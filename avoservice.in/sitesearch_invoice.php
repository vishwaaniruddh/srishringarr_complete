<?php
include("access.php");
$strPage = $_REQUEST['Page'];
?>
<form name="frm1" method="post" action="changeandroid.php">
<table style="width:80%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res" id="custtable">

<tr>
<th width="100">Invoice No</th>
<th width="100">Invoice Date</th>
<th width="100">Vertical</th>
<th width="80">Site/Sol/ATM ID</th>
<th width="50">Enduser Name</th>
<th width="82">Area</th>
<th width="80">City</th>
<th width="92">Address</th>
<!--<th width="42">State</th> -->
<th width="42">Branch</th>

<th width="42">UPS Start Date</th>
<th width="42">UPS Expiry Date</th>
<th width="42">Site Status</th>
<th width="92">Site Type</th>
<th width="30%">U-W Products</th>
<th width="5%">Generate Call</th>
<th width="30%">Warranty Expired</th>
</tr>

<?php

$count=0;
include("config.php");
$str.="select * from sales_orders where inv_no like '%".$_POST['data']."%' ";

$table=mysqli_query($con1,$str);

if(mysqli_num_rows($table)>0) {
$row= mysqli_fetch_row($table);

$pono=mysqli_query($con1,"select atmid,type,alert_id,cust_id,id,status,entry_date from pending_installations where id='".$row[1]."'");
$pon=mysqli_fetch_row($pono);

/* if($pon[1]=="AMC")
{
$nm="select bankname,atmid,cid,area,city,address,state,branch,amcid, amc_st_date, amc_ex_date, active from Amc where amcid='".$pon[0]."'";
}
else{ */
	
$nm="select  bank_name,atm_id,cust_id,area,city,address,state1,branch_id,track_id, start_date, expdt, active from atm where track_id='".$pon[0]."'";
//	}

echo $nm;

$invoice=$row[2];	
$invdt=$row[3];
$atm=mysqli_query($con1,$nm);

while($atmdet=mysqli_fetch_row($atm)) {	

	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$atmdet[2]."'");
	$custrow=mysqli_fetch_row($qry);
	
	$brqry=mysqli_query($con1,"select name from avo_branch where id='".$atmdet[7]."'");
	$brrow=mysqli_fetch_row($brqry);
 ?>
<tr>
<td  valign="top">&nbsp;<?php echo $invoice; ?></td>
<td  valign="top">&nbsp;<?php echo $invdt; ?></td>

<td  valign="top">&nbsp;<?php echo $custrow[0]; ?></td> <!-- Cust-->
<td  valign="top">&nbsp;<?php echo $atmdet[1]; ?></td> <!-- Site ID-->
<td  valign="top">&nbsp;<?php echo $atmdet[0]; ?></td>  <!-- Bank-->
<td  valign="top">&nbsp;<?php echo $atmdet[3]; ?></td> 
<td  valign="top">&nbsp;<?php echo $atmdet[4]; ?></td> 
<td  valign="top">&nbsp;<?php echo $atmdet[5]; ?></td> 
<td  valign="top">&nbsp;<?php echo $brrow[0]; ?></td>  <!--Branch-->
<td  valign="top">&nbsp;<?php if ($atmdet[9]!='0000-00-00') {echo $atmdet[9];}
 else {echo $invdt;} ?></td>   <!--Start date-->
<td  valign="top">&nbsp;<?php echo $atmdet[10]; ?></td>

<td  valign="top">&nbsp;<?php if ($atmdet[11]=='Y') { echo "Active"; }
 else { echo "Deactive ";} ?></td> <!--Site Status-->

<td  valign="top">&nbsp;<?php echo $pon[1]; ?></td> <!--Site Type-->
<!--   =========Assets in Warr=======  -->


<?php
if($pon[1]=='AMC') {
    //=======Need to work on old========
$qry2me=mysqli_query($con1,"select assetspecid,quantity,assets_name,valid from amcassets where callid='".$pon[4]."'");

}else

$qry2me=mysqli_query($con1,"select * from site_assets where atmid='".$atmdet[8]."' and status=1");

if(mysqli_num_rows($qry2me)>0){
?>
<td width="100"> 
<?
while($detailme=mysqli_fetch_row($qry2me))
{ 
$qry3me=mysqli_query($con1,"select name from assets_specification where ass_spc_id='$detailme[4]'");
$row3me=mysqli_fetch_row($qry3me);
$asst=$row3me[0];

echo $detailme[3].' Cap:' .$asst.'(Qty:'.$detailme[6].') || Start Date:'.$detailme[16].' || Exp Date:'.$detailme[18]."</br>";
}?>
</td>

<td width="56" height="31">  <a href="javascript:confirm_generate('<?php echo $atmdet[8]; ?>','<?php echo $atmdet[1]; ?>','<?php echo $atmdet[2]; ?>','site');" class="update"> Generate Call </a></td>
<? }  else {?>
<td>No Assets</td><td></td>
<? } ?>
<td width="100"><?php 

$qry2me=mysqli_query($con1,"select * from site_assets where atmid='".$atmdet[8]."' and status=0");
while($detailme=mysqli_fetch_row($qry2me))
{
$qry3me=mysqli_query($con1,"select name from assets_specification where ass_spc_id='$detailme[4]'");
$row3me=mysqli_fetch_row($qry3me);
$asst=$row3me[0];

echo $detailme[3].' Cap:' .$asst.'(Qty:'.$detailme[6].') || Start Date:'.$detailme[16].' || Exp Date:'.$detailme[18]."</br>";
} 
?>
</td>
</tr>
<?php
}

//=============New Sales order

} else {

$str1.="select * from so_order where inv_no like '%".$_POST['data']."%' ";
 $table=mysqli_query($con1,$str1);

if(mysqli_num_rows($table)>0) {
$row= mysqli_fetch_row($table);

$pono=mysqli_query($con1,"select atm_id, so_trackid from new_sales_order where so_trackid='".$row[1]."'");

$pon=mysqli_fetch_row($pono);
$invoice=$row[2];	
$invdt=$row[3];


$nm="select * from atm where atm_id='".$pon[0]."'";
//==================
echo $nm;

$atm=mysqli_query($con1,$nm);

while($atmdet=mysqli_fetch_row($atm)) {	

	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$atmdet[2]."'");
	$custrow=mysqli_fetch_row($qry);
	
	$brqry=mysqli_query($con1,"select name from avo_branch where id='".$atmdet[7]."'");
	$brrow=mysqli_fetch_row($brqry);

 ?>
<tr>
<td  valign="top">&nbsp;<?php echo $invoice; ?></td>
<td  valign="top">&nbsp;<?php echo $invdt; ?></td>

<td  valign="top">&nbsp;<?php echo $custrow[0]; ?></td> <!-- Cust-->
<td  valign="top">&nbsp;<?php echo $atmdet[1]; ?></td> <!-- Site ID-->
<td  valign="top">&nbsp;<?php echo $atmdet[3]; ?></td>  <!-- Bank-->
<td  valign="top">&nbsp;<?php echo $atmdet[4]; ?></td> 
<td  valign="top">&nbsp;<?php echo $atmdet[6]; ?></td> 
<td  valign="top">&nbsp;<?php echo $atmdet[9]; ?></td> 
<td  valign="top">&nbsp;<?php echo $brrow[0]; ?></td>  <!--Branch-->

<td  valign="top">&nbsp;<?php if ($atmdet[8]!='0000-00-00') {echo $atmdet[8];}
 else {echo $invdt;} ?></td>   <!--Start date-->

<td  valign="top">&nbsp;<?php echo $atmdet[14]; ?></td>

<td  valign="top">&nbsp;<?php if ($atmdet[22]=='Y') { echo "Active"; }
 else { echo "Deactive ";} ?></td> <!--Site Status-->
<td  valign="top">&nbsp;<?php echo "." ?></td> <!--Site Type-->

<?php 
$qry2me=mysqli_query($con1,"select * from site_assets where atmid='".$atmdet[0]."' and status=1 and so_id='".$pon[1]."'");
if(mysqli_num_rows($qry2me) >0) {
?>    
<td width="100"> 
<?
while($detailme=mysqli_fetch_row($qry2me))
{ 

$qry3me=mysqli_query($con1,"select name from assets_specification where ass_spc_id='$detailme[4]'");
$row3me=mysqli_fetch_row($qry3me);
$asst=$row3me[0];

echo $detailme[3].' Cap:' .$asst.'(Qty:'.$detailme[6].') || Start Date:'.$detailme[16].' || Exp Date:'.$detailme[18]."</br>";
//echo $detailme[3].' Cap:' .$row3me[2].'('.str_replace(',',' ',$detailme[5]).')'.'/ Qty:'.$detailme[6].' || Exp Date:'.$expdt."</br>";
} 
?>
</td>

<td width="56" height="31">  <a href="javascript:confirm_generate('<?php echo $atmdet[0]; ?>','<?php echo $atmdet[1]; ?>','<?php echo $atmdet[2]; ?>','site');" class="update"> Generate Call </a></td>
<?  }  else{ ?>
<td> No Assets in Warranty</td> <td></td>

<?  } ?>
<td width="100"><?php 

$qry2me=mysqli_query($con1,"select * from site_assets where atmid='".$atmdet[0]."' and status=0 and so_id='".$pon[1]."'");
//echo "select * from site_assets where atmid='".$atmdet[0]."' and status=0 and so_id='".$pon[1]."'";
while($detailme=mysqli_fetch_row($qry2me))
{
$qry3me=mysqli_query($con1,"select name from assets_specification where ass_spc_id='$detailme[4]'");
$row3me=mysqli_fetch_row($qry3me);
$asst=$row3me[0];

echo $detailme[3].' Cap:' .$asst.'(Qty:'.$detailme[6].') || Start Date:'.$detailme[16].' || Exp Date:'.$detailme[18]."</br>";
} ?>
</td>
<? } 
}?>
</tr>
<?php } ?>
</table>


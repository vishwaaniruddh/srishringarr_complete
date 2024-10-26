<?php
include("access.php");
$strPage = $_REQUEST['Page'];

echo "Hiiiiiiii!!!!!!"
?>
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

<th width="30%">U-W Products</th>
<th width="5%">Generate Call</th>
<th width="30%">Warranty Expired</th>
</tr>

<?php

$count=0;
include("config.php");
$barqr="select * from so_order_barcode where barcode_no ='".$_POST['data']."' ";
//echo $barqr;
$barc=mysqli_query($con1,$barqr);
while($barrow=mysqli_fetch_row($barc))
{

$str1.="select * from so_order where po_id ='".$barrow[1]."' ";
$table=mysqli_query($con1,$str1);
$row= mysqli_fetch_row($table);

$invoice=$row[2];	
$invdt=$row[3];

$so_qry="select * from demo_atm where so_id ='".$barrow[1]."' ";
$demo_atm=mysqli_query($con1,$so_qry);
$atm= mysqli_fetch_row($demo_atm);



//echo $nm;y

	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$atm[2]."'");
	$custrow=mysqli_fetch_row($qry);
	
	$brqry=mysqli_query($con1,"select name from avo_branch where id='".$atm[10]."'");
	$brrow=mysqli_fetch_row($brqry);

 ?>
<tr>
<td  valign="top">&nbsp;<?php echo $invoice; ?></td>
<td  valign="top">&nbsp;<?php echo $invdt; ?></td>

<td  valign="top">&nbsp;<?php echo $custrow[0]; ?></td> <!-- Cust-->
<td  valign="top">&nbsp;<?php echo $atm[1]; ?></td> <!-- Site ID-->
<td  valign="top">&nbsp;<?php echo $atm[6]; ?></td>  <!-- Bank-->
<td  valign="top">&nbsp;<?php echo $atm[7]; ?></td> 
<td  valign="top">&nbsp;<?php echo $atm[9]; ?></td> 
<td  valign="top">&nbsp;<?php echo $atm[11]; ?></td> 
<td  valign="top">&nbsp;<?php echo $brrow[0]; ?></td>  <!--Branch-->

<?php 

$qry2me=mysqli_query($con1,"select * from site_assets where so_id='".$barrow[1]."' and status=1 and assets_spec='".$barrow[2]."' and assets_name='UPS'");
if(mysqli_num_rows($qry2me) >0) {
//$site_r=mysqli_fetch_row($qry2me);


while($detailme=mysqli_fetch_row($qry2me))
{ 

$qry3me=mysqli_query($con1,"select name from assets_specification where ass_spc_id='$detailme[4]'");
$row3me=mysqli_fetch_row($qry3me);
$asst=$row3me[0];
?>    
<td width="100"> 
<?
echo $detailme[3].' Cap:' .$asst.'(Qty:'.$detailme[6].') || Start Date:'.$detailme[16].' || Exp Date:'.$detailme[18]."</br>";
?> </td> <?
} 
?>


<td width="56" height="31">  <a href="javascript:confirm_generate('<?php echo $detailme[7]; ?>','<?php echo $atm[1]; ?>','<?php echo $detailme[1]; ?>','site');" class="update"> Generate Call </a></td>
<?  }  else{ ?>
<td> No Assets in Warranty</td> <td></td>

<?  } ?>
<td width="100"><?php 

$qry2me=mysqli_query($con1,"select * from site_assets where so_id='".$barrow[1]."' and status=0 and assets_spec='".$barrow[2]."' and assets_name='UPS'");
while($detailme=mysqli_fetch_row($qry2me))
{
$qry3me=mysqli_query($con1,"select name from assets_specification where ass_spc_id='$detailme[4]'");
$row3me=mysqli_fetch_row($qry3me);
$asst=$row3me[0];

echo $detailme[3].' Cap:' .$asst.'(Qty:'.$detailme[6].') || Start Date:'.$detailme[16].' || Exp Date:'.$detailme[18]."</br>";
}  ?>
</td>
 

</tr>
<?php } ?>
</table>


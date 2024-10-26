<?php
session_start();
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
 //echo "br=".$br=$_POST['branch'];
include('config.php');
############# must create your db base connection

$strPage = $_REQUEST['Page'];

?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" >
<tr>

<th width="5%">S.N.</th> 
<th width="5%">PO No</th> 
<th width="5%">PO Date</th>
<th width="5%">Do No</th>
<th width="5%">DO Date</th>
<th width="5%">SO Date/time</th>
<th width="5%">End User/Consignee</th>
<th width="5%">Site/Sol/ATM Id</th>
<th width="5%">Delivery/Consignee Address</th>
<th width="5%">CITY</th>
<th width="5%">STATE</th>
<th width="5%">PIN CODE</th>
<th width="5%">Sales Person</th>
<th width="5%">Vertical/Customer</th>
<th width="5%">Buyer Name and address</th>
<th width="5%">Buyer GST No.</th>
<th width="5%">Contact Person</th>
<th width="5%">Contact No.</th>
<th width="5%">Created By</th>
<th width="5%">UPS</th>
<th width="5%">Rate/Unit</th>
<th width="5%">Buyback rate/unit</th>

<th width="10%">Battery</th>
<th width="5%">Rate/Unit</th>
<th width="5%">Buyback rate/unit</th>

<th width="10%">Iso Trx</th>
<th width="5%">Rate/Unit</th>
<th width="5%">Buyback rate/Unit</th>

<th width="10%">Stabilizer</th>
<th width="5%">Rate/Unit</th>
<th width="5%">Buyback rate/Unit</th>

<th width="10%">AVR</th>
<th width="5%">Rate/Unit</th>
<th width="5%">Buyback rate/Unit</th>

<th width="10%">Others</th>
<th width="5%">Rate/Unit</th>
<!--<th width="5%">ED</th>-->
<th width="5%">Buyback Details</th>
<th width="5%">Buyback Amount</th>
<th width="5%">Remarks Update</th>
<th width="5%">All Remarks</th>
<?php if($_SESSION['designation']==7){ ?>
<th width="5%">Generate Call </th>
<!--<th width="5%"> Edit </th>-->
<th width="5%">Update </th>
<?php } ?>
</tr>
<?php


$typenew=$_POST['type'];
if($_POST['type']=='sales'){
$flag='atm';
//$sql="select po,podate,atm_id from atm where po in (select po_no from purchase_order where del_type='site_del') and atm_id not in(select atmid from sales_orders) order by podate DESC "; 
$sql="select a.atmid,a.po,a.cust_id,a.req_date,a.DNo,a.del_type,a.type,a.ed,a.id,a.contactperson,a.contactno,a.BB_Details,a.bbdrate,a.createdby,a.entry_date,b.atm_id from pending_installations a,atm b where a.status=0 and a.type='sales' and a.del_type='site_del' and a.atmid=b.track_id";
}
else
{
$flag='amc';

$sql="select a.atmid,a.po,a.cust_id,a.req_date,a.DNo,a.del_type,a.type,a.ed,a.id,a.contactperson,a.contactno,a.BB_Details,a.bbdrate,a.createdby,a.entry_date,b.atmid from pending_installations a,Amc b where a.status=0 and a.type='AMC' and a.del_type='site_del' and a.atmid=b.amcid";
}
//========== branchwise===========
 	if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='' )
         {
          if($flag=="atm")
   	      $sql.=" and b.branch_id ='".$_POST['branch_avo']."'";
          else
              $sql.=" and b.branch ='".$_POST['branch_avo']."'";
         }
         // clientwise
         if(isset($_POST['cid']) && $_POST['cid']!='' )
         {
          $sql.=" and a.cust_id ='".$_POST['cid']."'";
         }
         if(isset($_POST['atmid']) && $_POST['atmid']!='' )
         {
          if($flag=="atm")
   	      $sql.=" and b.atm_id ='".$_POST['atmid']."'";
          else
              $sql.=" and b.atmid ='".$_POST['atmid']."'";
         }
//======================================Search Call Date wise
if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!=''){
		$fromdt=$_POST['fromdt'];
		$todt=$_POST['todt'];
	
			$fromdt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
			$todt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));
			$sql.=" and a.entry_date between '".$fromdt."' and '".$todt."'";
	
}

$sql.=" order by a.id desc ";
//echo $sql;

$table=mysqli_query($con1,$sql);
$count=0;
$Num_Rows = mysqli_num_rows ($table);
 ?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>
 Records Per Page :<select name="perpg" id="perpg" onchange="searchById('Listing','1','perpg');">

 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%10==0)
 {
 ?>
 <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
 <?php
 }
 }
 
 ?>
 <option value="<?php echo $Num_Rows; ?>"><?php echo "All"; ?></option>
 </select>
 
 </div>
 <?php
########### pagins
//echo $_POST['perpg'];
$Per_Page =$_POST['perpg'];   // Records Per Page
 
$Page = $strPage;
if(!$strPage)
{
	$Page=1;
}
 
$Prev_Page = $Page-1;
$Next_Page = $Page+1;


$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}
//echo $sql;
$qr22=$sql;
$sql.=" LIMIT $Page_Start , $Per_Page";
// echo $sql;
$table=mysqli_query($con1,$sql);
//echo mysqli_num_rows($table);
if(mysqli_num_rows($table)>0) {
	$i=0;
while($row= mysqli_fetch_row($table))
{

	//echo "select bankname,cid,area,city,address,state from Amc where atmid='".$row[1]."'";
	if($flag=="amc"){
	
        $atm=mysqli_query($con1,"select bankname,atmid,cid,area,city,address,state,pincode from Amc where amcid='".$row[0]."'");
    	}
	else{
			//echo "select  bank_name,atm_id,cust_id,area,city,address,state1 from atm where po='".$row[0]."'";
	$atm=mysqli_query($con1,"select  bank_name,atm_id,cust_id,area,city,address,state1,pincode from atm where track_id='".$row[0]."'");
	}

$atmdet=mysqli_fetch_row($atm);

	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[2]."'");
	$custrow=mysqli_fetch_row($qry);
	
	$tab=mysqli_query($con1,"select buyeraddress,gst,po_date,salesperson from purchase_order where po_no='".$row[1]."'");	
	$row1=mysqli_fetch_row($tab);
	
	//echo "eng stat".$row[15];
		?>
<tr>

<td  valign="top"><?php echo ++$i; ?></td>
<td  valign="top">&nbsp;<?php echo $row[1]; ?></td>
<td  valign="top">&nbsp;<?php echo $row1[2]; ?></td>
<td  valign="top">&nbsp;<?php echo $row[4]; ?></td>     
<td  valign="top">&nbsp;<?php echo $row[3]; ?></td>
<td  valign="top">&nbsp;<?php echo $row[14]; ?></td>
<td width="71" valign="top">&nbsp;<?php echo $atmdet[0]; ?></td>
<td valign="top">&nbsp;<?php echo $atmdet[1]; ?></td>
<td valign="top">&nbsp;<?php echo $atmdet[5] ;?></td>

<td valign="top">&nbsp;
		<?php 
		
		echo $atmdet[4] ;  ?> </td>

<td valign="top">&nbsp;<?php echo  $atmdet[6] ;?></td>

<td valign="top">&nbsp;<?php echo $atmdet[7] ;?></td>
<td valign="top">&nbsp;<?php echo $row1[3] ;?></td>
<td valign="top">&nbsp;<?php echo $custrow[0] ;?></td>
<td valign="top">&nbsp;<?php echo $row1[0] ;?></td>
<td valign="top">&nbsp;<?php echo $row1[1] ;?></td>
<td valign="top">&nbsp;<?php echo $row[9] ;?></td>
<td valign="top">&nbsp;<?php echo $row[10] ;?></td>
<td valign="top">&nbsp;<?php echo $row[13] ;?></td>
<?php
if($flag=="amc")
    {
    $tab=mysqli_query($con1,"select assetspecid,quantity,rate,buyback,valid from amcassets where assets_name='UPS' and callid='".$row[8]."'");	
	$row1=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row1[0]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb=$row1[3];
    }
else{
    $tab=mysqli_query($con1,"select assets_spec,quantity,rate,valid from site_assets where po='".$row[1]."' and assets_name='UPS' and callid='".$row[8]."'");	
	$row1=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row1[0]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb='';
    }


	?>
    <td> <?php echo "Model: $rowe[0]" ."<br>". "Qty: $row1[1]" ."<br>". "Warranty: $row1[3]" ;?> </td>
    <td  valign="top">&nbsp;<?php echo $row1[2]; ?></td>
    <td  valign="top">&nbsp;<?php echo $bb; ?></td> 

<?php

if($flag=="amc"){
$tab=mysqli_query($con1,"select assetspecid,quantity,rate,buyback,valid from amcassets where assets_name='Battery' and callid='".$row[8]."'");	
	$row2=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row2[0]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb=$row2[3];
}
else{
$tab=mysqli_query($con1,"select assets_spec,quantity,rate,valid from site_assets where po='".$row[1]."' and assets_name='Battery' and callid='".$row[8]."'");	
	$row2=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row2[0]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb='';
}
 
	?>
        <td> <?php echo "Model: $rowe[0]" ."<br>". "Qty: $row2[1]" ."<br>". "Warranty: $row2[3]" ;?> </td>
        <td  valign="top">&nbsp;<?php echo $row2[2]; ?></td>
        <td  valign="top">&nbsp;<?php echo $bb; ?></td>
<?php

if($flag=="amc"){
$tab=mysqli_query($con1,"select assetspecid,quantity,rate,buyback,valid from amcassets where assets_name='Isolation Transformer' and callid='".$row[8]."'");	
	$row3=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row3[0]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb=$row3[3];
}
else{
$tab=mysqli_query($con1,"select assets_spec,quantity,rate,valid from site_assets where po='".$row[1]."' and assets_name='Isolation Transformer' and callid='".$row[8]."'");	
	$row3=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row3[0]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb='';
}

	?>
    <td> <?php echo "Model: $rowe[0]" ."<br>". "Qty: $row3[1]" ."<br>". "Warranty: $row3[3]" ;?> </td>
    <td  valign="top">&nbsp;<?php echo $row3[2]; ?></td>
    <td  valign="top">&nbsp;<?php echo $bb; ?></td>
<?php

if($flag=="amc"){
$tab=mysqli_query($con1,"select assetspecid,quantity,rate,buyback,valid from amcassets where assets_name='Stabilizer' and callid='".$row[8]."'");	
	$row4=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row4[0]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb=$row4[3];
}
else{
$tab=mysqli_query($con1,"select assets_spec,quantity,rate,valid from site_assets where po='".$row[1]."' and assets_name='Stabilizer' and callid='".$row[8]."'");	
	$row4=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row4[0]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb='';
}

	?>
    <td> <?php echo "Model: $rowe[0]" ."<br>". "Qty: $row4[1]" ."<br>". "Warranty: $row4[3]" ;?> </td>
    <td  valign="top">&nbsp;<?php echo $row4[2]; ?></td>
    <td  valign="top">&nbsp;<?php echo $bb; ?></td>
<?php

if($flag=="amc"){
$tab=mysqli_query($con1,"select assetspecid,quantity,rate,buyback,valid from amcassets where assets_name='AVR' and callid='".$row[8]."'");	
	$row5=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row5[0]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb=$row5[3];
}
else{
$tab=mysqli_query($con1,"select assets_spec,quantity,rate,valid from site_assets where po='".$row[1]."' and assets_name='AVR' and callid='".$row[8]."'");	
	$row5=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row5[0]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb='';
}
	?>
    <td> <?php echo "Model: $rowe[0]" ."<br>". "Qty: $row5[1]" ."<br>". "Warranty: $row5[3]" ;?> </td>
       <td  valign="top">&nbsp;<?php echo $row5[2]; ?></td>
    <td  valign="top">&nbsp;<?php echo $bb; ?></td>
<?php

if($flag=="amc"){
$tab=mysqli_query($con1,"select assets_name,rate from amcassets where assets_name<>'UPS' and assets_name<>'Battery' and assets_name<>'Isolation Transformer' and assets_name<>'Stabilizer' and assets_name<>'AVR' and callid='".$row[8]."'");	
	$row6=mysqli_fetch_row($tab);
	
}
else{
$tab=mysqli_query($con1,"select assets_name,rate from site_assets where po='".$row[1]."' and assets_name<>'UPS' and assets_name<>'Battery' and assets_name<>'Isolation Transformer' and assets_name<>'Stabilizer' and assets_name<>'AVR' and callid='".$row[8]."'");	
	$row6=mysqli_fetch_row($tab);
}

	?>
<td valign="top">&nbsp;<?php echo $row6[0] ;?></td>
<td ><?php echo $row6[1];  ?></td>

<td><?php echo $row[11]; ?></td>
<td><?php echo $row[12]; ?></td>

<?php $qry_soupdt=mysqli_query($con1,"select Remarks_update from SO_Update where so_id='".$row[8]."' order by updt_id DESC limit 1");

//echo "select Remarks_update from SO_Update where so_id='".$row[8]."' order by updt_id DESC limit 1";

//echo "select Remarks_update from SO_Update where po_id='".$row[8]."' and date <='".$today."' order by date DESC";
$fetchsoupdt=mysqli_fetch_array($qry_soupdt);
?>
<td> <?php echo $fetchsoupdt[0];?></td>

<td><a href="javascript:void(0);" onclick="window.open('view_SO.php?id=<?php echo $row[8]?>&typ=1','view updates','width=700px,height=750,left=200,top=40')" class="update" >View</a></td>
<?php if($_SESSION['designation']==7){ ?>

<td><a href="salesorder.php?id=<?php echo $row[8]; ?>"  >Generate</a></td>
<!--<td><a href="newsite1.php?id=<?php echo $row[8]?>">Edit</a></td> -->
<td><a href="javascript:void(0);" onclick="window.open('update_generateSO.php?id=<?php echo $row[8]?>&typ=1','Update_generateSO','width=700px,height=750,left=200,top=40')" class="update" >Update</a></td>

<?php
} }
?>
</tr>

</table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php


if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a>";
}
/*
for($i=1; $i<=$Num_Pages; $i++){
	if($i != $Page)
	{
		echo " <li><a href=\"JavaScript:searchById('Listing','$i')\">$i</a> </li>";
	}
	else
	{
		echo "<li class='currentpage'><b> $i </b></li>";
	}
}*/
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}
    
}

?>
<form name="frm" method="post" action="salesreport.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="hidden" name="flagdata" value="<?php echo $typenew; ?>" readonly>

<input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>
 
<div id="bg" class="popup_bg"> </div> 

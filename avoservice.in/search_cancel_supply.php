<?php
include("access.php");



?>

<table style="width:80%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res" id="custtable">

<tr>
<th width="80">Invoice No</th>
<th width="80">Site/Sol/ATM ID</th>
<th width="50">Vertical</th>
<th width="50">Enduser Name</th>
<th width="50">Area</th>
<th width="50">City</th>
<th width="10%">Address</th>
<th width="42">State</th>
<th width="42">Branch</th>
<th width="8%">Status</th>
<th width="30%">Products</th>
<th width="8%">Action</th>

</tr>

<?php

$count=0;
include("config.php");

// data==Site ID/add
//type ==search type Site or Add


$str ="select * from so_order where 1 ";


if(isset($_POST['type']) && $_POST['type']=='siteid')
{
$str.=" and atm_id like '%".$_POST['data']."%' ";
}

if (isset($_POST['type']) && $_POST['type']=='invoice')
{
//	$str.=" and inv_no like '%".$_POST['data']."%' ";
	$str.=" and inv_no = '".$_POST['data']."' ";
}

if (isset($_POST['type']) && $_POST['type']=='sno')
{
$snoqry=mysqli_query($con1,"Select so_id from so_order_barcode where barcode_no='".$_POST['data']."'");
$snorow=mysqli_fetch_row($snoqry);
$so_idd=$snorow[0];

$str.=" and po_id ='".$so_idd."' ";
}



$qry=mysqli_query($con1,$str);

while($srow=mysqli_fetch_row($qry))
{
$count=$count+1;

//echo "select * from demo_atm where so_id='".$srow[1]."'";

$sql=mysqli_query($con1,"select * from demo_atm where so_id='".$srow[1]."'");
$row=mysqli_fetch_row($sql);

$qry3=mysqli_query($con1,"select * from avo_branch where id='".$row[10]."'");
$row3=mysqli_fetch_row($qry3);

$qry34=mysqli_query($con1,"select * from customer where cust_id='".$row[2]."'");
$row34=mysqli_fetch_row($qry34);
?>
<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">

<td><?php echo $srow[2]; ?></td> <!--Invoice-->
<td><?php echo $row[1]; ?></td> <!--ATM ID-->
<td><?php echo $row34[1]; ?></td>  <!--Vertical-->
<td><?php echo $row[6]; ?></td>   <!-- End User-->
<td><?php echo $row[7]; ?></td>   <!-- Area-->
<td><?php echo $row[9]; ?></td>   <!-- City-->
<td><?php echo $row[11]; ?></td>   <!-- Add-->
<td><?php echo $row[13]; ?></td>  <!-- State-->
<td><?php echo $row3[1]; ?></td>  <!-- Branch-->

<?php 

if($srow[19]=='1'){ $status="still Invoice is not closed. Hence, Cancel Invoice Directly"; }
elseif($srow[19]=='c'){ $status="Already Invoice Cancelled"; }
elseif($srow[19]=='2'){ $status="Supplied to the Site"; }
elseif($srow[19]=='h'){ $status="It is in Hold. Hence unhold to proceed further"; }
elseif($srow[19]=='9'){ $status="Already Sales return Done"; }
else{ 
    $status="It seems Unable to find the status"; }
?>
<td style="color:red"><?php echo $status; ?></td>

<?
$qry2me=mysqli_query($con1,"select * from new_sales_order_asset where so_trackid='".$srow[1]."'");

if(mysqli_num_rows($qry2me)>0){
?>
<td width="100"> 
<?
while($detailme=mysqli_fetch_row($qry2me))
{ 

$qry3me=mysqli_query($con1,"select name from assets_specification where ass_spc_id='$detailme[4]'");
$row3me=mysqli_fetch_row($qry3me);
$asst=$row3me[0];

echo $detailme[3].' Cap:' .$asst.' - Qty:'.$detailme[5]."</br>";

} 
?>
</td>
<td>
<?php if($srow[19]==2){ ?>
    <a href="#" onClick="window.open('cancel_sales.php?id=<?php echo $srow[1]; ?>','cancel_sales','width=500px,height=250,left=300,top=200')"> Cancel All Records </a>
  <? } else echo "Read the Status and proceed accordingly"; ?>  
    
    </td>
    

    
<!--<td width="56" height="31">  <a href="javascript:confirm_delete('<?php echo $srow[1]; ?>');" class="update"> Cancel </a></td> -->
<? } ?>

</tr>
<?php } ?>
</table>

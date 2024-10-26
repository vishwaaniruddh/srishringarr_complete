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
<th width="10%2">Address</th>
<th width="42">State</th>
<th width="42">Branch</th>
<th width="42"> Site Start Date</th>
<th width="25">Site Status</th>
<th width="30%">Products Supplied</th>
<th width="30%">Warranty Expired</th>

</tr>

<?php

$count=0;
include("config.php");
$br=$_SESSION['branch'];


if(isset($_POST['type']) && $_POST['type']=='siteid')
{
$str.="select * from atm where atm_id like '%".$_POST['data']."%' ";
}

elseif (isset($_POST['type']) && $_POST['type']=='add')
{
	$str.="select * from atm where address like '%".$_POST['data']."%'";
}

//echo $str;
$qry=mysqli_query($con1,$str);


$results = mysqli_num_rows($qry);

echo "Count -".$results;

while($row=mysqli_fetch_row($qry))
{
$count=$count+1;

$qry3=mysqli_query($con1,"select * from avo_branch where id='".$row[7]."'");
$row3=mysqli_fetch_row($qry3);

$qry34=mysqli_query($con1,"select * from customer where cust_id='".$row[2]."'");
$row34=mysqli_fetch_row($qry34);
?>
<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">

<td><?php echo $row[1]; ?></td> <!--ATM ID-->

<td><?php echo $row34[1]; ?></td>  <!--Vertical-->
<td><?php echo $row[3]; ?></td>   <!-- End User-->
<td><?php echo $row[4]; ?></td>   <!-- Area-->
<td><?php echo $row[6]; ?></td>   <!-- City-->
<td><?php echo $row[9]; ?></td>   <!-- Add-->
<td><?php echo $row[15]; ?></td>  <!-- State-->
<td><?php echo $row3[1]; ?></td>  <!-- Branch-->
<td><?php echo $row[8]; ?></td>   <!-- Start date-->

<td style="color:red;">
<?php if ($row[22] =='Y') {echo "Active";}
          else{echo "Non-Active";}?></td>

<?php 

$qry2me=mysqli_query($con1,"select * from site_assets where atmid='".$row[0]."' and status=1");

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
//echo $detailme[3].' Cap:' .$row3me[2].'('.str_replace(',',' ',$detailme[5]).')'.'/ Qty:'.$detailme[6].' || Exp Date:'.$expdt."</br>";
} 
?>
</td>

<td width="56" height="31">  <a href="javascript:confirm_generate('<?php echo $row[0]; ?>','<?php echo $row[1]; ?>','<?php echo $row[2]; ?>','site');" class="update"> Generate Call </a></td>
<? } else {?>

<td>No asset in Warr</td><td></td>
<? } ?>
<td width="100"><?php 

$qry2me=mysqli_query($con1,"select * from site_assets where atmid='".$row[0]."' and status=0");


while($detailme=mysqli_fetch_row($qry2me))
{
$qry3me=mysqli_query($con1,"select name from assets_specification where ass_spc_id='$detailme[4]'");
$row3me=mysqli_fetch_row($qry3me);
$asst=$row3me[0];

/*$validmnth=str_replace(',',' ',$detailme[5]);
if(isset($row[8]) and $row[8]!='0000-00-00')
$expdt=date('d-m-Y', strtotime($row[8] .' +'.$validmnth));
else
$expdt=date('d-m-Y', strtotime($row[13] .' +'.$validmnth)); */

echo $detailme[3].' Cap:' .$asst.'(Qty:'.$detailme[6].') || Start Date:'.$detailme[16].' || Exp Date:'.$detailme[18]."</br>";
} 
?>
</td>




</tr>
<?php } ?>
</table>

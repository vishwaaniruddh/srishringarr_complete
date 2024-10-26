<?php include("access.php");
include("config.php");

$getdata=$_GET['id'];


 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--validation-->

</head>



<body>


<center>
<?php // include("menubar.php"); ?>
<h2>Product Details</h2>
<table>

<?php $qry=mysqli_query($con1,"select * from amc_assets_new where po_id='".$_GET['id']."' ");
//echo "select * from amc_assts_new where po_id='".$_GET['id']."' "; 

?>
<th>S.No</th>
<th>Product Name</th>
<th>Model</th>
<th>Quantity</th>
<th>Rate</th>

<?php 
$s=1;
while($data=mysqli_fetch_array($qry)){?>


<tr>
<td><?php echo $s; ?></td>
<td><?php echo $data[2]; ?></td>
<td>
<? if($data[2]=='UPS'){ 
$asset=mysqli_query($con1,"Select name from assets_specification where assets_id='1'");
$asst_det=mysqli_fetch_row($asset);    
 echo $asst_det[0]; } else echo $data[3]; ?>   
</td>

<td><?php echo $data[4]; ?></td>
<td><?php echo $data[5]; ?></td>



</tr>
<?php $s++; }?>
</table>
</form>
</div>
</center>
</body>
</html>
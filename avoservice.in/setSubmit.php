<?php
include('config.php');

$id=$_GET['id'];
$sub=$_GET['sub'];

$qry=mysqli_query($con1,"update sales_orders set sub_date=STR_TO_DATE('".$sub."','%d/%m/%Y') where id='".$id."'");

if($qry)echo $sub;
else echo '-1';
?>
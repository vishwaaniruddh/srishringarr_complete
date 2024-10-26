<?php
include('config.php');

$id=$_GET['id'];
$del=$_GET['del'];

$qry=mysqli_query($con1,"update sales_orders set del_date=STR_TO_DATE('".$del."','%d/%m/%Y') where id=".$id);

if($qry)echo $del;
else echo '-1';
?>
<?php
session_start();
include('config.php');
$id=$_POST['id'];
$err=0;


$insqr=mysqli_query($con1,"update sales_orders
 set call_status='1' where id='".$id."'");

if(!$insqr)
{
$err++;
}
//echo mysqli_error();
if($err==0)
{

echo "1";
}else
{

echo "0";
}


?>
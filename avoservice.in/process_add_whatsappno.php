<?php
session_start();

$client= $_POST['client'];
$bank= $_POST['bank'];
$name= $_POST['name'];
$no= $_POST['whatsapp_no'];



if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Your Session has expired. Please login again');window.location='index.php';</script>";
}
else
{
include('config.php');

//echo "INSERT INTO `whatsapp_customer` (`cust_id`, `group_id`, `name`, `whatsapp_no`) VALUES ('".$client."', '".$bank."', '".$name."', '".$no."')";

$qry=mysqli_query($con1,"INSERT INTO `whatsapp_customer` (`cust_id`, `group_id`, `name`, `whatsapp_no`) VALUES ('".$client."', '".$bank."', '".$name."', '".$no."')");

if($qry)
echo "<script type='text/javascript'>alert('Data Entered Successfully');window.location='add_whatsappno.php';</script>";
else
echo "<script type='text/javascript'>alert('Some Error Occurred'); window.location='add_whatsappno.php'; </script>";
}
?>
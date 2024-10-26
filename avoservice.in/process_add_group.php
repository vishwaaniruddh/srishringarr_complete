<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Your Session has expired. Please login again');window.location='index.php';</script>";
}
else
{
include('config.php');
$qry=mysqli_query($con1,"INSERT INTO `whatsapp_groupname` (`cust_id`, `groupname`, type) VALUES ('".$_POST['client']."', '".$_POST['bank']."', '".$_POST['type']."')");
if($qry)
echo "<script type='text/javascript'>alert('Data Entered Successfully');window.location='add_whatsappgroup.php';</script>";
else
echo "<script type='text/javascript'>alert('Some Error Occurred');window.location='add_whatsappgroup.php';</script>";
}
?>
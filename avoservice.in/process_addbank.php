<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Your Session has expired. Please login again');window.location='index.php';</script>";
}
else
{
include('config.php');
$qry=mysqli_query($con1,"INSERT INTO `avo_bank` (`cust_id`, `bank_name`) VALUES ('".$_POST['client']."', '".$_POST['bank']."')");
if($qry)
echo "<script type='text/javascript'>alert('Data Entered Successfully');window.location='add_avobank.php';</script>";
else
echo "<script type='text/javascript'>alert('Some Error Occurred');window.location='add_avobank.php';</script>";
}
?>
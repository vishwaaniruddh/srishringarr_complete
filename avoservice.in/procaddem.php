<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Your Session has expired. Please login again');window.location='index.php';</script>";
}
else
{
include('config.php');

//echo "INSERT INTO `emailid` (`custid`, `bank`, `email`, `status`,`type`) VALUES ('".$_POST['client']."', '".$_POST['bank']."', '".$_POST['email']."', '0','".$_POST['type']."')";
$qry=mysqli_query($con1,"INSERT INTO `emailid` (`custid`, `bank`, `email`, `status`,`type`) VALUES ('".$_POST['client']."', '".$_POST['bank']."', '".$_POST['email']."', '0','".$_POST['type']."')");

if($qry)
echo "<script type='text/javascript'>alert('Data Entered Successfully');window.location='addem.php';</script>";
else
echo "<script type='text/javascript'>alert('Some Error Occurred');window.location='addem.php';</script>";
}
?>
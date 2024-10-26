<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Your Session has expired. Please login again');window.location='index.php';</script>";
}
else
{
include('config.php');
$qry=mysqli_query($con1,"update `emailid` set `custid`='".$_POST['client']."', `bank`='".$_POST['bank']."', `email`='".$_POST['email']."',type='".$_POST['type']."' where id='".$_POST['id']."'");
if($qry)
echo "<script type='text/javascript'>alert('Data Updated Successfully');window.location='viewccmails.php';</script>";
else
echo "<script type='text/javascript'>alert('Some Error Occurred');window.location='viewccmails.php';</script>";
}
?>
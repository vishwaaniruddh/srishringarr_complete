<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Your Session has expired. Please login again');window.location='index.php';</script>";
}
else
{
include('config.php');


$qry=mysqli_query($con1,"update `avo_bank` set `cust_id`='".$_POST['client']."' , `bank_name`= '".$_POST['bank']."' where `bank_id`='".$_POST['bankid']."' ");

if($qry)
echo "<script type='text/javascript'>alert('Data Updated Successfully');window.location='view_avobank.php';</script>";
else
echo "<script type='text/javascript'>alert('Some Error Occurred');window.location='view_avobank.php';</script>";
}
?>
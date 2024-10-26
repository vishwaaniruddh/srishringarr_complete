<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Your Session has expired. Please login again');window.location='index.php';</script>";
}
else
{
include('config.php');
//echo " update `avo_branchmgr_email`  set `name`='".$_POST['name']."', `branch_id`='".$_POST['avobranch']."',`branch_email`='".$_POST['email']."' where `id`='".$_POST['id']."'";

$qry=mysqli_query($con1," update `avo_branchmgr_email`  set `name`='".$_POST['name']."', `branch_id`='".$_POST['avobranch']."',`branch_email`='".$_POST['email']."' where `id`='".$_POST['id']."'"); 

if($qry)
echo "<script type='text/javascript'>alert('Data Edited Successfully');window.location='view_branchmgr_mail.php';</script>";
else
echo "<script type='text/javascript'>alert('Some Error Occurred');window.location='view_branchmgr_mail.php';</script>";
}
?>
<?php 
include 'config.php';

session_start();

$name=$_POST['medicalname'];

$address=$_POST['medicaladdress'];

$phone=$_POST['medicalphone'];

$sql="insert into medical_stores(name,address,phone) values('$name','$address','$phone')";

$result=mysqli_query($con,$sql);
if($result)
{
header("location: home.php");
 }else
echo "error Inserting data";
?>

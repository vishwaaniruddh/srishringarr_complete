<?php 
include 'config.php';

session_start();

$name=$_POST['name'];
$address=$_POST['add'];
$city=$_POST['city'];
$contact=$_POST['cn'];
$pincode=$_POST['pin'];
$info=$_POST['info'];


$sql="insert into tel_directory(name,address,city,contact,pincode,information_for) values('$name','$address','$city','$contact','$pincode','$info')";

$result=mysqli_query($con,$sql);
if($result)
{
header("location: home.php");
 }else
echo "error Inserting data";
?> 
<?php 
include('config.php');

session_start();

$name=$_POST['name'];
$address=$_POST['add'];
$contact=$_POST['cn'];
$pincode=$_POST['pin'];
$info=$_POST['info'];


$sql="insert into tel_directory(name,address,contact,pincode,information_for) values('$name','$address','$contact','$pincode','$info')";

$result=mysql_query($sql);
if($result)
{
header("location: home.php");
 }else
echo "error Inserting data";
?>
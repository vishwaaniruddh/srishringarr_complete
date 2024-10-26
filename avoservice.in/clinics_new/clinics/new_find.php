<?php 
include 'config.php';

session_start();

$name=$_POST['findname'];

$sql="insert into finding(name) values('$name')";

$result=mysqli_query($con,$sql);
if($result)
{
header("location: home.php");
 }else
echo "error Inserting data";
?>
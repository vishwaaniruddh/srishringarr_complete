<?php 
include 'config.php';

session_start();

$name=$_POST['compname'];

$sql="insert into complaints(complaint) values('$name')";

$result=mysqli_query($con,$sql);
if($result)
{
header("location: home.php");
 }else
echo "error Inserting data";
?>






<?php 
include 'config.php';

session_start();

$inst=$_POST['inst'];

$sql="insert into how_to_take(how) values('$inst')";

$result=mysqli_query($con,$sql);
if($result)
{
header("location: home.php");
 }else
echo "error Inserting data";
?>
<?php 
include('config.php');

session_start();

$name=$_POST['cityname'];


$sql="insert into city(name) values('$name')";

$result=mysql_query($sql);
if($result)
{
header("location: viewcity.php");
 }else
echo "error Inserting data";
?>
<?php 
include('config.php');

session_start();


$name=$_POST['name'];




$sql="insert into diag(name) values('$name')";

$result=mysql_query($sql);
if($result)
{
header("location: home.php");
 }else
echo "error Inserting data";
?>
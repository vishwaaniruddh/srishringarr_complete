<?php 
include('config.php');

session_start();

$name=$_POST['act'];


$sql="insert into treat1(name) values('$name')";

$result=mysql_query($sql);
if($result)
{
header("location: view_treatgiven.php");
 }else
echo "error Inserting data";
?>
<?php 
include('config.php');

session_start();

$name=$_POST['hosname'];


$sql="insert into hospital(name) values('$name')";

$result=mysql_query($sql);
if($result)
{
header("location: viewhospital.php");
 }else
echo "error Inserting data";
?>
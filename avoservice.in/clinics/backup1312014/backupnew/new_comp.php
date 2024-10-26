<?php 
include('config.php');

session_start();

$name=$_POST['compname'];

$sql="insert into compla(name) values('$name')";

$result=mysql_query($sql);
if($result)
{
header("location: viewcomplain.php");
 }else
echo "error Inserting data";
?>
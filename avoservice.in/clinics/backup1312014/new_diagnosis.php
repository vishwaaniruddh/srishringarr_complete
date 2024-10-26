<?php 
include('config.php');

session_start();

$name=$_POST['act'];


$sql="insert into diag(name) values('$name')";

$result=mysql_query($sql);
if($result)
{
header("location: view_diagnosis.php");
 }else
echo "error Inserting data";
?>
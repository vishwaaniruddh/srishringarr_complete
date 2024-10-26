<?php 
include('config.php');

session_start();

$name=$_POST['act'];


$sql="insert into medicine(name) values('$name')";

$result=mysql_query($sql);
if($result)
{
header("location: view_dosage.php");
 }else
echo "error Inserting data";
?>
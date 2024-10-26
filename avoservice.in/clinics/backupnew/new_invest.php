<?php 
include('config.php');

session_start();

$name=$_POST['act'];


$sql="insert into investi(name) values('$name')";

$result=mysql_query($sql);
if($result)
{
header("location: view_invest.php");
 }else
echo "error Inserting data";
?>
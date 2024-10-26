<?php 
include('config.php');

session_start();

$name=$_POST['act'];


$sql="insert into action(name) values('$name')";

$result=mysql_query($sql);
if($result)
{
header("location: viewaction.php");
 }else
echo "error Inserting data";
?>
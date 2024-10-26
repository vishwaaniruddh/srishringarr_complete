<?php 
include('config.php');

session_start();

$name=$_POST['splname'];


$sql="insert into special(name) values('$name')";

$result=mysql_query($sql);
if($result)
{
header("location: viewspecial.php");
 }else
echo "error Inserting data";
?>
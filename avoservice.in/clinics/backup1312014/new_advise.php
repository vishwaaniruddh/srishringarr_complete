<?php 
include('config.php');

session_start();

$name=$_POST['advisename'];

$sql="insert into advise(name) values('$name')";

$result=mysql_query($sql);
if($result)
{
header("location: home.php");
 }else
echo "error Inserting data";
?>
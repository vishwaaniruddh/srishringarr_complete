<?php 
include('config.php');

session_start();

$name=$_POST['name'];
$desc=$_POST['desc'];
$cost=$_POST['cost'];



$sql="insert into med_reports(name,description,cost) values('$name','$desc','$cost')";

$result=mysql_query($sql);
if($result)
{
header("location: home.php");
 }else
echo "error Inserting data";
?>
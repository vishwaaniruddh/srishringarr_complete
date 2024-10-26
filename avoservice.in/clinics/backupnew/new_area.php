<?php 
include('config.php');

session_start();

$name=$_POST['areaname'];


$sql="insert into area(name) values('$name')";

$result=mysql_query($sql);
if($result)
{
header("location: viewarea.php");
 }else
echo "error Inserting data";
?>
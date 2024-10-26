<?php 
include('config.php');

session_start();

$name=$_POST['medname'];


$sql="insert into medicine(name) values('$name')";

$result=mysql_query($sql);
if($result)
{
header("location: viewmedicines.php");
 }else
echo "error Inserting data";
?>
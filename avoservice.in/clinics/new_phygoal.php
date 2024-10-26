<?php 
include('config.php');

session_start();

$name=$_POST['act'];


$sql="insert into goals(name) values('$name')";

$result=mysql_query($sql);
if($result)
{
header("location: view_phygoal.php");
 }else
echo "error Inserting data";
?>
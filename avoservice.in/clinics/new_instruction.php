<?php 
include('config.php');

session_start();

$name=$_POST['act'];


$sql="insert into ins1(name) values('$name')";

$result=mysql_query($sql);
if($result)
{
header("location: view_instruction.php");
 }else
echo "error Inserting data";
?>
<?php 
include('config.php');

session_start();

$name=$_POST['act'];
$pass=$_POST['pass'];


$sql="insert into login(username,password) values('$name','$pass')";

$result=mysql_query($sql);
if($result)
{
header("location: userPassword.php");
 }else
echo "error Inserting data";
?>
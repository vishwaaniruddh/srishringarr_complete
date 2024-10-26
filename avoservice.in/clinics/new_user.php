<?php 
include('config.php');

session_start();

$name=$_POST['act'];
$pass=$_POST['pass'];
$dept=$_POST['dept'];


$sql="insert into login(username,password,dept) values('$name','$pass','$dept')";

$result=mysql_query($sql);
if($result)
{
header("location: userPassword.php");
 }else
echo "error Inserting data";
?>
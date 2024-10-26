<?php 
include('config.php');

session_start();

$name=$_POST['findname'];

$sql="insert into findings(finding) values('$name')";

$result=mysql_query($sql);
if($result)
{
header("location: home.php");
 }else
echo "error Inserting data";
?>
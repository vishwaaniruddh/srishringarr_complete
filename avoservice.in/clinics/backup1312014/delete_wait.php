<?php 
include('config.php');

session_start();

$id=$_GET['id'];
$app_id=$_GET['aid'];

$sql1="delete from appoint where waiting_list='".$id."'";

$result1=mysql_query($sql1);

$sql="delete from surgery_wait where w_real_id='".$id."'"; 
$result=mysql_query($sql);

if($result && $result1)
{
if($app_id=="sa") {
header("location: Wait_surgery.php");
}else {
header("location: view_surgWait.php");}
}
else
echo "error Inserting data";
?>
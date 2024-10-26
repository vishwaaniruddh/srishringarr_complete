<?php 
include('config.php');

session_start();

$id=$_GET['id'];


$sql="delete from surgery1 where s_real_id='".$id."'"; 
$result=mysql_query($sql);

if($result)
{


header("location: view_surgry.php");}

else
echo "error Inserting data";
?>
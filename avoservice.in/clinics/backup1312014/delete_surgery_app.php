<?php 
include('config.php');

session_start();

$id=$_GET['id'];


$sql="delete from appoint where app_real_id='".$id."'";

$result=mysql_query($sql);



if($result )
{
//header("location: Wait_surgery.php");

}
else
echo "error Inserting data";
?>
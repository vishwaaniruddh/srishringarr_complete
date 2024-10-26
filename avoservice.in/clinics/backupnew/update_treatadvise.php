<?php 
include('config.php');

$id=$_POST['id'];
$name=$_POST['act'];

$sql="update advise set name='".$name."' where id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: view_treatadvise.php");

}
else
echo "error Updating data";
?>
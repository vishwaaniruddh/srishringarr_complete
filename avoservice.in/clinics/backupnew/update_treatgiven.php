<?php 
include('config.php');

$id=$_POST['id'];
$name=$_POST['act'];

$sql="update treat1 set name='".$name."' where treat_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: view_treatgiven.php");

}
else
echo "error Updating data";
?>
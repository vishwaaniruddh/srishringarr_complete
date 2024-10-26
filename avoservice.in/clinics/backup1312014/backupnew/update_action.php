<?php 
include('config.php');

$id=$_POST['id'];
$name=$_POST['act'];

$sql="update action set name='".$name."' where action_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: viewaction.php");

}
else
echo "error Updating data";
?>
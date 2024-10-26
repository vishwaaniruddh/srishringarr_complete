<?php 
include('config.php');

$id=$_POST['id'];
$name=$_POST['act'];

$sql="update goals set name='".$name."' where goal_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: view_phygoal.php");

}
else
echo "error Updating data";
?>
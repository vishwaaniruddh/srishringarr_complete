<?php 
include('config.php');

$id=$_POST['id'];
$name=$_POST['act'];

$sql="update opdmast set name='".$name."' where opdmast_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: view_opdcollheads.php");

}
else
echo "error Updating data";
?>
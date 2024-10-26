<?php 
include('config.php');

$id=$_POST['id'];
$name=$_POST['act'];

$sql="update orders set name='".$name."' where order_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: view_admitorder.php");

}
else
echo "error Updating data";
?>
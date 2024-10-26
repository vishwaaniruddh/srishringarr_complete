<?php 
include('config.php');

$id=$_POST['id'];
$name=$_POST['act'];

$sql="update keyword set name='".$name."' where keyword_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: view_diagkey.php");

}
else
echo "error Updating data";
?>
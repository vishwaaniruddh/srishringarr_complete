<?php 
include('config.php');

$id=$_POST['id'];
$name=$_POST['act'];

$sql="update diag set name='".$name."' where diag_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: view_diagnosis.php");

}
else
echo "error Updating data";
?>
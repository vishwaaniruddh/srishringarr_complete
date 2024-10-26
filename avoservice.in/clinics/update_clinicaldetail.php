<?php 
include('config.php');

$id=$_POST['id'];
$name=$_POST['act'];

$sql="update clinic set name='".$name."' where clinic_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: view_clinicaldetail.php");

}
else
echo "error Updating data";
?>
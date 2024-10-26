<?php 
include('config.php');

$id=$_POST['id'];
$name=$_POST['act'];

$sql="update medicine set name='".$name."' where med_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: view_dosage.php");

}
else
echo "error Updating data";
?>
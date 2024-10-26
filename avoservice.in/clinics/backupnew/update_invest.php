<?php 
include('config.php');

$id=$_POST['id'];
$name=$_POST['act'];

$sql="update investi set name='".$name."' where inv_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: view_invest.php");

}
else
echo "error Updating data";
?>
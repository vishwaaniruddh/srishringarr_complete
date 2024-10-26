<?php 
include('config.php');

$id=$_POST['id'];
$name=$_POST['name'];


$sql="update area set name='".$name."' where area_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: viewarea.php");

}
else
echo "error Inserting data";
?>
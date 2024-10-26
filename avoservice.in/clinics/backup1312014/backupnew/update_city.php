<?php 
include('config.php');

$id=$_POST['id'];
$name=$_POST['name'];

$sql="update city set name='".$name."' where city_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: viewcity.php");

}
else
echo "error Inserting data";
?>
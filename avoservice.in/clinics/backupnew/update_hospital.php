<?php 
include('config.php');

$id=$_POST['id'];
$name=$_POST['name'];


$sql="update hospital set name='".$name."' where hospital_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: viewhospital.php");

}
else
echo "error Inserting data";
?>
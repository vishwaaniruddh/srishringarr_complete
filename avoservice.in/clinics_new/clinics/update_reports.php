<?php 
include 'config.php';

$id=$_POST['id'];
$name=$_POST['name'];
$desc=$_POST['description'];
$cost=$_POST['cost'];

$sql="update med_reports set name='".$name."',description='".$desc."',cost='".$cost."' where reports_id='".$id."'";

$result=mysqli_query($con,$sql);
if($result)
{
	
header("location: home.php");

}
else
echo "error Inserting data";
?>
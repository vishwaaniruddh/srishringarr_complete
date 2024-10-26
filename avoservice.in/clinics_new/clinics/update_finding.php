<?php 
include 'config.php';

$id=$_POST['findid'];
$name=$_POST['findname'];

$sql="update finding set name ='".$name."' where id='".$id."'";

$result=mysqli_query($con,$sql);
if($result)
{
	
header("location: home.php");

}
else
echo "error Inserting data";
?>
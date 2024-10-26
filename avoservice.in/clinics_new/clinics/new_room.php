<?php
include 'config.php';
$room=$_POST['room'];

$sql=mysqli_query($con,"insert into room(type)values('$room')");

if($sql)
{
	header('Location:home.php');
}
else
echo "Error Inserting Data";
?>
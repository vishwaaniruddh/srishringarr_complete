<?php
include("config.php");
 $type=$_POST['type'];
 $name=$_POST['name'];
 
//echo "INSERT INTO `activity` (`type`, `name`) VALUES ('".$type."','".$name."')";
$qry=mysqli_query($con1,"INSERT INTO `activity` (`type`, `name`) VALUES ('".$type."','".$name."')");

if(!$qry)
echo mysqli_error();
if($qry){
	
	header('Location:createActivity.php?sucess=Your Activity Addedd successfully.');
	}
else
echo "Error Adding Activity";

?>
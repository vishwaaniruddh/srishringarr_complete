<?php 
include 'config.php';

$id=$_POST['id'];
$name=$_POST['name'];
$address=$_POST['add'];
$city=$_POST['city'];
$contact=$_POST['cn'];
$pincode=$_POST['pin'];
$info=$_POST['info'];


$sql="update tel_directory set name='".$name."',address='".$address."',city='".$city."',contact='".$contact."',pincode='".$pincode."',information_for ='".$info."' where tel_id='".$id."'";

$result=mysqli_query($con,$sql);
if($result)
{
	
header("location: home.php");

}
else
echo "error Inserting data";
?>

<?php 
include('config.php');

$id=$_POST['id'];
$name=$_POST['name'];
$address=$_POST['add'];
$contact=$_POST['cn'];
$pincode=$_POST['pin'];
$info=$_POST['info'];


$sql="update tel_directory set name='".$name."',address='".$address."',contact='".$contact."',pincode='".$pincode."',information_for ='".$info."' where tel_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: home.php");

}
else
echo "error Inserting data";
?>
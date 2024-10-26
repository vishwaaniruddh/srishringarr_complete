<?php 
include('config.php');

$id=$_POST['id'];
$name=$_POST['name'];
$address=$_POST['add'];
$city=$_POST['city'];
$contact=$_POST['cn'];
$pincode=$_POST['pin'];
$info=$_POST['info'];


$sql="update address set name='".$name."',office='".$address."',city='".$city."',mobile='".$contact."',pincode='".$pincode."',category ='".$info."' where tel_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: viewtelephone.php");

}
else
echo "error Inserting data";
?>
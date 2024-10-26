<?php
include('config.php');
$id=$_POST['id'];
$cid=$_POST['cid'];
$cname=$_POST['cname'];
$cont=$_POST['cont'];
$email=$_POST['email'];
$add=$_POST['add']; 
$pin=$_POST['pin'];

//echo "update `phppos_service` set ".$id."=Yes where id='$cid'";
if($cid=="sales"){ 
$sql="update `phppos_service` set name ='".$cname."',contact ='".$cont."',email ='".$email."',address ='".$add."',pincode ='".$pin."' where id='$id'";
}

else
$sql="update `phppos_service1` set name ='".$cname."',contact ='".$cont."',email ='".$email."',address ='".$add."',pincode ='".$pin."' where id='$id'";

$result=mysql_query($sql);

if($result)
{
	header('Location: amcview.php');
}
else
echo "Error Updating Data";
?>
<?php
$id=$_GET['id'];
$tos=$_GET['tos'];
//require_once('class_files/delete.php');
include('config.php');
//$del=new delete();
if($tos=='atm')
$del=mysqli_query($con1,"update atm set active='N' where track_id = '$id'");
else
$del=mysqli_query($con1,"update Amc set active='N' where AMCID = '$id'");
//$del->delete_from('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts','Amc','AMCID',$id);

if($del)
{
	header('Location:view_site.php');
}
else
echo "Error DeActivating Site";

?>
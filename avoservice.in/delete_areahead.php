<?php
$id=$_GET['id'];
require_once('class_files/delete.php');
$del=new delete();
$del->delete_from('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts','area_head','head_id',$id);

if($del)
{
	header('Location:view_areahead.php');
}
else
echo "Error Deleting Area Head";

?>
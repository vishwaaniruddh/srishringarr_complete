<?php
$id=$_GET['id'];
require_once('class_files/delete.php');
$del=new delete();
$del->delete_from('localhost','site','site','atm_site','area_engg','engg_id',$id);

if($del)
{
	header('Location:view_areaeng.php');
}
else
echo "Error Deleting Engineer";

?>
<?php
$name=$_POST['name'];
$id=$_POST['id'];
$cont=$_POST['cont'];
$email=$_POST['email'];
$city=$_POST['city'];
$area=$_POST['area'];

require_once('class_files/update.php');
$update=new update();
$update->update_table('localhost','site','site','atm_site','area_head',array("head_name","city","area","email_id","phone_no1"),array($name,$city,$area,$email,$cont),'head_id',$id);

if($update)
{
	header('Location:view_areahead.php');
}
else
echo "Error Updating Area Head";
?>
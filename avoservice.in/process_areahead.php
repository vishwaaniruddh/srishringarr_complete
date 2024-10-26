<?php
$city=$_GET['city'];
$area=$_GET['area'];
$name=$_GET['name'];
$cont=$_GET['cont'];
$email=$_GET['email'];
require_once('class_files/insert.php');
$in_obj=new insert();
$in_obj->insert_into('localhost','site','site','atm_site','area_head',array("head_name","area","city","email_id","phone_no1"),array($name,$area,$city,$email,$cont));

if($in_obj)
{
	header('Location:newarea_head.php');
}
else
echo "Error Creating Area Head";
?>
<?php
$city=$_GET['city'];
$area=$_GET['area'];
$name=$_GET['name'];
$cont=$_GET['cont'];
$email=$_GET['email'];
require_once('class_files/insert.php');
$in_obj=new insert();
$in_obj->insert_into('localhost','site','site','atm_site','area_engg',array("engg_name","area","city","email_id","phone_no1"),array($name,$area,$city,$email,$cont));

if($in_obj)
{
	header('Location:view_areaeng.php');
}
else
echo "Error Creating Area Engineer";
?>
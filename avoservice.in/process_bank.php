<?php
$name=$_GET['name'];
require_once('class_files/insert.php');
$in_obj=new insert();
$in_obj->insert_into('localhost','hav_acc','Myaccounts123*','hav_accounts','bank',array("bank_name"),array($name));

if($in_obj)
{
	header('Location:view_bank.php');
}
else
echo "Error Creating Bank";
?>
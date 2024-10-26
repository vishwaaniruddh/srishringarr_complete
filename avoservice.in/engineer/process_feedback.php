<?php
$alert=$_GET['alert'];
$eng_id=$_GET['eng_id'];
$feed=$_GET['feed'];

require_once('class_files/insert.php');
$in_obj=new insert();
$tab=$in_obj->insert_into('localhost','site','site','atm_site','eng_feedback',array("eng_id","alert_id","feedback"),array($eng_id,$alert,$feed));

/*include('config.php');
$sql=mysql_query("update alert set status='Done' where alert_id='$alert'");*/
include_once('class_files/update.php');
$up=new update();
$tab1=$up->update_table('localhost','site','site','atm_site','alert',array("status"),array("Done"),"alert_id",$alert);


if($tab && $tab1)
{
	header('Location:eng_alert.php');
}
else
echo "Error Creating Alert";
?>
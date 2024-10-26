<?php
include('../config.php');

$logid=$_GET['logid'];
$regId=$_GET['regId'];
$pid=$_GET['pid'];
$desgid=$_GET['desgid'];
$message2="";
if($desgid=='3')
{
}
if($desgid=='4')
{
	$qry=mysql_query("Select * from alert_delegation where engineer='".$pid."'");
	if(mysql_num_rows($qry)>0)
	{
		$message2="You have '".mysql_num_rows($qry)."' New Alerts";
	}


}

 include_once './GCM.php';
 $gcm = new GCM();
    $registatoin_ids = array($regId);
    $message = array("alert" => $message2);

    $result = $gcm->send_notification($registatoin_ids, $message);

?>
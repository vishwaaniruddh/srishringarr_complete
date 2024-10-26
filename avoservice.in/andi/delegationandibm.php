<?php
include('../config.php');
$eng=$_GET['eng'];
$atm=$_GET['atmid'];
$alert=$_GET['alertid'];
$message2="";
$cdate = date('Y-m-d H:i:s');

$tab=mysql_query("update alert set status='Delegated',call_status='1' where alert_id='$alert'");
$tab2=mysql_query("Insert into alert_delegation(engineer,atm,alert_id,date) Values('".$eng."','".$atm."','".$alert."','".$cdate."')");
if($tab && $tab2)
{
	$message2="You have  New Alerts";
	
$reslt=mysql_query("Select loginid from area_engg where engg_id='".$eng."'");
$max=mysql_fetch_row($reslt);
$str=$max[0];
$str2=array();
//echo "Select gcm_regid from notification_tble where logid='".$str."' AND pid='".$eng."' AND status='0'";
$qry1=mysql_query("Select gcm_regid from notification_tble where logid='".$str."' AND pid='".$eng."' AND status='0'");
if(mysql_num_rows($qry1)>0)
{
	while($max1=mysql_fetch_row($qry1))
	{
		$str2[]=$max1[0];
	
	}



		include_once 'GCM.php';
		 $gcm = new GCM();
			//$registatoin_ids = $str2;
			$message = array("alert" => $message2);
		
			$result = $gcm->send_notification($str2, $message);
}

$responsestr=1;
	echo json_encode($responsestr);
}
else
{
	$responsestr=-1;
	echo json_encode($responsestr);
	//echo "Error Creating Delegation";
}
?>
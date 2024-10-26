<?php
include('../config.php');
$eng=$_GET['eng'];
$atm=$_GET['atmid'];
$alert=$_GET['alertid'];
$message2="";

$tab=mysqli_query($con1,"update alert set status='Delegated' where alert_id='$alert'");
$tab2=mysqli_query($con1,"Insert into alert_delegation(engineer,atm,alert_id) Values('".$eng."','".$atm."','".$alert."')");
if($tab && $tab2)
{
	$message2="You have  New Alerts";
	
$reslt=mysqli_query($con1,"Select loginid from area_engg where engg_id='".$eng."'");
$max=mysqli_fetch_row($reslt);
$str=$max[0];
$str2=array();

$qry1=mysqli_query($con1,"Select gcm_regid from notification_tble where logid='".$str."' AND pid='".$eng."' AND status='0'");
while($max1=mysqli_fetch_row($qry1))
{
	$str2[]=$max1[0];

}



include_once 'andi/GCM.php';
 $gcm = new GCM();
    //$registatoin_ids = $str2;
    $message = array("alert" => $message2);

    $result = $gcm->send_notification($str2, $message);
}
else
{
	$responsestr=-1;
	echo json_encode($responsestr);
	//echo "Error Creating Delegation";
}
?>
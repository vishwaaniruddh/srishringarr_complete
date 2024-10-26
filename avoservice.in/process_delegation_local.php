<?php
include("access.php");
session_start();
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

if(isset($_POST['delegate']))
{
 $req=$_POST['req'];
 $eng=$_POST['eng'];
 $atm=$_POST['atm'];
 $br=$_POST['br'];
 $cat=$_POST['cat'];
$message2="";


include('config.php');

if($atm!='' && isset($atm)){
	//echo "<br/>"."update local_site set cat='".$cat."' where track_id='".$atm."'";
	$cat_insert=mysqli_query($con1,"update local_site set cat='".$cat."' where track_id='".$atm."'");
}

$etdt="0000-00-00 00:00:00";
//echo strtotime(str_replace("/","-",$_POST['est']));
 //$_POST['time'] $_POST['meri']
 if(isset($_POST['est']) && $_POST['est']!='' && isset($_POST['time']) && $_POST['time']!=''){
 $tm=$_POST['time'].":".$_POST['min'].":00";
 if($_POST['meri']=='pm')
 $tm=(12+$_POST['time']).":".$_POST['min'].":00";
 //echo $tm;
 $etdt=date("Y-m-d $tm",strtotime(str_replace("/","-",$_POST['est'])));
 }
$cdate = date('Y-m-d H:i:s');
//echo "update alertlocal set status='Delegated',eta='".$etdt."' where alert_id='$req'<br/>";
$tab=mysqli_query($con1,"update alertlocal set status='Delegated',eta='".$etdt."' where alert_id='$req'");
//echo "Insert into alert_delegationlocal(engineer,atm,alert_id,date,delby) Values('".$eng."','".$atm."','".$req."','".$cdate."','".$_SESSION['user']."')";
$tab2=mysqli_query($con1,"Insert into alert_delegationlocal(engineer,atm,alert_id,date,delby) Values('".$eng."','".$atm."','".$req."','".$cdate."','".$_SESSION['user']."')");
}
/*$qry=mysqli_query($con1,"Select * from alert_delegation where engineer='".$eng."'");
	if(mysqli_num_rows($qry)>0)
	{
		$message2="You have '".mysqli_num_rows($qry)."' New Alerts";
		
	}*/
	/*
	if($tab2){
	$ep=mysqli_query($con1,"select email,startdt from esclatingpeople where state like '%".$_POST['brnch']."%' and level=0 and status=0");
	$epro=mysqli_fetch_row($ep);
	$st=", endtime=DATE_ADD('$epro[1]', INTERVAL 4 HOUR)";
	$esc=mysqli_query($con1,"update escalation set email='".$epro[0]."',level=1,type=1 $st where alertid='".$req."'");
	
	}
$message2="You have  New Alerts";
//echo "Select loginid from area_engg where engg_id='".$eng."'";	
$reslt=mysqli_query($con1,"Select loginid from area_engg where engg_id='".$eng."'");
$max=mysqli_fetch_row($reslt);
$str=$max[0];
$str2=array();
//echo "Select gcm_regid from notification_tble where logid='".$str."' AND pid='".$eng."' AND status='0'";
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
    	
//echo "result ".$result;

if($tab && $tab2)
{
?>
<script type="text/javascript">
<?php
if($_SESSION['designation']=='2')
{
?>
window.location='view_callalert.php';
<?php
}
else
{
?>
window.location='view_alert.php';
<?php
}
?>
</script>
<?php

	//header('Location:view_alert.php');
}
else
echo "Error Creating Delegation";
}*/
?>
<script type="text/javascript">
window.location='view_alertlocal.php';
</script>
<?php
session_start();
include("access.php");
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];


 //$req=$_POST['req']; //-alert_id of alert table
 $eng=946;
 


include('config.php');
$reslt=mysqli_query($con1,"Select loginid from area_engg where engg_id='".$eng."'");
//echo "Select loginid from area_engg where engg_id='".$eng."'";
$max=mysqli_fetch_row($reslt);
$str=$max[0];
$str2=array();
//echo "Select gcm_regid from notification_tble where logid='".$str."' AND pid='".$eng."' AND status='0'";
$qry1=mysqli_query($con1,"Select gcm_regid from notification_tble where logid='".$str."' AND pid='".$eng."' AND status='0'");
//echo "Select gcm_regid from notification_tble where logid='".$str."' AND pid='".$eng."' AND status='0'";
while($max1=mysqli_fetch_row($qry1))
{
	$str2[]=$max1[0];

}



include_once 'andi/send_notification.php';
$gcm_regid=$str2;

$_SESSION['regid']=$gcm_regid;

print_r($_SESSION['regid']);
exit();
header("location: http://avoservice.in/andi/send_notification.php");

?>
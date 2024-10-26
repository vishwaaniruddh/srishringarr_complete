<?php
session_start();
include("config.php");
$id=$_GET['id'];
$cdate = date('Y-m-d H:i:s');
$st="Call was unhold";
$br3=$_SESSION['branch'];
$user=$_SESSION['user'];

//echo "Update alert set call_status='Pending',status='Pending' where alert_id='".$id."'";

$qry=mysqli_query($con1,"Update alert set call_status='Pending' where alert_id='".$id."'");

if($qry){

$query=mysqli_query($con1,"Insert into alert_updates(`alert_id`,`up`,`update_time`,`branch`,`user`,`reason`) Values('".$id."','Call was unhold','".$cdate."','".$br3."','".$_SESSION['user']."', 'unhold')");

$query=mysqli_query($con1,"update alert_hold_unhold set unhold_time='".$cdate."' where alert_id='".$id."'");


}
if($qry)
header("location:view_alert.php");
else
echo "Some Error Occurred";
?>
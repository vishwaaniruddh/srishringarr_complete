<?php
session_start();
include("config.php");
$id=$_GET['id'];
$stat=$_GET['stat'];

$cdate = date('Y-m-d H:i:s');
$st="Call was unhold";
$br3=$_SESSION['branch'];
$user=$_SESSION['user'];

if($stat=='Delegated'){
$qry=mysqli_query($concs,"Update alert set call_status='1' where alert_id='".$id."'");
} else {
  $qry=mysqli_query($concs,"Update alert set call_status='Pending' where alert_id='".$id."'");  
}
if($qry){

$query=mysqli_query($concs,"Insert into alert_updates(`alert_id`,`up`,`update_time`,`branch`,`user`,`reason`) Values('".$id."','Call was unhold','".$cdate."','".$br3."','".$_SESSION['user']."', 'unhold')");

$query=mysqli_query($concs,"update alert_hold_unhold set unhold_time='".$cdate."' where alert_id='".$id."'");


}
if($qry)
echo "<script>window.close();</script>";
else
echo "Some Error Occurred";
?>
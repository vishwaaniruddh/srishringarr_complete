<?php
session_start();

include('access.php');
include("config.php");

$id=$_POST['id'];

$up=$_POST['up'];
$reason=$_POST['reason'];

$update=$reason." - ".$up;

$cdate = date('Y-m-d H:i:s');
$calltype=$_POST['callclose'];



//===hold===
if(isset($calltype) && $calltype=='hold')
{
	$status="call_status='onhold'";
	$reason="hold";

$query4=mysqli_query($concs,"Update alert set call_status='onhold' where alert_id='".$id."'");
    
$hold=mysqli_query($concs,"Insert into alert_hold_unhold(`alert_id`,`hold_time`,`hold_remarks`,`entry_by`) Values('".$id."','".$cdate."','".$update."','".$_SESSION['user']."')");
    
}
//===rejected===
if(isset($calltype) && $calltype=='Rejected')
{
	$status="call_status='Rejected'";
	$reason="Rejected";
	
$query4=mysqli_query($concs,"Update alert set call_status='Rejected', Reject_date = '".$cdate."'  where alert_id='".$id."'");	
}



$log=mysqli_query($concs,"select srno from login where username='".$_SESSION['user']."'");
$logro=mysqli_fetch_row($log);
 
 
 
 $query9=mysqli_query($concs,"Insert into alert_updates(`alert_id`,`up`,`update_time`,`user`,`reason`) Values('".$id."','".$update."','".$cdate."','".$_SESSION['user']."', '".$reason."')");	
 
 
$query10=mysqli_query($concs,"Insert into eng_feedback(`alert_id`,`feedback`,`feed_date`,`engineer`) Values('".$id."','".$update."','".$cdate."','".$logro[0]."')");




?>

<script type="text/javascript">
<?php
if($_SESSION['designation']=='2')
{
?>
alert("You have successfully Updated call");
window.location='view_alert.php';
<?php
}
else
{
?>
alert("You have successfully updated call");
window.close();
<?php
}
?>
</script>


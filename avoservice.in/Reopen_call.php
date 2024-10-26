<?php
session_start(); 

include("access.php");
include("config.php");

$user=$_SESSION['user'];
$alerts_id= $_GET['id'];
$cdate=date('Y-m-d H:i:s');

$loqry=mysqli_query($con1, "select * from login where username='".$user."'");
	 $logid=mysqli_fetch_row($loqry);

$qry= mysqli_query($con1,"update  alert set status='Pending' , call_status='Pending' where alert_id='".$alerts_id."'");


$qry2= mysqli_query($con1,"insert into eng_feedback set alert_id='".$alerts_id."' , engineer='".$logid[0]."', feedback='Call Re-opened', feed_date='".$cdate."', standby='', fromplace=''");

if($qry){
    echo "1";
}else{
    
    echo "0";
}


?>
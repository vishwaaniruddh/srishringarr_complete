<?php
include("config.php");
$id=$_GET['req'];
$qry=mysqli_query($con1,"select caller_email,createdby from alert where alert_id='$id'");
$row=mysqli_fetch_row($qry);
$to = $row[0];
			
			$subject = 'Task Completed';
			
			$headers = "From: " .AVOUPS. "\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			$message="Update Time : ".date("Y-m-d H:i:s")."<br><br>Update : Your Complain number ".$row[1]." has been successfully resolved.";
			
		mail($to, $subject, $message, $headers);
$qry=mysqli_query($con1,"Update alert set call_status='Done',close_date='".date("Y-m-d H:i:s")."' where alert_id='".$id."'");
if($qry)
header("location:view_alert.php");
else
echo "some error Occurred";
?>
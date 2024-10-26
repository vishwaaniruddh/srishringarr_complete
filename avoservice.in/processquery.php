<?php
session_start();
if(isset($_POST['cmdsub']))
{
//echo $_SESSION['branch'];
include("config.php");
$cnt=$_POST['cnt'];
$alertid=$_POST['alertid'];
$qr=mysqli_query($con1,"select * from alert where alert_id='".$alertid."'");
$qrro=mysqli_fetch_row($qr);
for($i=0;$i<$cnt;$i++)
{
if($_POST['txtquest']!='')
{
$st='';
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['txtquest'][$i]))
{
   $st=str_replace("'","\'",$_POST['txtquest'][$i]);
}
else
 $st=$_POST['txtquest'][$i];
//echo $st;
$qry=mysqli_query($con1,"Insert into queryans(`questtype`,`alertid`,`quest`,`ans`) Values('".$_POST['type']."','".$alertid."','".$_POST['questid'][$i]."','".$st."')");
}
}
$cmnt='';
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['cmnt']))
{
   $cmnt=str_replace("'","\'",$_POST['cmnt']);
}
else
 $cmnt=$_POST['cmnt'];
if($_POST['cmnt']!=''){
$log=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");
$logro=mysqli_fetch_row($log);
$ins=mysqli_query($con1,"Insert into alert_updates(`alert_id`,`up`,`update_time`,`branch`) Values('".$alertid."','".$cmnt."','".date('Y-m-d H:i:s')."','".$_SESSION['branch']."')");


$taba2=mysqli_query($con1,"Insert into eng_feedback(`alert_id`,`feedback`,`feed_date`,`engineer`,`standby`) Values('".$alertid."','".$cmnt."','".date('Y-m-d H:i:s')."','".$logro[0]."')");
}
if(isset($_POST['status']) && $_POST['status']=='accept')
{
$up=mysqli_query($con1,"Update alert set call_status='1' where alert_id='".$alertid."'");
if($up)
{
$to = $qrro[14];
			
			$subject = 'Updates for your Request';
			
			$headers = "From: " .AVOUPS. "\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			$message="Update Time : ".date("Y-m-d H:i:s")."<br><br>Update : ".$cmnt;
			
		mail($to, $subject, $message, $headers);
?>
<script type="text/javascript">
window.location='delegate.php?req=<?php echo $alertid; ?>&atm=<?php echo $qrro[2]; ?>&br=<?php echo $_SESSION['branch']; ?>&state=<?php echo $questate; ?>';
</script>
<?php
}
else
header("location:view_alert.php");
}
elseif(isset($_POST['status']) && $_POST['status']=='reject')
{
$up=mysqli_query($con1,"Update alert set call_status='Rejected',status='Rejected',responsetime='".date("Y-m-d H:i:s")."',close_date='".date("Y-m-d H:i:s")."' where alert_id='".$alertid."'");
if($up)
{

?>
<script type="text/javascript">
window.location='view_alert.php';
</script>
<?php
}
else
header("location:view_alert.php");
}
elseif(isset($_POST['status']) && $_POST['status']=='hold')
{
$up=mysqli_query($con1,"Update alert set call_status='onhold' where alert_id='".$alertid."'");
if($up)
{
$to= $qrro[14];;
			
			$subject = 'Updates for your Request';
			
			$headers = "From: " .AVOUPS. "\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			$message="Update Time : ".date("Y-m-d H:i:s")."<br><br>Update : ".$cmnt;
			
		mail($to, $subject, $message, $headers);
?>
<script type="text/javascript">
window.location='view_alert.php';
</script>
<?php
}
else
header("location:view_alert.php");
}
}
?>
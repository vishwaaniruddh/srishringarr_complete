<?php
$timezone="Asia/Calcutta";
date_default_timezone_set($timezone);
include('config.php');
$cdate = date('Y-m-d H:i:s');

$sql=mysqli_query($con1,"select * from alert where status<>'Done'");
while($row=mysqli_fetch_row($sql))
{
	
include('config.php');	
//echo "select * from alert_updates where alert_id='$row[0]' order by alert_id desc limit 1";
$sq=mysqli_query($con1,"select up from alert_updates where alert_id='$row[0]' order by id desc limit 1");
$ro=mysqli_fetch_row($sq);//echo $ro[0];	

$interval=	set_time(date('Y-m-d h:i',strtotime("$row[10]")),date('Y-m-d h:i'));



if($interval>=12)
{
//highest level escalation	
require_once('class_files/insert.php');

if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $ro[0]))
{
   $st=str_replace("'","\'",$ro[0]);
}
else $st=$ro[0];

$in_obj=new insert();
$tab=$in_obj->insert_into('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts','escalation',array("reason","esc_date","alert_id"),array($st,$cdate,$row[0]));
	mailing("support@sarmicrosystems.in",$st,$cdate);
	echo "toplevel Escalation function $interval<br>";
}
elseif($interval>=8 && $interval<=12)
{
	echo "Middle Escalation function $interval<br>";
}

//$sql=mysqli_query($con1,"select * from alert where alert_id='$row[0]' and ");

}
function set_time($t1,$t2){
date('h:i',strtotime("$t1 + 4 hours"));
$seconds=strtotime($t2)-strtotime($t1);
$hrs=$seconds/60/60;

return $hrs;
}

	

		
	function mailing($mail,$reason,$cdate)
	{	
	$to = $mail;
	
	$subject = 'Esc';
			
			$headers = "From: ". AVOUPS . "\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			$message="Reason : ".$reason."<br><br>Date/Time : " .$cdate;
			
		if (mail($to, $subject, $message, $headers)) {
			//header('Location:view_alert.php'); 
			}
			else {}
			//header('Location:view_alert.php');
	
	}
?>
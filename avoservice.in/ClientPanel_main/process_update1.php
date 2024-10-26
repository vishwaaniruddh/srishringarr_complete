<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry your session has Expired');window.location='../index.php';</script>";
}
else
{
include("config.php");
$id=$_POST['id'];
$br2=array();
$br=$_POST['br'];
$up=$_POST['up'];
$cdate = date('Y-m-d H:i:s');
$calltype=$_POST['callclose'];
$ctype=$_POST['ctype'];
$etadate=$_POST['etadt'];
$asstid=$_POST['astid'];
$asstname=$_POST['astname'];
$etdt="0000-00-00 00:00:00";

$log=mysql_query("select srno from login where username='".$_SESSION['user']."'");
$logro=mysql_fetch_row($log);
$br1=explode(',',$br);
for($i=0;$i<count($br1);$i++)
{
$br2[]=$br1[$i];
}
//print_r($br2);
$st='';
$br3=implode('/',$br2);

   $st=str_replace("'","\'",$up);
$qryal=mysql_query("Select call_status,responsetime,createdby,state,assetstatus,atm_id,cust_id,bank_name from alert where alert_id='".$id."'");
$resal=mysql_fetch_row($qryal);
if($resal[4]=='site')
$sitestr="select atm_id from atm where track_id='".$resal[5]."'";
if($resal[4]=='amc')
$sitestr="select atmid from Amc where amcid='".$resal[5]."'";

 $tabal=mysql_query("Insert into alert_updates(`alert_id`,`up`,`update_time`,`branch`,`user`) Values('".$id."','".$st."','".$cdate."','".$br3."','".$_SESSION['user']."')");	
$taba2=mysql_query("Insert into eng_feedback(`alert_id`,`feedback`,`feed_date`,`engineer`,`standby`) Values('".$id."','".$st."','".$cdate."','".$logro[0]."','".$stdb."')");	

	function extract_email_address($string) {
    foreach(preg_split('/\s/', $string) as $token) {
        $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        if ($email !== false) {
            $emails[] = $email;
        }
    }
    return $emails;
}	
	$sub=mysql_query("select subject from alert where alert_id='".$id."'");	
	$subro=mysql_fetch_row($sub);
	//$cc=mysql_query("select email from emailid where custid='".$resal[6]."' and bank='".$resal[7]."'");
	//$ccro=mysql_fetch_row($cc);
		$to = $_POST['email'];
			//$cc=$ccm=implode(",",extract_email_address($ccro[0]));
			$subject = $subro[0];
			
			$headers = "From:<HelpDesk@avoservice.in>\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			//$headers .= "Cc: ".$cc. "\r\n";
			$message="Update Time : ".$cdate."<br><br>Update for complaint no ".$resal[2].": ".$st;
			//echo $message;
		mail($to, $subject, $message, $headers);
	}
	
	if($_SESSION['designation']=='2')
          header('Location:success.html?success=You have successfully updated.');
         else
         header('Location:success.html?success=You have successfully updated.');


?>
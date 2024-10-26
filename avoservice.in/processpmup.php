<?php
session_start();

include('access.php');

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

$log=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");
$logro=mysqli_fetch_row($log);
//echo strtotime(str_replace("/","-",$_POST['est']));
 //$_POST['time'] $_POST['meri']
 if(isset($_POST['est']) && $_POST['est']!='' && isset($_POST['time']) && $_POST['time']!=''){
 $tm=$_POST['time'].":00:00";
 if($_POST['meri']=='pm')
 $tm=(12+$_POST['time']).":00:00";
 //echo $tm;
 $etdt=date("Y-m-d $tm",strtotime(str_replace("/","-",$_POST['est'])));
 }
$qryal=mysqli_query($con1,"Select call_status,responsetime,createdby,state,assetstatus,atm_id,cust_id,bank_name from pmalert where alert_id='".$id."'");
$resal=mysqli_fetch_row($qryal);
if($resal[4]=='site')
$sitestr="select atm_id from atm where track_id='".$resal[5]."'";
if($resal[4]=='amc')
$sitestr="select atmid from Amc where amcid='".$resal[5]."'";

$status="call_status='$resal[0]', eta='".$etdt."'";
//echo $status;

if(isset($calltype) && $calltype=='wait')
{
	$status="call_status='2',standby='Y'";
}
if(isset($calltype) && $calltype=='close')
{
$status="call_status='Done',close_date='".$cdate."'";
	$esc=mysqli_query($con1,"INSERT INTO `espmchis` (`id`, `alertid`, `startdt`, `endtime`, `escalateto`, `type`, `level`, `status`) select `id`, `alertid`, `startdt`, `endtime`, `escalateto`, `type`, `level`, `status` from escalation where alertid='".$id."')");
	if($esc)
	$del=mysqli_query($con1,"Delete from escalation where alertid='".$id."'");
}	


if(isset($_POST['rtime']) && $_POST['rtime']!='')
{	
     if($resal[1]=='0000-00-00 00:00:00')
	{
	//echo "Update alert set responsetime='".$_POST['rtime']."' where alert_id='".$id."'";
	$qryrtime=mysqli_query($con1,"Update pmalert set responsetime='".$_POST['rtime']."' where alert_id='".$id."'");
	}
}	
	
	//echo  "Update alert set $status where alert_id='".$id."'";
$upalert=mysqli_query($con1,"Update pmalert set $status where alert_id='".$id."'");	
	if(!$upalert)
	echo mysqli_error();
	//echo $ctype;

	
	

	

$br1=explode(',',$br);
for($i=0;$i<count($br1);$i++)
{
$br2[]=$br1[$i];
}
//print_r($br2);
$st='';
$br3=implode('/',$br2);

   $st=str_replace("'","\'",$up);

 
 if($calltype=='wait')
 $stdb='Y';
 else
 $stdb='';
	//echo "Insert into pmfeedback(`alert_id`,`feedback`,`feed_date`,`engineer`,`standby`) Values('".$id."','".$st."','".$cdate."','".$logro[0]."','".$stdb."')";
$taba2=mysqli_query($con1,"Insert into pmfeedback(`alert_id`,`feedback`,`feed_date`,`engineer`,`standby`) Values('".$id."','".$st."','".$cdate."','".$logro[0]."','".$stdb."')");	
if($_POST['email']!="")
	{
	function extract_email_address($string) {
    foreach(preg_split('/\s/', $string) as $token) {
        $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        if ($email !== false) {
            $emails[] = $email;
        }
    }
    return $emails;
}	
	$sub=mysqli_query($con1,"select subject from alert where alert_id='".$id."'");	
	$subro=mysqli_fetch_row($sub);
	$cc=mysqli_query($con1,"select email from emailid where custid='".$resal[6]."' and bank='".$resal[7]."'");
	$ccro=mysqli_fetch_row($cc);
		$to = $_POST['email'];
			$cc=$ccm=implode(",",extract_email_address($ccro[0]));
			$subject = $subro[0];
			
			$headers = "From:<HelpDesk@avoservice.in>\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$headers .= "Cc: ".$cc. "\r\n";
			$message="Update Time : ".$cdate."<br><br>Update for complaint no ".$resal[2].": ".$st;
			//echo $message;
		//mail($to, $subject, $message, $headers);
	}
	
	if($_SESSION['designation']=='2')
          header('Location:success.html?success=You have successfully updated.');
         else
         header('Location:success.html?success=You have successfully updated.');

//if($_SESSION['designation']=='2')
//header('Location:view_callalert.php');
//else
//header('Location:view_alert.php');



?>
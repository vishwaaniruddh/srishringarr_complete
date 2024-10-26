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
//echo "<br/>Select call_status,responsetime,createdby,state,assetstatus,atm_id,cust_id,bank_name from alertlocal where alert_id='".$id."'<br/>";
$qryal=mysqli_query($con1,"Select call_status,responsetime,createdby,state,assetstatus,atm_id,cust_id,bank_name from alertlocal where alert_id='".$id."'");
$resal=mysqli_fetch_row($qryal);
//echo "resal : ".$resal[4];
//if($resal[4]=='site')
$sitestr="select atm_id from local_site where track_id='".$resal[6]."'";
/*if($resal[4]=='amc')
$sitestr="select atmid from Amc where amcid='".$resal[5]."'";*/
//echo $resal[0];
$status="call_status='$resal[0]', eta='".$etdt."'";
//echo $status;

if(isset($calltype) && $calltype=='temp')
{
	$qrytmp=mysqli_query($con1,"Select * from tempclosedcalllocal where alert_id='".$id."' and status=0");
	if(mysqli_num_rows($qrytmp)>0)
	{
	}
	else
	{
		//echo "Insert into tempclosedcall(alert_id,date,branch) Values('".$id."','".$cdate."','".$resal[3]."')<br/>";
		$qrytmpin=mysqli_query($con1,"Insert into tempclosedcall(alert_id,date,branch) Values('".$id."','".$cdate."','".$resal[3]."')");
		$status="call_status='Done',close_date='".$cdate."'";
	}
}
if(isset($calltype) && $calltype=='wait')
{
	$status="call_status='2',standby='Y'";
}
if(isset($calltype) && $calltype=='close')
{
	
	//echo "Update tempclosedcalllocal set status='1' where alert_id='".$id."'<br/>";
	$updt=mysqli_query($con1,"Update tempclosedcalllocal set status='1' where alert_id='".$id."'");
	$status="call_status='Done',close_date='".$cdate."'";
	//$esc=mysqli_query($con1,"INSERT INTO `eschis` (`id`, `alertid`, `startdt`, `endtime`, `escalateto`, `type`, `level`, `status`) select `id`, `alertid`, `startdt`, `endtime`, `escalateto`, `type`, `level`, `status` from escalation where alertid='".$id."')");
	//if($esc)
	//$del=mysqli_query($con1,"Delete from escalation where alertid='".$id."'");
}	


if(isset($_POST['rtime']) && $_POST['rtime']!='')
{	
     if($resal[1]=='0000-00-00 00:00:00')
	{
	//echo "Update alertlocal set responsetime='".$_POST['rtime']."' where alert_id='".$id."'<br/>";
	$qryrtime=mysqli_query($con1,"Update alertlocal set responsetime='".$_POST['rtime']."' where alert_id='".$id."'");
	}
}	
	
	//echo  "Update alertlocal set $status where alert_id='".$id."'<br/>";
$upalert=mysqli_query($con1,"Update alertlocal set $status where alert_id='".$id."'");	
	if(!$upalert)
		echo mysqli_error();
	//echo $ctype;
if($ctype=='new')
{
//echo "Sitestr : ".$sitestr;
$site=mysqli_query($con1,$sitestr);
$sitero=mysqli_fetch_row($site);
//echo print_r($etadate);
	if(isset($etadate) && $etadate!='')
	{
//echo "<br>".count($etadate);
	 	for($i=0;$i<count($etadate);$i++)
               {
		     $adatet=str_replace('/','-',$etadate[$i]);
		     $mydate=date('Y-m-d',strtotime($adatet));
		     //echo "Select valid from alert_assets where alert_id='".$id."' and  assets like '%".$asstname[$i]."%'";
		     $qryvalid=mysqli_query($con1,"Select valid,pm from alert_assetslocal where alert_id='".$id."' and  assets like '%".$asstname[$i]."%'");
		     $resval=mysqli_fetch_row($qryvalid);
		     
		     $str=$resval[0];
		     $valres=str_replace(",","",$str);
		     
		     $expdt=date('Y-m-d', strtotime($mydate.' +'.$valres));
		     
		    //echo "Update installed_sitesmelocal set startdt='".$mydate."',expdt='".$expdt."',atm_id='".$resal[6]."' where alert_id='".$id."' and id=$asstid[$i]<br/>";
		     $queryupdt=mysqli_query($con1,"Update installed_sitesmelocal set startdt='".$mydate."',expdt='".$expdt."',atm_id='".$resal[6]."' where alert_id='".$id."' and id=$asstid[$i]");

// Service dates calculation and insertion
//echo "hi".$resval[1];
if($resval[1]!='' && $resval[1]!='0'){
$servdt=$mydate;
 $date1 = strtotime($mydate);
 $date2 = strtotime($expdt);
$months = 0;
//echo "<br><b>".strtotime('+'.$resval[1].' MONTH', $date1)." - ".$date2."</b><br>";
while (($date1 = strtotime('+'.$resval[1].' MONTH', $date1)) <= $date2)
    {
$months++;
//echo "<br>Hello";
}
//echo "<br>".$months;
for($j=1;$j<$months;$j++)
{
$actdt=$j*$resval[1];
$servdt=date('Y-m-d',strtotime("+$actdt months", strtotime($mydate)));
//echo "INSERT INTO `service_dateslocal` (`type`, `servicedt`, `atmautoid`, `custid`, `installedsiteid`,`atmid`,`actservicedt`) VALUES ('".$resal[4]."','".$servdt."','".$resal[6]."','".$resal[6]."','".$asstid[$i]."','".$sitero[0]."','".$servdt."')<br/>";
$ser=mysqli_query($con1,"INSERT INTO `service_dateslocal` (`type`, `servicedt`, `atmautoid`, `custid`, `installedsiteid`,`atmid`,`actservicedt`) VALUES ('".$resal[4]."','".$servdt."','".$resal[6]."','".$resal[6]."','".$asstid[$i]."','".$sitero[0]."','".$servdt."')");
}
                                     }
             }
	}
}	
	
	
$prob=array();
if(isset($_POST['prob']))
{
for($i=0;$i<count($_POST['prob']);$i++)
	{
		//echo "Select * from siteproblemlocal where alertid='".$id."' and probid='".$_POST['prob'][$i]."'";
		$qryprob=mysqli_query($con1,"Select * from siteproblemlocal where alertid='".$id."' and probid='".$_POST['prob'][$i]."'");
		if(mysqli_num_rows($qryprob)>0)
		{
		}
		else
		{
		//echo "Insert into siteproblemlocal(alertid,probid) Values('".$id."','".$_POST['prob'][$i]."')";
		$qryprob=mysqli_query($con1,"Insert into siteproblemlocal(alertid,probid) Values('".$id."','".$_POST['prob'][$i]."')");
		}
	}
}	
	

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
//echo "Insert into alert_updateslocal(`alert_id`,`up`,`update_time`,`branch`,`user`) Values('".$id."','".$st."','".$cdate."','".$br3."','".$_SESSION['user']."')<br/>";
 $tabal=mysqli_query($con1,"Insert into alert_updateslocal(`alert_id`,`up`,`update_time`,`branch`,`user`) Values('".$id."','".$st."','".$cdate."','".$br3."','".$_SESSION['user']."')");	
 //echo "Insert into eng_feedbacklocal(`alert_id`,`feedback`,`feed_date`,`engineer`,`standby`) Values('".$id."','".$st."','".$cdate."','".$logro[0]."','".$stdb."')<br/>";
$taba2=mysqli_query($con1,"Insert into eng_feedbacklocal(`alert_id`,`feedback`,`feed_date`,`engineer`,`standby`) Values('".$id."','".$st."','".$cdate."','".$logro[0]."','".$stdb."')");	
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
	//echo "select subject from alertlocal where alert_id='".$id."'";
	$sub=mysqli_query($con1,"select subject from alertlocal where alert_id='".$id."'");	
	$subro=mysqli_fetch_row($sub);
	//$cc=mysqli_query($con1,"select email from emailid where custid='".$resal[6]."' and bank='".$resal[7]."'");
	//$ccro=mysqli_fetch_row($cc);
		$to = $_POST['email'];
			//echo "CCRO : ".$ccro[0];
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
	
	/*if($_SESSION['designation']=='2')
          	//header('Location:success.html?success=You have successfully updated.');
         else
        	//header('Location:success.html?success=You have successfully updated.');
*/
/*if($_SESSION['designation']=='2')
	header('Location:view_callalert.php');
else
	header('Location:view_alertlocal.php');*/
?>
<script>
	window.close();
</script>
<?php
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

if(isset($calltype))
{
echo $calltype=$_POST['callclose'];
}

if(isset($calltype) && $calltype=='wait')
$stat=2;
else
$stat="Done";

$prob=array();
if(isset($_POST['prob']))
{
for($i=0;$i<count($_POST['prob']);$i++)
{
//echo "Insert into siteproblem(alertid,probid) Values('".$id."','".$_POST['prob'][$i]."')";
$qryprob=mysqli_query($con1,"Insert into siteproblem(alertid,probid) Values('".$id."','".$_POST['prob'][$i]."')");
}
}

//echo "select call_status,caller_email,createdby from alert where alert_id='".$id."'";
$qr=mysqli_query($con1,"select call_status,caller_email,createdby from alert where alert_id='".$id."'");
$qrro=mysqli_fetch_row($qr);
if($qrro[0]=='2')
{
//echo "update alert set call_status='$stat' where alert_id='".$id."'";
$tab1=mysqli_query($con1,"update alert set call_status='$stat' where alert_id='".$id."'");
}
else
{
//echo "update alert set call_status='$stat',close_date='".$cdate."' where alert_id='".$id."'";
$tab1=mysqli_query($con1,"update alert set call_status='$stat',close_date='".$cdate."' where alert_id='".$id."'");
}

if($tab1)
{
if($stat!='2')
{

$to = $qrro[1];
			
			$subject = 'Task Completed';
			
			$headers = "From: " .AVOUPS. "\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			$message="Update Time : ".date("Y-m-d H:i:s")."<br><br>Update : Your Complain number ".$qrro[2]." has been successfully resolved.";
			
		mail($to, $subject, $message, $headers);
}
	header('Location:view_alert.php');
}
else
echo "Error in Notifying Callers";

if($calltype=='temp')
{
//echo "Insert into tempclosedcall(alert_id,date) Values('".$id."','".$cdate."')";
$qrytmp=mysqli_query($con1,"Insert into tempclosedcall(alert_id,date) Values('".$id."','".$cdate."')");
}

if($ctype=='new')
{
if(isset($etadate) && $etadate!='')
{
for($i=0;$i<count($etadate);$i++)
{
$adatet=str_replace('/','-',$etadate[$i]);
     $mydate=date('Y-m-d',strtotime($adatet));
     //echo "Select valid from alert_assets where alert_id='".$id."' and  assets like '%".$asstname[$i]."%'";
     $qryvalid=mysqli_query($con1,"Select valid from alert_assets where alert_id='".$id."' and  assets like '%".$asstname[$i]."%'");
     $resval=mysqli_fetch_row($qryvalid);
     
     $str=$resval[0];
     $valres=str_replace(",","",$str);
     
     $expdt=date('Y-m-d', strtotime($mydate.' +'.$valres));
     
     //echo "Update installedsitesme set startdt='".$mydate."',expdt='".$expdt."' where alert_id='".$id."' and id=$asstid[$i]";
     $queryupdt=mysqli_query($con1,"Update installedsitesme set startdt='".$mydate."',expdt='".$expdt."' where alert_id='".$id."' and id=$asstid[$i]");
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
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $up))
{
   $st=str_replace("'","\'",$up);
}
else
 $st=$up;
//echo "Insert into alert_updates(`alert_id`,`up`,`update_time`,`branch`) Values('".$id."','".$st."','".$cdate."','".$br3."')";
 $tabal=mysqli_query($con1,"Insert into alert_updates(`alert_id`,`up`,`update_time`,`branch`) Values('".$id."','".$st."','".$cdate."','".$br3."')");

if(!$tabal)
echo "failed".mysqli_error();
if($tabal)
{

	if($_POST['email']!="")
	{
		
	$sub=mysqli_query($con1,"select subject from alert where alert_id='".$id."'");	
	$subro=mysqli_fetch_row($sub);
		$to = $_POST['email'];
			
			$subject = $subro[0];
			
			$headers = "From:<noreply@avoups.in>\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			$message="Update Time : ".$cdate."<br><br>Update : ".$st;
			//echo $message;
		mail($to, $subject, $message, $headers);
	}
	if($_POST['rtime']!='')
	{
	$qrr=mysqli_query($con1,"select responsetime from alert where alert_id='".$id."'");
	$rr=mysqli_fetch_row($qrr);
	if($rr[0]=='0000-00-00 00:00:00')
	{
	//echo "Update alert set responsetime='".$_POST['rtime']."' where alert_id='".$id."'";
	$qry=mysqli_query($con1,"Update alert set responsetime='".$_POST['rtime']."' where alert_id='".$id."'");
	if($qry)
			{
			if($_SESSION['designation']=='2')
header('Location:view_callalert.php');
else
header('Location:view_alert.php');
			 }
			 else
			 echo "Failed to set Response Time".mysqli_error();
	}
	else
	{
	if($_SESSION['designation']=='2')
header('Location:view_callalert.php');
else
header('Location:view_alert.php');
	}
	
			
	}
	
	
	if($_SESSION['designation']=='2')
header('Location:view_callalert.php');
else
header('Location:view_alert.php');


}





?>
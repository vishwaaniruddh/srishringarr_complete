<?php
include('access.php');
include("config.php");
$id=$_GET['id'];
$br2=array();
$br=$_GET['br'];
$up=$_GET['up'];
$cdate = date('Y-m-d H:i:s');
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
//echo "Insert into alert_updates(`alert_id`,`up`,`update_time`,`branch`) Values('".$id."','".$up."','".$cdate."','".$br3."')";
 $tab=mysqli_query($con1,"Insert into alert_updates(`alert_id`,`up`,`update_time`,`branch`) Values('".$id."','".$st."','".$cdate."','".$br3."')");
//require_once('class_files/insert.php');
//$in_obj=new insert();
//$tab=$in_obj->insert_into('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts','alert_updates',array("alert_id","up","update_time","branch"),array($id,$up,$cdate,$br3));
if(!$tab)
echo "failed".mysqli_error();
if($tab)
{
include("config.php");
	if($_GET['email']!="")
	{
		
	$sub=mysqli_query($con1,"select subject from alert where alert_id='".$id."'");	
	$subro=mysqli_fetch_row($sub);
		$to = $_GET['email'];
			
			$subject = $subro[0];
			
			$headers = "From:<noreply@avoups.in>\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			$message="Update Time : ".$cdate."<br><br>Update : ".$up;
			
		mail($to, $subject, $message, $headers);
	}
	if($_GET['rtime']!='')
	{
	$qrr=mysqli_query($con1,"select responsetime from alert where alert_id='".$id."'");
	$rr=mysqli_fetch_row($qrr);
	if($rr[0]=='0000-00-00 00:00:00')
	{
	//echo "Update alert set responsetime='".$_GET['rtime']."' where alert_id='".$id."'";
	$qry=mysqli_query($con1,"Update alert set responsetime='".$_GET['rtime']."' where alert_id='".$id."'");
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
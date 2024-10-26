<?php
session_start();

include('access.php');
include("config.php");

$id=$_POST['id'];
$eng_id=$_POST['eng_id'];
$qryeng=mysqli_query($concs,"Select loginid from area_engg where engg_id='".$eng_id."'");
$reng=mysqli_fetch_row($qryeng);
$logid=$reng[0];
$br2=array();
$br=$_POST['br'];
$up=mysqli_real_escape_string($concs,$_POST['up']);
$reviup=mysqli_real_escape_string($concs, $_POST['reviup']);
$cdate = date('Y-m-d H:i:s');
$calltype=$_POST['callclose'];
$ctype=$_POST['ctype'];
$etadate=$_POST['etadt'];
$asstid=$_POST['astid'];
$asstname=$_POST['astname'];
$etdt="0000-00-00 00:00:00";

if($_POST['reach_site'] || $_POST['left_site']){


//=======RESPONSE TIME FROM ENGG SET HERE=================
if(isset($_POST['rest']) && $_POST['rest']!='' && isset($_POST['eng_reach_time']) && $_POST['eng_reach_time']!='' && isset($_POST['rminute']) && $_POST['rminute']!=''){	
	$res_date=$_POST['rest']; //==Date
	$res_time=$_POST['eng_reach_time']; //==Hour
	$res_min=$_POST['rminute']; //==Min
	
	if($_POST['rmeri']=='pm' && $_POST['eng_reach_time'] !=12 ) //==Meridian
	$res_time=(12+$_POST['eng_reach_time']);
	
	$responseall=date("Y-m-d $res_time:$res_min",strtotime(str_replace('/','-',$res_date)));

//echo $responseall;	
//die;

	}
//=======================Eng Left Site HERE=======================
 if(isset($_POST['left_est']) && $_POST['left_est']!='' && isset($_POST['eng_left_time']) && $_POST['eng_left_time']!='' && isset($_POST['left_min']) && $_POST['left_min']!=''){
				
  $tm=$_POST['eng_left_time']; //==For Hour 
  //echo "date of e eta=" .$_POST['est']. "<br>";
 $minute=$_POST['left_min']; //==For Min
 
 if($_POST['left_meri']=='pm')
 $tm=(12+$_POST['eng_left_time']);
 //echo $tm;
 $left_eta=date("Y-m-d $tm:$minute",strtotime(str_replace("/","-",$_POST['left_est'])));
 
 }

 

 //===----------select data from alert table------------=======
$qryal=mysqli_query($concs,"Select call_status,responsetime,createdby,state1,assetstatus,atm_id,cust_id,bank_name,city,address,problem from alert where alert_id='".$id."'");
$resal=mysqli_fetch_row($qryal);
if($resal[4]=='site')
$sitestr="select atm_id from atm where track_id='".$resal[5]."'";
if($resal[4]=='amc')
$sitestr="select atmid from Amc where amcid='".$resal[5]."'";

$status="call_status='$resal[0]', eta='".$edit_eta."'";

if(isset($calltype) && $calltype=='pending')
	{
		$status="`pending_update`='1',`status_left_site`='0'";	
	}
$pendate = date('Y-m-d H:i:s');

//===close===
if(isset($calltype) && $calltype=='close')
{

	$status="call_status='Done',close_date='".$cdate."'";
}

$upalert=mysqli_query($concs,"Update alert set $status where alert_id='".$id."'");	

	if($_POST['reach_site']){

		$query5=mysqli_query($concs,"Update `alert` set `update_status`='1',`status_left_site`='1', responsetime='".$responseall."' where `alert_id`='".$id."'");	

$query1=mysqli_query($concs,"INSERT INTO `alert_progress`(`alert_id`, `responsetime`, `alert_type`, `engg_id`, `cust_id`, `pending_date`) VALUES ('".$id."','".$responseall."','".$ctype."', '".$logid."','".$resal[6]."','".$pendate."')");


		}
	if($_POST['left_site']){
	
$query5=mysqli_query($concs,"Update `alert` set `eng_left_site`='".$left_eta."' where `alert_id`='".$id."'");	


$quqry=mysqli_query($concs,"INSERT INTO `alert_progress`(`alert_id`,  `alert_type`, `eng_left_site`, `engg_id`, `cust_id`, `pending_date`) VALUES ('".$id."','".$ctype."','".$left_eta."','".$logid."','".$resal[6]."','".$pendate."')");
		}	

	
}//=====closing top if condition
	

$br3=$_SESSION['branch'];
$st=str_replace("'","\'",$up);

 //=======
$log=mysqli_query($concs,"select srno from login where username='".$_SESSION['user']."'");
$logro=mysqli_fetch_row($log);
	
 $query9=mysqli_query($concs,"Insert into alert_updates(`alert_id`,`up`,`update_time`,`branch`,`user`) Values('".$id."','".$st."','".$cdate."','".$br3."','".$_SESSION['user']."')");	

$query10=mysqli_query($concs,"Insert into eng_feedback(`alert_id`,`feedback`,`feed_date`,`engineer`,`standby`) Values('".$id."','".$st."','".$cdate."','".$logro[0]."','".$stdb."')");

	function extract_email_address($string) {
    foreach(preg_split('/\s/', $string) as $token) {
        $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        if ($email !== false) {
            $emails[] = $email;
        }
    }
    return $emails;
}
//===============Mail & WhatsApp=============
$alertqry=mysqli_query($concs,"select * from alert where alert_id='".$id."' ");
$alertr=mysqli_fetch_row($alertqry);

$custqry=mysqli_query($concs,"select cust_name from customer where cust_id='".$alertr[1]."' ");
$custname=mysqli_fetch_row($custqry);

if ($alertr[21]=='site') { $asstatus="Warranty";} 
elseif ($alertr[21]=='amc') { $asstatus="AMC";}
else $asstatus="PCB";

if ($alertr[17]=='new') { $calltp="New Installation";} 
elseif ($alertr[17]=='service' || $alertr[17]=='new temp') { $calltp="Service Call";} 
elseif ($alertr[17]=='pm' || $alertr[17]=='temp_pm') { $calltp="PM Call";} 
elseif ($alertr[17]=='dere' || $alertr[17]=='temp_dere') { $calltp="De-Re Installation";}    
    
if($alertr[21]=='site')
$sitestr="select atm_id from atm where track_id='".$alertr[2]."'";
if($alertr[21]=='amc')
$sitestr="select atmid from Amc where amcid='".$alertr[2]."'";
$rowatm=mysqli_query($concs,$sitestr);
$sitestrow1=mysqli_fetch_row($rowatm);
$atm_id=$sitestrow1[0];

if ($atm_id=='') {$atm_id= $alertr[2];}

$eng_nameqry=mysqli_query($concs,"select `engg_name`,`phone_no1` from `area_engg` where `engg_id`='".$eng."'");
$engg=mysqli_fetch_row($eng_nameqry);

//=========================mail===========
$tbl="<html>
<head>
<title>Switching AVO Electro Power Limited</title>
</head>
<body>
<p>New Updates for for Below Site: <font color='blue'>".$st."</font></p>
<table border='1' width='700px'>
<tr><th>COMPLAINT ID</th><th>ATM ID</th><th>BANK</th><th>State</th><th>City</th><th>Address</th><th>ISSUE</th><th>STATUS</th></tr>";
$tbl.="<tr>
        <td>".$alertr[25]."</td>
		<td>".$atm_id."</td>
		<td>".$alertr[3]."</td>
		<td>".$alertr[27]."</td>
		<td>".$alertr[6]."</td>
		<td>".$alertr[5]."</td>
		<td>".$alertr[9]."</td>

		<td><b>".$calltype."</b></td>
	</tr>";

    $cc=$ccm=implode(",",extract_email_address($alertr[32]));
	$to = $alertr[14];
	$subject = $alertr[29];
	//$to = $_POST['email'];

	$tbl.="</table><br><br><font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font> 
			<br><br><font color='blue'>Updated By:</font> <font color='red'>".$_SESSION['user']."</font> </body></html>";
	$headers = "From:<HelpDesk@avoservice.in>\r\n";
	//$headers .= "Reply-To: ".dfdf . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$cc. "\r\n";
	$message=$tbl;
	//$message="Update Time : ".$cdate."<br><br>Update for complaint no ".$resal[2].": ".$st;
	//echo $message;
	$mailqry=mail($to, $subject, $message, $headers);
	
	//=============== Whatapp Cust ===============
/* $cmobile=$alertr[13];
$gmobile=$alertr[45];
$whats_no=$cmobile.",".$gmobile;

        $MassageNew ="*Update from Switching AVO*";
        $Massage1="*ATM Id:* ".$atm_id;
        $Massage2="*Ticket No:* ".$alertr[25];
        $Massage3="*End User:* ".$alertr[3];
        $Massage4="*Address:* ".$alertr[5];
        $Massage5="*Type Of Call:* ".$calltp;
        $Massage6="*Problem Reported:* ".$alertr[9];
        $Massage7="*Current Feedback:* ".$st;
        $Massage8="*Time:* ".$cdate;

    $Message = $MassageNew."\n".$Massage1."\n".$Massage2."\n".$Massage3."\n".$Massage4."\n".$Massage5."\n".$Massage6."\n".$Massage7."\n".$Massage8;
   
// SendWhatmsg($mobile,$Message); */
?>	
<script type="text/javascript">
alert("Updated Successfully");
window.close();

</script>

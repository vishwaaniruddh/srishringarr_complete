<?php
session_start();
include("access.php");
include("Whatsapp_delegation/delegation_fun.php");

//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

function extract_email_address($string) {
    foreach(preg_split('/\s/', $string) as $token) {
        $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        if ($email !== false) {
            $emails[] = "<".$email.">";
        }
    }
    return $emails;
}

if(isset($_POST['delegate']))
{
 $req=$_POST['req']; //-alert_id of alert table
 $eng=$_POST['eng'];

 $atm=$_POST['atm'];
 $br=$_POST['br'];
 $message2="";


include('config.php');
$etdt="0000-00-00 00:00:00";

$cdate = date('Y-m-d H:i:s');

//echo "Select * from alert_delegation where alert_id='$req'";
$checkqry=mysqli_query($concs,"Select * from alert_delegation where alert_id='$req'");

if(mysqli_num_rows($checkqry)==0){

$tab2=mysqli_query($concs,"Insert into alert_delegation(engineer,atm,alert_id,date,delby) Values('".$eng."','".$atm."','".$req."','".$cdate."','".$_SESSION['user']."')");
} else {
    $olddel=mysqli_fetch_row($checkqry);
    $engold=$olddel[1];
   $created=$_SESSION['user'];
   
   echo "update alert_delegation set engineer='".$eng."', date='".$cdate."', status=0, delby='".$_SESSION['user']."' where alert_id='$req' ";
   $tab2=mysqli_query($concs,"update alert_delegation set engineer='".$eng."', date='".$cdate."', status=0, delby='".$_SESSION['user']."' where alert_id='$req' "); 

$redtab=mysqli_query($concs,"Insert into alert_redelegation(eng_old,eng_new,reason,atm,alert_id,createdby,created_at)Values('".$engold."','".$eng."','".$reason."','".$atm."','".$req."','".$created."','CURRENT_TIMESTAMP')");

    
    
}

if($tab2){
$tab=mysqli_query($concs,"update alert set status='Delegated',call_status='1',eta='".$etdt."', convert_into='".$dis."' where alert_id='$req'");
}
//==========Mailing / whatsapp===part Start =========================	
if($tab){
 
 $alertqry=mysqli_query($concs,"select * from alert where alert_id='".$req."' ");
$alertr=mysqli_fetch_row($alertqry);

$custqry=mysqli_query($concs,"select cust_name from customer where cust_id='".$alertr[1]."' ");
$custname=mysqli_fetch_row($custqry);

if ($alertr[21]=='site') { 
$atm1qry=mysqli_query($concs,"select atm_id, expdt from atm where track_id ='".$alertr[2]."' ");
$atmr=mysqli_fetch_row($atm1qry);
    $asstatus="Under Warranty. Expires on: ".$atmr[1];
    $atm_id=$atmr[0];
} 
elseif ($alertr[21]=='amc') {
$amcqry=mysqli_query($concs,"select atmid from Amc where amcid='".$alertr[2]."' ");
$amc=mysqli_fetch_row($amcqry);
$atm_id=$amc[0];
$atmqry=mysqli_query($concs,"select track_id from atm where atm_id ='".$atm_id."' ");

if(mysqli_num_rows($atmqry) > 0){
    $asset=mysqli_fetch_row($atmqry);

$batwarqry=mysqli_query($concs,"select * from site_assets where atmid='".$asset[0]."' and assets_name='Battery' order by site_ass_id DESC"); 
$bat=mysqli_fetch_row($batwarqry);
$bstatus=$bat[11];
$bexp=$bat[18];

if($bstatus==1) { $asstatus="UPS in AMC. Battery Under Warranty and Expires on: ".$bexp; }
else {$asstatus="UPS in AMC. Battery out of Warranty. Expired on: ".$bexp;}
} else {$asstatus="UPS in AMC. No any Battery supply";}

} else $asstatus="Chargeable or Temp Call"; 

if ($atm_id=='') {$atm_id= $alertr[2];}

if ($alertr[17]=='new') { $calltp="New Installation";} 
elseif ($alertr[17]=='service' || $alertr[17]=='new temp') { $calltp="Service Call";} 
elseif ($alertr[17]=='pm' || $alertr[17]=='temp_pm') { $calltp="PM Call";} 
elseif ($alertr[17]=='dere' || $alertr[17]=='temp_dere') { $calltp="De-Re Installation";}    
    
$eng_nameqry=mysqli_query($concs,"select `engg_name`,`phone_no1` from `area_engg` where `engg_id`='".$eng."'");
$engg=mysqli_fetch_row($eng_nameqry);
//============mail
$tbl="<html>
<head>
<title>Switching AVO Electro Power Limited</title>
</head>
<body>
<table border='1' width='700px'>
<tr>
	<th>COMPLAINT ID</th>
	<th>ATM ID</th>
	<th>BANK</th>
	<th>State</th>
	<th>City</th>
	
	<th>Address</th>
	<th>ISSUE</th>
	<th>Engineer Name</th>
	<th>Engineer No.</th>
	<th>ETA Time</th>
</tr>";
$tbl.="<tr>
		<td>".$alertr[25]."</td>
		<td>".$atm_id."</td>
		<td>".$alertr[3]."</td>
		<td>".$alertr[27]."</td>
		<td>".$alertr[6]."</td>
		
		<td>".$alertr[5]."</td>
		<td>".$alertr[9]."</td>
		<td>".$engg[0]."</td>
		<td>".$engg[1]."</td>
		<td>".$etdt."</td>
		
	</tr>";	

	$to = $alertr[14];
	$ccm=implode(",",extract_email_address($alertr[32]));
	$ccm=str_replace("<","",$ccm);
    $cc=str_replace(">","",$ccm);
	
	$subject = $alertr[29];
	$tbl.="</table><br><br><font color='blue'>Capital <font color='red'>Softs</font> </font> 
			<br><br><font color='blue'>Delegated By:</font> <font color='red'>".$_SESSION['user']."</font> </body></html>";
	$headers = "From:<HelpDesk@capital_softs.in>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$cc. "\r\n";
	$message=$tbl;
	$mailqry=mail($to, $subject, $message, $headers);
	
//=============== Whatapp Engineer ===============
/*  
 $mobile=$engg[1];

        $MassageNew = "*Switching AVO Electro Power Ltd*";
        $Massage1="[M] You have New Alert  !!";
        $Massage2="*Customer Name:* ".$custname[0] ;
        $Massage3="*ATM Id:* ".$atm_id;
        $Massage4="*Ticket No:* ".$alertr[25];
        $Massage5="*End User:* ".$alertr[3];
        $Massage6="*Address:* ".$alertr[5];
        $Massage7="*Type Of Call:* ".$calltp;
        $Massage8="*Problem Reported:* ".$alertr[9];
        $Massage9="*Asset Status:* ".$asstatus;

    $Message = $MassageNew."\n".$Massage1."\n".$Massage2."\n".$Massage3."\n".$Massage4."\n".$Massage5."\n".$Massage6."\n".$Massage7."\n".$Massage8."\n".$Massage9;
   
 SendWhatmsg($mobile,$Message);
//===============WhatsApp to Customer===============   

$cmobile=$alertr[13];
$gmobile=$alertr[45];
$whats_no=$cmobile.",".$gmobile;

$cmessage="*[D]Call was Delegated to:* ".$engg[0];
$cmmessage="*Mobile No:* ".$engg[1];
$allMessage = $MassageNew."\n".$cmessage."\n".$cmmessage."\n".$Massage3."\n".$Massage4."\n".$Massage5."\n".$Massage6."\n".$Massage7."\n".$Massage8;

SendWhatmsg($whats_no,$allMessage); */

}
//=================================Mailing part End================

if($tab2)
{
?>
<script type="text/javascript">
window.location='view_alert.php';
</script>
<?php
}
else
echo "Error Creating Delegation";
}
?>
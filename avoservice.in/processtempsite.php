<?php
include("access.php");
include("config.php");
include("Whatsapp_delegation/delegation_fun.php");
include_once 'andi/GCM.php';

$bank= mysqli_real_escape_string($con1,$_POST['bank']);
  $cust= mysqli_real_escape_string($con1,$_POST['cust']);
  $branch= $_POST['branch_avo'];
  $area= mysqli_real_escape_string($con1,$_POST['area']);
  $city= mysqli_real_escape_string($con1,$_POST['city']);
  $address= mysqli_real_escape_string($con1,$_POST['address']);
  $atmid= mysqli_real_escape_string($con1,$_POST['atmid']);
  $po= mysqli_real_escape_string($con1,$_POST['po']);
  $pincode= mysqli_real_escape_string($con1,$_POST['pincode']);
  $state= mysqli_real_escape_string($con1,$_POST['state']);
    $type= mysqli_real_escape_string($con1,$_POST['type']); // addon. pcb, dere
    $type_call= mysqli_real_escape_string($con1,$_POST['type_call']);//ser/ pm/dere
    $cname= mysqli_real_escape_string($con1,$_POST['cname']);
    
    $doc=$_POST['doc']; /// customer doc no...used for call cat
  
 $sub= mysqli_real_escape_string($con1,$_POST['sub']);
 $po= mysqli_real_escape_string($con1,$_POST['po']);
 $prob= mysqli_real_escape_string($con1,$_POST['prob']);
 
 $cphone= mysqli_real_escape_string($con1,$_POST['cphone']);
  $cemail=$_POST['cemail'];
  
  $reason=$_POST['how']; // Reason for log
  $approved=$_POST['appby'];
  
  $whatsno=$_POST['whatsno'];
 if($whatsno==''){$whatsno='NULL';}

function extract_email_address($string) {
    foreach(preg_split('/\s/', $string) as $token) {
        $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        if ($email !== false) {
            $emails[] = $email;
        }
    }
    return $emails;
}

$ccm=implode(",",extract_email_address($_POST['ccemail']));

//============Ticket No generate========
$qry2=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");
$qry2ro=mysqli_fetch_row($qry2);
	$qrr=mysqli_query($con1,"select * from alert where entry_date LIKE ('".date('Y-m-d')."%')");
	$num=mysqli_num_rows($qrr);
	$num2=$num+1;
	if($num2>0 && $num2<=9)
	$num3="0".$num2;
	else
	$num3=$num2;
	
	$alert_date=date('Y-m-d');

//======================FOR SERVICE DERE CALLS===============================
if(isset($_POST['cmdsubmit']) && $_POST['type_call']=='service' && $_POST['branch_avo']!=''){
    $ad = $_POST['adate'];
 
$alert=mysqli_query($con1,"Insert into alert(`cust_id`,`atm_id`,`bank_name`,`area`,`address`,`city`,`branch_id`,`pincode`,`problem`,`caller_name`,`caller_phone`,`caller_email`,`alert_date`,`call_status`,`alert_type`,`entry_date`,`po`,`state1`,`createdby`,`subject`,`custdoctno`,`appby`,`appref`,`ccmail`, whatsapp) Values('".$cust."','temp_".$atmid."','".$bank."','".$area."','".$address."' ,'".$city."','".$branch."','".$pincode."','".$prob."','".$cname."','".$cphone."','".$cemail."','".$alert_date."','Pending','new temp','".date('Y-m-d H:i:s')."','".$po."','".$_POST['state']."','".$qry2ro[0]."_".date("ymd").$num3."','".$sub."','".$type."','".$approved."','".$reason."','".$ccm."', '".$whatsno."')");

$id=mysqli_insert_id($con1);


$qry=mysqli_query($con1,"INSERT INTO `tempsites` (`id`, `custid`, `po`, `atmid`, `bankname`, `area`, `pincode`, `city`, `state`, `address`, `ref_id`,`type`,`state1`, trackerid) VALUES (NULL, '".$cust."', '".$po."', 'temp_".$atmid."', '".$bank."', '".$area."', '".$pincode."', '".$city."', '".$branch."', '".$address."', '0','".$type."', '".$state."' , '".$id."')");

$tempid=mysqli_insert_id($con1);
if(!$qry)

echo "failed".mysqli_error();


//======================FOR PM/ DERE CALLS===============================
}else if($_POST['type_call']=='pm' || $_POST['type_call']=='dere' || $_POST['type_call']=='w2pcb'){
 
 
    $alert=mysqli_query($con1,"Insert into alert(`cust_id`,`atm_id`,`bank_name`,`area`,`address`,`city`,`branch_id`,`pincode`,`problem`,`caller_name`,`caller_phone`,`caller_email`,`alert_date`,`call_status`,`alert_type`,`entry_date`,`po`,`state1`,`createdby`,`subject`,`custdoctno`,`appby`,`appref`,`ccmail`, whatsapp) Values('".$cust."','temp_".$atmid."','".$bank."','".$area."','".$address."' ,'".$city."','".$branch."','".$pincode."','".$prob."','".$cname."','".$cphone."','".$cemail."','".$alert_date."','Pending','temp_".$type_call."','".date('Y-m-d H:i:s')."','".$po."','".$_POST['state']."','".$qry2ro[0]."_".date("ymd").$num3."','".$sub."','".$type."','".$approved."','".$reason."','".$ccm."', '".$whatsno."')");
    
   
$id=mysqli_insert_id($con1);


$qry=mysqli_query($con1,"INSERT INTO `tempsites` (`id`, `custid`, `po`, `atmid`, `bankname`, `area`, `pincode`, `city`, `state`, `address`, `ref_id`,`type`,`state1`, trackerid) VALUES (NULL, '".$cust."', '".$po."', 'temp_".$atmid."', '".$bank."', '".$area."', '".$pincode."', '".$city."', '".$branch."', '".$address."', '0','".$type."', '".$state."' , '".$id."')");
	 

	}
	
 //===============Whatsapp Cust  

if($alert) {
 
$alertqry=mysqli_query($con1,"select * from alert where alert_id='".$id."' ");
$alertr=mysqli_fetch_row($alertqry);


if ($alertr[17]=='new') { $calltp="New Installation";} 
elseif ($alertr[17]=='service' || $alertr[17]=='new temp') { $calltp="Service Call";} 
elseif ($alertr[17]=='pm' || $alertr[17]=='temp_pm') { $calltp="PM Call";} 
elseif ($alertr[17]=='dere' || $alertr[17]=='temp_dere') { $calltp="De-Re Installation";}
         $MassageNew = "[T]*Switching AVO Electro Power Ltd*";
        $Massage3="*ATM Id:* ".$atmid;
        $Massage4="*Ticket No:* ".$alertr[25] ;
        $Massage5="*End User:* ".$alertr[3] ;
        $Massage6="*Address:* ".$alertr[5];
        $Massage7="*Type Of Call:* ".$calltp;
        $Massage8="*Problem Reported:* ".$alertr[9];
       
$cmobile=$alertr[13];
$gmobile=$alertr[45];
$whats_no=$cmobile.",".$gmobile;

$cmessage="*Call is Logged with Us !!*" ;
$cmmessage="*Engineer Will be deligated shortly* ";
$allMessage = $MassageNew."\n".$cmessage."\n".$cmmessage."\n".$Massage3."\n".$Massage4."\n".$Massage5."\n".$Massage6."\n".$Massage7."\n".$Massage8;

SendWhatmsg($whats_no,$allMessage);	

	//=======================mail
$tbl="<html>
<head>
<title>Switching AVO Electro Power Limited</title>
</head>
<body>
<p>New Call Logged from <font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font></p><table border='1' width='700px'><tr><th>COMPLAINT ID</th><th>ATM ID</th><th>BANK</th><th>State</th><th>City</th><th>Address</th><th>ISSUE</th><th>STATUS</th></tr>";

$tbl.="<tr><td>".$alertr[25]."</td><td>".$atmid."</td><td>".$alertr[3]."</td><td>".$alertr[27]."</td><td>".$alertr[6]."</td><td>".$alertr[5]."</td><td>".$alertr[9]."</td><td><b>Pending</b></td></tr>";



//print_r($cc);
$subject=$alertr[25]." <Switching AVO Electro Power Limited>";
//echo "<br>";
$tbl.="</table><br><br><font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font></body></html>";

$to = $alertr[14];
                    
	$headers = "From:<HelpDesk@avoservice.in>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$ccm. "\r\n";

		$message=$tbl; 
		$mailqry=mail($to, $subject, $message, $headers);

	
?>
<script type="text/javascript">
	alert("Alert created successfully. Complain ID is : <?php echo $qry2ro[0]."_".date("ymd").$num3; ?> ");
	window.location='newtempsite.php';
</script>
	
<?php 
}else{
	?>
	<script type="text/javascript">
	alert("Something wrong. Please try again");
	window.location='newtempsite.php';
	</script>
	
	<?php 
	}		
	
?>
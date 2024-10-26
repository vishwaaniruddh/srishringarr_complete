<?php
include("config.php");

$id=$_GET['id'];
$confirm=$_GET['confirm'];
$errcnt=0;

$sql=mysqli_query($con1,"SELECT * from `alert_mail` where `alert_id` ='".$id."'"); 

if(mysqli_num_rows($sql)>0) {
$row = mysqli_fetch_row($sql);

if($row[16]==2) {
    $errcnt++;
    $error .="Oops!! You already call Generated through this link"; }
elseif($row[16]=='0'){
  $errcnt++;
    $error .="Oops!! You already Rejected through this link";   
}
else if($row[16]==1 && $confirm==0){

$update=mysqli_query($con1,"UPDATE alert_mail set status=0 where alert_id='".$id."'");
 $errcnt++;
$error .="Sorry, We Can't Help Now. Initiate a new mail with correct details Once Again";

}
 
elseif($row[16]==1 && $confirm==1){

$tmb=date('Y-m-d 00:00:00', strtotime('-20 days'));
$ly=date('Y-m-d 00:00:00', strtotime('-1 year'));

$qry_his = "select alert_id, entry_date, call_status,status,alert_type,createdby from alert where atm_id='$row[3]' and entry_date > '".$ly."' order by alert_id DESC limit 5";


$sqlhis = mysqli_query($con1, $qry_his);
$rcnt = mysqli_num_rows($sqlhis);
$tmcnt = 0;
$stat=0;
while($rowe=mysqli_fetch_array($sqlhis))
{
if($rowe[1]>$tmb)$tmcnt++;

//echo "call_status".$rowe[2]."-status-".$rowe[3]."-created-".$rowe[5];

if($rowe[2]!='Done' && $rowe[2]!='Rejected' && $rowe[3]!='Done') {
$stat=1; }
}

if($stat==1){
    $errcnt++;
    $error.="Still Call is in Open";
   
} else if($rcnt >5){
    $errcnt++;
    $error.="repeated_failure of 5 times in a year. ";
   
} else if($tmcnt > 0){
   $errcnt++;
    $error.="call_closed within 30 days";
  
} 
}

} else {
    $errcnt++;
    $error.="No Data Found";
}

   ####======Start Logging=========
if($errcnt =='0') {

$dt=date("Y-m-d H:i:s");

$track_id=$row[3];
$cust_id= $row[1];
$br_id= $row[9];
$bank= $row[4];
$city= $row[7];
$area = $row[5];
$add = mysqli_real_escape_string($con1,$row[6]);
$state = $row[8];
$pin = $row[10];
$problem=$row[11];
$cont_name = $row[13];
$cont_no = $row[14];
$mail = $row[15];
$site = $row[17];
$sub = $row[18];
$ccmail= $row[19];
//=====
$po = "";
$approved = "System";
$app_ref ="System generated";
$dock_no= "Mail";
$whatsapp="";
$adate=date('Y-m-d');

//=for mail
$atm_id = $row[2];

$qrr=mysqli_query($con1,"select * from alert where entry_date LIKE ('".date('Y-m-d')."%')");
	$num=mysqli_num_rows($qrr);
	$num2=$num+1;
	if($num2>0 && $num2<=9)
	$num3="0".$num2;
	else
	$num3=$num2;
	
$createdby = "MAIL_".date("ymd").$num3;

$insertsql = "INSERT INTO `alert` (`alert_id`, `cust_id`,`atm_id`, `bank_name`, `area`, `address`, `city`, `branch_id`, `pincode`, `problem`, `entry_date`, `alert_date`, `caller_name`, `caller_phone`, `caller_email`, `status`, `call_status`, `alert_type`, `standby`, `po`, `assetstatus`, `appby`, `appref`,`state1`,`createdby`,`subject`,`custdoctno`,`ccmail`,`whatsapp`) VALUES (NULL, '".$cust_id."','".$track_id."' , '".$bank."', '".$area."', '".$add."', '".$city."', '".$br_id."', '".$pin."', '".$problem."', '".$dt."', '".$adate."', '".$cont_name."', '".$cont_no."', '".$mail."', 'Pending', 'Pending', 'service', '', '".$po."','".$site."', '".$approved."', '".$app_ref."','".$state."','".$createdby."','".$sub."','".$dock_no."','".$ccmail."' ,'".$whatsno."')";
//echo $insertsql;

$insert=mysqli_query($con1,$insertsql);

if($insert){
$error .= "Service Alert created successfully. Call Ticket is : ".$createdby;

$update=mysqli_query($con1,"UPDATE alert_mail set status=2 where alert_id='".$id."'");
} else { $error .= "Insert Error"; $errcnt++;}

}

	$to = $mail ;
	$cc = $ccmail.", service3@avoups.com";
  //  $cc = $ccmail;
	$subject = $sub;
$custqry = mysqli_query($con1, "Select cust_name from customer where cust_id ='".$cust_id."'");
$cust = mysqli_fetch_row($custqry);

$messagetitle = "<br>Hi, This is AVO auto Call_log Facility. Your Request has been processed.<br>";
$status = $error."<br><br>";
    
$tbl="<html>
<head>
<title>Switching AVO Electro Power Limited</title>
</head>
<body>
<table border='1' width='700px'>
<tr>
	<th>Site/Sol/ ATM Id </th>
	<th>Customer Vertical</th>
	<th>End User</th>
	<th>City</th>
	<th>Address</th>
	<th>State</th>
	
</tr>";
$tbl.="<tr>
		<td>".$atm_id."</td>
		<td>".$cust[0]."</td>
		<td>".$bank."</td>
		<td>".$city."</td>
		<td>".$add."</td>
		<td>".$state."</td>
	</tr>";	

	$tbl.="</table><br><br>
	</body></html>";
	
$message3 = "If the Call is Not Logged, Consult AVO.<br><br>Team AVO <br> <br><font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font>";
 
	$headers = "From:e_AVO HD<avoups@avoservice.in>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$cc. "\r\n";
	$message=$messagetitle.$status.$tbl.$message3;
//	echo $message;
	$mailqry=mail($to, $subject, $message, $headers);    






if($errcnt==0){
?>
<script type="text/javascript">
   alert("Service Alert created successfully. Call Ticket is <?php echo $createdby; ?>");
  window.close();
   </script>
<? } else {
       ?>
    <script type="text/javascript">
   alert("Error: <?php echo $error; ?> Consult AVO");
  window.close();
   </script>
<?  
} 



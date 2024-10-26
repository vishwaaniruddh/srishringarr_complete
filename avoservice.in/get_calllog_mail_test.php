<?php
error_reporting(-1);
include("config.php");

function extract_email_address($string) {
    foreach(preg_split('/\s/', $string) as $token) {
        $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        if ($email !== false) {
           $emails[] = "<".$email.">";
        }
    }
    return $emails;
}

/*$site_id = $_REQUEST['siteid']; // Site Id 
$problem = $_REQUEST['ProblemReported']; // Problem 
$cont_name = $_REQUEST['contactName']; // Contact Name
$cont_no = $_REQUEST['contactNo']; // Contact No

$mail = $_REQUEST['to']; // from mail
$tomail = $_REQUEST['mail_to'];
$ccmail = $_REQUEST['ccmail']; //mail_to
$sub=$_REQUEST['subject']; */

//var_dump($_REQUEST);


//============test
$site_id='PNB_034220';
// $site_id='AVOLCK232401587';//6NANAKAP01   
$problem = 'test by mail no id'; // Problem 
$cont_name = 'Boopathy'; // Contact Name
$cont_no = '9551086665'; // Contact No
$sub = "Test mail-12Call Open";
$mail = "boopathy@avoups.com";
// $mail = "work.rajeshb@gmail.com";

foreach($ccmail as $key=>$val){
            $ccmail2[] = $val;         
    }
$ccm=implode(",",$ccmail2);

foreach($mail as $key=>$val){
            $frommail[] = $val;         
    }
$mail1=implode(",",$frommail);

foreach($tomail as $key=>$val){
            $tomail2[] = $val;         
    }
$mail_to=implode(",",$tomail2);

$ccall=$mail_to.",".$ccm;

$errcnt=0;
$error = '';
if($site_id !=''){
$atmqry=mysqli_query($con1,"select track_id from atm where atm_id='".$site_id."' and active='Y'");
 if(mysqli_num_rows($atmqry) > 0) { 
 $siterow = mysqli_fetch_row($atmqry);
 $trackid=$siterow[0];
 $site_type="site";    
 } else {
 //echo "select amcid from Amc where atmid like '".$site_id."' and active='Y'"; 
 $amcqry=mysqli_query($con1,"select amcid from Amc where atmid like '".$site_id."' and active='Y'"); 
 if(mysqli_num_rows($amcqry) > 0) { 
  $siterow = mysqli_fetch_row($amcqry);
  $trackid=$siterow[0];
  $site_type="amc";
 }  else {  
 $str1 ="select po_id from so_order where inv_no like '%".$site_id."%' ";
 //echo $str1;
 $table=mysqli_query($con1,$str1); 
 if(mysqli_num_rows($table) > 0) {  
$row= mysqli_fetch_row($table);
$pono=mysqli_query($con1,"select atm_id, so_trackid from new_sales_order where so_trackid='".$row[0]."'");
$pon=mysqli_fetch_row($pono);
$nm=mysqli_query($con1,"select track_id from atm where atm_id='".$pon[0]."' and so_id='".$pon[1]."' and active='Y'");
if(mysqli_num_rows($nm)>0) {
$atmrow= mysqli_fetch_row($nm);
$trackid=$atmrow[0]; 
$site_type="site";
 } else {
   ###  Now check with expiry data..===========.
  $invnm=mysqli_query($con1,"select track_id from atm where atm_id='".$pon[0]."' and so_id='".$pon[1]."' and active='N'");
 if(mysqli_num_rows($invnm)>0) { 
    $error = "Given Invoice: <font color='red'><b>".$site_id."</b></font>  is Found But <font color='red'> Not in Warranty</font>";
 } 
 } 
 }else {
     $error = "Given Id / Invoice: <font color='red'><b>".$site_id."</b></font>  is <b>Not Found</b> in <font color='red'>AMC / Warranty</font>";
 }
 $amcexqry=mysqli_query($con1,"select amcid from Amc where atmid='".$site_id."' and active='N'"); 
 if(mysqli_num_rows($amcexqry) > 0) { 
   $error = "Given Id <font color='red'><b>".$site_id."</b></font>  is <font color='red'>Out of AMC</font>";
} else {
$atmexqry=mysqli_query($con1,"select atm_id from atm where atm_id='".$site_id."' and active='N'"); 
 if(mysqli_num_rows($atmexqry) > 0) { 
$error = "Given Id <font color='red'><b>".$site_id."</b></font>  is <font color='red'>Out of Warranty</font>";
} 
}

     
 }
}
 } 

echo "Trackid=".$trackid;

echo "<br> Error: ".$error;
die;

if($errcnt == 0){
if($trackid){

if($site_type=='site'){
$atmselqry=mysqli_query($con1,"select track_id,cust_id, branch_id, bank_name, city, area, pincode, address,po, state1,atm_id from atm where track_id='".$trackid."' ");
} 
else if($site_type=='amc') {
    $atmselqry=mysqli_query($con1,"select amcid, cid,branch,bankname,city,area,pincode,address,po,state,atmid from Amc where amcid='".$trackid."'"); 
  }	
$sitedata=mysqli_fetch_row($atmselqry);

$track_id=$sitedata[0];
$cust_id= $sitedata[1];
$br_id= $sitedata[2];
$bank= $sitedata[3];
$city= $sitedata[4];
$area = $sitedata[5];
$pin = $sitedata[6];
$add = mysqli_real_escape_string($con1,$sitedata[7]);
$state = $sitedata[9];
$po = $sitedata[8];

$atm_id = $sitedata[10];
$dt=date('Y-m-d H:i:s');

//=new table alert_mail========
	$sql = "INSERT INTO `alert_mail` (`alert_id`, `cust_id`,`atm_id`,`track_id`, `bank_name`, `area`, `address`, `city`, `branch_id`, `pincode`, `problem`, `entry_date`, `caller_name`, `caller_phone`, `caller_email`, `status`, `assetstatus`, `state`,`subject`,`ccmail`) VALUES (NULL, '".$cust_id."','".$atm_id."' ,'".$track_id."' , '".$bank."', '".$area."', '".$add."', '".$city."', '".$br_id."', '".$pin."', '".$problem."', '".$dt."', '".$cont_name."', '".$cont_no."', '".$mail1."', '1','".$site_type."','".$state."','".$sub."','".$ccall."')";

//echo $sql;

$insert=mysqli_query($con1,$sql);
$insertid=mysqli_insert_id($con1);

}
} else $error .= "Insert Error";
//========== mailing part if Success =========
$subject = $sub;


if($insert){
$to = $mail1;
$cc = "service3@avoups.com";
//echo $to."<br>";
$vustqry=mysqli_query($con1,"select cust_name from customer where cust_id ='".$cust_id."'");
$cust=mysqli_fetch_row($vustqry);

$messagetitle = "<br>Hi, This is AVO auto Call_log Facility. After click on the buttons, you are re-directed to our Portal and a POP-UP message will appear with Details.<br> For Any other Issues / assistance, Contact AVO Branches.<br><br>";
    
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
	
	<font color='blue'>Please confirm above details to proceed further to log the call.
			<br><br>
	</body></html>";
	
$message2 = "<table><tr><td><a input type='button' style='background-color: green; color: white;' href='http://avoservice.in/confirm_calllog.php?id=$insertid&confirm=1'>Yes & Confirm</a></td><td></td><td></td><td>
    <a input type='button' style='background-color: red; color: white;' href='http://avoservice.in/confirm_calllog.php?id=$insertid&confirm=0'>NO. Wrong Detail</a></td></tr></table><br><br><br>";

$message3 = "Team AVO <br> <br><font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font>";
 
	$headers = "From:e_AVO HD<avoups@avoservice.in>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$cc. "\r\n";
	$message=$messagetitle.$tbl.$message2.$message3;
//	echo $message;
	$mailqry=mail($to, $subject, $message, $headers);    

 } else { 
        
$cc = $ccall;
$to = $mail1;

$messagetitle = "<br>Hi, This is AVO auto Call_log Facility. We are unable to process your request at this time. Reason is:<br><br>";
  
  $status = "Error: <b>".$error."</b><br><br>";  

$reslt=" You Provided the details as below:<br>
<html>
<body>
<table border='1' width='700px'>
<tr> <td style='text-align: center;'><b>Details</b> </td>
<td style='text-align: center;'><b><font color='red'>Provided</font></b></td> </tr>";
$reslt.="<tr><td>Track_id</td> <td>".$site_id."</td> </tr>";
$reslt.="<tr><td>Problem Reported</td> <td>".$problem."</td> </tr>";
$reslt.="<tr><td>Contact Person</td> <td>".$cont_name."</td> </tr>";
$reslt.="<tr><td>Contact Number</td> <td>".$cont_no."</td> </tr>";
$reslt.="</table></body></html>";

$message3 = "<br><br>If the details are correct but have concerns on Warranty / AMC & need to log the Call,forward this mail to: <font color='blue'> service3@avoups.com </font>. <br> If, details are wrong, please initiate with new mail to: <font color='blue'> avoups@avoservice.in </font> <br>For Any other Issues / assistance, Contact AVO <br><br> Team AVO <br> <font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font>.";
   // echo $to;
 
	$headers = "From:e_AVO HD<avoups@avoservice.in>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$cc. "\r\n";
	$message=$messagetitle.$status.$reslt.$message3;
//	echo $message;
	$mailqry=mail($to, $subject, $message, $headers);    

}


mysqli_close($con1);   
?>

<?php
include("config.php");
$id=$_GET['id'];
$user=$_GET['user'];
//=====================================code for complaint number generation===========================================

          $selectuser=mysqli_query($con1,"select srno from login where username='".$user."'");
          
         $getid=mysqli_fetch_row($selectuser);
      
//echo "<br>select * from alert where entry_date LIKE ('".date('Y-m-d')."%')";
$qrr=mysqli_query($con1,"select * from alert where entry_date LIKE ('".date('Y-m-d')."%')");
$num=mysqli_num_rows($qrr);
$num2=$num+1;
if($num2>0 && $num2<=9)
$num3="0".$num2;
else
$num3=$num2;
$qry3=mysqli_query($con1,"update alert_customer set createdby='".$getid[0]."_".date("ymd").$num3."' where alert_id='".$id."'");






//=====================================end of this code================================================================



//===========================================query for inserting in alert table=====================================================================
if($qry3){
$insert="INSERT INTO `alert`(`cust_id`, `atm_id`, `bank_name`, `area`, `address`, `city`, `branch_id`, `pincode`, `problem`, `entry_date`, `alert_date`, `caller_name`, `caller_phone`, `caller_email`, `status`, `call_status`, `alert_type`, `close_date`, `standby`, `po`, `assetstatus`, `appby`, `appref`, `responsetime`, `createdby`, `transapp`, `state1`, `buyback`, `subject`, `custdoctno`, `eta`, `ccmail`, `eng_left_site`, `status_left_site`, `update_status`, `pending_update`) SELECT `cust_id`, `atm_id`, `bank_name`, `area`, `address`, `city`, `branch_id`, `pincode`, `problem`, `entry_date`, `alert_date`, `caller_name`, `caller_phone`, `caller_email`, `status`, `call_status`, `alert_type`, `close_date`, `standby`, `po`, `assetstatus`, `appby`, `appref`, `responsetime`, `createdby`, `transapp`, `state1`, `buyback`, `subject`, `custdoctno`, `eta`, `ccmail`, `eng_left_site`, `status_left_site`, `update_status`, `pending_update` FROM alert_customer WHERE alert_id='$id'";

$result=mysqli_query($con1,$insert);
}
//=========================================query for updating alert_customer table after approval=======================================
if($result){
$qry2=mysqli_query($con1,"update alert_customer set approval_status='1',approvedby='$user' where alert_id='".$id."'");
//============For atm id 
$select="SELECT * FROM alert_customer WHERE alert_id='$id'";
$getcust=mysqli_query($con1,$select);
$custid=mysqli_fetch_array($getcust);
if($custid[21]=='site' )
$sitestr="select atm_id from atm where track_id='".$custid[2]."'";
if($custid[21]=='amc')
$sitestr="select atmid from Amc where amcid='".$custid[2]."'";

$rowatm=mysqli_query($con1,$sitestr);
$sitestrow1=mysqli_fetch_row($rowatm);
//==================== select mail for branch manager
$brmgr=mysqli_query($con1,"select * from `avo_branchmgr_email` where `branch_id`='".$custid[7]."' and `status`='1'");
$allbremail=array();
while($brmgr1=mysqli_fetch_row($brmgr)){
$allbremail[]=$brmgr1[3];
}
$allbemails=implode(',',$allbremail);
//mail====================================
if($qry2){
$tbl="<html>
<head>
<title>Switching AVO Electro Power Limited</title>
</head>
<body>
<p>New Call Logged from <font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font></p><table border='1' width='700px'>
<tr>
<th>COMPLAINT ID</th>
<th>ATM ID</th>
<th>BANK</th>
<th>State</th>
<th>City</th>
<th>Address</th>
<th>ISSUE</th>
<th>STATUS</th>
</tr>";

$tbl.="<tr>
<td>".$custid[25]."</td>
<td>".$sitestrow1[0]."</td>
<td>".$custid[3]."</td>
<td>".$custid[27]."</td>
<td>".$custid[6]."</td>
<td>".$custid[5]."</td>
<td>".$custid[9]."</td>
<td><b>Pending</b></td>
</tr>";
		$to = $custid[14].",".$allbemails;	
		$subject=$custid[29];
		$tbl.="</table><br><br><font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font></body></html>";
        	$cc=$custid[32];
		$headers = "From: <HelpDesk@avoservice.in>\r\n";
		//$headers .= "Reply-To: ".dfdf . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$headers .= "Cc: ".$cc. "\r\n";
		$message=$tbl;
		/*if(isset($this->sendmail))
		{*/
		$maildone=mail($to, $subject, $message, $headers);
		//}
}
if($maildone)
echo "1";
else 
echo "2";
}

?>
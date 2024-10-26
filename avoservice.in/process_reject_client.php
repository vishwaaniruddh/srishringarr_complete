<?php session_start();
include("config.php");
$alert_id=$_POST['alertid'];
$reason=$_POST['reason'];
$convert=$_POST['convert'];
//echo $alert_id;
//echo "update `alert_customer` set `reject_reason`='".$reason."',`rejected`='1',`approvedby`='".$_SESSION['user']."'  where `alert_id`='".$alert_id."'";

$result=mysqli_query($con1,"update `alert_customer` set `reject_reason`='".$reason."',`rejected`='1',`approvedby`='".$_SESSION['user']."'  where `alert_id`='".$alert_id."'");
//==============
$select="SELECT * FROM alert_customer WHERE alert_id='".$alert_id."'";
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
$tbl="<html>
<head>
<title>Switching AVO Electro Power Limited</title>
</head>
<body>
<p>New Call Logged from <font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font></p><table border='1' width='700px'>
<tr>
<th>Reject Reason</th>
<th>ATM ID</th>
<th>BANK</th>
<th>State</th>
<th>City</th>
<th>Address</th>
<th>ISSUE</th>
<th>STATUS</th>
</tr>";

$tbl.="<tr>
<td>".$reason."</td>
<td>".$sitestrow1[0]."</td>
<td>".$custid[3]."</td>
<td>".$custid[27]."</td>
<td>".$custid[6]."</td>
<td>".$custid[5]."</td>
<td>".$custid[9]."</td>
<td><b>This site is Rejected</b></td>
</tr>";
		$to = $custid[14].",".$allbemails;	
		$subject=$custid[29];               
		$tbl.="</table><br><br><font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font></body></html>";
        	$cc=$custid[32] ;
		$headers = "From: <HelpDesk@avoservice.in>\r\n";
		//$headers .= "Reply-To: ".dfdf . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$headers .= "Cc: ".$cc. "\r\n";
		$message=$tbl;
		/*if(isset($this->sendmail))
		{*/
		$donemail=mail($to, $subject, $message, $headers);
		//}
if($donemail){ ?>
	<script type="text/javascript">
	alert("This site is Rejected successfully");
	//window.location='view_alert_cust.php';
	</script>
<?php 
}

?>
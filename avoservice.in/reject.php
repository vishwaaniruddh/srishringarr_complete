<?php
include("config.php");
$id=$_GET['id'];

$qry2=mysqli_query($con1,"update alert_customer set rejected='1' where alert_id='".$id."'");
$select="SELECT * FROM alert_customer WHERE alert_id='$id'";
$getcust=mysqli_query($con1,$select);
$custid=mysqli_fetch_array($getcust);
if($custid[21]=='site' )
$sitestr="select atm_id from atm where track_id='".$custid[2]."'";
if($custid[21]=='amc')
$sitestr="select atmid from Amc where amcid='".$custid[2]."'";

$rowatm=mysqli_query($con1,$sitestr);
$sitestrow1=mysqli_fetch_row($rowatm);
if($qry2)
echo "1";
else "2";


//mail====================================
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
<td><b>This site is Rejected</b></td>
</tr>";
		$to = 'kushal@sarmicrosystems.in';	
		$subject=$custid[29];
		$tbl.="</table><br><br><font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font></body></html>";
        $cc="jagoskp@gmail.com";
		$headers = "From: <kushalbedekar@gmail.com>\r\n";
		//$headers .= "Reply-To: ".dfdf . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$headers .= "Cc: ".$cc. "\r\n";
		$message=$tbl;
		/*if(isset($this->sendmail))
		{*/
		mail($to, $subject, $message, $headers);
		//}
?>
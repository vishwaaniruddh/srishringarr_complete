<? session_start();
include("config.php");
include("access.php");

/*function extract_email_address($string) {
    foreach(preg_split('/\s/', $string) as $token) {
        $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        if ($email !== false) {
            $emails[] = "<".$email.">";
        }
    }
    return $emails;
}
*/
$qry=mysqli_query($con1,"select * from alert where alert_id=1115053");
$alertr=mysqli_fetch_row($qry);

//echo "select * from alert where alert_id=1115053";
$close="Test Close";
$st="New Updates test";



$tbl="<html>
<head>
<title>Switching AVO Electro Power Limited</title>
</head>
<body>
<p>New Call Logged from <font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font></p><table border='1' width='700px'><tr><th>COMPLAINT ID</th><th>ATM ID</th><th>BANK</th><th>State</th><th>City</th><th>Address</th><th>ISSUE</th><th>STATUS</th></tr>";

$tbl.="<tr><td>".$alertr[25]."</td><td>".$atmid."</td><td>".$alertr[3]."</td><td>".$alertr[27]."</td><td>".$alertr[6]."</td><td>".$alertr[5]."</td><td>".$alertr[9]."</td><td><b>Pending</b></td></tr>";




//print_r($cc);
$subject=$alertr[29]." <Switching AVO Electro Power Limited>";
//echo "<br>";
$tbl.="</table><br><br><font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font></body></html>";

//$to = $alertr[14].", boopathy@avoups.com";

$to="boopathy@avoups.com";

	$headers = "From:<HelpDesk@avoservice.in>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$to."\r\n";
	

		$message=$tbl; 

		if(mail($to, $subject, $message, $headers)) {
		    echo '<p>Your message has been sent!</p>';
		}

	
?>
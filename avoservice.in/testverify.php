<?php
//header('Access-Control-Allow-Origin: http://swisskraft.in');

//$vcode=$_GET['vcode'];
$email=$_GET['mail'];
$subject="Bank Details of Swisskraft";
$headers = "From: <info@swisskraft.in>\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			//$headers .= "Cc: ".$this->ccm."\r\n";
			//echo $tbl."<br>";
			//echo $this->ccm;
			$message="<html>Bank Details of Swisskraft as below:<br>
                        Account Name  :SwissKraft.in <br>
                        Account Number :XXXXXXXXXX <br>
                        Branch  :Borivali<br>
                        IFSC Code  :XXXXXXXXXX</html>";
			

			$emailSend = mail($email, $subject, $message, $headers);

header('Location:http://swisskraft.in/');


?>

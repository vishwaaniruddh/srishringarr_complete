<?php
$vcode=$_GET['pwd'];
$email=$_GET['mail'];
$subject="Login Password SSA";
$headers = "From: <HelpDesk@smartscoreanalytics.com>\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			//$headers .= "Cc: ".$this->ccm."\r\n";
			//echo $tbl."<br>";
			//echo $this->ccm;
			$message="<html>Your password for SmartScoreAnalytics login is: <b>".$vcode."</b></html>";

			/*if(isset($this->sendmail))
			{*/
			mail($email, $subject, $message, $headers);

?>
<?php
$vcode=$_GET['vcode'];
$email=$_GET['mail'];
$subject="Verification Code SSA";
$headers = "From: <HelpDesk@smartscoreanalytics.com>\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			//$headers .= "Cc: ".$this->ccm."\r\n";
			//echo $tbl."<br>";
			//echo $this->ccm;
			$message="<html>Your Verification Code for SmartScoreAnalystics login is : <b>".$vcode."</b></html>";
			/*if(isset($this->sendmail))
			{*/
			mail($email, $subject, $message, $headers);

?>
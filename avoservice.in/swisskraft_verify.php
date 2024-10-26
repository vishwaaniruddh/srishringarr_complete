<?php
$vcode=$_GET['vcode'];
$email=$_GET['mail'];
$email1="hr@swisskraft.in";
$subject="Verification Code Swisskraft";
$headers = "From: <info@swisskraft.in>\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			//$headers .= "Cc: ".$this->ccm."\r\n";
			//echo $tbl."<br>";
			//echo $this->ccm;
			$message="<html>Verification Code of Swisskraft login is : <b>".$vcode."</b></html>";
			/*if(isset($this->sendmail))
			{*/
			mail($email, $subject, $message, $headers);
mail($email1, $subject, $message, $headers);

?>
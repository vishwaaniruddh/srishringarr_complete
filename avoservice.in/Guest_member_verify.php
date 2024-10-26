<?php
$code=$_GET['vcode'];
$email=$_GET['mail'];
$subject="Verification Code SSA";
$headers = "From: <HelpDesk@ipua.com>\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			//$headers .= "Cc: ".$this->ccm."\r\n";
			//echo $tbl."<br>";
			//echo $this->ccm;
			$message="Your verification code is ".$code;
			/*if(isset($this->sendmail))
			{*/
			mail($email, $subject, $message, $headers);

?>
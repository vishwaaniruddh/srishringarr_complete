<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once 'phpmail/src/PHPMailer.php';
require_once 'phpmail/src/Exception.php';
require_once 'phpmail/src/SMTP.php';
// require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
	$mail->SMTPDebug = 2;									
	$mail->isSMTP();											
	$mail->Host	 = 'smtp.gmail.com;';					
	$mail->SMTPAuth = true;							
	$mail->Username = 'work.rajeshb@gmail.com';				
	$mail->Password = 'rajesh@5672';						
	$mail->SMTPSecure = 'tls';							
	$mail->Port	 = 587;

	$mail->setFrom('work.rajeshb@gmail.com', 'Rajesh');		
	$mail->addAddress('hellbinderkumar@gmail.com');
// 	$mail->addAddress('receiver2@gfg.com', 'Name');
	
	$mail->isHTML(true);								
	$mail->Subject = 'Subject';
	$mail->Body = 'HTML message body in <b>bold</b> ';
	$mail->AltBody = 'Body in plain text for non-HTML mail clients';
	$mail->send();
	echo "Mail has been sent successfully!";
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>

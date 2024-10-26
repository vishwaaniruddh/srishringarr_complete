<?php

$Fristname=$_GET["Fristname"];
$Lastname=$_GET["Lastname"];
$Compnyname=$_GET["Compnyname"];
$Designation=$_GET["Designation"];
$email=$_GET["email"];
$PhoneNo=$_GET["PhoneNo"];
$msg=$_GET["msg"];


$subject="Contact US details";
$headers = "From: <HelpDesk@smartscoreanalytics.com>\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			//$headers .= "Cc: ".$this->ccm."\r\n";
			//echo $tbl."<br>";
			//echo $this->ccm;
			$message= '<html>
    <head>
      <title></title>
    </head>
    <body>
      <table>
  <tr><td>Fristname-</td><td>'.$Fristname.'</td></tr>
  <tr><td>Compnyname-</td><td>'.$Compnyname.'</td></tr>
  <tr><td>Designation-</td><td>'.$Designation.'</td></tr>
  <tr><td>email-</td><td>'.$email.'</td></tr>
  <tr><td>PhoneNo-</td><td>'.$PhoneNo.'</td></tr>
  <tr><td>msg-</td><td>'.$msg.'</td></tr>
 </table>
    </body>
    </html>';


			/*if(isset($this->sendmail))
			{*/
			mail($email, $subject, $message, $headers);
if(mail)
{
?>
<script>alert("success");</script>
<?php
}else
{
?>
<script>alert("error");</script>
<?php
}
?>
<script>window.open('http://www.sarmicrosystems.in/IPUA/CONTACT US.php','_self');</script>
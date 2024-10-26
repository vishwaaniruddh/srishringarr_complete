<?php 
include ('config.php');

$mob=$_POST['mob'];  
$email=$_POST['email']; 
$otp=$_POST['otp']; 





$qr     =mysqli_query($conn,"SELECT gtime FROM `otp` where mobile='".$mob."' and otpvalue='".$otp."' ");
$qrfetch=mysqli_fetch_array($qr);
$nrws=mysqli_num_rows($qr);
//echo $nrws;

  if($nrws >0){

 $mydate= $qrfetch['gtime'];
  $theDiff="";
  //echo $mydate;//2014-06-06 21:35:55
  $datetime1 = date_create($date);
  $datetime2 = date_create($mydate);
  $interval = date_diff($datetime1, $datetime2);
  //echo $interval->format('%s Seconds %i Minutes %h Hours %d days %m Months %y Year    Ago')."<br>";
  $min=$interval->format('%i');
  $sec=$interval->format('%s');
  $hour=$interval->format('%h');
  $mon=$interval->format('%m');
  $day=$interval->format('%d');
  $year=$interval->format('%y');

// if($interval->format('%h%d%m%y')=="0000"){
  // echo $min;
   
   
   if($min<10){
     
      $password=mt_rand(100000,999999);
      
      $qrHotelusers      =mysqli_query($conn,"SELECT * FROM `HotelUsers` where emailid='".$email."' ");
      $fetchHotelusers  =mysqli_fetch_array($qrHotelusers);
      
//===========for mail===============

$EmailSubject="Thank you for your Registration ";

$MESSAGE_BODY="";
    
   // $MESSAGE_BODY.="your username is: ".$email."\r\n";
      
      
    
    $MESSAGE_BODY.="your password is: ".$fetchHotelusers['password']."\r\n";
      
     $message="Dear ".$fetchHotelusers['empname']." You have been successfully registered please login with following link"."\r\n";
            $message.="http://sarmicrosystems.in/Lead_Management/hotel/default/login.php";
        $leadsmail="leads@loyaltician.com";
        $mailheader = "From: ".$leadsmail."\r\n"; 
    $mailheader .= "Reply-To: ".$leadsmail."\r\n"; 
 
//require 'phpmail/src/Exception.php';
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();

    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'sarmicrosystems.in';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'ram@sarmicrosystems.in';                 // SMTP username
    $mail->Password = 'ram1234*';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('leads@loyaltician.com','loyaltician');
    $mail->addAddress($email); 
    $mail->mailheader=$mailheader;// Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('ramshankargupta444@gmail.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(false);                                  // Set email format to HTML
    $mail->Subject = $EmailSubject."\r\n";
    $mail->Body    = $message."\r\n".$MESSAGE_BODY;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    //$mail->AltBody=$MESSAGE_BODY;
    $mail->send();
//==============mail end===
    mysqli_query($conn,"update HotelUsers set verified='Y' where emailid='".$email."' ");
    echo "1"; 
    
   }else
   {
    echo "0";
   }
   
 //}
 }else{
      echo "2";
 }



/*if($nrws >0){
   echo "1"; 
}else{
    echo "0";
}*/


?>
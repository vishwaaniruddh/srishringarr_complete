<?Php
session_start();
include ('config.php');
//ECHO 'TR';

$name=$_POST['name'];  // hotelname
$Lname=$_POST['lname'];  // empname
$enumber=$_POST['enumber'];  
$Department=$_POST['Department']; 
$email=$_POST['email'];  
//$password=$_POST['password'];

$password=mt_rand(100000,999999);
$otp=mt_rand(1000,9999);
$mob=$_POST['mob'];
$class1=$_POST['class1'];
$board=$_POST['board'];
$typ=$_POST['typ'];
//echo 
//echo $board;
$error=0;

mysqli_query($conn,'BEGIN');

$sqlr=mysqli_query($conn,"INSERT INTO `HotelUsers`( `hotelname`,`empname`, `empno`,`emailid`, `mobile`, `password`,Department) VALUES ('".$name."','".$Lname."','".$enumber."','".$email."','".$mob."','".$password."','".$Department."')");


//echo mysqli_error($conn);
$regid=mysqli_insert_id($conn);

if(!$sqlr)
{
    echo "duplicate value ";

    $error++;

}else{

// function to send otp
function sendotp($mobile,$otpval,$email)
{
    $curl = curl_init();
//http://control.msg91.com/api/sendotp.php?otp_length=4&authkey=265031A9Tcwgh5PSl5c76512f&sender=loyals&mobile=9323654529&otp=2353
curl_setopt_array($curl, array(
  CURLOPT_URL => "http://control.msg91.com/api/sendotp.php?otp_length=4&authkey=265031A9Tcwgh5PSl5c76512f&sender=loyals&mobile=".$mobile."&otp=".$otpval."&email=".$email,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  return "cURL Error #:" . $err;
} else {
  return $response;
}
} //end of otp function

$res=sendotp($mob,$otp,$email);
//echo $res;
$datetime=date("Y-m-d H:i:s");
$sqlr2=mysqli_query($conn,"INSERT INTO `otp`( `mobile`, `otpvalue`,`gtime`) VALUES ('".$mob."','".$otp."','".$datetime."')");
//INSERT INTO `Login`(`ID`, `EMAIL`, `PASSWORD`, `AGREE_STATUS`, `designation`) VALUES (
//$sqlr2=mysql_query("INSERT INTO `login`( id,`username`, `password`,designation,login_status) VALUES ('".$regid."','".$email."','".$password."','".$typ."','0')",$con);


//===========for mail===============
/*
$name=$_POST['name'];
$Lname=$_POST['lname'];
$email=$_POST['email'];
$password=$_POST['password'];
*/
/*$EmailSubject="Thank you for your Registration ";

$MESSAGE_BODY="";
    
   // $MESSAGE_BODY.="your username is: ".$email."\r\n";
      
      
    
    $MESSAGE_BODY.="your password is: ".$password."\r\n";
      
     $message="Dear ".$Lname." You have been successfully registered please login with following link"."\r\n";
            $message.="http://sarmicrosystems.in/Lead_Management/hotel";
        $leadsmail="leads@loyaltician.com";
        $mailheader = "From: ".$leadsmail."\r\n"; 
    $mailheader .= "Reply-To: ".$leadsmail."\r\n"; 
 
//require 'phpmail/src/Exception.php';
require '../phpmail/src/PHPMailer.php';
require '../phpmail/src/SMTP.php';

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
    $mail->setFrom('leads@loyaltician.com');
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
    $mail->send();*/
//==============mail end===
if(!$sqlr2)
{
//    echo "ok1";
echo mysqli_error($conn);
$error++;

}


if($error==0)
{
mysqli_query($conn,'COMMIT');
//echo 1;

header("Location: otp.php");
$_SESSION['$mob']= $mob;
$_SESSION['$email']= $email;
}
else
{

mysqli_query($conn,'ROLLBACK');
echo 2;
}}
?>
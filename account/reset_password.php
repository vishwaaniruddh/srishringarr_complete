<? include('site_header.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range(0, 9));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}
require __DIR__ . '/../phpmailer/src/Exception.php';
require __DIR__ . '/../phpmailer/src/PHPMailer.php';
require __DIR__ . '/../phpmailer/src/SMTP.php';



// Sender and recipient details
$senderEmail = 'info@srishringarr.com';
$senderName = 'Sri Shringarr Fashion Studio';
// $recipientEmail = 'vishwaaniruddh@gmail.com';


$email = $recipientEmail = $_POST['email'];

$email = $recipientEmail = $recipientEmail;

$sql=mysqli_query($con,"SELECT * FROM customer_login where email='".$email."' and site='SN'");
if($sql_result=mysqli_fetch_assoc($sql)){
   $otp = $string=random_string(8);
   $email = strip_tags($email);
   $userid=$sql_result['login_id'];
   
   $check_sql=mysqli_query($con,"select * from forget_password where userid='".$userid."' and site='SN'");
   $check_sql_result=mysqli_fetch_assoc($check_sql);
   
   if($check_sql_result){
     $sql_password="update forget_password set password='".$string ."' where userid='".$userid."' and site='SN' ";       
   }
   else{
     $sql_password="insert into forget_password(userid,email,password,site) values('".$userid."','".$email."','".$string."','SN')";
   }


   if(mysqli_query($con,$sql_password)){
    
            
$subject = 'Reset Password For SriShringarr Faishion Studio !';
$message = "
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
            }
            .container {
                background-color: #f4f4f4;
                padding: 20px;
                border-radius: 5px;
                text-align: center;
            }
            .otp {
                font-size: 24px;
                color: #007bff;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h2>OTP for Password Recovery</h2>
            <p>We have received a request to recover your password.</p>
            <p>Your OTP is: <span class='otp'>$otp</span></p>
            <p>This OTP is valid for a limited time.</p>
        </div>
    </body>
    </html>
";

// Initialize PHPMailer
$mail = new PHPMailer(true);

try {
    // Enable SMTP debugging
    // $mail->SMTPDebug = 1; // Set this to 2 for detailed debugging output

    // Server settings
    $mail->isSMTP();
    $mail->Host = 'mail.sarmicrosystems.in';
    $mail->SMTPAuth = true;
    $mail->Username = 'info@srishringarr.com';
    $mail->Password = 'SRIsri@@2023';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Recipients
    $mail->setFrom($senderEmail, $senderName);
    $mail->addAddress($recipientEmail);

    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;

    if($mail->send()){
    echo 'OTP sent to '. $email .' successfully.<br />';        
    
        
?>

    <div class="container">
        <form action="updatePassword.php" method="POST">
            
            <input type="hidden" name="email" class="form-control" value="<?= $email; ?>" />
            <input type="text" name="otp" class="form-control" placeholder="Enter OPT.. " />
            <input type="submit" name="submit" class="btn btn-primary" />
        </form>    
    </div>
    
    <?
        
    }
    
    
    
    
    
    
    
    
    
    
} catch (Exception $e) {
    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}


}
?>
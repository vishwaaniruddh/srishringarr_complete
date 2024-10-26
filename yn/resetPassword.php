<?php include('config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// Include PHPMailer classes
require __DIR__ . '/phpmailer/src/Exception.php';
require __DIR__ . '/phpmailer/src/PHPMailer.php';
require __DIR__ . '/phpmailer/src/SMTP.php';

// Sender and recipient details
$senderEmail = 'info@yosshitaneha.com';
$senderName = 'Yosshita Neha Fashion Studio';
// $recipientEmail = 'vishwaaniruddh@gmail.com';


$email = $recipientEmail = $_POST['email'];

$sql=mysqli_query($con,"SELECT * FROM customer_login where email='".$email."' and site='YN'");
if($sql_result=mysqli_fetch_assoc($sql)){
   $otp = $string=random_string(8);
   
   
   $email = strip_tags($email);

   $userid=$sql_result['login_id'];
   
   $check_sql=mysqli_query($con,"select * from forget_password where userid='".$userid."' and site='YN'");
   $check_sql_result=mysqli_fetch_assoc($check_sql);
   
   if($check_sql_result){
     $sql_password="update forget_password set password='".$string ."' where userid='".$userid."' and site='YN' ";       
   }
   else{
     $sql_password="insert into forget_password(userid,email,password,site) values('".$userid."','".$email."','".$string."','YN')";
   }


   if(mysqli_query($con,$sql_password)){
    
            
$subject = 'Reset Password For YosshitaNeha!';
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
    $mail->Username = 'info@yosshitaneha.com';
    $mail->Password = 'YNyn@@2023';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Recipients
    $mail->setFrom($senderEmail, $senderName);
    $mail->addAddress($recipientEmail);

    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->send();
    echo 'OTP sent to '. $email .' successfully.<br />';
    
    
    
    ?>
    
    <form action="updatePassword.php" method="POST">
        
        <input type="hidden" name="email" class="form-control" value="<?= $email; ?>" />
        <input type="text" name="otp" class="form-control" placeholder="Enter OPT.. " />
        <input type="submit" name="submit" class="btn btn-primary" />
    </form>
    
    
    <?
    
    
    
    
    
    
    
    
    
    
} catch (Exception $e) {
    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
        }
}
else{
    echo 'Oops ! No Account Found with this Email !';
}



?>

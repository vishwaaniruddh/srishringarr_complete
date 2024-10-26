<?php include_once('site_header.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require __DIR__ . '/../phpmailer/src/Exception.php';
require __DIR__ . '/../phpmailer/src/PHPMailer.php';
require __DIR__ . '/../phpmailer/src/SMTP.php';


// Sender and recipient details
$senderEmail = 'info@srishringarr.com';
$senderName = 'Sri Shringarr Fashion Studio';
$email = $recipientEmail = $_POST['emailid'];


$fname = $_POST['fname'];
$lname = $_POST['lname'];
// $email = $_POST['emailid'];
$mob = $_POST['mob'];
$gender = $_POST['radio'];
$pass = $_POST['passwd'];

$userid = $_SESSION['gid'];

function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range(0, 9));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }
    return $key;
}

$string = random_string(8);

if (
    isset($_SESSION['gid']) && $_SESSION['gid'] > 0 &&
    isset($fname) && isset($lname) && isset($email) && isset($mob) && isset($pass)
) {
    $check_sql = mysqli_query($con, "SELECT * FROM customer_login WHERE email='" . $email . "' and site='SN'");
    
    if ($check_sql_result = mysqli_fetch_assoc($check_sql)) {
        ?>
        <script>
            alert('Email ID Already Registered! Login To Continue');
            window.location.href = "account/my-account.php";
        </script>
        <?php
    } else {
        $check_sql = mysqli_query($con, "SELECT * FROM forget_password WHERE userid='" . $userid . "' AND email='" . $email . "' and site='SN'");

            $sql_password = "INSERT INTO forget_password (userid, email, password,site) VALUES ('" . $userid . "', '" . $email . "', '" . $string . "','SN')";

            if (mysqli_query($con, $sql_password)) {
                
                
                $subject = 'Srishringarr | Verify Account !';
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
                        <h2>OTP for Account Verification</h2>
                        <p>We have received a request to verify your Account.</p>
                        <p>Your OTP is: <span class='otp'>$string</span></p>
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
    $mail->Host = 'smtp.hostinger.com ';
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
        }
    }
    catch (Exception $e) {
    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
                
            }

    }
}

?>

<br><br>
<div class="container">
    <div class="container">
        <form action="verify.php" method="POST">
            <div class="row">
                <input type="hidden" name="fname" value="<?php echo $fname; ?>">
                <input type="hidden" name="lname" value="<?php echo $lname; ?>">
                <input type="hidden" name="emailid" value="<?php echo $email; ?>">
                <input type="hidden" name="mob" value="<?php echo $mob; ?>">
                <input type="hidden" name="radio" value="<?php echo $gender; ?>">
                <input type="hidden" name="passwd" value="<?php echo $pass; ?>">
                <input type="hidden" name="userid" value="<?php echo $userid; ?>">

                <div class="col-sm-12">
                    <label>Verify OTP <span style="color:red;"><? echo strtoupper('(Please check your spam and junk Mail)')?></span></label>
                    <input type="text" name="otp" class="form-control">
                </div>
                <div class="col-sm-12">
                    <br>
                    <input type="submit" name="submit" class="btn btn-danger">
                </div>
            </div>
        </form>
    </div>
</div>

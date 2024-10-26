<?php
// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

// Check if POST request contains email body and file content
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email_body']) && isset($_POST['file_name']) && isset($_POST['file_content'])) {
    // Decode email body
    $email_body = $_POST['email_body'];
    $file_name = $_POST['file_name'];
    $file_content = base64_decode($_POST['file_content']);

    // Save the file content to a temporary file
    $temp_file = tempnam(sys_get_temp_dir(), 'DVR_Report_');
    file_put_contents($temp_file, $file_content);

    // List of email recipients (comma-separated)
    // $to_emails = 'kvaljani@gmail.com,vishwaaniruddh@gmail.com';
    $to_emails = 'kvaljani@gmail.com, vishwaaniruddh@gmail.com, satyendra1111@gmail.com , prashant.12band@gmail.com, ntps9396@gmail.com';

    // Email settings
    $subject = 'Daily DVR Count Report';
    $from_email = 'your_email@example.com';
    $headers = "From: $from_email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"boundary-string\"\r\n";

    // Define email body with attachment
    $email_message = "--boundary-string\r\n";
    $email_message .= "Content-Type: text/html; charset=UTF-8\r\n";
    $email_message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $email_message .= $email_body . "\r\n";
    $email_message .= "--boundary-string\r\n";
    $email_message .= "Content-Type: application/octet-stream; name=\"{$file_name}\"\r\n";
    $email_message .= "Content-Transfer-Encoding: base64\r\n";
    $email_message .= "Content-Disposition: attachment; filename=\"{$file_name}\"\r\n\r\n";
    $email_message .= chunk_split(base64_encode($file_content)) . "\r\n";
    $email_message .= "--boundary-string--";

    // Send email to multiple recipients
    $recipients = explode(',', $to_emails);
    $mail_sent = true;
    foreach ($recipients as $to_email) {
        $to_email = trim($to_email);
        // Send email using mail() function
        if (!mail($to_email, $subject, $email_message, $headers)) {
            $mail_sent = false;
            echo "Failed to send email to $to_email<br>";
        }
    }

    // Check if all emails were sent successfully
    if ($mail_sent) {
        echo "Email sent successfully to all recipients";
    } else {
        echo "Failed to send email to one or more recipients";
    }

    // Delete the temporary file
    unlink($temp_file);

} else {
    echo "Invalid request.";
}
?>

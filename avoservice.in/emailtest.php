<?php
date_default_timezone_set("Asia/Calcutta"); // India time (GMT+5:30)
// error_reporting(E_ALL); // Enable error reporting for debugging
set_time_limit(0);

$username = 'avoups@avoservice.in';
$password = 'DeeBee@12345';
$emailServer = 'mail.avoservice.in';

// $nodes = 'http://clarify.advantagesb.com/generateAutoCallFromEmailReceived.php';

$inbox = imap_open("{{$emailServer}:993/imap/ssl}INBOX", $username, $password);

if ($inbox) {

    $unseenMessages = imap_search($inbox, 'UNSEEN');

    if ($unseenMessages) {

        foreach ($unseenMessages as $messageNumber) {
            // Fetch the email body
            $emailBody = imap_fetchbody($inbox, $messageNumber, 1);
            echo "<pre>";print_r($emailBody);echo "</pre>";
            
          

        }
    }
}

imap_close($inbox);

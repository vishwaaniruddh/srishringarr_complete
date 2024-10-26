<?php

// Gmail IMAP server settings
$imapServer = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'rajeshrungta719@gmail.com';
$password = 'prrtjohqqsiwuwix'; // Use App Password or regular password

// Connect to Gmail's IMAP server
$imap = imap_open($imapServer, $username, $password);

if ($imap) {
    $numMessages = imap_num_msg($imap);
    echo "Number of messages: $numMessages";
}

if (!$imap) {
    die('Could not connect: ' . imap_last_error());
}

// Search for all unseen (unread) emails
$emailIds = imap_search($imap, 'UNSEEN');

if ($emailIds === false) {
    die('No unread emails found');
}

// Loop through the email IDs and fetch email content
// foreach ($emailIds as $emailId) {
//     $emailHeader = imap_headerinfo($imap, $emailId);
//     $subject = $emailHeader->subject;
//     $from = $emailHeader->from[0]->mailbox . "@" . $emailHeader->from[0]->host;

//     $emailBody = imap_fetchbody($imap, $emailId, 1);

//     echo "Subject: $subject<br>";
//     echo "From: $from<br>";
//     echo "Body:<br>";
//     echo $emailBody;
//     echo "<hr>";

//     // You can perform further processing or save the email content as needed.
// }

// Close the IMAP connection
imap_close($imap);


?>
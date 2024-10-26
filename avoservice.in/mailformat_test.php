<?php
date_default_timezone_set("Asia/Calcutta"); // India time (GMT+5:30)
// error_reporting(E_ALL); // Enable error reporting for debugging
set_time_limit(0);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$username = 'avoups@avoservice.in';
$password = 'DeeBee@12345';
$emailServer = 'mail.avoservice.in';
$nodes = 'https://avoservice.in/mail_test/sendmailformt_test.php';

$getcall = 'https://avoservice.in/get_calllog_mail.php';
// $nodes = 'https://sarmicrosystems.in/SarMailor_APIS/sendmailformt.php';
$inbox = imap_open("{{$emailServer}:993/imap/ssl}INBOX", $username, $password);

if ($inbox) {

    $unseenMessages = imap_search($inbox, 'UNSEEN');

    if ($unseenMessages) {

        foreach ($unseenMessages as $messageNumber) {
            // Fetch the email body
            $emailBody = imap_fetchbody($inbox, $messageNumber, 1); // Assuming the body is in MIME type 1 (text/plain)
            
            //  echo "<pre>";print_r($emailBody);echo "</pre>"; 

            $siteID = extractValue($emailBody, 'Site ID');
            
           
        //   echo "<pre>"; print_r($siteID); echo "</pre>";
        
                $problemReported = extractValue($emailBody, 'Problem Reported');
                $contactPerson = extractValue($emailBody, 'Contact Person');
                $contactNo = extractValue($emailBody, 'Contact Number');
       
        $errcnt=0;
            
            if (isset($siteID) && empty($siteID)) {
                $error1 = "You must provide Either Site Id or Invoice Number";
            $errcnt++;
            } else { $error1 = "OK";}
            if($problemReported == ''){
               $error2 = "You must provide the Problem at the site"; 
               $errcnt++;
            } else { $error2 = "OK";}
            if($contactPerson == ''){
               $error3 = "You must provide the Contact Person Name"; 
               $errcnt++;
            } else { $error3 = "OK";}
            if($contactNo == ''){
               $error4 = "You must provide 10 Digit Contact Person Number";
               $errcnt++;
            } else { $error4 = "OK";}
            
 
                //echo "<pre>";print_r($emailBody);echo "</pre>";

                $header = imap_headerinfo($inbox, $messageNumber);
                $subject = $header->subject;
                
                $overview = imap_fetch_overview($inbox, $messageNumber);
                $emailHeaders = imap_fetchheader($inbox, $messageNumber);


                // Parse the headers into an associative array
                $headerInfo = imap_rfc822_parse_headers($emailHeaders);


                // Get the "To" recipients
                $toRecipients = isset($headerInfo->to) ? $headerInfo->to : [];
                $toEmails = getRecipientsEmails($toRecipients);
            
           
              
                
                $ccRecipients = isset($headerInfo->cc) ? $headerInfo->cc : [];
                $ccEmails = getRecipientsEmails($ccRecipients);


           /*     if (is_array($ccRecipients) || is_object($ccRecipients)) {
                    foreach ($ccRecipients as $ccValue) {
                        if (is_array($ccValue) || is_object($ccValue)) {
                            $ccEmails[] = $ccValue->mailbox . '@' . $ccValue->host;
                        }
                    }
                } */

 //  geth the From email======
 
                $sender = isset($headerInfo->from) ? $headerInfo->from : [];
               // $sender = $overview[0]->from;
                $senderEmail = getRecipientsEmails($sender);

                $toEmails[] = $toEmails; 
                $emailToRemove = "avoups@avoservice.in";
             
        
                foreach ($toEmails as $key => $email) {
                   if ($email === $emailToRemove) {
                       unset($toEmails[$key]); 
                    } 
                }
                
                $to = $senderEmail;
                $tomails = $toEmails;
                $ccmails = $ccEmails;
                
              //  echo "<pre>";print_r($subject);echo "</pre>"; 
              echo "<pre>";print_r($to);echo "</pre>";   
            //  echo "<pre>";print_r($tomails);echo "</pre>";  
            //  echo "<pre>";print_r($ccmails);echo "</pre>";  
//============================== Boopathy==========
   
$reslt="<html>
<body>
<table border='1' width='700px'>
<tr> <td style='text-align: center;'><b>Details</b> </td>
<td style='text-align: center;'><b><font color='red'>Required</font></b></td> </tr>";
$reslt.="<tr><td>Site ID / Invoice No</td> <td>".$error1."</td> </tr>";
$reslt.="<tr><td>Problem Reported</td> <td>".$error2."</td> </tr>";
$reslt.="<tr><td>Contact Person</td> <td>".$error3."</td> </tr>";
$reslt.="<tr><td>Contact Number</td> <td>".$error4."</td> </tr>";
$reslt.="</table></body></html>";
	 
	 $msgtitle = "<font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font><br><br> Hi, This is AVO auto Call_log Facility. Are you trying to log the Call?. IF Yes, Provide the details as per below format<br><br>";
            
        //  if($errcnt==0)  { 
        //      $data = array(
        //             'siteid' => $siteID,
        //             'ProblemReported' => $problemReported,
        //             'contactName' => $contactPerson,
        //             'contactNo' => $contactNo,
        //             'subject' => $subject,
        //             'to' => $to,
        //             'mail_to' => $tomails,
        //             'ccmail' => $ccmails,
        //           //  'message' => $emailBody,
        //         );
        
        // $alertarray = array(
        //             'http' => array(
        //                 'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        //                 'method' => 'POST',
        //                 'content' => http_build_query($data)
        //             )
        //         );

        //         $alertdata = stream_context_create($alertarray);
        //         $result1 = file_get_contents($getcall, false, $alertdata);      echo $result1;   
        
        //  } else {
             $reason = "<br>As per your mail we are able to read the details as above. Not sufficient to proceed to log the call.<br>";
             
             $repl= "<br><b> We request you to kindly send a separate mail which contains the required detail</b><br> <font color='red' size='5'> DO NOT REPLY TO THIS</font>";
             
             
             $data = array(
                 'subject' => $subject,
                //  'to' => $to,
                'to' => 'rajeshrungta719@gmail.com',
                 'mail_to' => $tomails,
                 'ccmail' => $ccmails,
                    'message1' => $msgtitle,
                    'table_result' => $reslt,
                    'message2' => $reason,
                    'message3' => $repl,
                    );
        //  }




// Use the url: get_calllog_mail.php//////
//============================================

var_dump($data);

                $options = array(
                    'http' => array(
                        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method' => 'POST',
                        'content' => http_build_query($data)
                    )
                );

                $context = stream_context_create($options);
                $result = file_get_contents($nodes, false, $context); 
                
                // $ch = curl_init($nodes);
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                
                // // execute!
                // $response = curl_exec($ch);
                
                // // close the connection, release resources used
                // curl_close($ch);
                
                // // // do anything you want with your response
                // var_dump($response);

            }
           // else{
             //   echo 'no siteid';
           // }


      //  }
    }
}

//var_dump($result);
imap_close($inbox);


// function extractValueFromMailBody($mailBody, $keyword) {
//     // Escape special characters in the keyword
//     $escapedKeyword = preg_quote($keyword, '/');
    
//     // Construct the pattern
//     $pattern = '/'.$escapedKeyword.':\s*([^\s]+)/';

//     preg_match($pattern, $mailBody, $matches);

//     // Check if a match is found
//     if (isset($matches[1])) {
//         return $matches[1];
//     } else {
//         echo 'No match found for '.$keyword;
//         return null; // Return null if no match is found
//     }
// }



// Function to extract a value based on a label from email body
function extractValue($emailBody, $label)
{
    if (preg_match("/$label\s+(.+)/i", $emailBody, $matches)) {
        return trim($matches[1]);
    } else {
        return '';
    }
}



function getSenderEmail($sender)
{
    $matches = array();
    preg_match('/([^<])<([^>])>/', $sender, $matches);
    return isset($matches[2]) ? trim($matches[2]) : '';
}

function getRecipientsEmails($recipients)
{
    $emails = array();
    if (is_array($recipients) || is_object($recipients)) {
        foreach ($recipients as $recipient) {
            if (is_array($recipient) || is_object($recipient)) {
                $emails[] = $recipient->mailbox . '@' . $recipient->host;
            }
        }
    }
    return $emails;
}

// Function to extract CC recipients from email headers
function getCCRecipientsFromHeaders($emailHeaders)
{
    preg_match('/^Cc:\s*(.*)$/mi', $emailHeaders, $matches);
    return isset($matches[1]) ? trim($matches[1]) : '';
}
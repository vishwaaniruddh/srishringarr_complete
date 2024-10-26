<?php

$nodes = 'sendmailapi.sarmicrosystems.in/yn_api.php';

// $Static_LeadID = 'work.rajeshb@gmail.com';
$subject = 'mail chck test';
$message = 'check mail now';
$leadsmail = "rajeshrungta19@gmail.com";
      

// $message = $message ;

    $from = 'contactus@theresortexperiences.com';
    $to  = 'work.rajeshb@gmail.com';
    $cc = ['rajeshrungta19@gmail.com'];
    $bcc = ['pratimabiswas657@gmail.com'];


        $data = array(
        'subject' => $subject,
        'message' => $message,
        'to'=>$to,
        'cc'=>$cc,
        'bcc'=>$bcc,
        );
    
//     $options = array(
//         'http' => array(
//             'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
//             'method'  => 'POST',
//             'content' => http_build_query($data)
//         )
//     );
    
//     $context  = stream_context_create($options);
//     $result =  file_get_contents($nodes, false, $context);

// var_dump($result);



$ch = curl_init($nodes);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// execute!
$response = curl_exec($ch);

// close the connection, release resources used
curl_close($ch);

// do anything you want with your response
var_dump($response);

// if($response)
// {
//     echo "<script>
//         alert('Mail Sent Successfully!!');
//         // window.location.href = 'contact_us.php';
    
//     </script>";
// }


return;
?>
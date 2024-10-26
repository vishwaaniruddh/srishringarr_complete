<?php

$personname = $_POST['name'];
$personcontact = $_POST['phone'];
$personemail = $_POST['email'];
$personmsg = $_POST['body'];

$nodes = 'sendmailapi.sarmicrosystems.in/yn_api.php';
$EmailSubject2="Welcome to YosshitaNeha Fashion Studio!";
$subject = $EmailSubject2 ; 
      
        $message2.='<table width="70%" align="center">';
          $message2.='<tr>';
        //   $message2.='<th><img src="http://loyaltician.in/application/gold_logo.png" alt="gold_logo.png" />  </th></tr><tr>';
           
        $message2.='<th><img src="https://yosshitaneha.com/assets/logo.jpg" alt="YosshitaNeha.com" />    </th>';
        $message2.='</tr><tr></br>';
        $message2.='<th style="text-align: left;"><b >Dear Yosshita Neha  ,</b></th></tr><tr></br>';
         $message2.='<td>The Contact Us details of the Interested Person. <br><br>
        <b> Name : </b>'.$personname.'<br>
        <b> Contact No : </b>'.$personcontact.' <br>
        <b> Email : </b>'.$personemail.' <br>
        <b> Message : </b>'.$personmsg.' <br><br>
         </td>';
       
        $message2.='</tr></table>';

$message = $message2 ;

// $from = 'rajeshbiswas@sarmicrosystems.in';
$from = 'enquiry@yosshitaneha.com';
$to = 'yosshita.neha@gmail.com';
// $to  = 'work.rajeshb@gmail.com';

        $data = array(
        'subject' => $subject,
        'from' => $from,    
        'to' => $to,
        'message' => $message,
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
// var_dump($response);

if($response)
{
    echo "<script>
        alert('Mail Sent Successfully!!');
        window.location.href = 'contact_us.php';
    
    </script>";
}


return;
?>
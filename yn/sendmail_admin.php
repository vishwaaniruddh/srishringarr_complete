<?php
$personname = $_POST['name'];
$personcontact = $_POST['phone'];
$personemail = $_POST['email'];
$personmsg = $_POST['body'];



$host = 'mail.sarmicrosystems.in';
$hostusername = 'rajeshbiswas@sarmicrosystems.in';
$hostpassword = 'rajesh.biswas@12345';
$port = '587';

$nodes = 'https://sarmicrosystems.in/phpmailerfiles/yn/contact_us.php';

$subject = "Email testing ";

$message2 ='<table width="50%" align="center"><td><img style="width:100%;" id="Picture 4" src="http://yosshitaneha.com/assets/logonew.png"></td></table>
                <table width="50%" align="center" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                  <tr style="height:14.5pt">
                    
                      <td width=529 valign=top style="width:247.0pt;border-top:none;border-left:
                      none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                      padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
                      <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
                      lang=EN-IN style="font-size:10.5pt;
                      border:none windowtext 1.0pt;padding:0in;background:white"><b>Contacted Person Name :</b> <br>'.$personname.'</span></p>
                      </td>
                    </tr>
                    <tr style="height:14.5pt">
                      <td width=329 valign=top style="width:247.0pt;border-top:none;border-left:
                      none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                      padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
                      <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
                      lang=EN-IN style="font-size:10.5pt;
                      border:none windowtext 1.0pt;padding:0in;background:white"><b>Contacted Person Email :</b><br> '.$personemail.'</span></p>
                      </td>
                    </tr>
                    <tr style="height:14.5pt">  
                      <td width=329 valign=top style="width:247.0pt;border-top:none;border-left:
                      none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                      padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
                      <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
                      lang=EN-IN style="font-size:10.5pt;
                      border:none windowtext 1.0pt;padding:0in;background:white"><b>PhoneNo :</b><br> '.$personcontact.' </span></p>
                      </td>
                    </tr>
                    <tr>  
                      <td width=729 valign=top style="width:247.0pt;border-top:none;border-left:
                      none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                      padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
                      <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
                      lang=EN-IN style="font-size:10.5pt;
                      border:none windowtext 1.0pt;padding:0in;background:white"><b>Message :</b><br> '.$personmsg.' </span></p>
                      </td>
                    </tr>
                 </tr>
                </tbody>
                </table>';
          
$from = $personemail;
$fromname = $personname;
// $to = 'vishwaaniruddh@gmail.com';
$to = 'work.rajeshb@gmail.com';
// $cc = 'work.rajeshb@gmail.com';



$post = [
    'username' => $hostusername,
    'password' => $hostpassword,
    'subject' => $subject,
    'message' => $message2,
    'from'=>$from,
    'fromname'=>$fromname,
    'to'=>$to,
    'cc'=>$cc,
];

$ch = curl_init($nodes);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

// execute!
$response = curl_exec($ch);

// close the connection, release resources used
curl_close($ch);

// do anything you want with your response
var_dump($response);



return ; 


// $subject = "Email testing ";

//         $message2 ='<table width="50%" align="center"><td><img style="width:100%;" id="Picture 4" src="http://yosshitaneha.com/assets/logonew.png"></td></table>
//                 <table width="50%" align="center" border="0" cellspacing="0" cellpadding="0">
//                 <tbody>
//                   <tr>
//                     <td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
//                       <p>
//                         <span style="text-decoration:none">
//                           <img border="0" width="130" style="width:1.3541in" src="http://loyaltician.in/resortmumbai/newassets/image002.png" alt="The Resort Mumbai Classic"></span>
//                         <u></u><u></u></p>
//                     </td>
//                     <td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
//                         <p align="right" style="text-align:right">
//                           <span style="text-decoration:none"><img border="0" width="130" style="width:1.3541in" src="http://loyaltician.in/resortmumbai/newassets/image003.png" alt="The Resort Mumbai Classic">
//                           </span>
//                       <u></u><u></u></p>
//                     </td>
//                   </tr>
//                 </tbody>
//                 </table>';
        
        
          
//         $from = $personemail;
//         $fromname = $personname;
//         $to = ['hellbinderkumar@gmail.com'];
//         $cc = ['work.rajeshb@gmail.com'];
         
//         $data = array(
//             'subject' => $subject,
//             'message' => $message2,
//             'from'=>$from,
//             'fromname'=>$fromname,
//             'to'=>$to,
//             'cc'=>$cc,
//         );
         
//         $options = array(
//         'http' => array(
//             'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
//             'method'  => 'POST',
//             'content' => http_build_query($data)
//         )
//     );
    
//     $context  = stream_context_create($options);
//     $result =  file_get_contents($nodes, false, $context); 
         
//     var_dump($result);
    
    
    
    
    
    
//     return ; 
    
    // echo "<br>";
    // var_dump($result);
         
         
         
         
         

// $name ="Rajesh";
// // $from ="work.rajeshb@gmail.com";
// $from ="rajeshbiswas@sarmicrosystems.in";
// $message ="Test";
// $contact ="9786767577";


// //echo json_encode($_POST);
// //$to = "prabir.d06@gmail.com";
// // $to = "contact@allmart.world";
// //  $to = "rajeshbiswas@sarmicrosystems.in";
//   $to = "work.rajeshb@gmail.com";
// //$to = "yosshita.neha@gmail.com";


// if ($from!='') {

//          $subject = "Contact Us details";
//          //$message = "<b>Details of the Interested person.</b>";
//          $message .= "<h1>Name :".$name."<br>Phone Number : ".$contact."<br>Email : ".$from."<br>Message : ".$message."  </h1>";
//          $header = "From:".$from." \r\n";
//       //  $header .= "Cc:prabir.d06@gmail.com \r\n";
//          $header .= "MIME-Version: 1.0\r\n";
//          $header .= "Content-type: text/html\r\n";

//          $retval = mail ($to,$subject,$message,$header);

//          if( $retval == true ) {
//             echo "1";
//              echo '<script>alert("Message Sent!!!")</script>';
            

//          }else {
//             echo "2";
//          }

// }else{
//     echo "3";
// }
 ?>
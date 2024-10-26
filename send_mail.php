<? include('config.php');?>
<html>
    <head>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>        
    </head>
    <body>
        


<?php 
    $nodes='sendmailapi.sarmicrosystems.in/ss_api.php';

    $name = $_POST['userName'];
    $msg = $_POST['userMsg'];
    $mobile = $_POST['userPhone'];
    
    $from = $_POST['email'];
    $newmsg='';
     $datetime = date('Y-m-d h:i:s');
    $newmsg.= $msg.'<br><br>Best Regards,<br>'.$name.'<br>'.$mobile.'<br>'.$from;

    
    // $headers = "Reply-To: The Sender sales@yosshitaneha.com\r\n"; 
    // $headers .= "Return-Path: The Sender sales@yosshitaneha.com\r\n"; 
    // $headers .= "From: Enquiry Srisringaar Fashion Studio sales@yosshitaneha.com" ."\r\n" ;
    // $headers .= "Organization: Sender Organization\r\n";
    // $headers .= "MIME-Version: 1.0\r\n";
    // $headers .= "Content-type: text/html; charset=utf-8\r\n";
    // $headers .= "X-Priority: 3\r\n";
    // $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
    
    $to = 'rajanipodar@gmail.com';
    // $to = 'work.rajeshb@gmail.com';
    $subject = 'Enquiry Mail from Sri Shringarr';
    
        $data = array(
        'subject' => $subject,
        'to' => $to,
        'message' => $newmsg,
        );
        
        
        $ch = curl_init($nodes);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// execute!
$response = curl_exec($ch);

// close the connection, release resources used
curl_close($ch);

// do anything you want with your response
// var_dump($response);

            
    if($response){
        
        $sql = "insert into contactus(name,mobile,email,msg,status,created_at) values('".$name."','".$mobile."','".$from."','".$msg."','1','".$datetime."')";
        mysqli_query($con,$sql);
        
        ?>
  <script>
        Swal.fire(
  'Email Sent Successfully!',
  '',
  'success'
);
setTimeout(function(){ window.location.href="contact_us.php";
}, 3000);

  </script>      
      

<? } else { ?>
  
  <script>
        Swal.fire(
  'Email Sent Error !',
  '',
  'error'
);
    setTimeout(function(){ window.location.href="contact_us.php";
    }, 3000);
  </script>      
  
  
  <? } 
  
  return;
        
  ?>
  
  
    </body>
</html>
<? include('config.php');?>
<html>
    <head>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>        
    </head>
    <body>
        


<?php 

    $name = $_POST['userName'];
    $msg = $_POST['userMsg'];
    $mobile = $_POST['userPhone'];
    
    $from = $_POST['email'];
    $newmsg='';
     $datetime = date('Y-m-d h:i:s');
    $newmsg.= $msg.'<br><br>Best Regards,<br>'.$name.'<br>'.$mobile.'<br>'.$from;

    
    $headers = "Reply-To: The Sender rajanipodar@gmail.com\r\n"; 
    $headers .= "Return-Path: The Sender rajanipodar@gmail.com\r\n"; 
    $headers .= "From: Enquiry Srisringaar Fashion Studio rajanipodar@gmail.com" ."\r\n" ;
    $headers .= "Organization: Sender Organization\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
            
    if(mail('rajanipodar@gmail.com', "Enquiry mail from SriShringarr fashion studio", $newmsg, $headers)){
        
        mail('vishwaaniruddh@gmail.com', "Enquiry mail from SriShringarr fashion studio", $newmsg, $headers);
        
        
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
  
  
  <? } ?>
  
  
    </body>
</html>
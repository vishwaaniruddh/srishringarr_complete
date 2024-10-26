<?php
$name =$_POST['name'];
$from =$_POST['email'];
$message =$_POST['body'];
$contact = $_POST['phone'];


//echo json_encode($_POST);
//$to = "franapp.allmart@gmail.com";
// $to = "prabir.d06@gmail.com";
// $to = "contact@allmart.world";
$to = "hellbinderkumar@gmail.com";
// $to = "yosshita.neha@gmail.com";

$from = "prabirdutta@sarmicrosystems.in";
if ($from!='') {

         $subject = "Contact Us details";
         //$message = "<b>Details of the Interested person.</b>";
         $message .= "<h1>Name :".$name."<br>Phone Number : ".$contact."<br>Email : ".$from."<br>Message : ".$message."  </h1>";
         $header = "From:".$from." \r\n";
       //  $header .= "Cc:prabir.d06@gmail.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";

         $retval = mail ($to,$subject,$message,$header);

         if( $retval == true ) {
            echo "1";
             echo '<script>alert("Message Sent!!!")</script>';
            echo '<script>window.location="https://yosshitaneha.com/contact_us.php"</script>';

         }else {
            echo "2";
         }

}else{
    echo "3";
}
 ?>
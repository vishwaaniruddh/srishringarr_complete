<?php session_start();?>
<html>
 <head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 </head>
<body>
<?php
include('config.php');

$Reson=$_POST['Reson'];
$LeadId=$_POST['HiddenId'];



$Qry=mysqli_query($conn,"Update Members set MemberCancelationReason='".$Reson."',canceledMember='1' where Static_LeadID='".$LeadId."' ");

$Qry1=mysqli_query($conn,"Update Leads_table set Status='8' where Lead_id='".$LeadId."' ");

if($Qry && $Qry1){
    
    
   $log= mysqli_query($conn,"select Primary_nameOnTheCard,GenerateMember_Id,booklet_Series from Members where Static_LeadID='".$LeadId."'");
   $fetchLog= mysqli_fetch_array($log);
 //===========for mail (Canceled Member Log Details )===============

$EmailSubject2="Member cancelaed by ".$_SESSION['user'];
 
        $message2.='Member Cancel by '.$_SESSION['user'].'<br> The Following Details is :<br> Member Name : '. $fetchLog['Primary_nameOnTheCard'].'<br>  Member Number : '.$fetchLog['GenerateMember_Id'] .'<br>  Booklet Series : '.$fetchLog['booklet_Series'] ;
        

        $leadsmail2=" Orchidmembership@loyaltician.com";
        $mailheader2 = "From: ".$leadsmail2."\r\n"; 
    $mailheader2.= "Reply-To: ".$leadsmail2."\r\n"; 
 
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';

$mail2 = new PHPMailer\PHPMailer\PHPMailer();

    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail2->isSMTP();                                      // Set mailer to use SMTP
    $mail2->Host = 'sarmicrosystems.in';  // Specify main and backup SMTP servers
    $mail2->SMTPAuth = true;                               // Enable SMTP authentication
    $mail2->Username = 'ram@sarmicrosystems.in';                 // SMTP username
    $mail2->Password = 'ram1234*';                           // SMTP password
    $mail2->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail2->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail2->setFrom('orchidgoldpune@orchidhotel.com','orchidhotel');
    $mail2->addAddress('meanand.gupta21@gmail.com'); 
    $mail2->mailheader=$mailheader2;// Add a recipient
  //  $mail->addCC('leads@loyaltician.com');
    $mail2->addBCC('kvaljani@gmail.com ');
     $mail2->addCC('admin.orchidpune@loyaltician.com');
    
    
    $mail2->isHTML(true);                                  // Set email format to HTML
    $mail2->Subject = $EmailSubject2."\r\n";
    $mail2->Body    = $message2;
    $mail2->send();
//==============mail end===


    
?>






   <script> 
 swal({
  title: "Success!",
  text: "Member Cancel Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    window.open("Members_view.php","_self");
    
  } 
});
     
</script>
 <?   
}else{
   echo "<script>swal('Error !')</script>";
}

?>

</body>
</html>
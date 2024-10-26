<?php session_start();?>
<html>
 <head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 </head>
<body>
<?php 
include('config.php');

$Static_LeadID=$_POST['Mainid'];

mysqli_query($conn,"START TRANSACTION");

$QuryGetLead=mysqli_query($conn,"select * from Leads_table where Lead_id='".$Static_LeadID."'");
$fetchLead=mysqli_fetch_array($QuryGetLead);
if($QuryGetLead){
    $flag1="1";
}else{
    $flag1="0";
}


    // part 3. MembershipDetails
    $MembershipDetails_Level=$_POST['MembershipDetails_Level'];   
    $MembershipDetails_Fee=$_POST['MembershipDetails_Fee'];   
    $MembershipDetails_offerCheck1=$_POST['MembershipDetails_offerCheck1']; 
    $MembershipSampal_offerCheck1=$_POST['MembershipSampal_offerCheck1'];
    $MembershipDts_Discount=$_POST['MembershipDts_Discount']; 
  
    $MembershipDts_Author=$_POST['MembershipDts_Author'];   
    $MembershipDts_NetPayment=$_POST['MembershipDts_NetPayment'];   
    $MembershipDts_GST=$_POST['MembershipDts_GST']; 
    $MembershipDts_GrossTotal=$_POST['MembershipDts_GrossTotal'];   
    $MembershipDts_PaymentDate=$_POST['MembershipDts_PaymentDate'];   
    $MembershipDts_PaymentMode=$_POST['MembershipDts_PaymentMode'];  
    $MembershipDts_InstrumentNumber=$_POST['MembershipDts_InstrumentNumber'];   
    $MembershipDts_BankName=$_POST['BankName']; 
    
    $MemshipDts_UploadCopyOfTheInstmnt=$_POST['MemshipDts_UploadCopyOfTheInstmnt'];   
    $MemshipDts_BatchNumber=$_POST['MemshipDts_BatchNumber'];   
    $MemshipDts_Remarks=$_POST['MemshipDts_Remarks'];  
    
    if($MembershipDetails_offerCheck1==""){$MembershipDetails_offerCheck1=0;}else{ $MembershipDetails_offerCheck1=1;}
    
    if($MembershipSampal_offerCheck1==""){$MembershipSampal_offerCheck1=0;}else{ $MembershipSampal_offerCheck1=1;}
    
    $MembershipDts_PaymentDate = date('Y-m-d', strtotime($MembershipDts_PaymentDate));
    ///////////////////////////////////////////////////////////////////////////////////////
    
    
       // part 1. Generate Membership ID
     $hotlName=$fetchLead['Hotel_Name'];
     $randomNumber=rand( 10000 , 99999 );
     $GenerateMember_Id=$hotlName.$MembershipDetails_Level.$randomNumber.'1';
     ////////////////////////////////////////////////
 
       $qryinsert=mysqli_query($conn,"insert into Members (GenerateMember_Id,Static_LeadID,Primary_Title,Primary_Pincode,Primary_mcode2,Primary_mob2,Primary_Contact1code,Primary_Contact1,Primary_Contact2code,Primary_Contact2,Primary_Contact3code,Primary_Contact3,Primary_nameOnTheCard,Primary_PhotoUpload,Primary_Email_ID2,Primary_DateOfBirth,Primary_AddressType1,Primary_BuldNo_addrss,Primary_Area_addrss,Primary_Landmark_addrss,Primary_MaritalStatus,Spouse_Title,Spouse_FirstName,Spouse_LastName,Spouse_GmailMArrid1,Spouse_GmailMArrid2,Spouse_PhotoUpload,Spouse_mcode1Married1,Spouse_mob1MArid1,Spouse_mcode1Married2,Spouse_mob1MArid2,Spouse_Contact1codeMArid,Spouse_Contact1Married,Spouse_Contact2codeMArid,Spouse_Contact2Married,Spouse_nameOnTheCardMarried,MembershipDetails_Level,MembershipDetails_Fee,MembershipDetails_offerCheck1,MembershipDts_Discount,MembershipDts_Author,MembershipDts_NetPayment,MembershipDts_GST,MembershipDts_GrossTotal,MembershipDts_PaymentDate,MembershipDts_PaymentMode,MembershipDts_InstrumentNumber,MemshipDts_UploadCopyOfTheInstmnt,MemshipDts_BatchNumber,MemshipDts_Remarks,Documentation_UploadSignatures,Documentation_AddressProof,Relationships_ReferredByLEADID,Relationships_ReferredByMEMBERSHIPID,itemCheck1,BookletCheck1,CertificatesCheck1,PromotionalCheck1,Issue_ReferredByLEADID,Issue_ReferredByMEMBERSHIPID,Member_bankName,Sample,receipt_no
    )values('".$GenerateMember_Id."','".$Static_LeadID."','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','".$MembershipDetails_Level."','".$MembershipDetails_Fee."','".$MembershipDetails_offerCheck1."','".$MembershipDts_Discount."','".$MembershipDts_Author."','".$MembershipDts_NetPayment."','".$MembershipDts_GST."','".$MembershipDts_GrossTotal."','".$MembershipDts_PaymentDate."','".$MembershipDts_PaymentMode."','".$MembershipDts_InstrumentNumber."','".$MemshipDts_UploadCopyOfTheInstmnt."','".$MemshipDts_BatchNumber."','".$MemshipDts_Remarks."','','','','','','','','','','','".$MembershipDts_BankName."','".$MembershipSampal_offerCheck1."','0')");
   
   if($qryinsert){
    $flag2="1";
   }else{
    $flag2="0";
   }
   
    
    if($qryinsert){//echo "<br>success";
        
    include('Leadpdf/MemberPaymentRecipt_pdf.php');
        
    
    
         $st="4";
    
    
    
    
    
  if($MembershipDts_PaymentMode=="Online"){
      $st="6";
      
    //===========for mail===============
$Gmail=$fetchLead['EmailId'];

$EmailSubject="Online Payment Link !";

   $MESSAGE_BODY="";
   $MESSAGE_BODY.="Sincerely,"."\r\n";
   $MESSAGE_BODY.="Team The Shyambabadham,"."\r\n";
      
     $message="hii This is for Online Payment Link "."\r\n";
            
        $leadsmail=" Orchidmembership@loyaltician.com";
        $mailheader = "From: ".$leadsmail."\r\n"; 
    $mailheader .= "Reply-To: ".$leadsmail."\r\n"; 
 
//require 'phpmail/src/PHPMailer.php';
//require 'phpmail/src/SMTP.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();

    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'sarmicrosystems.in';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'ram@sarmicrosystems.in';                 // SMTP username
    $mail->Password = 'ram1234*';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('leads@loyaltician.com','Shyambabadham');
  //  $mail->addAddress($Gmail); 
   $mail->addAddress('meanand.gupta21@gmail.com'); 
    $mail->mailheader=$mailheader;// Add a recipient
  //  $mail->addCC('leads@loyaltician.com');
  //  $mail->addBCC('kvaljani@gmail.com');
   // $mail->addBCC('meanand.gupta21@gmail.com');
    
    
    $mail->isHTML(false);                                  // Set email format to HTML
    $mail->Subject = $EmailSubject."\r\n";
    $mail->Body    = $message."\r\n".$MESSAGE_BODY;
    $mail->send();
//==============mail end===

    
      
      
      
  }
    
    
$UpdateQry=mysqli_query($conn,"update Leads_table set Status='".$st."' where Lead_id='".$Static_LeadID."' ");

  if($qryinsert){
    $flag3="1";
   }else{
    $flag3="0";
   }
   
 
 
 
        if ($flag1=="1" && $flag2=="1" && $flag3=="1") {
    mysqli_query($conn,"COMMIT");
} else {        
    mysqli_query($conn,"ROLLBACK");
}
      



?>
<script> 
 swal({
  title: "Success!",
  text: "Thank you, Add Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    window.open("leadupdatebysales.php","_self");
    
  } 
});
     
</script>
   
<? 
         
        
        
    }else{
    $sqlerror=mysqli_error($conn);
    echo $sqlerror; //"<script>swal('Error!'".$sqlerror.")</script>";
}

   
?>
</body>
</html>
<?php
$userName=$_SESSION['user'];
//include('../config.php');
require('fpdf.php');
$QL=mysqli_query($conn,"select * from Level where Leval_id='".$MembershipDetails_Level."' ");
$FL=mysqli_fetch_array($QL);

$QR=mysqli_query($conn,"select CountRecipt from PaymentReceipt where Program_ID='".$FL['Program_ID']."' ");
$FR=mysqli_fetch_array($QR);




$sqlexpiry="SELECT Expiry_month FROM `validity` where Leval_id='".$MembershipDetails_Level."' ";
    //echo $sqlexpiry;
	$QryExpiry=mysqli_query($conn,$sqlexpiry);
	$fetchExpiry=mysqli_fetch_array($QryExpiry);
	
 	$currentDate=date('Y-m-d');
    $dd= date("d-m-Y");
 	 $d = strtotime("+".$fetchExpiry['Expiry_month']." months",strtotime($currentDate));
     $R=  date("d-m-Y",$d);
	
	$CGST=$MembershipDts_GST/2;


class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    //$this->Image('logo1.png',10,6,30);
    // Arial bold 15
   // $this->SetFont('Arial','B',15);
    // $this->SetDrawColor(50,60,100);
    // Move to the right
   // $this->Cell(80);
    // Title
   //$this->Cell(30,10,'PROFORMA INVOICE',0,0,'C',0);
    // Line break
    
   // $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}


$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',10);


$pdf->image('LOYAL.png',20,10,30,20);
$pdf->image('FIRST.png',60,10,30,20);
$pdf->image('GOLD.png',110,10,30,20);
$pdf->image('PLATINUM.png',160,10,30,20);

$pdf->Rect(10, 10, 195, 50, 'D');

$pdf->Ln(20);
$pdf->SetFillColor(250, 255, 250);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(195,10,"Loyaltician CRM India Private Limited- Orchid Membership ",1,1,'C',true);

$pdf->SetFillColor(250, 255, 250);
$pdf->SetFont('Arial','B',7);
$pdf->multicell(195,5,"The Orchid Hotel Pune, Balewadi, Pune Bangalore Highway Pune 411045, Maharashtra orchidgoldpune@orchidhotel.com 
GSTN ID- 27AADCL8692D1Z8      State- Maharashtra     Code -27",1,1,'R',true);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(195,10,"Tax Invoice cum Receipt",1,1,'C',true);

$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(236, 141, 120);
$pdf->Cell(140,5,"Invoice to: (Customer Details)",1,0,'',true);
$pdf->Cell(55,5,"Invoice Details",1,1,'',true);

$pdf->SetFillColor(250, 250, 250);
$pdf->Cell(140,5,"Company Name:".$fetchLead['Company'],1,0,'',true);
$pdf->Cell(35,5,"Date",1,0,'',true);
$pdf->Cell(20,5,$dd,1,1,'',true);

$pdf->Cell(140,5,"Name:".$fetchLead['Title']." ".$fetchLead['FirstName']." ".$fetchLead['LastName'],1,0,'',true);
$pdf->Cell(35,5,"Invoice/ Receipt #",1,0,'',true);
$pdf->Cell(20,5,$FR['CountRecipt'],1,1,'',true);

$pdf->Cell(140,5,"Address:" .$fetchLead['Address1']." ".$fetchLead['Address2']." ".$fetchLead['Address3'],1,0,'',true);
$pdf->SetFillColor(236, 141, 120);
$pdf->Cell(55,5,"Membership Details",1,1,'C',true);

$pdf->SetFillColor(250, 250, 250);
$pdf->Cell(140,5,"Phone:".$fetchLead['MobileNumber'],1,0,'',true);
$pdf->Cell(35,5,"Membership ",1,0,'',true);
$pdf->Cell(20,5,$GenerateMember_Id,1,1,'',true);

$pdf->Cell(140,5,"Email:".$fetchLead['EmailId'],1,0,'',true);
$pdf->Cell(35,5,"Level",1,0,'',true);
$pdf->SetFont('Arial','B',7);
$pdf->Cell(20,5,$FL['level_name'],1,1,'',true);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(140,5,"GSTN: 27AADCL8692D1Z8",1,0,'',true);
$pdf->Cell(35,5,"Validity",1,0,'',true);
$pdf->Cell(20,5,$R,1,1,'',true);

$pdf->SetFillColor(236, 141, 120);
$pdf->Cell(125,5,"Description:",1,0,'',true);
$pdf->Cell(15,5,"Quantity",1,0,'',true);
$pdf->Cell(35,5,"Unit Price",1,0,'',true);
$pdf->Cell(20,5,"Amount",1,1,'',true);

$pdf->SetFillColor(250, 250, 250);
$pdf->Cell(125,20,$FL['level_name']." Membership:",1,0,'',true);
$pdf->Cell(15,20,"1",1,0,'',true);
$pdf->Cell(35,20,$MembershipDetails_Fee,1,0,'',true);
$pdf->Cell(20,20,$MembershipDts_NetPayment,1,1,'',true);

$pdf->SetFillColor(236, 141, 120);
$pdf->Cell(125,5,"Payment Details:",1,0,'',true);

$pdf->SetFillColor(240, 238, 205);
$pdf->Cell(50,5,"Subtotal",1,0,'',true);
$pdf->Cell(20,5,$MembershipDts_NetPayment,1,1,'',true);

$pdf->SetFillColor(236, 141, 120);
$pdf->Cell(125,5,"Received by: ".$MembershipDts_PaymentMode,1,0,'',true);
$pdf->SetFillColor(240, 238, 205);
$pdf->Cell(50,5,"CGST @ 9%",1,0,'',true);
$pdf->Cell(20,5,$CGST,1,1,'',true);
$pdf->SetFillColor(236, 141, 120);
$pdf->Cell(125,5,"Instrument Number/ Approval Code: ".$MembershipDts_InstrumentNumber ,1,0,'',true);
$pdf->SetFillColor(240, 238, 205);
$pdf->Cell(50,5,"GGST @ 9%",1,0,'',true);
$pdf->Cell(20,5,$CGST,1,1,'',true);
$pdf->SetFillColor(236, 141, 120);
$pdf->Cell(125,5,"Cheque Favouring - Loyaltician CRM India Private Limited- Orchid Membership:",1,0,'',true);
$pdf->Cell(50,5,"Total including Taxes",1,0,'',true);
$pdf->Cell(20,5,$MembershipDts_GrossTotal,1,1,'',true);

$pdf->SetFillColor(250, 250, 250);
$pdf->multiCell(195,5,"Terms and Conditions
1. To avail input credit (if available), GSTN number and State is mandatory.
2. This is the final invoice regarding the purchase.
3. No refunds are entertained beyond 15 days of purchase
",1,1,'L',true);

$pdf->Ln(10);
$pdf->multiCell(97.5,5,"Signed

For Loyaltician CRM India Private Limited",0,1,'R',true);


//$pdf->Output();



// attachment name
$filename = "PaymentRecipt.pdf";


//////////////////////////////////////////////

$pdfdoc = $pdf->Output("", "S");

$Gmail=$fetchLead['EmailId'];

$EmailSubject="Payment Recipt !";

   $MESSAGE_BODY="";
//   $MESSAGE_BODY.="Sincerely,"."\r\n";
  // $MESSAGE_BODY.="Team The Orchid Pune,"."\r\n";
      
     $message="PFA Payment Recipt From Orchid Pune  "."\r\n";
      $message1.=$body;
            
        $leadsmail=" Orchidmembership@loyaltician.com";
        $mailheader = "From: ".$leadsmail."\r\n"; 
    $mailheader .= "Reply-To: ".$leadsmail."\r\n"; 
 
include 'phpmail/src/PHPMailer.php';
include 'phpmail/src/SMTP.php';


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
    $mail->setFrom('orchidgoldpune@orchidhotel.com','orchidhotel');
  //  $mail->addAddress($Gmail); 
    $mail->addAddress('leads@loyaltician.com'); 
    $mail->mailheader=$mailheader;// Add a recipient
    $mail->addCC('satyendra1111@gmail.com');
    $mail->addBCC('kvaljani@gmail.com');
  //  $mail->addBCC('meanand.gupta21@gmail.com');
    
    
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $EmailSubject."\r\n";
    $mail->Body    = $message."\r\n".$MESSAGE_BODY;
    $mail->addStringAttachment($pdf->Output('',"S"), $filename, $encoding = 'base64', $type = 'application/pdf');
    $mail->send();
//==============mail end===




?>
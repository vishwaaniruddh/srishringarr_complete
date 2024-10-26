<?
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);



function is_dir_empty($dir) {
  if (!is_readable($dir)) return null; 
  return (count(scandir($dir)) == 2);
}



$EmailSubject = $_REQUEST['subject'];
$message = $_REQUEST['message'];
$leadsmail = $_REQUEST['leadsmail'];

$host = $_REQUEST['host'];
$hostusername = $_REQUEST['hostusername'];
$hostpassword = $_REQUEST['hostpassword'];
$port = $_REQUEST['port'];

$from = $_REQUEST['from'];
$fromname = $_REQUEST['fromname'];

$bcc = $_REQUEST['bcc'];    //array
$to = $_REQUEST['to'];      //array
$cc = $_REQUEST['cc'];      //array
$attachment = $_REQUEST['attachment'];

$pdfstructure = $_REQUEST['pdfstructure'];
$primary_name = $_REQUEST['primary_name'];


$mailheader = "From: ".$from."\r\n"; 
$mailheader .= "Reply-To: ".$from."\r\n"; 


// var_dump($_REQUEST);

require_once 'phpmail/src/PHPMailer.php';
require_once 'phpmail/src/SMTP.php';
require_once 'phpmail/src/Exception.php';




$mail = new PHPMailer\PHPMailer\PHPMailer();

    $mail->SMTPDebug = 1;                                // Enable verbose debug output
    $mail->isSMTP();                                        // Set mailer to use SMTP
    $mail->Host = $host;                                    // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                                 // Enable SMTP authentication
    $mail->Username = $hostusername;                        // SMTP username
    $mail->Password = $hostpassword;                        // SMTP password
    $mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted
    $mail->Port = $port;                                    // TCP port to connect to
    $mail->addReplyTo($leadsmail);
    
    //Recipients
    $mail->setFrom($from,$fromname);
    $mail->From = trim($hostusername);
    $mail->FromName = $fromname;
    
    foreach($to as $key=>$val){
            $mail->addAddress($val);         
    }

if(isset($cc)){
    foreach($cc as $keycc=>$valcc){
        $mail->addCC($valcc);
    }
   
}
     if(isset($bcc)){
        foreach($bcc as $keybcc=>$valbcc){
            $mail->addCC($valbcc);
        }
     }
    $mail->mailheader=$mailheader;// Add a recipient

if($attachment){




include('Leadpdf/generatepdf/TCPDF-master/examples/tcpdf_include.php');
include('Leadpdf/generatepdf/TCPDF-master/tcpdf.php');

class MYPDF extends TCPDF {
    public function Header() {
    }

    public function Footer() {
    }
}



// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Satyendra Sharma');
$pdf->SetTitle($primary_name);
$pdf->SetSubject('DER Report');
$pdf->SetKeywords('E-FSR, PDF');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}





$pdf->SetFont('times', '', 12);
$pdf->AddPage();
$pdf->SetMargins(5, 0, 10, true);
$pdf->SetFillColor(255, 255, 127);


if (is_dir_empty('Leadpdf/memberpdf')) {} else{
    $folder_path = "Leadpdf/memberpdf";
    $files = glob($folder_path.'/*'); 
    foreach($files as $file) {
        if(is_file($file)) 
            unlink($file); 
    }
}

$pdf->writeHTML($pdfstructure , true, false, false, false, '');
$pdf->Output('Leadpdf/memberpdf/'.$primary_name.'.pdf','F');
$mail->addAttachment("Leadpdf/memberpdf/$primary_name.pdf");
}


    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $EmailSubject."\r\n";
    $mail->Body    = $message;
    
    if($mail->send()){
        echo 1;
    }else{
        echo 0;
    }
    
    // var_dump($mail);
    
?>
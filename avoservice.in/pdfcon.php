<?php
include('config.php');
require('fpdf.php');
$mail=$_POST['email'];


$a=$_POST['Call_Ticket'];
$b=$_POST['CallAlertDate'];
$c=$_POST['Battery_Vendor'];
$d=$_POST['Customer_Name'];
$e=$_POST['Address'];
$f=$_POST['Branch'];
$g=$_POST['ContactPersonName'];
$h=$_POST['ContactpersonNumber'];
$i=$_POST['AVOContactPerson'];
$j=$_POST['AVOContactNumber'];
$k=$_POST['NatureofProblem'];
$l=$_POST['BatteryType'];
$m=$_POST['BatteryRating_AH'];
$n=$_POST['BatteryQuantity'];
$o=$_POST['No_ofBattery'];
$p=$_POST['PhysicalCondition'];
$q=$_POST['ConnectedtoUPS'];
$r=$_POST['KVARating'];
$s=$_POST['SrNo_ofUPS'];
$t=$_POST['FloatVoltage'];
$u=$_POST['ChargingCurrentSetting'];
$v=$_POST['CutOffVoltage'];
$w=$_POST['AmbientOperating'];
$x=$_POST['Load_Present'];
$y=$_POST['Back_up_Required'];
$z=$_POST['No_ofbatteriesfound'];
$Remarks=$_POST['Remarks'];
$atm=$_POST['atm_id'];

$Slno=$_POST['Sl_no'];
$BatterySerialNo=$_POST['BatterySerialNo'];
$Charging_Voltage=$_POST['Charging_Voltage'];
$Discharge=$_POST['Discharge'];
$DischargeVoltage=$_POST['DischargeVoltage'];



$Sl_no=  explode(',', $Slno);
$BatteryS_No=  explode(',', $BatterySerialNo);
$ChargingVoltage=  explode(',', $Charging_Voltage);
$Disch=  explode(',', $Discharge);
$Discharge_Voltage=  explode(',', $DischargeVoltage);

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('logo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
   $this->Cell(30,10,'AVOSERVICE',0,0,'C');
    // Line break
    $this->Ln(20);
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
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'THIS IS BRF FORM!',1,1,'C');
$pdf->Cell(70,10,"Call_Ticket:",1,0);
$pdf->Cell(120,10,$a,1,1);

$pdf->Cell(70,10,"atm_id:",1,0);
$pdf->Cell(120,10,$atm,1,1);

$pdf->Cell(70,10,"Battery_Vendor:",1,0);
$pdf->Cell(120,10,$c,1,1);

$pdf->Cell(70,10,"Customer_Name:",1,0);
$pdf->Cell(120,10,$d,1,1);
/*
$fontsize=12;
$pdf->Cell(120,10,"this is testing",0,1);
$tempFontSize=$fontsize;

$cellwidth=120;
while($pdf->GetStringWidth($e) > $cellwidth){
$pdf->SetFontsize($tempFontSize -=0.1);
}
$pdf->Cell($cellwidth,10,$e,0,1)
$tempFontSize=$fontsize;
$pdf->SetFontsize($fontsize);
*/
//$pdf->Cell(70,30,"Address:",1,0);
//$pdf->Cell(120,10,$e,1,1);
//$pdf->MultiCell(120,10,$e,1,1);
/*
$pdf->Cell(70,10,"Address:",1,0);
	$font_size = 14;
	$decrement_step = 0.1;
	$line_width = 120; // Line width (approx) in mm
	$pdf->SetFont('Arial','B',$font_size);
		while($pdf->GetStringWidth($e) > $line_width) {
		$pdf->SetFontSize($font_size -= $decrement_step);
	}
	
	 
	$pdf->Cell($line_width, 10, $e, 1, 1);
	*/
	//$e="hjgfvhd  ksjgdhfjg ksjhdfkjdsf kjshf vsdfkj iusyfusdf oisydf sdfkj iudyfsudf oisydfsiudfdf iousydfud fdf ";
	$x = $pdf->GetX();
          $y = $pdf->GetY();
          $pdf->Cell(70,10,"Address:",1,0);
          $pdf->multicell(120,10,$e,1,1);
   $pdf->SetFont('Arial','B',12);
$pdf->Cell(70,10,"Branch:",1,0);
$pdf->Cell(120,10,$f,1,1);


$pdf->Cell(70,10,"ContactPersonName:",1,0);
$pdf->Cell(120,10,$g,1,1);

$pdf->Cell(70,10,"ContactpersonNumber:",1,0);
$pdf->Cell(120,10,$h,1,1);

$pdf->Cell(70,10,"AVOContactPerson:",1,0);
$pdf->Cell(120,10,$i,1,1);

$pdf->Cell(70,10,"AVOContactNumber:",1,0);
$pdf->Cell(120,10,$j,1,1);

$pdf->Cell(70,10,"NatureofProblem:",1,0);
$pdf->Cell(120,10,$k,1,1);

$pdf->Cell(70,10,"BatteryType:",1,0);
$pdf->Cell(120,10,$l,1,1);

$pdf->Cell(70,10,"BatteryRating_AH:",1,0);
$pdf->Cell(120,10,$m,1,1);

$pdf->Cell(70,10,"BatteryQuantity:",1,0);
$pdf->Cell(120,10,$n,1,1);

$pdf->Cell(70,10,"No_ofBattery:",1,0);
$pdf->Cell(120,10,$o,1,1);

$pdf->Cell(70,10,"PhysicalCondition:",1,0);
$pdf->Cell(120,10,$p,1,1);

$pdf->Cell(70,10,"ConnectedtoUPS:",1,0);
$pdf->Cell(120,10,$q,1,1);

$pdf->Cell(70,10,"KVARating:",1,0);
$pdf->Cell(120,10,$r,1,1);

$pdf->Cell(70,10,"SrNo_ofUPS:",1,0);
$pdf->Cell(120,10,$s,1,1);

$pdf->Cell(70,10,"FloatVoltage:",1,0);
$pdf->Cell(120,10,$t,1,1);

$pdf->Cell(70,10,"ChargingCurrentSetting:",1,0);
$pdf->Cell(120,10,$u,1,1);

$pdf->Cell(70,10,"CutOffVoltage:",1,0);
$pdf->Cell(120,10,$v,1,1);

$pdf->Cell(70,10,"AmbientOperating:",1,0);
$pdf->Cell(120,10,$w,1,1);

$pdf->Cell(70,10,"Load_Present:",1,0);
$pdf->Cell(120,10,$x,1,1);

$pdf->Cell(70,10,"Back_up_Required:",1,0);
$pdf->Cell(120,10,$y,1,1);

$pdf->Cell(70,10,"No_ofbatteriesfound:",1,0);
$pdf->Cell(120,10,$z,1,1);

$pdf->Cell(70,10,"Remarks:",1,0);
$pdf->Cell(120,10,$Remarks,1,1);

$pdf->Ln(10);


$pdf->Cell(63,10,"BatterySerialNo",1,0);
$pdf->Cell(42,10,"Charging_Voltage",1,0);
$pdf->Cell(42,10,"Discharge",1,0);
$pdf->Cell(42,10,"DischargeVoltage",1,1);

$sql="SELECT Brf_id FROM `BRF_form` order by Brf_id desc limit 1";
$result=mysqli_query($con1,$sql);
$row=mysqli_fetch_array($result);
//echo $row['Brf_id'];

$sql1="SELECT * FROM `BRF_details` where Brf_id='".$row['Brf_id']."' ";

$result1=mysqli_query($con1,$sql1);
while($row1=mysqli_fetch_array($result1)){

$pdf->Cell(63,10,$row1['BatterySerialNo'],1,0);
$pdf->Cell(42,10,$row1['Charging_Voltage'],1,0);
$pdf->Cell(42,10,$row1['Discharge'],1,0);
$pdf->Cell(42,10,$row1['DischargeVoltage'],1,1);
}
//$pdf->Output();

//$pdf->Output('filename.pdf','D');
// email stuff (change data below)
//$to = "ramshankargupta444@gmail.com"; 

$from = "e-bfr@avoservice.in"; 
$subject = "Switching AVO - BRF form - Site Id .$atm"; 
$message = "<p>Please find attached the BRF form and request you to kindly log the call and ensure that the batterieas are replaced at the earliest:-   By:Switching AVOI Service team </p>";

// a random hash will be necessary to send mixed content
$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

// attachment name
$filename = "BRF.pdf";

// encode data (puts attachment in proper format)
$pdfdoc = $pdf->Output("", "S");
$attachment = chunk_split(base64_encode($pdfdoc));

// main header
$headers  = "From: ".$from.$eol;
$headers .= "MIME-Version: 1.0".$eol; 
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

// no more headers after this, we start the body! //

$body = "--".$separator.$eol;
$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
$body .= "This is a MIME encoded e-BRF form Switching AVO.".$eol;

// message
$body .= "--".$separator.$eol;
$body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$body .= $message.$eol;

// attachment
$body .= "--".$separator.$eol;
$body .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
$body .= "Content-Transfer-Encoding: base64".$eol;
$body .= "Content-Disposition: attachment".$eol.$eol;
$body .= $attachment.$eol;
$body .= "--".$separator."--";

// send message
if(mail($mail, $subject, $body, $headers))
{
  echo "Mail Sent Successfully";
  echo '<script>window.open("view_alert.php", "_self" )</script>';
}else{
  echo "Mail Not Sent";
}


?>
<?php
require('fpdf.php');

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
$word="2354534   ";
$address="jnjdfjdsnjdf ksndinkjdsf ksjnkjndkaf ksjndkjnas kjjsdnjnasdf kjasnknd jbhkjbskdf ksjbkjbdf kjnskjndf";
// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Cell(0,10,'THIS IS BRF FORM!',1,1,'C');
$pdf->Cell(70,10,"Call_Ticket:",1,0);
if($pdf->GetStringWidth($word) > 120){
    $pdf->SetFont('Arial','',12);
    $pdf->MultiCell(120,10,$word,1,1,false);
    $pdf->SetFont('Arial','',12);
}else{
    $pdf->Cell(120,10,$word,1,1);
}
//$pdf->Cell(120,10,$word,1,1);

$pdf->Cell(70,10,"address:",1,0);
$pdf->Cell(120,10,$address,1,1);

$pdf->Cell(70,10,"atm_id:",1,0);
$pdf->Cell(120,10,"897454hhy45hy",1,1);

$pdf->Output();
?>
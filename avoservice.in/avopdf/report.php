<?php error_reporting(0);
require_once('generatepdf/TCPDF-master/examples/tcpdf_include.php');
include('generatepdf/TCPDF-master/tcpdf.php');
include('../config.php');
$alertid=$_GET['aid'];
$sql=mysqli_query($con1,"select * from alert where alert_id='".$alertid."'");
$row=mysqli_fetch_array($sql);

$fsrsql=mysqli_query($con1,"select * from FSR_details where alertid='".$alertid."'");
$fsrrow=mysqli_fetch_array($fsrsql);

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
      $image_file ='AVO-Logo.png';
        $this->Image($image_file, 10, 10, 40, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 18);
        
       $this->Cell(0, 10, 'Switching AVO Electro Power Limited', 0, false, 'L', 0, '', 0, false, 'M', 'M');
$this->Ln();
$this->SetFont('helvetica', '', 10);
   $this->Cell(0, 5, 'H.O: 97, Raja Ram Mohan Rai Road, Kolkata- 700041', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$this->Ln();
$this->SetFont('helvetica', '', 10);
   $this->Cell(0, 5, 'Service Help Line-9674000501 / Fax: 033-24001420 / Email id: service3@avoups.com', 0, false, 'C', 0, '', 0, false, 'M', 'M');

$this->Ln();
$this->SetFont('helveticaB', 'U', 12);
$this->Cell(0, 5, 'FIELD SERVICE / INSTALLATION REPORT',0,false,'C',false, '', 0, false, 'M', 'U');
}

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Boopathy');
$pdf->SetTitle('E-FSR');
$pdf->SetSubject('Field Service Report');
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

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(220);

$pdf->Ln(6);

$brsql=mysqli_query($con1,"select name,phone from avo_branch where id='".$row[7]."'");
$brrow=mysqli_fetch_array($brsql);
$avobranch=$brrow[0];
$docketno=$row[25];
$custsql=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
$custrow=mysqli_fetch_array($custsql);

$customername=$custrow[0];

$address=$row[5];
$phn=$brrow[1];
if($row[21]=="site")
{
$atmsql=mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'");
$atmrow=mysqli_fetch_array($atmsql);
$atmid=$atmrow[0];

//if(mysqli_num_rows($atmrow)==0) { $atmid= $row[2] ; }
$cs="Warranty";
}
else if($row[21]=="amc")
{
$atmsql=mysqli_query($con1,"select atmid from Amc where amcid='".$row[2]."'");
$atmrow=mysqli_fetch_array($atmsql);

$atmid=$atmrow[0];
$cs="AMC";
}
else {$atmid=$row[2];
$cs="Temporary/Chargeable";
}

$pdf->MultiCell(85, 5, 'AVO Branch: '.$avobranch, 1, 'L', 1, 0, '', '', true);
$pdf->MultiCell(85, 5, 'AVO Docket No: '.$docketno, 1, 'L', 1, 0, '', '', true);
$pdf->Ln();
$pdf->MultiCell(85, 5, 'Site/Sol/ATM ID:  '.$atmid, 1, 'L', 0, 0, '', '', true);
$pdf->MultiCell(85, 5, 'Name of Customer: '.$customername, 1, 'L', 0, 0, '', '', true);
$pdf->Ln();
$pdf->MultiCell(85, 5, 'Phone/Mobile:'.$phn, 1, 'L', 0, 0, '', '', true);
$pdf->MultiCell(85, 5, 'Customer Status: '.$cs, 1, 'L', 0, 0, '', '', true);
$pdf->Ln();
$pdf->MultiCell(85, 5, 'Date of Call: '.$row[10], 1, 'L', 0, 0, '', '', true);
$pdf->MultiCell(85, 5, 'Call Type: '.$row[30], 1, 'L', 0, 0, '', '', true);    

$calltype="<b>".$row[17]."</b>";
//$servrendered=$row[17];

$pdf->Ln();
//$pdf->writeHTML("<hr>", true, false, false, false, '');
$pdf->MultiCell(85,5,'Site Type: '.$calltype, 1, 'L', 0, 0, '', '', true,0,true);
$pdf->MultiCell(85, 5, 'End User Name: '.$row[3], 1, 'L', 0, 0, '', '', true);
$pdf->Ln();
$pdf->MultiCell(172, 5,'Address:'.$address, 1, 'L', 0, 0, '', '', true,0,true);


$pdf->Ln();
$pdf->MultiCell(172,5,'Product Details', 0, 'C', 0, 0, '', '', true,0,true);
$pdf->Ln();
$htmtab1='

<table border="1" width="89%" align="center" vertical-align:middle>
<thead>
<tr>
<th><b> UPS Model </b></th>
<th><b> UPS Capacity</b></th>
<th><b> UPS Quantity</b></th>
<th><b> UPS Sl.No.</b></th>
<th><b> Battery Specs </b></th>
<th><b> Battery Qty</b></th>
</tr>
</thead>

<tr>
<td>'.$fsrrow[3].'</td>
<td>'.$fsrrow[4].'</td>
<td>'.$fsrrow[5].'</td>
<td>'.$fsrrow[6].'</td>
<td>'.$fsrrow[7].'</td>
<td>'.$fsrrow[8].'</td>
</tr>
</table>';
//$pdf->MultiCell(180, 5,$htmtab1, 1, 'C', 0, 0, '', '', true);
$pdf->writeHTML($htmtab1, false, true, false, false, '');

$pdf->Ln();
$pdf->MultiCell(172,5,'Voltage Parameters', 0, 'C', 0, 0, '', '', true,0,true);

$pdf->Ln();
$tbl_header = '<table border="1" style=" border: 1px solid #000;border-radius: 5px;border: 1px solid #000;margin-left:80px;margin-right:50px;width:93%;" align="center">
<tr>
<th><b> DC Voltages </b></th>
<th><b> Input Voltages </b></th>
<th><b> Output Voltages </b></th>
<!--<td style="width:150px;padding: 3px; ">DC Voltages</td>
<td style="width:150px;padding: 3px; ">Input Voltages</td>
<td style="width:150px;padding: 3px; ">Output Voltages</td>
<td style="width:100px;min-width:100px;max-width:216px; padding: 7px;" colspan="3">Out Put Voltages</td>-->
</tr>
<tr>
<td style="width:62px;padding: 3px; ">With Mains</td>
<td style="width:62px;padding: 3px; ">On Battery</td>
<td style="width:60px;padding: 3px; ">Charging Current</td>
<td style="width:62px;padding: 3px; ">L-N</td>
<td style="width:61px;padding: 3px; ">L-E</td>
<td style="width:60px;padding: 3px; ">N-E</td>
<td style="width:62px;padding: 3px; ">L-N</td>
<td style="width:61px;padding: 3px; ">L-E</td>
<td style="width:61px;padding: 3px; ">N-E</td>
</tr>';
$tbl_footer = '
<tr>
<td style="width:62px;padding: 3px; ">'.$fsrrow[16].'</td>
<td style="width:62px;padding: 3px; "></td>
<td style="width:60px;padding: 3px; ">'.$fsrrow[17].'</td>
<td style="width:62px;padding: 3px; ">'.$fsrrow[10].'</td>
<td style="width:61px;padding: 3px; ">'.$fsrrow[11].'</td>
<td style="width:60px;padding: 3px; ">'.$fsrrow[12].'</td>
<td style="width:62px;padding: 3px; ">'.$fsrrow[13].'</td>
<td style="width:61px;padding: 3px; ">'.$fsrrow[14].'</td>
<td style="width:61px;padding: 3px; ">'.$fsrrow[15].'</td>
</tr>
</table>';
$pdf->writeHTML($tbl_header . $tbl . $tbl_footer, false, true, false, false, '');

//=========
$engsql=mysqli_query($con1,"select engineer from alert_delegation where alert_id='".$row[0]."'");
$engrow=mysqli_fetch_array($engsql);
$avoengg=$engrow[0];
$engsql=mysqli_query($con1,"select engg_name, phone_no1 from area_engg where engg_id='".$avoengg."'");
$engrow=mysqli_fetch_array($engsql);
$enggname=$engrow[0] ;
$engg_mobile = $engrow[1];
$feedsql=mysqli_query($con1,"select feedback from eng_feedback where alert_id='".$row[0]."' order by id desc");
$feedrow=mysqli_fetch_array($feedsql);
$image_file ='AVO-Logo.png';
$fsrimgsql=mysqli_query($con1,"select * from fsr_images where alertid='".$row[0]."'");

while($fsrimgrow=mysqli_fetch_array($fsrimgsql))
{
 if($fsrimgrow[3]=="E")
   $engg_sign=$fsrimgrow[2];
 else if($fsrimgrow[3]=="A")
   $attn_sign=$fsrimgrow[2];
}
$enggfile='../andi/fsrimages/'.$engg_sign;
$attnfile='../andi/fsrimages/'.$attn_sign;
$pdf->Ln(5);
//$pdf->Cell(0, 0, '', 1,0,'C',true, '', 0, false, 'M', 'M');
if($row[9]=='')
$problem=$row[30];
else
$problem=$row[9];

$probsql=mysqli_query($con1,"select problemtype from siteproblem where alertid='".$row[0]."'");
$probrow=mysqli_fetch_array($probsql);


$pdf->Ln();
$pdf->MultiCell(85,5,'Problem Reported: '.$problem, 1, 'L', 0, 0, '', '', true,0,true);
$pdf->MultiCell(85,5,'Problem Type: '.$probrow[0], 1, 'L', 0, 0, '', '', true,0,true);

$pdf->Ln();
$pdf->MultiCell(85,5,'Time In: '.$row[24], 1, 'L', 0, 0, '', '', true,0,true);
$pdf->MultiCell(85,5,'Time-Out: '.$row[18], 1, 'L', 0, 0, '', '', true,0,true);
$pdf->Ln();
//$pdf->Cell(0, 5, 'Call Status : '.$row[15],0,false,'C',false, '', 0, false, 'M', 'U');
$pdf->Cell(172,5,'Call Status: '.$row[15].$row[16],1, false, 'C', 1, 1, '', '', false,0);
$pdf->Ln();
$pdf->MultiCell(172,5,'Service Remark : '.$feedrow[0], 1, 'L', 0, 0, '', '', true,0,true);

$pdf->Ln();
$pdf->MultiCell(172,5,'The above mentioned Systems installed/Serviced by Engineer is found to be functioning & satisfactory.', 0, 'L', 0, 0, '', '', true,0,true);
$pdf->Ln();
$pdf->MultiCell(85, 5, 'Engineer Name: '.$enggname .$nbsp .$engg_mobile, 1, 'L', 1, 0, '', '', true);
$pdf->MultiCell(85, 5, 'Customer : ', 1, 'L', 1, 0, '', '', true);
$pdf->Ln();
$htmtab3='

<table border="1" width="93.2%" align="center" vertical-align:middle>

<tr>
<td> 
 <img src="'.$enggfile.'" alt="Smiley face" height="40" width="150"> 
 </td>
<td><img src="'.$attnfile.'" alt="Smiley face" height="40" width="150"> </td>
  </tr>
  
</table>';
//$pdf->MultiCell(180, 5,$htmtab1, 1, 'C', 0, 0, '', '', true);
$pdf->writeHTML($htmtab3, false, true, false, false, '');

// ---------------------------------------------------------
$pdf->Ln(2);

$pdf->MultiCell(85,5,'Engineer Signature', 1, 'L', 0, 0, '', '', true,0,true);
$pdf->MultiCell(85,5,'Name & Sign By customer with seal', 1, 'R', 0, 0, '', '', true,0,true);

$pdf->Ln(7);
$pdf->MultiCell(172,5,'This is auto-generated FSR and hence Seal or Signature may not required', 1, 'L', 0, 0, '', '', true,0,true);
$pdf->AddPage();

$pdf->Ln(5);

// Battery report============
$pdf->MultiCell(180,3,'Battery Test Report', 0, 'C', 0, 0, '', '', true,0,true);

$pdf->Ln(5);
$batsql=mysqli_query($con1,"select * from battery_report where alertid='".$row[0]."'");
$batrow=mysqli_fetch_array($batsql);
$battbl_header = '<table border="1" style=" border: 1px solid #000;border-radius: 7px;border: 1px solid #000;margin-left:80px;margin-right:10px;width:100%;" align="center">
<tr>
<td style="width:100px;min-width:100px;max-width:100px;padding: 7px; ">S No.</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;" >Battery Batch / Sl.No.</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;" >With Mains</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;" >Battery Mode</td>
</tr>
<tr>
<td style="width:100px;min-width:100px;max-width:100px;padding: 7px; ">1</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;" >'.$batrow[2].'</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;">'.$batrow[10].'</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;">'.$batrow[18].'</td>
</tr>
<tr>
<td style="width:100px;min-width:100px;max-width:100px;padding: 7px; ">2</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;">'.$batrow[3].'</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;">'.$batrow[11].'</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;">'.$batrow[19].'</td>
</tr>
<tr>
<td style="width:100px;min-width:100px;max-width:100px;padding: 7px; ">3</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;">'.$batrow[4].'</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;">'.$batrow[12].'</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;">'.$batrow[20].'</td>
</tr>
<tr>
<td style="width:100px;min-width:100px;max-width:100px;padding: 7px; ">4</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;">'.$batrow[5].'</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;">'.$batrow[13].'</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;">'.$batrow[21].'</td>
</tr>
<tr>
<td style="width:100px;min-width:100px;max-width:100px;padding: 7px; ">5</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;">'.$batrow[6].'</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;">'.$batrow[14].'</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;">'.$batrow[22].'</td>
</tr>
<tr>
<td style="width:100px;min-width:100px;max-width:100px;padding: 7px; ">6</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;">'.$batrow[7].'</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;">'.$batrow[15].'</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;">'.$batrow[23].'</td>
</tr>
<tr>
<td style="width:100px;min-width:100px;max-width:100px;padding: 7px; ">7</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;">'.$batrow[8].'</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;">'.$batrow[16].'</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;">'.$batrow[24].'</td>
</tr>
<tr>
<td style="width:100px;min-width:100px;max-width:100px;padding: 7px; ">8</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;">'.$batrow[9].'</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;">'.$batrow[17].'</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;">'.$batrow[25].'</td>
</tr>
</table>';

$xx = '<table><tr>
<td style="width:100px;min-width:100px;max-width:100px;padding: 7px; "></td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;"></td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;"></td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;"></td>
</tr>
</table>';

$pdf->writeHTML($battbl_header.$xx, true, false, false, false, '');

// ==========Site Image=========

//$pdf->Ln(2);
$siteimgsql=mysqli_query($con1,"select imgname from site_images where id=$alertid");
while($siteimgrow=mysqli_fetch_array($siteimgsql)){
$sitefile='andi/img/'.$siteimgrow[0];
}
$siteimg1='<img src="'.$sitefile.'" alt="Smiley face" height="200" width="200" align="center">';
$pdf->writeHTML($siteimg1, true, false, false, false, '');


//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');
?>
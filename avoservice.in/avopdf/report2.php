<?php
require_once('generatepdf/TCPDF-master/examples/tcpdf_include.php');
include('generatepdf/TCPDF-master/tcpdf.php');
include('../config.php');
$alertid=$_GET['aid'];
$sql=mysql_query("select * from alert where alert_id='".$alertid."'");
$row=mysql_fetch_array($sql);

$fsrsql=mysql_query("select * from FSR_details where alertid='".$alertid."'");
$fsrrow=mysql_fetch_array($fsrsql);

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
      $image_file ='AVO-Logo.png';
        $this->Image($image_file, 10, 10, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        
       $this->Cell(0, 10, 'Switching AVO Electro Power Limited', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$this->Ln();
$this->SetFont('helvetica', '', 10);
   $this->Cell(0, 5, 'H.O: 230 S.N.Roy Road, Kolkata- 700038', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$this->Ln();
$this->SetFont('helvetica', '', 10);
   $this->Cell(0, 5, 'Service Help Line-033-32017233 / 65181192/Fax: 033-24886047.Email-service3@avoups.com', 0, false, 'C', 0, '', 0, false, 'M', 'M');

$this->Ln();
$this->Cell(0, 5, 'FIELD SERVICE REPORT', 1,0,'C',false, '', 0, false, 'M', 'M');

//$htxc='FIELD SERVICE REPORT';
//$this->MultiCell(180,5,$htxc, 1, 'C',false,0, 0, '', '', true,0,true);
//$this->Ln(3);

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
$pdf->SetAuthor('Satyendra Sharma');
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
$pdf->SetFont('times', '', 10);

// add a page
$pdf->AddPage();

$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(255, 255, 127);

$pdf->Ln(5);
// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

// set some text for example

/* Multicell test
$w,$h,$txt,$border = 0,$align = ‘J’,$fill = false,$ln = 1,$x = “,$y = “,$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 0,$valign = ’T’,$fitcell = false */

$brsql=mysql_query("select name,phone from avo_branch where id='".$row[7]."'");
$brrow=mysql_fetch_array($brsql);
$avobranch=$brrow[0];
$docketno=$row[25];
$custsql=mysql_query("select cust_name from customer where cust_id='".$row[1]."'");
$custrow=mysql_fetch_array($custsql);

$customername=$custrow[0];

$address=$row[5];
$phn=$brrow[1];
if($row[21]=="site")
{
$atmsql=mysql_query("select atm_id from atm where track_id='".$row[2]."'");
$atmrow=mysql_fetch_array($atmsql);
$atmid=$atmrow[0];
$cs="Warranty";
}
else if($row[21]=="amc")
{
$atmsql=mysql_query("select atmid from Amc where amcid='".$row[2]."'");
$atmrow=mysql_fetch_array($atmsql);
$atmid=$atmrow[0];
$cs="AMC";
}
else{
$atmid=$row[2];
$cs="Temporary";
}

$pdf->MultiCell(95, 5, 'AVO Branch:'.$avobranch, 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(80, 5, 'AVO Docket No:'.$docketno, 0, 'L', 0, 0, '', '', true);
$pdf->Ln();
$pdf->MultiCell(95, 5, 'Name of Customer:'.$customername, 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(80, 5, 'ATM ID:'.$atmid, 0, 'L', 0, 0, '', '', true);
$pdf->Ln();
$pdf->MultiCell(95, 25,'Address:'.$address, 0, 'L', 0, 0, '', '', true,0,true);
$pdf->MultiCell(80, 5, 'Phone/Mobile:'.$phn, 0, 'L', 0, 0, '', '', true);

$calltype="<b>".$row[17]."</b>";
$servrendered=$row[17];
$pdf->Ln(30);
$pdf->MultiCell(90, 5, 'Date of Call :'.$row[10], 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(50, 5, 'Customer Status: '.$cs, 0, 'L', 0, 0, '', '', true);

$pdf->Ln(10);
$pdf->writeHTML("<hr>", true, false, false, false, '');
$pdf->MultiCell(180,5,'Call Type: '.$calltype, 1, 'L', 0, 0, '', '', true,0,true);
$pdf->Ln();
$pdf->MultiCell(180, 5, 'Service Rendered: '.$servrendered, 1, 'C', 0, 0, '', '', true);


$pdf->Ln(10);

$htmtab1='
<table border="1" width="90%" align="center">
<tr height="5px">
<td>
UPS Model
</td>
<td>
 UPS Capacity
</td>
<td>
 UPS Quantity
</td>
<td>
UPS Serial Number
</td>
<td>
Battery Specs

</td>
<td>
Number of batteries</td>
</tr>

<tr height="5px">
<td>
'.$fsrrow[3].'
</td>
<td>
'.$fsrrow[4].'
</td>
<td>
'.$fsrrow[5].'
</td>
<td>
'.$fsrrow[6].'
</td>
<td>
'.$fsrrow[7].'</td>
<td>
'.$fsrrow[8].'</td>
</tr>
</table>
';
//$pdf->MultiCell(180, 5,$htmtab1, 1, 'C', 0, 0, '', '', true);
$pdf->writeHTML($htmtab1, true, false, false, false, '');



//$pdf->Ln(2);
$pdf->MultiCell(180,3,'AC Voltages', 0, 'C', 0, 0, '', '', true,0,true);

$pdf->Ln(5);



$tbl_header = '<table border="1" style=" border: 1px solid #000;border-radius: 7px;border: 1px solid #000;margin-left:80px;margin-right:10px;width:100%;" align="center">
<tr>
<td style="width:170px;min-width:170px;max-width:170px;padding: 7px; ">Product Name</td>
<td style="width:216px;min-width:216px;max-width:216px; padding: 7px;" colspan="3">Input Voltages</td>
<td style="width:216px;min-width:216px;max-width:216px; padding: 7px;" colspan="3">Out Put Voltages</td>
</tr>
<tr>
<td style="width:170px;min-width:170px;max-width:170px;padding: 7px; "></td>
<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; ">L-N</td>
<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; ">L-E</td>
<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; ">N-E</td>

<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; ">L-N</td>
<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; ">L-E</td>
<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; ">N-E</td>
</tr>';
$tbl_footer = '
<tr>
<td style="width:170px;min-width:170px;max-width:170px;padding: 7px; ">DC Voltages </td>
<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; ">'.$fsrrow[16].'</td>
<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; ">Current</td>
<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; ">'.$fsrrow[17].'</td>
<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; "></td>
<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; "></td>
<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; "></td>

</tr>
<tr>
<td style="width:170px;min-width:170px;max-width:170px;padding: 7px; "></td>
<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; "></td>
<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; "></td>
<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; "></td>
<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; "></td>
<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; "></td>
<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; "></td>

</tr>
</table>';

$tbl="";
//for($i=0;$i<2;$i++)
//{
$tbl.='
<tr>
<td style="width:170px;min-width:170px;max-width:170px;padding: 7px; ">UPS</td>
<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; ">'.$fsrrow[10].'</td>
<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; ">'.$fsrrow[11].'</td>
<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; ">'.$fsrrow[12].'</td>
<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; ">'.$fsrrow[13].'</td>
<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; ">'.$fsrrow[14].'</td>
<td style="width:67px;min-width:67px;max-width:67px;padding: 7px; ">'.$fsrrow[15].'</td>
</tr>';
//}

$pdf->writeHTML($tbl_header . $tbl . $tbl_footer, true, false, false, false, '');
// Battery report
$pdf->MultiCell(180,3,'Battery Test Report', 0, 'C', 0, 0, '', '', true,0,true);

$pdf->Ln(5);
$batsql=mysql_query("select * from battery_report where alertid='".$row[0]."'");
$batrow=mysql_fetch_array($batsql);
$battbl_header = '<table border="1" style=" border: 1px solid #000;border-radius: 7px;border: 1px solid #000;margin-left:80px;margin-right:10px;width:100%;" align="center">
<tr>
<td style="width:100px;min-width:100px;max-width:100px;padding: 7px; ">S No.</td>
<td style="width:160px;min-width:160px;max-width:160px; padding: 7px;" >Battery Serial No.</td>
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

$engsql=mysql_query("select engineer from alert_delegation where alert_id='".$row[0]."'");
$engrow=mysql_fetch_array($engsql);
$avoengg=$engrow[0];
$engsql=mysql_query("select engg_name from area_engg where engg_id='".$avoengg."'");
$engrow=mysql_fetch_array($engsql);
$enggname=$engrow[0];
$feedsql=mysql_query("select feedback from eng_feedback where alert_id='".$row[0]."' order by id desc");
$feedrow=mysql_fetch_array($feedsql);
$image_file ='AVO-Logo.png';
$fsrimgsql=mysql_query("select * from fsr_images where alertid='".$row[0]."'");
$siteimgsql=mysql_query("select imgname from site_images where imgname like '".$row[0]."_%'");
$siteimgrow=mysql_fetch_array($siteimgsql);
$sitefile='../andi/images/'.$siteimgrow[0];
while($fsrimgrow=mysql_fetch_array($fsrimgsql))
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

$pdf->Ln();
$pdf->MultiCell(180,5,'Nature of Problem : '.$problem, 0, 'L', 0, 0, '', '', true,0,true);
$pdf->Ln();
//$pdf->writeHTML("<hr>", true, false, false, false, '');
$pdf->MultiCell(180,5,'Service Remark : '.$feedrow[0], 0, 'L', 0, 0, '', '', true,0,true);
$pdf->Ln();
$probsql=mysql_query("select problemtype from siteproblem where alertid='".$row[0]."'");
$probrow=mysql_fetch_array($probsql);


$htmtab2='
<table  width="90%">
<tr>
<td colspan="2">

</td>
</tr>
<tr>
<td colspan="2">

</td>
</tr>

<tr>
<td colspan="2">
Problem Type : ' .$probrow[0].'
</td>
</tr>

<tr>
<td colspan="2">
Time In: '.$row[24].'   <br>                                                                  Time Out : '.$row[18].' <br>
</td>
</tr>
<tr>
<td colspan="2">
The above mentioned Systems installed/Serviced by Engineer is found to be functioning & satisfactory.
</td>
</tr>

<tr>
<td>

 Engineer Name : '.$enggname.'<br>
  <img src="'.$enggfile.'" alt="Smiley face" height="80" width="150"> 
</td>
<td>

 Customer Signature: <br>
  <img src="'.$attnfile.'" alt="Smiley face" height="80" width="150"> 
</td>
</tr>



</table>';

$pdf->Ln(2);
//$pdf->MultiCell(180,5,$txt12, 0, 'L', 0, 0, '', '', true,0,true);
//$pdf->writeHTML("<hr>", true, false, false, false, '');
$pdf->writeHTML($htmtab2, true, false, false, false, '');

//$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

// ---------------------------------------------------------
$pdf->Ln(5);




$pdf->MultiCell(90,5,'Signature', 0, 'L', 0, 0, '', '', true,0,true);
$pdf->MultiCell(60,5,'Name & Sign By customer with seal', 0, 'R', 0, 0, '', '', true,0,true);
//$pdf->Ln(2);
$siteimg='<br><br><br><br><br><br><img src="'.$sitefile.'" alt="Smiley face" height="200" width="200" align="center"> ';
$pdf->writeHTML($siteimg, true, false, false, false, '');
//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

?>
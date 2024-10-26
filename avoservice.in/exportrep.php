<?php

ini_set('max_execution_time', 0);
    set_time_limit(0) ;


require_once 'Classes/PHPExcel.php';

require_once "Classes/PHPExcel/IOFactory.php";

include_once 'Classes/PHPExcel/Writer/Excel5.php';

// create new PHPExcel object
$objPHPExcel = new PHPExcel();



 
ini_set('memory_limit', '-1');
//Prevent your script from timing out

// This increases the excution time from 30 secs to 3000 secs.
//set_time_limit ( 3000 ); 


// writer already created the first sheet for us, let's get it
$objSheet = $objPHPExcel->getActiveSheet();

// rename the sheet
$objSheet->setTitle('MONTHLY REPORT');

for($col = 'A'; $col !== 'T'; $col++) {
    $objPHPExcel->getActiveSheet()
        ->getColumnDimension($col)
        ->setAutoSize(true);
}



$objSheet->setCellValue('A1', 'Complaint ID');
$objSheet->setCellValue('B1', 'Client Docket Number');
$objSheet->setCellValue('C1', 'Name');
$objSheet->setCellValue('D1', 'ATM');
$objSheet->setCellValue('E1', 'Bank');

$objSheet->setCellValue('F1', 'City');
$objSheet->setCellValue('G1', 'Area');
$objSheet->setCellValue('H1', 'Address ');
$objSheet->setCellValue('I1', 'State ');

$objSheet->setCellValue('J1', 'Problem');
$objSheet->setCellValue('k1', 'Alert Date');
$objSheet->setCellValue('L1', 'Contact Person');
$objSheet->setCellValue('M1', 'Phone');
$objSheet->setCellValue('N1', 'Engineer Name');
$objSheet->setCellValue('O1', 'Customer Status');
$objSheet->setCellValue('P1', 'Call close time');
$objSheet->setCellValue('Q1', 'Engineer Last FeedBack');
$objSheet->setCellValue('R1', 'Engineers FeedBack');
$objSheet->setCellValue('S1', 'Status');

include('config.php');
 $cid=$_POST['cid'];
 $fromdt=$_POST['fromdt'];
$todt=$_POST['todt'];
//echo "Select * from alert where cust_id='".$cid."' and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";
$qry="Select * from alert where cust_id='".$cid."'and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";
if($_POST['prob']!='')
$qry.=" and alert_id in(select alertid from siteproblem where probid ='".$_POST['prob']."')";
$table=mysqli_query($con1,$qry);


$excrow = 2;
while($row=mysqli_fetch_row($table))
{
if($row[2]!='temp_'){
	

	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);

	$tab=mysqli_query($con1,"select feedback,standby from eng_feedback where alert_id='".$row[0]."' order by id DESC");
	$row1=mysqli_fetch_row($tab);

	$engr=mysqli_query($con1,"select engg_name from area_engg where engg_id=(select engineer from alert_delegation where    alert_id='".$row[0]."' order by id DESC limit 1)");
	$engro=mysqli_fetch_row($engr);
           
           /*$contents.="\n".$row[25]."\t";
	 $contents.=$row[30]."\t";
	 $contents.=$custrow[0]."\t";*/
           
            $objSheet->setCellValueExplicitByColumnAndRow(0, $excrow , $row[25]);
	
         $objSheet->setCellValueExplicitByColumnAndRow(1, $excrow , $row[30]);
	 
	 $objSheet->setCellValueExplicitByColumnAndRow(2, $excrow , $custrow[0]);

if($row[17]=='new' || $row[17]=='new temp'){ 
$objSheet->setCellValueExplicitByColumnAndRow(3, $excrow , $row[2]);

} 
else 
{
if($row[17]=='service' &&  $row[21] ==  'amc')
$atm=mysqli_query($con1,"select atmid from Amc where amcid='".$row[2]."'");
	if($row[17]=='service' &&  $row[21] == 'site')
	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'");  
  $atmrow=mysqli_fetch_row($atm);
$objSheet->setCellValueExplicitByColumnAndRow(3, $excrow , $atmrow[0]);
   //$contents.=$atmrow[0];  
}
	
   	$contents.="\t";
    
	// print $contents;
	// $contents.=$row[3]."\t";
$objSheet->setCellValueExplicitByColumnAndRow(4, $excrow , $row[3]);

	 //$contents.=$row[27]."\t";
	// $contents.=$row[6]."\t";
$objSheet->setCellValueExplicitByColumnAndRow(5, $excrow , $row[6]);

$conre=preg_replace('/\s+/', ' ', $row[4]);
$objSheet->setCellValueExplicitByColumnAndRow(6, $excrow , $conre);
	// $contents.=$row[4]."\t";

$conrt=preg_replace('/\s+/', ' ', $row[5]);
$objSheet->setCellValueExplicitByColumnAndRow(7, $excrow, $conrt);
	// $contents.=$row[5]."\t";
	 
	  //$contents.=$row[27]."\t"
$objSheet->setCellValueExplicitByColumnAndRow(8, $excrow , $row[27]);

	   if($row[28]=='1')
 {

 $buy=mysqli_query($con1,"select * from buyback where alertid='".$row[0]."'");
 $buyro=mysqli_fetch_row($buy);

 $contents.=$buyro[2]."\t";
$objSheet->setCellValueExplicitByColumnAndRow(9, $excrow , $row[27]);
 }
 
 
$conty=preg_replace('/\s+/', ' ', $row[9]);
$objSheet->setCellValueExplicitByColumnAndRow(9, $excrow , $conty);

if($row[17]=='service' || $row[17]=='new temp')
{
 $contz= date('d/m/Y h:i:s a',strtotime($row[10])); 
$objSheet->setCellValueExplicitByColumnAndRow(10, $excrow , $contz);
} 
  else
  { 
  if(isset($row[11]) and $row[11]!='0000-00-00') 
  $contenz= date('d/m/Y h:i:s a',strtotime($row[11]));
$objSheet->setCellValueByColumnAndRow(10, $excrow , $contenz);
   }
  // $contents.="\t";

 //  $contents.=$row[12]."\t";
 $objSheet->setCellValueExplicitByColumnAndRow(11, $excrow ,$row[12]);
   // $contents.=$row[13]."\t";
 $objSheet->setCellValueExplicitByColumnAndRow(12, $excrow ,$row[13]);

   // $contents.=$engro[0]."\t";
 $objSheet->setCellValueExplicitByColumnAndRow(13, $excrow ,$engro[0]);
    
    if(0 === strpos($row[2], 'temp'))
 $objSheet->setCellValueExplicitByColumnAndRow(14, $excrow ,"PCB");
	//$contents.="PCB"."\t";
	else
 if($row[21]=='' || $row[21]=='site')
{ 
//$contents.="Under Warranty"."\t";
 $objSheet->setCellValueExplicitByColumnAndRow(14, $excrow ,"Under Warranty");
}else if($row[21]=='amc')
{ 
//$contents.="AMC"."\t";
 $objSheet->setCellValueExplicitByColumnAndRow(14, $excrow ,"AMC"); 
}else
{ 
//$contents.="PCB"."\t";
$objSheet->setCellValueExplicitByColumnAndRow(14, $excrow ,"PCB"); 
 }
// $contenz= ;
//$contents.=$row[18]."\t";
$objSheet->setCellValueExplicitByColumnAndRow(15, $excrow ,date('d/m/Y h:i:s a',strtotime($row[18]))); 

 if($row1[0]!='')
 {  $corty=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row1[0]));
$objSheet->setCellValueExplicitByColumnAndRow(16, $excrow ,$corty); 
 }else
 { 
$al=mysqli_query($con1,"select max(id),feedback from eng_feedback where alert_id='".$row[0]."'");
$alro=mysqli_fetch_row($al);
 $engf=preg_replace('/\s+/', ' ', $alro[1]);
$engf=str_replace("\n"," ",$alro[1]);
//$contents.=$engf;
$objSheet->setCellValueExplicitByColumnAndRow(16, $excrow ,$engf); 
 }
 $contents.="\t";
$a2=mysqli_query($con1,"select feedback from eng_feedback where alert_id='".$row[0]."' order by id ASC ");
$coryu="";
while($alro2=mysqli_fetch_row($a2))
{
$coryu.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $alro2[0])).",";

}
$objSheet->setCellValueExplicitByColumnAndRow(17, $excrow ,$coryu); 
//$contents.="\t";

//$contents.=$row[15];
$a3=mysqli_query($con1,"select up from alert_updates where alert_id='".$row[0]."' order by id ASC ");
$conuy="";
while($alro3=mysqli_fetch_row($a3))
{
$conuy.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $alro3[0])).",";

}
 $objSheet->setCellValueExplicitByColumnAndRow(18, $excrow ,$conuy); 
}

 $excrow++;



 } 
/*$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
 // header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=report.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;*/

header("Content-Disposition: attachment; filename=MONTHLYREPORT.xls");
 header("Content-Type: application/vnd.ms-excel");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
$objWriter->save("php://output");


?>
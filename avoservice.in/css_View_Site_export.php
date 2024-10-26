<?php

ini_set('max_execution_time', 0);
    set_time_limit(0) ;
    
  

include ('config.php');

$qry=$_POST['expqry'];
//echo $qry;

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

//rename the sheet
$objSheet->setTitle('Quotation detail');

 	
$objSheet->setCellValue('A1', 'Sr No');
$objSheet->setCellValue('B1', 'Complaint No');
$objSheet->setCellValue('C1', 'Client Docket Number');
$objSheet->setCellValue('D1', 'Name');
$objSheet->setCellValue('E1', 'ATM');
$objSheet->setCellValue('F1', 'Bank');

$objSheet->setCellValue('G1', 'State');
$objSheet->setCellValue('H1', 'Site Address');

$objSheet->setCellValue('I1', 'Problem');
$objSheet->setCellValue('J1', 'Date');
$objSheet->setCellValue('K1', 'Contact Person');

$objSheet->setCellValue('L1', 'Phone');
$objSheet->setCellValue('M1', 'Status');
$objSheet->setCellValue('N1', 'Call Close Date/time');

$objSheet->setCellValue('O1', 'Response Time');
$objSheet->setCellValue('P1', 'Delegated IN');
$objSheet->setCellValue('Q1', 'Delegated To');




$objSheet->getStyle('Q')->getAlignment()->setWrapText(true);
$sqry=mysqli_query($con1,$qry);
$num=mysqli_num_rows($sqry);


$count=0;
$srn=1;
$apptotamt=0;
$row = 2;
while($rowarr=mysqli_fetch_array($sqry))
{
if($rowarr[17]=='service' &&  $rowarr[21] ==  'amc')
$atm=mysqli_query($con1,"select atmid from Amc where amcid='".$rowarr[2]."'");
	if($rowarr[17]=='service' &&  $rowarr[21] == 'site')
	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$rowarr[2]."'");
if($rowarr[17]=='new')
$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$rowarr[2]."'");

$atmrow=mysqli_fetch_row($atm);
$qry3=mysqli_query($con1,"select cust_name from customer where cust_id='".$rowarr[1]."'");
$row3=mysqli_fetch_row($qry3);

	$oldeng=mysqli_query($con1,"select date from alert_delegation where alert_id='".$rowarr[0]."'");
$getold=mysqli_fetch_row($oldeng);
$time1 = strtotime($rowarr[10]);
$time2 = strtotime($getold[0]);

$diff = $time2-$time1;
$hours = $diff / 3600; // 3600 seconds in an hour
$minutes = ($hours - floor($hours)) * 60;
$final_hours = round($hours,0);
$final_minutes = round($minutes);//echo $final_hours. "/" .$final_minutes;



$objSheet->setCellValueByColumnAndRow(0, $row, $srn);
$objSheet->setCellValueByColumnAndRow(1, $row,$rowarr[25]);
$objSheet->setCellValueByColumnAndRow(2, $row,$rowarr[30]);
$objSheet->setCellValueByColumnAndRow(3, $row, $row3[0]);
if($rowarr[17]=='service'){
$objSheet->setCellValueByColumnAndRow(4, $row, $atmrow[0]);
}else{
$objSheet->setCellValueByColumnAndRow(4, $row,$rowarr[2]);
}
$objSheet->setCellValueByColumnAndRow(5, $row, $rowarr[3]);

$branch_avo=mysqli_query($con1,"select * from avo_branch where id='".$rowarr[7]."'");
$bravo=mysqli_fetch_row($branch_avo);
$objSheet->setCellValueByColumnAndRow(6, $row, $bravo[1]);

$objSheet->setCellValueByColumnAndRow(7, $row, $rowarr[5]);
$objSheet->setCellValueByColumnAndRow(8, $row,$rowarr[9] );
if($rowarr[17]=='new'){
$objSheet->setCellValueByColumnAndRow(9, $row, date('d/m/Y h:i:s a',strtotime($rowarr[11])));
}else{
$objSheet->setCellValueByColumnAndRow(9, $row, date('d/m/Y h:i:s a',strtotime($rowarr[10])));
}

$objSheet->setCellValueByColumnAndRow(10, $row, $rowarr[12]);
$objSheet->setCellValueByColumnAndRow(11, $row, $rowarr[13]);

if($rowarr[16]=='1'){
$pending="pending";
}
elseif($row[16]=='2'){
$pending="Waitng for Final Close";
}else{
$pending=$rowarr[16];
}
$objSheet->setCellValueByColumnAndRow(12, $row,$pending);
if(isset($rowarr[18]) and $rowarr[18]!='0000-00-00 00:00:00'){
$objSheet->setCellValueByColumnAndRow(13, $row,date('d/m/Y h:i a',strtotime($rowarr[18])));
}
if($rowarr[24]!='0000-00-00 00:00:00'){
$objSheet->setCellValueByColumnAndRow(14, $row,date('d/m/Y g:i:s a',strtotime($rowarr[24])));
}
if(mysqli_num_rows($oldeng)>0){
$finaltime=$final_hours. "h " .$final_minutes."m";
}
$objSheet->setCellValueByColumnAndRow(15, $row,$finaltime);

$oldeng=mysqli_query($con1,"select engineer from alert_delegation where alert_id='".$rowarr[0]."'");
$getold=mysqli_fetch_row($oldeng);
$fetchengid=mysqli_query($con1,"Select engg_name from area_engg where engg_id='".$getold[0]."'");
$getoldname=mysqli_fetch_row($fetchengid);

$objSheet->setCellValueByColumnAndRow(16, $row,$getoldname[0]);


$row++;
$srn++;
}


$lastrow= intval($srn)+intval(1);

//$objSheet->getStyle('A1:AD1')->getFont()->setBold(true)->setSize(12);
$highestRow = $objSheet->getHighestRow();
$objSheet->setCellValueByColumnAndRow(19,$lastrow,$apptotamt);




















 header("Content-Disposition: attachment; filename=delegatetime.xls");
 header("Content-Type: application/vnd.ms-excel");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
$objWriter->save("php://output");
?>
















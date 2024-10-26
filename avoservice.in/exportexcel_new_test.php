<?php

// include("config.php");
include("db_connection.php");

$con1 = OpenCon1();

$sqlme=$_POST['qr'];

$table=mysqli_query($con1,$sqlme);
$num_rows = mysqli_num_rows($table);

if($num_rows>0){
    
    require_once 'Classes/PHPExcel.php';

require_once "Classes/PHPExcel/IOFactory.php";

include_once 'Classes/PHPExcel/Writer/Excel5.php';

// create new PHPExcel object
$objPHPExcel = new PHPExcel();
 
ini_set('memory_limit', '-1');
//Prevent your script from timing out

$styleArray = array(
    'font'  => array(
        'color' => array('rgb' => 'FF0000'),
    ));
    
// writer already created the first sheet for us, let's get it
$objSheet = $objPHPExcel->getActiveSheet();

// rename the sheet
$objSheet->setTitle('New Invoices');

$objSheet->setCellValue('A1', 'Sr No');
$objSheet->getColumnDimension('A1')->setWidth(10);
$objSheet->setCellValue('B1', 'So Date');
$objSheet->setCellValue('C1', 'DO No.');
$objSheet->getColumnDimension('C1')->setWidth(10);
$objSheet->setCellValue('D1', 'Invoice No');
$objSheet->setCellValue('E1', 'Invoice Date');
$objSheet->setCellValue('F1', 'Invoice Value');
$objSheet->setCellValue('G1', 'Invoice Upload Time');
$objSheet->setCellValue('H1', 'Customer Verified');
$objSheet->setCellValue('I1', 'PO Number');
$objSheet->setCellValue('J1', 'Buyer Name & Address');
$objSheet->getColumnDimension('J1')->setWidth(10);
$objSheet->setCellValue('K1', 'End User');
$objSheet->setCellValue('L1', 'City');
$objSheet->setCellValue('M1', 'Address');
$objSheet->getColumnDimension('M1')->setWidth(10);
$objSheet->setCellValue('N1', 'Branch');
$objSheet->setCellValue('O1', 'Site/Sol/ATMID');
$objSheet->setCellValue('P1', 'Credit Note');
$objSheet->setCellValue('Q1', 'Credit Note Amount');
$objSheet->setCellValue('R1', 'Delivery Type');
$objSheet->setCellValue('S1', 'Installation Request');
$objSheet->setCellValue('T1', 'Delivery Mode');
$objSheet->getColumnDimension('T1')->setWidth(10);
$objSheet->setCellValue('U1', 'Courier');
$objSheet->getColumnDimension('U1')->setWidth(10);
$objSheet->setCellValue('V1', 'Docket No.');
$objSheet->getColumnDimension('V1')->setWidth(10);
$objSheet->setCellValue('W1', 'Estimated Delivery Date');
$objSheet->setCellValue('X1', 'Dispatch Date');
$objSheet->setCellValue('Y1', 'Delivery Date');
$objSheet->setCellValue('Z1', 'Invoice Status');
$objSheet->setCellValue('AA1', 'Call Ticket No.');
$objSheet->getColumnDimension('AA1')->setWidth(10);
$objSheet->setCellValue('AB1', 'Call Status');
$objSheet->setCellValue('AC1', 'Pre-Invoice Updates');
$objSheet->setCellValue('AD1', 'Post-Invoice Updates');

$i=1;
$row = 2;


while($sql_result = mysqli_fetch_assoc($table)){
    $id = $sql_result['po_id'];

  //============new_sale_order data====
    $newso= mysqli_query($con1,"select * from new_sales_order where so_trackid = '".$id."' ");
    $buyer_id = "";
    $po_idno = "";
    $cust_id = "";
    $branch_id = "";
    $del_type = "";
    $inst_request = "";
    if(mysqli_num_rows($newso)>0){
        $newso = mysqli_fetch_assoc($newso);
     
        $buyer_id = $newso['buyerid'];
        $po_idno = $newso['po_trackid'];
        $cust_id = $newso['po_custid'];
        $branch_id = $newso['branch_id'];
        $del_type = $newso['del_type'];
        $inst_request = $newso['inst_request'];
    }
    
    //=========PO No.======
    $po_no = mysqli_query($con1,"select po_no from purchase_order where id='".$po_idno."'");
    $po_no1_po_no = "";
    if(mysqli_num_rows($po_no)>0){
       $po_no1 = mysqli_fetch_assoc($po_no);   
       $po_no1_po_no = $po_no1['po_no'];
    }
        
    //========Customer======
    $cust_sql = mysqli_query($con1,"select cust_name from customer where cust_id = '".$cust_id."'");
    $cust_name = "";
    if(mysqli_num_rows($cust_sql)>0){
        $cust_sql_result = mysqli_fetch_assoc($cust_sql);
        $cust_name= $cust_sql_result['cust_name'];
    }

    //==============Branch==========
    $branch_sql = mysqli_query($con1,"select name from avo_branch where id = '".$branch_id."'");
    $branch="";
    if(mysqli_num_rows($branch_sql)>0){
        $branch_sql_result = mysqli_fetch_assoc($branch_sql);
        $branch=$branch_sql_result['name'];
    }

//================demo ATM

$demoatm= mysqli_query($con1,"select so_date,DO_no,bank_name,city,atm_id,address from demo_atm where so_id = '".$id."' ");
$demo_so_date = "";
$demo_DO_no = "";
$demo_bank_name = "";
$demo_city = "";
$demo_atm_id = "";
$demo_address = "";

if(mysqli_num_rows($demoatm)>0){
   $demo = mysqli_fetch_assoc($demoatm);  
   $demo_so_date = $demo['so_date'];
   $demo_DO_no = $demo['DO_no'];
   $demo_bank_name = $demo['bank_name'];
   $demo_city = $demo['city'];
   $demo_atm_id = $demo['atm_id'];
   $demo_address = $demo['address'];
}

//==========Buyer
$buyerqry = mysqli_query($con1,"select buyer_name, buyer_address from buyer where buyer_ID='".$buyer_id."'");
$buyerdata_name = "";
$buyerdata_address = "";
if(mysqli_num_rows($buyerqry)>0){
   $buyerdata = mysqli_fetch_assoc($buyerqry);
   $buyerdata_name = $buyerdata['buyer_name'];
   $buyerdata_address = $buyerdata['buyer_address'];
}

//====================
 if($sql_result['status'] == '1'){
      $status1 = "Pending";
} elseif ($sql_result['status'] == '2'){
      $status1 = "Closed";
} elseif ($sql_result['status'] == 'h'){
      $status1 = "On Hold";
} else $status1 = "Cancelled";

$alert_id = $sql_result['alert_id']; 

// if($alert_id==''){
//     $alert_id = '-';
// }else{
//     $alert_id;
// }
// echo $alert_id.'<br>';

$po_no1_text = "";
if($po_no1_po_no!=''){
  $po_no1_text = htmlspecialchars($po_no1_po_no);
}

$po_address_text = "";
if($demo_address!=''){
  $po_address_text = htmlspecialchars($demo_address);
}

$buy_address_text = "";
if($buyerdata_address!=''){
  $buy_address_text = htmlspecialchars($buyerdata_address);
}
    
$atmid1= $demo_atm_id;

if(is_numeric($atmid1)){ 
    $atmid ="'".''.$atmid1.'';
}else{ 
    $atmid=$atmid1; 
}    
    
//==============Alert Table==========


$alerttable= mysqli_query($con1,"select * from alert where alert_id = '".$alert_id."' ");
 $alertdata = mysqli_fetch_assoc($alerttable);

$call_ticket_no = $alertdata['createdby'];  //call ticket no


$alert_call_status = $alertdata['call_status'];  // call status
$alert_status = $alertdata['status'];

if($alert_call_status=="Done" or $alert_status=="Done"){
  $call_status="Closed" ;
}else if($alert_call_status=="1"){
    $call_status="Pending" ;
}else if($alert_call_status==""){
 $call_status="Not Assigned" ;
}else{
    $call_status=$alert_call_status;
}

//============== pre invoice ==============
/*
$qryupdate=mysqli_query($con1,"select * from SO_Update where so_id='".$id."' and remarks_type='1' ORDER BY updt_id DESC LIMIT 1 ");	
$n=mysqli_num_rows($qryupdate);

    if($n>0){
        while($rowUpdate=mysqli_fetch_array($qryupdate)){
            $pre_invoice = str_replace("\n","  ",preg_replace('/\s+/', ' ', $rowUpdate[3]));
        }
    }else{
            $dataaa="";
            $pre_invoice = str_replace("\n","  ",preg_replace('/\s+/', ' ', $dataaa));
    }
*/
//============= post invoice =====================
/*
$qryupdate2=mysqli_query($con1,"select * from SO_Update where so_id='".$id."' and remarks_type='2' ORDER BY updt_id DESC LIMIT 1");	
$n2=mysqli_num_rows($qryupdate2);

    if($n2>0){
        while($rowUpdate2=mysqli_fetch_array($qryupdate2)){
            $post_invoice = str_replace("\n"," ",preg_replace('/\s+/', ' ', $rowUpdate[3]));
        }
    }else{
            $dataaa2="";
            $post_invoice = str_replace("\n"," ",preg_replace('/\s+/', ' ', $dataaa2));
    } 
    */
    
    $post_invoice = ""; $pre_invoice = "";
    
    $bl="";
    $objSheet->setCellValueExplicitByColumnAndRow(0, $row, $i);
    $objSheet->setCellValueByColumnAndRow(1, $row, $demo_so_date);
    $objSheet->setCellValueByColumnAndRow(2, $row, $demo_DO_no);
    $objSheet->setCellValueByColumnAndRow(3, $row, $sql_result['inv_no']);
    $objSheet->setCellValueByColumnAndRow(4, $row,$sql_result['inv_date']);
    $objSheet->setCellValueByColumnAndRow(5, $row,$sql_result['inv_value']);
    $objSheet->setCellValueByColumnAndRow(6, $row,$sql_result['inv_img_time']);
    $objSheet->setCellValueByColumnAndRow(7, $row,$cust_name);
    $objSheet->setCellValueByColumnAndRow(8, $row,$po_no1_text);
    $objSheet->setCellValueByColumnAndRow(9, $row,$buyerdata_name."\n".$buy_address_text);
    $objSheet->setCellValueByColumnAndRow(10, $row,$demo_bank_name);
    $objSheet->setCellValueByColumnAndRow(11, $row, $demo_city);
    $objSheet->setCellValueByColumnAndRow(12, $row, $po_address_text);
    $objSheet->setCellValueByColumnAndRow(13, $row, $branch);
    $objSheet->setCellValueByColumnAndRow(14, $row,$demo_atm_id);
    $objSheet->setCellValueByColumnAndRow(15, $row,$atmid);
    $objSheet->setCellValueByColumnAndRow(16, $row,$sql_result['crn_no']);
    $objSheet->setCellValueByColumnAndRow(17, $row,$sql_result['crn_amount']);
    $objSheet->setCellValueByColumnAndRow(18, $row,$del_type);
    $objSheet->setCellValueByColumnAndRow(19, $row,$inst_request);
    $objSheet->setCellValueByColumnAndRow(20, $row,$sql_result['del_mode']);
    $objSheet->setCellValueByColumnAndRow(21, $row, $sql_result['courier']);
    $objSheet->setCellValueByColumnAndRow(22, $row, $sql_result['docketno']);
    $objSheet->setCellValueByColumnAndRow(23, $row, $sql_result['est_date']);
    $objSheet->setCellValueByColumnAndRow(24, $row,$sql_result['dis_date']);
    $objSheet->setCellValueByColumnAndRow(25, $row,$sql_result['del_date']);
    $objSheet->setCellValueByColumnAndRow(26, $row,$status1);
    $objSheet->setCellValueByColumnAndRow(27, $row,$call_ticket_no);
    $objSheet->setCellValueByColumnAndRow(28, $row,$call_status);
    $objSheet->setCellValueByColumnAndRow(29, $row,$pre_invoice);
    $objSheet->setCellValueByColumnAndRow(30, $row,$post_invoice);
    $objSheet->setCellValueByColumnAndRow(31, $row,$post_invoice);
    $objSheet->setCellValueByColumnAndRow(32, $row,$post_invoice);
    $objSheet->setCellValueByColumnAndRow(33, $row,$post_invoice);
    $objSheet->setCellValueByColumnAndRow(34, $row,$post_invoice);
    $objSheet->setCellValueByColumnAndRow(35, $row,$post_invoice);
    $objSheet->setCellValueByColumnAndRow(36, $row,$post_invoice);
    $objSheet->setCellValueByColumnAndRow(37, $row,$post_invoice);
    
 $row++;
$i++;
    
}

    $filename = "InvoiceData";
    
// header("Content-Disposition: attachment; filename=".$filename.".xlsx");
// header("Content-Type: application/vnd.ms-excel");
// header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
//$objWriter->save("php://output",'r');

header("Content-Disposition: attachment; filename=" . $filename . ".xls");
header("Content-Type: application/vnd.ms-excel");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save("php://output", 'r');

//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//$objWriter->save("php://output", 'r');
    
} else{
   echo 'No Data Found!';
}


/*
header("Content-Disposition: attachment; filename=" . $filename . ".xls");
header("Content-Type: application/vnd.ms-excel");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save("php://output", 'r');
*/

Closecon($con1);
?>
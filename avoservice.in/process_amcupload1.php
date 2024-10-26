<?php 
session_start();
include('config.php');
include('vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;


$target_dir = 'PHPExcel';
$file_name = $_FILES["images"]["name"];
$file_tmp = $_FILES["images"]["tmp_name"];
$file = $target_dir . '/' . $file_name;

move_uploaded_file($file_tmp, $file);

try {
    $spreadsheet = IOFactory::load($file);
} catch (Exception $e) {
    die('Error loading file "' . pathinfo($file, PATHINFO_BASENAME) . '": ' . $e->getMessage());
}



$sheet = $spreadsheet->getActiveSheet();
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();

if ($highestRow > 1000) {
    echo "You Can't Log more than 1000 Sites at a time";
}
//if ($highestColumn > 'N') {
//    echo "No of Columns are High";
//}

//$rowData = [];

for ($row = 2; $row <= $highestRow; $row++) {
    $rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, false);
}


$headerStyles = [
    'font' => [
        'bold' => true, // Make the text bold
        'color' => ['rgb' => 'FFFFFF'], // Font color (white)
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => '0070C0'], // Background color (blue)
    ],
    'borders' => [
        'outline' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => 'FF000000'], // Border color (black)
        ],
    ],
];


$headers = array(
    'S. No',
    'Site Id',
    'End User',
    'Area',
    'Pincode',
    'City',
    'State',
    'Branch',
    'Address',
    'AMC Start date',
    'Product',
    'Qty',
    'AMC Ex Date',
    'Status'
);


foreach ($headers as $index => $header) {
    $column = chr(65 + $index); // A, B, C, ...
    $sheet->setCellValue($column . '1', $header);
    $sheet->getStyle($column . '1')->applyFromArray($headerStyles); // Apply styles to the header cell
    $sheet->getColumnDimension($column)->setAutoSize(true); // Auto-fill column width
}


// Initialize the row counter

$i = 2; // Start from row 2 for data
$serial_number = 1; // Initialize the serial number

$cust=$_POST['cust'];
$po2=$_POST['po2'];
$service=$_POST['servicetype'];
$po_id=$_POST['po_id'];

$date = date('Y-m-d h:i:s');
$only_date = date('Y-m-d');
$user=$_SESSION['logid'];


foreach ($rowData as $row) {

// for($i = 1; $i<=$row; $i++){
        $s_no =  $rowData[$i][0][0];
        $site_id = $rowData[$i][0][1];
        $site_id = trim($site_id);
        $enduser  = $rowData[$i][0][2];
        $area = $rowData[$i][0][3];
        $pin = $rowData[$i][0][4];
        
        $city = $rowData[$i][0][5];
        $state = $rowData[$i][0][6];
        $branch = $rowData[$i][0][7];
        $add = $rowData[$i][0][8];
        $add = mysqli_real_escape_string ($con1,$add);
        $start = $rowData[$i][0][9];
        $product = $rowData[$i][0][10];
        $qty = $rowData[$i][0][11];
        $exp = $rowData[$i][0][12];

     $error = '';   
     $errcnt=0;   
         

 $start_date="0000-00-00";
    $UNIX_DATE = ($start - 25569) * 86400;
	if($UNIX_DATE>0){
 $start_date=gmdate("Y-m-d",$UNIX_DATE);
	} else {
	  $error.= "AMC start date format wrong";
    $errcnt++;   
	}
 
 $exp_date="0000-00-00";
    $UNIX_DATE2 = ($exp - 25569) * 86400;
	if($UNIX_DATE2>0){
 $exp_date=gmdate("Y-m-d",$UNIX_DATE2);
	} else {
	  $error.= "AMC Expiry date format wrong";
    $errcnt++;   
	}

// echo "Fileerrooor "; die;
 
$branch_qry=mysqli_query($con1,"select id from avo_branch where name='".$branch."'");
$br_row=mysqli_fetch_row($branch_qry);
$br_id=$br_row[0];
       
if($site_id ==''){
  $error.= "Site Id Not Found";
    $errcnt++;  
} 

elseif($br_id =='' ) {
    $error.= "Branch name not matching";
    $errcnt++;  

    
} elseif($start =='') { 
   $error.= "AMC start date is Missing";
    $errcnt++; 
} elseif ($exp == '') {
    $error.= "Expiry Date missing";
    $errcnt++;  
    } else {
        
//===============Get Exisiting data===================
$qry_his = "select amc_st_date from Amc where atmid='".$site_id."'";
$sqlhis = mysqli_query($con1, $qry_his);

if(mysqli_num_rows($sqlhis) >0)
{
$exist=mysqli_fetch_row($sqlhis);
$exist_date = $exist[0] ;
if($exist_date == $start_date){
   $errcnt++;
   $error.="AMC start date is already as per portal";  
}
}
}

//echo $error."ERROR"; die;

if ($errcnt==0) {
    
    
 $check=mysqli_query($con1,"select amcid from Amc where atmid='".$site_id."'");
	if(mysqli_num_rows($check)>0)
	{
         $existidrow=mysqli_fetch_row($check);
         $amc_id=$existidrow[0];
         
    $result=mysqli_query($con1,"update Amc set amc_st_date='".$start_date."',amc_ex_date='".$exp_date."',bankname='".$enduser."',city='".$city."',state='".$state."', address='".addslashes($add)."',cid='".$cust."',branch='".$br_id."', po='".$po2."' , active='Y' where amcid='".$amc_id."'");
    $error .="AMC Updated"; 
   //   mysqli_query($con1,"update Amc set amc_st_date='".$start_date."',amc_ex_date='".$exp_date."', active='Y' where amcid='".$amc_id."'");
          
//$qry=mysqli_query($con1,"update amcpurchaseorder set startdt='".$start_date."',expdt='".$exp_date."', po='".$po2."' where amcsiteid=='".$amc_id."')");
              //=============Get updateed ID=======
	}
	
	else{
	
	 $result= mysqli_query($con1,"INSERT INTO  Amc(po,cid,atmid,bankname,area,pincode,city,address,state,amc_st_date,amc_ex_date,branch, active, refid, ups,nou,upswar, battery,nob,batwar,isotrans,noiso,isowar,stabilizer, nostab,stabwar, AVR,noavr,avrwar,cat)VALUES('$po2','$cust','".$site_id."','".trim($area)."','".trim($city)."','".addslashes($add)."','".trim($state)."','".$start_date."', '".$exp_date."','".$br_id."','Y','','".$product."','".$qty."' ,'','','','','','','','','','','','','','' )");

$id=mysqli_insert_id($con1);
$error .="AMC Inserted"; 

// $qry=mysqli_query($con1,"INSERT INTO `amcpurchaseorder` (`id`, `cid`, `po`, `startdt`, `expdt`,`amcsiteid`) VALUES (NULL, '".$cust."', '".$po2."', '".$start_date."','".$exp_date."','".$id."')");
}   
if(!$result)    
$error .="Update / Insert Error"; 

}  else{

if($po_id !='') {
$abc=mysqli_query($con1,"update amc_po_new set upload_date='".$date."' , status=2 where po_id = '".$po_id."' ");

} 

}


    $sheet->setCellValue('A' . $i , $serial_number ) ; 
    $sheet->setCellValue('B' . $i , $site_id ) ;  
    $sheet->setCellValue('C' . $i , $enduser ) ; 
    $sheet->setCellValue('D' . $i , $area ) ;
    $sheet->setCellValue('E' . $i , $pin ) ; 
    $sheet->setCellValue('F' . $i , $city ) ; 
    
    $sheet->setCellValue('G' . $i , $state ) ; 
    $sheet->setCellValue('H' . $i , $branch ) ; 
    $sheet->setCellValue('I' . $i , $add ) ; 
    $sheet->setCellValue('J' . $i , $start ) ; 
    $sheet->setCellValue('K' . $i , $product ) ; 
    $sheet->setCellValue('L' . $i , $qty ) ; 
    $sheet->setCellValue('M' . $i , $exp ) ; 
    
 
    $sheet->setCellValue('N' . $i , $error ) ; 
   
    
    $i++;
    $serial_number++;

}


$writer = new Xlsx($spreadsheet);

$tempFile = tempnam(sys_get_temp_dir(), 'Inventory');
$writer->save($tempFile);

// Provide the file as a download to the user
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="amc_upload.xlsx"');
header('Cache-Control: max-age=0');
readfile($tempFile);
mysqli_close($con1);
unlink($tempFile);

//return ; 

echo '<pre>';
   print_r($rowData);
   echo '</pre>';
   die;
//return ; 

?>
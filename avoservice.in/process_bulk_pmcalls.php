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

//echo $file; die;

move_uploaded_file($file_tmp, $file);

try {
    $spreadsheet = IOFactory::load($file);
} catch (Exception $e) {
    die('Error loading file "' . pathinfo($file, PATHINFO_BASENAME) . '": ' . $e->getMessage());
}

$sheet = $spreadsheet->getActiveSheet();
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();

  if($highestRow > 100){ echo "You Can't Upload more than 100 sites at a time";
  die;}
 // if($highestColumn > N){ echo "No of Columns are High";
 // die;}
 
   for ($row = 1; $row <= $highestRow; $row++) { 
    $rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, 
                                    null, true, false);
  }

    $row = $row-2;
    
 $error = '';      
$contents='';
 $contents.="S.No\t ATM Id \t Contact person Name\t Number\t requirement\t Status \t Ticket Number";
 

    for($i = 1; $i<=$row; $i++){
     
     $error = '';   
     $errcnt=0;   
     
        $s_no =  $rowData[$i][0][0];
        $site_id = $rowData[$i][0][1];
        $contact  = $rowData[$i][0][2];
        $number = $rowData[$i][0][3];
        $problem = $rowData[$i][0][4];
        
   
 //  echo "Hello"; die; 

     $error = '';   
     $errcnt=0;   
     
//echo "Hello Site Id check".$site_id; die; 

      
 $atmqry=mysqli_query($con1,"select track_id from atm where atm_id='".$site_id."' and active='Y'");
 
  if(mysqli_num_rows($atmqry)==0){
     $atmqry=mysqli_query($con1,"select amcid from Amc where atmid='".$site_id."' and active='Y' "); 
  }

if(mysqli_num_rows($atmqry) == 0) {
     $error.= "Site Id Not Found";
    $errcnt++;
} elseif(strlen($contact) < 7 ) {
    $error.= "No Contact Person Name or Give Full Name";
    $errcnt++;  
} elseif(strlen($number) < 10) { 
   $error.= "No Contact Number or 10 Digits Must";
    $errcnt++; 
} elseif (!is_numeric($number)) {
    $error.= "Contact Number must be Numbers";
   $errcnt++;  
    } 
    else {
    
//===============Get History===================

$siterow = mysqli_fetch_row($atmqry);
$trackid=$siterow[0];

$tmb=date('Y-m-d 00:00:00', strtotime('-30 days'));
$ly=date('Y-m-d 00:00:00', strtotime('-1 year'));


$qry_his = "select alert_id, entry_date, call_status,status,alert_type,createdby from alert  where atm_id='$trackid' and entry_date > '".$ly."' order by alert_id DESC limit 5";
//echo $qry_his;

$sqlhis = mysqli_query($con1, $qry_his);
$rcnt = mysqli_num_rows($sqlhis);
$tmcnt = 0;
$stat=0;
while($rowe=mysqli_fetch_array($sqlhis))
{
if($rowe[1]>$tmb)$tmcnt++;

if($rowe[2]!='Done' && $rowe[2]!='Rejected' && $rowe[3]!='Done') {
$stat=1; }
}

if($stat==1){
    $errcnt++;
    $error.="call Still in open";
   
} else if($rcnt >4){
   $errcnt++;
    $error.="Repeated Call";
   
} else if($tmcnt > 0){
   $errcnt++;
    $error .="call_closed within 30 days";
   
} 
}
if ($errcnt>0) {
 
$contents.="\n".$s_no."\t";
$contents.=$site_id."\t";
$contents.=$contact."\t";
$contents.=$number."\t";
$contents.=$problem."\t";
$contents.=$error."\t";   
    
} else {
   ####======Start Logging=========

      $dt=date("Y-m-d H:i:s");
 	$qrr=mysqli_query($con1,"select * from alert where entry_date LIKE ('".date('Y-m-d')."%')");
	$num=mysqli_num_rows($qrr);
	$num2=$num+1;
	if($num2>0 && $num2<=9)
	$num3="0".$num2;
	else
	$num3=$num2;
	$user=$_SESSION['logid'];
	$createdby=$user."_".date("ymd").$num3;
$assetstat='';

$atmselqry=mysqli_query($con1,"select track_id,cust_id, branch_id, bank_name, city, area, pincode, address,po, state1 from atm where track_id='".$trackid."' ");
 $assetstat="site";
if(mysqli_num_rows($atmselqry)==0){
    
     $atmselqry=mysqli_query($con1,"select amcid, cid,branch,bankname,city,area,pincode,address,po,state from Amc where amcid='".$trackid."'"); 
     $assetstat="amc";
  }	
$sitedata=mysqli_fetch_row($atmselqry);

$track_id=$sitedata[0];
$cust_id= $sitedata[1];
$br_id= $sitedata[2];
$bank= $sitedata[3];
$city= $sitedata[4];
$area = $sitedata[5];
$pin = $sitedata[6];
$add = mysqli_real_escape_string($con1,$sitedata[7]);
$state = $sitedata[9];
$po = $sitedata[8];
//====
$approved = "system_generated";
$app_ref ="bulk_pm";
$sub = "PM call - ".$site_id;
$dock_no= "Bulk PM call log";
$whatsapp="";
$adate=date('Y-m-d');

	$sql = "INSERT INTO `alert` (`alert_id`, `cust_id`,`atm_id`, `bank_name`, `area`, `address`, `city`, `branch_id`, `pincode`, `problem`, `entry_date`, `alert_date`, `caller_name`, `caller_phone`, `caller_email`, `status`, `call_status`, `alert_type`, `standby`, `po`, `assetstatus`, `appby`, `appref`,`state1`,`createdby`,`subject`,`custdoctno`,`ccmail`,`whatsapp`) VALUES (NULL, '".$cust_id."','".$track_id."' , '".$bank."', '".$area."', '".$add."', '".$city."', '".$br_id."', '".$pin."', '".$problem."', '".$dt."', '".$adate."', '".$contact."', '".$number."', '".$mail."', 'Pending', 'Pending', 'pm', '', '".$po."','".$assetstat."', '".$approved."', '".$app_ref."','".$state."','".$createdby."','".$sub."','".$dock_no."','".$ccm."' ,'".$wnatsno."')";
	
//	echo $sql;

$insert=mysqli_query($con1,$sql);

$alert_id=mysqli_insert_id($con1);
if($insert) {
    $error .= "Success";
}

 
$contents.="\n".$s_no."\t";
$contents.=$site_id."\t";
$contents.=$contact."\t";
$contents.=$number."\t";
$contents.=$problem."\t";
$contents.=$error."\t";  
$contents.=$createdby."\t";  
}

}


$contents = strip_tags($contents); 
// return;

  header("Content-Disposition: attachment; filename=bulk_pm.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
?>  

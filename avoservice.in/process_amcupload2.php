<?php 
session_start();
include('config.php');
include('vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;


$cust=$_POST['cust'];
$po2=$_POST['po2'];
$service=$_POST['servicetype'];
$po_id=$_POST['po_id'];


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

  if($highestRow > 5000){ echo "You Can't Upload more than 5000 sites at a time";
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
 $contents.="S.No\t ATM Id \t Bank Name \t Area \t Pincode \t City \t State \t Branch \t Address \t Amc Start date \t Product \t Qty \t   AMC Expiry Date\t Status";
 

    for($i = 1; $i<=$row; $i++){
     
     $error = '';   
     $errcnt=0;   
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

//echo "Hello".$errcnt."Count--- Error:".$error; die;
if($errcnt>0){
// echo $s_no."-".$errcnt."Count--- Error:".$error."</br>"; 
    
$contents.="\n".$s_no."\t";
$contents.=$site_id."\t";
$contents.=$enduser."\t";
$contents.=$area."\t";
$contents.=$pin."\t";
$contents.=$city."\t";

$contents.=$state."\t";
$contents.=$branch."\t";
$contents.=$add."\t";
$contents.=$start_date."\t";
$contents.=$product."\t";
$contents.=$qty."\t";
$contents.=$exp_date."\t";
$contents.=$error."\t";   


} else {
 //  echo "".$errcnt."No ErrrCount--- No Error</br>";  
 $check=mysqli_query($con1,"select amcid from Amc where atmid='".$site_id."'");
	if(mysqli_num_rows($check)>0)
	{
         $existidrow=mysqli_fetch_row($check);
         $amc_id=$existidrow[0];
      
  //   echo $s_no."update Amc set amc_st_date='".$start_date."',amc_ex_date='".$exp_date."',bankname='".$enduser."',city='".$city."',state='".$state."', address='".addslashes($add)."',cid='".$cust."',branch='".$br_id."', po='".$po2."' , active='Y' where amcid='".$amc_id."' </br>";
     
   $result=mysqli_query($con1,"update Amc set amc_st_date='".$start_date."',amc_ex_date='".$exp_date."',bankname='".$enduser."',city='".$city."',state='".$state."', address='".addslashes($add)."',cid='".$cust."',branch='".$br_id."', po='".$po2."' , active='Y' where amcid='".$amc_id."'");
   
   // $result=mysqli_query($con1,"update Amc set amc_st_date='".$start_date."',amc_ex_date='".$exp_date."',cid='".$cust."',branch='".$br_id."', po='".$po2."' , active='Y' where amcid='".$amc_id."'");
    
    $error="AMC Updated"; //$error="AMC Updated";
   //   mysqli_query($con1,"update Amc set amc_st_date='".$start_date."',amc_ex_date='".$exp_date."', active='Y' where amcid='".$amc_id."'");
          
//$qry=mysqli_query($con1,"update amcpurchaseorder set startdt='".$start_date."',expdt='".$exp_date."', po='".$po2."' where amcsiteid=='".$amc_id."')");
              //=============Get updateed ID=======
	}
	
	else{

//echo $s_no." - INSERT INTO  Amc(po,cid,atmid,bankname,area,pincode,city,address,state,amc_st_date,amc_ex_date,branch, active, refid, ups,nou,upswar, battery,nob,batwar,isotrans,noiso,isowar,stabiliser, nostab,stabwar, AVR,noavr,avrwar,cat)VALUES('$po2','$cust','".$site_id."','".$enduser."', '".trim($area)."','".$pin."', '".trim($city)."','".addslashes($add)."','".trim($state)."','".$start_date."', '".$exp_date."','".$br_id."','Y','','".$product."','".$qty."' ,'','','','','','','','','','','','','','') </br>";
	 
	 $result= mysqli_query($con1,"INSERT INTO  Amc(po,cid,atmid,bankname,area,pincode,city,address,state,amc_st_date,amc_ex_date,branch, active, refid, ups,nou,upswar, battery,nob,batwar,isotrans,noiso,isowar,stabiliser, nostab,stabwar, AVR,noavr,avrwar,cat)VALUES('$po2','$cust','".$site_id."','".$enduser."', '".trim($area)."','".$pin."', '".trim($city)."','".addslashes($add)."','".trim($state)."','".$start_date."', '".$exp_date."','".$br_id."','Y','','".$product."','".$qty."' ,'','','','','','','','','','','','','','')");

$id=mysqli_insert_id($con1);
$error="AMC Inserted"; 

// $qry=mysqli_query($con1,"INSERT INTO `amcpurchaseorder` (`id`, `cid`, `po`, `startdt`, `expdt`,`amcsiteid`) VALUES (NULL, '".$cust."', '".$po2."', '".$start_date."','".$exp_date."','".$id."')");
}   

 


$contents.="\n".$s_no."\t";
$contents.=$site_id."\t";
$contents.=$enduser."\t";
$contents.=$area."\t";
$contents.=$pin."\t";
$contents.=$city."\t";

$contents.=$state."\t";
$contents.=$branch."\t";
$contents.=$add."\t";
$contents.=$start_date."\t";
$contents.=$product."\t";
$contents.=$qty."\t";
$contents.=$exp_date."\t";
$contents.=$error."\t";
    }
 
}
 
if($po_id !='') {
    $date=date('Y-m-d');
$abc=mysqli_query($con1,"update amc_po_new set upload_date='".$date."' , status=2 where po_id = '".$po_id."' ");
}


 // return;    
$contents = strip_tags($contents); 
// return;

  header("Content-Disposition: attachment; filename=AMC_upload.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
?>



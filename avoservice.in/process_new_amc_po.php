<?php
session_start();
//include("access.php");
include("config.php");


$userid=$_SESSION['user'];
$entry_date=date('Y-m-d H:i:s');
    $po= mysqli_real_escape_string($con1,$_POST['po']);
  $podate= $_POST['podate'];
  //$podate=date('Y-m-d', strtotime(str_replace('/','-',$podate1)));
 // echo $podate1;
 // echo $podate; bill_br
 
  $bill_br=$_POST['bill_br'];
  $saleperson= mysqli_real_escape_string($con1,$_POST['saleperson']);
  $billperiod= $_POST['billperiod'];
  $value= $_POST['value'];
  
  $buyer= mysqli_real_escape_string($con1,$_POST['buyer']);
  $buyer_add= mysqli_real_escape_string($con1,$_POST['buyer_add']);
  
  $bank= mysqli_real_escape_string($con1,$_POST['bank']);
  $cust= $_POST['cust'];
  $area= mysqli_real_escape_string($con1,$_POST['area']);
  $city= mysqli_real_escape_string($con1,$_POST['city']);
  $address= mysqli_real_escape_string($con1,$_POST['address']);
  $pincode= $_POST['pincode'];
  $state= $_POST['state'];
  $branch_avo= $_POST['branch_avo'];
  $atmid= mysqli_real_escape_string($con1,$_POST['atmid']);
  $pmtime= $_POST['pmtime'];
$start_date= $_POST['start_date'];
$exp_date= $_POST['exp_date'];

$sites= $_POST['sites'];
    $ups=$_POST['ups'];
    $upsno =$_POST['upsno'];
    $upsrate =$_POST['upsrate'];

$oth = mysqli_real_escape_string($con1,$_POST['oth']);
$othqty =$_POST['othqty'];
$othrate =$_POST['othrate'];


$maxsize='500';
$size=($_FILES["pofile"]["size"] / 1024);

$size1=($_FILES["data_file"]["size"] / 1024);


if($size>$maxsize && $size1>$maxsize)
{

?>
<script type="text/javascript">
	alert("File is too large. You can only upload ".$maxsize." KB . Please correct the file size");
	window.location='new_amc_po.php';
	</script> 
    
<?   }  else {



$result12=mysqli_query($con1,"insert into `amc_po_new`(po_no,no_sites,cust_id,po_date,buyer,buyer_add, saleperson, start_date, exp_date,pm_time, created_by, billperiod, amc_value,  created_at, bill_branch) VALUES ('".$po."','".$sites."','".$cust."',STR_TO_DATE('".$podate."','%d/%m/%Y'),'".$buyer."','".$buyer_add."', '".$saleperson."',STR_TO_DATE('".$start_date."','%d/%m/%Y'),STR_TO_DATE('".$exp_date."','%d/%m/%Y'),'".$pmtime."', '".$userid."','".$billperiod."','".$value."','".$entry_date."', '".$bill_br."')");

		 $amc_poid=mysqli_insert_id($con1);
		 
	$target_dir = "amc_po/";
$target_file = $target_dir . $amc_poid .$_FILES['invfile']['name']; //echo "PO--file:".$target_file ;


$target_dir1 = "amc_dat_new/";
$target_file1 = $target_dir1 . $amc_poid . $_FILES['data_file']['name']; //echo "DB--file:".$target_file1 ;

$uploadOk = 1;
	
		 
	 if(move_uploaded_file($_FILES["invfile"]["tmp_name"], $target_file)){          
          mysqli_query($con1,"UPDATE amc_po_new set po_file='".$target_file."' where po_id='".$amc_poid."'");
          }
	 if(move_uploaded_file($_FILES["data_file"]["tmp_name"], $target_file1)){          
          mysqli_query($con1,"UPDATE amc_po_new set data_file='".$target_file1."' where po_id='".$amc_poid."'");
    	 }
		 
		 if($result12){
		    
		   if($upsno>0)
	{
	 $addasset=mysqli_query($con1,"insert into `amc_assets_new` (`po_id`,`assets_name`,`specs`,`po_qty`,`rate`, `start_date`,`ex_date`) 
		   values('".$amc_poid."','UPS','".$ups."','".$upsno."','".$upsrate."', STR_TO_DATE('".$start_date."','%d/%m/%Y'),STR_TO_DATE('".$exp_date."','%d/%m/%Y'))"); 
	 }

	 if($othqty>0)
	{
	 $addasset=mysqli_query($con1,"insert into `amc_assets_new` (`po_id`,`assets_name`,`specs`,`po_qty`,`rate`, `start_date`,`ex_date`) 
		   values('".$amc_poid."','OTHERS','".$oth."','".$othqty."','".$othrate."', STR_TO_DATE('".$start_date."','%d/%m/%Y'), STR_TO_DATE('".$exp_date."','%d/%m/%Y'))"); 
	}}
//echo "insert into `new_amc_sites`(po_id, po_no, atm_id,cust_id,	branch_id, state, enduser,city.area,pincode,address,start_date,exp_date,pm_period,created_at) VALUES ('".$amc_poid."','".$po."','".$atmid."','".$cust."','".$branch_avo."', '".$state."','".$bank."', '".$city."','".$area."', '".$pincode."', '".$address."',  STR_TO_DATE('".$start_date."','%d/%m/%Y'), STR_TO_DATE('".$exp_date."','%d/%m/%Y'), '".$pmtime."')";

  
if($sites==1 && $atmid !='' ){

 $amcdata=mysqli_query($con1,"insert into `new_amc_sites`(po_id, po_no, atm_id,cust_id,	branch_id, state, enduser,city,area,pincode,address,start_date,exp_date,pm_period) VALUES ('".$amc_poid."','".$po."','".$atmid."','".$cust."','".$branch_avo."', '".$state."','".$bank."', '".$city."','".$area."', '".$pincode."', '".$address."',  STR_TO_DATE('".$start_date."','%d/%m/%Y'), STR_TO_DATE('".$exp_date."','%d/%m/%Y'), '".$pmtime."')");

} }

	
	if (!$amcdata && $addasset){
	?> 
	
	<script type="text/javascript">
	alert("Successfull Uploaded Bulk site PO");
	window.location='new_amc_po.php';
	</script> 
	<?} elseif ($amcdata){ ?>
	<script type="text/javascript">
	alert("Successfully Uploaded Single site PO");
	window.location='new_amc_po.php';
	</script>  
	    
	 <?   
	} echo "Failed";
	
	?>
	
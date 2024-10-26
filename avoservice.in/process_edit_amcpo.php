<?php
session_start();
//include("access.php");
include("config.php");

$po_id=$_POST['po_id'];

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
	window.location='edit_new_amcpo.php';
	</script> 
    
<?   }  else {



$result12=mysqli_query($con1,"update `amc_po_new` set po_no='".$po."' ,no_sites='".$sites."',cust_id='".$cust."',po_date=STR_TO_DATE('".$podate."','%d/%m/%Y'),buyer='".$buyer."',buyer_add='".$buyer_add."', saleperson='".$saleperson."', start_date=STR_TO_DATE('".$start_date."','%d/%m/%Y'), exp_date=STR_TO_DATE('".$exp_date."','%d/%m/%Y'),pm_time='".$pmtime."',  billperiod='".$billperiod."', amc_value='".$value."',  bill_branch='".$bill_br."' where po_id='".$po_id."'");

		 $amc_poid=$po_id;
//echo "update `amc_po_new` set po_no='".$po."' ,no_sites='".$sites."',cust_id='".$cust."',po_date=STR_TO_DATE('".$podate."','%d/%m/%Y'),buyer='".$buyer."',buyer_add='".$buyer_add."', saleperson='".$saleperson."', start_date=STR_TO_DATE('".$start_date."','%d/%m/%Y'), exp_date=STR_TO_DATE('".$exp_date."','%d/%m/%Y'),pm_time='".$pmtime."',  billperiod='".$billperiod."', amc_value='".$value."',  bill_branch='".$bill_br."' where po_id='".$po_id."'";
		 
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
		  
		  
		   $assetqry=mysqli_query($con1,"select * from amc_assets_new where po_id='".$po_id."' and assets_name='UPS'");
    
        if (mysqli_num_rows($assetqry) >0) {  
		   
	 $addasset=mysqli_query($con1,"update `amc_assets_new`set `assets_name`='UPS',`specs`='".$ups."',`po_qty`='".$upsno."',`rate`='".$upsrate."', `start_date`=STR_TO_DATE('".$start_date."','%d/%m/%Y'),`ex_date`=STR_TO_DATE('".$exp_date."','%d/%m/%Y') where po_id='".$po_id."'"); 
	
     } else {
		     $addasset=mysqli_query($con1,"insert into `amc_assets_new` (`po_id`, `assets_name`,`specs`,`po_qty`,`rate`, `start_date`,`ex_date`) 
		   values('".$amc_poid."', 'UPS','".$ups."','".$upsno."','".$upsrate."', STR_TO_DATE('".$start_date."','%d/%m/%Y'),STR_TO_DATE('".$exp_date."','%d/%m/%Y'))"); 
}
	
$othersqry=mysqli_query($con1,"select * from amc_assets_new where po_id='".$po_id."' and assets_name='OTHERS'");

if (mysqli_num_rows($othersqry) >0) {
	 $addasset=mysqli_query($con1,"update `amc_assets_new` set `assets_name`='OTHERS',`specs=`'".$oth."',`po_qty`='".$othqty."',`rate`='".$othrate."', `start_date`=STR_TO_DATE('".$start_date."','%d/%m/%Y'),`ex_date`=STR_TO_DATE('".$exp_date."','%d/%m/%Y') where po_id='".$po_id."'");
	
} else {
    $addasset=mysqli_query($con1,"insert into `amc_assets_new` (`po_id`,`assets_name`,`specs`,`po_qty`,`rate`, `start_date`,`ex_date`) 
		   values('".$amc_poid."', 'OTHERS','".$oth."','".$othqty."','".$othrate."', STR_TO_DATE('".$start_date."','%d/%m/%Y'), STR_TO_DATE('".$exp_date."','%d/%m/%Y'))"); 
	}
}

 $siteqry=mysqli_query($con1,"select * from new_amc_sites where po_id='".$po_id."'");
 if (mysqli_num_rows($siteqry) >0) { 

 $amcdata=mysqli_query($con1,"update `new_amc_sites` set po_no='".$po."' , atm_id='".$atmid."',cust_id= '".$cust."',	branch_id ='".$branch_avo."', state='".$state."', enduser='".$bank."',city='".$city."',area='".$area."',pincode='".$pincode."',address='".$address."',start_date=STR_TO_DATE('".$start_date."','%d/%m/%Y'),exp_date=STR_TO_DATE('".$exp_date."','%d/%m/%Y'),pm_period='".$pmtime."' where po_id='".$po_id."'");

//echo "update `new_amc_sites` set po_no='".$po."' , atm_id='".$atmid."',cust_id= '".$cust."',	branch_id ='".$branch_avo."', state='".$state."', enduser='".$bank."',city='".$city."',area='".$area."',pincode='".$pincode."',address='".$address."',start_date=STR_TO_DATE('".$start_date."','%d/%m/%Y'),exp_date=STR_TO_DATE('".$exp_date."','%d/%m/%Y'),pm_period='".$pmtime."' where po_id='".$po_id."'";
     
     
     
 } else {
    $amcdata=mysqli_query($con1,"insert into `new_amc_sites`(po_id, po_no, atm_id,cust_id,	branch_id, state, enduser,city,area,pincode,address,start_date,exp_date,pm_period) VALUES ('".$po_id."', '".$po."','".$atmid."','".$cust."','".$branch_avo."', '".$state."','".$bank."', '".$city."','".$area."', '".$pincode."', '".$address."',  STR_TO_DATE('".$start_date."','%d/%m/%Y'), STR_TO_DATE('".$exp_date."','%d/%m/%Y'), '".$pmtime."')");
    
//  echo  "insert into `new_amc_sites`(po_id, po_no, atm_id,cust_id,	branch_id, state, enduser,city,area,pincode,address,start_date,exp_date,pm_period) VALUES ('".$po_id."','".$po."','".$atmid."','".$cust."','".$branch_avo."', '".$state."','".$bank."', '".$city."','".$area."', '".$pincode."', '".$address."',  STR_TO_DATE('".$start_date."','%d/%m/%Y'), STR_TO_DATE('".$exp_date."','%d/%m/%Y'), '".$pmtime."')";
}

}

	
	if (!$amcdata && $addasset){
	?> 
	
	<script type="text/javascript">
	alert("Successfull Updated Bulk site PO");
	
	</script> 
	<?} elseif ($amcdata){ ?>
	<script type="text/javascript">
	alert("Successfully Updated Single site PO");
	window.location='amc_sales_order.php';
	</script>  
	    
	 <?   
	} echo "Failed";
	
	?>
	
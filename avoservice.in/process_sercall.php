<?php
session_start();
include("access.php");
include("config.php");

$user = $_SESSION['logid'];

 $site_id=$_POST['site_id'];
 $site_type =$_POST['stype'];
 $docket = $_POST['docket'];
 $sub= mysqli_real_escape_string($con1,$_POST['sub']);
 $contact= mysqli_real_escape_string($con1,$_POST['cphone']);
 $number= mysqli_real_escape_string($con1,$_POST['cname']);
 $cemail=$_POST['cemail'];
 $ccmail = $_POST['cc'];



   ####======Start Logging=========

      $dt=date("Y-m-d H:i:s");
 	$qrr=mysqli_query($con1,"select * from alert where entry_date LIKE ('".date('Y-m-d')."%')");
	$num=mysqli_num_rows($qrr);
	$num2=$num+1;
	if($num2>0 && $num2<=9)
	$num3="0".$num2;
	else
	$num3=$num2;
	$createdby=$user."_".date("ymd").$num3;

$assetstat=$site_type;

if($site_type == 'site'){
$atmselqry=mysqli_query($con1,"select track_id,cust_id, branch_id, bank_name, city, area, pincode, address,po, state1 from atm where track_id='".$site_id."' ");
 
} else {
    
     $atmselqry=mysqli_query($con1,"select amcid, cid,branch,bankname,city,area,pincode,address,po,state from Amc where amcid='".$site_id."'"); 
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
$approved = "HD team";
$app_ref ="Nil";
$sub = $sub;
$dock_no= $docket;
$whatsapp="";
$adate=date('Y-m-d');

	$sql = "INSERT INTO `alert` (`alert_id`, `cust_id`,`atm_id`, `bank_name`, `area`, `address`, `city`, `branch_id`, `pincode`, `problem`, `entry_date`, `alert_date`, `caller_name`, `caller_phone`, `caller_email`, `status`, `call_status`, `alert_type`, `standby`, `po`, `assetstatus`, `appby`, `appref`,`state1`,`createdby`,`subject`,`custdoctno`,`ccmail`,`whatsapp`) VALUES (NULL, '".$cust_id."','".$track_id."' , '".$bank."', '".$area."', '".$add."', '".$city."', '".$br_id."', '".$pin."', '".$problem."', '".$dt."', '".$adate."', '".$contact."', '".$number."', '".$cemail."', 'Pending', 'Pending', 'service', '', '".$po."','".$assetstat."', '".$approved."', '".$app_ref."','".$state."','".$createdby."','".$sub."','".$dock_no."','".$ccmail."' ,'".$wnatsno."')";
	
$insert=mysqli_query($con1,$sql);

$alert_id=mysqli_insert_id($con1);
if($insert) {
?>
<script type="text/javascript">
alert("Alert created successfully. Complain ID is: <?php echo $createdby; ?>");
window.location = "logcall.php";

</script>


<?  } else { ?> 
<script type="text/javascript">
alert("Something went wrong ");
window.location = "logcall.php";
</script>

<?php } ?>
<?php
session_start();
include('config.php');

$cid=$_POST['cid'];
$type=$_POST['type'];
$docket=$_POST['docket'];		
$sub=$_POST['sub'];
$prblm=$_POST['prob'];		
$caller=$_POST['cname'];
$con=$_POST['cphone'];
$email=$_POST['cemail'];
$appby=$_POST['appby'];
$ref=$_POST['ref'];
$cdate=$_POST['cdate'];
$qry=mysqli_query($con1,"select * from local_site where track_id='".$cid."'");
$roqry=mysqli_fetch_row($qry);

$qry2=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");
$qry2ro=mysqli_fetch_row($qry2);

$ast=$_POST['ast'];


$dt=date("Y-m-d H:i:s");
		
$qrr=mysqli_query($con1,"select * from alertlocal where entry_date LIKE ('".date('Y-m-d')."%')");
$num=mysqli_num_rows($qrr);
$num2=$num+1;
if($num2>0 && $num2<=9)
$num3="0".$num2;
else
$num3=$num2;

//echo "INSERT INTO `alertlocal` (`cust_id`,`atm_id`, `area`, `address`, `city`, `state`, `pincode`, `problem`, `entry_date`, `alert_date`, `caller_name`, `caller_phone`, `caller_email`, `status`, `call_status`, `alert_type`, `po`, `assetstatus`, `appby`, `appref`,`state1`,`createdby`,`custdoctno`,`subject`) VALUES ( '".$roqry[0]."','".$roqry[1]."','".$roqry[4]."','".$roqry[9]."','".$roqry[6]."','".$roqry[7]."','".$roqry[5]."','".$prblm."','".$cdate."','".$dt."', '".$caller."','".$con."','".$email."','Pending','Pending','service','".$roqry[11]."','".$type."','".$appby."','".$appby."','".$roqry[7]."','LS".$qry2ro[0]."_".date("ymd").$num3."','".$docket."','".$sub."')";
$complain="LS".$qry2ro[0]."_".date("ymd").$num3;
$sql = mysqli_query($con1,"INSERT INTO `alertlocal` (`cust_id`,`atm_id`, `area`, `address`, `city`, `state`, `pincode`, `problem`, `entry_date`, `alert_date`, `caller_name`, `caller_phone`, `caller_email`, `status`, `call_status`, `alert_type`, `po`, `assetstatus`, `appby`, `appref`,`state1`,`createdby`,`custdoctno`,`subject`) VALUES ( '".$roqry[0]."','".$roqry[1]."','".$roqry[4]."','".$roqry[9]."','".$roqry[6]."','".$roqry[7]."','".$roqry[5]."','".$prblm."','".$dt."','".$cdate."', '".$caller."','".$con."','".$email."','Pending','Pending','service','".$roqry[11]."','".$type."','".$appby."','".$ref."','".$roqry[7]."','LS".$qry2ro[0]."_".date("ymd").$num3."','".$docket."','".$sub."')");
	$row=mysqli_insert_id();
	if(!$sql)
		echo "Some Error Occoured";
		//echo "Alertlocal table : ".mysqli_error();
	for($i=0;$i<count($ast);$i++)
	{
		//echo "select * from assets_specification where ass_spc_id='".$this->assid[$i]."'";
		if(isset($ast[$i]))
		{
			$assets_detail_qry =mysqli_query($con1,"select * from installed_sitesmelocal where id ='".$ast[$i]."'");
			$assets_detail=mysqli_fetch_array($assets_detail_qry);
			//echo "Insert into alert_assetslocal(`alert_id`,`po`,`assets`,`qty`,`pm`) Values('".$row."','".$roqry[11]."','".$assets_detail['assets']."','".$assets_detail['qty']."','".$ast[$i]."')";
			$qry=mysqli_query($con1,"Insert into alert_assetslocal(`alert_id`,`po`,`assets`,`qty`,`pm`) Values('".$row."','".$roqry[11]."','".$assets_detail['assets']."','".$assets_detail['qty']."','".$ast[$i]."')");
			if(!$qry)
				echo "Some Error Occoured";
				//echo "alert_assetslocal table : ".mysqli_error();
		}
	}
?>
<script type="text/javascript">
	alert("Your Docket number is <?php echo $complain; ?>");
	window.location='localservice.php';
</script>
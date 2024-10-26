<?php
session_start();
include('config.php');

	$amcid=$_POST['amcid1'];
	$cust=$_POST['cust'];
	$po=$_POST['po'];
	$atmid=$_POST['ref']; //atmid
	$bank=$_POST['bank'];
	$area=$_POST['area'];
	$pin=$_POST['pin'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$add=$_POST['add'];
	$branch=$_POST['branch'];
	$sertype=$_POST['sertype'];
	$cat=$_POST['cat'];
	$stdate=$_POST['stdate'];
	
	
 	$sub=$_POST['sub'];
	$docket=$_POST['docket'];		
	$prob=$_POST['prob'];
	$cname=$_POST['cname'];
	$cphone=$_POST['cphone'];
	$cemail=$_POST['cemail'];
	$cemail=$_POST['cemail'];
	$cemail=$_POST['cemail'];
	


		//echo"INSERT INTO `non_deployment_assets`(`amcid`, `cid`, `po`, `atmid`, `bankname`, `area`, `pincode`, `city`, `state`, `address`,  `servicetype`, `state1`, `startdt`, `cat`) VALUES ('".$amcid."','".$cust."','".$po."','".$atmid."','".$bank."','".$area."','".$pin."','".$city."','".$branch."','".$add."','".$sertype."','".$state."','".$stdate."','".$cat."')";	
		
		$result1= mysqli_query($con1,"INSERT INTO `non_deployment_assets`(`amcid`, `cid`, `po`, `atmid`, `bankname`, `area`, `pincode`, `city`, `state`, `address`,  `servicetype`, `state1`, `startdt`, `cat`) VALUES ('".$amcid."','".$cust."','".$po."','".$atmid."','".$bank."','".$area."','".$pin."','".$city."','".$branch."','".$add."','".$sertype."','".$state."','".$stdate."','".$cat."')");
		
	


?>
<script type="text/javascript">
alert("You have updated successfully.");
window.location='non_deployment.php';
</script>

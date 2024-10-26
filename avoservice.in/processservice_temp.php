<?php
session_start();
include('config.php');

//echo $_SESSION['logid'];

//include("Whatsapp_delegation/delegation_fun.php");


//=============Function for distnace ====================================

function distance($lat1, $lon1, $lat2, $lon2, $unit) {
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return ($miles * 1.609344);
    } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }
}

function extract_email_address($string) {
    foreach(preg_split('/\s/', $string) as $token) {
        $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        if ($email !== false) {
            $emails[] = "<".$email.">";
        }
    }
    return $emails;
}

    $dt=date("Y-m-d H:i:s");
	$qrr=mysqli_query($con1,"select * from alert where entry_date LIKE ('".date('Y-m-d')."%')");
	$num=mysqli_num_rows($qrr);
	$num2=$num+1;
	if($num2>0 && $num2<=9)
	$num3="0".$num2;
	else
	$num3=$num2;
	

	
    $wnatsno=$_POST['whatsno'];
    
$createdby=$_SESSION['logid'];
	$createdby=$createdby."_".date("ymd").$num3;

	$chksql=mysqli_query($con1,"select alert_id from alert where createdby='".$createdby."'");
	if(mysqli_num_rows($chksql)>0){
	    echo "This docket no is already given";
	} else 
	{

$adate=date('Y-m-d');

$add=mysqli_real_escape_string($con1,$_POST['add']);
$prob= mysqli_real_escape_string($con1,$_POST['prob']);
$alert_type =$_POST['alert_type'];
$asset_type = $_POST['type'];



	$sql = mysqli_query($con1,"INSERT INTO `alert` (`alert_id`, `cust_id`,`atm_id`, `bank_name`, `area`, `address`, `city`, `branch_id`, `pincode`, `problem`, `entry_date`, `alert_date`, `caller_name`, `caller_phone`, `caller_email`, `status`, `call_status`, `alert_type`, `standby`, `po`, `assetstatus`, `appby`, `appref`,`state1`,`createdby`,`subject`,`custdoctno`,`ccmail`,`whatsapp`) VALUES (NULL, '".$_POST['cust']."','".$_POST['ref']."' , '".$_POST['bank']."', '".$_POST['area']."', '".$add."', '".$_POST['city']."', '".$_POST['branch']."', '".$_POST['pin']."', '".$prob."', '".$dt."', '".$adate."', '".$_POST['cname']."', '".$_POST['cphone']."', '".$_POST['cemail']."', 'Pending', 'Pending', '$alert_type', '', '".$_POST['po']."','".$asset_type."', '".$_POST['appby']."', '".$_POST['how']."','".$_POST['state']."','".$createdby."','".$_POST['sub']."','".$_POST['docket']."','".$ccm."' ,'".$wnatsno."')");
	
	$alert_id=mysqli_insert_id($con1);


$atm_id=$_POST['ref'];
 $cutoff_date=date('Y-m-d 00:00:00', strtotime('-30 days'));

$last="select alert_id, entry_date from alert where atm_id='$atm_id' and entry_date >'$cutoff_date' and entry_date < NOW() and call_status !='Rejected' order by alert_id DESC limit 5";

$sql2=mysqli_query($con1,$last);


if(mysqli_num_rows($sql2) > 0) {
 $rowre=mysqli_fetch_row($sql2);
 $repet=mysqli_query($con1,"update alert set repeat_callid='".$rowre[0]."' where alert_id='".$req."'");
}  
 
	if($sql){
	
	echo "<center><br><br><br>Call logged successfully, Docket no. is ".$createdby."<br><br> <a href=service1.php >click here</a> to log another call</center>";
	}
	else
	{
	echo "error , Please try again."."<a href=service1.php >click here</a>";
	}
	
	
    }// else close
	?>
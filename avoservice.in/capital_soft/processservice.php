<?php
include('config.php');
//$concs = Openconc();

include("Whatsapp_delegation/delegation_fun.php");


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
    $qry="";
    $stat=0;
$tmb=date('Y-m-d 00:00:00', strtotime('-30 days'));
$ly=date('Y-m-d 00:00:00', strtotime('-1 year'));
$id=$_POST['ref'];
if($_POST['type']=='amc'){
$qry="select b.atmid,a.address,a.state1,a.entry_date,a.problem,a.call_status,a.alert_id,a.status from alert a,Amc b where a.atm_id='$id' and a.entry_date>'$ly' and a.atm_id=b.amcid order by alert_id DESC limit 5";
//echo $qry;
}
if($_POST['type']=='site'){
$qry="select b.atm_id,a.address,a.state1,a.entry_date,a.problem,a.call_status,a.alert_id,a.status from alert a,atm b where a.atm_id='$id' and a.entry_date>'$ly' and a.atm_id=b.track_id order by alert_id DESC limit 5";
//echo $qry;
}

$sql=mysqli_query($concs,$qry);
$rcnt=mysqli_num_rows($sql);
$tmcnt=0;
while($row=mysqli_fetch_array($sql))
{
    if($row[3]>$tmb)$tmcnt++;
$bm=mysqli_query($concs,"select up from alert_updates where alert_id='".$row[6]."' order by id DESC limit 1");
$bmro=mysqli_fetch_row($bm);
$eng=mysqli_query($concs,"select feedback from eng_feedback where alert_id='".$row[6]."' order by id DESC limit 1");
$engro=mysqli_fetch_row($eng);
//echo $row[5];
if($row[5]!='Done' && $row[5]!='Rejected' && $row[7]!='Done')
$stat=1;
}
    if($stat==1){
        echo "Sorry you cannot log the call. Either Call already in OPEN "; }
       else{
            $dt=date("Y-m-d H:i:s");
        $qry2=mysqli_query($concs,"select cust_name from customer where cust_id='".$_POST['cust']."'");
        $qry2ro=mysqli_fetch_row($qry2);
        $created=explode(' ',$qry2ro[0]);
        $creat=$created[0];
        if($creat==''){$creat=$qry2ro[0];}
        
        if($_POST['type']=='site'){
	$at=mysqli_query($concs,"select atm_id from atm where track_id='".$_POST['ref']."'");
	//echo "select track_id from atm where atm_id='".$_POST['ref']."'";
	}
	else if($_POST['type']=='amc'){
	$at=mysqli_query($concs,"select atmid from Amc where amcid='".$_POST['ref']."'");
	//echo "select amcid from Amc where atmid='".$_POST['ref']."'";
	}
	
	$atro=mysqli_fetch_row($at); /*echo "ATM -".$atro[0];*/
   
	$qrr=mysqli_query($concs,"select * from alert where entry_date LIKE ('".date('Y-m-d')."%')");
	$num=mysqli_num_rows($qrr);
	$num2=$num+1;
	if($num2>0 && $num2<=9)
	$num3="0".$num2;
	else
	$num3=$num2;
	
 // echo $num3;
	//echo "hi";
	
    $wnatsno=$_POST['whatsno'];
    $call_type=$_POST['call_type'];
    
	$ccm=implode(",",extract_email_address($_POST['ccemail']));
	$ccm=str_replace("<","",$ccm);
	$ccm=str_replace(">","",$ccm);
	$createdby=$creat."_".date("ymd").$num3;
	$chksql=mysqli_query($concs,"select alert_id from alert where createdby='".$createdby."'");
	if(mysqli_num_rows($chksql)==0)
	{

$adate=date('Y-m-d');

	$sql = mysqli_query($concs,"INSERT INTO `alert` (`alert_id`, `cust_id`,`atm_id`, `bank_name`, `area`, `address`, `city`, `branch_id`, `pincode`, `problem`, `entry_date`, `alert_date`, `caller_name`, `caller_phone`, `caller_email`, `status`, `call_status`, `alert_type`, `standby`, `po`, `assetstatus`, `appby`, `appref`,`state1`,`createdby`,`subject`,`custdoctno`,`ccmail`,`whatsapp`) VALUES (NULL, '".$_POST['cust']."','".$_POST['ref']."' , '".$_POST['bank']."', '".$_POST['area']."', '".$_POST['add']."', '".$_POST['city']."', '".$_POST['branch']."', '".$_POST['pin']."', '".$_POST['prob']."', '".$dt."', '".$adate."', '".$_POST['cname']."', '".$_POST['cphone']."', '".$_POST['cemail']."', 'Pending', 'Pending', '".$call_type."', '', '".$_POST['po']."','".$_POST['type']."', '".$_POST['appby']."', '".$_POST['how']."','".$_POST['state']."','".$creat."_".date("ymd").$num3."','".$_POST['sub']."','".$_POST['docket']."','".$ccm."' ,'".$wnatsno."')");
	
	$alert_id=mysqli_insert_id($concs);


$atm_id=$_POST['ref'];
 $cutoff_date=date('Y-m-d 00:00:00', strtotime('-30 days'));

$last="select alert_id, entry_date from alert where atm_id='$atm_id' and entry_date >'$cutoff_date' and entry_date < NOW() and call_status !='Rejected' order by alert_id DESC limit 5";

$sql2=mysqli_query($concs,$last);


if(mysqli_num_rows($sql2) > 0) {

 $rowre=mysqli_fetch_row($sql2);

 $repet=mysqli_query($concs,"update alert set repeat_callid='".$rowre[0]."' where alert_id='".$req."'");
  
}   
 
	if($sql){
	
	echo "<center><br><br><br>Call logged successfully, Docket no. is ".$creat."_".date("ymd").$num3."<br><br> <a href=service.php >click here</a> to log another call</center>";
	}
	else
	{
	echo "error , Please try again."."<a href=service.php >click here</a>";
	}
	
	}
	
    }
	?>
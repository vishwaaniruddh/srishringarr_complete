<?php
error_reporting(-1);
include("../config.php");

$srno = $_GET['id']; // login Id
$site_id = $_GET['siteid']; // Site Id 
$problem = $_GET['prob']; // Problem 
$cont_name = $_GET['c_name']; // Contact Name
$cont_no = $_GET['c_no']; // Contact No
$mail = $_GET['mail']; // Contact No

$result = mysqli_query($con1, "select * from login where srno='".$srno."' and status=1");
if(mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_row($result);
    
    
  //====Get Site data ========
  
$clientqr=mysqli_query($con1,"select client from clienthandle where logid='".$row[0]."'");
$clientrow=mysqli_fetch_row($clientqr);

$userfull=explode(" ",$clientrow[0]);
$user = $userfull[0];
if($user == ''){
$user=$clientrow[0];}

$custqr=mysqli_query($con1,"select cust_id from customer where cust_name='".$clientrow[0]."'");
$custr = mysqli_fetch_row($custqr);

//echo "select track_id from atm where atm_id='".$site_id."' and active='Y' and cust_id='".$custr[0]."'";

$atmqry=mysqli_query($con1,"select track_id from atm where atm_id='".$site_id."' and active='Y' and cust_id='".$custr[0]."'");
 
  if(mysqli_num_rows($atmqry)==0){
     $atmqry=mysqli_query($con1,"select amcid from Amc where atmid='".$site_id."' and active='Y' and cid='".$custr[0]."'"); 
  }
//==If site is in AMC / Warr=========
if(mysqli_num_rows($atmqry) >0) { 
//===============Get History===================

$siterow = mysqli_fetch_row($atmqry);
$trackid=$siterow[0];

$tmb=date('Y-m-d 00:00:00', strtotime('-30 days'));
$ly=date('Y-m-d 00:00:00', strtotime('-1 year'));

//echo " 1 Year:".$ly." 3 Months:".$tmb; 

$qry_his = "select alert_id, entry_date, call_status,status,alert_type,createdby from alert  where atm_id='$trackid' and entry_date > '".$ly."' order by alert_id DESC limit 5";
//echo $qry_his;

$sqlhis = mysqli_query($con1, $qry_his);
$rcnt = mysqli_num_rows($sqlhis);
$tmcnt = 0;
$stat=0;
while($rowe=mysqli_fetch_array($sqlhis))
{
if($rowe[1]>$tmb)$tmcnt++;

//echo "call_status".$rowe[2]."-status-".$rowe[3]."-created-".$rowe[5];
if($rowe[2]!='Done' && $rowe[2]!='Rejected' && $rowe[3]!='Done') {
$stat=1; }
}

//echo "Open: ".$stat."-Tot--".$rcnt."--30 days--".$tmcnt;

if($stat==1){
    $str = '-1';
    $error="call_open";
    $data = ['code'=>201,'data'=>$error];
} else if($rcnt >4){
    $str = '-1';
    $error="repeated_failure";
    $data = ['code'=>201,'data'=>$error];
} else if($tmcnt > 0){
    $str = '-1';
    $error="call_close_30";
    $data = ['code'=>201,'data'=>$error];
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
$app_ref ="api_through";
$sub = "Call log throgh API";
$dock_no= "Call log throgh API";
$whatsapp="";
$adate=date('Y-m-d');

	$sql = "INSERT INTO `alert` (`alert_id`, `cust_id`,`atm_id`, `bank_name`, `area`, `address`, `city`, `branch_id`, `pincode`, `problem`, `entry_date`, `alert_date`, `caller_name`, `caller_phone`, `caller_email`, `status`, `call_status`, `alert_type`, `standby`, `po`, `assetstatus`, `appby`, `appref`,`state1`,`createdby`,`subject`,`custdoctno`,`ccmail`,`whatsapp`) VALUES (NULL, '".$cust_id."','".$track_id."' , '".$bank."', '".$area."', '".$add."', '".$city."', '".$br_id."', '".$pin."', '".$problem."', '".$dt."', '".$adate."', '".$cont_name."', '".$cont_no."', '".$mail."', 'Pending', 'Pending', 'service', '', '".$po."','".$assetstat."', '".$approved."', '".$app_ref."','".$state."','".$createdby."','".$sub."','".$dock_no."','".$ccm."' ,'".$wnatsno."')";
	
//	echo $sql;

$insert=mysqli_query($con1,$sql);

$alert_id=mysqli_insert_id($con1);
//====Repeat call mark======
 $cutoff_date=date('Y-m-d 00:00:00', strtotime('-30 days'));

$last="select alert_id, entry_date from alert where atm_id='$site_id' and entry_date >'$cutoff_date' and entry_date < NOW() and call_status !='Rejected' order by alert_id DESC limit 5";

$sql2=mysqli_query($con1,$last);

if(mysqli_num_rows($sql2) > 0) {
 $rowre=mysqli_fetch_row($sql2);

 $repet=mysqli_query($con1,"update alert set repeat_callid='".$rowre[0]."' where alert_id='".$alert_id."'");
} 

if($insert) {
$str = ['compid' => $createdby, 'atmid' => $site_id];

 $data = ['code'=>200,'data'=>$str];     
 } else {  $str = -1;
         $error="insert_error";
         $data = ['code'=>201,'data'=>$error] ;
}
}
     
    
    
  }else {
         $str = -1;
         $error="data_notfound";
         $data = ['code'=>201,'data'=>$error];
    }
}  else { 
         $str = -1;
         $error="login_wrong";
         $data = ['code'=>201,'data'=>$error];
}

    echo json_encode($data);
mysqli_close($con1);   
?>

<?php
session_start();
include("config.php");

$siteid=$_GET['id'];
$site=$_GET['site'];
$engg_id=$_GET['engg'];


//===============Get History===================
$tmb=date('Y-m-d 00:00:00', strtotime('-60 days'));
$ly=date('Y-m-d 00:00:00', strtotime('-1 year'));


$qry_his = "select alert_id, entry_date, call_status,status,alert_type,createdby from alert  where atm_id='$siteid' and entry_date > '".$ly."' order by alert_id DESC limit 6";

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

if($stat==1){
    
    $result .="Still Call Open";
   } else if($rcnt >6){
    $str = '-2';
    $result.="repeated_failure";
   
} else if($tmcnt > 0){
    
    $result.="Last Call attended within 60 Days";
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
	$createdby=$_SESSION['logid']."_".date("ymd").$num3;


if($site=='site'){
$atmselqry=mysqli_query($con1,"select track_id,cust_id, branch_id, bank_name, city, area, pincode, address,po, state1 from atm where track_id='".$siteid."' ");
} 
else if($site=='amc') {
    $atmselqry=mysqli_query($con1,"select amcid, cid,branch,bankname,city, area, pincode, address, po, state from Amc where amcid='".$siteid."'"); 
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
$problem="PM Call by Self";
$approved = "Self_user";
$app_ref ="Self Engineer";
$sub = "Call log by Engineer";
$dock_no= "PM Call by Self";
$whatsapp="";
$adate=date('Y-m-d');
//=new table alert_mail========
	$sql = "INSERT INTO `alert` (`alert_id`, `cust_id`,`atm_id`, `bank_name`, `area`, `address`, `city`, `branch_id`, `pincode`, `problem`, `entry_date`, `alert_date`, `caller_name`, `caller_phone`, `caller_email`, `status`, `call_status`, `alert_type`, `standby`, `po`, `assetstatus`, `appby`, `appref`,`state1`,`createdby`,`subject`,`custdoctno`,`ccmail`,`whatsapp`) VALUES (NULL, '".$cust_id."','".$track_id."' , '".$bank."', '".$area."', '".$add."', '".$city."', '".$br_id."', '".$pin."', '".$problem."', '".$dt."', '".$adate."', '".$cont_name."', '".$cont_no."', '".$mail."', 'Pending', 'Pending', 'pm', '', '".$po."','".$site."', '".$approved."', '".$app_ref."','".$state."','".$createdby."','".$sub."','".$dock_no."','".$ccmail."' ,'".$whatsno."')";

//echo $sql;

$insert=mysqli_query($con1,$sql);
$alert_id=mysqli_insert_id($con1);

$delqry="INSERT INTO alert_delegation (engineer, atm, alert_id, status, date, delby, call_close_status) VALUES ('".$engg_id."','".$track_id."','".$alert_id."','0','".$dt."','".$_SESSION['user']."','0')";

$del=mysqli_query($con1,$delqry); 
$delid=mysqli_insert_id($con1);
if($del) {
    $del_up=mysqli_query($con1,"UPDATE alert set status='Delegated', call_status='1' where alert_id ='".$alert_id."'");
}
       
   }
if($insert) {
$result.="Logged Successfully. Ticket:".$createdby;
 } else {  
         $result.="Some Error occured";
        }
echo $result;     

mysqli_close($con1);   
?>

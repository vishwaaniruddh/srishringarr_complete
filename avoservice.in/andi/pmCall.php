<?php
include("../config.php");
include_once 'GCM.php';

$php_atm_Id         = $_POST['post_atm_Id'];
$php_ups_capacity   = $_POST['post_ups_capacity'];
$php_ups_status     = $_POST['post_ups_status'];
$php_battery_qty    = $_POST['post_battery_qty'];
$php_battery_ah     = $_POST['post_battery_ah'];
$php_battery_make   = $_POST['post_battery_make'];
$php_backupobserved = $_POST['post_backupobserved'];
$php_battery_status = $_POST['post_battery_status'];
$php_weak_qty       = $_POST['post_weak_qty'];
$php_mac_id         = $_POST['post_mac_id'];
$php_up_time        = $_POST['post_up_time'];
$php_post_latitude  = $_POST['post_latitude'];
$php_post_longitude = $_POST['post_longitude'];
$post_upsMake= $_POST['post_upsMake'];
$post_address= urldecode($_POST['post_address']);


//=========For branch id 
	//echo "select branch from Amc where atmid='".$php_atm_Id."'";
    	/*$atm=mysql_query("select branch from Amc where atmid='".$php_atm_Id."'");
	
	if(mysql_num_rows($atm)==0){
	//echo "select  branch_id from atm where atm_id='".$php_atm_Id."'";
	$atm=mysql_query("select branch_id  from atm where atm_id='".$php_atm_Id."'");
	}
	$atmbranch=mysql_fetch_row($atm);*/
//==============

	$resultx=mysql_query("select logid from notification_tble where mac_id='".$php_mac_id."'");
	$rowx=mysql_fetch_row($resultx);
	
	$branchid=mysql_query("select `area`,`engg_name` from `area_engg` where `loginid`='".$rowx[0]."'");
	$branchid1=mysql_fetch_row($branchid);
$udate=date('Y-m-d');
$my1=mysql_query("select max(udate) from Pmcalls where AtmId='".$php_atm_Id."'");
$row11=mysql_fetch_row($my1);
$ldate=strtotime($row11[0]);
$now = strtotime($udate);
$datediff = floor(($now - $ldate)/(60 * 60 * 24));

if($datediff>30){
$query  = ("INSERT INTO  Pmcalls(`AtmId`,`UpsCapacity`,`UpsStatus`, `BatteryQty`, `BatteryAh`, `BatteryMake`,`BackupObserved`,`BatteryStatus`,`WeakQty`, `engId`, `Uptime`, `lat`, `longi`,`branch_id`,`udate`,`ups_make`,`pm_address`) VALUES                                                                                               ('".$php_atm_Id."','".$php_ups_capacity."','".$php_ups_status."','".$php_battery_qty."','".$php_battery_ah."','".$php_battery_make."','".$php_backupobserved."', '".$php_battery_status."', '".$php_weak_qty."','".$rowx[0]."','".$php_up_time."','".$php_post_latitude."','".$php_post_longitude."','".$branchid1[0]."','".$udate."','".$post_upsMake."','".$post_address."')");

$result = mysql_query($query);
//echo $result;





if($result >0)
	{
	    
                $response["result"] = "success";	
		
		echo json_encode($response); 

	}       
else
        {
        	
                $response["result"] = "error";	
		
		echo json_encode($response); 
        }
           
mysqli_close($conn);




if(!startsWith($php_atm_Id, 'temp') and $php_post_latitude!=0.0 and $php_post_longitude!=0.0){
$sqlatm=mysql_query("select track_id from atm where atm_id='".$php_atm_Id."'");
if(mysql_num_rows($sqlatm)>0)
{
 $rowatm=mysql_fetch_row($sqlatm);
 mysql_query("insert into site_location values('".$rowatm[0]."','".site."','".$php_post_latitude."','".$php_post_longitude."')");
}
else
 {
 $sqlatm=mysql_query("select AMCID from Amc where ATMID='".$php_atm_Id."'");
 if(mysql_num_rows($sqlatm)>0)
{
 $rowatm=mysql_fetch_row($sqlatm);
 mysql_query("insert into site_location values('".$rowatm[0]."','".amc."','".$php_post_latitude."','".$php_post_longitude."')");
}
 }
                                                        }
//echo $query;
$qryx=mysql_query("Insert into avo_attendence(eng,present,attend_date,branch_id) Values('".$branchid1[1]."','P','".$udate."','".$branchid1[0]."')");

 

 }

?>
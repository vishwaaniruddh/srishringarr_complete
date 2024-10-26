<?php
include('../config.php');
//$arr=array();
//$mac_id=$_GET['mac_id'];
$android_id=$_GET['android_id'];
$sqlqry=("Select * from notification_tble where (mac_id='".$android_id."') and status=0");

 $res=mysqli_query($con1, $sqlqry);
if(mysqli_num_rows($res)>0)
{
	$str=array();
	$d=date("Y-m-d");
	$dt=date("Y-m-d H:i:s");
$row=mysqli_fetch_row($res);
//echo "Select * from login where srno='".$row[1]."'";
$qry=mysqli_query($con1, "Select * from login where srno='".$row[1]."'");
 $reslt=mysqli_fetch_row($qry);

$qryup=mysqli_query($con1, "insert into start_end_day(username,cdate,tstamp,etype) values ('".$reslt[1]."','".$d."','".$dt."','E')");
if($qryup)
$str="1";
else
$str="-1";
}
else
$str="-1";


echo json_encode($str);
 
				
?>
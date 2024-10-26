<?php
include("db_conn.php");
//include_once 'GCM.php';
//include("../Whatsapp_delegation/delegation_fun.php");

$alert=$_GET['alertid'];
$feed=urldecode($_GET['feed']);
$eng_id=$_GET['engid'];
$cdate =$_GET['uptime'];  //date('Y-m-d H:i:s');

//$feddback=str_replace("'","\'",$feed);
$feddback = $feed;

$qryx=mysqli_query($conapp,"select engineer from alert_delegation where alert_id='".$alert."' order by id desc");
$rowx=mysqli_fetch_row($qryx);
$eng_id=$rowx[0];
//$engqry=mysqli_query($conapp,"select engg_name,area,engg_id,phone_no1 from area_engg where loginid='".$eng_id."'");

$engqry=mysqli_query($conapp,"select loginid from area_engg where engg_id='".$eng_id."'");
$engqryro=mysqli_fetch_row($engqry);
$login_id=$engqryro[0];

$lat='';
$lng='';
$address='';
if(isset($_GET['localarea']))
$address.=$_GET['localarea'].",";

if(isset($_GET['area']))
$address.=$_GET['area'].",";

if(isset($_GET['city']))
$address.=$_GET['city'].",";

if(isset($_GET['state']))
$address.=$_GET['state'].",";

if(isset($_GET['country']))
$address.=$_GET['country'];

if(isset($_GET['lat']))
$lat=$_GET['lat'];
else
$lat='';

if(isset($_GET['long']))
$lng=$_GET['long'];
else
$lng='';
$str="";

$sql=mysqli_query($conapp,"Insert into eng_feedback(`engineer`,`alert_id`,`feedback`,`feed_date`,`standby`,`lat`,`lng`,`fromplace`) Values('".$login_id."','".$alert."','".$feddback."','".$cdate."','','".$lat."','".$lng."','".$address."')");

$qryreslt=mysqli_query($conapp,"Select mac_id from notification_tble where pid='".$eng_id."' ");
	$macidrow=mysqli_fetch_row($qryreslt);
     $mac=$macidrow[0];

mysqli_query($conapp,"Insert into Location(`mac_address`,`latitude`,`longitude`,`dt`,`address`,`engg_id`) Values('".$mac."','".$lat."','".$lng."','".$cdate."','".$address."','".$eng_id."')");

   mysqli_query($conapp,"update engg_current_location set mac_id ='".$mac."',latitude='".$lat."' , longitude ='".$lng."', last_updated='".$cdate."' where engg_id ='".$eng_id."'");

//$sqlupdate=mysqli_query($conapp,"insert into `alert_updates`(`alert_id`,`up`,`update_time`,`user`) values('".$alert."','".$feddback."','".$cdate."','".$eng_id."')");



if($sql)
{
$str='1';
}
else
$str='0';

echo json_encode($str);

?>

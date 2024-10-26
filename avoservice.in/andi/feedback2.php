<?php
include("db_conn.php");
//include_once 'GCM.php';
//include("../Whatsapp_delegation/delegation_fun.php");

/*function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/s', ' ', $string); 
  
   return preg_replace('/-+/', '-', $string); 
}*/

$alert=$_GET['alertid'];
$feed=$_GET['feed'];
$eng_id=$_GET['engid'];

$qryx=mysqli_query($conapp,"select engineer from alert_delegation where alert_id='".$alert."' order by id desc");
$rowx=mysqli_fetch_row($qryx);
$engqry=mysqli_query($conapp,"select loginid from area_engg where engg_id='".$rowx."'");
$engqryro=mysqli_fetch_row($engqry);
$login_id=$engqryro[0];
$eng_id=$rowx[0];


$update=mysqli_real_escape_string($conapp, $feed);

//$update=clean($feed);

$cdate =$_GET['uptime'];  //date('Y-m-d H:i:s');
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

$current_dates=date("Y-m-d H:i:s");
//          ====alert_progress// eng_feedback--loginid
$upalert=mysqli_query($conapp,"INSERT INTO `alert_progress`(`alert_id`,`responsetime`,`engg_id`,`pending_date`) VALUES('".$alert."','".$cdate."','".$login_id."','".$current_dates."')"); 

$sql=mysqli_query($conapp,"Insert into eng_feedback(`engineer`,`alert_id`,`feedback`,`feed_date`,`standby`,`lat`,`lng`,`fromplace`) Values('".$login_id."','".$alert."','".$update."','".$cdate."','','".$lat."','".$lng."','".$address."')");

$qryreslt=mysqli_query($conapp,"Select mac_id from notification_tble where pid='".$eng_id."' ");
				$macidrow=mysqli_fetch_row($qryreslt);
     $mac=$macidrow[0];
     mysqli_query($conapp,"Insert into Location(`mac_address`,`latitude`,`longitude`,`dt`,`address`,`engg_id`) Values('".$mac."','".$lat."','".$lng."','".$cdate."','".$address."','".$eng_id."')");
    
      mysqli_query($conapp,"update engg_current_location set mac_id ='".$mac."',latitude='".$lat."' , longitude ='".$lng."' , last_updated='".$cdate."' where engg_id ='".$eng_id."'");
     

//$sqlupdate=mysqli_query($conapp,"insert into `alert_updates`(`alert_id`,`up`,`update_time`,`user`) values('".$alert."','".$update."','".$cdate."','".$eng_id."')");

//========Response time goes to alert_progress===============


   
$tab1=mysqli_query($conapp,"update alert set responsetime='".$cdate."' where alert_id='".$alert."' and responsetime='0000-00-00 00:00:00'");


if($sql && $tab1 )
{
$str='1';
}
else
$str='0';

echo json_encode($str);

?>
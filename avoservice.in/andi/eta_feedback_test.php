<?php
include("db_conn.php");
//include_once 'GCM.php';
//include("../Whatsapp_delegation/delegation_fun.php");

//$alert=$_GET['alertid']; // test comment
//$feed=$_GET['feed']; // test comment
//$eng_id=$_GET['engid'];  // test comment

$alert= 1327940;
$feed="Test ETA page in the App";
$eng_id=2644;
$qryx=mysqli_query($conapp,"select engineer from alert_delegation where alert_id='".$alert."' order by id desc");
$rowx=mysqli_fetch_row($qryx);
$engqry=mysqli_query($conapp,"select engg_name,area,engg_id, phone_no1 from area_engg where loginid='".$eng_id."'");
$engqryro=mysqli_fetch_row($engqry);

if($rowx[0]==$engqryro[2]){
$eng_name=$engqryro[0];
$eng_mobile=$engqryro[3];

//$st=str_replace("'","\'",$feed); // test comment
$st= $feed;

//$cdate =$_GET['uptime']; // test comment
 $cdate=date('Y-m-d H:i:s');

//if(isset($_GET['etatime']))   // test comment
//$etatime =$_GET['etatime']; // test comment

$etatime = '2024-12-24 00:00:00';

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
$qry=mysqli_query($conapp,"select * from alert where alert_id='".$alert."'");
$qryro=mysqli_fetch_row($qry);

$cc=$qryro[32];
$atmid=$qryro[2];
//=======if row 17 = service to warranty and amc=============================================
//=======insert eta update in eta_feedback and eng_feedback ===============
//echo "Insert into eng_feedback(`engineer`,`alert_id`,`feedback`,`standby`,`lat`,`lng`,`fromplace`) Values('".$eng_id."','".$alert."','".$st."','".$stand."','".$lat."','".$lng."','".$address."')";
$sql=mysqli_query($conapp,"Insert into eng_feedback(`engineer`,`alert_id`,`feedback`,`feed_date`,`standby`,`lat`,`lng`,`fromplace`) Values('".$eng_id."','".$alert."','".$st."','".$cdate."','','".$lat."','".$lng."','".$address."')");

$qryreslt=mysqli_query($conapp,"Select mac_id,pid from notification_tble where logid='".$eng_id."' AND status='0'");
				$macidrow=mysqli_fetch_row($qryreslt);
     $mac=$macidrow[0];
     mysqli_query($conapp,"Insert into Location(`mac_address`,`latitude`,`longitude`,`dt`,`address`,`engg_id`) Values('".$mac."','".$lat."','".$lng."','".$cdate."','".$address."','".$engqryro[2]."')");
 
     mysqli_query($conapp,"update engg_current_location set mac_id ='".$mac."',latitude='".$lat."' , longitude ='".$lng."', last_updated='".$cdate."' where engg_id ='".$engqryro[2]."'");
     
mysqli_query($conapp,"insert into eta_feedback(id,eta_time,created_dt,updt_by) values('".$alert."','".$etatime."' ,'".$cdate."' ,'".$eng_id."')");

$sqlupdate=mysqli_query($conapp,"insert into `alert_updates`(`alert_id`,`up`,`update_time`,`user`) values('".$alert."','".$st."','".$cdate."','".$eng_id."')");


$tab1=mysqli_query($conapp,"update alert set eta='".$etatime."' where alert_id='".$alert."'");

if($sql && $tab1)
{

$str='1';
}
else
$str='0';
}
else $str='0';

echo json_encode($str);


?>
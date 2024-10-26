<?php
include("db_conn.php");
include_once 'GCM.php';
//include("../Whatsapp_delegation/delegation_fun.php");


$problemType=$_GET['problemtype'];//Problem Type added by vishnu

$alert=$_GET['alertid'];
$feed=$_GET['feed'];
$eng_id=$_GET['engid'];
//$srno=$_GET['srno'];

$alert=1328045;
$feed="close test using delegate enggineer qry";
$std="Y";
$cdate=date('Y-m-d H:i:s');

$delqry=mysqli_query($conapp,"select engineer from alert_delegation where alert_id='".$alert."'");
$del_enggrow=mysqli_fetch_row($delqry);
$del_enggid=$del_enggrow[0];
//============Use enggid from  alert_delegation==
$eng_id=$del_enggid;

$engqry=mysqli_query($conapp,"select loginid from area_engg where engg_id='".$del_enggid."'");

$engqryro=mysqli_fetch_row($engqry);
$login_id=$engqryro[0];

//$update1= str_replace("'","\'",$feed);
$update=mysqli_real_escape_string($conapp,$feed);

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
$close='';
//$std=urldecode($_GET['standby']);
//$std=$_GET['standby'];

if($std=='' || $std=='null')
{
$close="Pending";
$stand="";
}
elseif($std=='P')
{
$close="Pending";
$stand="";
}
elseif($std=='Y')
{
$close="Done";
$stand="Y";
}elseif($std=='A')  // Closed Avo End -Customer Scope
{
$close="Done";
$stand="A";
}elseif($std=='Z')
{
$close="Done";
$stand="";
} 

//echo $close."- Close type --- standby method-".$stand ;
//die;

$str="";


$current_dates=date("Y-m-d H:i:s");
 //==============alert_progress// eng_feedback--loginid
$upalert=mysqli_query($conapp,"INSERT INTO `alert_progress` (`alert_id`, `eng_left_site`,  `engg_id`,  `pending_date` ) VALUES ('".$alert."', '".$cdate."', '".$login_id."' ,'".$current_dates."')"); 	


$sql=mysqli_query($conapp,"Insert into eng_feedback(`engineer`,`alert_id`,`feedback`,`feed_date`,`standby`,`lat`,`lng`,`fromplace`) Values('".$login_id."','".$alert."','".$update."','".$cdate."','".$stand."','".$lat."','".$lng."','".$address."')");

     $qryreslt=mysqli_query($conapp,"Select mac_id from notification_tble where pid='".$eng_id."' ");
				$macidrow=mysqli_fetch_row($qryreslt);
     $mac=$macidrow[0];
     mysqli_query($conapp,"Insert into Location(`mac_address`,`latitude`,`longitude`,`dt`,`address`,`engg_id`) Values('".$mac."','".$lat."','".$lng."','".$cdate."','".$address."','".$eng_id."')");
     
    mysqli_query($conapp,"update engg_current_location set mac_id ='".$mac."',latitude='".$lat."' , longitude ='".$lng."', last_updated='".$cdate."' where engg_id ='".$eng_id."'");

$sqlupdate=mysqli_query($conapp,"insert into `alert_updates`(`alert_id`,`up`,`update_time`,`user`) values('".$alert."','".$update."','".$cdate."','".$eng_id."')");



if($close=="Done"){
$tab1=mysqli_query($conapp,"update alert set close_date='".$cdate."' where alert_id='".$alert."' and close_date='0000-00-00 00:00:00'");

mysqli_query($conapp,"update alert_delegation set call_close_status='1' where alert_id='".$alert."'");


$qry=mysqli_query($conapp,"select * from alert where alert_id='".$alert."'");
$qryro=mysqli_fetch_row($qry);

//===Check alert for new inst call==========
//$alertqry=mysqli_query($conapp,"select alert_id from alert where alert_id='".$alert."' and alert_type='new'");
//if(mysqli_num_rows($alertqry)>0)	
//================ ======= to update start expiry date======
	if($qryro[17]=='new')

         {
          $st=date("Y-m-d");
 $qry66=mysqli_query($conapp,"select site_ass_id, valid,start_date, assets_name  from site_assets where alert_id='".$alert."'");
   
 while($fetch=mysqli_fetch_row($qry66)) {

$deldate = $fetch[2];
$final = date("Y-m-d", strtotime("+3 months $deldate"));
if($st > $final){ $st= $final; }
        
    $d12=explode(',',$fetch[1]);
  $expdt1=date('Y-m-d', strtotime("+$d12[0] months $st"));    
 
  $updt=mysqli_query($conapp,"update site_assets set start_date='".$st."', exp_date='".$expdt1."' where site_ass_id='".$fetch[0]."'");
  
}
} else{}

} else 
mysqli_query($conapp,"update alert_delegation set call_close_status='2' where alert_id='".$alert."'");

$tab1=mysqli_query($conapp,"update alert set status='".$close."', standby='".$stand."' where alert_id='".$alert."'");


$query8=mysqli_query($conapp,"Insert into siteproblem(alertid,probid,problemtype) Values('".$alert."','".$problemType."','".$problemType."')");


if($sql && $tab1)
{
$str='1';
}
else
$str='0';

echo json_encode($str);

//mysqli_close($conapp);
?>

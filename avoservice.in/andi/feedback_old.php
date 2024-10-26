<?php
include("db_conn.php");
include_once 'GCM.php';
include("../Whatsapp_delegation/delegation_fun.php");


$problemType=$_GET['problemtype'];//Problem Type added by vishnu

$alert=$_GET['alertid'];
$feed=$_GET['feed'];
$eng_id=$_GET['engid'];
$qryx=mysqli_query($conapp,"select engineer from alert_delegation where alert_id='".$alert."' order by id desc");
$rowx=mysqli_fetch_row($qryx);
$engqry=mysqli_query($conapp,"select engg_name,area,engg_id, phone_no1 from area_engg where loginid='".$eng_id."'");
$engqryro=mysqli_fetch_row($engqry);

if($rowx[0]==$engqryro[2]){
$eng_name=$engqryro[0];
$eng_mobile=$engqryro[3];

$update1= str_replace("'","\'",$feed);

$update=mysqli_real_escape_string($conapp,$update1);

$cdate =$_GET['uptime'];  //date('Y-m-d H:i:s');
$dt=substr($cdate,0,10);
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
$std=$_GET['standby'];
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
$str="";
$srno=$_GET['srno'];
$qry=mysqli_query($conapp,"select * from alert where alert_id='".$alert."'");
$qryro=mysqli_fetch_row($qry);

$cc=$qryro[32];

if($qryro[21]=='amc'){
	$sitestr=mysqli_query($conapp,"select atmid from Amc where amcid='".$qryro[2]."'");
	$row3=mysqli_fetch_row($sitestr);
	$atmid=$row3[0];
	}elseif($qryro[21]=='site'){
	$qry3=mysqli_query($conapp,"select atm_id from atm where track_id='".$qryro[2]."'");
	$row3=mysqli_fetch_row($qry3);
	$atmid=$row3[0];		
	}
	
//=======if row 17 = service to warranty and amc=========================
/* if($qryro[17]=='service'){
	
	//==========update amcassets for serials================
	if($srno!='' || $srno!=null)
	$qry2=mysqli_query($conapp,"update amcassets set serialno='".$srno."' where siteid='".$qryro[2]."' and assets_name='UPS' and serialno=''");
	
	//==========update site_assets for serials================
	if($srno!='' || $srno!=null)
	$qry4=mysqli_query($conapp,"update site_assets set serialno='".$srno."' where atmid='".$qryro[2]."' and assets_name='UPS' and serialno=''");

}
//=======if row 17 = new ===============
elseif($qryro[17]=='new'){
		$at=(explode("_",$qryro[2]));
		if($at[0]!='temp'){
		if($qryro[21]=='amc'){
		$sitestr=mysqli_query($conapp,"select atmid from Amc where amcid='".$qryro[2]."'");
		$row3=mysqli_fetch_row($sitestr);
		$atmid=$row3[0];		
	}else{
		$qry3=mysqli_query($conapp,"select * from atm where track_id='".$qryro[2]."'");
		$row3=mysqli_fetch_row($qry3);
		$atmid=$row3[1];
		if($srno!='' || $srno!=null)
		//==========update site_assets for serials================
		$qry1=mysqli_query($conapp,"update site_assets set serialno='".$srno."' where atmid='".$row3[0]."' and assets_name='UPS' and serialno=''");
		}
}else{
	if($srno!='' || $srno!=null)
	$qry1=mysqli_query($conapp,"update tempsites set serialno='".$srno."' where atmid='".$qryro[2]."' and serialno=''");
	//$atmid=$qryro[2];
	}
} */

$sql=mysqli_query($conapp,"Insert into eng_feedback(`engineer`,`alert_id`,`feedback`,`feed_date`,`standby`,`lat`,`lng`,`fromplace`) Values('".$eng_id."','".$alert."','".$update."','".$cdate."','".$stand."','".$lat."','".$lng."','".$address."')");

     $qryreslt=mysqli_query($conapp,"Select mac_id,pid from notification_tble where logid='".$eng_id."' AND status='0'");
				$macidrow=mysqli_fetch_row($qryreslt);
     $mac=$macidrow[0];
     mysqli_query($conapp,"Insert into Location(`mac_address`,`latitude`,`longitude`,`dt`,`address`,`engg_id`) Values('".$mac."','".$lat."','".$lng."','".$cdate."','".$address."','".$engqryro[2]."')");
     
    mysqli_query($conapp,"update engg_current_location set mac_id ='".$mac."',latitude='".$lat."' , longitude ='".$lng."', last_updated='".$cdate."' where engg_id ='".$engqryro[2]."'");

$sqlupdate=mysqli_query($conapp,"insert into `alert_updates`(`alert_id`,`up`,`update_time`,`user`) values('".$alert."','".$update."','".$cdate."','".$eng_id."')");

//========Response time goes to alert_progress===============

$current_dates=date("Y-m-d H:i:s");
$upalert=mysqli_query($conapp,"INSERT INTO `alert_progress` (`alert_id`, `eng_left_site`,  `engg_id`,  `pending_date` ) VALUES ('".$alert."', '".$cdate."', '".$eng_id."' ,'".$current_dates."')"); 
 
if($close=="Done"){
mysqli_query($conapp,"update alert set close_date='".$cdate."' where alert_id='".$alert."' and close_date='0000-00-00 00:00:00'");

//==============Old to Update start/ exp warranty in atm table

if($qryro[17]=='new'){
$st=substr($cdate,0,10);
$qr=mysqli_query($conapp,"select valid from site_assets where atmid='".$qryro[2]."' and assets_name='UPS'");
if(mysqli_num_rows($qr)==0)
{
$qr=mysqli_query($conapp,"select valid from site_assets where atmid='".$qryro[2]."' and assets_name='Battery'");
 if(mysqli_num_rows($qr)==0)
 {
 $qr=mysqli_query($conapp,"select valid from site_assets where atmid='".$qryro[2]."' and assets_name='Isolation Transformer'");
    if(mysqli_num_rows($qr)==0)
   {
   $qr=mysqli_query($conapp,"select valid from site_assets where atmid='".$qryro[2]."' and assets_name='Stabilizer'");
      if(mysqli_num_rows($qr)==0)
     {
     $qr=mysqli_query($conapp,"select valid from site_assets where atmid='".$qryro[2]."' and assets_name='AVR'");
     }
   }
 }
}
$fetch1=mysqli_fetch_array($qr);

$d1=split(',',$fetch1[0]);
  $expdt=date('Y-m-d', strtotime("+$d1[0] months $st"));

$updt=mysqli_query($conapp,"update atm set start_date='".$st."',expdt='".$expdt."' where track_id='".$qryro[2]."'");
} 
//=======================new atart/end update in assets table

if($qryro[17]=='new'){
$st=substr($cdate,0,10);
$qry=mysqli_query($conapp,"select site_ass_id, valid from site_assets where alert_id='".$alert."' ");

if(mysqli_num_rows($qry) !=0) {

while ($fetch=mysqli_fetch_array($qry)){

$d11=split(',',$fetch[1]);
  $expdt1=date('Y-m-d', strtotime("+$d11[0] months $st"));

$updt=mysqli_query($conapp,"update site_assets set start_date='".$st."', exp_date='".$expdt1."' where site_ass_id='".$fetch[0]."'");
}
    
    
} }
//=================end===========
    
}else
mysqli_query($conapp,"update alert_delegation set call_close_status='2' where alert_id='".$alert."'");

$tab1=mysqli_query($conapp,"update alert set status='".$close."', standby='".$stand."' where alert_id='".$alert."'");


$query8=mysqli_query($conapp,"Insert into siteproblem(alertid,probid,problemtype) Values('".$alert."','".$problemType."','".$problemType."')");
$qryx=mysqli_query($conapp,"Insert into avo_attendence(eng,present,attend_date,branch_id) Values('".$engqryro[0]."','P','".$dt."','".$engqryro[1]."')");



$qryst=$qryro[7];
$createdval=$qryro[25];

//==============Notification to Branch App=========
//echo "Select state_id from state where state='".$qryst."'";
/*	$qrystat=mysqli_query($conapp,"Select state_id from state where state='".$qryst."'");
	if(mysqli_num_rows($qrystat)>0)
		{
			$resltrow=mysqli_fetch_row($qrystat);
			$message2="Update for Complaint No'".$createdval."' is '".$st."'";
			$qrylog=mysqli_query($conapp,"Select * from login where designation='3'");
			$srno=array();
			while($max1=mysqli_fetch_row($qrylog))
				{
				//echo $max1[3]."<br>";
				$br=explode(",",$max1[3]);
				for($i=0;$i<count($br);$i++)
				{
				//echo "<br>br=".($br[$i])."<br>";
					if($br[$i]==$resltrow[0])
					{
					$srno[]=$max1[0];
					break;
					}
				}
					
				
				}
				$logid=implode(",",$srno);
				//echo "Select gcm_regid from notification_tble where logid in($logid)";
				$qryreslt=mysqli_query($conapp,"Select gcm_regid from notification_tble where logid in($logid) AND status='0'");
				if(mysqli_num_rows($qryreslt)>0)
				{
				$str2=array();
						while($maxnew=mysqli_fetch_row($qryreslt))
						{
							$str2[]=$maxnew[0];
						
						}
						//$maxnew=mysqli_fetch_row($qryreslt);
						//$str2=$maxnew[0];
				//print_r($str2);
				
						 $gcm = new GCM();
							//$registatoin_ids = $str2;
							 //echo $str2." ".$message2;
							$message = array("alert" => $message2);
						
							$result = $gcm->send_notification($str2, $message);
				}
		} */
		

if($sql && $tab1 && $sqlupdate )
{
$str='1';
}
else
$str='0';
}
else $str='0';

echo json_encode($str);


//=============== Whatapp Customer ===============

if ($atmid=='') {$atmid= $qryro[2];}
if($str=='1')
{

       $MassageNew = "*Call Status from Switching AVO*";
        $Massage1="*ATM Id:* ".$atmid;
        $Massage2="*Ticket No:* ".$qryro[25];
        $Massage3="*End User:* ".$qryro[3];
        $Massage4="======= *Updates* =========";
        $Massage5="*Engineer:* ".$eng_name;
        $Massage6="*Mobile:* ".$eng_mobile;
        $Massage7="*Call Status:* ".$close;
        $Massage8="*Engr Feedback:* ".$update;

$cmobile=$qryro[13];
$gmobile=$qryro[45];
$whats_no=$cmobile.",".$gmobile;

$allMessage = $MassageNew."\n".$Massage1."\n".$Massage2."\n".$Massage3."\n".$Massage4."\n".$Massage5."\n".$Massage6."\n".$Massage7."\n".$Massage8;

//SendWhatmsg($whats_no,$allMessage);



global $atmid;
//echo "ATM:".$atmid;

$tbl="<html>
<head>
<title>Switching AVO Electro Power Limited</title>
</head>
<body>
<p>[F]New Updates for Below Site: <font color='blue'>".$update."</font></p>
<table border='1' width='700px'>
<tr><th>Complaint Id</th><th>Site/Sol/ATM Id</th><th>End User</th><th>State</th><th>City</th><th>Address</th><th>Problem reported</th><th>Current Status</th></tr>";
  $tbl.="<tr>
		<td>".$qryro[25]."</td>		
		<td>".$atmid."</td>
		<td>".$qryro[3]."</td>
		<td>".$qryro[27]."</td>
		<td>".$qryro[6]."</td>
		<td>".$qryro[5]."</td>
		<td>".$qryro[9]."</td>
		<td><b>".$close."</b></td>
	</tr>";


	$to = "service3@avoups.com, boopathy@avoups.com";
	//$cc=$ccm=implode(",",extract_email_address($ccro[0]));
	$cc= $qryro[14].",".$qryro[32];
	$subject = $qryro[29];
	$tbl.="</table><br><br><font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font> 
			<br><br><font color='blue'>Updated By:</font> <font color='red'>".$eng_name."</font> </body></html>";
	$headers = "From:<HelpDesk@avoservice.in>\r\n";
	//$headers .= "Reply-To: ".dfdf . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$cc. "\r\n";
	$message=$tbl;
	$mailqry=mail($to, $subject, $message, $headers);

}
?>

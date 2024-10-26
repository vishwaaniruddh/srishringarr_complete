<?php
include("../config.php");
include_once 'GCM.php';
//include("../Whatsapp_delegation/delegation_fun.php");

$problemType=$_GET['problemtype'];//Problem Type added by vishnu
$problemTypeReason= "";
if(isset($_GET['problemReason'])){
$problemTypeReason=$_GET['problemReason'];
}
$alert=$_GET['alertid'];
$feed=$_GET['feed'];
$eng_id=$_GET['engid'];
$qryx=mysqli_query($con1,"select engineer from alert_delegation where alert_id='".$alert."' order by id desc");
$rowx=mysqli_fetch_row($qryx);
$engqry=mysqli_query($con1,"select engg_name,area,engg_id, phone_no1 from area_engg where loginid='".$eng_id."'");
$engqryro=mysqli_fetch_row($engqry);

if($rowx[0]==$engqryro[2]){
    $eng_name=$engqryro[0];
    $eng_mobile=$engqryro[3];
    
    $st= mysqli_real_escape_string($con1, str_replace("'","\'",$feed));
    $update=$st;
    $cdate =$_GET['uptime'];  //date('Y-m-d H:i:s');
    $dt=substr($cdate,0,10);
    $lat='';
    $lng='';
    $address='';
    if(isset($_GET['localarea'])){
      $address.=$_GET['localarea'].",";
    }
    if(isset($_GET['area'])){
      $address.=$_GET['area'].",";
    }
    if(isset($_GET['city'])){
      $address.=$_GET['city'].",";
    }
    if(isset($_GET['state'])){
      $address.=$_GET['state'].",";
    }
    if(isset($_GET['country'])){
      $address.=$_GET['country'];
    }
    if(isset($_GET['lat'])){
      $lat=$_GET['lat'];
    }else{
      $lat='';
    }
    if(isset($_GET['long'])){
      $lng=$_GET['long'];
    }else{
      $lng='';
    }
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
    }
    elseif($std=='A')  // Closed Avo End -Customer Scope
    {
        $close="Done";
        $stand="A";
    }
    elseif($std=='Z')
    {
        $close="Done";
        $stand="";
    }
    $str="";
    $srno=$_GET['srno'];
    $qry=mysqli_query($con1,"select * from alert where alert_id='".$alert."'");
    $qryro=mysqli_fetch_row($qry);
    
    $cc=$qryro[32];
    $atmid=$qryro[2];
//=======if row 17 = service to warranty and amc=============================================
/*
    if($qryro[17]=='service'){
    	if($qryro[21]=='amc'){
        	$sitestr=mysqli_query($con1,"select atmid from Amc where amcid='".$qryro[2]."'");
        	$row3=mysqli_fetch_row($sitestr);
        	$atmid=$row3[0];
    	}else{
        	$qry3=mysqli_query($con1,"select * from atm where track_id='".$qryro[2]."'");
        	$row3=mysqli_fetch_row($qry3);
        	$atmid=$row3[1];		
    	}
    	//==========update amcassets for serials================
    	if($srno!='' || $srno!=null){
    	    $qry2=mysqli_query($con1,"update amcassets set serialno='".$srno."' where siteid='".$qryro[2]."' and assets_name='UPS' and serialno=''");
    	}
    	//==========update site_assets for serials================
    	if($srno!='' || $srno!=null){
    	    $qry4=mysqli_query($con1,"update site_assets set serialno='".$srno."' where atmid='".$qryro[2]."' and assets_name='UPS' and serialno=''");
    	}
    }
    */
//=======if row 17 = new ===============
   /*
    elseif($qryro[17]=='new'){
		$at=(explode("_",$qryro[2]));
		if($at[0]!='temp'){
    		if($qryro[21]=='amc'){
        		$sitestr=mysqli_query($con1,"select atmid from Amc where amcid='".$qryro[2]."'");
        		$row3=mysqli_fetch_row($sitestr);
        		$atmid=$row3[0];		
        	}else{
        		$qry3=mysqli_query($con1,"select * from atm where track_id='".$qryro[2]."'");
        		$row3=mysqli_fetch_row($qry3);
        		$atmid=$row3[1];
        		if($srno!='' || $srno!=null)
        		//==========update site_assets for serials================
        		$qry1=mysqli_query($con1,"update site_assets set serialno='".$srno."' where atmid='".$row3[0]."' and assets_name='UPS' and serialno=''");
        	}
        }else{
        	if($srno!='' || $srno!=null){
            	$qry1=mysqli_query($con1,"update tempsites set serialno='".$srno."' where atmid='".$qryro[2]."' and serialno=''");
        	}
        	//$atmid=$qryro[2];
        }
    }
    */
    $sql=mysqli_query($con1,"Insert into eng_feedback(`engineer`,`alert_id`,`feedback`,`feed_date`,`standby`,`lat`,`lng`,`fromplace`) Values('".$eng_id."','".$alert."','".$st."','".$cdate."','".$stand."','".$lat."','".$lng."','".$address."')");

    $qryreslt=mysqli_query($con1,"Select mac_id,pid from notification_tble where logid='".$eng_id."' AND status='0'");
	$macidrow=mysqli_fetch_row($qryreslt);
    $mac=$macidrow[0];
    mysqli_query($con1,"Insert into Location(`mac_address`,`latitude`,`longitude`,`dt`,`address`,`engg_id`) Values('".$mac."','".$lat."','".$lng."','".$cdate."','".$address."','".$engqryro[2]."')");
     
    mysqli_query($con1,"update engg_current_location set mac_id ='".$mac."',latitude='".$lat."' , longitude ='".$lng."', last_updated='".$cdate."' where engg_id ='".$engqryro[2]."'");

    $sqlupdate=mysqli_query($con1,"insert into `alert_updates`(`alert_id`,`up`,`update_time`,`user`) values('".$alert."','".$st."','".$cdate."','".$eng_id."')");


    $current_dates=date("Y-m-d H:i:s");
    $upalert=mysqli_query($con1,"INSERT INTO `alert_progress` (`alert_id`, `eng_left_site`,  `engg_id`,  `pending_date` ) VALUES ('".$alert."', '".$cdate."', '".$eng_id."' ,'".$current_dates."')"); 


if($close=="Done"){
   $tab1= mysqli_query($con1,"update alert set close_date='".$cdate."' where alert_id='".$alert."' and close_date='0000-00-00 00:00:00'");

    //==============Old to Update start/ exp warranty in atm table

    	if($qryro[17]=='new')
         {
          $st=date("Y-m-d");
        //  echo "select site_ass_id, valid,start_date, assets_name  from site_assets where alert_id='".$alert."'";
     $qry66=mysqli_query($con1,"select site_ass_id, valid,start_date, assets_name from site_assets where alert_id='".$alert."'");
   
 while($fetch=mysqli_fetch_row($qry66)) {

$deldate = $fetch[2];
$final = date("Y-m-d", strtotime("+3 months $deldate"));
if($st > $final){ $st= $final; }
        
    //$d12=split(',',$fetch[1]);
    $d12=explode(',',$fetch[1]);
  $expdt1=date('Y-m-d', strtotime("+$d12[0] months $st"));    
 
  $updt=mysqli_query($con1,"update site_assets set start_date='".$st."', exp_date='".$expdt1."' where site_ass_id='".$fetch[0]."'");
  
 /* if($fetch[3]=='UPS'){
   
   $updt=mysqli_query($con1,"update atm set start_date='".$st."',expdt='".$expdt1."' where track_id='".$qryro[2]."'");   
  } */
  
}
}

//=================end===========
    
}else{
   mysqli_query($con1,"update alert_delegation set call_close_status='2' where alert_id='".$alert."'");
}

//echo "update alert set status='".$close."', standby='".$stand."' where alert_id='".$alert."'";
$tab1=mysqli_query($con1,"update alert set status='".$close."', standby='".$stand."' where alert_id='".$alert."'");


$query8=mysqli_query($con1,"Insert into siteproblem(alertid,probid,problemtype) Values('".$alert."','".$problemType."','".$problemTypeReason."')");
$qryx=mysqli_query($con1,"Insert into avo_attendence(eng,present,attend_date,branch_id) Values('".$engqryro[0]."','P','".$dt."','".$engqryro[1]."')");



$qryst=$qryro[7];
$createdval=$qryro[25];

		

    if($sql && $tab1 && $sqlupdate )
    {
       $str='1';
    }
    else{
       $str='0';
    }
}
else { $str='0'; }

echo json_encode($str);


//=============== Whatapp Customer ===============
/* if($str=='1')
{
    if ($atmid=='') {$atmid= $qryro[2];}

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
    
    SendWhatmsg($whats_no,$allMessage);
}


global $atmid;
//echo "ATM:".$atmid;
$tbl="<html>
<head>
<title>Switching AVO Electro Power Limited</title>
</head>
<body>
<p>New Updates for for Below Site: <font color='blue'>".$st."</font></p>
<table border='1' width='700px'>
<tr><th>COMPLAINT ID</th><th>ATM ID</th><th>BANK</th><th>State</th><th>City</th><th>Address</th><th>ISSUE</th><th>STATUS</th></tr>";
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

	
	//$sub=mysqli_query($con1,"select subject from alert where alert_id='".$alert."'");	
	//$subro=mysqli_fetch_row($sub);
	//$cc=mysqli_query($con1,"select email from emailid where custid='".$resal[6]."' and bank='".$resal[7]."'");
	//$ccro=mysqli_fetch_row($cc);
	$to = "service2@avoups.com";
	//$cc=$ccm=implode(",",extract_email_address($ccro[0]));
	$cc=$qryro[32];
	$subject = $qryro[29];
	$tbl.="</table><br><br><font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font> 
			<br><br><font color='blue'>Updated By:</font> <font color='red'>".$eng_name."</font> </body></html>";
	$headers = "From:<HelpDesk@avoservice.in>\r\n";
	//$headers .= "Reply-To: ".dfdf . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$cc. "\r\n";
	$message=$tbl;
	//$message="Update Time : ".$cdate."<br><br>Update for complaint no ".$resal[2].": ".$st;
	//echo $message;
	$mailqry=mail($to, $subject, $message, $headers);

*/
?>
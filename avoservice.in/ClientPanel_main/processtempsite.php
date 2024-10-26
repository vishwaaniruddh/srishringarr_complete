<?php
include("access.php");
include("config.php");
//======================FOR SERVICE CALLS===============================
if(isset($_POST['cmdsubmit']) && $_POST['type_call']=='service' && $_POST['branch_avo']!=''){
include_once '../andi/GCM.php';
//echo "INSERT INTO `satyavan_accounts`.`tempsites` (`id`, `custid`, `po`, `atmid`, `bankname`, `area`, `pincode`, `city`, `state`, `address`, `ref_id`) VALUES (NULL, '".$_POST['cust']."', '".$_POST['po']."', '".$_POST['atmid']."', '".$_POST['bank']."', '".$_POST['area']."', '".$_POST['pincode']."', '".$_POST['city']."', '".$_POST['state']."', '".$_POST['address']."', '".$_POST['atmid']."')<br>";

$qry=mysql_query("INSERT INTO `tempsites` (`id`, `custid`, `po`, `atmid`, `bankname`, `area`, `pincode`, `city`, `state`, `address`, `ref_id`,`type`,`state1`) VALUES (NULL, '".$_POST['cust']."', '".$_POST['po']."', 'temp_".$_POST['atmid']."', '".$_POST['bank']."', '".$_POST['area']."', '".$_POST['pincode']."', '".$_POST['city']."', '".$_POST['state']."', '".$_POST['address']."', '".$_POST['atmid']."','".$_POST['type']."', '".$_POST['state']."')");

$tempid=mysql_insert_id();
if(!$qry)
echo "failed".mysql_error();

//echo "update tempsites set trackerid='temp_".$tempid."' where id='".$tempid."'<br>";
$qryup=mysql_query("update tempsites set trackerid='temp_".$tempid."' where id='".$tempid."'");
$qry2=mysql_query("select srno from login where username='".$_SESSION['user']."'");
$qry2ro=mysql_fetch_row($qry2);
	$qrr=mysql_query("select * from alert where entry_date LIKE ('".date('Y-m-d')."%')");
	$num=mysql_num_rows($qrr);
	$num2=$num+1;
	if($num2>0 && $num2<=9)
	$num3="0".$num2;
	else
	$num3=$num2;
	
	
	function extract_email_address($string) {
    foreach(preg_split('/\s/', $string) as $token) {
        $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        if ($email !== false) {
            $emails[] = $email;
        }
    }
    return $emails;
}

$ccm=implode(",",extract_email_address($_POST['ccemail']));
//echo "Insert into alert(`cust_id`,`atm_id`,`bank_name`,`area`,`address`,`city`,`state`,`pincode`,`problem`,`caller_name`,`caller_phone`,`caller_email`,`alert_date`,`call_status`,`alert_type`,`entry_date`,`po`) Values('".$_POST['cust']."','".$_POST['atmid']."','".$_POST['bank']."','".$_POST['area']."','".$_POST['address']."','".$_POST['city']."','".$_POST['state']."','".$_POST['pincode']."','".$_POST['prob']."','".$_POST['cname']."','".$_POST['cphone']."','".$_POST['cemail']."',STR_TO_DATE('".$_POST['adate']."','%d/%m/%Y'),'Pending','new','".$_POST['cdate']."','".$_POST['po']."')<br>";
$alert=mysql_query("Insert into alert(`cust_id`,`atm_id`,`bank_name`,`area`,`address`,`city`,`branch_id`,`pincode`,`problem`,`caller_name`,`caller_phone`,`caller_email`,`alert_date`,`call_status`,`alert_type`,`entry_date`,`po`,`state1`,`createdby`,`subject`,`custdoctno`,`appby`,`appref`,`ccmail`) Values('".$_POST['cust']."','temp_".$_POST['atmid']."','".$_POST['bank']."','".$_POST['area']."','".preg_replace('/\s+/', ' ', $_POST['address'])."','".$_POST['city']."','".$_POST['branch_avo']."','".$_POST['pincode']."','".preg_replace('/\s+/', ' ', $_POST['prob'])."','".$_POST['cname']."','".$_POST['cphone']."','".$_POST['cemail']."',STR_TO_DATE('".$_POST['adate']."','%d/%m/%Y'),'Pending','new temp','".date('Y-m-d H:i:s')."','".$_POST['po']."','".$_POST['state']."','".$qry2ro[0]."_".date("ymd").$num3."','".$_POST['sub']."','".$_POST['doc']."','".$_POST['appby']."','".$_POST['how']."','".$ccm."')");
$id=mysql_insert_id();

if($alert)
		{		
    //  $delqry=mysql_query("SELECT engineer,count(*) as cnt  FROM `alert_delegation` WHERE `atm`='".$_POST['ref']."' group by engineer order by cnt desc");
    if(strlen($_POST['atmid'])>=4){
      $delqry=mysql_query("SELECT engineer,count(*) as cnt  FROM `alert_delegation` WHERE `alert_id` in(select `alert_id` from alert where atm_id='temp_".$_POST['atmid']."') group by engineer order by cnt desc");
      $aidqry=mysql_query("select max(alert_id) from alert where atm_id='temp_".$_POST['atmid']."'");
      $aidrow=mysql_fetch_row($aidqry);
      $req=$aidrow[0];
      $bidqry=mysql_query("select branch_id from alert where alert_id='".$req."'");
      $bidrow=mysql_fetch_row($bidqry);
      $branch_id=$bidrow[0];
       while($delrow=mysql_fetch_row($delqry))
       {
        $enqry=mysql_query("select * from area_engg where engg_id='".$delrow[0]."' and area='".$branch_id."' and status=1"); 
        if(mysql_num_rows($enqry)>0)
        {  // delegate
         $ctime=date("Y-m-d H:i:s");
         $etdt=date("Y-m-d H:i:s", strtotime($ctime." + 4 hours"));

         $tab=mysql_query("update alert set status='Delegated',call_status='1',eta='".$etdt."' where alert_id='".$req."'");

        if($tab){
		//$cdate = date('Y-m-d H:i:s');
		$tab2=mysql_query("Insert into alert_delegation(engineer,atm,alert_id,date,delby)            values('".$delrow[0]."','".$_POST['atmid']."','".$req."','".$ctime."','".$_SESSION['user']."')");
                }
            
            $str2=array();
//echo "Select gcm_regid from notification_tble where logid='".$str."' AND pid='".$eng."' AND status='0'";
$qry1=mysql_query("Select gcm_regid from notification_tble where pid='".$delrow[0]."' AND status='0'");
    
            while($max1=mysql_fetch_row($qry1))
{
	$str2[]=$max1[0];

}

$message2="You have New Alerts";
include_once 'andi/GCM.php';
 $gcm = new GCM();
    //$registatoin_ids = $str2;
    $message = array("alert" => $message2);

    $result = $gcm->send_notification($str2, $message);
    
            break;
        }
        else
        continue;        
       }
  //header('location:service.php');
   // echo "Data added successfully<br><br><a href='service.php'>New Service</a>";
		
		
	//mail
$tbl="<html>
<head>
<title>Switching AVO Electro Power Limited</title>
</head>
<body>
<p>New Call Logged from <font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font></p><table border='1' width='700px'><tr><th>COMPLAINT ID</th><th>ATM ID</th><th>BANK</th><th>State</th><th>City</th><th>Address</th><th>ISSUE</th><th>STATUS</th></tr>";

$tbl.="<tr><td>".$qry2ro[0]."_".date("ymd").$num3."</td><td>".$_POST['atmid']."</td><td>".$_POST['bank']."</td><td>".$_POST['state']."</td><td>".$_POST['city']."</td><td>".$_POST['address']."</td><td>".$_POST['prob']."</td><td><b>Pending</b></td></tr>";



//print_r($cc);
$subject=$qry2ro[0]."_".date("ymd").$num3." <Switching AVO Electro Power Limited>";
//echo "<br>";
$tbl.="</table><br><br><font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font></body></html>";
//echo $tbl."<br>";
//echo $mailto." ".$cc;

$headers = "From: Switching AVO Electro Power Limited\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$headers .= "Cc: ".$ccm."\r\n";
			//echo $tbl;
			$message=$tbl;
			if(isset($_POST['ccemail']))
			{
			$mailto=$_POST['ccemail'];
			mail($mailto, $subject, $message, $headers);
			}	
		
		$curdt=date('Y-m-d H:i:s');
	
		$escem=array();
		$escpple=mysql_query("select email,level from esclatingpeople where level='0' and state like '%".$_POST['state']."%' and status=0 order by id ASC");
while($pplro=mysql_fetch_row($escpple))
$escem[]=$pplro[0];

$esclation=implode(",",$escem);
//echo "INSERT INTO `escalation` (`alertid`, `startdt`, `endtime`, `escalateto`, `type`, `level`, `status`) VALUES ('".$id."', '".$curdt."', '".date( "Y-m-d H:i:s", strtotime( '$curdt +15 minute' ) )."', '".$esclation."', '0', '1', '0')";
		$esc=mysql_query("INSERT INTO `escalation` (`alertid`, `startdt`, `endtime`, `escalateto`, `type`, `level`, `status`) VALUES ('".$id."', '".$curdt."', '".date( "Y-m-d", strtotime( '$curdt +15 minute' ) )."', '".$esclation."', '0', '1', '0')");
		
		
		
		$message2="";
		//echo "Select state_id from state where state='".$_POST['state']."'";
		$qry1=mysql_query("Select state_id from state where state='".$_POST['state']."'");
		if(mysql_num_rows($qry1)>0)
		{
		$resltrow=mysql_fetch_row($qry1);
		$message2="You have  New Alerts";
			$qry2=mysql_query("Select * from login where designation='3'");
			$srno=array();
			while($max1=mysql_fetch_row($qry2))
				{
				//echo $max1[3]."<br>";
				$br=explode(",",$max1[3]);
				for($i=0;$i<count($br);$i++)
				{
				//echo "<br>br=".($br[$i])."<br>";
					if($br[$i]==$resltrow[0])
					{
					$srno[]=$max1[0];
					//break;
					}
				}
					
				
				}
				$logid=implode(",",$srno);
				//echo "Select gcm_regid from notification_tble where logid in($logid)";
				$qryreslt=mysql_query("Select gcm_regid from notification_tble where logid in($logid)");
				if(mysql_num_rows($qryreslt)>0)
				{
				$str2=array();
						while($maxnew=mysql_fetch_row($qryreslt))
						{
							$str2[]=$maxnew[0];
						
						}
						//$maxnew=mysql_fetch_row($qryreslt);
						//$str2=$maxnew[0];
				//print_r($str2);
				
						 $gcm = new GCM();
							//$registatoin_ids = $str2;
							// echo $str2." ".$message2;
							$message = array("alert" => $message2);
						
							$result = $gcm->send_notification($str2, $message);
				}
		}
		}
}
//echo "<br>Update alert set `createdby`='".$qry2ro[0]."_".date("Ymd").$tempid."' where alert_id='".$tempid."'";
//$up=mysql_query("Update alert set `createdby`='".$qry2ro[0]."_".date("Ymd").$num3."' where alert_id='".$id."'");
?>
<script type="text/javascript">
alert("Alert created successfully. Complain ID is : <?php echo $qry2ro[0]."_".date("ymd").$num3; ?> ");
window.location='newtempsite.php';
</script>
<?php
//======================FOR PM CALLS===============================
}else if($_POST['type_call']=='pm' || $_POST['type_call']=='dere' || $_POST['type_call']=='w2pcb'){
//echo "INSERT INTO `tempsites_pm` ( `custid`, `po`, `atmid`, `bankname`, `area`, `pincode`, `city`, `state`, `address`, `ref_id`,`type`,`state1`,`call_type`) VALUES ('".$_POST['cust']."', '".$_POST['po']."', 'temp_".$_POST['atmid']."', '".$_POST['bank']."', '".$_POST['area']."', '".$_POST['pincode']."', '".$_POST['city']."', '".$_POST['branch_avo']."', '".$_POST['address']."', '".$_POST['atmid']."','".$_POST['type']."', '".$_POST['state']."','".$_POST['type_call']."')";
	
	$qry_pm=mysql_query("INSERT INTO `tempsites_pm` ( `custid`, `po`, `atmid`, `bankname`, `area`, `pincode`, `city`, `state`, `address`, `ref_id`,`type`,`state1`,`call_type`) VALUES ('".$_POST['cust']."', '".$_POST['po']."', 'temp_".$_POST['atmid']."', '".$_POST['bank']."', '".$_POST['area']."', '".$_POST['pincode']."', '".$_POST['city']."', '".$_POST['branch_avo']."', '".$_POST['address']."', '".$_POST['atmid']."','".$_POST['type']."', '".$_POST['state']."','".$_POST['type_call']."')");
	
$tempidpm=mysql_insert_id();
	//if(!$qry)
	//echo "failed".mysql_error();
	//echo "update tempsites_pm set trackerid='temp_".$tempidpm."' where id='".$tempidpm."'";
	$qryup=mysql_query("update tempsites_pm set trackerid='temp_".$tempidpm."' where id='".$tempidpm."'");
	//exit();
	$qry2=mysql_query("select srno from login where username='".$_SESSION['user']."'");
	$qry2ro=mysql_fetch_row($qry2);
	$qrr=mysql_query("select * from alert where entry_date LIKE ('".date('Y-m-d')."%')");
	$num=mysql_num_rows($qrr);
	$num2=$num+1;
	if($num2>0 && $num2<=9)
	$num3="0".$num2;
	else
	$num3=$num2;
	
	$alert_pm=mysql_query("Insert into alert(`cust_id`,`atm_id`,`bank_name`,`area`,`address`,`city`,`branch_id`, `pincode`, `caller_name`, `caller_phone`, `alert_date`, `call_status`, `alert_type`, `entry_date`, `po`, `state1`, `createdby`, `subject`, `custdoctno`) Values('".$_POST['cust']."','temp_".$_POST['atmid']."','".$_POST['bank']."','".$_POST['area']."','".preg_replace('/\s+/', ' ', $_POST['address'])."','".$_POST['city']."','".$_POST['branch_avo']."','".$_POST['pincode']."','".$_POST['cname']."','".$_POST['cphone']."',STR_TO_DATE('".$_POST['adate']."','%d/%m/%Y'),'Pending' ,'temp_".$_POST['type_call']."','".date('Y-m-d H:i:s')."','".$_POST['po']."','".$_POST['state']."','".$qry2ro[0]."_".date("ymd").$num3."','".$_POST['sub']."','".$_POST['doc']."')");
	
	if($alert_pm){		
	if(strlen($_POST['atmid'])>=4){
    //  $delqry=mysql_query("SELECT engineer,count(*) as cnt  FROM `alert_delegation` WHERE `atm`='".$_POST['ref']."' group by engineer order by cnt desc");
      $delqry=mysql_query("SELECT engineer,count(*) as cnt  FROM `alert_delegation` WHERE `alert_id` in(select `alert_id` from alert where atm_id='temp_".$_POST['atmid']."') group by engineer order by cnt desc");
      $aidqry=mysql_query("select max(alert_id) from alert where atm_id='temp_".$_POST['atmid']."'");
      $aidrow=mysql_fetch_row($aidqry);
      $req=$aidrow[0];
      $bidqry=mysql_query("select branch_id from alert where alert_id='".$req."'");
      $bidrow=mysql_fetch_row($bidqry);
      $branch_id=$bidrow[0];
       while($delrow=mysql_fetch_row($delqry))
       {
        $enqry=mysql_query("select * from area_engg where engg_id='".$delrow[0]."' and area='".$branch_id."' and status=1"); 
        if(mysql_num_rows($enqry)>0)
        {  // delegate
         $ctime=date("Y-m-d H:i:s");
         $etdt=date("Y-m-d H:i:s", strtotime($ctime." + 4 hours"));

         $tab=mysql_query("update alert set status='Delegated',call_status='1',eta='".$etdt."' where alert_id='".$req."'");

        if($tab){
		//$cdate = date('Y-m-d H:i:s');
		$tab2=mysql_query("Insert into alert_delegation(engineer,atm,alert_id,date,delby)            values('".$delrow[0]."','".$_POST['atmid']."','".$req."','".$ctime."','".$_SESSION['user']."')");
                }
            
            $str2=array();
//echo "Select gcm_regid from notification_tble where logid='".$str."' AND pid='".$eng."' AND status='0'";
$qry1=mysql_query("Select gcm_regid from notification_tble where pid='".$delrow[0]."' AND status='0'");
    
            while($max1=mysql_fetch_row($qry1))
{
	$str2[]=$max1[0];

}

$message2="You have New Alerts";
include_once '../andi/GCM.php';
 $gcm = new GCM();
    //$registatoin_ids = $str2;
    $message = array("alert" => $message2);

    $result = $gcm->send_notification($str2, $message);
    
            break;
        }
        else
        continue;        
       }
       }
	}	
	?>
	<script type="text/javascript">
	alert("Alert PM created successfully. Complain ID is : <?php echo $qry2ro[0]."_".date("ymd").$num3; ?> ");
	window.location='newtempsite.php';
	</script>
	
	<?php 
	}
	else{
	?>
	<script type="text/javascript">
	alert("Your login expired please try again");
	window.location='newtempsite.php';
	</script>
	
	<?php 
	}
?>
<?php
include('config.php');
include("Whatsapp_delegation/delegation_fun.php");


//=============Function for distnace ====================================

function distance($lat1, $lon1, $lat2, $lon2, $unit) {
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return ($miles * 1.609344);
    } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }
}

function extract_email_address($string) {
    foreach(preg_split('/\s/', $string) as $token) {
        $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        if ($email !== false) {
            $emails[] = "<".$email.">";
        }
    }
    return $emails;
}
    $qry="";
    $stat=0;
$tmb=date('Y-m-d 00:00:00', strtotime('-30 days'));
$ly=date('Y-m-d 00:00:00', strtotime('-1 year'));
$id=$_POST['ref'];
if($_POST['type']=='amc'){
$qry="select b.atmid,a.address,a.state1,a.entry_date,a.problem,a.call_status,a.alert_id,a.status from alert a,Amc b where a.atm_id='$id' and a.entry_date>'$ly' and a.atm_id=b.amcid order by alert_id DESC limit 5";
//echo $qry;
}
if($_POST['type']=='site'){
$qry="select b.atm_id,a.address,a.state1,a.entry_date,a.problem,a.call_status,a.alert_id,a.status from alert a,atm b where a.atm_id='$id' and a.entry_date>'$ly' and a.atm_id=b.track_id order by alert_id DESC limit 5";
//echo $qry;
}

$sql=mysqli_query($conc,$qry);
$rcnt=mysqli_num_rows($sql);
$tmcnt=0;
while($row=mysqli_fetch_array($sql))
{
    if($row[3]>$tmb)$tmcnt++;
$bm=mysqli_query($conc,"select up from alert_updates where alert_id='".$row[6]."' order by id DESC limit 1");
$bmro=mysqli_fetch_row($bm);
$eng=mysqli_query($conc,"select feedback from eng_feedback where alert_id='".$row[6]."' order by id DESC limit 1");
$engro=mysqli_fetch_row($eng);
//echo $row[5];
if($row[5]!='Done' && $row[5]!='Rejected' && $row[7]!='Done')
$stat=1;
}
    if($stat==1 || $tmcnt>=1){
        echo "Sorry you cannot log the call. Either Call already in OPEN or It seems Site Issue Repeated within 30 Days. Please contact Technical team / help desk of AVO for assistance."; }
    else if ($stat==1 || $rcnt>=5)   { 
        echo "Sorry you cannot log the call! Either Call already in OPEN or it seems Repeated issues. Please contact Technical team / help desk of AVO for assistance.";
    }
    else{
            $dt=date("Y-m-d H:i:s");
        $qry2=mysqli_query($conc,"select cust_name from customer where cust_id='".$_POST['cust']."'");
        $qry2ro=mysqli_fetch_row($qry2);
        if($_POST['type']=='site'){
	$at=mysqli_query($conc,"select atm_id from atm where track_id='".$_POST['ref']."'");
	//echo "select track_id from atm where atm_id='".$_POST['ref']."'";
	}
	else if($_POST['type']=='amc'){
	$at=mysqli_query($conc,"select atmid from Amc where amcid='".$_POST['ref']."'");
	//echo "select amcid from Amc where atmid='".$_POST['ref']."'";
	}
	
	$atro=mysqli_fetch_row($at); /*echo "ATM -".$atro[0];*/
    //    echo $qry2ro[0];
	//echo "<br>select * from alert where entry_date LIKE ('".date('Y-m-d')."%')";
	$qrr=mysqli_query($conc,"select * from alert where entry_date LIKE ('".date('Y-m-d')."%')");
	$num=mysqli_num_rows($qrr);
	$num2=$num+1;
	if($num2>0 && $num2<=9)
	$num3="0".$num2;
	else
	$num3=$num2;
	
 // echo $num3;
	//echo "hi";
	
    $wnatsno=$_POST['whatsno'];
    
	$ccm=implode(",",extract_email_address($_POST['ccemail']));
	$ccm=str_replace("<","",$ccm);
	$ccm=str_replace(">","",$ccm);
	$createdby=$qry2ro[0]."_".date("ymd").$num3;
	$chksql=mysqli_query($conc,"select alert_id from alert where createdby='".$createdby."'");
	if(mysqli_num_rows($chksql)==0)
	{

$adate=date('Y-m-d');

//echo "INSERT INTO `alert` (`alert_id`, `cust_id`,`atm_id`, `bank_name`, `area`, `address`, `city`, `branch_id`, `pincode`, `problem`, `entry_date`, `alert_date`, `caller_name`, `caller_phone`, `caller_email`, `status`, `call_status`, `alert_type`, `standby`, `po`, `assetstatus`, `appby`, `appref`,`state1`,`createdby`,`subject`,`custdoctno`,`ccmail`,`whatsapp`) VALUES (NULL, '".$_POST['cust']."','".$_POST['ref']."' , '".$_POST['bank']."', '".$_POST['area']."', '".$_POST['add']."', '".$_POST['city']."', '".$_POST['branch']."', '".$_POST['pin']."', '".$_POST['prob']."', '".$dt."', '".$adate."', '".$_POST['cname']."', '".$_POST['cphone']."', '".$_POST['cemail']."', 'Pending', 'Pending', 'service', '', '".$_POST['po']."','".$_POST['type']."', '".$_POST['appby']."', '".$_POST['how']."','".$_POST['state']."','".$qry2ro[0]."_".date("ymd").$num3."','".$_POST['sub']."','".$_POST['docket']."','".$ccm."' ,'".$wnatsno."')";
	    
	    
	    
	$sql = mysqli_query($conc,"INSERT INTO `alert` (`alert_id`, `cust_id`,`atm_id`, `bank_name`, `area`, `address`, `city`, `branch_id`, `pincode`, `problem`, `entry_date`, `alert_date`, `caller_name`, `caller_phone`, `caller_email`, `status`, `call_status`, `alert_type`, `standby`, `po`, `assetstatus`, `appby`, `appref`,`state1`,`createdby`,`subject`,`custdoctno`,`ccmail`,`whatsapp`) VALUES (NULL, '".$_POST['cust']."','".$_POST['ref']."' , '".$_POST['bank']."', '".$_POST['area']."', '".$_POST['add']."', '".$_POST['city']."', '".$_POST['branch']."', '".$_POST['pin']."', '".$_POST['prob']."', '".$dt."', '".$adate."', '".$_POST['cname']."', '".$_POST['cphone']."', '".$_POST['cemail']."', 'Pending', 'Pending', 'service', '', '".$_POST['po']."','".$_POST['type']."', '".$_POST['appby']."', '".$_POST['how']."','".$_POST['state']."','".$qry2ro[0]."_".date("ymd").$num3."','".$_POST['sub']."','".$_POST['docket']."','".$ccm."' ,'".$wnatsno."')");
	
	$alert_id=mysqli_insert_id();



	
	//========================mail============================
$tbl="<html>
<head>
<title>Switching AVO Electro Power Limited</title>
</head>
<body>
<p>New Call Logged from <font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font></p><table border='1' width='700px'><tr><th>COMPLAINT ID</th><th>ATM ID</th><th>BANK</th><th>State</th><th>City</th><th>Address</th><th>ISSUE</th><th>STATUS</th></tr>";

$tbl.="<tr><td>".$qry2ro[0]."_".date("ymd").$num3."</td><td>".$atro[0]."</td><td>".$_POST['bank']."</td><td>".$_POST['state']."</td><td>".$_POST['city']."</td><td>".$_POST['add']."</td><td>".$_POST['prblm']."</td><td><b>Pending</b></td></tr>";


//print_r($cc);
$subject= mysqli_real_escape_string($conc,$_POST['sub']);    
//echo "<br>";
$tbl.="</table><br><br><font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font></body></html>";
//echo $tbl."<br>";
//echo $mailto." ".$cc;
$headers = "From: <HelpDesk@avoservice.in>\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$headers .= "Cc: ".$ccm."\r\n";
			//echo $tbl."<br>";
			//echo $this->ccm;
			$message=$tbl;
			/*if(isset($this->sendmail))
			*/
			mail($_POST['cemail'], $subject, $message, $headers);
   
  $qrymail= mysqli_query($conc,"select branch_email from avo_branchmgr_email where branch_id='".$_POST['branch']."'");
   while($fetchemail=mysqli_fetch_array($qrymail)){
       
       	mail($fetchemail['branch_email'], $subject, $message, $headers);
   }
   //===============WhatsApp to Customer=============== 
   $delegate_flag=0;
   
$alertqry=mysqli_query($conc,"select * from alert where alert_id='".$alert_id."' ");
$alertr=mysqli_fetch_row($alertqry);

$custqry=mysqli_query($conc,"select cust_name from customer where cust_id='".$alertr[1]."' ");
$custname=mysqli_fetch_row($custqry);

if ($alertr[21]=='site') { 
$atm1qry=mysqli_query($conc,"select atm_id, expdt from atm where track_id ='".$alertr[2]."' ");
$atmr=mysqli_fetch_row($atm1qry);
$asstatus="Under Warranty. Expires on: ".$atmr[1];
$atm_no=$atmr[0];    
} 
elseif ($alertr[21]=='amc') {
$amcqry=mysqli_query($conc,"select atmid from Amc where amcid='".$alertr[2]."' ");
$amc=mysqli_fetch_row($amcqry);
$atm_no=$amc[0];
$atmqry=mysqli_query($conc,"select track_id from atm where atm_id ='".$atm_no."' ");

if(mysqli_num_rows($atmqry) > 0){
    $asset=mysqli_fetch_row($atmqry);

$batwarqry=mysqli_query($conc,"select * from site_assets where atmid='".$asset[0]."' and assets_name='Battery' order by site_ass_id DESC"); 
$bat=mysqli_fetch_row($batwarqry);
$bstatus=$bat[11];
$bexp=$bat[18];

if($bstatus==1) { $asstatus="UPS in AMC. Battery Under Warranty and Expires on: ".$bexp; }
else {$asstatus="UPS in AMC. Battery out of Warranty. Expired on: ".$bexp;}
} else {$asstatus="UPS in AMC. No any Battery supply";}

} else $asstatus="Chargeable or Temp Call";

if ($alertr[17]=='new') { $calltp="New Installation";} 
elseif ($alertr[17]=='service' || $alertr[17]=='new temp') { $calltp="Service Call";} 
elseif ($alertr[17]=='pm' || $alertr[17]=='temp_pm') { $calltp="PM Call";} 
elseif ($alertr[17]=='dere' || $alertr[17]=='temp_dere') { $calltp="De-Re Installation";}

         $MassageNew = "*Switching AVO Electro Power Ltd*";
        $Massage2="*Customer Name:* ".$custname[0] ;
        $Massage3="*ATM Id:* ".$atm_no;
        $Massage4="*Ticket No:* ".$alertr[25] ;
        $Massage5="*End User:* ".$alertr[3] ;
        $Massage6="*Address:* ".$alertr[5];
        $Massage7="*Type Of Call:* ".$calltp;
        $Massage8="*Problem Reported:* ".$alertr[9];
        $Massage9="*Asset Status:* ".$asstatus;
//===============

$atm_id=$_POST['ref'];
 $cutoff_date=date('Y-m-d 00:00:00', strtotime('-30 days'));

$last="select alert_id, entry_date from alert where atm_id='$atm_id' and entry_date >'$cutoff_date' and entry_date < NOW() and call_status !='Rejected' order by alert_id DESC limit 5";

$sql2=mysqli_query($conc,$last);


if(mysqli_num_rows($sql2) > 0) {

 $rowre=mysqli_fetch_row($sql2);

 $repet=mysqli_query($conc,"update alert set repeat_callid='".$rowre[0]."' where alert_id='".$req."'");
  
} else {
     //=========== Auto Delegation===================
  $req=$alert_id;
    //  $aidqry=mysqli_query($conc,"select max(alert_id) from alert where atm_id='".$_POST['ref']."'");
     //      $aidrow=mysqli_fetch_row($aidqry);
         //  $req=$aidrow[0];
           // GPS delegation
          if($_POST['type']=='site')
	$at=mysqli_query($conc,"select atm_id,latitude,longitude,address,city,state1 from atm where track_id='".$_POST['ref']."'");
	elseif($_POST['type']=='amc')
	$at=mysqli_query($conc,"select atmid,latitude,longitude,address,city,state from Amc where amcid='".$_POST['ref']."'");
	
	$atro=mysqli_fetch_row($at);
	if($atro[1]==0.0000000000)
	{
        $address=$atro[3].','.$atro[4].','.$atro[5];
        $formattedAddr = str_replace(' ','+',$address);
        //Send request and receive json data by address
        $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($formattedAddr).'&sensor=false&key=AIzaSyCBE1Xgn2mQmGOtUevIuFYw6443BkKCjbI'); 
        $output = json_decode($geocodeFromAddr);
        //Get latitude and longitute from json data
        //$data['latitude']  = $output->results[0]->geometry->location->lat; 
        //$data['longitude'] = $output->results[0]->geometry->location->lng;
        //Return latitude and longitude of the given address
        //print_r($output);
        //echo $data['latitude'];
        //echo $data['longitude'];
        
        $latitude=$output->results[0]->geometry->location->lat; 
        $longitude=$output->results[0]->geometry->location->lng; 
        
        if($_POST['type']=='site')
	          mysqli_query($conc,"update atm set latitude='".$latitude."',longitude='".$longitude."' where track_id='".$_POST['ref']."'");
	    elseif($_POST['type']=='amc')
	          mysqli_query($conc,"update Amc set latitude='".$latitude."',longitude='".$longitude."' where amcid='".$_POST['ref']."'");
        
	}
    else
    {
        $latitude=$atro[1]; 
        $longitude=$atro[2];
    }
    
   // $longitude = (float) 80.5908223000;
   // $latitude = (float) 25.6170441000;
    //$radius = 20; // in miles
      $radius = 25*0.621371192; // in km

    $lng_min = $longitude - $radius / abs(cos(deg2rad($latitude)) * 69);
    $lng_max = $longitude + $radius / abs(cos(deg2rad($latitude)) * 69);
    $lat_min = $latitude - ($radius / 69);
    $lat_max = $latitude + ($radius / 69);
   //==== Using Engr Current Location========     
    $qry="SELECT *,(6371 * acos( cos( radians($latitude) ) 
              * cos( radians( latitude ) ) 
              * cos( radians( longitude ) - radians($longitude) ) 
              + sin( radians($latitude) ) 
              * sin( radians( latitude ) ) ) ) AS distance FROM engg_current_location WHERE (longitude BETWEEN $lng_min AND $lng_max) AND (latitude BETWEEN $lat_min and $lat_max) ORDER BY distance";
  //=======or Engineer Residence========
   
   $qry="SELECT *,(6371 * acos( cos( radians($latitude) ) 
              * cos( radians( latitude ) ) 
              * cos( radians( longitude ) - radians($longitude) ) 
              + sin( radians($latitude) ) 
              * sin( radians( latitude ) ) ) ) AS distance FROM area_engg WHERE (longitude BETWEEN $lng_min AND $lng_max) AND (latitude BETWEEN $lat_min and $lat_max) and status=1 ORDER BY distance";  
  
    $res=mysqli_query($conc, $qry);
    $num=mysqli_num_rows($res);
    if($num>0){
        $row=mysqli_fetch_row($res);
        
$englat=$row[18];
$englong=$row[19];


if ($latitude =='0.00' || $latitude=='' ) {
$dis="Not Mapped" ;
} elseif ($englat =='0.00' || $englat=='' ) {
 $dis="Engr Not Mapped" ;   
} else {     
$dis1=distance($latitude, $longitude, $englat, $englong, "K"); 
$dis=$dis1." KMs";
} 
          $ctime=date("Y-m-d H:i:s");
         $etdt=date("Y-m-d H:i:s", strtotime($ctime." + 4 hours"));
         $delegate_flag=1;
         $tab=mysqli_query($conc,"update alert set status='Delegated',call_status='1',eta='".$etdt."', convert_into='".$dis."' where alert_id='".$req."'");

        if($tab){
		//$cdate = date('Y-m-d H:i:s');
		$tab2=mysqli_query($conc,"Insert into alert_delegation(engineer,atm,alert_id,date,delby) values('".$row[0]."','".$_POST['ref']."','".$req."','".$ctime."','".$_SESSION['user']."')");
                }
                if($tab2){
             // echo "Successfully Delegated"; 
                }
                
               mysqli_query($conc,"Insert into Delegation_tracking(alertid,del_type,del_date) values('".$req."',1,'".$ctime."')");
                
                $str2=array();
//echo "Select gcm_regid from notification_tble where logid='".$str."' AND pid='".$eng."' AND status='0'";
$qry1=mysqli_query($conc,"Select gcm_regid from notification_tble where pid='".$row[0]."' AND status='0'");
    
            while($max1=mysqli_fetch_row($qry1))
{
	$str2[]=$max1[0];

}

$message2="You have New Alerts";
include_once 'andi/GCM.php';
 $gcm = new GCM();
    //$registatoin_ids = $str2;
    $message = array("alert" => $message2);

    $result = $gcm->send_notification($str2, $message);
    
    //============Whatapp to Engr===========
      $engqry=mysqli_query($conc,"select phone_no1,engg_name from area_engg where engg_id='".$row[0]."' ");
 $engph=mysqli_fetch_row($engqry);
 $mobile=$engph[0];
$engg_name=$engph[1];
       
        $Massage1="[GPS]You have New Alert !!";
        
    $Message = $MassageNew."\n".$Massage1."\n".$Massage2."\n".$Massage3."\n".$Massage4."\n".$Massage5."\n".$Massage6."\n".$Massage7."\n".$Massage8 ."\n".$Massage9;
   
// SendWhatmsg($mobile,$Message);
    
    }
    // =================GPS delegation ends=============
    // ===================Delegation from History starts================
    if($delegate_flag==0){
      $delqry=mysqli_query($conc,"SELECT engineer,count(*) as cnt  FROM `alert_delegation` WHERE `alert_id` in(select `alert_id` from alert where atm_id='".$_POST['ref']."' and assetstatus='".$_POST['type']."') group by engineer order by cnt desc");
      $aidqry=mysqli_query($conc,"select max(alert_id) from alert where atm_id='".$_POST['ref']."'");
      $aidrow=mysqli_fetch_row($aidqry);
      $req=$aidrow[0];
      $bidqry=mysqli_query($conc,"select branch_id from alert where alert_id='".$req."'");
      $bidrow=mysqli_fetch_row($bidqry);
      $branch_id=$bidrow[0];
      $delegate_flag=0;
       while($delrow=mysqli_fetch_row($delqry))
       {
        $enqry=mysqli_query($conc,"select * from area_engg where engg_id='".$delrow[0]."' and area='".$branch_id."' and status=1"); 
        if(mysqli_num_rows($enqry)>0)
        {  // delegate
        
$engrow=mysqli_fetch_row($enqry);      
$englat=$engrow[18];
$englong=$engrow[19];


if ($latitude =='0.00' || $latitude=='' ) {
$dis="Not Mapped" ;
} elseif ($englat =='0.00' || $englat=='' ) {
 $dis="Engr Not Mapped" ;   
} else {     
$dis1=distance($latitude, $longitude, $englat, $englong, "K"); 
$dis=$dis1." KMs";
}  

         $ctime=date("Y-m-d H:i:s");
         $etdt=date("Y-m-d H:i:s", strtotime($ctime." + 4 hours"));
         $delegate_flag=1;
         $tab=mysqli_query($conc,"update alert set status='Delegated',call_status='1',eta='".$etdt."',convert_into='".$dis."' where alert_id='".$req."'");

        if($tab){
		//$cdate = date('Y-m-d H:i:s');
		$tab2=mysqli_query($conc,"Insert into alert_delegation(engineer,atm,alert_id,date,delby) values('".$delrow[0]."','".$_POST['ref']."','".$req."','".$ctime."','".$_SESSION['user']."')");
          
          mysqli_query($conc,"Insert into Delegation_tracking(alertid,del_type,del_date) values('".$req."',2,'".$ctime."')");
                }
            
            $str2=array();
//echo "Select gcm_regid from notification_tble where logid='".$str."' AND pid='".$eng."' AND status='0'";
$qry1=mysqli_query($conc,"Select gcm_regid from notification_tble where pid='".$delrow[0]."' AND status='0'");
    
            while($max1=mysqli_fetch_row($qry1))
{
	$str2[]=$max1[0];

}

$message2="You have New Alerts";
include_once '../andi/GCM.php';
 $gcm = new GCM();
    //$registatoin_ids = $str2;
    $message = array("alert" => $message2);

    $result = $gcm->send_notification($str2, $message);
    //============WhatsApp==========
      $engqry=mysqli_query($conc,"select phone_no1,engg_name from area_engg where engg_id='".$delrow[0]."' ");
 $engph=mysqli_fetch_row($engqry);
 $mobile=$engph[0];
$engg_name=$engph[1];
       
        $Massage1="[H]You have New Alert !!";
        
    $Message = $MassageNew."\n".$Massage1."\n".$Massage2."\n".$Massage3."\n".$Massage4."\n".$Massage5."\n".$Massage6."\n".$Massage7."\n".$Massage8 ."\n".$Massage9;
   
 //SendWhatmsg($mobile,$Message);
    
            break;
        }
        else
        continue;        
       }
    }
      //============Engr Mapping with engr_map Table=======================
       if($delegate_flag==0){
           
       if($_POST['type']=='site')
	$qrymap=mysqli_query($conc,"select engg_id from engg_site_mapping_warr where atm_='".$_POST['ref']."' and engg_id in (select engg_id from area_engg where status=1)");
	elseif($_POST['type']=='amc')
	$qrymap=mysqli_query($conc,"select engg_id from engg_site_mapping where atm_id='".$_POST['ref']."' and engg_id in (select engg_id from area_engg where status=1)");
	
  
        if($fetchmap= mysqli_fetch_array($qrymap)) {
           if($fetchmap[0]!=0){

$engqrye=mysqli_query($conc,"select latitude,longitude from area_engg where engg_id='".$fetchmap[0]."'");

$englatrow=mysqli_fetch_row($engqrye);           
$englat=$englatrow[0];
$englong=$englatrow[1];


if ($latitude =='0.00' || $latitude=='' ) {
$dis="Not Mapped" ;
} elseif ($englat =='0.00' || $englat=='' ) {
 $dis="Engr Not Mapped" ;   
} else {     
$dis1=distance($latitude, $longitude, $englat, $englong, "K"); 
$dis=$dis1." KMs";
}                 
               
           $delegate_flag=1;
           
         $ctime=date("Y-m-d H:i:s");
         $etdt=date("Y-m-d H:i:s", strtotime($ctime." + 4 hours"));
         
         $tab=mysqli_query($conc,"update alert set status='Delegated',call_status='1',eta='".$etdt."',convert_into='".$dis."' where alert_id='".$req."'");

        if($tab){
		//$cdate = date('Y-m-d H:i:s');
		$tab2=mysqli_query($conc,"Insert into alert_delegation(engineer,atm,alert_id,date,delby) values('".$fetchmap[0]."','".$_POST['ref']."','".$req."','".$ctime."','".$_SESSION['user']."')");
		
		 mysqli_query($conc,"Insert into Delegation_tracking(alertid,del_type,del_date) values('".$req."',3,'".$ctime."')");
                }
       
       
       
          $str2=array();
//echo "Select gcm_regid from notification_tble where logid='".$str."' AND pid='".$eng."' AND status='0'";
$qry1=mysqli_query($conc,"Select gcm_regid from notification_tble where pid='".$fetchmap[0]."' AND status='0'");
    
            while($max1=mysqli_fetch_row($qry1))
{
	$str2[]=$max1[0];

}

$message2="You have New Alerts";
include_once '../andi/GCM.php';
 $gcm = new GCM();
    //$registatoin_ids = $str2;
    $message = array("alert" => $message2);

    $result = $gcm->send_notification($str2, $message);
    
      //===========WhatsApp for History del============
  $engqry=mysqli_query($conc,"select  phone_no1, engg_name from area_engg where engg_id='".$fetchmap[0]."' ");
 $engph=mysqli_fetch_row($engqry);
 $mobile=$engph[0];
 $engg_name=$engph[1];
       
        $Massage1="[Map]You have New Alert !!";
      
    $Message = $MassageNew."\n".$Massage1."\n".$Massage2."\n".$Massage3."\n".$Massage4."\n".$Massage5."\n".$Massage6."\n".$Massage7."\n".$Massage8 ."\n".$Massage9;
    
// SendWhatmsg($mobile,$Message);
    
            break;
           }
        }
           
       }
      
}   
    //==============Delegation end   Cust whatsApp start here====================          
$cmobile=$alertr[13];
$gmobile=$alertr[45];
$whats_no=$cmobile.",".$gmobile;
    
 if($delegate_flag==1){
$cmessage="*[CA]Call is Logged and Delegated to:* ".$engg_name;
$cmmessage="*Mobile No:* ".$mobile;
$allMessage = $MassageNew."\n".$cmessage."\n".$cmmessage."\n".$Massage3."\n".$Massage4."\n".$Massage5."\n".$Massage6."\n".$Massage7."\n".$Massage8;

//SendWhatmsg($whats_no,$allMessage);
  } else {

$cmobile=$alertr[13];
$gmobile=$alertr[45];
$whats_no=$cmobile.",".$gmobile;

$cmessage="*Call is Logged with Us !!*" ;
$cmmessage="*Engineer Will be deligated shortly* ";
$allMessage = $MassageNew."\n".$cmessage."\n".$cmmessage."\n".$Massage3."\n".$Massage4."\n".$Massage5."\n".$Massage6."\n".$Massage7."\n".$Massage8;

//SendWhatmsg($whats_no,$allMessage);     
      
  }      
      
      
   
	if($sql){
	
	echo "<center><br><br><br>Call logged successfully, Docket no. is ".$qry2ro[0]."_".date("ymd").$num3."<br><br> <a href=service.php >click here</a> to log another call</center>";
	}
	else
	{
	echo "error , Please try again."."<a href=service.php >click here</a>";
	}
	}echo "This docket no is already given";
    }// else close
	?>
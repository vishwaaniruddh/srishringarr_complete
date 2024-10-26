<?php
include('config.php');
//$conc = Openconc();

//include("Whatsapp_delegation/delegation_fun.php");


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


function extract_email_address($str){
    // This regular expression extracts all emails from a string:
    $regexp = '/([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i';
    preg_match_all($regexp, $str, $m);

    return isset($m[0]) ? $m[0] : array();
}


    $qry="";
    $stat=0;
$tmb=date('Y-m-d 00:00:00', strtotime('-20 days'));
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
        echo "Sorry you cannot log the call. Either Call already in OPEN or It seems Site Issue Repeated within 20 Days."; }
    else if ($stat==1 || $rcnt>=6)   { 
        echo "Repeated Calls.Please contact Technical team / help desk of AVO.";
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
	if(mysqli_num_rows($chksql)>0){
	    echo "This docket no is already given";
	} else 
	{

$adate=date('Y-m-d');

	$sql = mysqli_query($conc,"INSERT INTO `alert` (`alert_id`, `cust_id`,`atm_id`, `bank_name`, `area`, `address`, `city`, `branch_id`, `pincode`, `problem`, `entry_date`, `alert_date`, `caller_name`, `caller_phone`, `caller_email`, `status`, `call_status`, `alert_type`, `standby`, `po`, `assetstatus`, `appby`, `appref`,`state1`,`createdby`,`subject`,`custdoctno`,`ccmail`,`whatsapp`) VALUES (NULL, '".$_POST['cust']."','".$_POST['ref']."' , '".$_POST['bank']."', '".$_POST['area']."', '".$_POST['add']."', '".$_POST['city']."', '".$_POST['branch']."', '".$_POST['pin']."', '".$_POST['prob']."', '".$dt."', '".$adate."', '".$_POST['cname']."', '".$_POST['cphone']."', '".$_POST['cemail']."', 'Pending', 'Pending', 'service', '', '".$_POST['po']."','".$_POST['type']."', '".$_POST['appby']."', '".$_POST['how']."','".$_POST['state']."','".$qry2ro[0]."_".date("ymd").$num3."','".$_POST['sub']."','".$_POST['docket']."','".$ccm."' ,'".$wnatsno."')");
	
	$alert_id=mysqli_insert_id($conc);


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

        }    
       }
    }
  
}   
 
	if($sql){
	
	echo "<center><br><br><br>Call logged successfully, Docket no. is ".$qry2ro[0]."_".date("ymd").$num3."<br><br> <a href=service.php >click here</a> to log another call</center>";
	}
	else
	{
	echo "error , Please try again."."<a href=service.php >click here</a>";
	}
	
	}
    }// else close
	?>
<?php
include('config.php');
$sqlme=$_POST['qr'];
$sqlme=$sqlme;//.' limit 400';
//echo $sqlme;



$table=mysqli_query($con1,$sqlme);

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/s', ' ', $string); 
  
   return preg_replace('/-+/', '-', $string); 
}

//========Function for distnace =========================

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

//echo mysqli_num_rows($table);

$contents='';
 $contents.="Sr. No.\t Complaint ID\t Call Request Type\t Vertical-Client Name\t Site/Sol/ATM ID\t End User\t City\t Area\t Address\t Branch\t Problem\t Alert Date\t Delegation time\t Contact Person\t Phone\t Engineer Name\t Engr Mobile\t Call Type\t Customer Status\t Response Time\t Last FeedBack\t  Last update Time\t Problem Type\t Call Open Ageing\t Distnace from Engr Resi\t Repeat Call\t ";
// echo $contents;
 $cnt=0;
 
while($row=mysqli_fetch_row($table))
{
$cnt++;

if($row[21] =='amc'){ 
$atm=mysqli_query($con1,"select atmid, latitude1, longitude1 from Amc where amcid='".$row[2]."'");
}
if($row[21] =='site'){
$atm=mysqli_query($con1,"select atm_id, latitude, longitude from atm where track_id='".$row[2]."'");
}
$atmro=mysqli_fetch_row($atm);
//==========Cust
$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);

//=======Engr================
$oldeng=mysqli_query($con1,"select engineer,date from alert_delegation where alert_id='".$row[0]."' order by id DESC limit 1");
        $getold=mysqli_fetch_row($oldeng);
      //  $getold[0]=1;
$engr=mysqli_query($con1,"select engg_name, phone_no1,latitude, longitude from area_engg where engg_id='".$getold[0]."'");
	$engro=mysqli_fetch_row($engr);
//===========	
	 $contents.="\n".$cnt."\t";
	 $contents.=$row[25]."\t";
	 $contents.=$row[30]."\t";
	 $contents.=$custrow[0]."\t";
if($row[17]=='temp_pm' || $row[17]=='new temp' || $row[17]=='temp_dere')
	{
	 $contents.=clean(trim($row[2]))."\t";
	 } 
	 else 	  {  
 $contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $atmro[0]))."\t";
         }
	
	 $contents.=clean(trim($row[3]))."\t";
	 $contents.=clean(trim(str_replace("\n","",$row[6])))."\t";
	 $contents.=clean(trim(addslashes($row[4])))."\t";
     $contents.=clean(trim(addslashes($row[5])))."\t";
    
    $branch=mysqli_query($con1,"select name from avo_branch where id='".$row[7]."'");
    $branchro=mysqli_fetch_row($branch);    
        $contents.=$branchro[0]."\t";
	
     $contents.=clean($row[9])."\t";
     $contents.= date('d/m/Y H:i:s',strtotime($row[10])); 
     $contents.="\t";
//==========Delegation time====
  $contents.=$getold[1]."\t";

//======= Contact Person  ======
     $contents.=trim(preg_replace('/\s+/', ' ', $row[12]))."\t";
//======= Phone ======
     $contents.=trim($row[13])."\t";
//=======Engineer Name ======
     
  //  $contents.=trim($engro[0])." (". $engro[1].")"."\t";
    $contents.=trim($engro[0])."\t";
    $contents.=trim($engro[1])."\t";

//=======Call Type ======
     $contents.=$row[17]."\t";
//===== Customer Status ===========    
    if(0 === strpos($row[2], 'temp'))
    {
 $atm=mysqli_query($con1,"select type from tempsites where atmid='".$row[2]."' and custid='".$row[1]."'");
        $ress=mysqli_fetch_row($atm);
        if($ress[0]=="addon")$contents.="ADDON"."\t";
        else
	$contents.="PCB"."\t";
       
	}
	else
 	if($row[21]=='site'){ $contents.="Under Warranty"."\t"; }
 	
 	else if($row[21]=='amc'){ $contents.="AMC"."\t"; }else{ $contents.="PCB"."\t"; }
//=======Response Time====== 
 if($row[24]!='0000-00-00 00:00:00')
 	$contents.=date('d/m/Y H:i:s',strtotime($row[24]));
 
 	$contents.="\t";
 //========Last FeedBack ========	
   
	$al=mysqli_query($con1,"select id,feedback, feed_date from eng_feedback where alert_id='".$row[0]."' order by id DESC ");
	$alro=mysqli_fetch_row($al);
 	
 	$engf=clean(preg_replace('/\s+/', ' ', $alro[1]));
	$engf=str_replace("\n"," ",$engf);
	$contents.=$engf;
 	
 $contents.="\t";
 
 //============Last update Time =============

 $contents.= date('d/m/Y H:i:s',strtotime($alro[2]));
$contents.="\t";
//===============Problem Type =================
$rejsta=mysqli_query($con1,"select * from `siteproblem` where `alertid`='".$row[0]."'");
//echo "select * from `siteproblem` where `alertid`='".$row[0]."'";
		if(mysqli_num_rows($rejsta)>0){
	 	$rejsta1=mysqli_fetch_row($rejsta);
	 	if($rejsta1[2]==0)$contents.=$rejsta1[3];
	 	else{
	 	$rejstax=mysqli_query($con1,"select problem from `problemtype` where `probid`='".$rejsta1[2]."'");
	 	$rejstay=mysqli_fetch_row($rejstax);
	 	$contents.=$rejstay[0];}
	 	}
		
$contents.="\t";

 
//==============Open call Easing ====

$ct=date('Y-m-d H:i:s');
	  $to_time = strtotime($ct);
	$from_time = strtotime($row[10]); 

$diff=round(abs($to_time - $from_time) / 3600,2);  // Hours
$ddiff=round(abs($to_time - $from_time) / (3600*24),2); // Days

if($diff<2.0){ $age = "Below 2 Hrs";}
    else if($diff<4.0){ $age = "Below 4 Hrs";}
	else if($diff<8.0) { $age = "Below 8 Hrs";}
	else if($diff<12.0){ $age = "Below 12 Hrs";}
				else if($ddiff<1.0){ $age ="Below 1 Day";}
				else if($ddiff<2.0){ $age ="Below 2 Days";}
				else if($ddiff<3.0){ $age ="Below 3 Days";}
				else if($ddiff<5.0){ $age ="Below 5 Days";}
				else $age ="Above 5 Days";
$contents.=$age."\t";


/*if($row[16]==1 or $row[16]=='Pending'){	
$curtime=strtotime(date("Y-m-d h:i:s"));
$logcalltime=strtotime($row[10]);
$diff_seconds2= $curtime-$logcalltime;

$contents.= floor($diff_seconds2/3600).' hours and '.floor(($diff_seconds2/3600)%60).' minutes';
//echo $diff_seconds2;
}else{
	//==============Close call Easing ====
		$closetime=strtotime($row[18]);
		$logcalltime=strtotime($row[10]);
		$diff_seconds2  = $closetime-$logcalltime;
		$contents.= floor($diff_seconds2/3600).' hours and '.floor(($diff_seconds2%3600)/60).' minutes';
		
		//echo "closetime".$row[18];
		//echo "logcalltime".$row[10];
		} 
	$contents.="\t"; */

//==============Distance==============

$englat=$engro[2];
$englong=$engro[3];

$sitelat=$atmro[1];
$sitelong=$atmro[2];

if ($sitelat =='0.00' || $sitelat=='' ) {
$dis="Not Mapped" ;
} elseif ($englat =='0.00' || $englat=='' ) {
 $dis="Engr Not Mapped" ;   
} else {     
$dis1=distance($sitelat, $sitelong, $englat, $englong, "K"); 
$dis=$dis1;
} 
$contents.=$dis. "\t";


if($row[43] !='') { $rep= "Repeated Call";} else $rep="";
$contents.=$rep. "\t";

}


$contents = strip_tags($contents); 

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
//  header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
   header("Content-Disposition: attachment; filename=mis.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
 
?>
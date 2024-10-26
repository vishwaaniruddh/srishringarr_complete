<?php
include('config.php');
$sqlme=$_POST['qr'];
$sqlme=$sqlme.' limit 3000';
//echo $sqlme;

$table=mysqli_query($con1,$sqlme);

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}


$contents='';
 $contents.="Sr. No.\t Complaint ID\t  Vertical-Client Name\t Site/Sol/ATM ID\t End User\t  Address\t  Branch\t Alert Date\t Delegation time\t Call Status\t Call Hold time\t Un-Hold Time\t Engineer Name\t Call Type\t  Response Time\t Last update\t All updates\t Problem Type\t Problem Group\t  ";

 $cnt=0;
 
while($row=mysqli_fetch_row($table))
{
$cnt++;
//echo $cnt;

$time1 = strtotime($row[10]); //entry date
$time2 = strtotime($row[18]); // close date

$diff = $time2-$time1;
$hours = $diff / 3600; // 3600 seconds in an hour
$minutes = ($hours - floor($hours)) * 60;
$final_hours = round($hours,0);
$final_minutes = round($minutes);//echo $final_hours. "/" .$final_minutes;

if($row[21] ==  'amc')
        $atm=mysqli_query($con1,"select atmid from Amc where amcid='".$row[2]."'");
	if($row[21] == 'site')	
        {
	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'");
	}
//==============Cust

	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);

//=================Engineer=======
//echo "select engg_name from area_engg where engg_id=(select engineer from alert_delegation where alert_id='".$row[0]."')<br>";
        $oldeng=mysqli_query($con1,"select engineer,date from alert_delegation where alert_id='".$row[0]."' order by id DESC limit 1");
        $getold=mysqli_fetch_row($oldeng);
      //  $getold[0]=1;
	$engr=mysqli_query($con1,"select engg_name, phone_no1 from area_engg where engg_id='".$getold[0]."'");
	$engro=mysqli_fetch_row($engr);
//====Output=============	
	
	 $contents.="\n".$cnt."\t";
	 //========Ticket No==============
	 $contents.=$row[25]."\t";
	//============Customer=======
	 $contents.=$custrow[0]."\t";
//=========ATM ID=============
if($row[17]=='temp_pm' || $row[17]=='new temp' || $row[17]=='temp_dere' || $row[17]=='temp_servi')
	{
	 $contents.=clean(trim($row[2]))."\t";
	 
	 } 
	 else
	  {  
         $atmrow=mysqli_fetch_row($atm);

   	 $contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $atmrow[0]))."\t";
 
         }
		$contents.=clean(trim(addslashes($row[3])))."\t";
	$contents.=clean(trim(addslashes($row[5])))."\t";
	
    
//==================Branch
     
    $branch=mysqli_query($con1,"select name from avo_branch where id='".$row[7]."'");
    $branchro=mysqli_fetch_row($branch);    
    $contents.=$branchro[0]."\t";
	
     
     $contents.= date('d/m/Y H:i:s',strtotime($row[10])); 
     $contents.="\t";
//==========Delegation time====
  $contents.=$getold[1]."\t";
  
//============Call Status============
if( $row[16]=='onhold') {$stat="Hold Call"; } else $stat= "Open Call";
 $contents.=$stat."\t";
  
  
//============Call Hold & Unhold time

    $hold=mysqli_query($con1,"select update_time from alert_updates where alert_id='".$row[0]."' and reason='hold' ORDER BY ASC LIMIT 1");
	$holdrow=mysqli_fetch_row($hold);

	$contents.= $holdrow[0]."\t";

//   ========== unhold=========== -->

    $unhold=mysqli_query($con1,"select update_time from alert_updates where alert_id='".$row[0]."' and reason='unhold' ORDER BY DESC LIMIT 1");
	$unholdrow=mysqli_fetch_row($unhold);

	$contents.= $unholdrow[0]."\t";

//=======Engineer Name ======
     
  //  $contents.=trim($engro[0])." (". $engro[1].")"."\t";
    $contents.=trim($engro[0])."\t";
    
//=======Call Type ======
     $contents.=$row[17]."\t";

//=======Response Time====== 
 if($row[24]!='0000-00-00 00:00:00')
 	$contents.=date('d/m/Y H:i:s',strtotime($row[24]));
 
 	$contents.="\t";
 
//========Last FeedBack ========	
$al=mysqli_query($con1,"select feedback from eng_feedback where alert_id='".$row[0]."'order by id DESC");
	$alro=mysqli_fetch_row($al);
 	
 	$engf=clean(preg_replace('/\s+/', ' ', $alro[0]));
	$engf=str_replace("\n"," ",$engf);
	$contents.=$engf;
 	
 $contents.="\t";
 //=======Engineers FeedBack  ============
 
$a2=mysqli_query($con1,"select feedback,feed_date from eng_feedback where alert_id='".$row[0]."' order by id ASC ");
while($alro2=mysqli_fetch_row($a2))
{
	$contents.=clean(str_replace("\n","  ",$alro2[0])).",";
}
	$contents.="\t";

//===============Problem Type =================
$rejsta=mysqli_query($con1,"select * from `siteproblem` where `alertid`='".$row[0]."'");
 	$rejsta1=mysqli_fetch_row($rejsta);
	 
	 	$contents.=$rejsta1[3];

$contents.="\t";

$qrygr=mysqli_query($con1,"select prob_group from `problemtype` where `probid`='".$rejsta1[2]."'");
	 	$probgr=mysqli_fetch_row($qrygr);
	 	
	$contents.=$probgr[0]."\t";
   
//==============Open call Easing ====
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
		} */
	$contents.="\t";
	 	
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
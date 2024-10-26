<?php
 include('config.php');
//include('db_connection.php');
//$con1 = OpenCon1();

$sqlme=$_POST['qr'];
$sqlme=$sqlme;//.' limit 400';
//echo $sqlme;

$table=mysqli_query($con1,$sqlme);


function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}

/*function clean($string) {

$string = preg_replace_callback('/\{(.*?)\}/', function ($matches) {
      return $GLOBALS[$matches[1]]; 
}, $string);
return ($string); 
}

function clean($string) {
    $string=htmlspecialchars($string ?? '');
   // $string = str_replace(' ', ' ', $string); 
    $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/s', ' ', $string);
   return ($string); 
}*/

//echo mysqli_num_rows($table);

$contents='';
 $contents.="Sr. No.\t Complaint ID\t Call Request Type\t Vertical-Client Name\t Site/Sol/ATM ID\t End User\t City\t Area\t Address\t State\t Branch\t Problem\t Alert Date\t Delegation time\t Contact Person\t Phone\t Engineer Name\t Engr Mobile\t  Del Status\t Distance from Engr\t Call Type\t Customer Status\t Response Time\t Resolution Time\t Call close time\t Last FeedBack\t  Last update Time\t Location\t Engineers FeedBack\t Status\t Repeat Call\t Approved By\t Approval Rem\t"; 
 
 // Problem Type\t  Visits\t Hold Time\t Unhold Time\t Hold Reason\t ";
 
// echo $contents;
 $cnt=0;
 
while($row=mysqli_fetch_row($table))
{
$cnt++;


//$time1 = strtotime($row[10]); //entry date
//$time2 = strtotime($row[18]); // close date

//$diff = $time2-$time1;
//$hours = $diff / 3600; // 3600 seconds in an hour
//$minutes = ($hours - floor($hours)) * 60;
//$final_hours = round($hours,0);
//$final_minutes = round($minutes);//echo $final_hours. "/" .$final_minutes;


	if($row[21] ==  'amc') {
        $atm=mysqli_query($con1,"select atmid from Amc where amcid='".$row[2]."'");
        $atmrow=mysqli_fetch_row($atm);
        $atm_id = $atmrow[0];
        
	} elseif($row[21] == 'site')	
        {
	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'");
	$atmrow=mysqli_fetch_row($atm);
	$atm_id = $atmrow[0];
		} 
		
		else {
		     $atm_id=$row[2];
		}

	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
	
	$tab=mysqli_query($con1,"select feedback,standby from eng_feedback where alert_id='".$row[0]."' order by id DESC"); //taking time
	$row1=mysqli_fetch_row($tab);

        $oldeng=mysqli_query($con1,"select engineer,date, status,call_close_status from alert_delegation where alert_id='".$row[0]."' order by id DESC limit 1");
        if(mysqli_num_rows($oldeng)>0){
        $getold=mysqli_fetch_row($oldeng);
      //  $getold[0]=1;
	$engr=mysqli_query($con1,"select engg_name, phone_no1 from area_engg where engg_id='".$getold[0]."'");
	
	$engro=mysqli_fetch_row($engr);
	$engg_name=$engro[0];
	$engg_no = $engro[1];
	
	if($getold[2]==2){ $engstat = "Engineer Rejeceted";}
	else if($getold[3]==2){ $engstat = "Attended -Pending";} else {$engstat='';}
        } else {
            $engg_name='';
	$engg_no = '';
	$engstat ='';
        } 
	 $contents.="\n".$cnt."\t";
	 $contents.=$row[25]."\t";
	 $contents.=$row[30]."\t";
	 $contents.=$custrow[0]."\t";

	 $contents.=clean(trim($atm_id))."\t";
//	 $contents.=trim($atm_id)."\t";
	 
	
	 $contents.=trim($row[3])."\t";
	 $contents.=trim($row[6])."\t";
	 $contents.=trim($row[4])."\t";
     $contents.=clean(trim(addslashes($row[5])))."\t";
   //  $contents.=trim(addslashes($row[5]))."\t";
     
	$contents.=trim($row[27])."\t";
    $branch=mysqli_query($con1,"select name from avo_branch where id='".$row[7]."'");
    $branchro=mysqli_fetch_row($branch);    
        $contents.=$branchro[0]."\t";
	
     $contents.=clean($row[9])."\t";
    //  $contents.=$row[9]."\t";
      
      
     $contents.= $row[10]; 
     $contents.="\t";
//==========Delegation time====
  $contents.=$getold[1]."\t";

//======= Contact Person  ======
     $contents.=trim(preg_replace('/\s+/', ' ', $row[12]))."\t";
//======= Phone ======
     $contents.=trim($row[13])."\t";
//=======Engineer Name ======
     
 
    $contents.=trim($engg_name)."\t";
    $contents.=trim($engg_no)."\t";
    $contents.=$engstat."\t";
   
$contents.=$row[37]."\t";
//=======Call Type ======
if($row[17]=='service' or $row[17]=='new temp'){ $ctyp="Service";}
if($row[17]=='pm' or $row[17]=='temp_pm'){ $ctyp="PM Call";}
if($row[17]=='dere' or $row[17]=='temp_dere'){ $ctyp="De-Re";}
if($row[17]=='new'){ $ctyp="Inst";}
     $contents.=$ctyp."\t";
//===== Customer Status ===========    
  
  	if($row[21]=='' || $row[21]=='site'){ $contents.="Under Warranty"."\t"; }
 	
 	else if($row[21]=='amc'){ $contents.="AMC"."\t"; }else{ $contents.="PCB"."\t"; }
//=======Response Time====== 
 if($row[24]!='0000-00-00 00:00:00')
 	$contents.=date('d/m/Y H:i:s',strtotime($row[24]));
 
 	$contents.="\t";
 //=======Response Time=====
 	if($row[18]!='0000-00-00 00:00:00')
	$contents.=$final_hours. "h " .$final_minutes."m";
	$contents.="\t";
//========Call close Time========
	$contents.=$row[18]."\t";
//========Last FeedBack ========	
   
	$al=mysqli_query($con1,"select id,feedback, feed_date,fromplace from eng_feedback where alert_id='".$row[0]."' order by id DESC ");

 	if(mysqli_num_rows($al)>0){
 	  	$alro=mysqli_fetch_row($al);  
 	    $engf=clean(preg_replace('/\s+/', ' ', $alro[1]));
 	 //   $engf=$alro[1];
    	$engf=str_replace("\n"," ",$engf);
    	$feedb = $engf;
    	$lastupdt = $alro[2];
    	$locat = $alro[3];
    	
 	} 	else {
 	    $feedb = '';
    	$lastupdt = '';
    	$locat = '';
 	}
    	$contents.=$feedb."\t";
//============Last update Time =============
$contents.= $lastupdt."\t";

//===========Location=========
	$contents.=$locat."\t";

 //=======Engineers FeedBack  ============
 $fdate;
 
$a2=mysqli_query($con1,"select feedback,feed_date from eng_feedback where alert_id='".$row[0]."' order by id ASC ");
 if(mysqli_num_rows($a2)>0){
while($alro2=mysqli_fetch_row($a2))
{
$contents.=clean(str_replace("\n","  ",$alro2[0])).",";
//$contents.=str_replace("\n","  ",$alro2[0]).",";
    }
// 	$contents.=clean(str_replace("\n","  ",$alro2[0])).",";


$fdate=$alro2[1];
}
	$contents.="\t";

//===============Problem Type =================

/* $rejsta=mysqli_query($con1,"select * from `siteproblem` where `alertid`='".$row[0]."'");
//echo "select * from `siteproblem` where `alertid`='".$row[0]."'";
		if(mysqli_num_rows($rejsta)>0){
	 	$rejsta1=mysqli_fetch_row($rejsta);
	 	if($rejsta1[2]==0) {$contents.=$rejsta1[3];}
	 	else{
	 	$rejstax=mysqli_query($con1,"select problem from `problemtype` where `probid`='".$rejsta1[2]."'");
	 	$rejstay=mysqli_fetch_row($rejstax);
	 	$contents.=$rejstay[0];}
	 	}
		
$contents.="\t"; */


if($row[15]=='Done') { $stat="Closed By Engg"; }
else if($row[16]=='Done') { $stat="Closed By Branch"; }
else if($row[16]=='Rejected') { $stat="Rejected by Branch"; }
else if($row[16]=='onhold') { $stat="Call on Hold"; }
else { $stat="Pending"; }
	 $contents.=$stat. "\t";
	 
//$contents.=$row[15]. "\t";
//$contents.=$row[16]. "\t";

//$contents.=trim(preg_replace('/\s+/', ' ', $row[22]))."\t";
//$contents.=trim(preg_replace('/\s+/', ' ', $row[23]))."\t";

//=========== FSR Data==========

/*$fsr= mysqli_query($con1,"SELECT upsmodel from FSR_details where alertid='".$row[0]."'");

//echo "SELECT * from FSR_details where alertid='".$row[0]."'";

$fsr_result = mysqli_fetch_assoc($fsr);  

if(mysqli_num_rows($fsr)>0){
   $contents.=$fsr_result['upsmodel']."\t"; 
} */

 //========== No.of Visits==============

/*$result = mysqli_query($con1,"SELECT COUNT(responsetime) AS `count` FROM `alert_progress` where alert_id='".$row[0]."' and responsetime !='0000-00-00 00:00:00'");

$rowr = mysqli_fetch_assoc($result);
$cnt1 = $rowr['count'];
$contents.=$cnt1. "\t";*/

if($row[43] !='') { $dis= "Repeated Call";} else $dis="";

$contents.=$dis. "\t";
//=========approved========
$contents.=clean($row[22]). "\t";
$contents.=clean($row[23]). "\t";

//$contents.=$row[22]. "\t";
//$contents.=$row[23]. "\t";

//==========Hold_unhold

/*$holdqr = mysqli_query($con1,"SELECT * FROM `alert_hold_unhold` where alert_id='".$row[0]."' order by id DESC");
$hold=mysqli_fetch_row($holdqr);

if(mysqli_num_rows($holdqr)>0){
    $holdtime=$hold[2];
    $unholdtime=$hold[3];
    $holdreas=clean($hold[4]);
    
    } else {
        $holdtime='';
    $unholdtime='';
    $holdreas='';
    }

 $contents.=$holdtime. "\t";
    $contents.=$unholdtime. "\t";
    $contents.=clean($holdreas). "\t"; */
    
    
}
$contents = strip_tags($contents); 
  header("Content-Disposition: attachment; filename=calls.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;

?>

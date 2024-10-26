<?php
include('config.php');
$sqlme=$_POST['qr'];
//echo $sqlme;
$table=mysqli_query($con1,$sqlme);

$contents='';
 $contents.="Complain ID \t Client Docket Number \t Name \t ATM \t Bank \t City \t Area \t Address \t State \t Branch \t Problem \t Alert Date \t Contact Person \t Phone \t Engineer Name\t Call Type \t Customer Status \t Response Time \t Resolution Time \t Call close time\t Last FeedBack \t Engineers FeedBack \t Problem Type \t Last update Time \t Call Open Easing \t";
 
while($row=mysqli_fetch_row($table))
{
if($row[2]!='temp_'){
$time1 = strtotime($row[10]); //entry date
$time2 = strtotime($row[18]); // close date

$diff = $time2-$time1;
$hours = $diff / 3600; // 3600 seconds in an hour
$minutes = ($hours - floor($hours)) * 60;
$final_hours = round($hours,0);
$final_minutes = round($minutes);//echo $final_hours. "/" .$final_minutes;


	if($row[17]=='service' &&  $row[21] ==  'amc')
        $atm=mysqli_query($con1,"select atmid from Amc where amcid='".$row[2]."'");
	if($row[17]=='new' &&  $row[21] == 'site')
	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'");


	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
	$tab=mysqli_query($con1,"select feedback,standby from eng_feedback where alert_id='".$row[0]."' order by id DESC");
	$row1=mysqli_fetch_row($tab);
	//echo "select engg_name from area_engg where engg_id=(select engineer from alert_delegation where alert_id='".$row[0]."')<br>";
	$engr=mysqli_query($con1,"select engg_name from area_engg where engg_id=(select engineer from alert_delegation where alert_id='".$row[0]."' order by id DESC limit 1)");
	$engro=mysqli_fetch_row($engr);
	 $contents.="\n".$row[25]."\t";
	 $contents.=$row[30]."\t";
	 $contents.=$custrow[0]."\t";
	if($row[17]=='temp_pm' || $row[17]=='new temp' || $row[17]=='temp_dere' || $row[17]=='temp_servi')
	{
	 $contents.=str_replace("\n","",preg_replace('/\s+/', '', $row[2]));
	 //echo $row[2];
	 } 
	 else
	  {  
         $atmrow=mysqli_fetch_row($atm);
   	 $contents.=str_replace("\n","",preg_replace('/\s+/', '', $atmrow[0]));
         //echo $atmrow[0]; 
         }
	// print $contents;
	$contents.="\t";
	 $contents.=$row[3]."\t";
	 //$contents.=$row[27]."\t";
	 $contents.=$row[6]."\t";
         $contents.=preg_replace('/\s+/', ' ', $row[4])."\t";
	// $contents.=$row[4]."\t";
        $contents.=preg_replace('/\s+/', ' ', addslashes($row[5]))."\t";
	// $contents.=$row[5]."\t";
	 
	  $contents.=$row[27]."\t";
 $branch=mysqli_query($con1,"select name from avo_branch where id='".$row[7]."'");
    $branchro=mysqli_fetch_row($branch);    
        $contents.=$branchro[0]."\t";
	   if($row[28]=='1')
 {

 $buy=mysqli_query($con1,"select * from buyback where alertid='".$row[0]."'");
 $buyro=mysqli_fetch_row($buy);

 $contents.=$buyro[2]."\t";
 }
 
 
$contents.=preg_replace('/\s+/', ' ', $row[9])."\t";


// if($row[17]=='service' || $row[17]=='new temp')
// {
 $contents.= date('m/d/Y H:i:s',strtotime($row[10])); 
/* } 
  else
  { 
  if(isset($row[11]) and $row[11]!='0000-00-00') {
  $contents.= date('m/d/Y H:i:s',strtotime($row[11]));
         }
   }*/
  
   $contents.="\t";
   //======= Contact Person  ======
   $contents.=$row[12]."\t";
    //======= Phone ======
    $contents.=$row[13]."\t";
	 //=======Engineer Name ======
    $contents.=$engro[0]."\t";
     //=======Call Type ======
    $contents.=$row[17]."\t";
//===== Customer Status ===========    
    if(0 === strpos($row[2], 'temp'))
	$contents.="PCB"."\t";
	else
 	if($row[21]=='' || $row[21]=='site'){ $contents.="Under Warranty"."\t"; }else if($row[21]=='amc'){ $contents.="AMC"."\t"; }else{ $contents.="PCB"."\t"; }
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
 	if($row1[0]!=''){  
	$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row1[0])); 
 	}else{ 
	$al=mysqli_query($con1,"select max(id),feedback from eng_feedback where alert_id='".$row[0]."'");
	$alro=mysqli_fetch_row($al);
 	$engf=preg_replace('/\s+/', ' ', $alro[1]);
	//$engf=str_replace("\n"," ",$alro[1]);
	$contents.=$engf;
 	}
 $contents.="\t";
 //=======Engineers FeedBack  ============
$a2=mysqli_query($con1,"select feedback from eng_feedback where alert_id='".$row[0]."' order by id ASC ");
while($alro2=mysqli_fetch_row($a2))
{
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $alro2[0])).",";
}
$contents.="\t";
//===============Problem Type =================
$rejsta=mysqli_query($con1,"select * from `siteproblem` where `alertid`='".$row[0]."'");
		if(mysqli_num_rows($rejsta)>0){
	 	$rejsta1=mysqli_fetch_row($rejsta);
	 	$rejstax=mysqli_query($con1,"select problem from `problemtype` where `probid`='".$rejsta1[2]."'");
	 	$rejstay=mysqli_fetch_row($rejstax);
	 	$contents.=$rejstay[0];
	 	}
		
$contents.="\t";

 //============Last update Time =============
$feddtim=mysqli_query($con1,"select feed_date from eng_feedback where alert_id='".$row[0]."' order by id DESC limit 1 ");
while($feddtim1=mysqli_fetch_row($feddtim))
{
if(isset($feddtim1[0]) and $feddtim1[0]!='0000-00-00') 
  $contents.= date('d/m/Y H:i:s',strtotime($feddtim1[0]));
}
$contents.="\t";
if($row[16]==1 or $row[16]=='Pending'){	
//==============Open call Easing ====
$curtime=strtotime(date("Y-m-d h:i:s"));
$logcalltime=strtotime($row[10]);
$diff_seconds2  = $curtime-$logcalltime;
$contents.= floor($diff_seconds2/3600).' hours and '.floor(($diff_seconds2%3600)/60).' minutes';
}else{
	
	//==============Close call Easing ====
		$closetime=strtotime($row[18]);
		$logcalltime=strtotime($row[10]);
		$diff_seconds2  = $closetime-$logcalltime;
		$contents.= floor($diff_seconds2/3600).' hours and '.floor(($diff_seconds2%3600)/60).' minutes';
	}
		
$contents.="\t";	 	
$contents.=$row[15];
/*$a3=mysqli_query($con1,"select up from alert_updates where alert_id='".$row[0]."' order by id ASC ");
while($alro3=mysqli_fetch_row($a3))
{
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $alro3[0])).",";
}*/
 $contents.="\n";
 
	}
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
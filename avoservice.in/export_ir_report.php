<?php
include('config.php');
$sqlme=$_POST['qr'];
$sqlme=$sqlme;//.' limit 400';
//echo $sqlme;
$table=mysqli_query($con1,$sqlme);
//echo mysqli_num_rows($table);

$contents='';
 $contents.="Sr. No.\t Complaint ID\t Call Request Type\t Vertical-Client Name\t Site/Sol/ATM ID\t End User\t City\t Area\t Address\t State\t Branch\t Problem\t Alert Date\t  Engineer Name\t Response Time\t Call close time\t Last FeedBack\t UPS Sl. No\t ";
// echo $contents;
 $cnt=0;
 
while($row=mysqli_fetch_row($table))
{
$cnt++;


$time1 = strtotime($row[10]); //entry date
$time2 = strtotime($row[18]); // close date

$diff = $time2-$time1;
$hours = $diff / 3600; // 3600 seconds in an hour
$minutes = ($hours - floor($hours)) * 60;
$final_hours = round($hours,0);
$final_minutes = round($minutes);//echo $final_hours. "/" .$final_minutes;


	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'");
	$atmrow=mysqli_fetch_row($atm);
	
	if(mysqli_num_rows($atm)!=0){
	$atmid=$atmrow[0] ; 
	} else { $atmid = $row[2]; }
	
	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
	$tab=mysqli_query($con1,"select feedback,standby from eng_feedback where alert_id='".$row[0]."' order by id DESC"); //taking time
	$row1=mysqli_fetch_row($tab);
//echo "select engg_name from area_engg where engg_id=(select engineer from alert_delegation where alert_id='".$row[0]."')<br>";
        $oldeng=mysqli_query($con1,"select engineer from alert_delegation where alert_id='".$row[0]."' order by id DESC limit 1");
        $getold=mysqli_fetch_row($oldeng);
      //  $getold[0]=1;
	$engr=mysqli_query($con1,"select engg_name, phone_no1 from area_engg where engg_id='".$getold[0]."'");
	$engro=mysqli_fetch_row($engr);
	 $contents.="\n".$cnt."\t";
	 $contents.=$row[25]."\t";
	 $contents.=$row[30]."\t";
	 $contents.=$custrow[0]."\t";
     $contents.=$atmid."\t"; // ATM ID
	
	 $contents.=trim(preg_replace('/\s+/', ' ', $row[3]))."\t";
	 $contents.=trim(str_replace("\n","",preg_replace('/\s+/', '', $row[6])))."\t";
	 $contents.=trim(preg_replace('/\s+/', ' ', addslashes($row[4])))."\t";
         $contents.=trim(preg_replace('/\s+/', ' ', addslashes($row[5])))."\t";
	
$addr=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row[27]))." ";
	 $contents.=$addr."\t";
 $branch=mysqli_query($con1,"select name from avo_branch where id='".$row[7]."'");
    $branchro=mysqli_fetch_row($branch);    
        $contents.=$branchro[0]."\t";
	
     $contents.=preg_replace('/\s+/', ' ', $row[9])."\t";
     $contents.= date('d/m/Y H:i:s',strtotime($row[10])); 
     $contents.="\t";

//=======Engineer Name ======
     $contents.=trim($engro[0])." (". $engro[1].")"."\t";

//=======Response Time====== 
 if($row[24]!='0000-00-00 00:00:00')
 	$contents.=date('d/m/Y H:i:s',strtotime($row[24]));
 
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
 
$upsno=mysqli_query($con1,"select upssn from FSR_details where alertid='".$row[0]."' ");
$no=mysqli_fetch_row($upsno);

$contents.=$no[0]."\t";

/* if($row1[44]!=''){ $status="IR Available";}

else $status= "Not Found";
$contents.=$status."\t"; */
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
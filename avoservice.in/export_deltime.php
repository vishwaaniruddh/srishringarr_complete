<?php
// include('config.php');
include('db_connection.php');
$con1 = OpenCon1();

$sqlme=$_POST['qr'];
$sqlme=$sqlme; //.' limit 400';
//echo $sqlme;

$table=mysqli_query($con1,$sqlme);

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/s', ' ', $string); 
  
   return preg_replace('/-+/', '-', $string); 
}
function get_engg($id,$con1){
 
 $sql =mysqli_query($con1,"select engg_name from area_engg where engg_id='".$id."'");
 $sql_result =mysqli_fetch_assoc($sql);
 
 return $sql_result['engg_name'];
}

//echo mysqli_num_rows($table);


$contents='';
 $contents.="Sr. No.\t Complaint ID\t Vertical-Client Name\t Site/Sol/ATM ID\t End User\t  Address\t Branch\t Problem\t Alert Date\t Call status\t First Delegated type\t Present Delegate to\t First Del Time\t No. of Delegation\t Last Delegate Time\t Eng Reject Date, if\t Rejected By\t Log to Delegate Time\t Time Duration to Delegate\t";
// echo $contents;
 $cnt=0;
 
while($row=mysqli_fetch_row($table))
{
$cnt++;

 $is_qry = 0;
	if($row[21] ==  'amc' || $row[21] ==  'AMC') {
	    $is_qry = 1;
	    $atmquery="select atmid from Amc where amcid='".$row[2]."'";
	 //  echo $atmquery; 
   } elseif($row[21] == 'site') {
       $is_qry = 1;
       
	    $atmquery="select atm_id from atm where track_id='".$row[2]."'";
	  
	} 
	
	if($is_qry==1){
	    $atm=mysqli_query($con1,$atmquery);
    
        	$atmrow=mysqli_fetch_row($atm);
        	$atm_id=$atmrow[0];
    	 } else{ 
    	    $atm_id=$row[2];
	    
	} 
//===============Cutsomer===========
	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
//============Updates=========	
//	$tab=mysqli_query($con1,"select feedback,standby,feed_date from eng_feedback where alert_id='".$row[0]."' order by feed_date DESC limit 1");
//	$row1=mysqli_fetch_row($tab);

      $contents.="\n".$cnt."\t";
	 $contents.=$row[25]."\t";
	 $contents.=$custrow[0]."\t";
	 $contents.=$atm_id."\t";
	 $contents.=clean($row[3])."\t";
	 $contents.=clean($row[5])."\t";
	

$branch_name=mysqli_query($con1,"select `name` from `avo_branch` where `id`='".$row[7]."'");
$branch_name1=mysqli_fetch_row($branch_name);

 $contents.=$branch_name1[0]."\t";
 $contents.=clean($row[9])."\t";

//==================Alert date ============-->
$contents.=$row[10]."\t";

if($row[15]=='Done' or $row[16]=='Done' ) { $stat="Closed"; }
elseif($row[16]=='Rejected') { $stat="Rejected"; }
elseif($row[16]=='onhold') { $stat="on Hold"; }
else { $stat="Pending"; } 

$contents.=$stat."\t";
///--==================Delegation Tracking ============-->
$del_trqry=mysqli_query($con1,"select * from `Delegation_tracking` where `alertid`='".$row[0]."'");
if(mysqli_num_rows($del_trqry)>0){
$del_track=mysqli_fetch_row($del_trqry);
if($del_track[2] == 1){ $del_type ="GPS";}
elseif($del_track[2] == 2){ $del_type ="History";}
elseif($del_track[2] == 3){ $del_type ="Database";}
}else { $del_type ="Manual";}

$contents.=$del_type."\t";

$tot_del = 0;
$first_eng = '';
$curr_engr ='';
$first_deltime = '';
$last_del = '';


$curr_delqry=mysqli_query($con1,"select * from `alert_delegation` where `alert_id`='".$row[0]."'");
if(mysqli_num_rows($curr_delqry)>0){
    $tot_del =mysqli_num_rows($curr_delqry);
$curr_delto=mysqli_fetch_row($curr_delqry);
$curr_engr = $curr_delto[1];
$first_deltime= $curr_delto[5];
$tot_del = 1;
} else {
    $curr_engr = "Pending";
    $first_deltime = "Pending";
}

$contents.=get_engg($curr_engr,$con1)."\t";
$contents.=$first_deltime."\t";


if($row[24] != 0){

$redl_delqry=mysqli_query($con1,"select * from `alert_redelegation` where `alert_id`='".$row[0]."' and created_at < '".$row[24]."' order by id DESC");
} else {
  
   $redl_delqry=mysqli_query($con1,"select * from `alert_redelegation` where `alert_id`='".$row[0]."' order by id DESC "); 
}
if(mysqli_num_rows($redl_delqry) >0 ) {
$delcnt = mysqli_num_rows($redl_delqry);
$tot_del = $delcnt+1;
$all_del=mysqli_fetch_array($redl_delqry);
$all_oldeng = $all_del[1];

$last_del = $all_del[6];

} else {$last_del = $first_deltime; }

//$contents.=get_engg($first_eng,$con1)."\t";
$contents.=$tot_del."\t";
$contents.=$last_del."\t";
// =========$all_deldet; // All del

$rejqry=mysqli_query($con1,"select * from `rejectedcalls` where `alertid`='".$row[0]."' ");
if(mysqli_num_rows($rejqry) >0) {
 $rej=mysqli_fetch_row($rejqry);
 $rej_dt = $rej[4];
 $rej_by = get_engg($rej[3],$con1);
} else { $rej_dt = "No Reject"; $rej_by = "No Reject"; }

$contents.=$rej_dt."\t";
$contents.=$rej_by."\t";

if($last_del == 'Pending') { $last_del = date('Y-m-d H:i:s'); }
$time1 = strtotime($row[10]); //entry date
$time2 = strtotime($last_del); // del date

$diff = $time2-$time1;
$hours = $diff / 3600; // 3600 seconds in an hour
$minutes = ($hours - floor($hours)) * 60;
$hours = round($hours,0);
$minutes = round($minutes);

 $contents.=$row[10]." # ".$last_del."\t"; 
 $contents.=$hours.":".$minutes."\t";

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

<?php CloseCon($con1); ?>

<?php
// include('config.php');
include('db_connection.php');
$con1 = OpenCon1();

$sqlme=$_POST['qr'];
$sqlme=$sqlme.' limit 400';
//echo $sqlme;

$table=mysqli_query($con1,$sqlme);

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/s', ' ', $string); 
  
   return preg_replace('/-+/', '-', $string); 
}

//echo mysqli_num_rows($table);

$contents='';
 $contents.="Sr. No.\t Engineer Name\t Designation\t Emp Code\t Complaint ID\t Vertical-Client Name\t Site/Sol/ATM ID\t End User\t City\t Address\t Branch\t Alert Date\t Call close time\t IR status\t IR uploaded time\t Snap Status\t Snap upload time\t";
// echo $contents;
 $cnt=0;
 
while($row=mysqli_fetch_row($table))
{
$cnt++;

	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'");
$site_id=mysqli_fetch_row($atm);

	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);

$oldeng=mysqli_query($con1,"select engineer,date from alert_delegation where alert_id='".$row[0]."' order by id DESC limit 1");
        $getold=mysqli_fetch_row($oldeng);
      //  $getold[0]=1;
$engr=mysqli_query($con1,"select engg_name, engg_desgn,emp_code from area_engg where engg_id='".$getold[0]."'");
	$engro=mysqli_fetch_row($engr);
	
	 $contents.="\n".$cnt."\t";
	 $contents.=$engro[0]."\t";
	 $contents.=$engro[1]."\t";
	  $contents.=$engro[2]."\t";
	 
	 $contents.=$row[25]."\t";
	 $contents.=$custrow[0]."\t";
	 $contents.=$site_id[0]."\t";

	 $contents.=clean(trim($row[3]))."\t";
	 $contents.=clean(trim(str_replace("\n","",$row[6])))."\t";
	 $contents.=clean(trim(addslashes($row[5])))."\t";
	
   $branch=mysqli_query($con1,"select name from avo_branch where id='".$row[7]."'");
    $branchro=mysqli_fetch_row($branch);    
        $contents.=$branchro[0]."\t";

     $contents.= date('d/m/Y H:i:s',strtotime($row[10])); 
     $contents.="\t";
     
//========Call close Time========
	$contents.=$row[18]."\t";

if($row[44]==''){ $ir_st="Pending"; $ir_d='';} 
else {
    $ir_st="Done";
$ir_qry=mysqli_query($con1,"select `upload_time` from `fsr_upload_time` where `alert_id`='".$row[0]."'");
$ir_date=mysqli_fetch_row($ir_qry);
$ir_d=$ir_date[0];
 
}
 $contents.=$ir_st."\t";
 $contents.=$ir_d."\t";

if($row[41]==''){ $snap_st="Pending"; $snap_d='';} 
else {
    $snap_st="Done";
$sanp_qry=mysqli_query($con1,"select `created_at` from `snap_inst` where `alert_id`='".$row[0]."'");
$snap_date=mysqli_fetch_row($sanp_qry);
$snap_d=$snap_date[0];
}
 $contents.=$snap_st."\t";
 $contents.=$snap_d."\t";



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

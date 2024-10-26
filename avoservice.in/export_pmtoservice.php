<?php
include('config.php');
$sqlme=$_POST['qr'];

//$sqlme=$sqlme.' limit 2000';

//echo $sqlme;

$table=mysqli_query($con1,$sqlme);

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}


$contents='';
 $contents.="Sr. No.\t Customer Name\t Site/Sol/ATM ID\t End User\t City\t  Address\t Branch\t PM Done Date\t Ticket No.\t Engineer\t Final Update\t Service Call Log\t Ticket No\t Problem Reported\t ";
// echo $contents;

$cnt=0;
 
while($row=mysqli_fetch_row($table))
{
$cnt++;
    
if($row[21] ==  'amc')
  {
 	$atm=mysqli_query($con1,"select atmid from Amc where amcid='".$row[2]."'");
	}
        else if($row[21] ==  'site'){
	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'");
	//echo "select atm_id from atm where track_id='".$row[2]."'";
	}
	$aid=mysqli_fetch_array($atm);
//==========Customer===========
$custqry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
$custfetch=mysqli_fetch_array($custqry);
//==============Branch==========
$brqry=mysqli_query($con1,"select name from avo_branch where id='".$row[7]."'");
$br=mysqli_fetch_array($brqry);

//=======Last Engineer==============
$engdel=mysqli_query($con1,"select engineer from alert_delegation where alert_id='".$row[0]."' order by id DESC");
$engid=mysqli_fetch_array($engdel);
$enggqry=mysqli_query($con1,"select engg_name from area_engg where engg_id='".$engid[0]."'");
$eng=mysqli_fetch_array($enggqry);
//========================Last call--- feedback
$upqry=mysqli_query($con1,"select feedback from eng_feedback where alert_id='".$row[0]."' order by id DESC limit 1");
$update=mysqli_fetch_row($upqry);


if ($row[15] =='Done' || $row[16] =='Done'){$status= "Closed"; }
if ($row[15] =='Delegated'){$status= "Delegated"; }
if ($row[16] =="Rejected"){$status= "Rejected"; }
if ($row[16] =='onhold'){$status= "On Hold"; }
if ($row[16] =='Pending'){$status= "Pending"; }

	
	 $contents.="\n".$cnt."\t";
	 $contents.=$custfetch[0]."\t";
	 $contents.=clean($aid[0])."\t";
	 
	 $contents.=$row[3]."\t";
	 $contents.=$row[6]."\t";
	 $contents.=clean(trim(addslashes($row[5])))."\t";
	 $contents.=$br[0]."\t";
	 $contents.=$row[18]."\t";// Close Date
	 $contents.=$row[25]."\t";
	 $contents.=$eng[0]."\t";
	 
	 $contents.=clean($update[0])."\t";

$serqry=mysqli_query($con1,"select entry_date, createdby,problem from alert where alert_type='service' and atm_id='".$row[2]."' and entry_date > '".$row[18]."' order by alert_id ASC");

if(mysqli_num_rows($serqry) > 0) {
$serrow=mysqli_fetch_row($serqry); 

$contents.=$serrow[0]."\t";
$contents.=$serrow[1]."\t";
$contents.=$serrow[2]."\t";

} else {  

$contents.="No Calls"."\t";
}     
 }



$contents = strip_tags($contents); 

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
//  header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
   header("Content-Disposition: attachment; filename=pm_to_ser-call.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
 
?>
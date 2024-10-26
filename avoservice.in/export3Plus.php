<?php
include('config.php');
$sqlme=$_POST['qr'];
$sqlme=$sqlme;//.' limit 400';
//echo $sqlme;
$fromdt=$_POST['fromdt'];
$todt=$_POST['todt'];

$table=mysqli_query($con1,$sqlme);

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}



$contents='';
 $contents.="Sr. No. \t Customer Name\t Site Id \t end User\t  City\t Address \t Branch \t count\t Last Complain ID \t Last Engineer\t  Last Update\t Current Call No.\t ";

 $cnt=0;
while($row=mysqli_fetch_array($table))
{


$lastqry=mysqli_query($con1,"select * from alert where atm_id='".$row[2]."' and entry_date between '".$fromdt." 00:00:00' and '".$todt." 23:59:59' order by alert_id DESC limit 2");


$coqry= mysqli_query($con1,"select count(alert_id) AS count from alert where atm_id='".$row[2]."' and entry_date between '".$fromdt." 00:00:00' and '".$todt." 23:59:59' and (call_status='Done' or status='done') ");

$countrow=mysqli_fetch_assoc($coqry);
$count=$countrow['count'];

$last=mysqli_fetch_array($lastqry);

//============ATM ID============        
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

//=======Engineer==============
$engdel=mysqli_query($con1,"select engineer from alert_delegation where alert_id='".$row[0]."' order by id DESC");
$engid=mysqli_fetch_array($engdel);
$enggqry=mysqli_query($con1,"select engg_name from area_engg where engg_id='".$engid[0]."'");
$eng=mysqli_fetch_array($enggqry);
//========================Last feedback
$upqry=mysqli_query($con1,"select feedback from eng_feedback where alert_id='".$row[0]."' order by id DESC limit 1");

$update=mysqli_fetch_row($upqry);

$cnt++;

 $contents.="\n".$cnt."\t";
 $contents.=$custfetch[0]."\t";
 $contents.=$aid[0]."\t";
 $contents.=$row[3]."\t";
 $contents.=$row[6]."\t";
 $contents.=clean($row[5])."\t";
 $contents.=$br[0]."\t";
 $contents.=$count."\t";
 $contents.=$row[25]."\t";
 $contents.=$eng[0]."\t";
 $contents.=clean($update[0])."\t";
 $contents.=$last[25]."\t";
 
	
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
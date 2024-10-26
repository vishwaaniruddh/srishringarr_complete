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
 $contents.="Sr. No.\t Customer Name\t Site/Sol/ATM ID\t End User\t City\t  Address\t Branch\t Last Call Date\t Last Ticket No.\t Last Engineer\t Call Closed Date\t Last Final Update\t Repeat Call Ticket\t Repeat Call Date\t Current Engineer Name\t Current update\t Current Status\t ";
// echo $contents;

$cnt=0;
 
while($rrow=mysqli_fetch_row($table))
{
$cnt++;
//echo $cnt;
$qry=mysqli_query($con1,"select * from alert where alert_id='".$rrow[0]."' ");
$row=mysqli_fetch_array($qry);

//=========Last Call ===

$lastqry=mysqli_query($con1,"select * from alert where alert_id='".$row[43]."' ");
//echo "select * from alert where alert_id='".$row[43]."' ";

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

//=======Last Engineer==============
$engdel=mysqli_query($con1,"select engineer from alert_delegation where alert_id='".$last[0]."' order by id DESC");
$engid=mysqli_fetch_array($engdel);
$enggqry=mysqli_query($con1,"select engg_name from area_engg where engg_id='".$engid[0]."'");
$eng=mysqli_fetch_array($enggqry);
//========================Last call--- feedback
$upqry=mysqli_query($con1,"select feedback from eng_feedback where alert_id='".$last[0]."' order by id DESC limit 1");
$update=mysqli_fetch_row($upqry);

//========Current Call===========
//=======Engineer==============
$engqry=mysqli_query($con1,"select engineer from alert_delegation where alert_id='".$row[0]."' order by id DESC");
$engneid=mysqli_fetch_array($engqry);
$enqry=mysqli_query($con1,"select engg_name from area_engg where engg_id='".$engneid[0]."'");
$engnew=mysqli_fetch_array($enqry);
//========================curr- feedback
$upqry1=mysqli_query($con1,"select feedback from eng_feedback where alert_id='".$row[0]."' order by id DESC limit 1");
//$upqry1=mysqli_query($con1,"select max(id),feedback from eng_feedback where alert_id='".$row[0]."'");
$update1=mysqli_fetch_row($upqry1);

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
	 $contents.= date('d/m/Y H:i:s',strtotime($last[10]))."\t";
	 $contents.=$last[25]."\t";
	 $contents.=$eng[0]."\t";
	 $contents.=$last[18]."\t";
	 $contents.=clean($update[0])."\t";
	 
	 $contents.=$row[25]."\t";
	 $contents.= date('d/m/Y H:i:s',strtotime($row[10]))."\t";
	 
	 if($engnew[0]==''){ $engg="Not Delegated" ;} else { $engg=$engnew[0] ;}
	 $contents.=$engg."\t";
	 $contents.=clean($update1[0])."\t";
	 $contents.=$status."\t";
     
 }



$contents = strip_tags($contents); 

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
//  header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
   header("Content-Disposition: attachment; filename=repeat-call.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
 
?>
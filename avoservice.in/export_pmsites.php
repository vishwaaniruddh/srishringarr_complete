<?php
include('config.php');
$sqlme=$_POST['qr'];
//$sqlme=$sqlme." limit 0, 2000";
//echo $sqlme;

$table=mysqli_query($con1,$sqlme);

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}


$contents='';
 $contents.="S.no \t Customer Name \t ATM \t Bank \t City \t Area \t Address \t State \t Branch\t Battery Specs\t Start Date \t exp date \t Status\t  Last Call Done\t Ageing\t ";
 $cnt=0;
while($row=mysqli_fetch_row($table))
{
$cnt++;

$amcqry=mysqli_query($con1,"select bankname,area,city,state,address, CID, BRANCH,amcid, atmid from Amc where amcid='$row[0]'");
$amc=mysqli_fetch_row($amcqry);

$qry1=mysqli_query($con1,"select cust_name from customer where cust_id='$amc[5]'");
$crow=mysqli_fetch_row($qry1);

$brqry=mysqli_query($con1,"select name from avo_branch where id='$amc[6]'");
$br=mysqli_fetch_row($brqry);



$contents.="\n".$cnt;
$contents.="\t".$crow[0];
$contents.="\t".$amc[8];

$contents.="\t".$amc[0];
$contents.="\t".clean(trim(preg_replace('/\s+/', ' ', $amc[2])));
$contents.="\t".clean(trim($amc[1]));
$addr1 =clean($amc[4]);

$addr=str_replace('\n', '',(preg_replace('/\s+/', ' ', $addr1))).",";
$contents.="\t".$addr;

$contents.="\t".$amc[3];
$contents.="\t".$br[0];

$qry2me=mysqli_query($con1,"select * from site_assets where atmid='$row[1]' and assets_name like '%Battery%' order by site_ass_id DESC");
$detail=mysqli_fetch_row($qry2me);

$qry3me=mysqli_query($con1,"select * from assets_specification where ass_spc_id='$detail[4]'");
$asset=mysqli_fetch_row($qry3me);
if($detail[11]==1) { $status="Warranty"; }
else { $status="Out of Warranty";}

$contents.="\t".$asset[2]." (".$detail[5].")";
$contents.="\t".$detail[16];
$contents.="\t".$detail[18];
$contents.="\t".$status;

$alertqry=mysqli_query($con1,"select date(close_date) from alert where atm_id ='".$row[0]."' order by alert_id DESC ");
$alert=mysqli_fetch_row($alertqry); 
$contents.="\t".$alert[0];

//============
$date=date('Y-m-d');
$exp= $det[18];
$sixmonth = date('Y-m-d', strtotime("+6 months $exp"));
$oneyear = date('Y-m-d', strtotime("+12 months $exp"));
$two= date('Y-m-d', strtotime("+24 months $exp"));
$three= date('Y-m-d', strtotime("+36 months $exp"));

$warrdue= date('Y-m-d', strtotime("-6 months $exp"));

$status=$det[11] ;

if($status==1) {
if($date > $warrdue) { $age = "<6 Months Left";} else {$age ="UW";}
    
} else {
    
    if($date < $sixmonth) { $age = "Expired Within 6 Months";}
elseif($date <$oneyear) { $age = "Expired 6-12 Months";}
elseif($date < $two) { $age = "Expired 1-2 Years";}
elseif($date < $three) { $age = "Expired 2-3 Years";}
 
else{ $age = "Abv 3 Years"; }
}

$contents.="\t".$age;



 } 
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
 // header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=mis.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
?>
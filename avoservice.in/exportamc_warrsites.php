<?php
include('config.php');
$sqlme=$_POST['qr'];
//echo $sqlme;
$table=mysqli_query($con1,$sqlme);

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}




$contents='';
 $contents.="S.no \t Customer Name \t Site/Sol/ATM Id \t Bank \t City \t Area \t Address \t pincode\t State \t Branch\t AMC Start Date \t AMC Exp date \t Products Status\t Products in Warr\t";
 $cnt=0;
while($row=mysqli_fetch_row($table))
{
$cnt++;
$qry1=mysqli_query($con1,"select * from customer where cust_id='$row[1]'");
$crow=mysqli_fetch_row($qry1);

$brqry=mysqli_query($con1,"select name from avo_branch where id='$row[8]'");
$br=mysqli_fetch_row($brqry);

$contents.="\n".$cnt;
$contents.="\t".$crow[1];
$contents.="\t".$row[3];
$contents.="\t".clean(trim(preg_replace('/\s+/', ' ', $row[4])));
$contents.="\t".clean(trim($row[7]));
$contents.="\t".clean(trim($row[5]));
$addr1 =clean($row[9]);

$addr=str_replace('\n', '',(preg_replace('/\s+/', ' ', $addr1))).",";

$contents.="\t".$addr;

$contents.="\t".$row[6];

$contents.="\t".$br[0];


$contents.="\t".$row[10];
$contents.="\t".$row[12];
$contents.="\t".$row[25];

$warqry=mysqli_query($con1,"select * from site_assets where atmid='$row[38]' and status=1");
if(mysqli_num_rows($warqry) >0){
$status="Some Products in Warr";
} else {$status="Products Warranty Expired";}

$contents.="\t".$status;

while($ast=mysqli_fetch_row($warqry))
{
$qry3me=mysqli_query($con1,"select name from assets_specification where ass_spc_id='$ast[4]'");
$spec=mysqli_fetch_row($qry3me);

$contents.="\t".$ast[3]."(".$spec[0].") ".$ast[16]." to ".$ast[18];

}

 } 
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
 // header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=mis.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
?>
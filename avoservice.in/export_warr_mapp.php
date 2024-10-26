<?php
include('config.php');
$sqlme=$_POST['qr'];
//echo $sqlme;
$table=mysqli_query($con1,$sqlme);

$contents='';
 $contents.="S.No \t Customer Name \t Site Id \t Bank \t City \t Area \t Address \t pincode\t state\t Branch \t Engineer Name \t Engineer Status\t Distance\t";
$cnt=0;

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}



while($row=mysqli_fetch_row($table))
{
$cnt++;
$qry1=mysqli_query($con1,"select cust_name from customer where cust_id='$row[2]'");
$crow=mysqli_fetch_row($qry1);
$qrybr=mysqli_query($con1,"select name from avo_branch where id='$row[7]'");
$bran=mysqli_fetch_row($qrybr);	


$contents.="\n".$cnt;	
$contents.="\t".$crow[0];
$contents.="\t".preg_replace('/\s+/', ' ', $row[1]);
$contents.="\t".clean($row[3]);
$contents.="\t".clean($row[6]);
$contents.="\t".clean($row[4]);
$contents.="\t".clean($row[9]);

$contents.="\t".clean($row[5]);
$contents.="\t".clean($row[15]);

$contents.="\t".$bran[0];

$qry1=mysqli_query($con1,"select engg_id,id from engg_site_mapping_warr where site_id='$row[0]' order by id desc");

$enrow=mysqli_fetch_row($qry1);
$engqry=mysqli_query($con1,"select engg_name, status from area_engg where engg_id='$enrow[0]' ");

$engrow=mysqli_fetch_row($engqry);

$contents.="\t".$engrow[0];

if(mysqli_num_rows($engqry)==0) { $enng="Eng Not Mapped";}
elseif($engrow[1]==1) {$enng="Active"; }
else{ $enng="Engineer Left, assign"; }

$contents.="\t".$enng;


 } 


$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
 // header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=mis.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
?>
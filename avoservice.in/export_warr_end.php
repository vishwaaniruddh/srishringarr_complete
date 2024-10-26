<?php
include('config.php');
$sqlme=$_POST['qr'];
$prod=$_POST['prod'];


//echo $sqlme;
$table=mysqli_query($con1,$sqlme);

$contents='';
 $contents.="S.No \t Customer Name \t ATM \t Bank \t City \t Area \t Address \t pincode\t state\t Branch \t last PO Date \t UPS Start date\t UPS Expiry date \t Assets in Warr \t ";
$cnt=0;

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}



while($row=mysqli_fetch_row($table))
{
$cnt++;
$qry1=mysqli_query($con1,"select * from customer where cust_id='$row[2]'");
$crow=mysqli_fetch_row($qry1);
$qrybr=mysqli_query($con1,"select name from avo_branch where id='$row[7]'");
$bran=mysqli_fetch_row($qrybr);	

$contents.="\n".$cnt;	
$contents.="\t".$crow[1];
$contents.="\t".preg_replace('/\s+/', ' ', $row[1]);
$contents.="\t".clean($row[3]);
$contents.="\t".clean($row[6]);
$contents.="\t".clean($row[4]);
$contents.="\t".clean($row[9]);

$contents.="\t".clean($row[5]);
$contents.="\t".clean($row[15]);

$contents.="\t".$bran[0];

$contents.="\t".$row[13];  // po date


//=========== Show latest UPS start-exp date======= 

 $qryas=mysqli_query($con1,"select po_date, start_date, exp_date from site_assets where atmid='".$row[0]."' and assets_name ='UPS' order by site_ass_id DESC limit 1");
$dt=mysqli_fetch_row($qryas);

$contents.="\t".$dt[1]; //UPS start
$contents.="\t".$dt[2]; // UPS exp 

//============ All assets in Warranty======

$as_det="";

$qry2me=mysqli_query($con1,"select * from site_assets where cust_id='$row[2]' and atmid='".$row[0]."' and status=1 order by assets_name ASC, site_ass_id DESC");

//$qry2me=mysqli_query($con1,"select * from site_assets where cust_id='$row[2]' and atmid='".$row[0]."' and status=1 and assets_name ='UPS' order by site_ass_id DESC");

while($detailme=mysqli_fetch_row($qry2me))
{

$qry3=mysqli_query($con1,"select * from assets_specification where ass_spc_id='$detailme[4]'");
$row3=mysqli_fetch_row($qry3);

$validmnth=str_replace(',',' ',$detailme[5]);

//if(isset($row[8]) and $row[8]!='0000-00-00') $expdt=date('d-m-Y', strtotime($row[8] .' +'.$validmnth));
//else $expdt=date('d-m-Y', strtotime($row[13] .' +'.$validmnth));    

//$as_det=$as_det.$detailme[3]."(".str_replace(',',' ',$detailme[5]).")"."/".$expdt."*";

$as_det= $detailme[3]."-".$row3[2]."(".str_replace(',',' ',$detailme[5]).") / ".$detailme[16]." - ".$detailme[18];

//$as_det= $detailme[3]."(".str_replace(',',' ',$detailme[5]).") / ".$detailme[16]." - ".$detailme[18];
 
$contents.="\t".str_replace("\n","  ",preg_replace('/\s+/', ' ',$as_det));

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
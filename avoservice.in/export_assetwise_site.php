<?php
include('config.php');
$sqlme=$_POST['qr'];
$prod=$_POST['prod'];


//echo $sqlme;
$table=mysqli_query($con1,$sqlme);

$contents='';
 $contents.="S.No \t Customer Name \t Site_id \t Bank \t City \t Area \t Address \t pincode\t state\t Branch \t PO No.\t Product Name\t Product Specs\t Warranty\t  Qty\t Product Start date\t Product Expiry date \t  All Warr Assets at Site \t ";
$cnt=0;

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}
while($row=mysqli_fetch_assoc($table))
{
$cnt++;
$qry1=mysqli_query($con1,"select * from customer where cust_id='".$row['cust_id']."'");
$crow=mysqli_fetch_row($qry1);
$qrybr=mysqli_query($con1,"select name from avo_branch where id='".$row['branch_id']."'");
$bran=mysqli_fetch_row($qrybr);	

$contents.="\n".$cnt;	
$contents.="\t".$crow[1];
$contents.="\t".preg_replace('/\s+/', ' ', $row['atm_id']);
$contents.="\t".clean($row['bank_name']);
$contents.="\t".clean($row['city']);
$contents.="\t".clean($row['area']);
$contents.="\t".clean($row['address']);

$contents.="\t".$row['pincode'];
$contents.="\t".clean($row['state1']);

$contents.="\t".$bran[0];

$contents.="\t".$row['po'];  // po date
$contents.="\t".$row['assets_name'];

$assqr=mysqli_query($con1,"select * from assets_specification where ass_spc_id='".$row['assets_spec']."'");
$asset=mysqli_fetch_row($assqr);

$contents.="\t".$asset[2];
$contents.="\t".$row['valid'];
$contents.="\t".$row['quantity'];

$contents.="\t".$row['start_date']; // start
$contents.="\t".$row['exp_date'];// exp 

//============ All assets in Warranty======

$as_det="";

$qry2me=mysqli_query($con1,"select * from site_assets where cust_id='".$row['cust_id']."' and atmid='".$row['track_id']."' and status=1 order by assets_name ASC, site_ass_id DESC");

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
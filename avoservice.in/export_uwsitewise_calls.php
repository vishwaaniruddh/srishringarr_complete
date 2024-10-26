<?php
include('config.php');

$contents='';
 $contents.="S.No \t Customer Name \t ATM \t Bank \t Address \t Branch \t UPS Start date\t UPS Expiry date \t calls logged count \t ";
$cnt=0;

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}

//$sql="Select a.track_id, a.atm_id, a.cust_id,a.bank_name, a.address, a.branch_id,b.start_date, b.exp_date, count(c.atm_id) from atm a,site_assets b, alert c where a.track_id=b.atmid and a.track_id=c.atm_id and b.assets_name='UPS' and b.start_date <'2023-09-30' and b.exp_date >'2023-04-01' and a.branch_id in(1 and c.entry_date between '2023-04-01 00:00:00' and '2023-09-30 23:59:59'";

$sql="Select a.track_id, a.atm_id, a.cust_id,a.bank_name, a.address, a.branch_id,b.start_date, b.exp_date from atm a,site_assets b where a.track_id=b.atmid and b.assets_name='UPS' and b.start_date <'2023-09-30' and b.exp_date >'2023-04-01' and a.branch_id in(1) order by b.site_ass_id DESC";

//$sql="Select track_id,atm_id,cust_id,bank_name,address,branch_id from atm where start_date < '2023-09-31' and expdt > '2023-03-31' and cust_id=7 ";
//=========

//echo  "select distinct(atm_id), count(atm_id) As `count` from alert where assetstatus='site' and alert_type='service' and date(entry_date) between '2023-04-01' and '2023-09-30' group by atm_id";

$alertqry=mysqli_query($con1,"select distinct(atm_id),count(alert_id) as `count` from alert where assetstatus='site' and alert_type='service' and date(entry_date) between '2023-04-01' and '2023-09-30' ");

//$alrtcnt=mysqli_num_rows($qry2me);

$table=mysqli_query($con1,$sql);
$count=mysqli_num_rows($table);

echo "Alert Count: ".$alrtcnt;
echo "Count: ".$count;
die;

while($row=mysqli_fetch_row($table))
{
$cnt++;
$qry1=mysqli_query($con1,"select * from customer where cust_id='$row[2]'");
$crow=mysqli_fetch_row($qry1);
$qrybr=mysqli_query($con1,"select name from avo_branch where id='$row[5]'");
$bran=mysqli_fetch_row($qrybr);	

$contents.="\n".$cnt;	
$contents.="\t".$crow[1];
$contents.="\t".preg_replace('/\s+/', ' ', $row[1]);
$contents.="\t".clean($row[3]);
$contents.="\t".clean($row[4]);
$contents.="\t".$bran[0];
//=========== Show latest UPS start-exp date======= 

// $qryas=mysqli_query($con1,"select start_date, exp_date from site_assets where atmid='".$row[0]."' and assets_name ='UPS' order by site_ass_id DESC limit 1");
//$dt=mysqli_fetch_row($qryas);

$contents.="\t".$row[6];
$contents.="\t".$row[7];

//$contents.="\t".$dt[0]; //UPS start
//$contents.="\t".$dt[1]; // UPS exp 

//============ calls in Alert table======
$count=0;
while($alert=mysqli_fetch_array($alertqry)){
//$qry2me=mysqli_query($con1,"select count(atm_id) As `count` from alert where atm_id ='".$row[0]."' and alert_type='service' and date(entry_date) between '2023-04-01' and '2023-09-30' group by atm_id");
//echo "select track_id from atm where track_id='".$alert[0]."'</br>";

$atm=mysqli_query($con1,"select track_id from atm where track_id='".$alert[0]."'");
while($com=mysqli_fetch_row($atm)){

echo "select count(atm_id) As `count` from alert where atm_id ='".$com[0]."' ";
$qry2me=mysqli_query($con1,"select count(atm_id) As `count` from alert where atm_id ='".$com[0]."' ");

$det=mysqli_fetch_assoc($qry2me);
$count=$det['count'];

$contents.="\t".$count;
//$contents.="\t".$det['date'];
}
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
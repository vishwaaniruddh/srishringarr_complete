<?php
include('config.php');
$sqlme=$_POST['qr'];
//echo $sqlme;
$table=mysqli_query($concs,$sqlme);

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}




$contents='';
 $contents.="S.no \t Customer Name \t ATM \t PO No.\t Bank \t City \t Area \t Address \t pincode\t Branch \t State\t Start Date \t exp date \t ";
 $cnt=0;
while($row=mysqli_fetch_row($table))
{
$cnt++;
$qry1=mysqli_query($concs,"select * from customer where cust_id='$row[1]'");
$crow=mysqli_fetch_row($qry1);

$brqry=mysqli_query($concs,"select name from avo_branch where id='$row[8]'");
$br=mysqli_fetch_row($brqry);

$contents.="\n".$cnt;
$contents.="\t".$crow[1];
$contents.="\t".$row[3];
$contents.="\t".$row[2];
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

/* $qry2me=mysqli_query($concs,"select * from amcassets where `siteid`='$row[0]'");
while($detail1=mysqli_fetch_row($qry2me))
{
//echo "select * from assets_specification where ass_spc_id='$detail1[2]'";
$qry3me=mysqli_query($concs,"select * from assets_specification where ass_spc_id='$detail1[2]'");
$row3me=mysqli_fetch_row($qry3me);

$qry4me=mysqli_query($concs,"select * from assets where assets_id='$row3me[1]'");
$row4me=mysqli_fetch_row($qry4me);

$qry5me=mysqli_query($concs,"select * from `amcpurchaseorder` where amcsiteid='".$row[0]."'");
$row5me=mysqli_fetch_row($qry5me);
if($row5me[3]!='0000-00-00' && $row5me[4]!='0000-00-00')
{ 

$contents.="\t".$row4me[1]." : ".date('d/m/Y',strtotime($row5me[3]))."-".date('d/m/Y',strtotime($row5me[4]));


//echo $row4me[1]." : "."<b>".date('d/m/Y',strtotime($row5me[3]))."-".date('d/m/Y',strtotime($row5me[4]))."</b>"."</br>";


}

}
*/
 } 
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
 // header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=mis.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
?>
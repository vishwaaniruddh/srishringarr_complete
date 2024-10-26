<?php
include('config.php');
$sqlme=$_POST['qr'];
//echo $sqlme;
$table=mysqli_query($con1,$sqlme);

$contents='';
 $contents.="AtmId \t Customer Name \t Bank Name \t Address \t GPS location \t state \t Branch \t Date of PM \t Engineer Name \t UPS Cap \t Ups Status \t Batt Qty \t Batt Ah \t Batt Make \t Batt Status \t Battery Weak Qty \t";
while($row=mysqli_fetch_row($table))
{
$atmdet="";
if(substr($row[1], 0, 4) == 'temp')
{
$watm="select * from tempsites where atmid='".$row[1]."'";//get atmid
$atmdet=mysqli_query($con1,$watm);
$norrs=mysqli_num_rows($atmdet);

if($norrs=='0')
{
$watm1="select * from tempsites_pm where atmid='".$row[1]."'";//get atmid
$atmdet=mysqli_query($con1,$watm1);

}
}
else
{
$watm="select bank_name,address,cust_id,state1 from atm where atm_id='".$row[1]."'";//get atmid
$atmdet=mysqli_query($con1,$watm);

$norrs=mysqli_num_rows($atmdet);

if($norrs==0)
{
$watm1="select bankname,address,cid,state from Amc where atmid='".$row[1]."'";//get atmid
$atmdet=mysqli_query($con1,$watm1);

}

}



$detrow=mysqli_fetch_array($atmdet);

$qrybranch=mysqli_query($con1,"select id,name from avo_branch where id='".$row[14]."'");//get Branch name
$br=mysqli_fetch_array($qrybranch);

//$qryatm=mysqli_query($con1,"select cust_id from atm where atm_id='".$row[0]."'");
//$atmr=mysqli_fetch_array($qryatm);

$qrycust=mysqli_query($con1,"select cust_name from customer where cust_id='".$detrow[2]."'");
$ctm=mysqli_fetch_array($qrycust);

$qryeng=mysqli_query($con1,"select engg_name from area_engg where loginid='".$row[10]."'");
$eng=mysqli_fetch_array($qryeng);



$contents.="\n".trim($row[1]);
$contents.="\t".$ctm[0];
$contents.="\t".$detrow[0];
$contents.="\t".str_replace("\n","  ",preg_replace('/\s+/', ' ', trim($detrow[1])));
$contents.="\t".$row[12].",".$row[13];
$contents.="\t".$detrow[3]; 
$contents.="\t". $br[1];
$contents.="\t".$row[11];
$contents.="\t".$eng[0];
$contents.="\t".$row[2];
$contents.="\t".$row[3];
$contents.="\t".$row[4];
$contents.="\t".$row[5];
$contents.="\t".$row[6];
$contents.="\t".$row[7];
$contents.="\t".$row[8];
$contents.="\t".$row[9];

 } 
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
 // header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=pmcalls.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
?>
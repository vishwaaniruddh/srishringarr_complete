<?php
include('config.php');
$sqlme=$_POST['qr'];

$sqlme=$sqlme." limit 0,10000";


//echo $sqlme;
$table=mysqli_query($con1,$sqlme);

$contents='';
 $contents.="S.No \t Customer Name \t Site Status\t ATM \t Bank \t City \t Area \t Address \t pincode\t state\t Branch \t Engineer Name\t Distance in KMs\t ";
$cnt=0;

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}

function distance($lat1, $lon1, $lat2, $lon2, $unit) {
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return ($miles * 1.609344);
    } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }
}

while($row=mysqli_fetch_row($table))
{
$cnt++;
$qry1=mysqli_query($con1,"select * from customer where cust_id='$row[1]'");
$crow=mysqli_fetch_row($qry1);
$qrybr=mysqli_query($con1,"select name from avo_branch where id='$row[8]'");
$bran=mysqli_fetch_row($qrybr);	

$contents.="\n".$cnt;	
$contents.="\t".$crow[1];
$contents.="\t"."AMC";
$contents.="\t".preg_replace('/\s+/', ' ', $row[3]);
$contents.="\t".clean($row[4]);
$contents.="\t".clean($row[7]);
$contents.="\t".clean($row[5]);
$contents.="\t".clean($row[9]);

$contents.="\t".clean($row[6]);
$contents.="\t".clean($row[10]);

$contents.="\t".$bran[0];

$qryt1=mysqli_query($con1,"select engg_id from engg_site_mapping where site_id='".$row[0]."'");

$maprow=mysqli_fetch_row($qryt1);

$qryt23=mysqli_query($con1,"select * from area_engg where engg_id='$maprow[0]'");
$maprow=mysqli_fetch_row($qryt23);

$contents.="\t".$maprow[1]; 

if(mysqli_num_rows($qryt23)==0) {
 $dis="Site-Engr Not mapped" ;   
} else {

$sitelat = $row[34];
$sitelong=$row[35];
$englat = $maprow[18];
$englong =$maprow[19];

if ($sitelat =='0.00' || $sitelat=='' ) {
$dis="Site Not Marked" ;
} elseif ($englat =='0.00' || $englat==''  ) {
 $dis="Mark Engr Location" ;   
} 

else {
$dis1=distance($sitelat, $sitelong, $englat, $englong, "K"); 
$dis=$dis1;
}
}
$contents.="\t".$dis; 


 } 


$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
 // header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=mis.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
?>
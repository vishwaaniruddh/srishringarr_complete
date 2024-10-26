<?php
include('config.php');
$sql=$_POST['qr'];
$sqlme=$sql.' limit 2000';

//echo $sqlme;
$table=mysqli_query($con1,$sqlme);

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}



$contents='';
 $contents.="Sr. No.\t Engineer Name\t Branch\t Designation\t Claim Date\t Logistics Claim Detail\t Logistics Amount\t Handling / Hamali Detail\t Hamali Charges\t Spares Purchase Detail\t Spares Amount\t Courier Detail\t Courier Amount\t Stationary Detail\t Stationary Amount\t Other Expense Detail\t Other Exp Amount\t Total Claimed Amount\t ";
 
 
 // echo $contents;
 $cnt=0;
 
while($row=mysqli_fetch_row($table))
{
$cnt++;

$qry2=mysqli_query($con1,"select name from avo_branch where id='".$row[3]."'");
$row2=mysqli_fetch_row($qry2);

$qry3=mysqli_query($con1,"select engg_name,engg_desgn from area_engg where engg_id='".$row[1]."'");
$row3=mysqli_fetch_row($qry3);


if ($row[18]==1) { $status='Pending' ; }
else if ($row[18]==2) { $status='Approved' ; }


$contents.="\n".$cnt."\t";
$contents.=$row3[0]."\t";
$contents.=$row2[0]."\t";
$contents.=$row3[1]."\t";
$contents.=$row[2]."\t";
$contents.=clean($row[4])."\t";
$contents.=$row[5]."\t";
$contents.=clean($row[6])."\t";
$contents.=$row[7]."\t";
$contents.=clean($row[8])."\t";
$contents.=$row[9]."\t";
$contents.=clean($row[10])."\t";
$contents.=$row[11]."\t";
$contents.=clean($row[12])."\t";
$contents.=$row[13]."\t";
$contents.=clean($row[14])."\t";
$contents.=$row[15]."\t";

$contents.=$row[16]."\t"; 


}

$contents = strip_tags($contents); 

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])

   header("Content-Disposition: attachment; filename=claims.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
 
?>
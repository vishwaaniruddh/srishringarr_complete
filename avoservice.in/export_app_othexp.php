<?php
include('config.php');
$sql=$_POST['qr'];
$sqlme=$sql.' LIMIT 0, 1200';

//echo $sqlme;

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}


$table=mysqli_query($con1,$sqlme);

$contents='';


 $contents.="Sr. No.\t Engineer Name\t Branch\t Designation\t Emp. Code\t Claim Date\t Logistics Detail\t Engr Claimed\t Br. Approved\t Hamali Detail\t Engr Claimed\t Br. Approved\t Spares Detail\t Engr Claimed\t Br. Approved\t Courier\t Engr Claimed\t Br. Approved\t Stationary\t Engr Claimed\t Br. Approved\t Other Claims\t Engr Claimed\t Br. Approved\t Total Claimed\t Br. Approved\t Approved By\t Approval remarks\t";
 // echo $contents;
 $cnt=0;
 
while($row=mysqli_fetch_row($table))
{
$cnt++;

$exp1=mysqli_query($con1,"select * from engg_oth_expenses where id='".$row[1]."'");
$exp=mysqli_fetch_row($exp1);

$qry2=mysqli_query($con1,"select name from avo_branch where id='".$exp[3]."'");
$row2=mysqli_fetch_row($qry2);

$qry3=mysqli_query($con1,"select * from area_engg where engg_id='".$row[2]."'");
$row3=mysqli_fetch_row($qry3);


if ($row[8]==1) { $status='Pending' ; }
else if ($row[8]==2) { $status='Verified' ; }
else if ($row[8]==0) { $status='Rejected' ; }




$contents.="\n".$cnt."\t";
$contents.=$row3[1]."\t";
$contents.=$row2[0]."\t";
$contents.=$row3[11]."\t";
$contents.=$row3[6]."\t";
$contents.=$exp[2]."\t";

$contents.=clean($exp[4])."\t"; 
$contents.=$exp[5]."\t";
$contents.=$row[5]."\t";

$contents.=clean($exp[6])."\t"; 
$contents.=$exp[7]."\t";
$contents.=$row[6]."\t";

$contents.=clean($exp[8])."\t"; 
$contents.=$exp[9]."\t";
$contents.=$row[7]."\t";

$contents.=clean($exp[10])."\t"; 
$contents.=$exp[11]."\t";
$contents.=$row[8]."\t";

$contents.=clean($exp[12])."\t"; 
$contents.=$exp[13]."\t";
$contents.=$row[9]."\t";

$contents.=clean($exp[14])."\t"; 
$contents.=$exp[15]."\t";
$contents.=$row[10]."\t";

$contents.=$exp[16]."\t"; // claimed total
$contents.=$row[11]."\t"; // Approved Total

$contents.=$row[13]."\t"; // Approved By
$contents.=clean($row[12])."\t"; // Approved remarks
$contents.=$row[15]."\t"; // Approved date




}

$contents = strip_tags($contents); 

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])

   header("Content-Disposition: attachment; filename=claims.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
 
?>
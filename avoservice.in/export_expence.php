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
 $contents.="Sr. No.\t Engineer Name\t Branch\t Designation\t Claim Date\t Calls Attended\t Other Calls/Visits\t Purpose of Other Visits\t Company Vehicle travel KM\t Own vehicle Travel KM\t Ownvehicle Claim Amount\t Cab Travel KM\t Cab Expenses\t Public Transport KM\t Pubic Tr. Claim Amount\t Food Expense\t Lodging\t Mobile Expense\t Room rent\t Total Travel KMs\t Total Claimed Amount\t Status\t Rejected Remarks\t Portal Calls\t Portal Travel KM\t Approved Amount\t App. Remarks\t Approved By\t " ;
 
 
 // echo $contents;
 $cnt=0;
 
while($row=mysqli_fetch_row($table))
{
$cnt++;

$qry2=mysqli_query($con1,"select name from avo_branch where id='".$row[2]."'");
$row2=mysqli_fetch_row($qry2);

$qry3=mysqli_query($con1,"select * from area_engg where engg_id='".$row[1]."'");
$row3=mysqli_fetch_row($qry3);


if ($row[17]==1) { $status='Pending' ; }
else if ($row[17]==2) { $status='Approved' ; }
else if ($row[17]==0) { $status='Rejected' ; }

If ($row[17]==2) 
$qry4=mysqli_query($con1,"select * from approved_expenses where claim_id='".$row[0]."'");
$row4=mysqli_fetch_assoc($qry4);



$contents.="\n".$cnt."\t";
$contents.=$row3[1]."\t";
$contents.=$row2[0]."\t";
$contents.=$row3[11]."\t";
$contents.=$row[3]."\t";
$contents.=$row[4]."\t"; 
$contents.=$row[5]."\t";
$contents.=clean($row[21])."\t";
$contents.=$row[20]."\t";
$contents.=$row[6]."\t";
$contents.=$row[7]."\t";
$contents.=$row[8]."\t";
$contents.=$row[9]."\t";
$contents.=$row[10]."\t";
$contents.=$row[11]."\t";
$contents.=$row[12]."\t";
$contents.=$row[13]."\t";

$contents.=$row[16]."\t"; //mobile
$contents.=$row[23]."\t"; // room
//$contents.=$row[16]."\t";
$contents.=$row[18]."\t";
$contents.=$row[19]."\t";
$contents.=$status."\t";
$contents.=$row[24]."\t";

$contents.=$row4['portal_calls']."\t";
$contents.=$row4['portal_dis']."\t";
$contents.=$row4['app_amt']."\t";
$contents.=$row4['app_remarks']."\t";
$contents.=$row4['approved_by']."\t";

}

$contents = strip_tags($contents); 

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])

   header("Content-Disposition: attachment; filename=claims.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
 
?>
<?php
include('config.php');
$sql=$_POST['qr'];
$sqlme=$sql.' LIMIT 0, 3000';

//echo $sqlme;

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}


$table=mysqli_query($con1,$sqlme);

$contents='';
 $contents.="Sr. No.\t Engineer Name\t Branch\t Designation\t Emp. Code\t Claim Date\t Calls Attended\t Other Calls/Visits\t Purpose of Other Visits\t Company Vehicle travel KM\t Own vehicle Travel KM\t Ownvehicle Claim Amount\t Cab Travel KM\t Cab Expenses\t Public Transport KM\t Pubic Tr. Claim Amount\t Food Expense\t Lodging\t Mobile Exp\t Room rent\t Total Travel KMs\t Total Claimed Amount\t Portal Calls\t Portal Travel KM\t Approved Amount\t App. Remarks\t Approved By\t Approved Date\t Admin Verify\t " ;
 
//$contents.="Sr. No.\t Engineer Name\t Branch\t Designation\t Emp. Code\t Claim Date\t Calls Attended\t Other Calls/Visits\t Purpose of Other Visits\t Company Vehicle travel KM\t Own vehicle Travel KM\t Ownvehicle Claim Amount\t Cab Travel KM\t Cab Expenses\t Public Transport KM\t Pubic Tr. Claim Amount\t Food Expense\t Lodging\t Other Exp Reason\t Other Exp\t Total Travel KMs\t Total Claimed Amount\t Portal Calls\t Portal Travel KM\t Approved Amount\t App. Remarks\t Approved By\t Approved Date\t Admin Verify\t " ; 
 
 $cnt=0;
 
while($row=mysqli_fetch_row($table))
{
$cnt++;

$exp1=mysqli_query($con1,"select * from daily_expenses where id='".$row[1]."'");
$exp=mysqli_fetch_row($exp1);

$qry2=mysqli_query($con1,"select name from avo_branch where id='".$exp[2]."'");
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
$contents.=$exp[3]."\t";
$contents.=$exp[4]."\t"; 
$contents.=$exp[5]."\t";

$contents.=clean($exp[21])."\t";// other visit
$contents.=$exp[20]."\t"; // company KMs
$contents.=$exp[6]."\t";
$contents.=$exp[7]."\t";
$contents.=$exp[8]."\t";
$contents.=$exp[9]."\t";
$contents.=$exp[10]."\t";
$contents.=$exp[11]."\t";
$contents.=$exp[12]."\t";
$contents.=$exp[13]."\t";
//========New
$contents.=$exp[16]."\t";
$contents.=$exp[23]."\t";

//======Old
//$contents.=clean(trim($exp[14]))."\t";
//$contents.=$exp[15]."\t";



$contents.=$exp[18]."\t";
$contents.=$exp[19]."\t";


$contents.=$row[5]."\t"; // portal calls
$contents.=$row[7]."\t"; // portal dis
$contents.=$row[6]."\t";  // app amt
$contents.=clean($row[10])."\t"; // app remark
$contents.=$row[9]."\t"; // app by
$contents.=$row[11]."\t"; // app date
$contents.=$status."\t";
//$contents.=$row[12]."\t";  // veri amount
//$contents.=clean($row[13])."\t"; // veri remark
//$contents.=$row[14]."\t"; // ver by

$result = mysqli_query($con1,"SELECT alert_id FROM `alert_progress` where engg_id='".$row3[8]."' and date(responsetime)='".$row[4]."' and responsetime !='0000-00-00 00:00:00'");

//echo "SELECT alert_id FROM `alert_progress` where engg_id='".$row[2]."' and date(responsetime)='".$exp[3]."' and responsetime !='0000-00-00 00:00:00'";
$ida=0;
while ($calls = mysqli_fetch_array($result)){

$sqlal="Select createdby from alert where alert_id='".$calls[0]."' ";
//echo $sqlal;

$tick=mysqli_query($con1,$sqlal);
$tkt= mysqli_fetch_array($tick);

$contents.=$tkt[0]."\t";
$ida++ ;

    
}

}

$contents = strip_tags($contents); 

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])

   header("Content-Disposition: attachment; filename=claims.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
 
?>
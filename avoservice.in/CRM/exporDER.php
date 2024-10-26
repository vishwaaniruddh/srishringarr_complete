<?php
include('config.php');
$sqlme=$_POST['qr'];
$sqlme=$sqlme;//.' limit 400';

$table=mysqli_query($conn,$sqlme);
//echo mysql_num_rows($table);

$contents='';
 $contents.="Sr. No. \t Title \t Full Name \t Member Id \t Level \t Expiry Date \t Entry Date \t Member_Type \t";
// echo $contents;
 $cnt=0;
 
while($_row=mysqli_fetch_array($table))
{
$cnt++;

 $sql2="select FirstName,LastName from Leads_table where Lead_id='".$_row['Static_LeadID']."' ";
	//echo $sql2;
	$runsql2=mysqli_query($conn,$sql2);
	$sql2fetch=mysqli_fetch_array($runsql2);
			    
	$sql3="SELECT level_name FROM `Level` where Leval_id='".$_row['MembershipDetails_Level']."' ";
	//echo $sql2;
	$runsql3=mysqli_query($conn,$sql3);
	$sql3fetch=mysqli_fetch_array($runsql3);
	
	$sql4="SELECT Expiry_month FROM `validity` where Leval_id='".$_row['MembershipDetails_Level']."' ";
  	$runsql4=mysqli_query($conn,$sql4);
	$sql4fetch=mysqli_fetch_array($runsql4);
	
     $dd=date('Y-m-d', strtotime($_row['entryDate']));

	 $d = strtotime("+".$sql4fetch['Expiry_month']." months",strtotime($dd));
     // $R=  date("d-m-Y",$d);
   $formattedValue = date("F, Y", $d);
   $R=$formattedValue;

$ddd=date('d-m-Y', strtotime($_row['entryDate']));


	 $contents.="\n".$cnt."\t";
     $contents.=$_row['Primary_Title']."\t";
	 $contents.=$sql2fetch['FirstName']." ".$sql2fetch['LastName']."\t";
	 $contents.=$_row['GenerateMember_Id']."\t";
	 $contents.=$sql3fetch['level_name']."\t";
	  $contents.=$R."\t";
     $contents.=$ddd."\t";
     $contents.='Primary'."\t";


    
if($_row['Primary_MaritalStatus']=='Married'){
    
    $cnt++;
$useBelowSpouse++;

	 $contents.="\n".$cnt."\t";
     $contents.=$_row['Spouse_Title']."\t";
	 $contents.=$_row['Spouse_FirstName']." ".$_row['Spouse_LastName']."\t";
	 $contents.=$_row['GenerateMember_Id']."\t";
	 $contents.=$sql3fetch['level_name']."\t";
	  $contents.=$R."\t";
     $contents.=$ddd."\t";
     $contents.='Complimentory'."\t";

}






	
 } 
 
$contents = strip_tags($contents); 

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
//  header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
   header("Content-Disposition: attachment; filename=mis.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
?>
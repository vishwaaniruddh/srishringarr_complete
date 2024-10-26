<?php
include('config.php');
$sqlme=$_POST['qr'];
$sqlme=$sqlme.' order by po_id DESC limit 1000';

//echo $sqlme;



$table=mysqli_query($con1,$sqlme);

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}

$contents='';
 $contents.="Sr. No.\t Customer\t Billing Branch\t PO No\t PO Date\t Uploaded Date\t Buyer/End User\t Address\t Sales Person\t No. of SItes\t AMC Value\t AMC Start Date\t End Date\t Billing period\t Uploaded By\t Bill Status\t Last Invoice No\t Inv Date\t Invoice Amount\t Bill Due Date\t action\t";

 $cnt=0;
 
while($row=mysqli_fetch_assoc($table))
{
$cnt++;

$id=$row['po_id'];
$po_no=$row['po_no'];
$po_date= $row['po_date'];
$cust_id=  $row['cust_id'];
$branch_id=  $row['bill_branch'];
$saleperson= $row['saleperson'];
$buyer=clean($row['buyer']);
$buyer_add=clean($row['buyer_add']);
$no_sites=$row['no_sites'];
$start_date=$row['start_date'];
$exp_date=$row['exp_date'];
$pm_time=$row['pm_time'];
$billperiod=$row['billperiod'];
$amc_value=$row['amc_value'];
$created_by=$row['created_by'];
$created_at=$row['created_at'];
$po_file=$row['po_file'];
$data_file=$row['data_file'];

$bill_status=$row['bill_status'];

$upload_date= $row['upload_date'];
$status= $row['status'];

$custname=mysqli_query($con1,"select `cust_name` from `customer` where `cust_id`='".$cust_id."'");
$custname1=mysqli_fetch_row($custname);

$brname=mysqli_query($con1,"select `name` from `avo_branch` where `id`='".$branch_id."'");
$br=mysqli_fetch_row($brname);
if( $branch_id=='all') { $branch='All';}
else $branch=$br[0];

$contents.="\n".$cnt. "\t";
$contents.=$custname1[0]. "\t";
$contents.=$branch. "\t";
$contents.=$po_no. "\t";
$contents.=$po_date. "\t";
$contents.=$created_at. "\t";
$contents.=$buyer. "\t";
$contents.=$buyer_add. "\t";
$contents.=$saleperson. "\t";
$contents.=$no_sites. "\t";
$contents.=$amc_value. "\t";
$contents.=$start_date. "\t";
$contents.=$exp_date. "\t";


if($billperiod==0){ $period = "100% Adv";}
elseif($billperiod==3){ $period = "Quarterly";}
elseif($billperiod==6){ $period = "Half Year";}
elseif($billperiod==12){ $period = "After Completion";}

$contents.=$period. "\t";

$contents.=$created_by. "\t";

if($bill_status==0){ $dis="Pending";}
if($bill_status==1){ $dis="Partial Bills Done";}
if($bill_status==2){ $dis="Completed";}
$contents.=$dis. "\t";

$billsquery=mysqli_query($con1,"select * from `amc_bills` where `po_id`='".$id."'order by id DESC limit 1");
$bill=mysqli_fetch_row($billsquery);

$contents.=$bill[2]. "\t";
$contents.=$bill[3]. "\t";
$contents.=$bill[4]. "\t";

$curr=strtotime(date('Y-m-d'));
$start_date1=strtotime($start_date);
$repet=strtotime($bill[7]);
$expdt=strtotime($exp_date);


if($bill_status==0 && $billperiod==0){$duedate=$start_date;}

if($bill_status==0){
if($billperiod==3){
$duedate=date('Y-m-d', strtotime('+3 months', $start_date1));} 
elseif ($billperiod==6){
$duedate=date('Y-m-d', strtotime('+6 months', $start_date1));} 

elseif ($billperiod==12){
$duedate=$exp_date;} 
}

elseif($bill_status==1){
if($billperiod==3){
$duedate=date('Y-m-d', strtotime('+3 months', $repet));} 
elseif ($billperiod==6){
$duedate=date('Y-m-d', strtotime('+6 months', $repet));} 
elseif ($billperiod==12){ $duedate=$exp_date;} 
}
$duedate1=strtotime($duedate);

if($duedate1 > $expdt ) { $duedate=$exp_date;}

//=== 100% Adv===
if($bill_status==0 && $billperiod==0 ){ $act= "Raise the Bill";}

if($bill_status==0 && $duedate1 < $curr ){$act= "Raise Bill";} 
if($bill_status==0 && $duedate1 > $curr ){$act= "Period not Over"; }
if($bill_status==1 && $duedate1 < $curr ){$act= "Raise Part Bill";} 
if($bill_status==1 && $duedate1 > $curr ){$act= "Part Period not Over"; }

$contents.=$duedate. "\t";
$contents.=$act. "\t";

}


$contents = strip_tags($contents); 

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
//  header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
   header("Content-Disposition: attachment; filename=amc_po.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
 
?>
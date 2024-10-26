<?php

include 'config.php';
$id=$_POST['ad_id'];
$pid=$_POST['pid'];
$cond=$_POST['condi'];
$diag=$_POST['diag'];
$refno=$_POST['refno'];
$datedis=$_POST['datedis'];
$timedis=$_POST['timedis'];
$dept=$_POST['dept'];
$consult=$_POST['consult'];
$proc=$_POST['proc'];
$other=$_POST['other'];
$code=$_POST['code'];
$rate=$_POST['rate'];
$amt=$_POST['amt'];
$amtdt=$_POST['amtdt'];
$qty=$_POST['qty'];
$amtc=$_POST['amtc'];
$implan=$_POST['implan'];
$rem1=$_POST['rem1'];
$other_proc=$_POST['other_proc'];
$other_rate=$_POST['other_rate'];
$other_cdate=$_POST['other_cdate'];
$other_qty=$_POST['other_qty'];
$other_crate=$_POST['other_crate'];
$amtcII=$_POST['amtcII'];
$procs=$_POST['procs'];
$others=$_POST['others'];
$codes=$_POST['codes'];
$rates=$_POST['rates'];
$amts=$_POST['amts'];
$amtsdt=$_POST['amtsdt'];
$qtys=$_POST['qtys'];
$amtcIII=$_POST['amtcIII'];
$medst=$_POST['medst'];
$bills=$_POST['bills'];
$amtst=$_POST['amtst'];
$amtstdt=$_POST['amtstdt'];
$amtcIV=$_POST['amtcIV'];

$totalamt=$_POST['totalamt'];
$totalrem=$_POST['totalrem'];
$rem=$rem1.".".$totalrem;
$d=count($proc);
$d1=count($other_proc);
$d2=count($procs);
$d3=count($medst);

mysqli_query($con,"update admission set dis_date=STR_TO_DATE('".$datedis."','%d/%m/%Y') ,dis_time='".$timedis."' where ad_id='".$id."'");

mysqli_query($con,"insert into discharge(ad_id,diagnosis,condi,implant,amt1,amt2,amt3,remarks,department,consultant,amt4) values('$id','$diag','$cond','$implan','$amtc','$amtcII','$amtcIII','$rem','$dept','$consult','$amtcIV')");

for($i=0;$i<$d;$i++)
{ 
if($code[$i]!='')
mysqli_query($con,"insert into discharge_details(ad_id,code,other,rate,qty,claimed,type,claim_date) values('$id','$proc[$i]','$other[$i]','$rate[$i]','$qty[$i]','$amt[$i]','1','$amtdt[$i]')");		  
}

for($i=0;$i<$d1;$i++)
{
if($other_proc[$i]!=0) 
mysqli_query($con,"insert into discharge_details(ad_id,code,rate,qty,claimed,type,claim_date) values('$id','$other_proc[$i]','$other_rate[$i]','$other_qty[$i]','$other_crate[$i]','2','$other_cdate[$i]')");	  
}

for($i=0;$i<$d2;$i++)
{
if($codes[$i]!='') 
mysqli_query($con,"insert into discharge_details(ad_id,code,other,rate,qty,claimed,type,claim_date) values('$id','$procs[$i]','$others[$i]','$rates[$i]','$qtys[$i]','$amts[$i]','3','$amtsdt[$i]')");		  
}

for($i=0;$i<$d3;$i++)
{
if($medst[$i]!=0) 
mysqli_query($con,"insert into discharge_details(ad_id,code,other,rate,qty,claimed,type,claim_date) values('$id','$medst[$i]','$bills[$i]','0','0','$amtst[$i]','4','$amtstdt[$i]')");		  
}

header('location:home.php');

?>
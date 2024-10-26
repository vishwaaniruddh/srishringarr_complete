<?php

session_start();

include('config.php');

$date1 = $_GET['date'];

$date2= $date = str_replace('/', '-', $date1 );
$date=date('Y-m-d',strtotime($date2));


//echo $date;

$id=$_GET['id'];
$sub=$_GET['reason'];
$remarks=$_GET['remarks'];
if($remarks==''){ $remarks='NULL';}

$upsspec=$_GET['upsspec'];
if($upsspec==''){ $upsspec='NULL';}

$upsqty=$_GET['upsqty'];
if($upsqty==''){ $upsqty='0';}
$battqty=$_GET['battqty'];
if($battqty==''){ $battqty='0';}

$battspec=$_GET['battspec'];
if($battspec==''){ $battspec='NULL';}
$remarkqty=$_GET['remarkqty'];
if($remarkqty==''){ $remarkqty='0';}

$pickup_by=$_GET['pickup_by'];

$user = $_SESSION['user'];

//echo $remarks;

$qry=mysqli_query($con1,"update new_buyback set is_collected= '".$sub."', buyback_date='".$date."', remark='".$remarks."', update_by='".$user."', ups_spec='".$upsspec."'  ,ups_qty='".$upsqty."' , batt_spec='".$battspec."' , batt_qty='".$battqty."' , other_qty='".$remarkqty."', pickup_by='".$pickup_by."' where track_id='".$id."' ");


if($qry)echo "Success";

else echo  '-1';
?>
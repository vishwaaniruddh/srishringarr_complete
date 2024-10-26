<?php

session_start();

include('config.php');

$date1 = $_GET['date'];
$date2= $date = str_replace('/', '-', $date1 );
$date=date('Y-m-d',strtotime($date2));


$id=$_GET['id'];
$sub=$_GET['status'];
$user = $_SESSION['user'];




$qry=mysqli_query($con1,"update amc_po_new set status= '".$sub."', upload_date='".$date."' where po_id='".$id."' ");


if($qry)echo $date;

else echo  '-1';
?>
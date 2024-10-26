<?php

session_start();

include('config.php');

$id=$_GET['id'];
$status=$_GET['reason'];
$remarks=$_GET['remarks'];
$amount=$_GET['amount'];
$user = $_SESSION['user'];
$date= date('Y-m-d H:i:s');

//echo $remarks;

$qry=mysqli_query($con1,"update approved_expenses set status='".$status."', verify_rem='".$remarks."', verify_amt='".$amount."', verify_by='".$user."', verify_dt='".$date."' where id='".$id."' ");


if($qry)echo $amount;

//else echo '-1';
?>
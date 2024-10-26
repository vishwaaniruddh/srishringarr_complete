<?php

session_start();

include('config.php');

$id=$_GET['id'];
$sub=$_GET['reason'];
$remarks=$_GET['remarks'];
$user = $_SESSION['user'];

//echo $remarks;

$qry=mysqli_query($con1,"insert into tempcall_status1 set alert_id= '".$id."', reason='".$sub."', remarks='".$remarks."', user='".$user."' ");


if($qry)echo $sub;

else echo '-1';
?>
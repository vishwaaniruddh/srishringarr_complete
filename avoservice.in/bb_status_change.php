<?php

session_start();

include('config.php');



$id=$_GET['id'];
$sub=$_GET['reason'];
$user = $_SESSION['user'];

//echo $sub;

//echo $user;

$qry=mysqli_query($con1,"update new_sales_order set bb_available= '".$sub."' where so_trackid='".$id."' ");

$qry1=mysqli_query($con1,"insert into new_buyback set so_trackid= '".$id."', bb_available='Yes', is_collected=0 , ups_qty=0,batt_qty =0 , other_qty=0 ");
//insert into new_buyback set so_trackid=76248 , bb_available='Yes', is_collected=0 , ups_qty=0,batt_qty =0 , other_qty=0

if($qry1)echo "Successful";

else echo '-1';
?>
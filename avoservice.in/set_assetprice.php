<?php

session_start();

include('config.php');

$id=$_GET['id'];
$price=$_GET['price'];
$user = $_SESSION['user'];
$date=date("Y-m-d H:i:s");
//echo $sub;

//echo $user;

$qry=mysqli_query($con1,"update assets_specification set price= '".$price."', edit_by= '".$user."' , edit_time='".$date."' where ass_spc_id='".$id."' ");

if($qry)echo "Successful";

else echo '-1';
?>
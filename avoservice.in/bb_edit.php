<?php

session_start();
include('config.php');

$id=$_GET['id'];

$qry1=mysqli_query($con1,"insert into new_buyback set so_trackid= '".$id."'");

if($qry1)echo "Successful";

else echo '-1';
?>
<?php
$id=$_GET['id'];
include("config.php");


$qry=mysqli_query($con1,"Update whatsapp_customer set status='0' where id='".$id."'");

//echo "Update whatsapp_customer set status='0' where id='".$id."'";

if($qry)
echo "<script type='text/javascript'>alert('Data Entered Successfully');window.location='view_whatspp_no.php';</script>";

else
echo "<script type='text/javascript'>alert('Something Went Wrong');window.location='view_whatspp_no.php';</script>";

?>
<?php
session_start();

//$id= $_GET['id'];

$id=$_POST['id'];

echo $id;

$name= $_POST['name'];
$no= $_POST['whatsapp_no'];



if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Your Session has expired. Please login again');window.location='index.php';</script>";
}
else
{
include('config.php');

$updt="Update whatsapp_customer set name='".$name."', whatsapp_no='".$no."' where id='".$id."'";

//echo $updt;

$qry=mysqli_query($con1,$updt);

if($qry)
echo "<script type='text/javascript'>alert('Data Entered Successfully');window.location='view_whatspp_no.php';</script>";
else
 echo "<script type='text/javascript'>alert('Some Error Occurred'); window.location='view_whatspp_no.php';
 </script>";
} 

?>
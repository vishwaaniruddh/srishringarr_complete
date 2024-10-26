<?php 
include 'config.php';

session_start();
$cat=$_POST['cat'];
$appdate=$_POST['appdate'];
$type=$_POST['type'];
$report=$_POST['report'];
$sym=$_POST['sym'];
//echo $type;
if($type=="X-RAY"){

$sql="SELECT amount FROM  `xraymast` where type='$report'";
$result=mysqli_query($con,$sql);

$row=mysqli_fetch_row($result);
$amount=$row[0]; 
}else if($type=="USG"){


$amount=550; 
}else if($type=="LAB")
{
$sql="SELECT amount FROM  `labmast`  where type='$report'";
$result=mysqli_query($con,$sql);

$row=mysqli_fetch_row($result);
$amount=$row[0]; 
}

$sql1="insert into diagnose(srno,date,type,report,finding,amount) values('$cat',STR_TO_DATE('".$appdate."','%d/%m/%Y'),'$type','$report','$sym','$amount')";

$result1=mysqli_query($con,$sql1);
if($result1)
{
header("location: home.php");
 }else
echo "error Inserting data";
?>
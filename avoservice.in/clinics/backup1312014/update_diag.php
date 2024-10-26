<?php 
include('config.php');

session_start();
$cat=$_POST['cat'];
$appdate=$_POST['appdate'];
$type=$_POST['type'];
$report=$_POST['report'];
$sym=$_POST['sym'];
//echo $type;
if($type=="X-RAY"){

$sql="SELECT amount FROM  `xraymast` where type='$report'";
$result=mysql_query($sql);

$row=mysql_fetch_row($result);
$amount=$row[0]; 
}else if($type=="USG"){


$amount=550; 
}else if($type=="LAB")
{
$sql="SELECT amount FROM  `labmast`  where type='$report'";
$result=mysql_query($sql);

$row=mysql_fetch_row($result);
$amount=$row[0]; 
}

$sql1="update diagnose set srno='".$cat."',date=STR_TO_DATE('".$appdate."','%d/%m/%Y'),type='".$type."',report='".$report."',finding='".$sym."',amount='".$amount."' where d_id='".$id."'"; 

$result1=mysql_query($sql1);
if($result1)
{
header("location: view_diag.php");
 }else
echo "error Inserting data";
?>
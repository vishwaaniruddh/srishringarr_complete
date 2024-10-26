<?php 
include 'config.php';

session_start();

$id=$_POST['id'];
$days='';
$appfor=$_POST['appfor'];
$doc=$_POST['doc'];
$appdate=$_POST['appdate'];
$hr=$_POST['hour'];
$min=$_POST['min'];
$time= $hr.":".$min;
$type=$_POST['type'];
$app_id=$_POST['aid'];
$wait="No";

$sql1="update appoint set reason='".$appfor."',doctor='".$doc."',date=STR_TO_DATE('".$appdate."','%d/%m/%Y'),time='".$time."',type='".$type."' where waiting_list='".$app_id."'";

$result1=mysqli_query($con,$sql1);

$sql="update surgery_wait set waiting='".$wait."',days='".$days."' where w_id='".$id."'"; 
$result=mysqli_query($con,$sql);

if($result && $result1)
{
header("location: home.php");
}
else
echo "error Inserting data";
?>
<?php 
include 'config.php';

session_start();

$fname=$_POST['fname'];
$contact=$_POST['cn'];
$address=$_POST['add'];
$ref=$_POST['ref'];
$charges=$_POST['charges'];

$sql="insert into patient(name,mobile,address,ref,date) 
values('$fname','$contact','$address','$ref',curdate())";
$result=mysqli_query$con,($sql);

$sq=mysqli_query($con,"select max(no) from patient");
$max=mysqli_fetch_row($sq);


$appfor=$_POST['appfor'];
$doc=$_POST['doc'];
$appdate=$_POST['appdate'];
$hr=$_POST['hour'];
$min=$_POST['min'];
$time= $hr.":".$min;
$type=$_POST['type'];

$sql1="insert into appoint(no,reason,doctor,date,time,type,charges) values('$max[0]','$appfor','$doc',STR_TO_DATE('".$appdate."','%d/%m/%Y'),'$time','$type','$charges')";
$result1=mysqli_query($con,$sql1);

if($result && $result1)
{
header("location: printticket.php?id=".$max."&did=".$doc);
}
else
echo "error Inserting data";
?>
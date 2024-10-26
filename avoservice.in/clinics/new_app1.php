<?php 
include('config.php');

session_start();

$fname=$_POST['fname'];
$contact=$_POST['cn'];
$address=$_POST['add'];
$ref=$_POST['ref'];


$sql="insert into patient(name,mobile,address,ref,date) 
values('$fname','$contact','$address','$ref',curdate())";
$result=mysql_query($sql);

$sq=mysql_query("select max(no) from patient");
$max=mysql_fetch_row($sq);


$appfor=$_POST['appfor'];
$doc=$_POST['doc'];
$appdate=$_POST['appdate'];
$hr=$_POST['hour'];
$min=$_POST['min'];
$time= $hr.":".$min;
$type=$_POST['type'];

$sql1="insert into appoint(no,reason,doctor,date,time,type) values('$max[0]','$appfor','$doc',STR_TO_DATE('".$appdate."','%d/%m/%Y'),'$time','$type')";
$result1=mysql_query($sql1);

if($result && $result1)
{
header("location: home.php");
}
else
echo "error Inserting data";
?>
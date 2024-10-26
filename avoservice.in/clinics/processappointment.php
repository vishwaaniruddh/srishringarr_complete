<?php 
include('config.php');


$cdate1=$_POST['cdate1'];
$fname=$_POST['fname'];
$appfor=$_POST['appfor'];
$newold=$_POST['new'];
$appdate=$_POST['appdate'];
$cn=$_POST['cn'];
$mob=$_POST['mob'];
$doc=$_POST['doc'];
$type=$_POST['type'];
$ref=$_POST['ref'];
$hos=$_POST['hos'];
$remarks=$_POST['rem'];
$hr=$_POST['hour'];
$min=$_POST['min'];
$time1= $hr.":".$min;
$email=$_POST['email'];


//echo $doc;
$result2=mysql_query("select max(no) from `patient`");
$row2=mysql_fetch_row($result2);

$sql="insert into `appoint`(date,name,time,app_date,new_old,telno,mobile,ref,doctor,type,hospital,remarks,email,no)
 values(STR_TO_DATE('".$cdate1."','%d/%m/%Y'),'$fname','$time1',STR_TO_DATE('".$appdate."','%d/%m/%Y'),'$newold','$cn','$mob','$ref','$doc','$type','$hos','$remarks','$email','$row2[2]')";

$sql1="insert into `patient`(date,name,reference,telno,mobile,email,ref) values(STR_TO_DATE('".$cdate1."','%d/%m/%Y'),'$fname','$doc','$cn','$mob','$email','$ref')";
$result1=mysql_query($sql1);

$result=mysql_query($sql);
if($result1)
{
	if($result){
	
header("location:home.php");
}
}
else
echo "error Inserting data";

?>
<?php 
include('config.php');

session_start();

$fname=$_POST['fname'];
$dob=$_POST['dob'];
$age=$_POST['age'];
$gender=$_POST['gen'];
$contact=$_POST['cn'];
$city=$_POST['city'];
$address=$_POST['add'];
$bloodgroup=$_POST['bg'];
$ms=$_POST['ms'];
$height=$_POST['height'];
$hr=$_POST['hour'];
$min=$_POST['min'];
$time= $hr.":".$min;
$ref=$_POST['ref'];
$doc=$_POST['doc'];
$follow=$_POST['follow'];
$hos=$_POST['hos'];
$email=$_POST['email'];


$sql="insert into patient(name,birth,age,sex,mobile,city,address,ref,type,date,height,bloodgroup,marital_status,email,hospital) 
values('$fname',STR_TO_DATE('".$dob."','%d/%m/%Y'),'$age','$gender','$contact','$city','$address','$ref','$follow',curdate(),'$height','$bloodgroup','$ms','$email','$hos')";
$result=mysql_query($sql);

$sq=mysql_query("select max(no) from patient");
$max=mysql_fetch_row($sq);
$sql1="insert into appoint(no,doctor,time,type) values('$max[0]','$doc','$time','$follow')";
$result1=mysql_query($sql1);

if($result && $result1)
{
header("location: home.php");
}
else
echo "error Inserting data";
?>
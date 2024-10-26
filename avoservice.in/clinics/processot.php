<?php
include('config.php');

$fnamed=$_POST['fname'];
$apdate=$_POST['apdate'];
$tel=$_POST['tel'];
$mob=$_POST['mob'];

$hr=$_POST['hour'];
$min=$_POST['min'];
$time=$hr.":".$min;

$hr1=$_POST['hour1'];
$min1=$_POST['min1'];
$time1=$hr1.":".$min1;


$doc=$_POST['doc'];
$hos=$_POST['hos'];
$rem=$_POST['rem'];
$ane=$_POST['ane'];
$surtxt=$_POST['surtxt'];

$sql="insert into operate (date,name,telno,mobile,time,time1,ref,remarks,anaesth,operation,hospital)
 values(STR_TO_DATE('".$apdate."','%d/%m/%Y'),'$fname','$tel','$mob','$time','$time1','$doc','$rem','$ane','$surtxt','$hos')";

$result=mysql_query($sql);

if($result)
{
	
header("location: otscheduler.php");

}
else
echo "error Inserting data";

?>
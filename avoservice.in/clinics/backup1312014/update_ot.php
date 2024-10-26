<?php 
include('config.php');

$id=$_POST['id'];
$fname=$_POST['fname'];
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

$sql="update operate set name='".$fname."',date=STR_TO_DATE('".$apdate."','%d/%m/%Y'),telno='".$tel."',mobile='".$mob."',time='".$time."',time1='".$time1."',ref='".$doc."',remarks='".$rem."',anaesth='".$ane."',operation='".$surtxt."',hospital='".$hos."' where ot_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: otscheduler.php");

}
else
echo "error Updating data";
?>
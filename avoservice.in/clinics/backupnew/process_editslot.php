<?php 
include('config.php');

$slot_id=$_POST['slot_id'];

$hos=$_POST['hos'];
$appdate=$_POST['appdate'];

$hr=$_POST['hour'];
$min=$_POST['min'];


$hr1=$_POST['hour1'];
$min1=$_POST['min1'];


$dur=$_POST['dur'];
$dur1=$_POST['dur1'];
if($dur=="pm" && $hr!=12){
	$hr+=12;
	}
	if($dur=="am" && $hr==12){
			$hr="00";
			}
if($dur1=="pm" && $hr1!=12){
	$hr1+=12;
	}
	if($dur1=="am" && $hr1==12){
			$hr1="00";
			}
$time=$hr.":".$min;
$time1=$hr1.":".$min1;

$sql="update slot set hospital='".$hos."',app_date=STR_TO_DATE('".$appdate."%','%d/%m/%Y'), start_time='".$time."', end_time='".$time1."',center='".$_POST['center']."' where block_id='".$slot_id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: view_slot.php");

}
else
echo "error Inserting data";
?>
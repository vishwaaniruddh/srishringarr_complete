<?php 
include('config.php');

session_start();

$id=$_POST['patient_id'];
$appfor=$_POST['appfor'];
$doc=$_POST['doc'];
$appdate=$_POST['appdate'];
$hr=$_POST['hour'];
$min=$_POST['min'];
$time= $hr.":".$min;
$type=$_POST['type'];

$sql="insert into appoint (no,reason,doctor,app_date,time,date,type) values('$id','$appfor','$doc',STR_TO_DATE('".$appdate."','%d/%m/%Y'),'$time',curdate(),'$type')";

$result=mysql_query($sql);
if($result)
{
	
header("location: home.php");

}
else
echo "error Inserting data";

?>
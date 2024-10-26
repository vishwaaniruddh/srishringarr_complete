<?php 
include 'config.php';

session_start();

$id=$_POST['patient_id'];
$appfor=$_POST['appfor'];
$doc=$_POST['doc'];
$refno=$_POST['refno'];
$cdate=$_POST['cdate'];
$appdate=$_POST['appdate'];
$hr=$_POST['hour'];
$min=$_POST['min'];
$time= $hr.":".$min;
$type=$_POST['type'];
$charges=$_POST['charges'];

$sql="insert into appoint(no,ref,reason,doctor,date,app_date,time,type,charges) values('$id','$refno','$appfor','$doc',STR_TO_DATE('".$cdate."','%d/%m/%Y'),STR_TO_DATE('".$appdate."','%d/%m/%Y'),'$time','$type','$charges')";

echo $sql;
$result=mysqli_query($con,$sql);
if($result)
{
	
header("location: printticket.php?id=".$id."&did=".$doc);

}
else
echo "error Inserting data";

?>
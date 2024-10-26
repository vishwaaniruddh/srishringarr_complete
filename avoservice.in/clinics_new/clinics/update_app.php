<?php 
include 'config.php';

$id=$_POST['id'];

$appfor=$_POST['appfor'];
$doc=$_POST['doc'];
$appdate=$_POST['appdate'];
$hr=$_POST['hour'];
$min=$_POST['min'];
$time= $hr.":".$min;
$type=$_POST['type'];


$sql="update new_app set appointment_for='".$appfor."',doctor='".$doc."',app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y'),app_time ='".$time."',cdate=curdate(),type='".$type."' where treatment_id='".$id."'";

$result=mysqli_query($con,$sql);
if($result)
{
	
header("location: home.php");

}
else
echo "error Inserting data";
?>
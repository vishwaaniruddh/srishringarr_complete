<?php
include ('config.php');

$adate=$_POST['atdate'];
$name=$_POST['name'];
$present=$_POST['present'];
$hour=$_POST['hr'];
$min=$_POST['min'];
$ot=$_POST['ot'];
$time=$hour.":".$min;

  
$sql="insert into attendence (attdate,name,present,time,ot) values (STR_TO_DATE('".$adate."','%d/%m/%Y'),'$name','$present','$time','$ot')";


$result=mysql_query($sql);
if ($result)
{
	header("location:home.php");
}
else 
echo "Error Inserting Data";

?>
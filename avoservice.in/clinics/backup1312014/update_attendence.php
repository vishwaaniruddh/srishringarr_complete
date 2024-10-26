<?php
include ('config.php');

$id=$_POST['id'];


$present=$_POST['present'];
$hour=$_POST['hour'];
$min=$_POST['min'];
$ot=$_POST['ot'];
$time=$hour.":".$min;

$sql="update attendence set present='".$present."',time='".$time."',ot='".$ot."' where att_id='".$id."'";
$result=mysql_query($sql);


if ($result)
{
	header("location:home.php");
}
else 
echo "Error Inserting Data";

?>
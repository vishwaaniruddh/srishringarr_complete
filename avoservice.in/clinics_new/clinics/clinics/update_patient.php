<?php 
include('config.php');

$id=$_POST['id'];
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


$sql="update new_patient set fname='".$fname."',dob=STR_TO_DATE('".$dob."','%d/%m/%Y'),age='".$age."',gender='".$gender."',contact='".$contact."',city='".$city."',address='".$address."',bloodgroup='".$bloodgroup."',marital_status ='".$ms."',height='".$height."',doc_reference='".$ref."',type='".$follow."' where patient_id='".$id."'";
$result=mysql_query($sql);

$sql1="update new_app set time_given='".$time."',doctor='".$doc."',type='".$follow."' where patient_id='".$id."'";
$result1=mysql_query($sql1);

if($result && $result1)
{
	
header("location: home.php");

}
else
echo "Error Updating data"; 

?>
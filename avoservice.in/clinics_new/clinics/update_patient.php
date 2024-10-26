<?php 
include 'config.php';

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
$esino=$_POST['esino'];
$refd=$_POST['refd'];
$diag=$_POST['diag'];
$refno=$_POST['refno'];


$sql="update patient set name='".$fname."',birth=STR_TO_DATE('".$dob."','%d/%m/%Y'),age='".$age."',sex='".$gender."',telno='".$contact."',city='".$city."',address='".$address."',bloodgroup='".$bloodgroup."',marital_status ='".$ms."',height='".$height."',reference='".$ref."',type='".$follow."',esino='".$esino."',referral_date=STR_TO_DATE('". $referral_date."','%d/%m/%Y'),diagnosis='".$diagnosis."',refno='".$refno."' where no='".$id."'";
$result=mysqli_query($con,$sql);
if($result){
$sql1="update appoint set time='".$time."',doctor='".$doc."',type='".$follow."' where NO='".$id."'";
$result1=mysqli_query($con,$sql1);
// echo $sql1;

if($result1)
{
	
header("location: home.php");

}
 else
echo "Error Updating appointment"; 
}
else
echo "Error Updating data"; 

?>
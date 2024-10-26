<?php 
include('config.php');

session_start();

$id=$_POST['id'];
$days='';
$appdate=$_POST['appdate'];
$doc=$_POST['doc'];
//$time= $hr.":".$min;
$type=$_POST['type'];
$app_id=$_POST['aid'];
$adm=$_POST['adm'];
$wait="No";

$hour=$_POST['hour'];
$min=$_POST['min'];
$dur=$_POST['dur'];
$start_time=$hour.":".$min.":".$dur;

$hour1=$_POST['hour1'];
$min1=$_POST['min1'];
$dur1=$_POST['dur1'];
$end_time=$hour1.":".$min1.":".$dur1;

$ad_hour=$_POST['ad_hour'];
$ad_min=$_POST['ad_min'];
$ad_dur=$_POST['ad_dur'];
$ad_time=$ad_hour.":".$ad_min.":".$ad_dur;

$diag=$_POST['diag'];
$sur=$_POST['sur'];
$ot_type=$_POST['ot_type'];

$hospital=$_POST['hospital'];
$pts=$_POST['pts'];
$imp=$_POST['imp'];
$nbm=$_POST['nbm'];
$cat=$_POST['cat'];
$room=$_POST['room'];

$sql="update surgery_wait set waiting='".$wait."',wdate=STR_TO_DATE('".$appdate."','%d/%m/%Y'),adm_date=STR_TO_DATE('".$adm."','%d/%m/%Y'),room_type='".$room."',type='".$type."',Surgery_start_time='".$start_time."',Surgery_end_time='".$end_time."',Diagnosis='".$diag."',Suregery='".$sur."',ot_type='".$ot_type."',hospital='".$hospital."',pts='".$pts."',implant='".$imp."',Anesthetic='".$doc."',nbm='".$nbm."',cat='".$cat."',ad_time='".$ad_time."' where w_real_id='".$id."'"; 


$result=mysql_query($sql);

if($result)
{
header("location: home.php");
}
else
echo "error Inserting data";
?>
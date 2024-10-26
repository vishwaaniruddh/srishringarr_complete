<?php 
include('config.php');

session_start();

$id=$_POST['patient_id'];
$wait=$_POST['wait'];
$type=$_POST['type'];
$room=$_POST['room'];
$doc=$_POST['doc'];
$adm=$_POST['adm'];
$next_date=$_POST['next_date'];

if($wait=="Yes"){
	$next_date=$_POST['next_date'];
	$days=$_POST['days'];




}else {

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

	$days='';
	
//$appfor=$_POST['appfor'];
}
///echo $type;
$sq12=mysql_query("select * from `machine_code` where machine_name='Net'");
$max12=mysql_fetch_row($sq12);

$sq11=mysql_query("select max(w_id) from surgery_wait");
$max11=mysql_fetch_row($sq11);
//echo $max[0];
$newopd=$max11[0]+1;
$newsrno=$max12[0]."-".$newopd;


if($wait=="Yes"){

$sql="insert into surgery_wait(p_id,waiting,days,wdate,next_date,room_type,adm_date,w_real_id,w_id,type) 
values('$id','$wait','$days',curdate(),STR_TO_DATE('".$next_date."','%d/%m/%Y'),'$room',STR_TO_DATE('".$adm."','%d/%m/%Y'),'$newsrno','$newopd','$type')";
$result=mysql_query($sql);
}else{


$sql="insert into surgery_wait(p_id,waiting,days,wdate,next_date,room_type,adm_date,w_real_id,w_id,type,Surgery_start_time,Surgery_end_time,Diagnosis,Suregery,ot_type,hospital,pts,implant,Anesthetic,nbm,cat,ad_time) 
values('$id','$wait','$days',curdate(),STR_TO_DATE('".$next_date."','%d/%m/%Y'),'$room',STR_TO_DATE('".$adm."','%d/%m/%Y'),'$newsrno','$newopd','$type','$start_time','$end_time','$diag','$sur','$ot_type','$hospital','$pts','$imp','$doc','$nbm','$cat','$ad_time')";


 

  
 

$result=mysql_query($sql);
}

if($result)
{
if($wait=="Yes"){


?>
<script>
 
    close();
  

</script>

<?php
}else{ 
header('location:home.php');
}
}
else
echo "error Inserting data".mysql_error();
?>
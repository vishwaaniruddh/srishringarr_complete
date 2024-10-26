<?php 
include('config1.php');

$id=$_POST['patient_id'];
//echo $id;
$doc=$_POST['doc'];
$addate=$_POST['addate'];
$disdate=$_POST['disdate'];
$stay=$_POST['stay'];
$room=$_POST['room'];
$hr=$_POST['hour'];
$min=$_POST['min'];
$time= $hr.":".$min;
$hr1=$_POST['hour1'];
$min1=$_POST['min1'];
$time1= $hr1.":".$min1;
$final=$_POST['final'];
$all=$_POST['all'];
$present=$_POST['present'];
$past=$_POST['past'];
$sys=$_POST['sys'];
$local=$_POST['local'];
$pro=$_POST['pro'];
$built=$_POST['built'];
$temp=$_POST['temp'];
$nour=$_POST['nour'];
$pulse=$_POST['pulse'];
$aneama=$_POST['aneama'];
$resp=$_POST['resp'];
$cya=$_POST['cya'];
$lying=$_POST['lying'];
$oedema=$_POST['oedema'];
$bp=$_POST['bp'];
$jau=$_POST['jau'];
$skin=$_POST['skin'];
$throat=$_POST['throat'];
$nail=$_POST['nail'];
$tongue=$_POST['tongue'];
$other=$_POST['other'];
$lymph=$_POST['lymph'];

//echo"update admission set doctor='".$doc."',admit_date=STR_TO_DATE('".$addate."','%d/%m/%Y'),admit_time ='".$time."',dis_date=STR_TO_DATE('".$disdate."','%d/%m/%Y'),dis_time ='".$time1."',days ='".$stay."',room ='".$room."',final_diag ='".$final."',allergies ='".$all."',symptoms_of_present_illness='".$present."',past_illness ='".$past."',systematic_exam ='".$sys."',local_examination ='".$local."',provisional_diag ='".$pro."',built ='".$built."',temperature ='".$temp."',nourishment ='".$nour."',pulse ='".$pulse."',anaema ='".$aneama."',respiration ='".$resp."',cyanosis ='".$cya."',lying_bp_down ='".$lying."',oedema ='".$oedema."',bp_sitting ='".$bp."',jaundice ='".$jau."',skin ='".$skin."',throat ='".$throat."',nails ='".$nail."',tongue ='".$tongue."',other ='".$other."',lymph_nodes ='".$lymph."' where ad_id='".$id."'";
$sql="UPDATE  `satyavan_clinicmgt`.`admission` SET doctor='".$doc."',admit_date=STR_TO_DATE('".$addate."','%d/%m/%Y'),admit_time ='".$time."',dis_date=STR_TO_DATE('".$disdate."','%d/%m/%Y'),dis_time ='".$time1."',days ='".$stay."',room ='".$room."',final_diag ='".$final."',allergies ='".$all."',symptoms_of_present_illness='".$present."',past_illness ='".$past."',systematic_exam ='".$sys."',local_examination ='".$local."',provisional_diag ='".$pro."',built ='".$built."',temperature ='".$temp."',nourishment ='".$nour."',pulse ='".$pulse."',anaema ='".$aneama."',respiration ='".$resp."',cyanosis ='".$cya."',lying_bp_down ='".$lying."',oedema ='".$oedema."',bp_sitting ='".$bp."',jaundice ='".$jau."',skin ='".$skin."',throat ='".$throat."',nails ='".$nail."',tongue ='".$tongue."',other ='".$other."',lymph_nodes ='".$lymph."' where ad_id='".$id."'";

$result=mysql_query($sql);
if($result)
{

header("location: home.php");

}
else
echo "error Inserting data";
?>
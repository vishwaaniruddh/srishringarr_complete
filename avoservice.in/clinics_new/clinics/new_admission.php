<?php 
include 'config.php';

session_start();

$id=$_POST['patient_id'];
$doc=$_POST['doc'];
$refno=$_POST['refno'];
$refdate=$_POST['refd'];
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
$treattype=$_POST['tre'];


$sql="insert into admission (patient_id,doctor,admit_date,admit_time,dis_date,dis_time,days,room,final_diag,allergies,symptoms_of_present_illness,past_illness,systematic_exam,local_examination,provisional_diag,built,temperature,nourishment,pulse,anaema,respiration,cyanosis,lying_bp_down,oedema,bp_sitting,jaundice,skin,throat,nails,tongue,other,lymph_nodes,treat_type,refno,refdate) values('$id','$doc',STR_TO_DATE('".$addate."','%d/%m/%Y'),'$time',STR_TO_DATE('".$disdate."','%d/%m/%Y'),'$time1','$stay','$room','$final','$all','$present','$past','$sys','$local','$pro','$built','$temp','$nour','$pulse','$aneama','$resp','$cya','$lying','$oedema','$bp','$jau','$skin','$throat','$nail','$tongue','$other','$lymph','$treattype','$refno',STR_TO_DATE('".$refdate."','%d/%m/%Y'))";

$result=mysqli_query($con,$sql);

// mysqli_query($con,"update appoint set status='yes' where app_id='".$aid."'");
if($result)
{
	header("location: home.php");

}
else
echo "error Inserting data";

?>
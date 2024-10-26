<?php

include 'config.php';

$addate=$_POST['datead'];
$disdate=$_POST['disdate'];

$hr1=$_POST['hour1'];
$min1=$_POST['min1'];
$adtime=$hr1.":".$min1;

$hr2=$_POST['hour2'];
$min2=$_POST['min2'];
$distime=$hr2.":".$min2;

$date1=$_POST['date1'];

$hr3=$_POST['hour3'];
$min3=$_POST['min3'];
$btime=$hr3.":".$min3;


$weight=$_POST['weight'];
$gender=$_POST['gender'];
$bg=$_POST['bg'];
$typedel=$_POST['typedel'];
$apgar=$_POST['apgar'];
$indi=$_POST['indi'];
$pmc=$_POST['pmc'];
$hname=$_POST['hname'];
$edu=$_POST['edu'];
$notification=$_POST['notification'];
$mrel=$_POST['mrel'];
$medu=$_POST['medu'];
$bg2=$_POST['bg2'];


$sql="insert into delivery (admission_date,discharge_date,admission_time,discharge_time,date,time,weight,sex,blood_group,delivery_type,apgar_score,indication,pmc_reg,h_name,h_edu,birth_notify,m_rel,m_edu,m_blood_grp) values 
(STR_TO_DATE('".$addate."','%d/%m/%Y'),STR_TO_DATE('".$disdate."','%d/%m/%Y'),'$adtime','$distime',STR_TO_DATE('".$date1."','%d/%m/%Y'),'$btime','$weight','$gender','$bg','$typedel','$apgar','$indi','$pmc','$hname','$edu','$notification','$mrel','$medu','$bg2')";


$result=mysqli_query($con,$sql);

if($result)
{
	
header("location: home.php");

}
else
echo "error Inserting data";

?>

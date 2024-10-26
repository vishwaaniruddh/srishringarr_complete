<?php 
include('config.php');

$id=$_POST['id'];

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



$sql="update delivery set admission_date=STR_TO_DATE('".$addate."','%d/%m/%Y'),
discharge_date=STR_TO_DATE('".$disdate."','%d/%m/%Y'),
admission_time='".$adtime."',
discharge_time='".$distime."',
date=STR_TO_DATE('".$date1."','%d/%m/%Y'),
time='".$btime."',
weight ='".$weight."',
sex ='".$gender."',
blood_group ='".$bg."',
delivery_type ='".$typedel."',
apgar_score ='".$apgar."',
indication ='".$indi."',
pmc_reg ='".$pmc."',
h_name ='".$hname."',
h_edu ='".$edu."',
birth_notify ='".$notification."',
m_rel ='".$mrel."',
m_edu ='".$medu."',
m_blood_grp ='".$bg2."' where delivery_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: viewdelivery.php");

}
else
echo "error Inserting data";
?>
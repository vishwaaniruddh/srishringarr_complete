<?php 
include 'config.php';

session_start();
date_default_timezone_set('Asia/Calcutta');
$fname=mysqli_real_escape_string($con, $_POST['fname']);
$dob=$_POST['dob'];
$age=$_POST['age'];
$gender=$_POST['gen'];
$contact=$_POST['cn'];
$city=$_POST['city'];
$address=mysqli_real_escape_string($con,$_POST['add']);
$bloodgroup=$_POST['bg'];
$ms=$_POST['ms'];
$height=$_POST['height'];
//$hr=$_POST['hour'];
//$min=$_POST['min'];
//$time= $hr.":".$min;
$ref=$_POST['ref'];
//$doc=$_POST['doc'];
//$follow=$_POST['follow'];
$hos=$_POST['hos'];
$email=$_POST['email'];
$esino=0;//$_POST['esino'];

if(isset($_POST['esiname'])){

    $esiname=$_POST['esiname'];
}

//$refd="0000-00-00";//$_POST['refd'];
//$diag=$_POST['diag'];
//$refno=$_POST['refno'];

if(isset($_POST['rel'])){

    $rel=$_POST['rel'];
}

$charges=$_POST['charges'];
$aadhar=$_POST['aadhaar']; 
// echo $aadhar;die("0");
//insert into `patient`(name,birth,age,sex,mobile,city,address,ref,type,date,height,bloodgroup,marital_status,email,hospital)
$d=date('Y-m-d');
$sql=" 
INSERT INTO `patient` (`name`,`birth`, `age`, `sex`, `mobile`,`city`,`address`,`ref`, `date`,`height`, `bloodgroup`, `marital_status`,`email`,`hospital`,`esino`,`esiname`,`relation`,`referral_date`,diagnosis,refno,aadhar)
values('$fname',STR_TO_DATE('".$dob."','%d/%m/%Y'),'$age','$gender','$contact','$city','$address','$ref','$d','$height','$bloodgroup','$ms','$email','$hos','$esino','$esiname','$rel','2017-01-01','NA','NA','$aadhar')";


$result=mysqli_query($con,$sql);

echo mysqli_error($con);

$id=mysqli_insert_id($con);
$sql2="insert into appoint(no,ref,reason,doctor,date,app_date,time,type,charges,waiting_list,status) values('$id','$ref','','$ref','".date("Y-m-d")."','2017-01-01','0','','$charges',0,'')";

$insapp=mysqli_query($con,$sql2);

/*
$sq=mysqli_query("select max(no) from `patient`");
$max=mysqli_fetch_row($sq);
//echo $max[0];
$sql1="insert into appoint(no,doctor,time,type) values('$max[0]','$doc','$time','$follow')";
$result1=mysqli_query($sql1);
*/
if($result & $insapp)
{ //echo $esino;
//header("location: home.php");
header("location: printticket.php?id=".$id."&did=".$ref);
}
else
echo "error Inserting data".mysqli_error();
?>
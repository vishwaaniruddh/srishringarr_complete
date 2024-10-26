<?php
include("config.php");
 $city=$_POST['city'];
// $cat=$_POST['cat'];
 $branch=$_POST['branch'];
 $state_id=$_POST['state'];
 $area=$_POST['area'];
 $name=trim($_POST['name']);
 $cont=$_POST['cont'];
 $empcod=trim($_POST['empcode']);
 $desgnn=$_POST['desgn'];
 $dojj=date("Y-m-d",strtotime(str_replace("/","-",$_POST['doj'])));

$lat=$_POST['lat'];
$long=$_POST['long'];
$add=$_POST['add'];

 
$logid='';

$uname=explode(" ",$name);

$qr=mysqli_query($con1,"select max(srno) from login");
$row=mysqli_fetch_row($qr);

$uid=$uname[0].($row[0]+1)."";

$q=mysqli_query($con1,"INSERT INTO `login` (`srno`, `username`, `password`, `branch`, `designation`, `status`) VALUES (NULL, '".$uid."', '".$uid."123', '".$area."', '4', '1')");
$logid=mysqli_insert_id($con1);

if ($logid){
//echo "Insert into area_engg(`engg_name`,`area`,`city`,`email_id`,`phone_no1`,`resume`,`loginid`,`state_id`,`current_area`) Values('".$name."','".$area."','".$city."','".$email."','".$cont."','".$newname."','".$logid."','".$state_id."','".$area."')";

$qry=mysqli_query($con1,"Insert into area_engg (`engg_name`,`area`,`city`,`email_id`,`phone_no1`, `emp_code`,`resume`,`loginid`,`state_id` ,`current_area`, `branch_id`, `engg_desgn`, `date_join` , `latitude`, `longitude`, `address`, `status`) Values('".$name."','".$area."','".$city."','".$email."','".$cont."','".$empcod."', '".$newname."','".$logid."','".$state_id."','".$area."', '".$area."','".$desgnn."','".$dojj."','".$lat."','".$long."','".$add."', 1)");

if($qry)
{
	header('Location:view_areaeng.php');
}
else
echo "Error Creating Area Engineer";
}

?>
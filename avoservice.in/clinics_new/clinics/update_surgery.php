<?php
include 'config.php';

$pid=$_POST['patient_id'];
//$cdate=$_POST['cdate'];
$an=$_POST['an'];
$type=$_POST['type'];

$hr=$_POST['hour'];
$min=$_POST['min'];
$time=$hr.":".$min;

$hr1=$_POST['hour1'];
$min1=$_POST['min1'];
$time1=$hr1.":".$min1;


$surgery=$_POST['surgery'];
$surgeon1=$_POST['surgeon1'];
$surgeon2=$_POST['surgeon2'];
$pro=$_POST['pro'];

$af1=$_POST['af1'];
$af2=$_POST['af2'];
$af3=$_POST['af3'];
$af4=$_POST['af4'];
$af5=$_POST['af5'];
$af6=$_POST['af6'];
$af7=$_POST['af7'];
$af8=$_POST['af8'];
$af9=$_POST['af9'];
$af10=$_POST['af10'];
$af11=$_POST['af11'];
$af12=$_POST['af12'];
$af13=$_POST['af13'];
$af14=$_POST['af14'];
$af15=$_POST['af15'];
$af16=$_POST['af16'];
$af17=$_POST['af17'];
$af18=$_POST['af18'];
$af19=$_POST['af19'];
$af20=$_POST['af20'];


$sql="update surgery set cdate=curdate(),anaesthetist='".$an."',type='".$type."',time_in='".$time."',time_out='".$time1."',surgery_head='".$surgery."',surgeon_1='".$surgeon1."',surgeon_2='".$surgeon2."',proc='".$pro."',ad_fees='".$af1."',pulse_charge='".$af2."',ot_inst='".$af3."',md='".$af4."',sur_charge='".$af5."',anae_charge='".$af6."',lith_charge='".$af7."',x_ray_charge='".$af8."',ecg_charge='".$af9."',path_charge='".$af10."',dress_charge='".$af11."',rn_charge='".$af12."',spl_charge='".$af13."',exp_charge='".$af14."',phy_charge='".$af15."',amb_charge='".$af16."',misc_charge='".$af17."',total='".$af18."',discount='".$af19."',grand_total='".$af20."'";


$result=mysqli_query($con,$sql);

if($result)
{
	
header("location: home.php");

}
else
echo "error Inserting data";

?>
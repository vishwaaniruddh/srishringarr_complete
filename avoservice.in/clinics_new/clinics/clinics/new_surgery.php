<?php
include('config.php');

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

/*$sql="insert into surgery (patient_id,anaesthetist,type,time_in,time_out,surgery_head,surgeon_1,surgeon_2,procedure) values('$pid','$an','$type','$time','$time1','$surgery','$surgeon1','$surgeon2','$pro')";
*/

$sql="insert into surgery (patient_id,cdate,anaesthetist,type,time_in,time_out,surgery_head,surgeon_1,surgeon_2,proc,ad_fees,pulse_charge,ot_inst,md,sur_charge,anae_charge,lith_charge,x_ray_charge,ecg_charge,path_charge,dress_charge,rn_charge,spl_charge,exp_charge,phy_charge,amb_charge,misc_charge,total,discount,grand_total)
 values('$pid',curdate(),'$an','$type','$time','$time1','$surgery','$surgeon1','$surgeon2','$pro','$af1','$af2','$af3','$af4','$af5','$af6','$af7','$af8','$af9','$af10','$af11','$af12','$af13','$af14','$af15','$af16','$af17','$af18','$af19','$af20')";

$result=mysql_query($sql);

if($result)
{
	
header("location: home.php");

}
else
echo "error Inserting data";

?>
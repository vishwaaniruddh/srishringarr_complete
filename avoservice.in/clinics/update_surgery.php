<?php
include('config.php');

$pid=$_POST['surgery_id'];
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






$sql="update surgery1 set sur_date=curdate(),anaesth='".$an."',anatype='".$type."',time_in='".$time."',time_out='".$time1."',doctor='".$surgeon1."',doctor1='".$surgeon2."',operation='".$pro."',room='".$af1."',pulse='".$af2."',otrent='".$af3."',	drugs='".$af4."',surgery='".$af5."',anaes='".$af6."',litho='".$af7."',xray='".$af8."',ecg='".$af9."',lab='".$af10."',dressing='".$af11."',nursing='".$af12."',instru='".$af13."',visit='".$af14."',physio='".$af15."',ambul='".$af16."',misc='".$af17."',details='".$af18."',discount='".$af19."',net='".$af20."' where s_real_id='".$pid."' ";


$result=mysql_query($sql);

if($result)
{
	
header("location:view_surgry.php");

}
else
echo "error Inserting data";

?>
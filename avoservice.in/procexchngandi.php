<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, Your session has Expired');window.location='index.php';</script>";
}
else
{
include("config.php");
$cdate=date('Y-m-d H:i:s');


//echo "select username from login where srno='".$_POST['logid']."'";

$log=mysqli_query($con1,"select username from login where srno='".$_POST['logid']."'");

$logro=mysqli_fetch_row($log);

$noti=mysqli_query($con1,"select * from area_engg where engg_id='".$_POST['oldid']."'");
$new=mysqli_fetch_row($noti);


$qry=mysqli_query($con1,"update notification_tble set `logid`='".$_POST['logid']."',`pid`='".$new[0]."',`name`='".$new[1]."',`email`='".$new[4]."',`username`='".$logro[0]."',`updt`='".$cdate."' where pid='".$_POST['eng']."'");
if($qry)
{
$db= mysqli_query($con1,"DELETE from notification_tble where pid='".$_POST['eng']."'");

$up=mysqli_query($con1,"INSERT INTO `andiexchangeby` (`id`, `fromip`, `userid`, `fromeng`, `toeng`, `rem`, `status`) VALUES (NULL, '".$_SERVER['REMOTE_ADDR']."','".$_SESSION['user']."', '".$_POST['eng']."', '".$new[0]."','', '0')");

echo "<script type='text/javascript'>alert('updated Successfully'); window.location='view_areaeng.php'</script>";
}
else
{
echo "<script type='text/javascript'>alert('Some Error Occurred'); window.location='view_areaeng.php'</script>";
}
}

?>
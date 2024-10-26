<?php
session_start();
if(!isset($_SESSION['user']))
header('location:index.php');
else
{
include("config.php");
if(isset($_POST['cmdsub']))
{
$alertid=$_POST['alert'];
$updt=date('Y-m-d H:i:s');
$srn=mysqli_query($con1,"select srno,designation from login where username='".$_SESSION['user']."'");
$srno=mysqli_fetch_row($srn);
$alert=mysqli_query($con1,"select serviceid from pmalert where alert_id='".$alertid."'");
$alertro=mysqli_fetch_row($alert);
$pmdel=mysqli_query($con1,"select engineer from pmdelegation where alert_id='".$alertid."' order by id DESC limit 1");
$pmro=mysqli_fetch_row($pmdel);
if($srno[1]=='4')
{
$sttt=" status='Done',close_date='".$updt."'";
}
else
{
$feed=str_replace("'","\'",$_POST['feed']);

$sttt=" call_status='Done',close_date='".$updt."',caller_name='".$_POST['availperson']."'";
$sql="update servicemonth set description='".$feed."',availperson='".$_POST['availperson']."',serviceby='".$pmro[0]."',status='1' where id='".$alertro[0]."'";
}



$up=mysqli_query($con1,"INSERT INTO `pmfeedback`(`alert_id`, `engineer`, `feedback`, `feed_date`) values('".$alertid."','".$_POST['eng_id']."','".$feed."','".$updt."')");
$pmid=mysqli_insert_id();
if($up)
{


for($i=0;$i<$_POST['pmcnt'];$i++)
{
if(isset($_POST['asst'][$i]))
{
$rem2=str_replace("'","\'",$_POST['rem'][$i]);
$up2=mysqli_query($con1,"INSERT INTO `pmastrep`(`alertid`, `pmastid`, `asset`, `capacity`, `company`, `qty`, `rem`) VALUES('".$alertid."','".$pmid."','".$_POST['asst'][$i]."','".$_POST['spec'][$i]."','".$_POST['cap'][$i]."','".$_POST['quan'][$i]."','".$rem2."')");
}
}
$up3=mysqli_query($con1,"update pmalert set ".$sttt." where alert_id='".$alertid."'");
if($_POST['ctype']=='')
header('location:engpmalert.php');
else
{
echo "<h2>Updated Successfully</h2>";
}
}
else
echo "<h2>Error: ".mysqli_error()."</h2>";
}
else
{
session_destroy();
header('location:index.php');
}
}
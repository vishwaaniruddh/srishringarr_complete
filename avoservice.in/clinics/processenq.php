<?php
session_start();
include("config.php");
$year=$_POST['year'];
$month=$_POST['month'];
$day=$_POST['day'];
$dob=$year."-".$month."-".$day;
//echo "select max(id) from `enquiryperson` where center='".$_POST['center']."'";
$sq=mysql_query("select max(id) from `enquiryperson` where center='".$_POST['center']."'");
$max=mysql_fetch_row($sq);
//echo $max[0];
$newpatid=$max[0]+1;
$ini=substr($_POST['center'],0,1);
 $newsrno="E".$ini."-".$newpatid;

$qry=mysql_query("INSERT INTO `enquiryperson` (`id`, `name`, `dob`, `gender`, `remarks`, `reference`, `city`, `address1`, `center`, `phone1`,  `mobile`, `mobile2`, `email`, `trackid`, `entrydt`, `addedby`, `status`) VALUES ('".$newpatid."', '".$_POST['name']."', '".$dob."', '".$_POST['gen']."', '".$_POST['rem']."', '".$_POST['ref']."', '".$_POST['city']."', '".$_POST['add']."', '".$_POST['center']."', '".$_POST['cn12']."', '".$_POST['cn22']."', '".$_POST['mob2']."', '".$_POST['email1']."', '".$newsrno."', Now(), '".$_SESSION['SESS_USER_NAME']."', '0')");
if(!$qry)
echo "qry".mysql_error();
$res=mysql_query("INSERT INTO `enquirystatus` (`id`, `feedback`, `entrydt`, `enteredby`,`nextcall`, `status`,`perid`) VALUES (NULL, '".$_POST['rem']."', Now(), '".$_SESSION['SESS_USER_NAME']."',STR_TO_DATE('".$_POST['nxtdate']."','%d/%m/%Y'), '0','".$newsrno."')");
if(!$res)
echo "<br>res".mysql_error();
if($qry && $res)
{
$_SESSION['success']='Successfully Entered';
header('location:newenquiry.php');
}
else
{
$_SESSION['fail']='Some Error Occurred'.mysql_error();
header('location:newenquiry.php');
}
?>
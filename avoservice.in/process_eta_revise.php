<?php
session_start();

include('access.php');
include("config.php");

$id=$_POST['id'];
$eng_id=$_POST['eng_id'];
$br2=array();
$br=$_POST['br'];
$up_revise=$_POST['up_revise'];

$cdate = date('Y-m-d H:i:s');
$calltype=$_POST['callclose'];
$ctype=$_POST['ctype'];
$etadate=$_POST['etadt'];
$asstid=$_POST['astid'];
$asstname=$_POST['astname'];
$etdt="0000-00-00 00:00:00";


 //=======================REVISE ETA SET HERE=======================
 if(isset($_POST['est']) && $_POST['est']!='' && isset($_POST['time']) && $_POST['time']!='' && isset($_POST['minute']) && $_POST['minute']!=''){
  $tm=$_POST['time']; //==For Hour 
  //echo "date of e eta=" .$_POST['est']. "<br>";
 $minute=$_POST['minute']; //==For Min
 
 if($_POST['meri']=='pm')
 $tm=(12+$_POST['time']);
 //echo $tm;
 $edit_eta=date("Y-m-d $tm:$minute",strtotime(str_replace("/","-",$_POST['est'])));
 //echo "<br>Revise ETA= ".$edit_eta."<br>";
 }
 
 //===----------select data from alert table------------=======
$qryal=mysqli_query($con1,"Select call_status,responsetime,createdby,state1,assetstatus,atm_id,cust_id,bank_name from alert where alert_id='".$id."'");
$resal=mysqli_fetch_row($qryal);
if($resal[4]=='site')
$sitestr="select atm_id from atm where track_id='".$resal[5]."'";
if($resal[4]=='amc')
$sitestr="select atmid from Amc where amcid='".$resal[5]."'";

$pendate = date('Y-m-d H:i:s');

	$alertp=mysqli_query($con1,"INSERT INTO `alert_progress`(`alert_id`,  `alert_type`, `revise_eta`, `engg_id`, `cust_id`, `revise_update`) VALUES ('".$id."','".$ctype."','".$edit_eta."','".$eng_id."','".$resal[6]."','".$up_revise."')");

	
	//====update REVISE ETA ===========
	$sql=mysqli_query($con1,"select `update_status` from alert where alert_id='".$id."'");
	$restul=mysqli_fetch_row($sql);
	if($restul[0]=='0'){
	//echo "<br>Update alert set `eta`='".$edit_eta."' where alert_id='".$id."'"; 
	$qryrtime=mysqli_query($con1,"Update alert set `eta`='".$edit_eta."' where alert_id='".$id."'");
	}

	if($_SESSION['designation']=='2')
          header('Location:success.php?success=You have successfully updated ');
         else
          header('Location:success.php?success=You have successfully updated');

?>
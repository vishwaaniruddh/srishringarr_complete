<?php
include("db_conn.php");
//include_once 'GCM.php';

$um=$_POST['um'];//Model Problem Type added by vishnu

$alertid=$_POST['alertid'];
$alert = $alertid;
$ucap=$_POST['ucap'];
$eng_id=$_POST['engid'];

$qryx=mysqli_query($conapp,"select engineer from alert_delegation where alert_id='".$alert."' order by id desc");
$rowx=mysqli_fetch_row($qryx);
//$engqry=mysqli_query($conapp,"select engg_name,area,engg_id from area_engg where loginid='".$eng_id."'");

$engqry=mysqli_query($conapp,"select loginid from area_engg where engg_id='".$rowx[0]."'");

$engqryro=mysqli_fetch_row($engqry);
$login_id=$engqryro[0];

//echo json_encode($login_id);


$lat='';
$lng='';
$bat_specs='';
if(isset($_POST['uqty']))
$uqty=$_POST['uqty'];
if($uqty==''){ $uqty=0;}

if(isset($_POST['bm']))
$bat_specs.=$_POST['bm'].",";

if(isset($_POST['bv']))
$bat_specs.=$_POST['bv'].",";

if(isset($_POST['bah']))
$bat_specs.=$_POST['bah'];
if($bat_specs==''){ $bat_specs='NULL';}

if(isset($_POST['bn']))
$bn=$_POST['bn'];
else
$bn=0;

if(isset($_POST['iln']))
$iln=$_POST['iln'];
else
$iln=0;

if(isset($_POST['ile']))
$ile=$_POST['ile'];
else
$ile=0;
//$close='';
//$std=urldecode($_POST['standby']);
$ine=$_POST['ine']; if($ine==''){$ine='0';}
$oln=$_POST['oln']; if($oln==''){$oln='0';}

$ole=$_POST['ole'];  if($ole==''){$ole='0';}
$one=$_POST['one']; if($one==''){$one='0';}
$usn=$_POST['usn']; if($usn==''){$usn='NULL';}
$cv=$_POST['cv']; if($cv==''){$cv='0';}
$ccn=$_POST['ccn']; if($ccn==''){$ccn='0';}
//========= battery report
$bsn1=$_POST['bsn1']; if($bsn1==''){$bsn1='NULL';}
$bsn2=$_POST['bsn2']; if($bsn2==''){$bsn2='NULL';}
$bsn3=$_POST['bsn3']; if($bsn3==''){$bsn3='NULL';}
$bsn4=$_POST['bsn4']; if($bsn4==''){$bsn4='NULL';}
$bsn5=$_POST['bsn5']; if($bsn5==''){$bsn5='NULL';}
$bsn6=$_POST['bsn6']; if($bsn6==''){$bsn6='NULL';}
$bsn7=$_POST['bsn7']; if($bsn7==''){$bsn7='NULL';}
$bsn8=$_POST['bsn8']; if($bsn8==''){$bsn8='NULL';}
$wm1=$_POST['wm1'];   if($wm1==''){$wm1='0';}
$wm2=$_POST['wm2']; if($wm2==''){$wm2='0';}
$wm3=$_POST['wm3']; if($wm3==''){$wm3='0';}
$wm4=$_POST['wm4']; if($wm4==''){$wm4='0';}
$wm5=$_POST['wm5']; if($wm5==''){$wm5='0';}
$wm6=$_POST['wm6']; if($wm6==''){$wm6='0';}
$wm7=$_POST['wm7']; if($wm7==''){$wm7='0';}
$wm8=$_POST['wm8']; if($wm8==''){$wm8='0';}
$bm1=$_POST['bm1']; if($bm1==''){$bm1='0';}
$bm2=$_POST['bm2']; if($bm2==''){$bm2='0';}
$bm3=$_POST['bm3']; if($bm3==''){$bm3='0';}
$bm4=$_POST['bm4']; if($bm4==''){$bm4='0';}
$bm5=$_POST['bm5']; if($bm5==''){$bm5='0';}
$bm6=$_POST['bm6']; if($bm6==''){$bm6='0';}
$bm7=$_POST['bm7']; if($bm7==''){$bm7='0';}
$bm8=$_POST['bm8']; if($bm8==''){$bm8='0';}
$signedby=$_POST['signedby']; if($signedby==''){$signedby='NULL';}
$mobileno=$_POST['mobileno']; if($mobileno==''){$mobileno='NULL';}

$tesqry = "Insert into FSR_details(`alertid`,`enggid`,`upsmodel`,`upscapacity`,`upsqty`,`upssn`,`batteryspecs`,`nob`,`prod_name`,`i_ln`,`i_le`,`i_ne`,`o_ln`,`o_le`,`o_ne`,`voltage`,`current`,`signed_by`,`mobile`) Values('".$alertid."','".$eng_id."','".$um."','".$ucap."','".$uqty."','".$usn."','".$bat_specs."','".$bn."','UPS','".$iln."','".$ile."','".$ine."','".$oln."','".$ole."','".$one."','".$cv."','".$ccn."','".$signedby."','".$mobileno."')"; 

$sql=mysqli_query($conapp,"Insert into FSR_details(`alertid`,`enggid`,`upsmodel`,`upscapacity`,`upsqty`,`upssn`,`batteryspecs`,`nob`,`prod_name`,`i_ln`,`i_le`,`i_ne`,`o_ln`,`o_le`,`o_ne`,`voltage`,`current`,`signed_by`,`mobile`) Values('".$alertid."','".$eng_id."','".$um."','".$ucap."','".$uqty."','".$usn."','".$bat_specs."','".$bn."','UPS','".$iln."','".$ile."','".$ine."','".$oln."','".$ole."','".$one."','".$cv."','".$ccn."','".$signedby."','".$mobileno."')");

mysqli_query($conapp,"Insert into battery_report(`alertid`,`bsn1`,`bsn2`,`bsn3`,`bsn4`,`bsn5`,`bsn6`,`bsn7`,`bsn8`,`wm1`,`wm2`,`wm3`,`wm4`,`wm5`,`wm6`,`wm7`,`wm8`,`bm1`,`bm2`,`bm3`,`bm4`,`bm5`,`bm6`,`bm7`,`bm8`) Values('".$alertid."','".$bsn1."','".$bsn2."','".$bsn3."','".$bsn4."','".$bsn5."','".$bsn6."','".$bsn7."','".$bsn8."','".$wm1."','".$wm2."','".$wm3."','".$wm4."','".$wm5."','".$wm6."','".$wm7."','".$wm8."','".$bm1."','".$bm2."','".$bm3."','".$bm4."','".$bm5."','".$bm6."','".$bm7."','".$bm8."')");

if($sql){

$str='1';
}
else
$str='0';
echo json_encode($str);
?>
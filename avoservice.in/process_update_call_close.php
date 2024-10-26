<?php
//session_start();
include('access.php');
include("config.php");
$id=$_POST['id'];
//echo "id=".$id."<br>";
$up=$_POST['up'];
$eng_id=$_POST['eng_id'];
$calltype=$_POST['ctype'];
//echo "calltype=".$calltype;
$cdate = date('Y-m-d H:i:s.a',strtotime(str_replace('/','-',$_REQUEST['cdate'])));
//echo "<br>". $cdate;
$asst=$_POST['asst'];
//print_r($asst);
$spec=$_POST['spec'];
$cap=$_POST['cap'];
$quan=$_POST['quan'];
$rem=$_POST['rem'];
//=======RESPONSE TIME FROM ENGG SET HERE=================
$cdate=$_POST['cdate']; //==Date
$close_hr=$_POST['close_hr']; //==Hour
$close_min=$_POST['close_min']; //==Min
if($_POST['close_meri']=='pm') //==Meridian
$close_hr=(12+$_POST['close_hr']);
$allclosedate=date("Y-m-d $close_hr:$close_min",strtotime(str_replace('/','-',$cdate)));
//echo "<br> Close TIME= ".$allclosedate."<br>";
//=============================================CALL TYPE STATUS ================
if(isset($calltype) && $calltype=='close' && $allclosedate != "0000-00-00 12:00") {	
	$updt=mysqli_query($con1,"Update tempclosedcall set status='1' where alert_id='".$id."'");
	$status="call_status='Done',close_date='".$allclosedate."'";
	//echo $status;
//=================================Insert int corection_assets Table =============
for($j=0;$j<count($asst);$j++){
	$cor_assets=mysqli_query($con1,"INSERT INTO `corection_assets`(`alert_id`,`ass_name`, `capacity`, `qty`,`company`,`remark`) VALUES('".$id."','".$asst[$j]."','".$spec[$j]."','".$quan[$j]."','".$cap[$j]."','".$rem[$j]."')");
}
//============================ Query For Updating site_assets (SITE  AND  AMC) ASSETS TYPE ========================== 
$atm_id=mysqli_query($con1,"select `atm_id`,`assetstatus` from `alert` where `alert_id`='".$id."'");
$atm_id1=mysqli_fetch_row($atm_id);
//echo $atm_id1[1];
if(strcasecmp($atm_id1[1],"site")==0){
	//================================For  site =================
	for($a=0;$a<count($asst);$a++){
		$strnew = preg_replace('/\D/', '', $spec[$a]);
		//echo "<br>update `site_assets` set  `assets_spec`='".$strnew."', `quantity`='".$quan[$a]."'  where `atmid`='".$atm_id1[0]."' and `assets_name`='".$asst[$a]."' ";
	$update_assets=mysqli_query($con1,"update `site_assets` set  `assets_spec`='".$strnew."', `quantity`='".$quan[$a]."'  where `atmid`='".$atm_id1[0]."' and`assets_name`='".$asst[$a]."' ");
	}
	
}else{
	//================================For amc  =================
	for($a=0;$a<count($asst);$a++){
		$strnew = preg_replace('/\D/', '', $spec[$a]);
		$ass_id=mysqli_query($con1,"select `ass_spc_id` from `assets_specification` where `name`= '".$spec[$a]."'");
		$ass_id1=mysqli_fetch_row($ass_id);		
	//echo "<br>update `amcassets` set  `assetspecid`='".$ass_id1[0]."', `quantity`='".$quan[$a]."'  where `siteid`='".$atm_id1[0]."' and `assets_name`='".$asst[$a]."' ";
	$update_amcasset=mysqli_query($con1,"update `amcassets` set  `assetspecid`='".$ass_id1[0]."', `quantity`='".$quan[$a]."'  where `siteid`='".$atm_id1[0]."' and`assets_name`='".$asst[$a]."' ");
	}		
}
//====insert into eschis==========	
	$esc=mysqli_query($con1,"INSERT INTO `eschis` (`id`, `alertid`, `startdt`, `endtime`, `escalateto`, `type`, `level`, `status`) select `id`, `alertid`, `startdt`, `endtime`, `escalateto`, `type`, `level`, `status` from escalation where alertid='".$id."')");
	if($esc)
	$del=mysqli_query($con1,"Delete from escalation where alertid='".$id."'");	
	}else{
		//echo "Data is not submited successfully  please go back and try again.";
		//header('Location:success_close.php?unsuccess=Data is not submited successfully  please go back and try again.');		
		}

//===wait or standby close============
if(isset($calltype) && $calltype=='wait'){
	$status="call_status='2',standby='Y'";
	}
//echo "<br>Update alert set $status where alert_id='".$id."'<br>";
$upalert=mysqli_query($con1,"Update alert set $status where alert_id='".$id."'");	
//=============================================CALL TYPE STATUS END HERE ================	
		if($_SESSION['designation']=='2')
          header('Location:success_close.php?success=You have successfully Closed Call');
         else
          header('Location:success_close.php?success=You have successfully Closed Call');

?>
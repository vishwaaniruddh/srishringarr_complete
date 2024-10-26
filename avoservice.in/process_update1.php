<?php
session_start();

include('access.php');
include("config.php");

$id=$_POST['id'];
$eng_id=$_POST['eng_id'];

$qryeng=mysqli_query($con1,"Select loginid from area_engg where engg_id='".$eng_id."'");
$reng=mysqli_fetch_row($qryeng);
$logid=$reng[0];
$br2=array();
$br=$_POST['br'];
$update=mysqli_real_escape_string($con1,$_POST['up']);
$reviup=mysqli_real_escape_string($con1, $_POST['reviup']);
$cdate = date('Y-m-d H:i:s');
$calltype=$_POST['callclose'];
$ctype=$_POST['ctype'];
$etadate=$_POST['etadt'];
$asstid=$_POST['astid'];
$asstname=$_POST['astname'];
$etdt="0000-00-00 00:00:00";
//============Feedback update=========
$log=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");
$logro=mysqli_fetch_row($log);
$br3=$_SESSION['branch'];

 if($calltype=='wait')
 $stdb='Y';
 else
 $stdb='N';

$query9=mysqli_query($con1,"Insert into alert_updates(`alert_id`,`up`,`update_time`,`branch`,`user`) Values('".$id."','".$update."','".$cdate."','".$br3."','".$_SESSION['user']."')");	

$query10=mysqli_query($con1,"Insert into eng_feedback(`alert_id`,`feedback`,`feed_date`,`engineer`,`standby`) Values('".$id."','".$update."','".$cdate."','".$logro[0]."','".$stdb."')");

//--------Reach & Left

if(isset($_POST['rest']) && $_POST['rest']!='' && isset($_POST['eng_reach_time']) && $_POST['eng_reach_time']!='' && isset($_POST['rminute']) && $_POST['rminute']!=''){	
	$res_date=$_POST['rest']; //==Date
	$res_time=$_POST['eng_reach_time']; //==Hour
	$res_min=$_POST['rminute']; //==Min
	
	if($_POST['rmeri']=='pm' && $_POST['eng_reach_time'] !=12 ) //==Meridian
	$res_time=(12+$_POST['eng_reach_time']);
	
	$responseall=date("Y-m-d $res_time:$res_min",strtotime(str_replace('/','-',$res_date)));

	} else { 
	  $qry_alert=mysqli_query($con1,"Select responsetime from alert where alert_id='".$id."'");
$resp_qry=mysqli_fetch_row($qry_alert);
$responseall=$resp_qry[0];
}
	
//=======================Eng Left Site HERE=======================
 if(isset($_POST['left_est']) && $_POST['left_est']!='' && isset($_POST['eng_left_time']) && $_POST['eng_left_time']!='' && isset($_POST['left_min']) && $_POST['left_min']!=''){
				
  $tm=$_POST['eng_left_time']; //==For Hour 
  //echo "date of e eta=" .$_POST['est']. "<br>";
 $minute=$_POST['left_min']; //==For Min
 
 if($_POST['left_meri']=='pm')
 $tm=(12+$_POST['eng_left_time']);
 //echo $tm;
 $left_eta=date("Y-m-d $tm:$minute",strtotime(str_replace("/","-",$_POST['left_est'])));

 }

$left=strtotime($left_eta);
$reach=strtotime($responseall); 

if(isset($_POST['reach_site']) && $_POST['reach_site']!='') {

$query5=mysqli_query($con1,"Update `alert` set `update_status`='1', responsetime='".$responseall."' where `alert_id`='".$id."'");	
$query1=mysqli_query($con1,"INSERT INTO `alert_progress`(`alert_id`, `responsetime`, `alert_type`, `engg_id`, `pending_date`) VALUES ('".$id."','".$responseall."','".$ctype."', '".$logid."','".$cdate."')");
}

if(isset($_POST['left_site']) && $_POST['left_site']!='') {
    
if($left < $reach){ 
?>
 
<script type="text/javascript">
alert("Reached at Site Time Higher than left site time");
window.close();
</script>

  <?} elseif($reach ==0){ ?>
<script type="text/javascript">
alert("You have to Update First Reached at site");
window.close();
</script>
<? } else {


$quqry=mysqli_query($con1,"INSERT INTO `alert_progress`(`alert_id`,  `alert_type`, `eng_left_site`, `engg_id`, `pending_date`) VALUES ('".$id."','".$ctype."','".$left_eta."','".$logid."','".$cdate."')");

if($calltype=='close') {
 echo "Update `alert` set call_status='Done',close_date='".$cdate."' where `alert_id`='".$id."'";   
 $query5=mysqli_query($con1,"Update `alert` set call_status='Done',close_date='".$cdate."' where `alert_id`='".$id."'");
if($ctype=='new')
         {
          $st=date("Y-m-d");
$qry66=mysqli_query($con1,"select site_ass_id, valid,start_date, assets_name  from site_assets where alert_id='".$id."'");
  
 while($fetch=mysqli_fetch_row($qry66)) {

$deldate = $fetch[2];
$final = date("Y-m-d", strtotime("+3 months $deldate"));

if($st > $final){ $st= $final; }

  $d12=explode(",",$fetch[1]);
  $expdt1=date('Y-m-d', strtotime("+$d12[0] months $st"));    

  $updt=mysqli_query($con1,"update site_assets set start_date='".$st."', exp_date='".$expdt1."' where site_ass_id='".$fetch[0]."'");
  
  if($fetch[3]=='UPS'){
   $updt=mysqli_query($con1,"update atm set start_date='".$st."',expdt='".$expdt1."' where track_id='".$resal[5]."'");   
  }
 }
} 
    
} elseif($calltype=='wait') {
$query5=mysqli_query($con1,"Update `alert` set call_status='Done',standby='Y' where `alert_id`='".$id."'");

} elseif ($calltype =='pending') {

$status="`pending_update`='1',`status_left_site`='1', `update_status`='0'";
$query5=mysqli_query($con1,"Update alert set $status and  `eng_left_site`='".$left_eta."' where alert_id='".$id."'");	
	}

$prob=array();
if(isset($_POST['prob']))
{
for($i=0;$i<count($_POST['prob']);$i++)
	{

	$qryprob=mysqli_query($con1,"Select * from siteproblem where alertid='".$id."' and probid='".$_POST['prob'][$i]."'");
	
	$probqry=mysqli_query($con1,"Select * from problemtype where probid='".$id."'");
	$protype=mysqli_fetch_row($probqry);
	
			if(mysqli_num_rows($qryprob)>0)
			{
			}
			else
			{
	$query8=mysqli_query($con1,"Insert into siteproblem(alertid,probid,problemtype) Values('".$id."','".$_POST['prob'][$i]."','".$protype[1]."')");
			}
		}
}		

}
}
if($query10){
?>	
<script type="text/javascript">
alert("Updated Successfully");
window.close();
</script>
<? } else if($query5){ ?>
<script type="text/javascript">
alert("Call Status Updated Successfully");
window.close();
</script>

<? } else { ?>
<script type="text/javascript">
alert("Something Wrong");
window.close();
</script>

<? } ?>

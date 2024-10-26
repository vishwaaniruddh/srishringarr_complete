<?php
session_start();
include("access.php");
//include("Whatsapp_delegation/delegation_fun.php");
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation']." ".$_SESSION['logid'];

$created=$_SESSION['logid'];

$user=$_SESSION['user'];

if(isset($_POST['delegate']))
{
	$req=$_POST['req'];
 //	$engnew=$_POST['engnew'];
 	$eng1=$_POST['engnew'];
 
 $engdet=explode(',',$eng1);
 $engnew=$engdet[0];
 $dis=$engdet[1];
 	
 	$engold=$_POST['engold'];
	$atm='';

  	$reason=$_POST['resonrel'];
	$message2="";
	


include('config.php');
$etdt="0000-00-00 00:00:00";

$pendate = date('Y-m-d H:i:s');

//echo strtotime(str_replace("/","-",$_POST['est']));
 //$_POST['time'] $_POST['meri']
 if(isset($_POST['est']) && $_POST['est']!='' && isset($_POST['time']) && $_POST['time']!=''){
 $tm=$_POST['time'].":00:00";
 if($_POST['meri']=='pm')
 $tm=(12+$_POST['time']).":00:00";
 //echo $tm;
 $etdt=date("Y-m-d $tm",strtotime(str_replace("/","-",$_POST['est'])));
 }
$seldel= mysqli_query($con1,"Select * from alert_delegation where alert_id='".$req."'");
$olddel=mysqli_fetch_row($seldel);

$tab2=mysqli_query($con1,"Insert into alert_redelegation(eng_old,eng_new,reason,atm,alert_id,createdby,created_at)Values('".$engold."','".$engnew."','".$reason."','".$atm."','".$req."','".$created."','".$pendate."')");


if($tab2){
$tab=mysqli_query($con1,"update alert_delegation set engineer='".$engnew."',atm='".$atm."' where alert_id='".$req."'");

$alrt=mysqli_query($con1,"update alert set convert_into='".$dis."' where alert_id='".$req."'");
$upt=mysqli_query($con1,"insert into eng_feedback set alert_id='$req',feedback='redelegate', engineer ='".$created."', feed_date='".$pendate."'" );

//$tb=mysqli_query($con1,"INSERT INTO `alert_progress`(`alert_id`, `revise_eta`, `engg_id`,`cust_id`,`alert_type`,`pending_date`) VALUES ('".$req."','".$etdt."','".$engnew."','".$alertdata1[0]."','".$alertdata1[1]."','".$pendate."')");
}
//=======================Mailing part Start =========================	
if($tab){
   
 
?>
<script type="text/javascript">
alert("Redelegated successfully");
window.location='view_alert.php';
</script>
<?php

	//header('Location:view_alert.php');
}
else
echo "Error Creating Delegation";
}

?>
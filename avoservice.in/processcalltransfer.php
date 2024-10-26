<?php
if(isset($_POST['cmdsub']))
{
if(isset($_POST['state'])&& $_POST['state']!='0'){
	
	include("access.php");
	include("config.php");
	$state=$_POST['state'];
	//echo "state=".$state;
	$br=$_POST['br'];
	
	//echo "select `branch_id` from `state` where `state_id`='".$state."' <br>";
	//$branch=mysqli_query($con1,"select `branch_id`,`state` from `state` where `state_id`='".$state."' ");
	//$branch1=mysqli_fetch_row($branch);
	//echo "brid=".$branch1[0];
	
	//echo "select name from `avo_branch` where id='".$branch1[0]."' <br>";
	$br_new=mysqli_query($con1,"select name from `avo_branch` where id='".$state."' ");
	$br_new1=mysqli_fetch_row($br_new);
	
	$alertid=$_POST['alertid'];
	$cmnt=str_replace("'","\'",$_POST['frmcmnt']);
	
	//echo "INSERT INTO `transfersites` (`id`, `frombranch`, `tobranch`, `alertid`, `approval`, `frmdesc`, `todesc`, `status`,`date`) VALUES (NULL, '".$br."', '".$br_new1[0]."', '".$alertid."', '0', '".$cmnt."', '', '0','".date('Y-m-d h:i:s')."')<br>";
	
	
	//old query
	//$qry=mysqli_query($con1,"INSERT INTO `transfersites` (`id`, `frombranch`, `tobranch`, `alertid`, `approval`, `frmdesc`, `todesc`, `status`,`date`,`state`) VALUES (NULL, '".$br."', '".$state."', '".$alertid."', '0', '".$cmnt."', '', '0','".date('Y-m-d h:i:s')."','".$br_new1[0]."')");
	
	// direct transfer (new query)
	$qry=mysqli_query($con1,"INSERT INTO `transfersites` (`id`, `frombranch`, `tobranch`, `alertid`, `approval`, `frmdesc`, `todesc`, `status`,`date`,`state`) VALUES (NULL, '".$br."', '".$state."', '".$alertid."', 'approve', '".$cmnt."', '', '0','".date('Y-m-d h:i:s')."','".$br_new1[0]."')");
	
	//$qry=mysqli_query($con1,"INSERT INTO `transfersites` (`id`, `frombranch`, `tobranch`, `alertid`, `approval`, `frmdesc`, `todesc`, `status`,`date`,`state`) VALUES (NULL, '".$br."', '".$state."', '".$alertid."', '0', '".$cmnt."', '', 'approve','".date('Y-m-d h:i:s')."','".$br_new1[0]."')");
	
	if($qry)
	{
	//old query
	//$update=mysqli_query($con1,"update alert set transapp='1' where alert_id='".$alertid."'");
	
	// direct transfer (new query)
	$update=mysqli_query($con1,"update alert set transapp='2',state1='".$br_new1[0]."',branch_id='".$state."' where alert_id='".$alertid."'");
	
	$alert=mysqli_query($con1,"select atm_id,assetstatus from alert where alert_id='".$alertid."'");
        $alertro=mysqli_fetch_row($alert);
	
	if($alertro[1]=='site')
 { //update branch in table atm
 mysqli_query($con1,"Update atm set branch_id='".$state."' where track_id='".$alertro[0]."'");
 }
 elseif($alertro[1]=='amc')
 { //update branch in table amc
 mysqli_query($con1,"Update Amc set branch='".$state."' where amcid='".$alertro[0]."'");
 }
	
	
	//==============================transfer automatically
	//$alert=mysqli_query($con1,"select * from alert where alert_id=(select alertid from transfersites where id='".$id."')");
 //$alertro=mysqli_fetch_row($alert);
 //$trans=mysqli_query($con1,"select * from transfersites where id='".$id."'");
 //$trrow=mysqli_fetch_row($trans);
 
	
	
	//==========================================================
	?>
	<script type="text/javascript">
	alert("Alert transferred successfully");
	window.location='view_alert.php';
	</script>
	<?php
	}
}
else
header('location:view_alert.php');
}
else
header('location:view_alert.php');
?>
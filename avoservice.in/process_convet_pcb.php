<?php 
include("config.php");
$alert_id=$_POST['alertid'];
$reason=$_POST['reason'];
$convert=$_POST['convert'];
//echo $alert_id;
//echo "update alert set `convert_into`='".$convert."',`convert_update`='".$reason."' where `alert_id`='".$alert_id."'";
//$result=mysqli_query($con1,"update alert set `convert_into`='".$convert."',`convert_update`='".$reason."' where `alert_id`='".$alert_id."'");
$result=mysqli_query($con1,"update alert set `alert_type`='service', `convert_update`='".$reason."' where `alert_id`='".$alert_id."'");

if($result){ ?>
	<script type="text/javascript">
	alert("Alert type Converted successfully");
	window.location='view_alert.php';
	</script>
<?php 
}

?>
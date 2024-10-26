<?php
include("access.php");
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

if(isset($_POST['delegate']))
{
$req=$_POST['req'];
 $engnew=$_POST['engnew'];
 $engold=$_POST['engold'];
$br=$_POST['br'];
  $reason=$_POST['resonrel'];
//$message2="";


include('config.php');
$etdt="0000-00-00 00:00:00";
//echo strtotime(str_replace("/","-",$_POST['est']));
 //$_POST['time'] $_POST['meri']
 if(isset($_POST['est']) && $_POST['est']!='' && isset($_POST['time']) && $_POST['time']!=''){
 $tm=$_POST['time'].":00:00";
 if($_POST['meri']=='pm')
 $tm=(12+$_POST['time']).":00:00";
 //echo $tm;
 $etdt=date("Y-m-d $tm",strtotime(str_replace("/","-",$_POST['est'])));
 }
/*echo "update alert set status='Delegated' where alert_id='$req'";
echo "Insert into alert_redelegation(eng_old,eng_new,reason,atm,alert_id,created_at)Values('".$engold."','".$engnew."','".$reason."','".$atm."','".$req."',CURRENT_TIMESTAMP)";*/
//$tab=mysqli_query($con1,"update alert set status='Delegated' where alert_id='$req'");
//echo "update alert_delegationlocal set engineer='".$engnew."' where alert_id='".$req."'";
$tab=mysqli_query($con1,"update alert_delegationlocal set engineer='".$engnew."' where alert_id='".$req."'");
//echo "Insert into alert_redelegation_local(eng_old,eng_new,reason,alert_id,created_at)Values('".$engold."','".$engnew."','".$reason."','".$atm."','".$req."',CURRENT_TIMESTAMP)";
$tab2=mysqli_query($con1,"Insert into alert_redelegation_local(eng_old,eng_new,reason,alert_id,created_at)Values('".$engold."','".$engnew."','".$reason."','".$req."',CURRENT_TIMESTAMP)");
//echo "update alertlocal set eta='".$etdt."' where alert_id='$req'";
$tb=mysqli_query($con1,"update alertlocal set eta='".$etdt."' where alert_id='$req'");

$upstat=mysqli_query($con1,"update alert set update_status=0 where alert_id='".$req."'");

if(!$tab || !$tab2 || !$tb || !$upstat){
	echo mysqli_error();
}

/*$message2="You have  New Alerts";
//echo "Select loginid from area_engg where engg_id='".$engnew."'";	
$reslt=mysqli_query($con1,"Select loginid from area_engg where engg_id='".$engnew."'");
$max=mysqli_fetch_row($reslt);
$str=$max[0];
$str2=array();
//echo "Select gcm_regid from notification_tble where logid='".$str."' AND pid='".$engnew."' AND status='0'";
$qry1=mysqli_query($con1,"Select gcm_regid from notification_tble where logid='".$str."' AND pid='".$engnew."' AND status='0'");
while($max1=mysqli_fetch_row($qry1))
{
	$str2[]=$max1[0];

}



include_once 'andi/GCM.php';
 $gcm = new GCM();
    //$registatoin_ids = $str2;
    $message = array("alert" => $message2);

    $result = $gcm->send_notification($str2, $message);
    	
//echo "result ".$result;

if($tab && $tab2)
{
?>
<script type="text/javascript">
<?php
if($_SESSION['designation']=='2')
{
?>
window.location='view_callalert.php';
<?php
}
else
{
?>
window.location='view_alert.php';
<?php
}

?>
</script>
<?php
*/
//header('Location:view_alert.php');
header('Location:view_alertlocal.php');
}
?>
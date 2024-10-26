<?php
session_start();
include("access.php");

function extract_email_address($string) {
    foreach(preg_split('/\s/', $string) as $token) {
        $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        if ($email !== false) {
            $emails[] = "<".$email.">";
        }
    }
    return $emails;
}

$created=$_SESSION['logid'];

$user=$_SESSION['user'];

if(isset($_POST['delegate']))
{
	$req=$_POST['req'];
 
 	$engnew=$_POST['engnew'];
 
  	$engold=$_POST['engold'];
	$atm=$_POST['atm'];
	$br=$_POST['br'];
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
//echo "update alert_delegation set engineer='".$engnew."',atm='".$atm."', date='".$pendate."' where alert_id='".$req."'";

$tab=mysqli_query($concs,"update alert_delegation set engineer='".$engnew."',atm='".$atm."', date='".$pendate."' where alert_id='".$req."'");


if($tab){
$tab2=mysqli_query($concs,"Insert into alert_redelegation(eng_old,eng_new,reason,atm,alert_id,createdby,created_at)Values('".$engold."','".$engnew."','".$reason."','".$atm."','".$req."','".$created."',CURRENT_TIMESTAMP)");
}


$pendate = date('Y-m-d H:i:s');
$alertdata=mysqli_query($concs,"select `cust_id`,`alert_type` from `alert` where `alert_id`='".$req."'");
$alertdata1=mysqli_fetch_row($alertdata);
if($tab2){
$tb=mysqli_query($concs,"INSERT INTO `alert_progress`(`alert_id`, `revise_eta`, `engg_id`,`cust_id`,`alert_type`,`pending_date`) VALUES ('".$req."','".$etdt."','".$engnew."','".$alertdata1[0]."','".$alertdata1[1]."','".$pendate."')");
}

if($tab && $tab2 && $tb)
{
?>
<script type="text/javascript">
alert("Redelegated successfully");
window.location='view_alert.php';
</script>
<?php
}
else
echo "Error Creating Delegation";
}

?>
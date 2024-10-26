<?php
session_start();
include("access.php");
include("Whatsapp_delegation/delegation_fun.php");

//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

/*function extract_email_address($string) {
    foreach(preg_split('/\s/', $string) as $token) {
        $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        if ($email !== false) {
            $emails[] = "<".$email.">";
        }
    }
    return $emails;
}*/

if(isset($_POST['delegate']))
{
 $req=$_POST['req']; //-alert_id of alert table
 $eng1=$_POST['eng'];
 
 $engdet=explode(',',$eng1);
 $eng=$engdet[0];
 $dis=$engdet[1];
 
 $atm=$_POST['atm'];
 $br=$_POST['br'];
 $message2="";


include('config.php');
//======================For categery query update in atm table ===============================

$etdt="0000-00-00 00:00:00";
//echo strtotime(str_replace("/","-",$_POST['est']));
 //$_POST['time'] $_POST['meri']
 if(isset($_POST['est']) && $_POST['est']!='' && isset($_POST['time']) && $_POST['time']!=''){
 $tm=$_POST['time'].":".$_POST['min'].":00";
 if($_POST['meri']=='pm')
 $tm=(12+$_POST['time']).":".$_POST['min'].":00";
 //echo $tm;
 $etdt=date("Y-m-d $tm",strtotime(str_replace("/","-",$_POST['est'])));
 }




$cdate = date('Y-m-d H:i:s');

$checkqry=mysqli_query($con1,"Select * from alert_delegation where alert_id='$req'");
if(mysqli_num_rows($checkqry)>0){
 $olddel=mysqli_fetch_row($checkqry);
    $engold=$olddel[1];
   $created=$_SESSION['user'];
   
$tab2=mysqli_query($con1,"update alert_delegation set engineer='".$eng."', status=0, call_close_status=0, delby='".$_SESSION['user']."' where alert_id='$req' "); 

$redtab=mysqli_query($con1,"Insert into alert_redelegation(eng_old,eng_new,reason,atm,alert_id,createdby,created_at)Values('".$engold."','".$eng."','".$reason."','".$atm."','".$req."','".$created."','".$cdate."')");
} else {
$tab2=mysqli_query($con1,"Insert into alert_delegation(engineer,atm,alert_id,date,delby) Values('".$eng."','".$atm."','".$req."','".$cdate."','".$_SESSION['user']."')");
}

if($tab2){
$tab=mysqli_query($con1,"update alert set status='Delegated',call_status='1',eta='".$etdt."', convert_into='".$dis."' where alert_id='$req'");

$upt=mysqli_query($con1,"insert into eng_feedback set alert_id='$req',feedback='delegate', engineer ='".$created."', feed_date='".$cdate."'" );
?>
<script type="text/javascript">
alert("Delegated Successfully");
window.location='view_alert.php';


</script>
<?
}
else
echo "Error Creating Delegation";
}
?>
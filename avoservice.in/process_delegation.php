<?php
include("access.php");
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

if(isset($_POST['delegate']))
{
 $req=$_POST['req'];
 $eng=$_POST['eng'];
 $atm=$_POST['atm'];
 $br=$_POST['br'];



include('config.php');
$cdate=date('Y-m-d H:i:s');
$tab=mysqli_query($con1,"update alert set status='Delegated' where alert_id='$req'");
$tab2=mysqli_query($con1,"Insert into alert_delegation(engineer,atm,alert_id,`date`) Values('".$eng."','".$atm."','".$req."','".$cdate."')");
include_once('class_files/update.php');

if($tab && $tab2)
{
if($_SESSION['designation']=='2')
header('Location:view_callalert.php');
else
header('Location:view_alert.php');
}
else
echo "Error Creating Delegation";
}
?>
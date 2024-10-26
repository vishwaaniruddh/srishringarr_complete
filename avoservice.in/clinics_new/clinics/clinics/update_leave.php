<?php 
include('config.php');

$id=$_POST['id'];

$frmdate=$_POST['frmdate'];
$todate=$_POST['todate'];
$name=$_POST['name'];
$remarks=$_POST['remarks'];



$sql="update leave_report set frmdate=STR_TO_DATE('".$frmdate."','%d/%m/%Y'),todate=STR_TO_DATE('".$todate."','%d/%m/%Y'),name ='".$name."',remarks ='".$remarks."' where leave_id='".$id."'";

$result=mysql_query($sql);
if($result)
{

header("location: home.php");

}
else
echo "error Inserting data";
?>
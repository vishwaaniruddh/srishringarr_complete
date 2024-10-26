<?php 
include('config.php');

$id=$_POST['id'];

$frmdate=$_POST['frmdate'];
$todate=$_POST['todate'];
$name=$_POST['name'];
$remarks=$_POST['remarks'];



$sql="update `leave` set date1=STR_TO_DATE('".$frmdate."','%d/%m/%Y'),date2=STR_TO_DATE('".$todate."','%d/%m/%Y'),name ='".$name."',remarks ='".$remarks."' where leave_id='".$id."'";

$result=mysql_query($sql);
if($result)
{

header("location: view_leaverecord.php");

}
else
echo "error Inserting data";
?>
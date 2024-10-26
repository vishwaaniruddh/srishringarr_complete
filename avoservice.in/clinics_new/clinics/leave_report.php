<?php
include 'config.php';

$frmdate=$_POST['frmdate'];
$todate=$_POST['todate'];
$name=$_POST['name'];
$remarks=$_POST['remarks'];

$sql="insert into leave_report(frmdate,todate,name,remarks) values (STR_TO_DATE('".$frmdate."', '%d/%m/%Y'),STR_TO_DATE('".$todate."', '%d/%m/%Y'),'$name','$remarks')";

$result=mysqli_query($con,$sql);
if($result)
{
	header ("location: home.php");
}

else 
echo "Error Inserting Data";
?>
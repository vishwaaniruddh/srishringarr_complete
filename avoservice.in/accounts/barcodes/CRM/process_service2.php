<?php
include('config.php');
$st=$_GET['st'];
$id=$_GET['id'];
$cid=$_GET['cid'];
$pdate=$_GET['pdate'];
$sdate1=$_GET['sdate1'];
$assign=$_GET['assign'];
$desc=$_GET['desc'];
$per=$_GET['per'];

//echo "update `phppos_service` set ".$id."=Yes where id='$cid'";

$sql="insert into amcservice(customer,purchase_date,service_date,assign_to,description,available_person) values ('$id','$pdate','$sdate1','$assign','$desc','$per')";
$result=mysql_query($sql);

$sql1="update `phppos_servicestatus1` set ".$st."='Yes' where id='$id' and service_date='$sdate1'";
$result1=mysql_query($sql1);

if($result)
{
	header('Location: amcview.php');
}
else
echo "Error Inserting Data";
?>
<?php
include('config.php');
$id=$_GET['id'];
$cid=$_GET['cid'];
$pdate=$_GET['pdate'];
$sdate1=$_GET['sdate1'];
$assign=$_GET['assign'];
$desc=$_GET['desc'];
$per=$_GET['per'];

//echo "update `phppos_service` set ".$id."=Yes where id='$cid'";

$sql="insert into prservice(customer,purchase_date,service_date,assign_to,description,available_person) values ('$cid','$pdate','$sdate1','$assign','$desc','$per')";
$result=mysql_query($sql);
//echo "update `phppos_service` set ".$id."='Yes' where id='$cid'";
$sql1="update `phppos_service` set ".$id."='Yes' where id='$cid'";
$result1=mysql_query($sql1);
if(!$result1)
echo "failed".mysql_error();
if($result)
{
	header('Location: cust_service.php');
}
else
echo "Error Inserting Data";
?>
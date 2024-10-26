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
$cid=$_GET['cid'];
//echo "update `phppos_service` set ".$id."=Yes where id='$cid'";
//echo $cid;
$sql="insert into amcservice(customer,purchase_date,service_date,assign_to,description,available_person,tbl_name) values ('$cid','$pdate','$sdate1','$assign','$desc','$per','AMC')";
$result=mysql_query($sql);

$sql1="update `phppos_amc` set ".$st."='Yes' where id='$id'";
$result1=mysql_query($sql1);

if($result)
{
	header('Location: amcview.php');
}
else
echo "Error Inserting Data";
?>
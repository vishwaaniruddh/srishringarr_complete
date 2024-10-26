<?php
$id=$_GET['id'];
include("config.php");

$qry=mysqli_query($con1,"select loginid from area_engg where engg_id='".$id."'");
$row=mysqli_fetch_row($qry);

$qry3=mysqli_query($con1,"Update area_engg set status='0', deleted='1' where engg_id='".$id."'");

$qry2=mysqli_query($con1,"Update login set status=1 where srno='".$row[0]."'");

$qry4=mysqli_query($con1,"DELETE from notification_tble where pid=='".$id."'");

$qry4=mysqli_query($con1,"DELETE from engg_current_location where engg_id=='".$id."'");


if($qry3 && $qry2)
header("location:view_areaeng.php");
else
echo "Error Deleting Engineer";

?>
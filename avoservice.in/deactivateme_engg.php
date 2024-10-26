<?php
include("config.php");
$id1=$_GET['id1'];

/*$qry=mysqli_query($con1,"select loginid from area_engg where engg_id='".$id1."'");
$row=mysqli_fetch_row($qry);*/
//echo "Update notification_tble set status='1' where pid='".$id1."'";
$qry3=mysqli_query($con1,"Update notification_tble set status='1' where pid='".$id1."'");

if($qry3)
header("location:view_areaeng.php");
else
echo "Error Deleting Engineer";

?>
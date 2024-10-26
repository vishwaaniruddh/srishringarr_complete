<?php
include("config.php");
$id=$_GET['id'];
$qry=mysql_query("update appoint set confirmstat='c' where app_real_id='".$id."'");
if($qry)
header("location:View_app.php");
else
echo "Some Error Occurred ".mysql_error();
?>
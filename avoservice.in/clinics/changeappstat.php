<?php
include("config.php");
$appid=$_GET['appid'];
$stat=$_GET['stat'];
$qr=mysql_query("update appoint set presstat='$stat' where app_real_id='".$appid."'");
if($qr)
echo "1";
else
echo "0";
?>
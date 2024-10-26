<?php
include("config.php");
$opdid=$_GET['opd'];
$appid=$_GET['appid'];
//echo "Update appoint set presstat='2' where app_real_id='".$appid."'";
$opd=mysql_query("select medicines,potency,days1,app_id from opd where opd_real_id='".$opdid."'");
$opdro=mysql_fetch_row($opd);
$med=explode(",",$opdro[0]);
$pot=explode(",",$opdro[1]);
$days=explode(",",$opdro[2]);

$qry=mysql_query("Update appoint set presstat='4' where app_real_id='".$appid."'");
if($qry)
echo 1;
else
echo 0;
?>
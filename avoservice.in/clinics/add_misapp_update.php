<?php
include('config.php');
$qry=mysql_query("INSERT INTO `misapp_rem`(`app_id`,`srno`, `rem`, `entrdt`) VALUES ('".$_REQUEST['id']."','".$_REQUEST['srno']."','".addslashes($_REQUEST['rem'])."','".date('Y-m-d H:i:s')."')");
if($qry)
echo "1";
else
echo "0";
?>
<?php
include('config.php');
$qry=mysql_query("INSERT INTO `rem_update`(`srno`, `rem`, `entrdt`, `type`) VALUES ('".$_REQUEST['id']."','".addslashes($_REQUEST['rem'])."','".date('Y-m-d H:i:s')."','".$_REQUEST['type']."')");
if($qry)
echo "1";
else
echo "0";
?>
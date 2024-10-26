<?php
include("config.php");
$packid=$_GET['packid'];
$qry=mysql_query("select amt from package where `desc`='".$packid."'");
$row=mysql_fetch_row($qry);
echo $row[0];
?>
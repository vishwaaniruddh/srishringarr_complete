<?php
 //error_reporting(0);
date_default_timezone_set('Asia/Kolkata');
//$con = mysql_connect("mysql1002.mochahost.com","satya123_avo","Myaccounts123*");
$con = mysql_connect("localhost","avoservi_avo","Myaccounts123*");
//$con = mysql_connect("gator3221.hostgator.com","kevalj_avo","Myaccounts123*");
mysql_select_db("avoservi_service",$con);

$conc = mysqli_connect("localhost","avoservi_avo","Myaccounts123*","avoservi_service");

//mysql_select_db("kevalj_hav_accounts",$con);
mysql_query("SET NAMES UTF8;");
define("GOOGLE_API_KEY", "AIzaSyAySemt7rQA6rcnIKf_101x1LddTU98Pg8");
error_reporting(0);
?>
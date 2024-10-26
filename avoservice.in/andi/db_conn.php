<?php
date_default_timezone_set('Asia/Kolkata');
$host="localhost";
$user="avoservi_avo";
$pass="Myaccounts123*";
$dbname="avoservi_service";
/*$con2 = mysqli_connect("localhost","avoservi_anirudd","aniruddh");
mysqli_select_db("avoservi_crm",$con2);*/
$conapp = mysqli_connect($host,$user,$pass,$dbname);

error_reporting(0);

?>
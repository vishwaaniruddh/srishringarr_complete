<?php
//error_reporting(0);
date_default_timezone_set('Asia/Kolkata');

$concs = mysqli_connect("localhost", "avoservi_avo", "Myaccounts123*", "avoservi_service");

//mysqli_select_db("kevalj_hav_accounts",$con);
mysqli_query($concs,"SET NAMES UTF8;");
define("GOOGLE_API_KEY", "AIzaSyAySemt7rQA6rcnIKf_101x1LddTU98Pg8");
error_reporting(0);
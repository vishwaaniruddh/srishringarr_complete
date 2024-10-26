<?php
/**
 * Database config variables
 */
 $conn = mysqli_connect("localhost" , "avoservi_avo" , "Myaccounts123*" , "avoservi_service");
date_default_timezone_set('Asia/Kolkata');
define("DB_HOST", "localhost");
define("DB_USER", "avoservi_avo");
define("DB_PASSWORD", "Myaccounts123*");
define("DB_DATABASE", "avoservi_service");
//date_default_timezone_set('Asia/Kolkata');




define("GOOGLE_API_KEY", "AIzaSyAySemt7rQA6rcnIKf_101x1LddTU98Pg8");
error_reporting(0);
?>
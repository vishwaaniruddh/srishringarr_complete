<?php include('../functions.php');
include('../config.php');
$keyId = 'rzp_test_m5DDzdnExZQleD';
$keySecret = 'wvd2DUAQpfY4TapD1nQl8Hkg';


// $keyId = 'rzp_live_DW1px0XkHJ4tAv';
// $keySecret = 'A52buJeuJW1E8hsEg6ssfm70';

$displayCurrency = 'INR';

$datetime = date('Y-m-d h:i:s'); 
$date = date('Y-m-d');

//These should be commented out in production
// This is for error reporting
// Add it to config.php to report any errors
// error_reporting(E_ALL);
ini_set('display_errors', 1);



if($_COOKIE['ss_userid'] > 0 ){
$userid =     $_COOKIE['ss_userid'] ; 
}else{
$userid = $_SESSION['gid'];
    
}



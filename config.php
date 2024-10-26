<?php session_start();



// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");


date_default_timezone_set('Asia/Kolkata');
$con = mysqli_connect("localhost", "u464193275_srishrinjuser", "9b@hMgk!=zI","u464193275_srishrinjewels");
$conn = mysqli_connect("localhost", "u464193275_srishrinjuser", "9b@hMgk!=zI","u464193275_srishrinjewels");
$con3=mysqli_connect("localhost", "u464193275_sarmicropos", "Mypos1234","u464193275_srishringarr");
$pathmain="";





$currency = $_SESSION['cur'] ?? ($_SESSION['cur'] = 'INR');


$cur = $_SESSION['cur'];


//echo "SELECT symbol FROM conversion_rates WHERE currency='".$currency."'" ; 
// After the line: $currency = $_SESSION['cur'] ?? ($_SESSION['cur'] = 'INR');
//if (!isset($_SESSION['currency_symbol'])) {
  //  $currency_symbolsql = mysqli_query($con, "SELECT symbol FROM conversion_rates WHERE currency='".$currency."'");
    //$currency_symbolsql_result = mysqli_fetch_assoc($currency_symbolsql);
    //$_SESSION['currency_symbol'] = $currency_symbolsql_result['symbol'];
//}
//$currency_symbol = $_SESSION['currency_symbol'];



$file_version = 1.1;

$userid = $_SESSION['gid'];
?>
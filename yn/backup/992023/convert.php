<? include('config.php');
$currency = $_REQUEST['currency'];
$money = $_REQUEST['money'];
$currencySymbol = $_REQUEST['currencySymbol'];

$sql = mysqli_query($con,"select * from conversion_rates where currency ='".$currency."'");
$sql_result = mysqli_fetch_assoc($sql);
$rate = $sql_result['rate'];
$newmoney = number_format((float)$rate*$money, 2, '.', '');
echo  $currencySymbol .' '. $newmoney ; 
<? $ip = $_SERVER['REMOTE_ADDR'];

$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));

$country = $ipdat->geoplugin_countryName; 
$currency = $ipdat->geoplugin_currencyCode;
$currencySymbol = $ipdat->geoplugin_currencySymbol_UTF8;


echo '$currencySymbol  = ' . $currencySymbol;


?>
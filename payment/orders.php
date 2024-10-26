<? session_start();
require('config.php');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;


$api = new Api($keyId, $keySecret);

$orders = $api->order->all($options);


var_dump($orders['items']);


?>
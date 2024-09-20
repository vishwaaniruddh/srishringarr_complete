<? session_start();
require('config.php');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;


$api = new Api($keyId, $keySecret);

// GET ALL ORDERS 
// $orders = $api->order->all($options);
// var_dump($orders['items']);
// GET ALL ORDERS 




$orderId = 'order_I8x5PygtQxz9uE';
$orders = $api->order->fetch($orderId)->payments();
$orderinfo = $orders['items'][0];

var_dump($orderinfo);
echo '<br>';
echo $orderinfo->id; 

// var_dump($orders['items'][0]['Razorpay\Api\Payment']);


?>
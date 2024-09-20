<?php session_start();
require('config.php');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$success = true;

$error = "Payment Failed";

// var_dump($_SESSION);
// echo '<br>';
// var_dump($_POST);
// echo '<br>';
// echo '<br>';

$yn_shopping_order_id = $_SESSION['orderid'];
// $razorpay_payment_id = $_POST['razorpay_payment_id'];
$orderId = $_SESSION['razorpay_order_id'] ;


if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);


var_dump($api);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

$api->utility->verifyPaymentSignature($attributes);

// $orders = $api->order->fetch($orderId)->payments();
$orders = $api->payment->fetch($_POST['razorpay_payment_id']) ;
$orderinfo = $orders['items'][0];
$razor_status = $orderinfo->status ;


    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}


// $orders = $api->order->fetch($orderId)->payments();
$orders = $api->payment->fetch($_POST['razorpay_payment_id']) ;

$orderinfo = $orders['items'][0];
$razor_status = $orderinfo->status ;

if($razor_status == 'captured'){
    echo 'hello if';
    include('res.php');
}else{
    echo 'testing done';
}




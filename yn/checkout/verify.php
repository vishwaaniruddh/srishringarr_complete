<?php session_start();
require('config.php');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";
$ss_shopping_order_id = $_POST['shopping_order_id'];
$razorpay_payment_id = $_POST['razorpay_payment_id'];
$orderId = $_SESSION['razorpay_order_id'] ;



if (empty($razorpay_payment_id) === false)
{
    $api = new Api($keyId, $keySecret);

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

$orders = $api->order->fetch($orderId)->payments();
$orderinfo = $orders['items'][0];
$razor_status = $orderinfo->status ;


    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}


$orders = $api->order->fetch($orderId)->payments();
$orderinfo = $orders['items'][0];
$razor_status = $orderinfo->status ;

if($razor_status == 'captured'){
    require('res.php');
}



<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Set your callback URL
$callback_url = "https://meraqr.co/payment/callback.php";

// Include Razorpay Checkout.js library
echo '<script src="https://checkout.razorpay.com/v1/checkout.js"></script>';

// Create a payment button with Checkout.js
echo '<button onclick="startPayment()">Pay with Razorpay</button>';

// Add a script to handle the payment
echo '<script>
    function startPayment() {
        var options = {
            key: 'rzp_test_4gwWqpQ2mlWxfH', // Enter the Key ID generated from the Dashboard
            amount: '5000 ', // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
            currency: "INR",
            name: "Acme Corp",
            description: "Test transaction",
            image: "https://cdn.razorpay.com/logos/GhRQcyean79PqE_medium.png",
            order_id: "123", // This is a sample Order ID. Pass the `id` obtained in the response of Step 1
            prefill: {
                name: "Gaurav Kumar",
                email: "gaurav.kumar@example.com",
                contact: "9000090000"
            },
            notes: {
                address: "Razorpay Corporate Office"
            },
            theme: {
                "color": "#3399cc"
            },
            callback_url: "' . $callback_url . '"
        };
        var rzp = new Razorpay(options);
        rzp.open();
    }
</script>';
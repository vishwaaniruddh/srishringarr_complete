<?php session_start();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


require('config.php');
require('razorpay-php/Razorpay.php');






// Create the Razorpay Order

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

// echo "insert into Order_ent(user_id) values('".$userid."')";
$order_ent = mysqli_query($con,"insert into Order_ent(user_id) values('".$userid."')");
$orderid = $con->insert_id;


if($_SESSION['totalamt']!='')
{
    $total_amount = $_SESSION['totalamt'];
}else
{
    $total_amount = $_SESSION['total_amount'];
}

//echo $total_amount=1;

$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$mobile = $_SESSION['mobile'];
$email = $_SESSION['email'];
$userid = $_SESSION['gid'];
$_SESSION['orderid'] = $orderid ; 


$orderData = [
    'receipt'         => $orderid,
    'amount'          => $total_amount * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$name = $fname .' ' . $lname ; 

$razorpayOrder = $api->order->create($orderData);
$razorpayOrderId = $razorpayOrder['id'];
$_SESSION['razorpay_order_id'] = $razorpayOrderId;
$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}


if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
    $checkout = $_GET['checkout'];
}

$data = [
    "key"               => $keyId,
    "amount"            => $total_amount,
    "name"              => $name,
    "description"       => "Yosshitaneha Fashion Studio",
    "image"             => "https://yosshitaneha.com/assets/logo.jpg",
    "prefill"           => [
    "name"              => $name,
    "email"             => $email,
    "contact"           => $mobile,
    ],
    "notes"             => [
    "address"           => $orderid,
    "merchant_order_id" => $orderid,
    ],
    "theme"             => [
    "color"             => ""
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);


// var_dump($_SESSION)
?>


<html>
    <head>
        

        <title>Pay At Yosshitaneha Fashion Studio</title>
        <link rel="" href="logo/Untitled-2 copy.jpg"/><link rel="icon" href="logo/Untitled-2 copy.jpg" type="image/x-icon" />


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- jQuery (necessary for Bootstrap s JavaScript plugins) -->
        
        <script src="yn/js/jquery.min.js"></script>
        
        <!-- Custom Theme files -->
        <!--theme-style-->
        
        <link href="yn/css/style.css" rel="stylesheet" type="text/css" media="all" />
        
        <!--//theme-style-->
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Wedding Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
        Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- start menu -->
        <script src="yn/js/simpleCart.min.js"></script>
        <!-- start menu -->
        <link href="yn/css/memenu.css" rel="stylesheet" type="text/css" media="all" />
        <script type="text/javascript" src="yn/js/memenufi.js"></script>
        
        <script>
            $(document).ready(function(){
                if($.fn.memenu){
                    $(".memenu").memenu();
                }
            });
        </script>
    
        <link href="yn/css/form.css" rel="stylesheet" type="text/css" media="all" />
        <link href="yn/css/custom.css" rel="stylesheet" type="text/css" media="all" />	
        
        <!-- this meta viewport is required for BOLT //-->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
 
       <link href="style.css" rel="stylesheet" type="text/css" media="all" />	
 
    </head>
    <body >
        <?php //include("addtocartpopup.php");?>
        <?php //include("requiredfields.php");?>
    
    
        <div class="top_bga">
        	<div class="container">
        		<div class="header_top-sec">
        			<?php //include('topbar.php')?>
        	    </div>
            </div>
            <div class="header-top">
        		<div class="container">	
        		    <!---->
        		    <div class="" style=" margin-top:-px; ">
        			  <?php //include('menu.php')?>
        			</div>
        			
                    <div class="table-wrapper" style="padding:5%; ">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="index.php">
                                        <img src="http://yosshitaneha.com/assets/logo.jpg">
                                    </a>
                                </div>
                                <div class="col-sm-4 custom_checkout_heading text-center">
                                    <!--<h2>Payment Process</h2>-->
                                </div>
                                <div class="col-md-4" style="font-size: 20px;">
            						<div>Kindly complete your payment within <span id="timer"></span></div>
                                </div>
            						


            					</div>
                            </div>
                        </div>
                    </div>
    		        <div class="clearfix"> </div>
    		        
    		        <div class="container">
        			<div class="main">



                        <div> </div> 

                            
                            <div class="form-group row">
                                <label for="amount" class="col-sm-2 col-form-label">Amount ( IN INR ):</label>
                                <div class="col-sm-10">
                                  <!--<input type="text" class="form-control" id="amount" placeholder="amount" name="amount" value="1.00" / >-->
                                  <input type="text" class="form-control" id="amount" placeholder="amount" name="amount" value="<? echo sprintf("%.2f", $amount/100) ;?>" readonly / >
                                  
                                </div>
                            </div>
                            
                            
                            <div class="form-group row">
                                <label for="amount" class="col-sm-2 col-form-label">Name:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="fname" name="fname" placeholder="Name" value="<? echo $fname .' '. $lname; ?>" readonly />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="amount" class="col-sm-2 col-form-label">Email:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="email" name="email" placeholder="Email ID" value="<?php echo $email; ?>" readonly />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="amount" class="col-sm-2 col-form-label">Mobile/Cell Number:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile/Cell Number" value="<? echo $mobile ; ?>" readonly/>
                                </div>
                            </div>

                            <div class="text-center" style="display: flex;justify-content: space-evenly;">
                                <a class="btn btn-danger" href="../cart.php">Cancel</a>
                            	<?php require("checkout/manual.php"); ?>
                            </div>


                    	
                    	
                    	
                    	
                    	
                    </div>    		            
    		        </div>

                    
        		</div>
        		<div class="clearfix"> </div>
            </div>
        </div>
   <script>
       
       // Time 
var countDownDate = new Date();
countDownDate = countDownDate.setMinutes(countDownDate.getMinutes()+5);

var x = setInterval(function() {
var now = new Date().getTime();
var distance = countDownDate - now;
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);
document.getElementById("timer").innerHTML =  minutes + "m " + seconds + "s ";
    
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("timer").innerHTML = "EXPIRED";
  }
}, 1000);

// end Timer 

setInterval(function(){
    
    

    if(document.getElementById("timer").innerHTML == "EXPIRED") {
        alert('Maximum time limit extended to complete the transaction ! ');
        window.location='https://yosshitaneha.com/cart.php';
        // add_again(product_id);
    }
    
},1000);
       
       
   </script>     
        

          </body>
</html>

<?php session_start();
include("config.php");
// include("function.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$product_arr = get_product_from_cart($userid);

foreach($product_arr as $key => $val) {
    $type=get_product_type_by_productid($val,$userid);
    $skua[]=get_sku($val,$type);
}
$skua=json_encode($skua);
                   $sql = mysqli_query($con,"select sum(total_amt) as total from cart where user_id='".$userid."' and ac_typ='2'");
                    $sql_result = mysqli_fetch_assoc($sql);
                    $total_amount = $sql_result['total'];

if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0) {
    //Request hash
    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    if(strcasecmp($contentType, 'application/json') == 0) {
        $data = json_decode(file_get_contents('php://input'));
        $hash = hash('sha512', $data->key.'|'.$data->txnid.'|'.$data->amount.'|'.$data->pinfo.'|'.$data->fname.'|'.$data->email.'|||||'.$data->udf5.'||||||'.$data->salt);
        $json = array();
        $json['success'] = $hash;
        echo json_encode($json);
    }
    exit(0);
}

function getCallbackUrl()
{
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    //  return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . 'response.php';
    return  $protocol . $_SERVER['HTTP_HOST'] . '/response.php';
}

// include('header.php');
?>
<!DOCTYPE html>
<html>
    <head>


        <title>YosshitaNeha</title>
        <link rel="" href="logo/Untitled-2 copy.jpg"/><link rel="icon" href="logo/Untitled-2 copy.jpg" type="image/x-icon" />
        <link href="yn/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Wedding Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
        Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

        <link href="yn/css/form.css" rel="stylesheet" type="text/css" media="all" />
        <link href="yn/css/custom.css" rel="stylesheet" type="text/css" media="all" />

        <!-- this meta viewport is required for BOLT //-->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >
        <!-- BOLT Sandbox/test //-->
<!--<script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>-->
<script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <style>
            .alert {
                padding: 20px;
                background-color: #f44336;
                color: white;
            }

            .closebtn {
                margin-left: 15px;
                color: white;
                font-weight: bold;
                float: right;
                font-size: 22px;
                line-height: 20px;
                cursor: pointer;
                transition: 0.3s;
            }

            .closebtn:hover {
                color: black;
            }

            #snackbar {
                visibility: hidden;
                min-width: 250px;
                margin-left: -125px;
                background-color: #333;
                color: #fff;
                text-align: center;
                border-radius: 2px;
                padding: 16px;
                position: fixed;
                z-index: 1;
                left: 50%;
                bottom: 30px;
                font-size: 17px;
            }

            #snackbar.showalrt{
                visibility: visible;
                -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
                animation: fadein 0.5s, fadeout 0.5s 2.5s;
            }

            @-webkit-keyframes fadein {
                from {bottom: 0; opacity: 0;}
                to {bottom: 30px; opacity: 1;}
            }

            @keyframes fadein {
                from {bottom: 0; opacity: 0;}
                to {bottom: 30px; opacity: 1;}
            }

            @-webkit-keyframes fadeout {
                from {bottom: 30px; opacity: 1;}
                to {bottom: 0; opacity: 0;}
            }

            @keyframes fadeout {
                from {bottom: 30px; opacity: 1;}
                to {bottom: 0; opacity: 0;}
            }


            .drop1{ border:0; color:#EEE; background:#800000;
            font-size:18px; font-weight:bold; padding:2px 8px; width:150px;
            *width:160px; *background:#fff; -webkit-appearance: none; }

            #mainselection { overflow:hidden; width:150px;
            -moz-border-radius: 9px 9px 9px 9px;
            -webkit-border-radius: 9px 9px 9px 9px;
            border-radius: 9px 9px 9px 9px;
            box-shadow: 1px 1px 11px #800000;
            background: url("http://www.danielneumann.com/wp-content/uploads/2011/01/arrow.gif") no-repeat scroll 219px 5px #fff;
            }

            .main {
        		margin-left:30px;
        		font-family:Verdana, Geneva, sans-serif, serif;
        	}
        	.text {
        		float:left;
        		width:180px;
        	}
        	.dv {
        		margin-bottom:5px;
        	}
        	.hide-data{
        	    display : none;
        	}
        	#timer{
        	        font-size: 18px;
    font-weight: 600;
    color: red;
    /*margin: auto 5%;*/
    width: 100%;
        	}
        	.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    cursor: not-allowed;
    opacity: 1;
    background: #d0d0d0;
}
        </style>
    </head>
    <body >

        <div class="top_bga">
        	<div class="container">
        		<div class="header_top-sec">
        	    </div>
            </div>
            <div class="header-top">
        		<div class="container">
        		    <div class="" style=" margin-top:-px; ">
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
             					</div>
                            </div>
                        </div>
                    </div>
    		        <div class="clearfix"> </div>

    		        <div class="container">
        			<div class="main">
                        <div> </div>
                    	<form action="#" id="payment_form">
                            <input type="hidden" id="udf5" name="udf5" value="BOLT_KIT_PHP7" />
                            <input type="hidden" id="surl" name="surl" value="<?php echo getCallbackUrl(); ?>" />

                            <div class="dv hide-data">
                                <span class="text"><label>Merchant Key:</label></span>
                                <span><input type="text" id="key" name="key" placeholder="Merchant Key" value="nMHrhc6s" /></span>
                            </div>

                            <div class="dv hide-data">
                                <span class="text"><label>Merchant Salt:</label></span>
                                <span><input type="text" id="salt" name="salt" placeholder="Merchant Salt" value="XrBnKyEXsp" /></span>
                            </div>

                            <div class="dv hide-data">
                                <span class="text"><label>Transaction/Order ID:</label></span>
                                <span><input type="text" id="txnid" name="txnid" placeholder="Transaction ID" value="<?php echo  "Txn" . rand(10000,99999999)?>" /></span>
                            </div>

                            <div class="form-group row">
                                <label for="amount" class="col-sm-2 col-form-label">Amount (In Rupees): </label>
                                <div class="col-sm-10">
                                  <!--<input type="text" class="form-control" id="amount" placeholder="amount" name="amount" value="1.00" / >-->
                                  <input type="text" class="form-control" id="amount" placeholder="amount" name="amount" value="<? echo sprintf("%.2f", $total_amount) ;?>" readonly / >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="amount" class="col-sm-2 col-form-label">First Name:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<? echo $_SESSION['fname'].' '.$_SESSION['lname'] ?>" readonly />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="amount" class="col-sm-2 col-form-label">Email:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="email" name="email" placeholder="Email ID" value="<?php echo $_SESSION['email'];?>" readonly />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="amount" class="col-sm-2 col-form-label">Mobile/Cell Number:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile/Cell Number" value="<? echo $_SESSION['mobile']; ?>" readonly/>
                                </div>
                            </div>

                            <div class="dv hide-data">
                                <span class="text"><label>Product Info:</label></span>
                                <span>
                                    <input type="text" id="pinfo" name="pinfo" placeholder="Product Info" value="P01,P02" />
                                </span>
                            </div>

                            <div class="dv hide-data">
                                <span class="text"><label>Hash:</label></span>
                            <span><input type="text" id="hash" name="hash" placeholder="Hash" value="" /></span>
                            </div>
                            <div class="text-center">
                                <a class="btn btn-danger" href="cart.php">Cancel</a>
                                <input type="submit" value="Pay" class="btn btn-info" onclick="launchBOLT(); return false;" />
                            </div>
                    	</form>
                    </div>
    		        </div>


        		</div>
        		<div class="clearfix"> </div>
            </div>
        </div>


        <script type="text/javascript"><!--


        function get_hashCode(){

            $.ajax({
                  url: 'pay.php',
                  type: 'post',
                  data: JSON.stringify({
                    key: $('#key').val(),
        			salt: $('#salt').val(),
        			txnid: $('#txnid').val(),
        			amount: $('#amount').val(),
        		    pinfo: $('#pinfo').val(),
                    fname: $('#fname').val(),
        			email: $('#email').val(),
        			mobile: $('#mobile').val(),
        			udf5: $('#udf5').val()
                  }),
        		  contentType: "application/json",
                  dataType: 'json',
                  success: function(json) {
                      //alert('pay res');
                    if (json['error']) {
        			 $('#alertinfo').html('<i class="fa fa-info-circle"></i>'+json['error']);
                    }
        			else if (json['success']) {
        				$('#hash').val(json['success']);
                    }
                  }
                });
            }

        get_hashCode();
        </script>
        <script type="text/javascript"><!--
        function launchBOLT()
        {
        	bolt.launch({
        	key: $('#key').val(),
        	txnid: $('#txnid').val(),
        	hash: $('#hash').val(),
        	amount: $('#amount').val(),
        	firstname: $('#fname').val(),
        	email: $('#email').val(),
        	phone: $('#mobile').val(),
        	productinfo: $('#pinfo').val(),
        	udf5: $('#udf5').val(),
        	surl : $('#surl').val(),
        	furl: $('#surl').val(),
        	mode: 'dropout'
        },{ responseHandler: function(BOLT){
        	console.log( BOLT.response.txnStatus );
        	if(BOLT.response.txnStatus != 'CANCEL')
        	{
        		//Salt is passd here for demo purpose only. For practical use keep salt at server side only.
        		var fr = '<form action=\"'+$('#surl').val()+'\" method=\"post\">' +
        		'<input type=\"hidden\" name=\"key\" value=\"'+BOLT.response.key+'\" />' +
        		'<input type=\"hidden\" name=\"salt\" value=\"'+$('#salt').val()+'\" />' +
        		'<input type=\"hidden\" name=\"txnid\" value=\"'+BOLT.response.txnid+'\" />' +
        		'<input type=\"hidden\" name=\"amount\" value=\"'+BOLT.response.amount+'\" />' +
        		'<input type=\"hidden\" name=\"productinfo\" value=\"'+BOLT.response.productinfo+'\" />' +
        		'<input type=\"hidden\" name=\"firstname\" value=\"'+BOLT.response.firstname+'\" />' +
        		'<input type=\"hidden\" name=\"email\" value=\"'+BOLT.response.email+'\" />' +
        		'<input type=\"hidden\" name=\"udf5\" value=\"'+BOLT.response.udf5+'\" />' +
        		'<input type=\"hidden\" name=\"mihpayid\" value=\"'+BOLT.response.mihpayid+'\" />' +
        		'<input type=\"hidden\" name=\"status\" value=\"'+BOLT.response.status+'\" />' +
        		'<input type=\"hidden\" name=\"hash\" value=\"'+BOLT.response.hash+'\" />' +
        		'</form>';
        		var form = jQuery(fr);
        		jQuery('body').append(form);
        		form.submit();
        	}
        },
        	catchException: function(BOLT){
         		alert( BOLT.message );
        	}
        });
        }

        </script>
          </body>
</html>
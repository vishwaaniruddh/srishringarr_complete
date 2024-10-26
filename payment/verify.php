<?php session_start();
include('config.php');
include('../functions.php');

require('../config.php');



date_default_timezone_set('Asia/Kolkata'); 

$datetime = date('Y-m-d h:i:s'); 
$date = date('Y-m-d');
// $userid = $_COOKIE['gid'];


if($_COOKIE['ss_userid'] > 0 ){
$userid =     $_COOKIE['ss_userid'] ; 
}else{
$userid = $_SESSION['gid'];
    
}



// $total_amount=$_SESSION['total_rental']; 
$coupon = $_SESSION['coupon_code'] ;
if($is_same_state==1) {
    $cgst=$total_gst/2;
    $sgst=$total_gst/2;
    $igst=0;
    
} else {
    $cgst=0;
    $sgst=0;
    $igst=$total_gst;  
}


/*Ruchi : insert customised order */

$custom_details ='';

if(isset($_SESSION['piece'])) { 
    
    $custom_details.= 'Same piece \n';
}
if(isset($_SESSION['color'])) {
    
    $custom_details.= 'Same color \n';
}
if(isset($_SESSION['pattern'])) { 
    
    $custom_details.= 'Same pattern \n';
}

if(isset($_SESSION['customize'])){
    $custom_details = $_SESSION['custom_data'];
    $is_customisable = 1;
    
    $custom_data = $_SESSION['custom_data'];
} else {
    $is_customisable = 0;
    $custom_data = '';
}

// $errs++;
$email=$_COOKIE['ss_email'];

$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];

$delivery_add = $_SESSION['delivery'];
$pickup_add = $_SESSION['pickup'];


$salt="ecH0HEsO";

$user_id=$_SESSION['gid'];

$qryqty=mysqli_query($conn,"select * from Order_ent where transaction_id='".$txnid."' and transaction_stats=1");


$frw=mysqli_fetch_array($qryqty);

$nrws=mysqli_num_rows($qryqty);

if($nrws>0)
{
    $orderid=$frw[0];
}





require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
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
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    $html = "<p>Your payment was successful</p>
             <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
    
    $select_sql=mysqli_query($conn,"select * from Order_ent where transaction_id='".$txnid."'");
    $select_sql_result=mysqli_fetch_assoc($select_sql);
    
    if(!$select_sql_result && $userid>0) { //to prevent duplicate entries
    
         $insert="insert into Order_ent(user_id,amount,status,pmode,cmplt_status,transaction_stats,transaction_id,shipping_charges,total_amount,sgst,cgst,igst,is_customized,acc_type,date,delivery_add,pickup_add,coupon_code) VALUES ('".$user_id."','".$amount."','".$status."','online','1','1','".$txnid."','".$shipping_charges."','".$total_amount."','".$sgst."','".$cgst."','".$igst."',$is_customisable,1,'".$datetime."','".$delivery_add."','".$pickup_add."','".$coupon."')";

        mysqli_query($conn,$insert);

        $order= mysqli_insert_id($conn);
      
        $crtids=get_cart_ids($userid);
        
        foreach($crtids as $key => $val) {
            
            $qty=get_cart_quantity($val);
            $product_amt=get_product_amt_by_cart_id($val);
            $rental_date = get_cart_info($val);
            
            
            $cart_sql = mysqli_query($conn,"select * from cart where cart_id='".$val."'");
            $cart_sql_result = mysqli_fetch_assoc($cart_sql);
            
            $product_image = $cart_sql_result['image']; 
            $deposit_date = $cart_sql_result['deposite_date'];
            
            
           $insert_order_details = "insert into order_details(order_id,cart_id,user_id,product_type,product_id,qty,product_amt,total_amt,date,status,ac_typ,custom_data,rent_dt,return_dt,deposit_amt,image,deposite_date) VALUES ('".$order."','".$val."','".$userid."','".get_product_type_from_cart($val,$userid)."','".get_product_from_cart_by_cartid($val)."','".$qty."','".$product_amt."','".$product_amt*$qty."','".date('Y/m/d h:i:s')."','".'1'."','1','".$custom_data."','".$rental_date[0]."','".$rental_date[1]."','".$rental_date[2]."','".$product_image."','".$deposit_date."')";
            // echo '<br>';
            mysqli_query($conn,$insert_order_details);
            
        }
    



// POS TABLE 
     
     
        
        $crtids=get_cart_ids($userid);
        
        $state_id = state_id_userid($userid);
        
         foreach($crtids as $key => $val){
            
            $qty=get_cart_quantity($val);
            $product_amt=get_product_amt_by_cart_id($val);
            $pro_type=get_product_type_from_cart($val,$userid);
            $product_id = get_product_from_cart_by_cartid($val);
            $sku=get_sku($product_id,$pro_type);
            $discount = get_discount($product_id,$pro_type);
            
            $rental_date = get_cart_info($val);
            
            

            
            // INSERT INTO `phppos_rent` 

            mysqli_query($con3,"insert into phppos_rent(cust_id,bill_date,rent_amount,	amount,status, pick, delivery, pstatus,pick_date, delivery_date,delivery_status,booking_status,order_id) values('".$userid."','".$date."','".$product_amt."','".$rental_date[3]."','A','Customer','Customer Return','Paid','".$rental_date[0]."','".$rental_date[1]."','Paid','Booked','".$order."')");
            
            $phppos_rent_id = $con3->insert_id;
            if($phppos_rent_id > 0){
                    // INSERT POS order_detail
                    
                    mysqli_query($con3,"insert into order_detail(bill_id,item_id,rent,deposit,total_amount) values('".$phppos_rent_id."','".$sku."','".$product_amt."','".$rental_date[2]."','".$rental_date[3]."')");
                    
                    // END INSERT POS order_detail            
                    
                    
                    $insert_paid_amount = "insert into paid_amount(bill_id,amount,payment_by,bid) values('".$userid."','".$total_amount."','ONLINE','".$phppos_rent_id."')";    
            }else{
                echo 'not';
                return ; 
            }

         }

    //start Email Body 
    
    
    if($is_customisable==1){
        
        $Adminlink= '<html lang="en">

 <head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<div id="m_3716871841364271743wrapper" dir="ltr" style="background-color:#f7f7f7;margin:0;padding:70px 0;width:100%">
	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
		<tbody>
		    <tr>
			 <td align="center" valign="top">
				<div id="m_3716871841364271743template_header_image"></div>
					<table border="0" cellpadding="0" cellspacing="0" width="600" id="m_3716871841364271743template_container" style="background-color:#ffffff;border:1px solid #dedede;border-radius:3px">
						<tbody>
							<tr>
							<td align="center" valign="top">
								<table border="0" cellpadding="0" cellspacing="0" width="600" id="m_3716871841364271743template_header" style="background-color:#96588a;color:#ffffff;border-bottom:0;font-weight:bold;line-height:100%;vertical-align:middle;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;border-radius:3px 3px 0 0">
									<tbody>
										<tr>
											<td id="m_3716871841364271743header_wrapper" style="padding:36px 48px;display:block">
												<h1 style="font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:30px;font-weight:300;line-height:150%;margin:0;text-align:left;color:#ffffff">
												Customization order request  

												</h1>
												
					<h3>You have received an customization order request from '.$firstname.' ! </h3>
                
												</td>
										</tr>
									</tbody>
								</table>

							</td>
							</tr>

							<tr>
							<td align="center" valign="top">
									<table border="0" cellpadding="0" cellspacing="0" width="600" id="m_3716871841364271743template_body"><tbody><tr>
										<td valign="top" id="m_3716871841364271743body_content" style="background-color:#ffffff">
												
												<table border="0" cellpadding="20" cellspacing="0" width="100%"><tbody><tr>
												<td valign="top" style="padding:48px 48px 32px">
													<div id="m_3716871841364271743body_content_inner" style="color:#636363;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:14px;line-height:150%;text-align:left">

															<p style="margin:0 0 16px">Hi Admin,</p>

															</span><h2 style="color:#96588a;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left">
																[Order #'.$order.'] ('.date('Y/m/d h:i:s').')</h2>
															
															<p style="margin:0 0 16px">Measurement given below : ,</p>'.$custom_details.'

															<div style="margin-bottom:40px">
																<table cellspacing="0" cellpadding="6" border="1" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">
															<thead><tr>
															<th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Product</th>
																			<th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Quantity</th>
																			<th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Price</th>
																		</tr></thead>';
																		
									
									
																		
                                                        $sql=mysqli_query($conn,"select * from order_details  where order_id='".$order."' and ac_typ ='1' ");
                                                        while($sql_result=mysqli_fetch_assoc($sql)){
                                                        
                                                        $product_id=$sql_result['product_id'];
                                                        $type = $sql_result['product_type'];
                                                        
                                                        $name = get_sku($product_id,$type); 
                                                        
                                                        $quantity = $sql_result['qty'];
                                                        $product_amt = $sql_result['product_amt'];
                                                            $image_url = $sql_result['image'];
                                                        $link .=  '<tbody>
                                                            <tr>
                                                                <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word">
                                                				    <img src="'. $image_url.'" width="30%">	'.$name.'		</td>
                                                                <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">
                                                															'.$quantity.' </td>
                                                                <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">
                                                				<span><span>₹</span>'.$product_amt.'</span>		</td>
                                                            </tr>
                                                            </tbody>';
                                                        }
                                                        //footer
                                                        $Adminlink .= '<tfoot> 
                                                        	
															<tr>
															<th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Total:</th>
																<td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left"><span><span>₹</span>'.$total_amount.'</span></td>
															</tr>
															</tfoot>
															</table>
															</div>
															<p style="margin:0 0 16px">We look forward to fulfilling your order soon.</p>
													</div>

												</td>
											</tr>
										</tbody>
									</table>

								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</td>
</tr>

<tr>
<td align="center" valign="top">
						
<table border="0" cellpadding="10" cellspacing="0" width="600" id="m_3716871841364271743template_footer"><tbody><tr>
<td valign="top" style="padding:0;border-radius:6px">
									<table border="0" cellpadding="10" cellspacing="0" width="100%"><tbody><tr>
<td colspan="2" valign="middle" id="m_3716871841364271743credit" style="border-radius:6px;border:0;color:#8a8a8a;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:12px;line-height:150%;text-align:center;padding:24px 0">
									
											</td>
										</tr></tbody></table>
</td>
							</tr></tbody></table>

</td>
				</tr>
</tbody></table><div class="yj6qo"></div><div class="adL">
</div></div>

</body>
</html>';
}
    $to = $email;
    $link= '<html lang="en">

 <head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<div id="m_3716871841364271743wrapper" dir="ltr" style="background-color:#f7f7f7;margin:0;padding:70px 0;width:100%">
	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
		<tbody>
		    <tr>
			 <td align="center" valign="top">
				<div id="m_3716871841364271743template_header_image"></div>
					<table border="0" cellpadding="0" cellspacing="0" width="600" id="m_3716871841364271743template_container" style="background-color:#ffffff;border:1px solid #dedede;border-radius:3px">
						<tbody>
							<tr>
							<td align="center" valign="top">
								<table border="0" cellpadding="0" cellspacing="0" width="600" id="m_3716871841364271743template_header" style="background-color:#96588a;color:#ffffff;border-bottom:0;font-weight:bold;line-height:100%;vertical-align:middle;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;border-radius:3px 3px 0 0">
									<tbody>
										<tr>
											<td id="m_3716871841364271743header_wrapper" style="padding:36px 48px;display:block">
												<h1 style="font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:30px;font-weight:300;line-height:150%;margin:0;text-align:left;color:#ffffff">
												Thank you for your order

												</h1>
												
					<h3>Your Order is successfully placed ! </h3>
                <span> The transaction id for your reference is  '.$txnid.' </span>
                
                
												</td>
										</tr>
									</tbody>
								</table>

							</td>
							</tr>

							<tr>
							<td align="center" valign="top">
									<table border="0" cellpadding="0" cellspacing="0" width="600" id="m_3716871841364271743template_body"><tbody><tr>
										<td valign="top" id="m_3716871841364271743body_content" style="background-color:#ffffff">
												
												<table border="0" cellpadding="20" cellspacing="0" width="100%"><tbody><tr>
												<td valign="top" style="padding:48px 48px 32px">
													<div id="m_3716871841364271743body_content_inner" style="color:#636363;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:14px;line-height:150%;text-align:left">

															<p style="margin:0 0 16px">Hi '.$firstname.',</p>
															<p style="margin:0 0 16px">Thanks for your order. It’s on-hold until we confirm that payment has been received. In the meantime, here’s a reminder of what you ordered:</p><span class="im">


															</span><h2 style="color:#96588a;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left">
																[Order #'.$order.'] ('.date('Y/m/d h:i:s').')</h2>

															<div style="margin-bottom:40px">
																<table cellspacing="0" cellpadding="6" border="1" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">
															<thead><tr>
                															<th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Product</th>
                															<th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Pickup</th>
                															<th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Return</th>
                															<th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Deposit</th>
																			<th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Quantity</th>
																			<th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Price</th>
																		</tr></thead>';
																		
									
									
																		
$sql=mysqli_query($conn,"select * from order_details  where order_id='".$order."' and ac_typ ='1'");
while($sql_result=mysqli_fetch_assoc($sql)){

$product_id=$sql_result['product_id'];
$type = $sql_result['product_type'];

$name = get_sku($product_id,$type); 

$quantity = $sql_result['qty'];
$product_amt = $sql_result['product_amt'];
    $image_url = $sql_result['image'];
    $deposit_date = $sql_result['deposite_date'];
    $return_date =$sql_result['return_dt'];
    $rent_date = $sql_result['rent_dt'];
$link .=  '<tbody>
            <tr>
                <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word">
				    <img src="'. $image_url.'" width="30%">	'.$name.'		</td>
                <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">
															'.$rent_date.' </td>
                <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">
															'.$return_date.' </td>
				<td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">
															'.$deposit_date.' </td>
                <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">
															'.$quantity.' </td>
                <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">
				<span><span>₹</span>'.$product_amt.'</span>		</td>
            </tr>

            </tbody>';
                    
}
        
															











$link .= '<tfoot>


															<tr>
															<th scope="row" colspan="5" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Total:</th>
																					<td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left"><span><span>₹</span>'.$total_amount.'</span></td>
																				</tr>
															</tfoot>
															</table>
															</div>




															<p style="margin:0 0 16px">We look forward to fulfilling your order soon.</p>
															
															<a href="http://srishringarr.com/bill/srisringarr_bill/bill.php?oid='.$order.'" >Click here to View/download Bill</a>

<h3>Enjoy Unlimited Unique Fashion Products !<h3>
<p>Visit <b><a href="http://srishringarr.com/">Srishringarr</a></b></p>


<a style="border-radius:0px;font-size:16px;color:#fff;padding:11px 50px;max-width:500px;font-family:Atlas Grotesk,Open Sans,HelveticaNeue-Light,Helvetica Neue Light,Helvetica Neue,Helvetica,Arial,Lucida Grande,sans-serif;border:0px solid #0061ff;text-align:center;text-decoration:none;font-weight:300;display:block;background-color:#0061ff" href="https://www.srishringarr.com/account/redirect.php?id='.$userid.'" data-saferedirecturl="https://www.google.com/url?q=https://www.dropbox.com/l/AABWjooGQaWoHtoVAS-WNXojMuESi-3AWkk/transfer&amp;source=gmail&amp;ust=1599233688458000&amp;usg=AFQjCNFvNdMIywplnetehOofv4MityU2Kg">
View My Account
</a>


													</div>

												</td>
											</tr>
										</tbody>
									</table>

								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</td>
</tr>

<tr>
<td align="center" valign="top">
						
						<table border="0" cellpadding="10" cellspacing="0" width="600" id="m_3716871841364271743template_footer"><tbody><tr>
<td valign="top" style="padding:0;border-radius:6px">
									<table border="0" cellpadding="10" cellspacing="0" width="100%"><tbody><tr>
<td colspan="5" valign="middle" id="m_3716871841364271743credit" style="border-radius:6px;border:0;color:#8a8a8a;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:12px;line-height:150%;text-align:center;padding:24px 0">
									
											</td>
										</tr></tbody></table>
</td>
							</tr></tbody></table>

</td>
				</tr>
</tbody></table><div class="yj6qo"></div><div class="adL">
</div></div>

</body>
</html>';






    $headers='';
    $headers .= "Reply-To: The Sender sales@srishringarr.com\r\n"; 
    $headers .= "Return-Path: The Sender sales@srishringarr.com\r\n"; 
    $headers .= "From: Srishringarr Fashion Studio <sales@srishringarr.com>" ."\r\n" .
    $headers .= "Organization: Sender Organization\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
    
            
    if(mail($to, "Thanks You For Shopping At Srishringarr", $link, $headers,'-f sales@srishringarr.com -F "Srishringarr Fashion Studio"')){
        
        mail('yosshita.neha@gmail.com', "Thanks You For Shopping At Srishringarr", $link, $headers,'-f sales@srishringarr.com -F "Srishringarr Fashion Studio"');
        
        mail('rajanipodar@gmail.com', "Thanks You For Shopping At Srishringarr", $link, $headers,'-f sales@srishringarr.com -F "Srishringarr Fashion Studio"');
        mail('vishwaaniruddh@gmail.com', "Thanks You For Shopping At Srishringarr", $link, $headers,'-f sales@srishringarr.com -F "Srishringarr Fashion Studio"');
        mail('developer.ruchi@gmail.com', "Thanks You For Shopping At Yosshitaneha", $link, $headers,'-f sales@srishringarr.com -F "Yosshitaneha Fashion Studio"');
    
        
    }
    
    
    if($is_customisable==1) {
        $filename = 'dummy.pdf';
        $path = 'http://sarmicrosystems.in/srishringarr/web/static/documents';
        $file = $path . "/" . $filename;
        
        $content = file_get_contents($file);
        $content = chunk_split(base64_encode($content));
        
        // a random hash will be necessary to send mixed content
        $separator = md5(time());
    
        // carriage return type (RFC)
        $eol = "\r\n";
        
        // main header (multipart mandatory)
        
        
        $headers = "Reply-To: The Sender sales@srishringarr.com\r\n"; 
        $headers .= "Return-Path: The Sender sales@srishringarr.com\r\n"; 
    $headers .= "From: Srishringarr Fashion Studio <sales@srishringarr.com>" ."\r\n" .
    $headers .= "Organization: Sender Organization\r\n";
        //$headers .= "MIME-Version: 1.0\r\n";
        //$headers .= "Content-type: text/html; charset=utf-8\r\n";
        //$headers .= "X-Priority: 3\r\n";
        //$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
    
    
    
        $headers .= "From: sales@srishringarr.com" . $eol;
        $headers .= "MIME-Version: 1.0" . $eol; 
        $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
        $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
        $headers .= "This is a MIME encoded message." . $eol;
    
        // message
        $Adminlink.= "--" . $separator . $eol;
        $Adminlink .= $message . $eol;
        
        // attachment
        $Adminlink .= "--" . $separator . $eol;
        $Adminlink .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
        $Adminlink .= "Content-Transfer-Encoding: base64" . $eol;
        $Adminlink .= "Content-Disposition: attachment" . $eol;
        $Adminlink .= $content . $eol;
        $Adminlink .= "--" . $separator . "--";

        // mail('developer.ruchi@gmail.com', "Admin customization request Mail", $Adminlink, $headers);
    }
    // end Email Body
} 




















             
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

echo $html;



?>




<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="keywords" content="htmlcss bootstrap menu, navbar, mega menu examples" />
<meta name="description" content="Navigation  menu with submenu examples for any type of project, Bootstrap 4" />  
	<title>Sri Shringarr</title>
    	<meta charset="UTF-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1"> 
        
    	<link rel="icon" type="image/png" href="../static/images/icons/favicon.png"/>
    
    	<link rel="stylesheet" type="text/css" href="../static/css/bootstrap.min.css"> 
    	
    
    	<link rel="stylesheet" type="text/css" href="../static/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    
    	<link rel="stylesheet" type="text/css" href="../static/fonts/themify/themify-icons.css">
    
    	<link rel="stylesheet" type="text/css" href="../static/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    	
    	<link rel="stylesheet" type="text/css" href="../static/css/style.css">
    
    	<link rel="stylesheet" type="text/css" href="../static/css/vendor/animate/animate.css">
    
    	<link rel="stylesheet" type="text/css" href="../static/css/vendor/css-hamburgers/hamburgers.min.css">
    
    	<!-- <link rel="stylesheet" type="text/css" href="/static/css/vendor/animsition/css/animsition.min.css"> -->
    
    	<link rel="stylesheet" type="text/css" href="../static/css/vendor/select2/select2.min.css">
    
    	<link rel="stylesheet" type="text/css" href="../static/css/vendor/daterangepicker/daterangepicker.css">
    
    	<link rel="stylesheet" type="text/css" href="../static/css/vendor/slick/slick.css">
    
    	<link rel="stylesheet" type="text/css" href="../static/css/vendor/lightbox2/css/lightbox.min.css">
        
    	<link rel="stylesheet" type="text/css" href="../static/css/util.css">
    	<link rel="stylesheet" type="text/css" href="../static/css/main.css">
    	<link rel="stylesheet" type="text/css" href="../static/css/site.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
crossorigin="anonymous"></script>
	<script type="text/javascript" src="http://sarmicrosystems.in/srishringarr/web/static/css/vendor/bootstrap/js/popper.js"></script>
<!-- Bootstrap files (jQuery first, then Popper.js, then Bootstrap JS) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    	
        <!--<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>-->
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/latest/css/bootstrap.css">
        <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css">


        <script src="../requiredfunctions.js"></script>
<script type="text/javascript">
/// some script

// jquery ready start
$(document).ready(function() {
	// jQuery code

	//////////////////////// Prevent closing from click inside dropdown
    $(document).on('click', '.dropdown-menu', function (e) {
      e.stopPropagation();
    });

    // make it as accordion for smaller screens
    if ($(window).width() < 992) {
	  	$('.dropdown-menu a').click(function(e){
	  		e.preventDefault();
	        if($(this).next('.submenu').length){
	        	$(this).next('.submenu').toggle();
	        }
	        $('.dropdown').on('hide.bs.dropdown', function () {
			   $(this).find('.submenu').hide();
			})
	  	});
	}
	
	
	$(".dropdown-menu li a").on("click",function(){
    var href = $(this).attr('href');
    
    if(href != '#'){
        window.location = 'http://srishringarr.com/'+href;
    }
})



	
}); // jquery end
</script>

<style type="text/css">

.cart_anchor{
    position:relative;
}
.header-icons-noti{
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background-color: #111111;
    color: white;
    font-family: Montserrat-Medium;
    font-size: 12px;
    position: absolute;
    top: -15px;
    right: -19px;
}




	@media (min-width: 992px){
		.dropdown-menu .dropdown-toggle:after{
			border-top: .3em solid transparent;
		    border-right: 0;
		    border-bottom: .3em solid transparent;
		    border-left: .3em solid;
		}

		.dropdown-menu .dropdown-menu{
			margin-left:0; margin-right: 0;
		}

		.dropdown-menu li{
			position: relative;
		}
		.nav-item .submenu{ 
			display: none;
			position: absolute;
			left:100%; top:-7px;
		}
		.nav-item .submenu-left{ 
			right:100%; left:auto;
		}

		.dropdown-menu > li:hover{ background-color: #f1f1f1 }
		.dropdown-menu > li:hover > .submenu{
			display: block;
		}
	}
</style>
    <style>
        .pointer {cursor: pointer;}
        .block2-overlay{
            top: auto !important;
            left: auto !important;
        }
        
        .add_to_cart_btn{
            display:none;
        }
        .product_div:hover .add_to_cart_btn{
            display: block ! important;
            color:white;
            text-align:center;
            padding: 7px;
            margin-bottom: 10px;
        }
    </style>
    
</head>
<body class="bg-light">
    
<!-- ========================= SECTION CONTENT ========================= -->

<style>
@media (min-width: 992px){
.navbar-expand-lg {
    -ms-flex-flow: row nowrap;
    flex-flow: row nowrap;
    -ms-flex-pack: start;
    justify-content: center;
}    

.navbar-nav{
        width: 100%;
    display: flex;
    justify-content: center;
}
}

    .custom_fluid{
        display: flex;
    justify-content: center;
    margin: auto;
    }
    
    @media (min-width: 768px){
    .cust_logo{
        width:30%;
    }        
    nav.navbar{
        width:50%;
    }
    .header-icons{
            width: 20%;
        }
                    #web{
        position: sticky;
    top: 0;
    z-index: 1000;
    }


        #mobile{
            display:none;
        }
                #web{
background: white;
    padding-left: 2%;
    padding-right: 2%;
    display: flex;
        }
        .navbar-expand-lg{
                /*flex-flow: column;*/
        }
        .free_shipping_quotes{
        font-size: 20px;            
        }

    }
    
        @media (max-width: 768px){

        #web{
            display:none;
        }

        #mobile{
    display: flex;
    justify-content: space-between;
        background: white;
        }
        .nav-item{
            padding-left: 1%;
        }
        .nav-link{
            color: black;
        }
        .navbar-toggler{
background-color: white;
    border: 1px solid;
        }
        .topbar-social{
    padding-left: 15px;
    width: 80%;
        }
        .p-r-20{
                padding-right: 10px;
        }
        .topbar-child2{
            padding-right: 0;
    width: 20%;
        }
        .free_shipping_quotes{
            font-size:12px;
        }
        .collapse.show {
    display: block;
    width: 100%;
    padding: 1%;
    background: white;
    border: 1px solid #f8f9fa;
}
    }
    
    .navbar-expand-lg .navbar-nav .nav-link{
        color:black;
    }
    
    .wrap-slick1{
        z-index:-1;
    }

.dropdown-item{
        padding: 0.05rem 1.5rem;
}
</style>

<style>
.list-1 {
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-flex-wrap: wrap;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}
.list-1 li:first-child, .list-1 li:last-child {
    width: 50%;
}
.list-1 li {
    overflow: hidden;
    position: relative;
    width: 25%;
}
.list-1 img {
    width: 100%;
}
.list-1 li:first-child, .list-1 li:last-child {
    width: 50%;
}

@media (max-width: 767px)
{
.list-1 li {
    width: 100%;
}
.list-1 li:first-child, .list-1 li:last-child {
   width: 100%;
}

.item-slick1{
	height: 100px !important;
}

.slick-initialized .slick-slide{
	margin-top: 0 !important;
}

.slick1 .slick-slide .slick-initialized .slick-slider{
	margin-top: 0 !important;
}

.slick-list .draggable .slick-slide .slick-current .slick-active{
	margin-top: 0 !important;
}

.slick-slide{
	margin-top: 0 !important;
}

@media screen and (max-width:424px) {
    #mobileviewperfect {
        height:10%;
    }
}


</style>


<div class="topbar">
			    			    <div class="topbar-social">
					<a href="https://www.facebook.com/srishringarr/" target="_blank" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
					<a href="https://www.instagram.com/srishringarr/" target="_blank" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
					<!-- <a href="https://plus.google.com/u/1/113103807414319162517" target="_blank" class="fs-18 color1 p-r-20 fa social_googleplus"></a> -->
					<a href="https://twitter.com/SriShringarr" target="_blank" class="fs-18 color1 p-r-20 fa social_twitter"></a>
					<a href="https://in.pinterest.com/srishringarr/?eq=sri&amp;etslf=5839" target="_blank" class="fs-18 color1 p-r-20 fa social_pinterest"></a>
					<span style="font-weight: 700;color: #888888;"> <img src="assets/truck.png" style="height: 32px; "> <b class="free_shipping_quotes">Free Shipping To And Fro</b> </span>
				</div>
				<div class="topbar-child2">
					<form style="display:flex;" method="post" enctype="multipart/form-data" action="">
						<div class="topbar effect1 w-size9">
							<input type="text" class="topbar  s-text7 bg6 w-full" name="search" placeholder="Search.." value="">
							<span class="effect1-line"></span>
						</div>
						<input type="submit" class="search_btn" name="searchbtn" value="Search">
					</form>
		        </div> 
	        </div>
	        
	        
<div class="container-fluid custom_fluid" id="web">
    
    <div class="cust_logo">
        <a href="/">
            <img src="static/images/site/logo/main_logo.png" alt="Avatar"> 
        </a>
    </div>
    			
<nav class="navbar navbar-expand-lg">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="main_nav">

<ul class="navbar-nav">
    

	<li class="nav-item"><a href="index.php" class="nav-link" href="#"> Home </a></li>

	
	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href ="sub_category.php?type=2" data-toggle="dropdown">  Apparel  </a>
            <ul class="dropdown-menu">
						    <?php 
	        $qryjew=mysqli_query($con,"SELECT * FROM `garments` where `Main_id`=1 or `Main_id`=3");     
 	        while($rowjew=mysqli_fetch_array($qryjew)){  ?>
                  <li><a class="dropdown-item" href="list.php?id=<?php echo $rowjew[0];?>&type=2"><?php echo ucfirst(strtolower($rowjew[2])); ?></a></li>
            <?php } ?>

            </ul>
            
    </li>
								

	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">  Jewellery  </a>
	    <ul class="dropdown-menu">
  <?php  $qryjew = mysqli_query($con,"SELECT * FROM `jewel_subcat` where mcat_id=1 or mcat_id=3");     
                                			
                                		    while($rowjew=mysqli_fetch_array($qryjew)) {  
                                				$qryjew1=mysqli_query($con,"select * from subcat1  where maincat_id='$rowjew[0]' and status=1 order by name");
                                				
                                				$cnt = mysqli_num_rows($qryjew1); 	
                            					$i = 1;
                            					while($rowjew1=mysqli_fetch_row($qryjew1)) { 
                            						 
                            						if($cnt >1){ 
                            						    if($i==1){ ?>
                            						    <li>
                            							    <a class="dropdown-item" href="#"><?php echo ucwords($rowjew[2]); ?> &raquo </span></a>
                            							    <ul class="submenu dropdown-menu">
                            							<?php }  ?>
                                                            <li> <a class="dropdown-item" href="list.php?id=<?php echo $rowjew1[0];?>&type=1" ><?php echo ucwords(strtolower($rowjew1[2]))?></b></a></li>
                                                            
                                                        <?php if($i==$cnt){?>
                                                        
                                                            <li>
                                                                <!--<a href="sub_category.php?type=1&cid=<?php echo $rowjew[0];?>"><?php echo ucwords($rowjew[2]); ?></span></a>-->
                                                                <a class="dropdown-item" href="list.php?id=0&viewall=<?php echo $rowjew1[0];?>&type=1" >View All</a></li>
                                                        <?php echo '</ul></li>';} ?>
                            						<?php } else  { ?>
                                						
                                						<?php if($i==1){ ?>
                                						    <li><a class="dropdown-item" href="list.php?id=<?php echo $rowjew1[0];?>&type=1" ><?php echo ucfirst(strtolower($rowjew[2]))?></b></a></li>
                                						<?php } ?>
                            						
                            						<?php } ?>

                            						<?php  
                            						$i++;
                            					}  ?>
                                			<?php } ?>
	    </ul>
	</li>
	
	<li class="nav-item"><a href="contact_us.php" class="nav-link" >Contact Us</a> </li>
	
</ul>


  </div> <!-- navbar-collapse.// -->

</nav>

<style>
    .cart_account img{
        height:30px;
        width:30px;
    }
    .cart_account div{
        margin:auto 0;
        width: 25%;
    }
</style>
<div class="cart_account" style="display:flex;justify-content:flex-end; width:20%;"> 

        <div class="">  
            
                <a class="dropbtn" href="account/my-account.php">
                    <img src="assets/account.png" class="header-icon1" alt="ICON" <? if($_COOKIE['ss_email']){ ?>  title="Hello , <? echo $_COOKIE['ss_fname'];?>"  <? } else{ ?> title="Login / Signup" <?php }?>>
                </a>
            </div>
    
    <div class="" id="cartshowid"></div>
    
<? if($_SESSION['email']){ ?>
       <div>
           <a href="logout.php" style="color:black;">Logoout</a>
       </div> 
<? }?>

</div>

</div><!-- container //  -->




<div id="mobile">
    <div class="">
        <a href="/">
            <img src="static/images/site/logo/main_logo.png" alt="Avatar"> 
        </a>
    </div>    
    
    <nav class="navbar navbar-expand-lg" >




  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" style="    margin: auto;">
    <!--<span class="navbar-toggler-icon"></span>-->
    <img src="assets/menu.png" style="height: 20px; width: 20px;">
  </button>
</nav>


</div>


  <div class="collapse navbar-collapse" id="main_nav">

<ul class="navbar-nav">
    

	<li class="nav-item"><a href="index.php" class="nav-link" href="#"> Home </a></li>
	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href ="sub_category.php?type=2" data-toggle="dropdown">  Apparel  </a>
            <ul class="dropdown-menu">
						    <?php 
	        $qryjew=mysqli_query($con,"SELECT * FROM `garments` where `Main_id`=1 or `Main_id`=3");     
 	        while($rowjew=mysqli_fetch_array($qryjew)){  ?>
                  <li><a class="dropdown-item" href="list.php?id=<?php echo $rowjew[0];?>&type=2"><?php echo ucfirst(strtolower($rowjew[2])); ?></a></li>
            <?php } ?>

            </ul>
            
    </li>
								

	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">  Jewellery  </a>
	    <ul class="dropdown-menu">
  <?php  $qryjew = mysqli_query($con,"SELECT * FROM `jewel_subcat` where mcat_id=1 or mcat_id=3");     
                                			
                                		    while($rowjew=mysqli_fetch_array($qryjew)) {  
                                				$qryjew1=mysqli_query($con,"select * from subcat1  where maincat_id='$rowjew[0]' and status=1 order by name");
                                				
                                				$cnt = mysqli_num_rows($qryjew1); 	
                            					$i = 1;
                            					while($rowjew1=mysqli_fetch_row($qryjew1)) { 
                            						 
                            						if($cnt >1){ 
                            						    if($i==1){ ?>
                            						    <li>
                            							    <a class="dropdown-item" href="#"><?php echo ucwords($rowjew[2]); ?> &raquo </span></a>
                            							    <ul class="submenu dropdown-menu">
                            							<?php }  ?>
                                                            <li> <a class="dropdown-item" href="list.php?id=<?php echo $rowjew1[0];?>&type=1" ><?php echo ucwords(strtolower($rowjew1[2]))?></b></a></li>
                                                            
                                                        <?php if($i==$cnt){?>
                                                        
                                                            <li>
                                                                <!--<a href="sub_category.php?type=1&cid=<?php echo $rowjew[0];?>"><?php echo ucwords($rowjew[2]); ?></span></a>-->
                                                                <a class="dropdown-item" href="list.php?id=0&viewall=<?php echo $rowjew1[0];?>&type=1" >View All</a></li>
                                                        <?php echo '</ul>';} ?>
                            						<?php } else  { ?>
                                						
                                						<?php if($i==1){ ?>
                                						    <li><a class="dropdown-item" href="list.php?id=<?php echo $rowjew1[0];?>&type=1" ><?php echo ucfirst(strtolower($rowjew[2]))?></b></a></li>
                                						<?php } ?>
                            						
                            						<?php } ?>

                            						<?php  
                            						$i++;
                            					}  ?>
                                			<?php } ?>
	    </ul>
	</li>
		<li class="nav-item"><a href="contact_us.php" class="nav-link" >Contact Us</a> </li>
	
</ul>


  </div> <!-- navbar-collapse.// -->

<br><br><br>

    <div class="product-model">  
        <div class="container">
            
            
      
            <div class="row ">
                <div class="col-md-12 pay-info">
                    
                    
                    <?php if($status=='success'){
                        
                        
                        
                        
                        
                        
                        
                        // var_dump($_SESSION);
                        echo "<h3>Thank You, " . $firstname .".Your order status is ". $status .".</h3>";
                        echo "<h4>Your Transaction ID for this transaction is <span class='txn_id'>".$txnid.".</span></h4>"; ?>
                        <div id="primary" class="content-area">
                            <main id="main" class="site-main" role="main">
                                <article id="post-8" class="post-8 page type-page status-publish hentry">
                                    <div class="entry-content">
                                        <div class="woocommerce">
                                            <div class="woocommerce-order">
                                            <?php $sql=mysqli_query($conn,"select * from Order_ent where transaction_id='".$txnid."'");
                                            $sql_result=mysqli_fetch_assoc($sql);
                                            $order_id=$sql_result['id'];
                                            $date = $sql_result['date'];
                                            $total_amount=$sql_result['amount'];
                                            
                                            // echo "select * from order_details where order_id='".$order_id."' and ac_typ = '1'"; 
                                            
                                            ?>
                                            <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">
                                                <li class="woocommerce-order-overview__order order">
                                                    Order number:  <strong><? echo $order_id; ?></strong>
                                                </li>
                                                <li class="woocommerce-order-overview__date date">
                                                    Date:                   <strong><? echo date('d M Y', strtotime($date)); ?> </strong>
                                                </li>
                    
                                                <li class="woocommerce-order-overview__email email">
                                                    Email: <strong><? echo $email;?></strong>
                                                </li>
                                    
                                                <li class="woocommerce-order-overview__total total">
                                                    Total: <strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><? echo $total_amount ; ?></span></strong>
                                                </li>
                                            </ul>
                                
                                            <section class="woocommerce-order-details">
                                                <h2 class="woocommerce-order-details__title">Order details</h2>
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="woocommerce-table__product-name product-name">Product</th>
                                                            <th scope="col" class="border-0 bg-light">
                                                                <div class="py-2 text-uppercase">Booking Date</div>
                                                              </th>
                                                              <th scope="col" class="border-0 bg-light">
                                                                <div class="py-2 text-uppercase">Return Date</div>
                                                              </th>
                                                              
                                                              <th scope="col" class="border-0 bg-light">
                                                                <div class="py-2 text-uppercase">Deposit</div>
                                                              </th>
                                                              
                                  
                                                            <th class="woocommerce-table__product-table product-total">Total</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        
                                                        $sql=mysqli_query($conn,"select * from order_details where order_id='".$order_id."' and ac_typ = '1'");
                                                        // $sql=mysqli_query($conn,"select * from order_details where order_id='68'");
                                                        
                                                        $overall_amount = 0; 

                                                        while($sql_result=mysqli_fetch_assoc($sql)){
                                                        
                                                        $product_id=$sql_result['product_id'];
                                                        $type=$sql_result['product_type'];
                                                        
                                                        $total_amt=$sql_result['total_amt'];
                                                        $qty=$sql_result['qty'];
                                                        $name = get_sku($product_id,$type);
                                                        $image_url = $sql_result['image'];
                                                        $deposit_amt = $sql_result['deposit_amt'];
                                                        ?>
                                                
                                                        <tr class="woocommerce-table__line-item order_item">
                                                            <td class="woocommerce-table__product-name product-name">
                                                                <img src="<? echo $image_url; ?>" style="width:100px;">
                                                                <?php echo $name;?> <strong class="product-quantity">×&nbsp;<? echo $qty; ?></strong>
                                                            </td>
                                                            
                                                            <td ><strong><?php echo date('d M Y',strtotime($sql_result['rent_dt'])); ?></strong></td>
                                                            <td ><strong><?php echo date('d M Y',strtotime($sql_result['return_dt'])); ?></strong></td>
                                                            <td ><strong><?php echo $deposit_amt ;   if($sql_result['deposite_date']=='0000-00-00'){ }else{ echo '<p> To Be Paid On </p>' . date('d M Y',strtotime($sql_result['deposite_date'])); } ?></strong></td>


                                                            <td class="woocommerce-table__product-total product-total">
                                                                <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><? echo $total_amt; ?></span>
                                                            </td>
                                                        </tr>
                                                    <?php 
                                                    
                                                    $overall_amount = $overall_amount+$total_amt; 
                                                    } ?>
                                                </tbody>
                                            
                                                <tfoot>
                                                               
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th scope="row">Total:</th>
                                                        <td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><? echo $total_amount; ?></span></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </section>
                                    </div>
                                </div>
                            </div><!-- .entry-content -->
                        </article><!-- #post-## -->
                    </main><!-- #main -->
                </div>
                <?php
                // include ('avopdf/report.php');
                // include("sendmailwithattachment.php");
                // }
                  
                //delete everything from cart
                delete_from_cart($userid);
                    
                $_SESSION['pay_status']=true;
                
                
                
                
$usersql = mysqli_query($con,"select * from Registration where registration_id='".$userid."'");
$usersql_result = mysqli_fetch_assoc($usersql);

$fname = $usersql_result['Firstname'];
$mobile = $usersql_result['Mobile'];
$email = $usersql_result['email'];
$pincode = $usersql_result['pincode'];
$city  = $usersql_result['city'];
$city_sql = mysqli_query($con,"select * from cities where code = '".$city."'");
$city_sql_result = mysqli_fetch_assoc($city_sql);
$city = $city_sql_result['name'];



// $url = "https://www.xircls.com/api/v1/confirm_order/";
$url = "https://www.demo.xircls.in/api/v1/confirm_order/";

// $authentication_key  = "wDgmH6BS0B5s/tcOmfAqtRpbCw4VyghEcwcXqwRT2FI="; // pass the api key given
$authentication_key  = 'wDgmH6BS0B5s/tcOmfAqtdHSmnw7MBRsKOT0Yc+500I=';


$head = [
	'Authorization: '.$authentication_key,
	'Content-Type: application/x-www-form-urlencoded'
];



$mobile = '+91'.$mobile ;
        $discounted_amount = $total_amount +$total_amoun ; 

		$data = array(
                    "customer_first_name"=> $fname, 
                    "customer_mobile"=>$mobile, 
                    "customer_email"=>$email,
                    "merchant_ref_code"=>$coupon_code,                // If code is applied pass the code
                    "pincode"=>$pincode,
                    "city"=>$city,
                    "country"=> "India",
                    "price_before_apply_offer"=>$total_amount,
                    "price_after_apply_offer"=>$discounted_amount,         //If code is appiled pass the value after code applied
			);
					
				     $string = http_build_query($data);
				    
        $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
		$response = curl_exec($ch);
		curl_close($ch);
		
		$response_obj = json_decode($response);
		
                
            } else {
                echo "<h3>Something went Wrong !! </h3>";
                echo "<h4>Please try Again !</h4>";
                $sql=mysqli_query($conn,"select * from cart where user_id='".$userid."'");

                while($sql_result=mysqli_fetch_assoc($sql)){
                    
                    $cart_product_id = $sql_result['product_id'];
                    $cart_product_type = $sql_result['product_type'];
                    $cart_quantity = $sql_result['qty'];
                    
                    $sku=get_sku($cart_product_id,$cart_product_type);
                    
                    $pos_sql=mysqli_query($con3,"select * from phppos_items where name='".$sku."'");
                    $pos_sql_result=mysqli_fetch_assoc($pos_sql);
                
                    $quantity=$pos_sql_result['quantity'];
                    $new_quantity=$quantity+$cart_quantity;
                    $new_quantity = sprintf("%.2f", $new_quantity);
                    $update="update phppos_items set quantity='".$new_quantity."' where name LIKE '".$sku."'";
                    mysqli_query($con3,$update);
                }

                $_SESSION['pay_status']=false;
                
unset($_SESSION['delivery']);
unset($_SESSION['pickup']);
            }  ?>  
            <div > </div>              
        </div>
    </div>
</div>
<!---->
<?php include('../footer.php')?>
</div>  

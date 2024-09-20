<?php session_start();

function get_product_from_cart($userid){
    
    global $con;
    
    $sql=mysqli_query($con,"select product_id from cart where user_id='".$userid."'");
   
    while($sql_result=mysqli_fetch_assoc($sql)){
        
        $product_id[]=$sql_result['product_id'];
    

    }
    return $product_id;    // returns array

}


function get_discount($productid,$type){
    
    global $conn;
    
    if($type==2){
        
        $sql=mysqli_query($conn,"select * from garment_product where gproduct_id='".$productid."'");
        
        $sql_result=mysqli_fetch_assoc($sql);
        
        $discount = $sql_result['discount'];
        
        return $discount;
        
    }
    else{
        
        $sql=mysqli_query($conn,"select * from product where product_id='".$productid."'");
        
        $sql_result=mysqli_fetch_assoc($sql);
        
        $discount = $sql_result['discount'];
        
        return $discount;
        
        
    }

}

function get_cart_info($cartid){
    global $con;
    
    $sql = mysqli_query($con,"select * from cart where cart_id='".$cartid."' and ac_typ=2");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    return array($sql_result['rent_dt'],$sql_result['return_dt'],$sql_result['deposit_amt'],$sql_result['total_amt']);
}


function cartcount(){
    global $con,$userid;
    

$usersql = mysqli_query($con,"select * from cart where user_id ='".$userid."'");
$usersql_result = mysqli_num_rows($usersql);

if($usersql_result>0){
        
        $sql = mysqli_query($con,"select sum(qty) as total from cart where user_id='".$userid."' and ac_typ='2'");
            if($sql_result = mysqli_fetch_assoc($sql)){        
                return $sql_result['total'];        
            }else{
                return 0 ; 
            }
        
    
}else{
    return 0;
}
    
}


function get_sku($product_id,$type){
    
    global $con;
    
             if($type==2){
            
                $sql=mysqli_query($con,"SELECT gproduct_code FROM `garment_product` WHERE gproduct_id = '".$product_id."'");
                
                $sql_result=mysqli_fetch_assoc($sql);
                
                $sku=$sql_result['gproduct_code'];
                return $sku;
            
                
            }
             else {
                
                $sql=mysqli_query($con,"SELECT * FROM product WHERE product_id = '".$product_id."'");
                
                $sql_result=mysqli_fetch_assoc($sql);
                
                $sku=$sql_result['product_code'];
                
                return $sku;
            
            }

return;
   
}
function get_product_from_cart_by_cartid($cartid){
    
    global $con;
    
    $sql=mysqli_query($con,"select product_id from cart where cart_id='".$cartid."' and ac_typ='2'");
   
    $sql_result=mysqli_fetch_assoc($sql);
        
    $product_id=$sql_result['product_id'];
        
    return $product_id;

}

function get_product_type_from_cart($cartid,$userid){
    
    global $con;
    
    $sql=mysqli_query($con,"select * from cart where cart_id='".$cartid."' and user_id='".$userid."' and ac_typ='2'");
   
    $sql_result=mysqli_fetch_assoc($sql);
        
        $product_type=$sql_result['product_type'];
        
    return $product_type;

}

function get_product_type_by_productid($productid,$userid){

    global $con;
    
    $sql=mysqli_query($con,"select * from cart where product_id='".$productid."' and user_id='".$userid."'");
   
    $sql_result=mysqli_fetch_assoc($sql);
        
        $product_type=$sql_result['product_type'];
        
    return $product_type;
    
}

function get_cart_ids($userid){
    global $con;
    
    $sql=mysqli_query($con,"select * from cart where user_id='".$userid."' and ac_typ=2");
    while($sql_result=mysqli_fetch_assoc($sql)){
        $cart_id[]=$sql_result['cart_id'];   
    }
    return $cart_id;
}


function get_product_amt_by_cart_id($cartid){

    global $con;
    
    $sql=mysqli_query($con,"select * from cart where cart_id='".$cartid."' and ac_typ=2");
    
    $sql_result=mysqli_fetch_assoc($sql);
    
    $cart_total=$sql_result['product_amt'];
    
    return $cart_total;
}

function get_cart_quantity($cartid){
    
    global $con;
    
    $sql=mysqli_query($con,"select * from cart where cart_id='".$cartid."' and ac_typ=2");
    
    while($sql_result=mysqli_fetch_assoc($sql)){
        
        $cart_quantity=$sql_result['qty'];
        
    }
    
    return $cart_quantity;
    
}

function delete_from_cart($userid){
    global $con;
    
    $delete="delete from cart where user_id='".$userid."' and ac_typ=2";
    
    mysqli_query($con,$delete);
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

// $orderId will get from parent verify.php page

$id = $_SESSION['orderid'] ; 
$ss_shopping_order_id=$id ; 
$orders = $api->order->fetch($orderId)->payments();
$orderinfo = $orders['items'][0];
$razor_status = $orderinfo->status ; 
$email=$_SESSION['email'];
$delivery_add = $_SESSION['delivery'];
$pickup_add = $_SESSION['address'];
$amount= $_SESSION['total_amount'];
$coupon = $_SESSION['coupon_code'];

$firstname = $_COOKIE['ss_fname'] ; 
if(!isset($coupon)){
    $coupon='';
}
    
if($razor_status=='captured'){
    
    
    try{

        $sql  = "update Order_ent set amount ='".$amount."', razorpay_payment_id = '".$razorpay_payment_id."',date = '".$datetime."',delivery_add='".$delivery_add."' , pickup_add = '".$pickup_add."' , 
        acc_type ='2',coupon_code='".$coupon."',razor_status = '".$razor_status."',razorpay_order_id ='".$orderId."'
        where id = '".$ss_shopping_order_id."'" ;        
        
        
        mysqli_query($con,$sql);
        
        $txnid = str_replace('order_','',$orderId);
        
        
        // Get and set order details
        
        $select_sql = mysqli_query($con,"select * from order_details where order_id = '".$ss_shopping_order_id."'");

        if($select_sql_result=mysqli_fetch_assoc($select_sql)){
            
        }else{

        $id_sql = mysqli_query($con,"select * from Order_ent where id = '".$id."'"); 
        $id_sql_result = mysqli_fetch_assoc($id_sql);
        $userid = $id_sql_result['user_id'];
        
        $crtids=get_cart_ids($userid);
        
        foreach($crtids as $key => $val) {
            
            $qty=get_cart_quantity($val);
            $product_amt=get_product_amt_by_cart_id($val);
            $rental_date = get_cart_info($val);
            
            
            $cart_sql = mysqli_query($con,"select * from cart where cart_id='".$val."'");
            $cart_sql_result = mysqli_fetch_assoc($cart_sql);
            
            $product_image = $cart_sql_result['image']; 
            $deposit_date = $cart_sql_result['deposite_date'];
            $total_amount_ = $product_amt*$qty;
            
           $insert_order_details = "insert into order_details(order_id,cart_id,user_id,product_type,product_id,qty,product_amt,total_amt,date,status,ac_typ,custom_data,rent_dt,return_dt,deposit_amt,image,deposite_date) VALUES 
           ('".$id."','".$val."','".$userid."','".get_product_type_from_cart($val,$userid)."','".get_product_from_cart_by_cartid($val)."','".$qty."','".$product_amt."','".$total_amount_."','".date('Y/m/d h:i:s')."','".'1'."','2','".$custom_data."','".$rental_date[0]."','".$rental_date[1]."','".$rental_date[2]."','".$product_image."','".$deposit_date."')";


            if(mysqli_query($con,$insert_order_details)){
                $order_detail = $con->insert_id ; 
                $payable_deposite = "insert into payable_deposit(userid,order_ent,order_detail,amount,is_complete,created_at) values('".$userid."','".$id."','".$order_detail."','".$product_amt."','0','".date('Y/m/d h:i:s')."')";
                mysqli_query($con,$payable_deposite);
            }else{
                $err=1 ; 
            }                
            
        }
    
    $total_amount = $amount; 
    // POS TABLE 
     
    //  Check POSPEOPLE  
    
    $people_sql = mysqli_query($con3,"Select * from phppos_people where person_id ='".$userid."'");
    if($people_sqlresult = mysqli_fetch_assoc($people_sql)){
        // echo 'person if';    
        
    }else{        

        $get_people =mysqli_query($con,"SELECT * FROM `Registration` WHERE `registration_id` = '".$userid."'");
        $get_people_result = mysqli_fetch_assoc($get_people);


        $first_name = $get_people_result['Firstname'];
        $last_name = $get_people_result['Lastname'];
        $phone_number = $get_people_result['Mobile'];
        $email = $get_people_result['email'];
        $address_1 = $get_people_result['address'];
        $city = $get_people_result['city'];
        $state = $get_people_result['state'];
        $zip = $get_people_result['pincode'];
        $country = $get_people_result['country'];
        $person_id = $userid;
        $acc_type = 2;


        $insert_people = "insert into phppos_people(first_name,last_name,phone_number,email,address_1,city,state,zip,person_id,acc_type) 
        values('".$first_name."','".$last_name."','".$phone_number."','".$email."','".$address_1."','".$city."','".$state."','".$zip."','".$person_id."','".$acc_type."')";
        if(mysqli_query($con3,$insert_people)){
        }else{
            $err=1; 
        }
    }
     
        $approval_sql = "insert into approval(cust_id,bill_date,status,paid_amount,transaction_id,bill_by,typ) 
                values('".$userid."','".$date."','S','".$product_amt."','".$txnid."','online','1')"; 
                mysqli_query($con3,$approval_sql);
        
        $approval_id = $con3->insert_id;
        
        foreach($crtids as $key => $val){
            
            $qty=get_cart_quantity($val);
            $product_amt=get_product_amt_by_cart_id($val);
            
            $pro_type=get_product_type_from_cart($val,$userid);
            $product_id = get_product_from_cart_by_cartid($val);
            $sku=get_sku($product_id,$pro_type);
            
            $total_amount_ = $qty*$product_amt;
            
            $approval_detail = "insert into approval_detail(bill_id,item_id,qty,aid,amount,item_per,final_amount)
            values('".$approval_id."','".$sku."','".$qty."','".$product_id."','Rs','".$total_amount_."')";
            mysqli_query($con3,$approval_detail);
        }
        
        // INSERT INTO `phppos_rent`

        $pos_insert = "insert into phppos_purchase(bill_id,date,totalamt) 
                    values('".$id."','".$date."','".$amount."')";
        if(mysqli_query($con3,$pos_insert)){
            $pos_purchase_id = $con3->insert_id ;
            
            foreach( $crtids as $key => $val ) {
                
                $qty=get_cart_quantity($val);
                $product_amt=get_product_amt_by_cart_id($val);
                
                $purchase_details_sql = "insert into phppos_purchase_details(pur_id,item_id,qty,price) 
                values('".$pos_purchase_id."','".get_product_from_cart_by_cartid($val)."','".$qty."','".$product_amt."')";
                
            }
            
        }
            $phppos_rent_id = $pos_purchase_id ; 
            
        $crtids=get_cart_ids($userid);
        
        // $state_id = state_id_userid($userid);
        
         foreach($crtids as $key => $val){
            
            $qty=get_cart_quantity($val);
            $product_amt=get_product_amt_by_cart_id($val);
            $pro_type=get_product_type_from_cart($val,$userid);
            $product_id = get_product_from_cart_by_cartid($val);
            $sku=get_sku($product_id,$pro_type);
            $discount = get_discount($product_id,$pro_type);
            $rental_date = get_cart_info($val);
            
            if($phppos_rent_id > 0){
                    // INSERT POS order_detail
                    $product_total = $qty*$product_amt ; 
                    mysqli_query($con3,"insert into order_detail(bill_id,item_id,rent,deposit,qty,total_amount,pickup_date,return_date) 
                    values('".$phppos_rent_id."','".$sku."','".$product_amt."','".$rental_date[2]."','".$qty."','".$product_total."','".$rental_date[0]."','".$rental_date[1]."')");
                    
                    // END INSERT POS order_detail            
                    
                    
                    $insert_paid_amount = "insert into paid_amount(bill_id,amount,payment_by,bid) values('".$userid."','".$total_amount."','ONLINE','".$phppos_rent_id."')";
                    mysqli_query($con3,$insert_paid_amount);
            }else{
                
                // Escalation Email to reduce quantity manually 
                
                $toemail = 'vishwaaniruddh@gmail.com';
                $sub = 'Quantity Issue In POS'; 
                
                    $headers_esc='';
                        $headers_esc .= "Reply-To: The Sender sales@yosshitaneha.com\r\n"; 
                        $headers_esc .= "Return-Path: The Sender sales@yosshitaneha.com\r\n"; 
                        $headers_esc .= "From: Escalation Yosshitaneha Fashion Studio <sales@yosshitaneha.com>" ."\r\n" .
                        $headers_esc .= "Organization: Sender Organization\r\n";
                        $headers_esc .= "MIME-Version: 1.0\r\n";
                        $headers_esc .= "Content-type: text/html; charset=utf-8\r\n";
                        $headers_esc .= "X-Priority: 3\r\n";
                        $headers_esc .= "X-Mailer: PHP". phpversion() ."\r\n" ;
                        
                           $link = $sub ; 
                           mail($toemail, $sub, $link, $headers_esc,'-f sales@yosshitaneha.com -F "Yosshitaneha Fashion Studio"') ; 
                        

            }

         }
// Email 
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
																[Order #'.$id.'] ('.date('Y/m/d h:i:s').')</h2>

															<div style="margin-bottom:40px">
																<table cellspacing="0" cellpadding="6" border="1" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">
															<thead><tr>
                															<th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Product</th>
                															<th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Quantity</th>
																			<th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Price</th>
																		</tr></thead>';
																		
                                                                                                                                    
                                                            $sql=mysqli_query($con,"select * from order_details  where order_id='".$id."' and ac_typ ='2'");
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
															<a href="https://yosshitaneha.com/checkout/Invoice.php?oid='.$id.'" >Click here to View/download Bill</a>
                                                                                                                        
                                                            <h3>Enjoy Unlimited Unique Fashion Products !<h3>
                                                            <p>Visit <b><a href="https://yosshitaneha.com/">YosshitaNeha</a></b></p>


                                                            <a style="border-radius:0px;font-size:16px;color:#fff;padding:11px 50px;max-width:500px;font-family:Atlas Grotesk,Open Sans,HelveticaNeue-Light,Helvetica Neue Light,Helvetica Neue,Helvetica,Arial,Lucida Grande,sans-serif;border:0px solid #0061ff;text-align:center;text-decoration:none;font-weight:300;display:block;background-color:#0061ff" href="https://www.yosshitaneha.com/account/redirect.php?id='.$userid.'" data-saferedirecturl="https://www.google.com/url?q=https://www.dropbox.com/l/AABWjooGQaWoHtoVAS-WNXojMuESi-3AWkk/transfer&amp;source=gmail&amp;ust=1599233688458000&amp;usg=AFQjCNFvNdMIywplnetehOofv4MityU2Kg">
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
    $headers .= "Reply-To: The Sender sales@yosshitaneha.com\r\n"; 
    $headers .= "Return-Path: The Sender sales@yosshitaneha.com\r\n"; 
    $headers .= "From: Yosshitaneha Fashion Studio <sales@yosshitaneha.com>" ."\r\n" .
    $headers .= "Organization: Sender Organization\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
    
            
    if(mail($to, "Thanks You For Shopping At Yosshitaneha", $link, $headers,'-f sales@yosshitaneha.com -F "Yosshitaneha Fashion Studio"')){
        mail('yosshita.neha@gmail.com', "Thanks You For Shopping At Yosshitaneha", $link, $headers,'-f sales@yosshitaneha.com -F "Yosshitaneha Fashion Studio"');
        mail('rajanipodar@gmail.com', "Thanks You For Shopping At Yosshitaneha", $link, $headers,'-f sales@yosshitaneha.com -F "Yosshitaneha Fashion Studio"');
        mail('vishwaaniruddh@gmail.com', "Thanks You For Shopping At Yosshitaneha", $link, $headers,'-f sales@yosshitaneha.com -F "Yosshitaneha Fashion Studio"');
        
    }        
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
		
		
}
}
catch(Exception $e){
    
if($err==1){
        $con->rollback();
        $con3->rollback();    
}
}
		delete_from_cart($userid);
}

//return;
?>

<? include($_SERVER["DOCUMENT_ROOT"].'/header.php') ;?>

<div class="container">

    <br><br>
    <div class="row ">
        <div class="col-md-12 pay-info">


            <?php if($success=='success'){
                        
                        $id = $_SESSION['orderid'] ; 
                        
                        // var_dump($_SESSION);
                        echo "<h3>Thank You, " . $firstname ." . Your Order is successfully placed !</h3>";
                        echo "<h4>Your Transaction ID for this transaction is <span class='txn_id'>".$txnid.".</span></h4>"; ?>
            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">
                    <article id="post-8" class="post-8 page type-page status-publish hentry">
                        <div class="entry-content">
                            <div class="woocommerce">
                                <div class="woocommerce-order">
                                    <?php
                                            
                                            $sql=mysqli_query($con,"select * from Order_ent where id='".$id."'");
                                            
                                            $sql_result=mysqli_fetch_assoc($sql);
                                            
                                            
                                            
                                            $order_id=$sql_result['id'];
                                            $date = $sql_result['date'];
                                            $total_amount=$sql_result['amount'];
                                            
                                            // echo "select * from order_details where order_id='".$order_id."' and ac_typ = '1'"; 
                                            
                                            ?>
                                    <ul
                                        class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">
                                        <li class="woocommerce-order-overview__order order">
                                            Order number: <strong>
                                                <? echo $id; ?>
                                            </strong>
                                        </li>
                                        <li class="woocommerce-order-overview__date date">
                                            Date: <strong>
                                                <? echo date('d M Y', strtotime($date)); ?>
                                            </strong>
                                        </li>

                                        <li class="woocommerce-order-overview__email email">
                                            Email: <strong>
                                                <? echo $email;?>
                                            </strong>
                                        </li>

                                        <li class="woocommerce-order-overview__total total">
                                            Total: <strong><span class="woocommerce-Price-amount amount"><span
                                                        class="woocommerce-Price-currencySymbol">₹</span>
                                                    <? echo $total_amount ; ?>
                                                </span></strong>
                                        </li>
                                    </ul>

                                    <section class="woocommerce-order-details">
                                        <h2 class="woocommerce-order-details__title">Order details</h2>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="woocommerce-table__product-name product-name">Product
                                                    </th>
                                                    <th scope="col" class="border-0 bg-light">
                                                        <div class="py-2 text-uppercase">Date</div>
                                                    </th>



                                                    <th class="woocommerce-table__product-table product-total">Total
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                        
                                                        $sql=mysqli_query($con,"select * from order_details where order_id='".$order_id."' and ac_typ = '2'");
                                                        // $sql=mysqli_query($con,"select * from order_details where order_id='68'");
                                                        
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
                                                        <?php echo $name;?> <strong class="product-quantity">×&nbsp;
                                                            <? echo $qty; ?>
                                                        </strong>
                                                    </td>

                                                    <td><strong><?php echo date('d M Y',strtotime($sql_result['date'])); ?></strong>
                                                    </td>



                                                    <td class="woocommerce-table__product-total product-total">
                                                        <span class="woocommerce-Price-amount amount"><span
                                                                class="woocommerce-Price-currencySymbol">₹</span>
                                                            <? echo $total_amt; ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <?php 
                                                    
                                                    $overall_amount = $overall_amount+$total_amt; 
                                                    } ?>
                                            </tbody>

                                            <tfoot>

                                                <tr>
                                                    <th></th>

                                                    <th scope="row">Total:</th>
                                                    <td><span class="woocommerce-Price-amount amount"><span
                                                                class="woocommerce-Price-currencySymbol">₹</span>
                                                            <? echo $total_amount; ?>
                                                        </span></td>
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
                    

		
                
            } else {
                echo "<h3>Something went Wrong !! </h3>";
                echo "<h4>Please try Again !</h4>";
                $sql=mysqli_query($con,"select * from cart where user_id='".$userid."'");

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
            <div> </div>
        </div>
    </div>
</div>
<!---->

<br><br>

</div>
<?php include('footer.php')?>
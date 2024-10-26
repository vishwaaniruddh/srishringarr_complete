<?php include('header.php');


$currency = $_SESSION['cur'];

function currencyAmount($currency,$product_amount){
    
    global $con; 
    
    if($currency=='INR'){
        return $product_amount ; 
    }else{
    
        $cur_sql = "select * from conversion_rates where currency ='".$currency."'";
        $sql1 = mysqli_query($con,"select * from conversion_rates where currency ='".$currency."'");
        $sql1_result = mysqli_fetch_assoc($sql1);
        $rate = $sql1_result['rate'];
        $product_amount = $rate*$product_amount ;
        return round($product_amount,2) ;   
    }
}



?>

<style>
    .table thead th {
    vertical-align: top;

}
</style>



<script>
    function remove_from_cart(productid,usrid) {
      $.ajax({
           type: "POST",
           url: 'remove_from_cart.php',
           data: 'productid='+productid+'&usrid='+usrid,
           success:function(msg) {
               if(msg == 1){
                    swal("Product Removed Successfully");
                    setTimeout(function(){ location.reload(); },
                    2000); 
               } else {
                   swal("Product Not Removed  !! ");
                    setTimeout(function(){ location.reload(); },
                    2000);
               }
                
            }
        });
    }
 
    function add_one_cart(productid,usrid,sku) {
        $.ajax({
           type: "POST",
           url: 'cart/add_one_cart.php',
           data: 'productid='+productid+'&usrid='+usrid+'&sku='+sku,
           success:function(msg) {
                console.log(msg);
                if(msg==2){
                    swal('Insufficient Quantity.');
                }else{
                    location.reload();                    
                }
 
            }
        });
        return;
    }
    function remove_one_cart(productid,usrid,sku) {
        $.ajax({
           type: "POST",
           url: 'cart/remove_one_cart.php',
           data: 'productid='+productid+'&usrid='+usrid+'&sku='+sku,
           success:function(msg) {
                console.log(msg);
                 location.reload(); 
            }
        });
        return;
    }

</script>
<script>
    function showcart() {
        $("#cart").toggle();
    }
    
    function detail(sid,typ,subcattyp,transtyp,maincatid,subcatid)
    {
        var s=1009;
        var typ =2;
        var subcattyp =2;
        var transtyp=2;
        var maincatid = 8;
        var subcatid =0;

        window.open('sdets1.php?slkd='+s+'&slpyt='+typ+'&psbctp='+subcattyp+'&ptrp='+transtyp+'&dmctd='+maincatid+'&dsd='+subcatid,'_self');
    }

</script>	

<body>
    
    <div class="container-fluid">

        <?php

        
        $strPage = $_POST['Page'];
        $cartfinalids="";

        $View123 =mysqli_query($con,"select * from cart where ac_typ=1 and  user_id='".$userid."' and status=0");
        while($vefetcharr=mysqli_fetch_array($View123))
        {
            if($cartfinalids=="")
            {
                $cartfinalids=$vefetcharr[0];
            }else
            {
                $cartfinalids=$cartfinalids.",".$vefetcharr[0];
            }
        }
        
        $i=1;
        $tl=0;
        
        $qrycnt=mysqli_query($con,"select count(cart_id) from cart  where ac_typ=1 and user_id='".$userid."' and status=0");
        $fetchcnt=mysqli_fetch_array($qrycnt);
        
        $View = "select * from cart where ac_typ=1 and user_id='".$userid."' and status=0";
        $table=mysqli_query($con,$View);
        
        $Num_Rows = mysqli_num_rows($table);
        
        //echo $View;
        ?>
        <div align="center" style="display:none" > Records Per Page : 
            <select name="perpg" id="perpg" onChange="funcs('1','perpg');"><br>
                <?php
                for($i=1;$i<=$Num_Rows;$i++)
                {
                    if($i%10==0)
                    { ?>
                        <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
                    <?php }
                } ?>
                <option value="<?php echo $Num_Rows; ?>"><?php echo "All"; ?></option>
            </select>
        </div>
        <?php
        if(isset($_GET['page']) && $_GET['page']=='all'){
            $View = "select * from cart where ac_typ=1 and user_id='".$userid."' and status=0";
        } else {
        // pagins
        //echo $_POST['perpg'];
        $Per_Page =$_POST['perpg'];   // Records Per Page
        $Per_Page =12;
         
        //echo $Per_Page;
        $Page = $strPage;
        if($strPage=="")
        {
        	$Page=1;
        }
         
        $Prev_Page = $Page-1;
        $Next_Page = $Page+1;
        
        $Page_Start = (($Per_Page*$Page)-$Per_Page);
        if($Num_Rows<=$Per_Page)
        {
        	$Num_Pages =1;
        }
        else if(($Num_Rows % $Per_Page)==0)
        {
        	$Num_Pages =($Num_Rows/$Per_Page) ;
        }
        else
        {
        	$Num_Pages =($Num_Rows/$Per_Page)+1;
        	$Num_Pages = (int)$Num_Pages;
        }
        //$View.=" ORDER BY cust ASC ";
        $View.=" LIMIT $Page_Start , $Per_Page";
        $qrys=mysqli_query($con,$View);
        }	
        // echo $View;
        ?>
        
        
        <style>
        .cart-total {
  /* New styles */
  display: flex;
  justify-content: space-between;
  font-weight: bold;
  margin-top: 1rem;
}

.checkout-btn {
  /* New styles */
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 4px;
  padding: 1rem 2rem;
  font-size: 1rem;
  cursor: pointer;
  margin-top: 1rem;
}

.checkout-btn:hover {
  /* New styles */
  background-color: #0056b3;
}



            .woocommerce-info {
    border-top-color: #1e85be;
}

.woocommerce-error, .woocommerce-info, .woocommerce-message {
    padding: 1em 2em 1em 3.5em;
    margin: 0 0 2em;
    position: relative;
    background-color: #f7f6f7;
    color: #515151;
    border-top: 3px solid #e6be6e;
    list-style: none outside;
    width: auto;
    word-wrap: break-word;
}
.woocommerce-info::before {
    color: #1e85be;
}
.woocommerce-error::after, .woocommerce-info::after, .woocommerce-message::after {
    clear: both;
}
.woocommerce-error::after, .woocommerce-error::before, .woocommerce-info::after, .woocommerce-info::before, .woocommerce-message::after, .woocommerce-message::before {
    content: " ";
    display: table;
}


.woocommerce-error::before, .woocommerce-info::before, .woocommerce-message::before {
    font-family: WooCommerce;
    content: "\e028";
    display: inline-block;
    position: absolute;
    top: 1em;
    left: 1.5em;
}
.woocommerce-error::after, .woocommerce-error::before, .woocommerce-info::after, .woocommerce-info::before, .woocommerce-message::after, .woocommerce-message::before {
    content: " ";
    display: table;
}



.woocommerce form.checkout_coupon, .woocommerce form.login, .woocommerce form.register {
    border: 1px solid #d3ced2;
    padding: 20px;
    margin: 2em 0;
    text-align: left;
    border-radius: 5px;
}


.woocommerce form .form-row {
    padding: 3px;
    margin: 0 0 6px;
}

.woocommerce form .form-row-first, .woocommerce-page form .form-row-first {
    float: left;
}
.woocommerce form .form-row-first, .woocommerce form .form-row-last, .woocommerce-page form .form-row-first, .woocommerce-page form .form-row-last {
    width: 47%;
    overflow: visible;
}
.pb-5, .py-5 {
    padding-bottom: 1rem!important;
}
.pt-5, .py-5 {
    padding-top: 1rem!important;
}
p {
    margin-top: 0;
    margin-bottom: 0;
}
        </style>

        <div class=" cart-items">
            <!--<h3>My Shopping Bag (<?php echo $fetchcnt[0];?>)</h3>-->
            <div class="px-4 px-lg-0">
            <!-- For demo purpose -->
            <!--<div class="text-white py-5 text-center"> </div>-->
            <!-- End -->
            
            
            
<? 
 $total_deposite = 0 ;
 $total_rental = 0; 
 $get_cart_sql=mysqli_query($con,"SELECT * from cart where ac_typ=1 and user_id='".$userid."'");
    while($get_cart_sql_result=mysqli_fetch_array($get_cart_sql)){ 
$productid=$get_cart_sql_result['product_id'];
$quantity=$get_cart_sql_result['qty'];
$type=$get_cart_sql_result['product_type'];
$return_date = $get_cart_sql_result['return_dt'];
$image = $get_cart_sql_result['image'];
$booking_date = $get_cart_sql_result['rent_dt'];
$deposite_date = $get_cart_sql_result['deposite_date'];

$total_rental +=  $quantity * $get_cart_sql_result['product_amt'];
}

?>    

                            
                            
                            
                            
            
 
         <?
         
         $is_cart_count=mysqli_query($conn,"SELECT * from cart where ac_typ=1 and user_id='".$userid."'"); 
         
         $is_cart_count_result=mysqli_fetch_assoc($is_cart_count);
         
         
         if($is_cart_count_result){ ?>
<div class="woocommerce-form-coupon-toggle" style="user-select: auto;">
	
	<div class="woocommerce-info" style="user-select: auto;">
		Have a coupon? <a href="#" id="showcoupon" class="showcoupon" style="user-select: auto;">Click here to enter your code</a>	</div>
</div>             
         <? } ?>   




<style>
    .overlay {
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    position: fixed;
    background: #222222b3;
        z-index: 1000;
}

.overlay__inner {
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    position: absolute;
}

.overlay__content {
    left: 50%;
    position: absolute;
    top: 50%;
    transform: translate(-50%, -50%);
}

.spinner {
    width: 75px;
    height: 75px;
    display: inline-block;
    border-width: 2px;
    border-color: rgba(255, 255, 255, 0.05);
    border-top-color: #fff;
    animation: spin 1s infinite linear;
    border-radius: 100%;
    border-style: solid;
}

@keyframes spin {
  100% {
    transform: rotate(360deg);
  }
}
</style>
<!--<div class="overlay" >-->
<div class="overlay" id="loader" style="display:none;">
    <div class="overlay__inner">
        <div class="overlay__content">
            <h4 style="color:white;">
            Please Wait ..    
            </h4>
            <span class="spinner"></span></div>
    </div>
</div>







<form id="couponform" class="checkout_coupon woocommerce-form-coupon" method="post" style=" padding: 30px;border: 1px solid gray; display:none;" action="xircle.php">
    <input type="hidden" id="userid" name="userid" value="<? echo $userid; ?>">
    <input type="hidden" id="total_price" name="total_price" value="<? echo $total_rental; ?>">
    <p>If you have a coupon code, please apply it below.</p>
    <div class="row">
        <div class="col-sm-6">
    		<input type="text" id="coupon_code" name="coupon_code" class="form-control" placeholder="Coupon code" style="border: 1px solid lightgrey !important;" autocomplete="off">        
        </div>
        <div class="col-sm-6">
    		<input type="submit" name="coupon_submit" class="btn btn-dark" value="Apply">        
        </div>
        
    </div>
    <br>
    <div id="coupon_msg"></div>

</form>





<script>

$(function () {

        $('#couponform').on('submit', function (e) {


$("#loader").css('display','block');
e.preventDefault();

var userid = $("#userid").val();
var total_price = $("#total_price").val();
var  coupon_code= $("#coupon_code").val();

          $.ajax({
            type: 'post',
            url: 'xircle.php',
            data: 'userid='+userid+'&&total_rental='+total_price+'&&coupon_code='+coupon_code,
            success: function (msg) {
                    if(msg>2){
                        // alert('successfully Applied Coupne');
                        $(".total_rental").html(msg);
                        $("#total_rental").val(msg);
                        $("#loader").css('display','none');
                        $("#coupon_msg").html('<div class="alert alert-success" role="alert">Coupon Succesfully Applied . </div>');
                        
                    }else if(msg==0){
                        // alert('Error In Applied Coupne');
                        $("#loader").css('display','none');
                        $("#coupon_msg").html('<div class="alert alert-danger" role="alert">Error While Applying Coupon .</div>');
                    }else if(msg==2){
                        // alert('Not In The Criteria');
                        $("#loader").css('display','none');
                        $("#coupon_msg").html('<div class="alert alert-info" role="alert">Invalid Coupon Code.</div>');
                    }
            }
          });

        });

      });
      
      
      
      
$('#showcoupon').click(function(){
    $(".checkout_coupon").toggle();
  });
  

</script>










        <form action ="razorpay/confirmShipping.php" method="post" style="margin: 2% auto;">
        	<input type="hidden" name="slkd" value="<?php echo $_POST['slkd']; ?>">
            <input type="hidden" name="psbctp" value="<?php echo $_POST['psbctp']; ?>">
            <input type="hidden" name="dmctd" value="<?php echo $_POST['dmctd']; ?>">
            <input type="hidden" name="dsd" value="<?php echo $_POST['dsd']; ?>">
            <input type="hidden" name="slpyt" value="<?php echo $_POST['slpyt']; ?>">
            <input type="hidden" id="pqty" name="pqty" value="<?php echo  $_POST['pqty']; ?>" readonly>
            <input type="hidden" id="price" name="price" value="<?php echo  $_POST['price']; ?>" readonly>
            <input type="hidden" id="avail_qty" name="avail_qty" value="<?php echo $_POST['avail_qty']; ?>" readonly>
            
        
            <div class="pb-5">
            <div class="">
            <?php
            
            
            if($is_cart_count_result){ ?>
                
                <style>
                    tr th{
                        white-space: nowrap
                    } 
                </style>
                <div class="row">
                    <div class="col-sm-12 rounded">
        
                    <!-- Shopping cart table -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                
                                
                                <tr>
                                  <th scope="col" class="border-0 bg-light">
                                    <div class="p-2 px-3 text-uppercase">Product<br></div>
                                  </th>
                                  
                                  <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Refundable Deposit </div>
                                  </th>
                                  <th scope="col" class="border-0 bg-light" >
                                    <div class="py-2 text-uppercase">Rent / Sell Price</div>
                                  </th>
                                  <th scope="col" class="border-0 bg-light" >
                                    <div class="py-2 text-uppercase">Booking Date</div>
                                  </th>
                                  <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Return Date</div>
                                  </th>
                                  
                                  <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Deposit Date</div>
                                  </th>
                                  
                                  <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Quantity</div>
                                  </th>
                                  <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Remove</div>
                                  </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?
                                $total_deposite = 0 ;
                                $total_rental = 0; 
                                
                                $get_cart_sql=mysqli_query($conn,"SELECT * from cart where ac_typ=1 and user_id='".$userid."'");
                                while($get_cart_sql_result=mysqli_fetch_array($get_cart_sql)){ 

                                $productid=$get_cart_sql_result['product_id'];
                                $quantity=$get_cart_sql_result['qty'];
                                $type=$get_cart_sql_result['product_type'];
                                $return_date = $get_cart_sql_result['return_dt'];
                                $image = $get_cart_sql_result['image'];
                                $booking_date = $get_cart_sql_result['rent_dt'];
                                $deposite_date = $get_cart_sql_result['deposite_date'];
                                $purchase_type = $get_cart_sql_result['purchase_type'];
                                $skuCode = $get_cart_sql_result['sku'];
                                $purchase_type  = $purchase_type ? $purchase_type : 'Rent' ; 
                                ?>    
                            
                            
                            
                            
                            
                            
                            
                            
                                <tr>
                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                          <img src="<? echo $image ; ?>" alt="<?php echo $productid; ?>" width="70" class="cart_img">
                                          <div class="cart_product_name">
                                            <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle"><?php echo $skuCode ; ?></a></h5>
                                          </div>
                                        </div>
                                    </th>
                                    <td class="border-0 align-middle">
                                        <? 
                                        if($purchase_type=='Rent'){ ?>
                                       <input class="form-control total-amount" type="text" name="deposit_amt" id="deposit_amt" value=" <? echo $currency_symbol . ' ' .currencyAmount($currency,$get_cart_sql_result['deposit_amt']); ?>" border="none" readonly="">
                                       <? }else{ 
                                       
                                       echo '----';
                                           
                                       }
                                       ?>

                                    </td>
                                    <td class="border-0 align-middle">
                                        
                                       <label class="cartPurchaseType"> <?= $purchase_type ; ?> </label>
                                       <span><?= $currency_symbol . ' ' . currencyAmount($currency,$get_cart_sql_result['product_amt']); ?></span>
                                       <input class="form-control total-amount" type="hidden" name="amount" id="amount" value="<? echo $currency_symbol . ' ' . currencyAmount($currency,$get_cart_sql_result['product_amt']); ?>" border="none" readonly="">
                                    </td>
                                    
                                    <td class="border-0 align-middle">
                                        <p>
                                            <? 
                                            if($purchase_type=='Rent'){
                                                echo date('d M Y',strtotime($booking_date)) ;                                                
                                            }else{
                                                echo '----';
                                            } 
                                            ?>
                                        </p>
                                    </td>
                                    <td class="border-0 align-middle">
                                        <p>
                                            <?
                                            if($purchase_type=='Rent'){
                                            echo date('d M Y',strtotime($return_date)) ; 
                                            
                                            }else{
                                                echo '----';
                                            } ?>
                                         </p>
                                    </td>
                                    
                                    <td class="border-0 align-middle"><p>
                                        <?
                                            if($purchase_type=='Rent'){
                                             echo date('d M Y',strtotime($deposite_date)) ; 
                                            }else{
                                                echo '----';
                                            }
                                         ?></p>
                                    </td>
                                    
                                    
                                    <td class="border-0 align-middle" style="width:15%;">
                                        <div class="nights-count">
                                            <h6 class=""></h6>
                                            <button onclick="remove_one_cart(<? echo $productid; ?>,<?php echo $userid; ?>,'<?php echo get_sku($productid,$type); ?>')" type="button" style="margin: 0; padding: 0; border: 0;background: transparent; outline:0; " class="button hollow circle" data-productinfo="minus" data-field="productinfo"> 
                                                <i class="fa" style="background: url(https://image.flaticon.com/icons/svg/149/149146.svg); height: 28px; width: 21px; background-repeat: no-repeat; outline:none; vertical-align: middle;" aria-hidden="true"></i>
                                            </button>
                                                    
                                            <input class="input-group-field" type="text" name="productinfo" style="font-size: 21px;width: 10%;text-align: center;background: #f1f1f1;border: none;border-top: none;box-shadow: none;" value="<? echo $quantity; ?>" readonly="">
                        
                                            <button onclick="add_one_cart(<? echo $productid; ?>,<? echo $userid; ?>,'<?php echo get_sku($productid,$type); ?>')" type="button" style="margin: 0; padding: 0; border: 0;background: transparent; outline:none; " class="button hollow circle" data-productinfo="plus" data-field="productinfo">
                                                <i class="fa " style="background: url(https://image.flaticon.com/icons/svg/149/149145.svg); height: 28px; width: 21px; background-repeat: no-repeat; outline:none; vertical-align: middle;" aria-hidden="true"></i><br>
                                            </button>
                                        </div>
                                    </td>
                                    
                                                                        
                                    <td class="border-0 align-middle"><a href="#" class="text-dark" onclick="remove_from_cart(<? echo $productid; ?>,<? echo $userid; ?>)"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                
                                
                                
                                
                                
                            <?php
                            
                            $total_deposite +=  $quantity * $get_cart_sql_result['deposit_amt'];
                            $total_rental +=  $quantity * $get_cart_sql_result['product_amt'];
                            
                            } 
                            
                            $_SESSION['total_deposite'] = $total_deposite ;
                            $_SESSION['total_rental'] = $total_rental ;
                            ?>
                            
                            
                            
                            
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
                </div>
            <?php
            
                $subtotal = total_cart_amount($userid);
            
                $shipping_charges = get_shipping_charges($subtotal);
            
                $total = $subtotal+$shipping_charges;

            if($total_rental>0){ ?>
                <div class="row">
                    <div class="col-sm-12 cart_pay_details">
                    
                        <h2 style="text-align:center">Charges</h2>
                        <p class="total_show" style="color: black;">Rent Price : <span class="total_rental"><? echo  $currency_symbol . ' ' .currencyAmount($currency,$total_rental);?></span></p>
                        <p class="total_show" style="color: black;">Shipping Charges : <? echo  $currency_symbol . ' '  ; ?> 0.00 </p>
                        <?php $user_state=state_id_userid($userid);
                        
                        if($user_state){ ?>
                        <div class="gst_tax">
                            <? $gst= igst($userid);
                            if($user_state!=3){ ?>
                                <div class="tax">
                                    <span> IGST: </span>
                                    <span>  &#8377; <? echo $gst; ?>   </span>
                                    <? $_SESSION['same_state']=0;?>
                                </div>
                            <? } else { ?>
                                <?php $_SESSION['same_state']=1;?>
                                <div class="tax">
                                    <div class="cgst" style="font-size:12px; color:gray;">
                                        <span> CGST: </span>
                                        <span> &#8377; <? echo sprintf("%.2f", $gst/2); ?>  </span>   
                                    </div>
                                    <div class="sgst" style="font-size:12px; color:gray;">
                                        <span> SGST: </span>
                                        <span> &#8377; <? echo sprintf("%.2f", $gst/2); ?>  </span>
                                    </div>
                                    <div class="total_gst" style="font-size:14px; color:gray;">
                                        <span> TOTAL GST: </span>
                                        <span> &#8377; <? echo sprintf("%.2f", $gst); ?>  </span>
                                    </div>
                                </div>
                                <br>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <p class="total_show" style="color:red; font-size: 30px;" > <b>Grand Total : <span class="total_rental"><? echo $currency_symbol . ' ' .currencyAmount($currency,sprintf("%.2f", $total_rental));?> </span></b></p>
                                    
                    <div class="checkout_btn">
                        <? if($_SESSION['email']){ ?>
                            <input type="submit" class="btn btn-dark py-2 btn-block btn-check" value="Proceed to Shipping Details">
                        <? }else{ ?>
                            <a href="account/my-account.php" class="btn btn-dark py-2 btn-block btn-check">Login To Continue</a>
                        <? } ?>
                        </div>    
                </div>
                </div>
        <?php } ?>  
    </div>
<?php } else { 



?>
<style>


    .cart-empty {
        padding: 15px;
        font-size: 20px;
        text-align: center;
    }
    .cart-empty {
        background: #f7f6f7;
        padding: 15px;
    }
    .empty-cart-image, .return-to-shop {
        display: flex;
        justify-content: center;
    }
    
    .empty-cart-image img {
        width: auto;
        height: 50vh;
    }
    .woocommerce img, .woocommerce-page img {
        height: auto;
        max-width: 100%;
    }
    
</style>
<p class="cart-empty">Your cart is currently empty.</p>
<div class="empty-cart-image">
    <img src="https://srishringarr.com/assets/empty.png" alt="Empty Cart">
</div>
<?php } ?>
<?php
    $_SESSION['total_gst']=$gst;
    $_SESSION['total_amount']=$total+$gst;
?>
</div>
                <input type="hidden" id="total_rental" name="total_rental" value="<?php echo  $total_rental; ?>" readonly>
        </form>

</div>
</div>
</div>
</div>






<div id="myModal" class="modal fade">
    <div class="modal-dialog mymodaldialough">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Subscribe And Get 15% Discount Coupon</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
				<div class="newsletter">
	                <div class="nl_content">
	            <form id="nl_form">
	                
	            
                    <div class="form-group">

                        <input type="text" class="form-control" id="name" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="mobilenum" placeholder="Mobile" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email"  placeholder="Email Address" required>
                    </div>
                    <button id="nlsubmit" type="submit" class="btn btn-primary">Subscribe</button>
                        <a href="#" id="nevershownl" data-dismiss="modal">Never Show Again</a>
                </form>
                </div>
                
                
				</div>
    
            </div>
        </div>
    </div>
</div>
    





<script>






    $("#nl_form").submit(function(e){
        e.preventDefault();
        var name=$("#name").val();
        var mobile=$("#mobilenum").val();
        var email=$("#email").val();
        
        var error ='';
        if(!name){
            error += 'Name Cannot Be Empty';
        }
        if(!mobile){
            error += 'Mobile Cannot Be Empty';
        }
        if(!email){
            error += 'Email Cannot Be Empty';
        }
        if(!name || !mobile || !email){
            alert(error);    
        }else{
    $.ajax({

            type: "POST",
            url: 'process_nl.php',
            data: 'name='+name+'&mobile='+mobile+'&email='+email,
            success:function(msg) {
                if(msg==1){
                    $("#nl_form").html('Coupon Sent To Your Email');
                }else if(msg==0){
                    $("#nl_form").html('Some Error Occured');
                }else if(msg==2){
                    $("#nl_form").html('Email ID OR Mobile Already Exists');
                }
            }
    });
    

        }
            
    }); 
        
    
    $(document).ready(function(){
    
        $("form").attr( 'autocomplete', 'off' );
    
});
    
    
    
</script>
<?php include('footer.php'); ?>
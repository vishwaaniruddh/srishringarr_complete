<?php include('header.php'); ?>
<main class="mainContent" role="main">
    <section id="pageContent">
        <div class="container">
            <div id="shopify-section-vela-template-cart" class="shopify-section">
                <div class="cartContainer">
                    <form>

                        <input type="hidden" name="userid" value="<? echo $userid; ?>">

                    </form>
  <style>
    .highlight{
            padding: 10px;
    box-shadow: 0px 0px 10px 2px rgb(0 0 0 / 40%);
    margin: 20px auto;
    }
</style>              
                    
                    <div class="woocommerce-info" style="user-select: auto;">
                        
                                        <div class="woocommerce-info" style="user-select: auto;">
                                        <h5>Have a coupon? <a href="#" id="showcoupon" class="showcoupon" style="user-select: auto;">Click here to enter your code</a> </h5> </div>
                                    </div>
                           
                    <form id="couponform" class="highlight checkout_coupon woocommerce-form-coupon" method="post" style=" padding: 30px;border: 1px solid gray; display:none;"  >
                        <input type="hidden" id="userid" name="userid" value="<? echo $userid; ?>">
                        <input type="hidden" id="total_price" name="total_price" value="">
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
                    <h1 class="cartTitle">Shopping cart</h1>
                    <div class="cartContent" id="cartpagetable">
                    <form action="checkout.php" method="POST" class="cartForm">

                            <input type="hidden" name="userid" value="<? echo $userid; ?>">
                            <input type="hidden" name="cur" value="<? echo $_SESSION['cur']; ?>">
                            
                            <div class="cartTable">
                                    <div class="row noGutter cartHeaderLabels">
                                        <div class="col-xs-3 col-sm-2">Image</div>
                                        <div class="col-xs-9 col-sm-8">Product</div>
                                        <div class="col-xs-12 col-sm-2 hidden-xs text-right">Total</div>
                                    </div>

                            <?
                            $total_amount = 0;
                            $total_amountMRP = 0 ; 
                            $sql = mysqli_query($con, "select * from cart where active=1 and user_id='" . $userid . "' and ac_typ='2'");
                            while ($sql_result = mysqli_fetch_assoc($sql)) {

                                $cartid = $sql_result['cart_id'];
                                $img = $sql_result['image'];
                                $price = $sql_result['product_amt']; // this may be discounted price
                                $mrp = $sql_result['mrp'];
                                $qty = $sql_result['qty'];
                                $total = $sql_result['total_amt'];
                                $type = $sql_result['product_type'];
                                $pid = $sql_result['product_id'];
                                $sku = $sql_result['sku'];


                                if ($type == "1") {
                                    $sql1 = "SELECT * FROM `product` WHERE `product_id`='" . $pid . "'";
                                } else if ($type == "2") {
                                    $sql1 = "select * from  `garment_product` where gproduct_id='" . $pid . "'";
                                }
                                $table = mysqli_query($con, $sql1);
                                $rws = mysqli_fetch_array($table); 
                                $productname = $rws[3];

                                $total_amount = $total_amount + currencyAmount($_SESSION['cur'], $price) * $qty;
                                $total_amountMRP = $total_amountMRP + currencyAmount($_SESSION['cur'], $mrp) * $qty;


                            ?> 

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


                                    .woocommerce form.checkout_coupon,
                                    .woocommerce form.login,
                                    .woocommerce form.register {
                                        border: 1px solid #d3ced2;
                                        padding: 20px;
                                        margin: 2em 0;
                                        text-align: left;
                                        border-radius: 5px;
                                    }
                                </style>
                                <div class="overlay" id="loader" style="display:none;">
                                    <div class="overlay__inner">
                                        <div class="overlay__content">
                                            <h4 style="color:white;">
                                            Please Wait ..    
                                            </h4>
                                            <span class="spinner"></span></div>
                                    </div>
                                </div>
                                
                                
                                    <div class="cartItemWrap">

                                        <div class="flexRow noGutter">
                                            <div class="productImage col-xs-3 col-sm-2" data-label="Product">
                                                <a href="/collections/all/products/sweeper-and-funnel?variant=31715443867766" class="cartImage">
                                                    <img class="img-responsive" src="<? echo $img; ?>" alt="Gabardine Bermuda Shorts - White">
                                                </a>
                                            </div>
                                            <div class="productInfo col-xs-9 col-sm-8">
                                                <a href="detail.php?id=<? echo $pid; ?>&&type=<? echo $type; ?>" class="productName">
                                                    <? echo $productname; ?>
                                                </a>

                                                <br>
                                                <small><? echo $sku; ?></small>

                                                <div data-label="Price">
                                                    <span class="priceProduct">
                                                        <strike class="money"><? echo $currency_symbol . ' ' . currencyAmount($_SESSION['cur'], $mrp); ?></strike>
                                                        <span class="money"><? echo $currency_symbol . ' ' . currencyAmount($_SESSION['cur'], $price); ?></span>
                                                    </span>
                                                </div>
                                                <div class="flexRow cartGroup flexAlignCenter" data-label="Quantity" style="user-select: auto;">

                                                    <div class="velaQty" style="user-select: auto;">
                                                        <button type="button" class="velaQtyAdjust velaQtyButton velaQtyMinus" data-cartid="<? echo $cartid; ?>" data-id="" data-qty="0" style="user-select: auto;">
                                                            <span class="txtFallback" style="user-select: auto;">−</span>
                                                        </button>
                                                        <input type="text" class="velaQtyNum velaQtyText" value="<? echo $qty; ?>" min="0" data-id="" aria-label="quantity" pattern="[0-9]*" name="updates[]" id="" style="user-select: auto;">
                                                        <button type="button" class="velaQtyAdjust velaQtyButton velaQtyPlus" data-id="" data-qty="11" data-cartid="<? echo $cartid; ?>" style="user-select: auto;">
                                                            <span class="txtFallback" style="user-select: auto;">+</span>
                                                        </button>
                                                    </div>
                                                    <!--<input type="submit" name="update" class="btn btnUpdateCart" onclick="window.location.reload(true)" value="Update Cart"  style="user-select: auto;">-->

                                                    <a href="#" onclick="removeproduct('<? echo $cartid; ?> window.location.reload();')" class="cartRemove" title="Remove" style="user-select: auto;">
                                                        Remove
                                                    </a>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="text-right col-xs-12 col-sm-2 hidden-xs" data-label="Total">
                                                
                                                <strike class="h3 cartSubtotal priceProduct">
                                                    <span class="money"><? echo $currency_symbol . ' ' . currencyAmount($_SESSION['cur'], $mrp) * $qty; ?></span>
                                                </strike>
                                                <br />
                                                <span class="h3 cartSubtotal priceProduct">
                                                    <span class="money"><? echo $currency_symbol . ' ' . currencyAmount($_SESSION['cur'], $price) * $qty; ?></span>
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                    
                                <? }
                                
                                ?>
                                <script>
                                  var tot_amt = <?php echo $total_amount; ?>;
                                  $('#total_price').val(tot_amt);
                                </script>
                                
                                </div>
                                
                                <div class="functionCart flexRow">
                                    <div class="col-xs-12 col-md-7">
                                        
                                    </div>
                                    <div class="text-right col-xs-12 col-md-5">
                                        
                                        <input type="hidden" name="mainamt" id="mainamt" value="">
                                        <div class="cartBoxSubtotal">
                                            
                                            
                                            <span class="cartSubtotalTitle">Subtotal: </span>

<strike class="money">
    <? echo $currency_symbol . ' ' . $total_amountMRP; ?>
</strike>

                                            <span class="cartSubtotal"><span class="money"  name="totalamt" id="totalamt">
                                                
                                                <? echo $currency_symbol . ' ' . $total_amount; ?></span></span>
                                        </div>

                                        <p class="cartShipping">Shipping, taxes, and discounts will be calculated at checkout.</p>
                                        <div class="functionCartButton">



                                            <input type="submit" name="checkout" class="btn btnCheckout" value="Check Out">
                                        </div>

                                    </div>
                                </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

 <script>
    $(document).on('click', '.cartRemove', function() {
        swal('Product Removed', 'success');

        swal({
            title: "Product Removed!",
            text: "",
            icon: "success",
            button: "Close!",
        });

        $("#cartpagetable").load(location.href + " #cartpagetable>*", "");
    });
</script>
<script>
    $(function() {

        $('#couponform').on('submit', function(e) { debugger;


            $("#loader").css('display', 'block');
            e.preventDefault();

            var userid = $("#userid").val();
            // alert(userid);
            var total_price = $("#total_price").val();
            // alert(total_price);
            var coupon_code = $("#coupon_code").val();
            // alert(coupon_code);

            $.ajax({
                type: 'post',
                url: 'Xircle_coupon.php',
                data: 'userid=' + userid + '&total_rental=' + total_price + '&coupon_code=' + coupon_code,
                success: function(msg) { debugger;
                    if (msg > 2) {
                        // alert('successfully Applied Coupne');
                        $(".total_rental").html(msg);
                        $("#total_rental").val(msg);
                        // alert(msg);
                        $("#loader").css('display', 'none');
                        $("#coupon_msg").html('<div class="alert alert-success" role="alert">Coupon Succesfully Applied . </div>');
                        $("#totalamt").html('₹ ' + msg);
                        $("#mainamt").val(msg);
                        

                    } else if (msg == 0) {
                        // alert('Error In Applied Coupne');
                        $("#loader").css('display', 'none');
                        $("#coupon_msg").html('<div class="alert alert-danger" role="alert">Error While Applying Coupon .</div>');
                    } else if (msg == 2) {
                        // alert('Not In The Criteria');
                        $("#loader").css('display', 'none');
                        $("#coupon_msg").html('<div class="alert alert-info" role="alert">Invalid Coupon Code.</div>');
                    }
                }
            });

        });

    });




    $('#showcoupon').click(function() {
        $(".checkout_coupon").toggle();
    });
</script>
<?php include('footer.php'); ?>
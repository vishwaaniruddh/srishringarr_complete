<? include('header.php') ;?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<main class="mainContent" role="main">
    <section id="pageContent">
        <div class="container">
            <div id="shopify-section-vela-template-cart" class="shopify-section">
                <div class="cartContainer">
                    <form>

                        <input type="hidden" name="userid" value="<? echo $userid; ?>">

                    </form>

<style>
    #coupon_container .alert-danger{
        margin-top: 50px;
    }
        
</style>

<h2>Have A Coupon ? </h2>
<hr style="border-top: 1px solid #e5e0e0">
    <div id="coupon_container"></div>

    <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>

    <!-- Load our React component. -->
    <script src="like_button.js"></script>
                 
                 <div class="cartmsg"></div>
                 
                 
            <form action="checkout.php" method="POST" class="cartForm">

                <input type="hidden" name="userid" value="<? echo $userid; ?>">
                <input type="hidden" name="cur" value="<? echo $_SESSION['cur'];?>">

                <div class="cartTable">
                    <div class="row noGutter cartHeaderLabels">
                        <div class="col-xs-3 col-sm-2">Image</div>
                        <div class="col-xs-6 col-sm-8">Product</div>
                        <div class="col-xs-3 col-sm-2 text-right">Total</div>
                    </div>


                    <?                $total_amount = 0;
                    $sql = mysqli_query($con,"select * from cart where user_id='".$userid."' and ac_typ='2'");
                    while($sql_result = mysqli_fetch_assoc($sql)){

                    $cartid = $sql_result['cart_id'];
                    $img =$sql_result['image'];
                    $price = $sql_result['product_amt'];
                    $qty = $sql_result['qty'];
                    $total = $sql_result['total_amt'];
                    $type=$sql_result['product_type'];
                    $pid = $sql_result['product_id'];
                    $sku = $sql_result['sku'];


                            if($type=="1")
                            {
                            $sql1="SELECT * FROM `product` WHERE `product_id`='".$pid."'";
                            }
                            else if($type=="2")
                            {
                            $sql1="select * from  `garment_product` where gproduct_id='".$pid."'";
                            }
                            $table=mysqli_query($con,$sql1);
                            $rws=mysqli_fetch_array($table);
                            $productname = $rws[3];

                    ?>


                    <div class="cartItemWrap">

                            <div class="flexRow noGutter">
                                <div class="productImage col-xs-3 col-sm-2" data-label="Product">
                                    <a href="/collections/all/products/sweeper-and-funnel?variant=31715443867766" class="cartImage">
                                      <img class="img-responsive" src="<? echo $img; ?>" alt="Gabardine Bermuda Shorts - White">
                                    </a>
                                </div>
                                <div class="productInfo col-xs-6 col-sm-8">
                                    <a href="detail.php?id=<?echo $pid; ?>&&type=<? echo $type; ?>" class="productName">
                                        <? echo $productname ; ?>
                                    </a>

                                        <br>
                                        <small><? echo $sku; ?></small>

                                    <div  data-label="Price">
                                        <span class="priceProduct">
                                            <span class="money"><? echo $currency_symbol . ' '. currencyAmount($_SESSION['cur'],$price); ?></span>
                                        </span>
                                    </div>




                                    <div class="flexRow cartGroup flexAlignCenter" data-label="Quantity" style="user-select: auto;">

        <div class="velaQty" style="user-select: auto;">
            
            <button type="button" class="velaQtyAdjust velaQtyButton velaQtyMinus" data-cartid="<? echo $cartid; ?>" data-id="" data-qty="0" style="user-select: auto;">
                <span class="txtFallback" style="user-select: auto;">−</span>
            </button>
            
            <input type="text" class="velaQtyNum velaQtyText" value="<? echo $qty; ?>" min="0" data-id="" aria-label="quantity" pattern="[0-9]*" name="updates[]" id="" style="user-select: auto;">
            
            <button type="button" class="velaQtyAdjust velaQtyButton velaQtyPluss" data-id="" data-qty="11" data-cartid="<? echo $cartid; ?>" style="user-select: auto;">
                <span class="txtFallback" style="user-select: auto;">+</span>
            </button>
            
        </div>
                                        <input type="submit" name="update" class="btn btnUpdateCart" value="Update Cart" style="user-select: auto;">

                                        <a href="#" onclick="removeproduct('<? echo $cartid; ?>')" class="cartRemove" title="Remove" style="user-select: auto;">
                                            Remove
                                        </a>
                                    </div>
                                </div>
                                <div class="text-right col-xs-2" data-label="Total">
                                    <span class="h3 cartSubtotal priceProduct">
                                        <span class="money"><? echo $currency_symbol . ' '. currencyAmount($_SESSION['cur'],$price)*$qty; ?></span>
                                    </span>
                                </div>
                            </div>

                    </div>
                    <?
                                  $total_amount = $total_amount + currencyAmount($_SESSION['cur'],$price)*$qty ;
                    } ?>
                </div>
                <div class="functionCart flexRow"><div class="col-xs-12 col-md-7">
                            <div class="functionCartNote">
                                <div class="velaCartNoteButton">
                                    <a class="btnCartNote collapsed" href="#Note data-toggle="collapse">
                                        <i class="fa fa-times"></i>
                                        Add Order Note
                                    </a>
                                </div>
                                <div id=Note" class="velaCartNoteGroup collapse">
                                    <label for="CartSpecialInstructions">Special instructions for seller</label>
                                    <textarea name="note" class="form-control" id="CartSpecialInstructions" rows="4"></textarea>
                                </div>
                            </div>
                            
                            <span class="money" id="total_checkout_amount" style="display:none;"><? echo  $total_amount; ?></span>
                            
                            
                            
                        </div><div class="text-right col-xs-12 col-md-5">
                        <div class="cartBoxSubtotal">
                            <span class="cartSubtotalTitle">Subtotal: </span>
                            <span class="cartSubtotal"><? echo $currency_symbol . ' ' ; ?><span class="money" id="total_checkout_amount_og"><? echo  $total_amount; ?></span></span>
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

// <script>


// Add Quantity 

$(document).on('click','.velaQtyPluss',function(){


       var cartid = $(this).data("cartid");
    
    var inputval = $("input."+cartid).val() ;
    inputval = inputval -1 ; 
        
        $.ajax({

                type: "POST",
                url: 'cart/add_one_cart.php',
                data: 'cartid='+cartid,
                success:function(msg) {
                    console.log(msg);
                    if(msg==0){
                        $(".cartmsg").html('');
                        $(".cartmsg").html('<div class="alert alert-error" role="alert">Error  </div>');
                        
                    }else if(msg==1){
                        $(".").html('');
                         $(".").html('<div class="alert alert-success" role="alert">Success  </div>');
                        
                        
                    }else if(msg==2){
                        $("input."+cartid).val(inputval);
                        $(".cartmsg").html('');
                        $(".cartmsg").html('<div class="alert alert-warning" role="alert"> Higher Qunatity! </div>');
                    }

                    
                }
                
                
                                        
            });
            
    });
    
    

// End Add Quantity


// Remove Quantity 

$(document).on('click','.velaQtyMinus',function(){
   alert('remove'); 
});

// End Remove Quantity



    $('#showcoupon').click(function() {
        $(".checkout_coupon").slideToggle();
    });
$(document).on('click','.cartRemove',function(){
    swal('Product Removed','success');
    
    swal({
  title: "Product Removed!",
  text: "",
  icon: "success",
  button: "Close!",
});

    $("#cartpagetable").load(location.href+" #cartpagetable>*","");
});

</script>
<?php include('footer.php'); ?>
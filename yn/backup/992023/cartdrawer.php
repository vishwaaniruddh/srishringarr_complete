<? include('config.php'); ?>
<script>
    function removeproduct(id){
        $.ajax({

                type: "POST",
                url: 'cart/remove.php',
                data: 'id='+id,
                success:function(msg) {
                    if(msg==1){
                        // $("#cartmsg").html('');
                        // $("#cartDrawer").html('');
                        $("#cartmsg").html('<div class="alert alert-success" role="alert"> Removed </div>');
                        $("#cartDrawer").load('cartdrawer.php');
                        $("#cartmsg").html('<div class="alert alert-success" role="alert"> Removed </div>');
                    }else if(msg==0){
                        $("#cartmsg").html('');
                        $("#cartmsg").html('<div class="alert alert-warning" role="alert"> Errorr </div>');
                        
                        
                    }
                }
});
}

</script>
<style>
.alert-warning {
    color: #856404;
    background-color: #fff3cd;
    border-color: #ffeeba;
}

.alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

.alert {
    position: relative;
    padding: .75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: .25rem;
}
.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}

</style>
	<div class="drawerClose" >
            <span class="jsDrawerClose" ></span>
        </div>
	    <div class="drawerCartTitle" >
	        <span >Shopping cart</span>
	    </div>
	    
	    
	    <div id="cartmsg"></div>
	    
	    
	    <div id="cartContainer" >
    
        <form action="checkout.php" method="post" novalidate="" class="cart ajaxcart" >
<input type="hidden" name="userid" value="<? echo $userid; ?>">
                <input type="hidden" name="cur" value="<? echo $_SESSION['cur'];?>"> 
                
            <div class="ajaxCartInner" >
                
                
                
                
                 <?
                $total_amount = 0; 
                    $sql = mysqli_query($con,"select * from cart where active=1 and user_id='".$userid."' and ac_typ='2'");
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
                            $productname = $rws[3]; ?> 



                
                
                
                <div class="ajaxCartProduct" >
                    <div class="drawerProduct ajaxCartRow" data-line="1" >
                        <div class="drawerProductImage" >
                            <a href="/products/victo-pedant-lamp?variant=31715442032758" ><img class="img-responsive" src="<? echo $img;?>" alt="" ></a>
                        </div>
                        <div class="drawerProductContent" >
                            <div class="drawerProductTitle" >
                                <a href="detail.php?id=<?echo $pid; ?>&&type=<? echo $type; ?>" ><? echo $productname; ?></a>

                                

                            </div>
                            <div class="drawerProductPrice" >
                                <div class="priceProduct" >
                                    <span class="money" ><? echo $currency_symbol . ' '. currencyAmount($_SESSION['cur'],$price); ?></span>
                                </div>
                            </div>
                            <div class="drawerProductQty" style="display: flex;justify-content: space-between;">
                                <div class="velaQty" >
                                    
                                    <button type="button" class="qtyAdjust velaQtyButton velaQtyMinus" data-cartid="<? echo $cartid; ?>">
                                        <span class="txtFallback" >−</span>
                                    </button>
                                    
                                    
                                    <input type="text" name="updates[]" class="qtyNum velaQtyText <? echo $cartid ; ?>" value="<? echo $qty; ?>" min="0" data-input="<? echo $cartid; ?>" data-line="1" pattern="[0-9]*" readonly>
                                    
                                    <button type="button" class="qtyAdjust velaQtyButton velaQtyPlus" data-inputvalue="<? echo $qty; ?>"  data-cartid="<? echo $cartid; ?>">
                                        <span class="txtFallback" >+</span>
                                    </button>
                                
                                

                                    
                                
                                </div>
                                <span class="h6 cartSubtotal priceProduct">
                                    <span class="money"><? echo $currency_symbol . ' '. currencyAmount($_SESSION['cur'],$price)*$qty; ?></span>
                                </span>
                                    
                            </div>
                            <div class="drawerProductDelete" >
                                <div class="cartRemoveBox" >
                                    <a href="#" class="cartRemove btnClose" onclick="removeproduct('<? echo $cartid; ?>')" data-line="1" >
                                        <span >Remove</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
    
              <? 
                                                $total_amount = $total_amount + currencyAmount($_SESSION['cur'],$price)*$qty ; 
              } ?>
              
              
              
              
              
    
                    <div class="ajaxCartNote" >
                        <div class="velaCartNoteButton" >
                            <a class="btnCartNote collapsed" href="#velaCartNote" data-toggle="collapse" >
                                <i class="fa fa-times" ></i>
                                add order note
                            </a>
                        </div>
                        <div id="velaCartNote" class="velaCartNoteGroup collapse" >
                            <label for="CartSpecialInstructions" >Special instructions for seller</label>
                            <textarea name="note" class="form-control" id="CartSpecialInstructions" rows="4" ></textarea>
                        </div>
                    </div>
    
                
    
                <div class="drawerCartFooter" >
                    <div class="drawerAjaxFooter" >
                        <div class="drawerSubtotal" >
                            <span class="cartSubtotalHeading" >Subtotal</span>
                            <span class="cartSubtotal" ><span class="money"  ><? echo $currency_symbol . ' '. $total_amount; ?></span></span>
                        </div>
                        <p class="drawerShipping" >Shipping, taxes, and discounts will be calculated at checkout.</p>
                        <div class="drawerButton" >
                            <div class="drawerButtonBox" >
                                <a class="btn btnVelaCart btnViewCart" href="cart.php" >
                                    View Cart
                                </a>
                            </div>
                            <div class="drawerButtonBox" >
                                <button type="submit" class="btn btnVelaCart btnCheckout" name="checkout" >
                                    Check Out
                                </button>
                            </div>
    
                            
    
                        </div>
                    </div>
                </div>
            </div>
        </form>
    
</div>




<script>
    $(document).on('click','.velaQtyMinus',function(){


$("#cartmsg").html('');
        
        var cartid = $(this).data("cartid");
        $.ajax({

                type: "POST",
                url: 'cart/remove_one_cart.php',
                data: 'cartid='+cartid,
                success:function(msg) {
                    console.log(msg);
                    if(msg==0){
                         $("#cartmsg").html('');
                         $("#cartmsg").html('<div class="alert alert-error" role="alert">Error  </div>');
                    }else if(msg==1){
                         $("#cartmsg").html('');
                         $("#cartmsg").html('<div class="alert alert-success" role="alert">Success  </div>');
                    $("#cartDrawer").load('cartdrawer.php');
                        
                    }else if(msg==2){
                        $("#cartmsg").html('');
                         $("#cartmsg").html('<div class="alert alert-warning" role="alert"> Higher Qunatity! </div>');
                    }else if(msg==-1){
                         $("#cartmsg").html('');
                         $("#cartmsg").html('<div class="alert alert-success" role="alert">Success  </div>');
                    $("#cartDrawer").load('cartdrawer.php');
                    }
                    
                    
                                            
                                            
                }
            });
    });
    
    $(document).on('click','.velaQtyPlus',function(){


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
                        $("#cartmsg").html('');
                        $("#cartmsg").html('<div class="alert alert-error" role="alert">Error  </div>');
                        $("#cartDrawer").load('cartdrawer.php');
                    }else if(msg==1){
                        $("#cartmsg").html('');
                         $("#cartmsg").html('<div class="alert alert-success" role="alert">Success  </div>');
                        $("#cartDrawer").load('cartdrawer.php');
                        
                        
                        $(".cartmsg").html('');
                         $(".cartmsg").html('<div class="alert alert-success" role="alert">Success  </div>');

                        
                    }else if(msg==2){
                        $("input."+cartid).val(inputval);
                        $("#cartmsg").html('');
                        $("#cartmsg").html('<div class="alert alert-warning" role="alert"> Higher Qunatity! </div>');
                    }

                    
                }
                
                
                                        
            });
            
    });
    
</script>

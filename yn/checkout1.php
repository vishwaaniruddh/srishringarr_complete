<?php session_set_cookie_params();
session_start();
include('header.php');


$cur = $_SESSION['cur'];

if($cur=='INR'){
    $cur_sym = '&#8377;';
}else if($cur=='USD'){
    $cur_sym = '&#36;';
}


 ?>


<link rel="stylesheet" href="https://yosshitaneha.com/js/checkout_stylesheet.css" media="all" />

    <div class="content" data-content>
      <div class="wrap" style="margin:0;width: 100%; max-width: none;">
        <div class=row"">
            <div class="col-sm-6">
          <header class="main__header" role="banner">




<style>
th{
    padding:25px;
}
.modal-open .modal {
    overflow-x: hidden;
    overflow-y: auto;
}

.fade.in {
    opacity: 1;
}

.modal {
    display: none;
    overflow: hidden;
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1050;
    -webkit-overflow-scrolling: touch;
    outline: 0;
}
.fade {
    opacity: 0;
    -webkit-transition: opacity 0.15s linear;
    -o-transition: opacity 0.15s linear;
    transition: opacity 0.15s linear;
}



.modal.fade .modal-dialog {
    -webkit-transform: translate(0, -25%);
    -ms-transform: translate(0, -25%);
    -o-transform: translate(0, -25%);
    transform: translate(0, -25%);
    -webkit-transition: -webkit-transform 0.3s ease-out;
    -moz-transition: -moz-transform 0.3s ease-out;
    -o-transition: -o-transform 0.3s ease-out;
    transition: transform 0.3s ease-out;
}
@media (min-width: 992px){
.modal-lg {
    width: 900px;
}
}

@media (min-width: 768px){
.modal-dialog {
    width: 600px;
    margin: 30px auto;
}


}
.modal-dialog {
    position: relative;
    width: auto;
    margin: 10px;
}

@media (min-width: 768px){
.modal-content {
    -webkit-box-shadow: 0 5px 15px rgb(0 0 0 / 50%);
    box-shadow: 0 5px 15px rgb(0 0 0 / 50%);
}
}
.modal-header {
    padding: 15px;
    border-bottom: 1px solid #e5e5e5;
}


.modal-body {
    position: relative;
    padding: 15px;
}


.modal-content {
    position: relative;
    background-color: white;
    border: 1px solid #999999;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 4px;
    -webkit-box-shadow: 0 3px 9px rgb(0 0 0 / 50%);
    box-shadow: 0 3px 9px rgb(0 0 0 / 50%);
    background-clip: padding-box;
    outline: 0;
}




    .velaShadow-1, .velaFormAccount, .boxAccount, .accountOrderBox {
    -webkit-box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 1px 5px 0 rgb(0 0 0 / 12%), 0 3px 1px -2px rgb(0 0 0 / 20%);
    box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 1px 5px 0 rgb(0 0 0 / 12%), 0 3px 1px -2px rgb(0 0 0 / 20%);
}

.boxAccount {
    position: relative;
    margin-bottom: 30px;
    padding: 30px;
    border-radius: 3px;
}
.accountHeading {
    margin: 0 0 15px;
    padding: 0;
    font-size: 18px;
}
.boxAccount .accountContent {
    font-size: 15px;
    line-height: 20px;
}
.card {
    position: relative;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    justify-content:center;
    background-color: #fff;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.25rem;
    padding: 10px;
    margin: 10px auto;
}
 .boxAccount .accountButton a {
    display: inline-block;
    font-size: 14px;
    text-transform: uppercase;
    -webkit-transition: all 0.35s ease;
    -o-transition: all 0.35s ease;
    transition: all 0.35s ease;
}

.btn {
    display: inline-block;
    margin-bottom: 0;
    text-align: center;
    vertical-align: middle;
    touch-action: manipulation;
    cursor: pointer;
    background-image: none;
    border: 1px solid transparent;
    white-space: nowrap;
    padding: 9px 20px;
    font-size: 16px;
    line-height: 1.45;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.boxAccount{
    height:auto;
}







</style>





<?
    if(isset($_POST['del_submit']) && $_GET['action']=='add_del'){
        $person_name = $_POST['person_name'];
        $person_contact = $_POST['person_contact'];
        $address = $_POST['address'];
        $landmark = $_POST['landmark'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $country = $_POST['country'];
        $pincode = $_POST['pincode'];

        $created_at = date('Y-m-d h:i:s');

$sql = "insert into shippingInfo(userid,person_name,person_contact,address,landmark,city,state,country,pincode,type,status,created_at,created_by,site) values('".$userid."','".$person_name."','".$person_contact."','".$address."','".$landmark."','".$city."','".$state."','".$country."','".$pincode."','0','1','".$created_at."','".$userid."','YN')" ;

    if(mysqli_query($con,$sql)){ ?>
       <script>
           alert('Shipping added');
           window.location.href="checkout.php";
       </script>
    <? }
}


?>





                <div class="shown-if-js" data-alternative-payments>
</div>

<form action="checkout_set1.php" method="POST">

<? if($_SESSION['email']){ ?>
  <div class="boxAccount accountAddress">
                                <h4 class="accountHeading">Your Addresses</h4>
                                <div class="accountContent">

                                    <?
                                    $sql = mysqli_query($con,"select * from shippingInfo where userid ='".$userid."' and site='YN'");
                                    $sql_result1 = mysqli_num_rows($sql);

                                if($sql_result1>0){
                                    while($sql_result = mysqli_fetch_assoc($sql)){ ?>

                                        <div class="card">
                                         <div class="card-block" style="padding:15px;">
                                             <input type="radio" class="card-input-element" name="delivery" value="<? echo $sql_result['id'];?>" required style=" height: 25px; width: 25px;">
                                         </div>

                                         <div class="card-block">

                                                <h5><? echo $sql_result['person_name'];?></h5>
                                                <p><? echo $sql_result['person_contact'];?></p>

                                                <p>
                                                <span><? echo $sql_result['address'] . ', ' . $sql_result['landmark']. ', ' . $sql_result['city'].', '.$sql_result['state'].', '.$sql_result['country'].', '.$sql_result['pincode'] ; ?></span>
                                                </p>



                                            </div>
                                        </div>

                                    <?

                                    }
                                    }else{ ?>

                                        <div>
                                        </div>
                                        <p>There are no addresses in your address book</p>

                                    <? } ?>

                                            <div class="accountButton">
                                                <a id="del" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Add address </a>
                                            </div>
                                        </div>

            </div>

            <?
            if($sql_result1>0){ ?>
                <button name="button" type="submit" id="continue_button" class="step__footer__continue-btn btn" aria-busy="false"><span class="btn__content" data-continue-button-content="true">Continue to Shipping</span><svg class="icon-svg icon-svg--size-18 btn__spinner icon-svg--spinner-button" aria-hidden="true" focusable="false"> <use xlink:href="#spinner-button" /> </svg></button>
            <? }else{ ?>
                <a href="account/account.php" class="step__footer__continue-btn btn">Add Address To Continue</a>

            <? } ?>


            <? }else{ ?>
                <a href="login_register.php" class="step__footer__continue-btn btn">Login To Continue</a>
            <? }  ?>


</form>


          </header>
 <main class="main__content" role="main">

<form action="<? echo $_SERVER['PHP_SELF'];?>?action=add_del" id="del_form" method="POST"></form>


<div class="step" data-step="contact_information" data-last-step="false">
  <form class="edit_checkout" novalidate="novalidate" data-customer-information-form="true" data-email-or-phone="true" action="/27646165110/checkouts/7ae5495f5ee275010fd1f898a688518e" accept-charset="UTF-8" method="post"><input type="hidden" name="_method" value="patch" /><input type="hidden" name="authenticity_token" value="OKnrc4q8lkab5aAQ6VZGc8SPLpObgL34QcXoEU7wUAL7gvOBX3/3aaJ+ptFV8nVSKEKi7sGfyeH+bbC6QdQi6A==" />

  <input type="hidden" name="previous_step" id="previous_step" value="contact_information" />
  <input type="hidden" name="step" value="shipping_method" />





  <div class="step__footer" data-step-footer>


  <a class="step__footer__previous-link" href="cart.php"><svg focusable="false" aria-hidden="true" class="icon-svg icon-svg--color-accent icon-svg--size-10 previous-link__icon" role="img" xmlns="https://www.w3.org/2000/svg" viewBox="0 0 10 10"><path d="M8 1L7 0 3 4 2 5l1 1 4 4 1-1-4-4"/></svg><span class="step__footer__previous-link-content">Return to cart</span></a>
</div>

</form>
</div>



 </main>

        </div>
    <div class="col-sm-6" style="background: #fff7e2;padding: 3%;">


<script>
    function removeproduct(id){
        $.ajax({

                type: "POST",
                url: 'cart/remove.php',
                data: 'id='+id,
                success:function(msg) {
                    if(msg==1){
                        // $("#cartmsg2").html('');
                        // $("#cartDrawer").html('');
                        $("#cartmsg2").html('<div class="alert alert-success" role="alert"> Removed </div>');
                        $("#cartDrawer").load('cartdrawer.php');
                        $("#cartmsg2").html('<div class="alert alert-success" role="alert"> Removed </div>');
                    }else if(msg==0){
                        $("#cartmsg2").html('');
                        $("#cartmsg2").html('<div class="alert alert-warning" role="alert"> Errorr </div>');


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

</style>	    <div id="cartmsg2"></div>


	    <div id="cartContainer" >

        <form action="checkout.php" method="post" novalidate="" class="cart ajaxcart" >
<input type="hidden" name="userid" value="<? echo $userid; ?>">
                <input type="hidden" name="cur" value="<? echo $_SESSION['cur'];?>">

            <div class="ajaxCartInner" >
                <?
                $total_amount = 0;

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
                                    <span class="money" ><? echo $cur_sym . ' '. currencyAmount($_SESSION['cur'],$price); ?></span>
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
                                    <span class="money"><? echo $cur_sym . ' '. currencyAmount($_SESSION['cur'],$price)*$qty; ?></span>
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
                            <a class="btnCartNote collapsed" href="#OrderNote" data-toggle="collapse" >
                                <i class="fa fa-times" ></i>
                                add order note
                            </a>
                        </div>
                        <div id="OrderNote" class="velaCartNoteGroup collapse" >
                            <label for="CartSpecialInstructions" >Special instructions for seller</label>
                            <textarea name="note" class="form-control" id="CartSpecialInstructions" rows="4" ></textarea>
                        </div>
                    </div>
                <div class="drawerCartFooter" >
                    <div class="drawerAjaxFooter" >
                        <div class="drawerSubtotal" >
                            <span class="cartSubtotalHeading" >Subtotal</span>
                            <span class="cartSubtotal" ><span class="money"  ><? echo $cur_sym . ' '. $total_amount; ?></span></span>
                        </div>


                    </div>
                </div>
            </div>
        </form>
</div>

<?
$_SESSION['total_amount'] = $total_amount ; 

var_dump($_SESSION);
?>
<script>
    $(document).on('click','.velaQtyMinus',function(){


$("#cartmsg2").html('');

        var cartid = $(this).data("cartid");
        $.ajax({

                type: "POST",
                url: 'cart/remove_one_cart.php',
                data: 'cartid='+cartid,
                success:function(msg) {
                    console.log(msg);
                    if(msg==0){
                         $("#cartmsg2").html('');
                         $("#cartmsg2").html('<div class="alert alert-error" role="alert">Error  </div>');
                    }else if(msg==1){
                         $("#cartmsg2").html('');
                         $("#cartmsg2").html('<div class="alert alert-success" role="alert">Success  </div>');
                    $("#cartDrawer").load('cartdrawer.php');
                                            setTimeout(function(){ window.location.reload(); }, 1000);

                    }else if(msg==2){
                        $("#cartmsg2").html('');
                         $("#cartmsg2").html('<div class="alert alert-warning" role="alert"> Higher Qunatity! </div>');
                    }else if(msg==-1){
                         $("#cartmsg2").html('');
                         $("#cartmsg2").html('<div class="alert alert-success" role="alert">Success  </div>');
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
                    // console.log(msg);
                    if(msg==0){
                        $("#cartmsg2").html('');
                        $("#cartmsg2").html('<div class="alert alert-error" role="alert">Error  </div>');
                        $("#cartDrawer").load('cartdrawer.php');
                    }else if(msg==1){
                        $("#cartmsg2").html('');
                         $("#cartmsg2").html('<div class="alert alert-success" role="alert">Success  </div>');
                        $("#cartDrawer").load('cartdrawer.php');
                        setTimeout(function(){ window.location.reload(); }, 1000);


                    }else if(msg==2){
                        $("input."+cartid).val(inputval);
                        $("#cartmsg2").html('');
                        $("#cartmsg2").html('<div class="alert alert-warning" role="alert"> Higher Qunatity! </div>');
                    }

                }

            });

    });

</script>

        </div>
        <div>

      </div>
    </div>

<script>

$(document).ready(function(){
    $("#del").on('click',function(){

        var ht = '<div class="row" style="text-transform: capitalize;     margin: 10px auto; text-transform: capitalize; padding: 20px;">';
            ht +=   '<div class="col-sm-6"><label for="">person name</label><input type="text" name="person_name" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">person contact</label><input type="text" name="person_contact" class="form-control" required></div>';
            ht +=   '<div class="col-sm-12"><label for="">address</label><input type="text" name="address" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">landmark</label><input type="text" name="landmark" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">city</label><input type="text" name="city" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">state</label><input type="text" name="state" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">country</label><input type="text" name="country" class="form-control" required></div>';
            ht +=   '<div class="col-sm-6"><label for="">pincode</label><input type="text" name="pincode" class="form-control" required></div>';
            ht +=   '<div class="col-sm-12"><br><div class="row"><div class="col-sm-6"><input type="submit" name="del_submit" class="btn btn-success"></div><div class="col-sm-6"><a class="btn btn-danger" data-dismiss="modal">Cancel</a></div></div></div>';

            ht +=   '</div>';
            ht +='<input type="hidden" name="userid" value="<? echo $userid?>"><input type="hidden" name="cur" value="<? echo $cur; ?>">'
            $("#del_form").html(ht);

    });

});

</script>

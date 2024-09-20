<?php session_start();
include_once('site_header.php');

var_dump($_SERVER) ;

?>

<a href="<? echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'] ; ?>/logout.php">Logout</a>



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
           window.location.href="account.php";
       </script> 
    <? }
}


?>

<link rel="stylesheet" href="../amcss.css">



<style>
    .card{
            position: relative;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
    background-color: #fff;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.25rem;
        padding: 10px;
        margin: 10px auto;
    }
</style>


        <main class="mainContent" role="main">
        <div class="container">
            
            <?
            $order_sql = mysqli_query($con,"select * from order_details where user_id = '".$userid."' and ac_typ=2 order by id desc ");
            while($order_sql_result = mysqli_fetch_assoc($order_sql)){ 
            
            $order_id  =  $order_sql_result['id'];
            $image = $order_sql_result['image'];
            $order_date = $order_sql_result['date'];
            $order_date = date('d-M-y',strtotime($order_date));
            ?>


            
            
            <div class="a-box-group a-spacing-base order js-order-card">
<div class="a-box a-color-offset-background order-info"><div class="a-box-inner">
    <div class="a-fixed-right-grid"><div class="a-fixed-right-grid-inner" style="padding-right:290px">
        <div class="a-fixed-right-grid-col a-col-left" style="padding-right:0%;float:left;">
            <div class="a-row">


    
<div class="a-column a-span3">
    

<div class="a-row a-size-mini">
    
<span class="a-color-secondary label">
    Order placed
</span>

</div>
<div class="a-row a-size-base">
    
<span class="a-color-secondary value">
    <? echo $order_date;?> 
</span>

</div>

</div>


            
<div class="a-column a-span2">
    

<div class="a-row a-size-mini">
    
<span class="a-color-secondary label">
    Total
</span>

</div>
<div class="a-row a-size-base">
    
<span class="a-color-secondary value">
    <span style="text-decoration: inherit; white-space: nowrap;"><span class="currencyINR">&nbsp;&nbsp;</span><span class="currencyINRFallback" style="display:none">Rs. </span>1,299.00</span>
</span>

</div>

</div>

            </div>
        </div>
        <div class="a-fixed-right-grid-col actions a-col-right" style="width:290px;margin-right:-290px;float:left;">


            <div class="a-row a-size-mini">

<span class="a-color-secondary label">
    Order #
</span>         
        <span class="a-color-secondary value">
            <bdi dir="ltr"><? echo 'YN-'.$order_id ;?></bdi>
        </span>
</div>

        </div>
    </div></div>
</div></div>









<div class="a-box shipment shipment-is-delivered"><div class="a-box-inner">
    <div class="a-row shipment-top-row js-shipment-info-container">
        <div style="margin-right:230px; padding-right:20px"> 
    
    <div class="a-row">
        <span class="a-size-medium a-color-base a-text-bold">
    Delivered <? echo $order_date; ?>
</span>
    </div>
    <div class="a-row">
        <span data-isstatuswithwarning="0" data-yodeliveryestimate="Delivered 21-Dec-2021" data-yoshortstatuscode="DELIVERED" data-yostatusstring="" class="js-shipment-info aok-hidden">
</span>
    </div>

</div>
    </div>
    <div class="a-fixed-right-grid a-spacing-top-medium"><div class="a-fixed-right-grid-inner a-grid-vertical-align a-grid-top">
        <div class="a-fixed-right-grid-col a-col-left" style="padding-right:3.2%;float:left;">
    
    <div class="a-row">
        <div class="a-fixed-left-grid a-spacing-none"><div class="a-fixed-left-grid-inner" style="padding-left:100px">
        <div class="a-text-center a-fixed-left-grid-col a-col-left" style="width:100px;margin-left:-100px;float:left;">
                
<div class="item-view-left-col-inner">
    






    <a class="a-link-normal" href="/gp/product/B095YZB3MS/ref=ppx_yo_dt_b_asin_image_o03_s00?ie=UTF8&amp;psc=1">
        
<img alt="" src="<? echo $image ; ?>" aria-hidden="true" class="" height="90" width="81" >

    </a>


</div>
        </div>
        <div class="a-fixed-left-grid-col a-col-right" style="padding-left:1.5%;float:left;">
                
    
    <div class="a-row">
        



    <a class="a-link-normal" href="/gp/product/B095YZB3MS/ref=ppx_yo_dt_b_asin_title_o03_s00?ie=UTF8&amp;psc=1">
        Noise Buds VS103 - Truly Wireless Earbuds with 18-Hour Playtime, HyperSync Technology, Full Touch Controls and Voice Assistant (Pearl White)
    </a>


    </div>
    <div class="a-row">
        
    <span class="a-color-secondary a-text-bold">
        
    </span> 
    <span class="a-color-secondary">
        
    </span> 

    </div>
    <div class="a-row">
        
    
<span class="a-declarative" data-action="bia_button" data-bia_button="{}">
        <span class="a-button a-spacing-mini a-button-primary" id="a-autoid-10"><span class="a-button-inner"><a href="/gp/buyagain/ref=ppx_yo_dt_b_bia?ie=UTF8&amp;ats=eyJjdXN0b21lcklkIjoiQTJSRzkyM0ZJVldVSE8iLCJleHBsaWNpdENhbmRpZGF0ZXMiOiJCMDk1%0AWVpCM01TIn0%3D%0A" aria-label="Buy it again" class="a-button-text" role="button" id="a-autoid-10-announce">
            <div class="reorder-modal-trigger-text">
                <i class="reorder-modal-trigger-icon"></i>
                Buy it again
            </div>
        </a></span></span>
</span>

                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div></div>

</div>  


            <? } ?>
        </div>


        </main>
        
        
        <div id="shopify-section-vela-footer" class="shopify-section"><footer id="velaFooter">
    <div class="footerCenter">
        <div class="container">
            <div class="footerCenterInner">
                <div class="rowFlex rowFlexMargin">
                    <div class="col-xs-12 col-sm-6 col-md-3 mb30">
                        <div class="footerInfo"><div class="infoImage"><a href="/" style="width: 130px;">                                       
                                        

<div class="p-relative">
    <div class="product-card__image" style="padding-top:18.461538461538463%;">
        <img class="product-card__img lazyload"
           
            data-src="//cdn.shopify.com/s/files/1/0276/4616/5110/files/logo-white_{width}x.png?v=1589385475"
            data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]"
            data-aspectratio="5.416666666666667"
            data-ratio="5.416666666666667"
            data-sizes="auto"
            alt=""
            
        />
    </div>
    <div class="placeholder-background placeholder-background--animation" data-image-placeholder></div>
</div>


                                    </a>
                                </div><div class="footerSocial">
                                    <div class="d-flex velaSocialFooter">
    <a target="_blank" href="https://www.facebook.com/velatheme">
        <i class="fa fa-facebook"></i>
    </a>
    <a target="_blank" href="https://twitter.com/velatheme">
        <i class="fa fa-twitter"></i>
    </a>
    <a target="_blank" href="https://www.instagram.com/velatheme/">
        <i class="fa fa-instagram"></i>
    </a>
    <a target="_blank" href="https://www.pinterest.com/velatheme/">
        <i class="fa fa-pinterest"></i>
    </a>
<a target="_blank" href="https://velatheme.com">
        <i class="fa fa-youtube-play"></i>
    </a>
</div>
                                </div></div>
                    </div><div class="col-xs-12 col-sm-6 col-md-3 mb30"><div class="velaFooterMenu"><h4 class="velaFooterTitle">Information Company</h4>
	
	<div class="velaContent">
		<ul class="velaFooterLinks list-unstyled">
			
				<li class="active">
					<a href="/account" title="">My Account</a>
				</li>
			
				<li class="">
					<a href="/" title="">Track Your Order</a>
				</li>
			
				<li class="">
					<a href="/pages/faqs" title="">FAQs</a>
				</li>
			
				<li class="">
					<a href="/" title="">Payment Methods</a>
				</li>
			
				<li class="">
					<a href="/policies/shipping-policy" title="">Shipping Guide</a>
				</li>
			
				<li class="">
					<a href="http://velatheme.com/guide/velatheme/product_pages.html" title="">Products Support</a>
				</li>
			
				<li class="">
					<a href="/" title="">Gift Card Balance</a>
				</li>
			
		</ul>
	</div>
</div>
                            
                        </div><div class="col-xs-12 col-sm-6 col-md-3 mb30"><div class="velaFooterMenu"><h4 class="velaFooterTitle">More From Rubix</h4>
	
	<div class="velaContent">
		<ul class="velaFooterLinks list-unstyled">
			
				<li class="">
					<a href="/pages/about-us" title="">About Rubix</a>
				</li>
			
				<li class="">
					<a href="/pages/about-us" title="">Our Guarantees</a>
				</li>
			
				<li class="">
					<a href="/policies/terms-of-service" title="">Terms and Conditions</a>
				</li>
			
				<li class="">
					<a href="/policies/privacy-policy" title="">Privacy Policy</a>
				</li>
			
				<li class="">
					<a href="/policies/refund-policy" title="">Return Policy</a>
				</li>
			
				<li class="">
					<a href="/policies/refund-policy" title="">Delivery & Return</a>
				</li>
			
				<li class="">
					<a href="/" title="">Sitemap</a>
				</li>
			
		</ul>
	</div>
</div>
                        </div><div class="col-xs-12 col-sm-6 col-md-3 mb30">
                            <div class="footerAbout">
                                <h5>Let’s Talk</h5>
<div class="d-flex mb30">
   <div><i class="icons icon-earphones-alt"></i></div>
<div>+391 (0)35 2568 4593 <br><u>hello@domain.com</u>
</div>
</div>
<h5>Find Us</h5>
<div class="d-flex">
<div><i class="icons icon-location-pin"></i></div>
<div>502 New Design Str<br>Melbourne, Australia</div>
</div>
                            </div>
                        </div></div>
            </div>
        </div>
    </div>
    <div class="footerCopyRight">
        <div class="container">
            <div class="footerCopyRightInner clearfix"><div class="velaCopyRight pull-left">
                        <a href="/"><b>© 2020 Rubix.</b></a> All Rights Reserved
                    </div><div class="velaPayment pull-right hidden-xs hidden-sm">
                    <div class="vela-content">
                        
                        <img class="img-responsive" alt="" src="//cdn.shopify.com/s/files/1/0276/4616/5110/files/paymenlogo.png?v=1589386819" />
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
        
    <div id="shopify-section-vela-template-notification" class="shopify-section">
</div>



<!-- large modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Add Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="card">
                <div class="row">
                    <form action="<? echo $_SERVER['PHP_SELF'];?>?action=add_del" id="del_form" method="POST"></form>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>






<script>
   



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
            $("#del_form").html(ht);

    });
    
</script>







    <script type="text/javascript">
        $(window).on("load",function() {
            var dateCookie = new Date();
            var minutes = 60;
            dateCookie.setTime(dateCookie.getTime() + (minutes * 60 * 1000));
            setTimeout(function () {
                if ( document.body.classList.contains('template-collection') && ($("#velaNotifiCollection").length > 0) && ($.cookie('velaNotifiCollectioin') != 'closed')) {
                    $.fancybox.open({
                        src  : '#velaNotifiCollection',
                        opts : {
                            padding: 0,
                            beforeLoad: function(){
                                $('#velaNotifiCollection').removeClass('hidden');
                            },
                            href: '#velaNotifiCollection',
                            helpers:  {
                                overlay : true
                            },
                            afterClose : function(){
                                $('#velaNotifiCollection').addClass('hidden');
                                $.cookie('velaNotifiCollectioin', 'closed', {expires:dateCookie, path:'/'});
                            }
                        }
                    });
                }
                else if ( document.body.classList.contains('template-blog') && ($("#velaNotifiBlog").length > 0) && ($.cookie('velaNotifiBlog') != 'closed')) {
                    $.fancybox.open({
                        src  : '#velaNotifiBlog',
                        opts : {
                            padding: 0,
                            beforeLoad: function(){
                                $('#velaNotifiBlog').removeClass('hidden');
                            },
                            href: '#velaNotifiBlog',
                            helpers:  {
                                overlay : true
                            },
                            afterClose : function(){
                                $('#velaNotifiBlog').addClass('hidden');
                                $.cookie('velaNotifiBlog', 'closed', {expires:dateCookie, path:'/'});
                            }
                        }
                    });
                }
                else if (document.body.classList.contains('template-product') && ($("#velaNotifiProduct").length > 0) && ($.cookie('velaNotifiProduct') != 'closed')) {
                    $.fancybox.open({
                        src  : '#velaNotifiProduct',
                        opts : {
                            padding: 0,
                            beforeLoad: function(){
                                $('#velaNotifiProduct').removeClass('hidden');
                            },
                            href: '#velaNotifiProduct',
                            helpers:  {
                                overlay : true
                            },
                            afterClose : function(){
                                $('#velaNotifiProduct').addClass('hidden');
                                $.cookie('velaNotifiProduct', 'closed', {expires:dateCookie, path:'/'});
                            }
                        }
                    });
                }
                else if ( document.body.classList.contains('template-page') && ($("#velaNotifiPage").length > 0) && ($.cookie('velaNotifiPage') != 'closed')) {
                    $.fancybox.open({
                        src  : '#velaNotifiPage',
                        opts : {
                            padding: 0,
                            beforeLoad: function(){
                                $('#velaNotifiPage').removeClass('hidden');
                            },
                            href: '#velaNotifiPage',
                            helpers:  {
                                overlay : true
                            },
                            afterClose : function(){
                                $('#velaNotifiPage').addClass('hidden');
                                $.cookie('velaNotifiPage', 'closed', {expires:dateCookie, path:'/'});
                            }
                        }
                    });
                }
                else if (($("#velaNotifi").length > 0) && ($.cookie('velaNotifi') != 'closed')){
                    $.fancybox.open({
                        src  : '#velaNotifi',
                        opts : {
                            padding: 0,
                            beforeLoad: function(){
                                $('#velaNotifi').removeClass('hidden');
                            },
                            href: '#velaNotifi',
                            helpers:  {
                                overlay : true
                            },
                            afterClose : function(){
                                $('#velaNotifi').addClass('hidden');
                                $.cookie('velaNotifi', 'closed', {expires:dateCookie, path:'/'});
                            }
                        }
                    });
                }
                
            }, 0);
        });
    </script>

    </div>
    <script id="CartTemplate" type="text/template">
    
        <form action="/cart" method="post" novalidate class="cart ajaxcart">
            <div class="ajaxCartInner">
                {{#items}}
                <div class="ajaxCartProduct">
                    <div class="drawerProduct ajaxCartRow" data-line="{{line}}">
                        <div class="drawerProductImage">
                            <a href="{{url}}"><img class="img-responsive" src="{{img}}" alt="" /></a>
                        </div>
                        <div class="drawerProductContent">
                            <div class="drawerProductTitle">
                                <a href="{{url}}">{{name}}</a>
                                {{#if variation}}
                                    <span>{{variation}}</span>
                                {{/if}}
                                {{#properties}}
                                    {{#each this}}
                                        {{#if this}}
                                            <span>{{@key}}: {{this}}</span>
                                        {{/if}}
                                    {{/each}}
                                {{/properties}}

                                

                            </div>
                            <div class="drawerProductPrice">
                                <div class="priceProduct">
                                    {{{price}}}
                                </div>
                            </div>
                            <div class="drawerProductQty">
                                <div class="velaQty">
                                    <button type="button" class="qtyAdjust velaQtyButton velaQtyMinus" data-id="{{id}}" data-qty="{{itemMinus}}" data-line="{{line}}">
                                        <span class="txtFallback">&minus;</span>
                                    </button>
                                    <input type="text" name="updates[]" class="qtyNum velaQtyText" value="{{itemQty}}" min="0" data-id="{{id}}" data-line="{{line}}"  pattern="[0-9]*" />
                                    <button type="button" class="qtyAdjust velaQtyButton velaQtyPlus" data-id="{{id}}" data-line="{{line}}" data-qty="{{itemAdd}}">
                                        <span class="txtFallback">+</span>
                                    </button>
                                </div>
                            </div>
                            <div class="drawerProductDelete">
                                <div class="cartRemoveBox">
                                    <a href="#" class="cartRemove btnClose" onclick="return false;" data-line="{{ line }}">
                                        <span>Remove</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{/items}}
                
    
                
    
                    <div class="ajaxCartNote">
                        <div class="velaCartNoteButton">
                            <a class="btnCartNote collapsed" href="#velaCartNote" data-toggle="collapse">
                                <i class="fa fa-times"></i>
                                add order note
                            </a>
                        </div>
                        <div id="velaCartNote" class="velaCartNoteGroup collapse">
                            <label for="CartSpecialInstructions">Special instructions for seller</label>
                            <textarea name="note" class="form-control" id="CartSpecialInstructions" rows="4">{{ note }}</textarea>
                        </div>
                    </div>
    
                
    
                <div class="drawerCartFooter">
                    <div class="drawerAjaxFooter">
                        <div class="drawerSubtotal">
                            <span class="cartSubtotalHeading">Subtotal</span>
                            <span class="cartSubtotal">{{{totalPrice}}}</span>
                        </div>
                        <p class="drawerShipping">Shipping, taxes, and discounts will be calculated at checkout.</p>
                        <div class="drawerButton">
                            <div class="drawerButtonBox">
                                <a class="btn btnVelaCart btnViewCart" href="/cart">
                                    View Cart
                                </a>
                            </div>
                            <div class="drawerButtonBox">
                                <button type="submit" class="btn btnVelaCart btnCheckout" name="checkout">
                                    Check Out
                                </button>
                            </div>
    
                            
    
                        </div>
                    </div>
                </div>
            </div>
        </form>
    
</script>
<script id="headerCartTemplate" type="text/template">
    <form action="/cart" method="post" novalidate class="cart ajaxcart">
    <div class="headerCartInner">
        <div class="headerCartScroll">

        {{#items}}
            <div class="ajaxCartProduct">
                <div class="ajaxCartRow rowFlex" data-line="{{line}}">
                    <div class="headerCartImage">
                        <a href="{{url}}"><img class="img-responsive" src="{{img}}" alt="" /></a>
                    </div>
                    <div class="headerCartContent">
                        <div class="headerCartInfo">
                            <a href="{{url}}" class="headerCartProductName">{{name}}</a>
                            {{#if variation}}
                                <div class="headerCartProductMeta">{{variation}}</div>
                            {{/if}}
                            {{#properties}}
                                {{#each this}}
                                    {{#if this}}
                                        <div class="headerCartProductMeta">{{@key}}: {{this}}</div>
                                    {{/if}}
                                {{/each}}
                            {{/properties}}
        
                            
        
                            <div class="headerCartPrice">
                                {{{price}}} <span class="d-block">x {{itemQty}}</span>
                            </div>
                        </div>
                        <div class="headerCartRemoveBox">
                            <a href="#" class="cartRemove" onclick="return false;" data-line="{{ line }}">
                                <i class="btnClose"></i> <span>Remove</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        {{/items}}
        </div>
        <div class="headerCartTotal">
            <span class="headerCartTotalTitle">Subtotal</span>
            <span class="headerCartTotalNum">{{{totalPrice}}}</span>
        </div>
        <div class="headerCartButton d-flex">
            <div class="headerCartButtonBox mr10">
                <a class="btn btnVelaCart btnViewCart" href="/cart">
        
                    View Cart
        
                </a>
            </div>
            <div class="headerCartButtonBox">
                <button type="submit" class="btn btnVelaCart btnCheckout" name="checkout">
        
                    Check Out
        
                </button>
            </div>
        </div>

    </div>
    </form>
</script>
<script id="velaAjaxQty" type="text/template">
    
        <div class="velaQty">
            <button type="button" class="qtyAdjust velaQtyButton velaQtyMinus" data-id="{{id}}" data-qty="{{itemMinus}}">
                <span class="txtFallback">&minus;</span>
            </button>
            <input type="text" class="qtyNum velaQtyText" value="{{itemQty}}" min="0" data-id="{{id}}" aria-label="quantity" pattern="[0-9]*">
            <button type="button" class="qtyAdjust velaQtyButton velaQtyPlus" data-id="{{id}}" data-qty="{{itemAdd}}">
                <span class="txtFallback">+</span>
            </button>
        </div>
    
</script>
<script id="velaJsQty" type="text/template">
    
        <div class="velaQty">
            <button type="button" class="velaQtyAdjust velaQtyButton velaQtyMinus" data-id="{{id}}" data-qty="{{itemMinus}}">
                <span class="txtFallback">&minus;</span>
            </button>
            <input type="text" class="velaQtyNum velaQtyText" value="{{itemQty}}" min="1" data-id="{{id}}" aria-label="quantity" pattern="[0-9]*" name="{{inputName}}" id="{{inputId}}" />
            <button type="button" class="velaQtyAdjust velaQtyButton velaQtyPlus" data-id="{{id}}" data-qty="{{itemAdd}}">
                <span class="txtFallback">+</span>
            </button>
        </div>
    
</script>
    <div id="loading" style="display:none;"></div>
    
    <div id="velaQuickView" style="display:none;">
        <div class="quickviewOverlay"></div>
        <div class="jsQuickview"></div>
        <div id="quickviewModal" class="quickviewProduct" style="display:none;">
            <a title="Close" class="quickviewClose btnClose" href="javascript:void(0);"></a>
            <div class="proBoxPrimary row">
                <div class="proBoxImage col-xs-12 col-sm-12 col-md-5">
                    <div class="proFeaturedImage">
                        <a class="proImage" title="" href="#">
                            <img class="img-responsive proImageQuickview" src="//cdn.shopify.com/s/files/1/0276/4616/5110/t/6/assets/loading.gif?v=4737358046173361859" alt="Quickview"  />
                            <span class="loadingImage"></span>
                        </a>
                    </div>
                    <div class="proThumbnails proThumbnailsQuickview clearfix">
                        <div class="owl-thumblist">
                            <div class="owl-carousel">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="proBoxInfo col-xs-12 col-sm-12 col-md-7">
                    <h3 class="quickviewName mb20">&nbsp;</h3>
                    <div class="proShortDescription rte"></div>
                    
                    <form action="/cart/add" method="post" enctype="multipart/form-data" class="formQuickview form-ajaxtocart">                       
                        <div class="proVariantsQuickview"><select name='id' style="display:none"></select></div>
                        <div class="proPrice clearfix">
                            <span class="priceProduct priceCompare"></span>
                            <span class="priceProduct pricePrimary"></span>
                            
                        </div>
                        <div class="velaGroup d-flex flexAlignEnd mb20">
                            <div class="proQuantity">
                                <!-- <label for="Quantity" class="qtySelector">Quantity</label> -->
                                <input type="number" id="Quantity" name="quantity" value="1" min="1" class="qtySelector">
                            </div>
                            <div class="proButton">
                                <button type="submit" name="add" class="btn btnAddToCart">
                                    <span>Add to Cart</span>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="proAttr quickviewAvailability"></div>
                    <div class="proAttr quickViewVendor"></div>
                    <div class="proAttr quickViewType"></div>
                    <div class="proAttr quickViewSKU"></div>
                   
                </div>
            </div>
        </div>    
    </div><div id="goToTop" class="hidden-xs hidden-sm"><span class="fa fa-angle-up"></span></div><div id="velaPreLoading">
        <span></span>
        <div class="velaLoading">
            <span class="velaLoadingIcon one"></span>
            <span class="velaLoadingIcon two"></span>
            <span class="velaLoadingIcon three"></span>
            <span class="velaLoadingIcon four"></span>
        </div>
    </div>
    

    <script src="//cdn.shopify.com/shopifycloud/shopify/assets/themes_support/shopify_common-8ea6ac3faf357236a97f5de749df4da6e8436ca107bc3a4ee805cbf08bc47392.js" type="text/javascript"></script>
<script src="//cdn.shopify.com/shopifycloud/shopify/assets/themes_support/option_selection-fe6b72c2bbdd3369ac0bfefe8648e3c889efca213baefd4cfb0dd9363563831f.js" type="text/javascript"></script>
<script src="//cdn.shopify.com/shopifycloud/shopify/assets/themes_support/api.jquery-e94e010e92e659b566dbc436fdfe5242764380e00398907a14955ba301a4749f.js" type="text/javascript"></script>
<script src="//cdn.shopify.com/s/javascripts/currencies.js" type="text/javascript"></script>
<script src="//cdn.shopify.com/s/files/1/0276/4616/5110/t/6/assets/vendor.js?v=13878651640065809907" type="text/javascript"></script>
<script src="//cdn.shopify.com/s/files/1/0276/4616/5110/t/6/assets/vela_ajaxcart.js?v=14082523266353193198" type="text/javascript"></script>
<script src="//cdn.shopify.com/s/files/1/0276/4616/5110/t/6/assets/lazysizes.min.js?v=15377268347072223862" async="async"></script>
<script src="//cdn.shopify.com/s/files/1/0276/4616/5110/t/6/assets/vela.js?v=11348010493869627964" type="text/javascript"></script>
<script src="//cdn.shopify.com/s/files/1/0276/4616/5110/t/6/assets/jquery.cookie.js?v=7236575574540404818" type="text/javascript"></script>

<script type="text/javascript">
    if (window.currencies) {
        Currency.format = "money_format";
        var shopCurrency = window.currency;
        Currency.moneyFormats[shopCurrency].money_with_currency_format = window.shop_money_with_currency_format;
        Currency.moneyFormats[shopCurrency].money_format = window.shop_money_format;
        var defaultCurrency = 'USD';
        var cookieCurrency = Currency.cookie.read();
        var velaCurrencies = $('[name=currencies]'),
            velaCurrencyItem = $('.jsvela-currency__item'),
            velaCurrencyCurrent = $('.jsvela-currency__current');
        $('span.money span.money').each(function() {
            $(this).parents('span.money').removeClass('money');
        });
        $('span.money').each(function() {
            $(this).attr('data-currency-' + window.currency, $(this).html());
        });
        if (cookieCurrency == null) {
            if (shopCurrency !== defaultCurrency) {
                Currency.convertAll(shopCurrency, defaultCurrency);
            }
            else {
                Currency.currentCurrency = defaultCurrency;
            }
        }
        else if ($('[name=currencies]').size() && $('[name=currencies] .jsvela-currency__item[data-value=' + cookieCurrency + ']').size() === 0) {
            Currency.currentCurrency = shopCurrency;
            Currency.cookie.write(shopCurrency);
        }
        else if (cookieCurrency === shopCurrency) {
            Currency.currentCurrency = shopCurrency;
        }
        else {
            Currency.currentCurrency = cookieCurrency;
            Currency.convertAll(shopCurrency, cookieCurrency);
            velaCurrencies.data('value', cookieCurrency);
            velaCurrencyItem.removeClass('active');
            velaCurrencyItem.each(function() {
                if ($(this).data('value') === cookieCurrency)
                    $(this).addClass('active');
            });

        }
        $('body').on('click', '.jsvela-currency__item', function() {
            var newCurrency = $(this).data('value');
            velaCurrencies.data('value', newCurrency);
            velaCurrencyItem.removeClass('active');
            $(this).addClass('active');
            Currency.convertAll(Currency.currentCurrency, newCurrency);
            velaCurrencyCurrent.text(Currency.currentCurrency);
            return false;
        });
        var original_selectCallback = window.selectCallback;
        var selectCallback = function(variant, selector) {
            original_selectCallback(variant, selector);
            Currency.convertAll(shopCurrency, $('[name=currencies]').data('value'));
            velaCurrencyCurrent.text(Currency.currentCurrency);
        };
        $('body').on('ajaxCart.afterCartLoad', function(cart) {
            Currency.convertAll(shopCurrency, $('[name=currencies]').data('value'));
            velaCurrencyCurrent.text(Currency.currentCurrency);  
        });
        velaCurrencyCurrent.text(Currency.currentCurrency);
    }
</script>
</body>
</html>

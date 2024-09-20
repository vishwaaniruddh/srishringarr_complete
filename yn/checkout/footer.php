
<div id="shopify-section-vela-footer" class="shopify-section"><footer id="velaFooter">
   <div class="footerCenter">
       <div class="container">
           <div class="footerCenterInner">
               <div class="rowFlex rowFlexMargin">
                   <div class="col-xs-12 col-sm-6 col-md-3 mb30">
                       <div class="footerInfo"><div class="infoImage"><a href="/" style="width: 130px;">


<div class="p-relative">
   <div class="product-card__image" style="padding-top:2.461538%;">
       <!-- <img class="product-card__img lazyautosizes lazyloaded" data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]" data-aspectratio="5.416666666666667" data-ratio="5.416666666666667" data-sizes="auto" alt="" data-srcset="/assets/logo.png"> -->
        <img src="/assets/logo.jpg" style="width:100%" >
   </div>
   <div class="placeholder-background placeholder-background--animation" data-image-placeholder=""></div>
</div>


</a>
</div>
    <div class="footerSocial">
        <div class="d-flex velaSocialFooter">
            <a target="_blank" href="https://www.facebook.com/YosshitaandNehaFashionStudio/">
                <i class="fa fa-facebook"></i>
            </a>
            <a target="_blank" href="https://twitter.com/yosshitaneha/">
                <i class="fa fa-twitter"></i>
            </a>
            <a target="_blank" href="https://www.instagram.com/yosshitanehafashionstudio/">
                <i class="fa fa-instagram"></i>
            </a>
            <a target="_blank" href="https://in.pinterest.com/yosshitaandneha/">
                <i class="fa fa-pinterest"></i>
            </a>
            <!-- <a target="_blank" href="https://velatheme.com">
                <i class="fa fa-youtube-play"></i>
            </a> -->
        </div>
    </div>
</div>
                   </div><div class="col-xs-12 col-sm-6 col-md-3 mb30"><div class="velaFooterMenu"><h4 class="velaFooterTitle">Information Company</h4>

	<div class="velaContent" style="">
		<ul class="velaFooterLinks list-unstyled">

				<li class="">
					<a href="https://yosshitaneha.com/account/account.php" title="">My Account</a>
				</li>

				<li class="">
					<a href="#" title="">Track Your Order</a>
				</li>

				<li class="">
					<a href="#" title="">FAQs</a>
				</li>

				<!-- <li class="">
					<a href="/" title="">Payment Methods</a>
				</li> -->

				<li class="">
					<a href="https://yosshitaneha.com/shippingpolicy.php" title="">Shipping Guide</a>
				</li>

				<li class="">
					<a href="#" title="">Products Support</a>
				</li>

				<li class="">
					<a href="/" title="">Gift Card Balance</a>
				</li>

		</ul>
	</div>
</div>

                       </div><div class="col-xs-12 col-sm-6 col-md-3 mb30"><div class="velaFooterMenu"><h4 class="velaFooterTitle">More From YosshitaNeha</h4>

	<div class="velaContent" style="">
		<ul class="velaFooterLinks list-unstyled">

				<li class="">
					<a href="https://yosshitaneha.com/about_us.php" title="">About YosshitaNeha</a>
				</li>

				<!-- <li class="">
					<a href="/pages/about-us" title="">Our Guarantees</a>
				</li> -->

				<li class="">
					<a href="https://yosshitaneha.com/termsConditions.php" title="">Terms and Conditions</a>
				</li>

				<li class="">
					<a href="https://yosshitaneha.com/privacypolicy.php" title="">Privacy Policy</a>
				</li>

				<li class="">
					<a href="https://yosshitaneha.com/deliveryandreturn.php" title="">Delivery &amp; Return</a>
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
<div>9324243011 / 7400413163 <br><u>yosshita.neha@gmail.com</u>
</div>
</div>
<h5>Find Us</h5>
<div class="d-flex">
<div><i class="icons icon-location-pin"></i></div>
<div> Shyamkamal Building B/1,Flat No 104,1st Floor, Agarwal Market,<br>Near Deenanath Mangeshkar Natya Mandir, Vile Parle East, <br>Mumbai 400057</div>
</div>
                           </div>
                       </div></div>
           </div>
       </div>
   </div>
</footer>
</div>


<div id="shopify-section-vela-template-notification" class="shopify-section">
</div>
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



    <div id="goToTop" class="hidden-xs hidden-sm" style="display: block;"><span class="fa fa-angle-up"></span></div>

   <div id="velaNewsletterModal" class="hidden" style="display: none;">
           <div class="newsletterModal">
               <div class="velaNewsletterModal text-center">
                   <h3 class="velaTitle">Get Our Email Letter</h3>
                   <div class="velaContent">

                           <div class="newsletterDescription">Subscribe to the Rubix mailing list to receive updates on new arrivals, special offers and other discount information.</div>


    <form action="https://velatheme.us13.list-manage.com/subscribe/post-json?u=4d8c80acdd82f3c48d27467f6&amp;id=d52e6e4f14&amp;c=?" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank" class="js-vela-newsletter formNewsletter clearfix">
                               <div class="input-group">
                                   <input type="email" value="" placeholder="Your email address..." name="EMAIL" id="mail" class="js-input-newsletter form-control" aria-label="Your email address...">
                                   <span class="input-group-addon">
                                       <button id="subscribe" class="btn btnNewsletter" type="submit">
                                           <i class="pe-7s-paper-plane"></i>
                                           <span>Subscribe</span>
                                       </button>
                                   </span>
                               </div>
                           </form>

                       <div class="checkbox checkGroup">
                           <input id="chkNewsletterModal" name="show-again" type="checkbox"><label for="chkNewsletterModal"> Don't show this popup again</label>
                       </div>
                   </div>
               </div>
           </div>
       </div>

        <!-- <script type="text/javascript">
           $(window).on("load",function() {
               var dateCookie = new Date();
               var minutes = 60;
               var chkShowAgain = $('#chkNewsletterModal');
               dateCookie.setTime(dateCookie.getTime() + (minutes * 60 * 1000));
               setTimeout(function () {
                   if ($.cookie('newLetterModal') != 'closed') {
                       $.fancybox.open({
                           src  : '#velaNewsletterModal',
                           opts : {
                               padding: 0,
                               beforeLoad: function(){
                                   $('#velaNewsletterModal').removeClass('hidden');
                               },
                               href: '#velaNewsletterModal',
                               helpers:  {
                                   overlay : true
                               },
                               afterClose : function(){
                                   $('#velaNewsletterModal').addClass('hidden');
                                   if(chkShowAgain.is(':checked')){
                                       $.cookie('newLetterModal', 'closed', {expires:dateCookie, path:'/'});
                                   }
                               }
                           }
                       });
                   }
               }, 0);
           });
        </script> -->

        <script src="../js/option_selection.js" type="text/javascript"></script>
        <script src="../js/api.jquery.js" type="text/javascript"></script>
        <script src="../js/currencies.js" type="text/javascript"></script>
        <script src="../js/vendor.js" type="text/javascript"></script>
        <script src="../js/vela_ajaxcart.js" type="text/javascript"></script>
        <script src="../js/lazysizes.min.js" async="async"></script>
        <script src="../js/vela.js" type="text/javascript"></script>
        <script src="../js/jquery.cookie.js" type="text/javascript"></script>
        <script type="text/javascript">

</script>
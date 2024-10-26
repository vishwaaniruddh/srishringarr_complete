<div id="shopify-section-vela-footer" class="shopify-section">
	<footer id="velaFooter">
		<div class="footerCenter">
			<div class="container">
				<div class="footerCenterInner">
					<div class="rowFlex rowFlexMargin">
						<div class="col-xs-12 col-sm-6 col-md-3 mb30">
							<div class="footerInfo">
								<div class="infoImage"><a href="/" style="width: 130px;">


										<div class="p-relative">
											<div class="product-card__image" style="padding-top:2.461538%;">

												<img src="https://<? echo $_SERVER['SERVER_NAME']?>/yn/assets/logo.jpg" 
    												style="width:100%;" 
												alt="Yosshita Neha Fashion Studio Logo"

												/>
											</div>
											<div class="placeholder-background placeholder-background--animation"
												data-image-placeholder=""></div>
										</div>


									</a>
								</div>
								<div class="footerSocial">
									<div class="d-flex velaSocialFooter">
										<a target="_blank"
											href="https://www.facebook.com/YosshitaandNehaFashionStudio/">
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
						</div>
						<div class="col-xs-12 col-sm-6 col-md-3 mb30">
							<div class="velaFooterMenu">
								<h4 class="velaFooterTitle">Information Company</h4>

								<div class="velaContent" style="">
									<ul class="velaFooterLinks list-unstyled">

										<li class="">
											<a href="https://<? echo $_SERVER['SERVER_NAME']?>/yn/account/account.php"
												title="">My Account</a>
										</li>

										<li class="">
											<a href="https://<? echo $_SERVER['SERVER_NAME']?>/yn/faq.php"
												title="">FAQs</a>
										</li>


										<li class="">
											<a href="https://<? echo $_SERVER['SERVER_NAME']?>/yn/shippingpolicy.php"
												title="">Shipping Guide</a>
										</li>

									</ul>
								</div>
							</div>

						</div>
						<div class="col-xs-12 col-sm-6 col-md-3 mb30">
							<div class="velaFooterMenu">
								<h4 class="velaFooterTitle">More From YosshitaNeha</h4>

								<div class="velaContent" style="">
									<ul class="velaFooterLinks list-unstyled">

										<li class="">
											<a href="https://<? echo $_SERVER['SERVER_NAME']?>/yn/about_us.php"
												title="">About YosshitaNeha</a>
										</li>

										<li class="">
											<a href="https://<? echo $_SERVER['SERVER_NAME']?>/yn/termsConditions.php"
												title="">Terms and Conditions</a>
										</li>

										<li class="">
											<a href="https://<? echo $_SERVER['SERVER_NAME']?>/yn/privacypolicy.php"
												title="">Privacy Policy</a>
										</li>

										<li class="">
											<a href="https://<? echo $_SERVER['SERVER_NAME']?>/yn/deliveryandreturn.php"
												title="">Delivery &amp; Return</a>
										</li>

										<li class="">
											<a href="/" title="">Sitemap</a>
										</li>

									</ul>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-3 mb30">
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
									<div> Shyamkamal Building B/1,Flat No 104,1st Floor, Agarwal Market,<br>Near
										Deenanath Mangeshkar Natya Mandir, Vile Parle East, <br>Mumbai 400057</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>


<div id="shopify-section-vela-template-notification" class="shopify-section">
</div>
<script type="text/javascript">
	$(window).on("load", function () {
		var dateCookie = new Date();
		var minutes = 60;
		dateCookie.setTime(dateCookie.getTime() + (minutes * 60 * 1000));
		setTimeout(function () {
			if (document.body.classList.contains('template-collection') && ($("#velaNotifiCollection").length > 0) && ($.cookie('velaNotifiCollectioin') != 'closed')) {
				$.fancybox.open({
					src: '#velaNotifiCollection',
					opts: {
						padding: 0,
						beforeLoad: function () {
							$('#velaNotifiCollection').removeClass('hidden');
						},
						href: '#velaNotifiCollection',
						helpers: {
							overlay: true
						},
						afterClose: function () {
							$('#velaNotifiCollection').addClass('hidden');
							$.cookie('velaNotifiCollectioin', 'closed', { expires: dateCookie, path: '/' });
						}
					}
				});
			}
			else if (document.body.classList.contains('template-blog') && ($("#velaNotifiBlog").length > 0) && ($.cookie('velaNotifiBlog') != 'closed')) {
				$.fancybox.open({
					src: '#velaNotifiBlog',
					opts: {
						padding: 0,
						beforeLoad: function () {
							$('#velaNotifiBlog').removeClass('hidden');
						},
						href: '#velaNotifiBlog',
						helpers: {
							overlay: true
						},
						afterClose: function () {
							$('#velaNotifiBlog').addClass('hidden');
							$.cookie('velaNotifiBlog', 'closed', { expires: dateCookie, path: '/' });
						}
					}
				});
			}
			else if (document.body.classList.contains('template-product') && ($("#velaNotifiProduct").length > 0) && ($.cookie('velaNotifiProduct') != 'closed')) {
				$.fancybox.open({
					src: '#velaNotifiProduct',
					opts: {
						padding: 0,
						beforeLoad: function () {
							$('#velaNotifiProduct').removeClass('hidden');
						},
						href: '#velaNotifiProduct',
						helpers: {
							overlay: true
						},
						afterClose: function () {
							$('#velaNotifiProduct').addClass('hidden');
							$.cookie('velaNotifiProduct', 'closed', { expires: dateCookie, path: '/' });
						}
					}
				});
			}
			else if (document.body.classList.contains('template-page') && ($("#velaNotifiPage").length > 0) && ($.cookie('velaNotifiPage') != 'closed')) {
				$.fancybox.open({
					src: '#velaNotifiPage',
					opts: {
						padding: 0,
						beforeLoad: function () {
							$('#velaNotifiPage').removeClass('hidden');
						},
						href: '#velaNotifiPage',
						helpers: {
							overlay: true
						},
						afterClose: function () {
							$('#velaNotifiPage').addClass('hidden');
							$.cookie('velaNotifiPage', 'closed', { expires: dateCookie, path: '/' });
						}
					}
				});
			}
			else if (($("#velaNotifi").length > 0) && ($.cookie('velaNotifi') != 'closed')) {
				$.fancybox.open({
					src: '#velaNotifi',
					opts: {
						padding: 0,
						beforeLoad: function () {
							$('#velaNotifi').removeClass('hidden');
						},
						href: '#velaNotifi',
						helpers: {
							overlay: true
						},
						afterClose: function () {
							$('#velaNotifi').addClass('hidden');
							$.cookie('velaNotifi', 'closed', { expires: dateCookie, path: '/' });
						}
					}
				});
			}

		}, 0);
	});
</script>

<div id="loading" style="display:none;"></div>





<script src="https://<? echo $_SERVER['SERVER_NAME']?>/yn/js/option_selection.js" type="text/javascript"></script>
<script src="https://<? echo $_SERVER['SERVER_NAME']?>/yn/js/api.jquery.js" type="text/javascript"></script>
<script src="https://<? echo $_SERVER['SERVER_NAME']?>/yn/js/currencies.js" type="text/javascript"></script>
<script src="https://<? echo $_SERVER['SERVER_NAME']?>/yn/js/vendor.js" type="text/javascript"></script>
<script src="https://<? echo $_SERVER['SERVER_NAME']?>/yn/js/vela_ajaxcart.js" type="text/javascript"></script>
<script src="https://<? echo $_SERVER['SERVER_NAME']?>/yn/js/lazysizes.min.js" async="async"></script>
<script src="https://<? echo $_SERVER['SERVER_NAME']?>/yn/js/vela.js" type="text/javascript"></script>
<script src="https://<? echo $_SERVER['SERVER_NAME']?>/yn/js/jquery.cookie.js" type="text/javascript"></script>
<script type="text/javascript">
</script>
</body>

</html>
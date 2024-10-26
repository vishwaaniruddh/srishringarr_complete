<?php include('./header.php');


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


$productName = $_REQUEST['name'];
if($productName){

    $getsql = mysqli_query($con,"select * from garment_product where yn_productName='".$productName."'");
    $getsqlResult = mysqli_fetch_assoc($getsql);    
    $id = $getsqlResult['gproduct_id'];
    $product_id = $prid = $id;    
}
else{

$id = $_REQUEST['id'];
$product_id = $prid = $id;

}


    $userid = $_SESSION['gid'];

    if(isset($_SESSION['cur'])){
        $currency = $_SESSION['cur'];
    }else{
        $currency = $_SESSION['cur']='INR';
    }

    $currency_symbolsql  = mysqli_query($con,"select symbol from conversion_rates where currency='".$currency."'") ;
    $currency_symbolsql_result = mysqli_fetch_assoc($currency_symbolsql);
    $currency_symbol = $currency_symbolsql_result['symbol'];
    $cur = $_SESSION['cur'];

   $type  = 2;

   $userid = $_SESSION['userid'];
   $transtyp = 1;


       $sql="select * from  `garment_product` where gproduct_id='".$prid."'";

   $table=mysqli_query($con,$sql);
   $rws=mysqli_fetch_array($table);
   $sku = $rws[2];
   $mainCategory = $rws['product_for'];

    $youtube = $rws[35];


$proddetails = $rws[4];

       $sqlimg="SELECT img_name FROM `product_images_new` WHERE `gproduct_id`='$prid' order by rank";


   $qryimg=mysqli_query($con,$sqlimg);
   $rowimg=mysqli_fetch_row($qryimg);
   $pathmain = 'https://srishringarr.com/yn/';
   if($youtube){
            $ytarray=explode("/", $youtube);
            $ytendstring=end($ytarray);
            $ytendarray=explode("?v=", $ytendstring);
            $ytendstring=end($ytendarray);
            $ytendarray=explode("&", $ytendstring);
            $ytcode=$ytendarray[0];
            $imgframe =  "<iframe title=\"\" width=\"100%\" height=\"315\" src=\"https://www.youtube.com/embed/$ytcode\" autoplay=\"0\"  frameborder=\"0\" allowfullscreen></iframe>";
    }
    else if($rowimg[0]){
            $path = trim($pathmain."uploads".$rowimg[0]);
            $source_img = trim("yn/uploads".$rowimg[0]);
            $filename = basename($source_img);
            $_file_parent = "https://srishringarr.com/yn/";
            $_new_filename = $_file_parent.$source_img;
            // $destination_img = 'comimage/com_'.$filename;
            if(!file_exists($_new_filename)){
               $destination_img =  $path;
            }else{
                $destination_img =  str_replace($filename,'',$source_img) .'com_'.$filename;
            }
            $imgframe = '<img alt="'.$productName.'" class="lazyload img-fluid product_img" style="width: 100%; object-fit: contain; user-select: auto;" data-src="' . $destination_img . '">';

    }else{
    // $path='';
    }

       $re = mysqli_query($con3,"SELECT unit_price,cost_price,quantity FROM phppos_items where name like '".$rws[2]."'");
       $qty = 0;
       if(mysqli_num_rows($re)>0){
       $rero = mysqli_fetch_row($re);

       $qty = $rero[2];
       
       $unit_price = $rero[0];
       
       }
      // echo $qty;die;


      
   ?>

   <meta property="og:site_name" content="velademorubix-fashion">
	<meta property="og:url" content="https://velademorubix-fashion.myshopify.com/products/arctander-chair">
	<meta property="og:title" content="Cotton Fleece Jogging Pants">
	<meta property="og:type" content="product">
	<meta property="og:description" content="Most of us are familiar with the iconic design of the egg shaped chair floating in the air. The Hanging Egg Chair is a critically acclaimed design that has enjoyed praise worldwide ever since the distinctive sculptural shape was created. [SHORTDESCRIPTION] Most of us are familiar with the iconic design of the egg shape">
	<meta property="og:price:amount" content="39.00">
	<meta property="og:price:currency" content="USD">
	<meta property="og:image" content="https://cdn.shopify.com/s/files/1/0276/4616/5110/products/2_1copy_1024x1024.jpg?v=1589430616">
	<meta property="og:image" content="https://cdn.shopify.com/s/files/1/0276/4616/5110/products/2_2copy_1024x1024.jpg?v=1589430616">
	<meta property="og:image" content="https://cdn.shopify.com/s/files/1/0276/4616/5110/products/2_3copy_1024x1024.jpg?v=1589430616">
	<meta property="og:image:secure_url" content="https://cdn.shopify.com/s/files/1/0276/4616/5110/products/2_1copy_1024x1024.jpg?v=1589430616">
	<meta property="og:image:secure_url" content="https://cdn.shopify.com/s/files/1/0276/4616/5110/products/2_2copy_1024x1024.jpg?v=1589430616">
	<meta property="og:image:secure_url" content="https://cdn.shopify.com/s/files/1/0276/4616/5110/products/2_3copy_1024x1024.jpg?v=1589430616">
	<meta name="twitter:site" content="@">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="Cotton Fleece Jogging Pants">
	<meta name="twitter:description" content="Most of us are familiar with the iconic design of the egg shaped chair floating in the air. The Hanging Egg Chair is a critically acclaimed design that has enjoyed praise worldwide ever since the distinctive sculptural shape was created. [SHORTDESCRIPTION] Most of us are familiar with the iconic design of the egg shape">
	<style data-shopify>
		:root {
		--vela-color-primary: #ba933e;
		--vela-color-secondary: #ba933e;
		--vela-border-color: #e1e1e1;
		--vela-body-bg: #ffffff;
		--vela-text-color-primary: #444444;
		--vela-text-color-secondary: #1a1a1a;
		--vela-text-color-banner: #666666;
		--vela-border-main: 1px solid var(--vela-border-color);
		--vela-gutter-width: 30px;
		--vela-font-family: Red Hat Display;
		--vela-font-family-secondary: Red Hat Display;
		--vela-font-icon: "FontAwesome";
		--vela-topbar-bgcolor: #f5f5f5;
		--vela-topbar-textcolor: #666666;
		--vela-header-bgcolor: #ffffff;
		--vela-header-textcolor: #1a1a1a;
		--vela-footer-bgcolor: #1a1a1a;
		--vela-footer-titlecolor: #ffffff;
		--vela-footer-textcolor: #999999;
		--vela-breadcrumb-bgcolor: #eaebef;
		--vela-breadcrumb-linkcolor: #1a1a1a;
		--vela-breadcrumb-textcolor: #999999;
		--vela-breadcrumb-headingcolor: #1a1a1a;
		--vela-font-size: 16px;
		--vela-heading-color: var(--vela-text-color-secondary);
		--newslettermodal: url(//cdn.shopify.com/s/files/1/0276/4616/5110/t/6/assets/newslettermodal.png?v=14874258336589018416);
		--icon_loading: url(//cdn.shopify.com/s/files/1/0276/4616/5110/t/6/assets/loading.gif?v=4737358046173361859);
		--icon_close: url(//cdn.shopify.com/s/files/1/0276/4616/5110/t/6/assets/velaClose.png?v=12125300534150527376);
		--button_one_txtcolor: #ffffff;
		--button_one_bgcolor: #1a1a1a;
		--button_one_bordercolor: #1a1a1a;
		--button_one_bgcolor_hover: #ba933e;
		--button_one_bordercolor_hover: #ba933e;
		--button_one_txtcolor_hover: #ffffff;
		--btnpro_txtcolor: #1a1a1a;
		--btnpro_bgcolor: #ffffff;
		--btnpro_bordercolor: #ffffff;
		--btnpro_bgcolor_hover: #ba933e;
		--btnpro_bordercolor_hover: #ba933e;
		--btnpro_txtcolor_hover: #ffffff;
		--addtocart_txtcolor: #ffffff;
		--addtocart_bgcolor: #1a1a1a;
		--addtocart_bordercolor: #1a1a1a;
		--addtocart_txtcolor_hover: #ffffff;
		--addtocart_bgcolor_hover: #ba933e;
		--addtocart_bordercolor_hover: #ba933e;
		--velamenu-bgcolor: #ffffff;
		--velamenu-linkcolor: #1a1a1a;
		--velamenu-linkcolor-hover: #ba933e;
		--velamenu-fontsize: 16px;
		--velasubmenu-bgcolor: #ffffff;
		--velasubmenu-linkcolor: #888888;
		--velasubmenu-linkcolor-hover: #333333;
		--velasubmenu-fontsize: 14px;
	</style>
	<link href="//cdn.shopify.com/s/files/1/0276/4616/5110/t/6/assets/vela-fonts.css?v=2277802566244331549" rel="stylesheet" type="text/css" media="all" />
	<link href="//cdn.shopify.com/s/files/1/0276/4616/5110/t/6/assets/plugin.css?v=18058060656392713226" rel="stylesheet" type="text/css" media="all" />
	<link href="//cdn.shopify.com/s/files/1/0276/4616/5110/t/6/assets/vela-site.css?v=7094835592882501527" rel="stylesheet" type="text/css" media="all" />
	<script src="//cdn.shopify.com/s/files/1/0276/4616/5110/t/6/assets/jquery-3.5.0.min.js?v=180960344766504024" type="text/javascript"></script>
	<script>
	window.money = '<span class="money">${{amount}}</span>';
	window.money_format = '${{amount}} USD';
	window.currency = 'USD';
	window.shop_money_format = "${{amount}}";
	window.shop_money_with_currency_format = "${{amount}} USD";
	window.loading_url = "//cdn.shopify.com/s/files/1/0276/4616/5110/t/6/assets/loading.gif?v=4737358046173361859";
	window.file_url = "//cdn.shopify.com/s/files/1/0276/4616/5110/files/?771";
	window.asset_url = "//cdn.shopify.com/s/files/1/0276/4616/5110/t/6/assets/?771";
	window.ajaxcart_type = 'drawer';
	window.newsletter_success = "Thank you for your subscription";
	window.cart_empty = "Your cart is currently empty.";
	window.swatch_enable = true;
	window.swatch_show_unvailable = true;
	window.sidebar_multichoise = true;
	window.float_header = true;
	window.review = true;
	window.currencies = true;
	window.countdown_format = "<ul class='list-unstyle list-inline'><li><span class='number'>%D</span><span>Days</span></li><li><span class='number'>%H</span><span>Hours</span></li><li><span class='number'>%M</span><span>Mins</span></li><li><span class='number'>%S</span><span>Secs</span></li></ul>";
	window.vela = window.vela || {};
	vela.strings = {
		add_to_cart: "Add to Cart",
		sold_out: "Sold Out",
		vendor: "Vendor",
		sku: "SKU",
		availability: "Availability",
		available: "In stock",
		unavailable: "Out Of Stock"
	};
	</script>
	<script>
	window.performance && window.performance.mark && window.performance.mark('shopify.content_for_header.start');
	</script>
	<meta id="shopify-digital-wallet" name="shopify-digital-wallet" content="/27646165110/digital_wallets/dialog">
	<link rel="alternate" type="application/json+oembed" href="https://velademorubix-fashion.myshopify.com/products/arctander-chair.oembed">
	<link href="https://monorail-edge.shopifysvc.com" rel="dns-prefetch">
	<script id="shopify-features" type="application/json">{"accessToken":"e969fbd9de8c3a349d6e1854aa648c3e","betas":["rich-media-storefront-analytics"],"domain":"velademorubix-fashion.myshopify.com","predictiveSearch":true,"shopId":27646165110,"smart_payment_buttons_url":"https:\/\/cdn.shopify.com\/shopifycloud\/payment-sheet\/assets\/latest\/spb.en.js","dynamic_checkout_cart_url":"https:\/\/cdn.shopify.com\/shopifycloud\/payment-sheet\/assets\/latest\/dynamic-checkout-cart.en.js","locale":"en"}</script>
	<script>
	(function() {
		if("sendBeacon" in navigator && "performance" in window) {
			var session_token = document.cookie.match(/_shopify_s=([^;]*)/);

			function handle_abandonment_event(e) {
				var entries = performance.getEntries().filter(function(entry) {
					return /monorail-edge.shopifysvc.com/.test(entry.name);
				});
				if(!window.abandonment_tracked && entries.length === 0) {
					window.abandonment_tracked = true;
					var currentMs = Date.now();
					var navigation_start = performance.timing.navigationStart;
					var payload = {
						shop_id: 27646165110,
						url: window.location.href,
						navigation_start,
						duration: currentMs - navigation_start,
						session_token: session_token && session_token.length === 2 ? session_token[1] : "",
						page_type: "product"
					};
					window.navigator.sendBeacon("https://monorail-edge.shopifysvc.com/v1/produce", JSON.stringify({
						schema_id: "online_store_buyer_site_abandonment/1.1",
						payload: payload,
						metadata: {
							event_created_at_ms: currentMs,
							event_sent_at_ms: currentMs
						}
					}));
				}
			}
			window.addEventListener('pagehide', handle_abandonment_event);
		}
	}());
	</script>
	<script>
	var Shopify = Shopify || {};
	Shopify.shop = "velademorubix-fashion.myshopify.com";
	Shopify.locale = "en";
	Shopify.currency = {
		"active": "USD",
		"rate": "1.0"
	};
	Shopify.country = "US";
	Shopify.theme = {
		"name": "fashion-home01-new",
		"id": 120181325942,
		"theme_store_id": null,
		"role": "main"
	};
	Shopify.theme.handle = "null";
	Shopify.theme.style = {
		"id": null,
		"handle": null
	};
	Shopify.cdnHost = "cdn.shopify.com";
	</script>
	<script type="module">!function(o){(o.Shopify=o.Shopify||{}).modules=!0}(window);</script>
	<script>
	! function(o) {
		function n() {
			var o = [];

			function n() {
				o.push(Array.prototype.slice.apply(arguments))
			}
			return n.q = o, n
		}
		var t = o.Shopify = o.Shopify || {};
		t.loadFeatures = n(), t.autoloadFeatures = n()
	}(window);
	</script>
	<script>
	(function() {
		function asyncLoad() {
			var urls = ["\/\/productreviews.shopifycdn.com\/assets\/v4\/spr.js?shop=velademorubix-fashion.myshopify.com"];
			for(var i = 0; i < urls.length; i++) {
				var s = document.createElement('script');
				s.type = 'text/javascript';
				s.async = true;
				s.src = urls[i];
				var x = document.getElementsByTagName('script')[0];
				x.parentNode.insertBefore(s, x);
			}
		};
		if(window.attachEvent) {
			window.attachEvent('onload', asyncLoad);
		} else {
			window.addEventListener('load', asyncLoad, false);
		}
	})();
	</script>
	<script id="__st">
	var __st = {
		"a": 27646165110,
		"offset": -14400,
		"reqid": "7599a9a8-199b-4a0f-9a63-94b21c3217b6",
		"pageurl": "velademorubix-fashion.myshopify.com\/products\/arctander-chair",
		"u": "435caeb57682",
		"p": "product",
		"rtyp": "product",
		"rid": 4491236868214
	};
	</script>
	<script>
	window.ShopifyPaypalV4VisibilityTracking = true;
	</script>
	<script>
	window.ShopifyAnalytics = window.ShopifyAnalytics || {};
	window.ShopifyAnalytics.meta = window.ShopifyAnalytics.meta || {};
	window.ShopifyAnalytics.meta.currency = 'USD';
	var meta = {
		"product": {
			"id": 4491236868214,
			"gid": "gid:\/\/shopify\/Product\/4491236868214",
			"vendor": "Demo Vender",
			"type": "Demo Type",
			"variants": [{
				"id": 31715440656502,
				"price": 3900,
				"name": "Cotton Fleece Jogging Pants - Yellow",
				"public_title": "Yellow",
				"sku": ""
			}, {
				"id": 31715440689270,
				"price": 3900,
				"name": "Cotton Fleece Jogging Pants - Grey",
				"public_title": "Grey",
				"sku": ""
			}]
		},
		"page": {
			"pageType": "product",
			"resourceType": "product",
			"resourceId": 4491236868214
		},
		"page_view_event_id": "e7fd6b919360be57dd034bf33106d11eb876d4a5befd8462bfa7df6b1fb6d8b0",
		"cart_event_id": "d73510f77a6c64dbf18f3ec6fc624a7de51fda7c677d6ac48fba2f51ea6c9ccf"
	};
	for(var attr in meta) {
		window.ShopifyAnalytics.meta[attr] = meta[attr];
	}
	</script>
	<script>
	window.ShopifyAnalytics.merchantGoogleAnalytics = function() {};
	</script>
	<script class="analytics">
	(function() {
		var customDocumentWrite = function(content) {
			var jquery = null;
			if(window.jQuery) {
				jquery = window.jQuery;
			} else if(window.Checkout && window.Checkout.$) {
				jquery = window.Checkout.$;
			}
			if(jquery) {
				jquery('body').append(content);
			}
		};
		var hasLoggedConversion = function(token) {
			if(token) {
				return document.cookie.indexOf('loggedConversion=' + token) !== -1;
			}
			return false;
		}
		var setCookieIfConversion = function(token) {
			if(token) {
				var twoMonthsFromNow = new Date(Date.now());
				twoMonthsFromNow.setMonth(twoMonthsFromNow.getMonth() + 2);
				document.cookie = 'loggedConversion=' + token + '; expires=' + twoMonthsFromNow;
			}
		}
		var trekkie = window.ShopifyAnalytics.lib = window.trekkie = window.trekkie || [];
		if(trekkie.integrations) {
			return;
		}
		trekkie.methods = ['identify', 'page', 'ready', 'track', 'trackForm', 'trackLink'];
		trekkie.factory = function(method) {
			return function() {
				var args = Array.prototype.slice.call(arguments);
				args.unshift(method);
				trekkie.push(args);
				return trekkie;
			};
		};
		for(var i = 0; i < trekkie.methods.length; i++) {
			var key = trekkie.methods[i];
			trekkie[key] = trekkie.factory(key);
		}
		trekkie.load = function(config) {
			trekkie.config = config;
			var first = document.getElementsByTagName('script')[0];
			var script = document.createElement('script');
			script.type = 'text/javascript';
			script.onerror = function(e) {
				var scriptFallback = document.createElement('script');
				scriptFallback.type = 'text/javascript';
				scriptFallback.onerror = function(error) {
					var Monorail = {
						produce: function produce(monorailDomain, schemaId, payload) {
							var currentMs = new Date().getTime();
							var event = {
								schema_id: schemaId,
								payload: payload,
								metadata: {
									event_created_at_ms: currentMs,
									event_sent_at_ms: currentMs
								}
							};
							return Monorail.sendRequest("https://" + monorailDomain + "/v1/produce", JSON.stringify(event));
						},
						sendRequest: function sendRequest(endpointUrl, payload) {
							// Try the sendBeacon API
							if(window && window.navigator && typeof window.navigator.sendBeacon === 'function' && typeof window.Blob === 'function' && !Monorail.isIos12()) {
								var blobData = new window.Blob([payload], {
									type: 'text/plain'
								});
								if(window.navigator.sendBeacon(endpointUrl, blobData)) {
									return true;
								} // sendBeacon was not successful
							} // XHR beacon
							var xhr = new XMLHttpRequest();
							try {
								xhr.open('POST', endpointUrl);
								xhr.setRequestHeader('Content-Type', 'text/plain');
								xhr.send(payload);
							} catch(e) {
								console.log(e);
							}
							return false;
						},
						isIos12: function isIos12() {
							return window.navigator.userAgent.lastIndexOf('iPhone; CPU iPhone OS 12_') !== -1 || window.navigator.userAgent.lastIndexOf('iPad; CPU OS 12_') !== -1;
						}
					};
					Monorail.produce('monorail-edge.shopifysvc.com', 'trekkie_storefront_load_errors/1.1', {
						shop_id: 27646165110,
						theme_id: 120181325942,
						app_name: "storefront",
						context_url: window.location.href,
						source_url: "https://cdn.shopify.com/s/trekkie.storefront.df6b00d20909a649d079ae9dc31ef825b4fe66d0.min.js"
					});
				};
				scriptFallback.async = true;
				scriptFallback.src = 'https://cdn.shopify.com/s/trekkie.storefront.df6b00d20909a649d079ae9dc31ef825b4fe66d0.min.js';
				first.parentNode.insertBefore(scriptFallback, first);
			};
			script.async = true;
			script.src = 'https://cdn.shopify.com/s/trekkie.storefront.df6b00d20909a649d079ae9dc31ef825b4fe66d0.min.js';
			first.parentNode.insertBefore(script, first);
		};
		trekkie.load({
			"Trekkie": {
				"appName": "storefront",
				"development": false,
				"defaultAttributes": {
					"shopId": 27646165110,
					"isMerchantRequest": null,
					"themeId": 120181325942,
					"themeCityHash": "3386116454759755023",
					"contentLanguage": "en",
					"currency": "USD"
				},
				"isServerSideCookieWritingEnabled": true,
				"isPixelGateEnabled": true
			},
			"Performance": {
				"navigationTimingApiMeasurementsEnabled": true,
				"navigationTimingApiMeasurementsSampleRate": 1
			},
			"Session Attribution": {}
		});
		var loaded = false;
		trekkie.ready(function() {
			if(loaded) return;
			loaded = true;
			window.ShopifyAnalytics.lib = window.trekkie;
			var originalDocumentWrite = document.write;
			document.write = customDocumentWrite;
			try {
				window.ShopifyAnalytics.merchantGoogleAnalytics.call(this);
			} catch(error) {};
			document.write = originalDocumentWrite;
			(function() {
				if(window.BOOMR && (window.BOOMR.version || window.BOOMR.snippetExecuted)) {
					return;
				}
				window.BOOMR = window.BOOMR || {};
				window.BOOMR.snippetStart = new Date().getTime();
				window.BOOMR.snippetExecuted = true;
				window.BOOMR.snippetVersion = 12;
				window.BOOMR.application = "storefront-renderer";
				window.BOOMR.themeName = "Vela Framework";
				window.BOOMR.themeVersion = "v2.0.0";
				window.BOOMR.shopId = 27646165110;
				window.BOOMR.themeId = 120181325942;
				window.BOOMR.url = "https://cdn.shopify.com/shopifycloud/boomerang/shopify-boomerang-1.0.0.min.js";
				var where = document.currentScript || document.getElementsByTagName("script")[0];
				var parentNode = where.parentNode;
				var promoted = false;
				var LOADER_TIMEOUT = 3000;

				function promote() {
					if(promoted) {
						return;
					}
					var script = document.createElement("script");
					script.id = "boomr-scr-as";
					script.src = window.BOOMR.url;
					script.async = true;
					parentNode.appendChild(script);
					promoted = true;
				}

				function iframeLoader(wasFallback) {
					promoted = true;
					var dom, bootstrap, iframe, iframeStyle;
					var doc = document;
					var win = window;
					window.BOOMR.snippetMethod = wasFallback ? "if" : "i";
					bootstrap = function(parent, scriptId) {
						var script = doc.createElement("script");
						script.id = scriptId || "boomr-if-as";
						script.src = window.BOOMR.url;
						BOOMR_lstart = new Date().getTime();
						parent = parent || doc.body;
						parent.appendChild(script);
					};
					if(!window.addEventListener && window.attachEvent && navigator.userAgent.match(/MSIE [67]./)) {
						window.BOOMR.snippetMethod = "s";
						bootstrap(parentNode, "boomr-async");
						return;
					}
					iframe = document.createElement("IFRAME");
					iframe.src = "about:blank";
					iframe.title = "";
					iframe.role = "presentation";
					iframe.loading = "eager";
					iframeStyle = (iframe.frameElement || iframe).style;
					iframeStyle.width = 0;
					iframeStyle.height = 0;
					iframeStyle.border = 0;
					iframeStyle.display = "none";
					parentNode.appendChild(iframe);
					try {
						win = iframe.contentWindow;
						doc = win.document.open();
					} catch(e) {
						dom = document.domain;
						iframe.src = "javascript:var d=document.open();d.domain='" + dom + "';void(0);";
						win = iframe.contentWindow;
						doc = win.document.open();
					}
					if(dom) {
						doc._boomrl = function() {
							this.domain = dom;
							bootstrap();
						};
						doc.write("<body onload='document._boomrl();'>");
					} else {
						win._boomrl = function() {
							bootstrap();
						};
						if(win.addEventListener) {
							win.addEventListener("load", win._boomrl, false);
						} else if(win.attachEvent) {
							win.attachEvent("onload", win._boomrl);
						}
					}
					doc.close();
				}
				var link = document.createElement("link");
				if(link.relList && typeof link.relList.supports === "function" && link.relList.supports("preload") && ("as" in link)) {
					window.BOOMR.snippetMethod = "p";
					link.href = window.BOOMR.url;
					link.rel = "preload";
					link.as = "script";
					link.addEventListener("load", promote);
					link.addEventListener("error", function() {
						iframeLoader(true);
					});
					setTimeout(function() {
						if(!promoted) {
							iframeLoader(true);
						}
					}, LOADER_TIMEOUT);
					BOOMR_lstart = new Date().getTime();
					parentNode.appendChild(link);
				} else {
					iframeLoader(false);
				}

				function boomerangSaveLoadTime(e) {
					window.BOOMR_onload = (e && e.timeStamp) || new Date().getTime();
				}
				if(window.addEventListener) {
					window.addEventListener("load", boomerangSaveLoadTime, false);
				} else if(window.attachEvent) {
					window.attachEvent("onload", boomerangSaveLoadTime);
				}
				if(document.addEventListener) {
					document.addEventListener("onBoomerangLoaded", function(e) {
						e.detail.BOOMR.init({
							producer_url: "https://monorail-edge.shopifysvc.com/v1/produce",
							ResourceTiming: {
								enabled: true,
								trackedResourceTypes: ["script", "img", "css"]
							},
						});
						e.detail.BOOMR.t_end = new Date().getTime();
					});
				} else if(document.attachEvent) {
					document.attachEvent("onpropertychange", function(e) {
						if(!e) e = event;
						if(e.propertyName === "onBoomerangLoaded") {
							e.detail.BOOMR.init({
								producer_url: "https://monorail-edge.shopifysvc.com/v1/produce",
								ResourceTiming: {
									enabled: true,
									trackedResourceTypes: ["script", "img", "css"]
								},
							});
							e.detail.BOOMR.t_end = new Date().getTime();
						}
					});
				}
			})();
			window.ShopifyAnalytics.lib.page(null, {
				"pageType": "product",
				"resourceType": "product",
				"resourceId": 4491236868214
			}, "e7fd6b919360be57dd034bf33106d11eb876d4a5befd8462bfa7df6b1fb6d8b0");
			var match = window.location.pathname.match(/checkouts\/(.+)\/(thank_you|post_purchase)/)
			var token = match ? match[1] : undefined;
			if(!hasLoggedConversion(token)) {
				setCookieIfConversion(token);
				window.ShopifyAnalytics.lib.track("Viewed Product", {
					"currency": "USD",
					"variantId": 31715440656502,
					"productId": 4491236868214,
					"productGid": "gid:\/\/shopify\/Product\/4491236868214",
					"name": "Cotton Fleece Jogging Pants - Yellow",
					"price": "39.00",
					"sku": "",
					"brand": "Demo Vender",
					"variant": "Yellow",
					"category": "Demo Type",
					"nonInteraction": true
				}, "02618c618d5732414990e3cb260d9e7fbc90f2a38d67832578db6a7437b57131");
				window.ShopifyAnalytics.lib.track("monorail:\/\/trekkie_storefront_viewed_product\/1.1", {
					"currency": "USD",
					"variantId": 31715440656502,
					"productId": 4491236868214,
					"productGid": "gid:\/\/shopify\/Product\/4491236868214",
					"name": "Cotton Fleece Jogging Pants - Yellow",
					"price": "39.00",
					"sku": "",
					"brand": "Demo Vender",
					"variant": "Yellow",
					"category": "Demo Type",
					"nonInteraction": true,
					"referer": "https:\/\/velademorubix-fashion.myshopify.com\/products\/arctander-chair"
				}, null);
			}
		});
		var eventsListenerScript = document.createElement('script');
		eventsListenerScript.async = true;
		eventsListenerScript.src = "//cdn.shopify.com/shopifycloud/shopify/assets/shop_events_listener-714e2e017903fad17d4471cb27d1f2c8a83b5a7a276f92420f7e5e40dbc9136e.js";
		document.getElementsByTagName('head')[0].appendChild(eventsListenerScript);
	})();
	</script>
	<script>
	! function(e) {
		e.addEventListener("DOMContentLoaded", function() {
			var t = ['form[action^="/contact"] input[name="form_type"][value="contact"]', 'form[action*="/comments"] input[name="form_type"][value="new_comment"]'].join(",");
			null !== e.querySelector(t) && (window.Shopify = window.Shopify || {}, window.Shopify.recaptchaV3 = window.Shopify.recaptchaV3 || {
				siteKey: "6LcCR2cUAAAAANS1Gpq_mDIJ2pQuJphsSQaUEuc9"
			}, (t = e.createElement("script")).setAttribute("src", "https://cdn.shopify.com/shopifycloud/storefront-recaptcha-v3/v0.1/index.js"), e.body.appendChild(t))
		})
	}(document);
	</script>
	<script integrity="sha256-2KbxRG1nAJxSTtTmhkiAC6kILrdVSO4o4QUDMcvnuig=" data-source-attribution="shopify.loadfeatures" defer="defer" src="//cdn.shopify.com/shopifycloud/shopify/assets/storefront/load_feature-d8a6f1446d67009c524ed4e68648800ba9082eb75548ee28e1050331cbe7ba28.js" crossorigin="anonymous"></script>
	<script integrity="sha256-h+g5mYiIAULyxidxudjy/2wpCz/3Rd1CbrDf4NudHa4=" data-source-attribution="shopify.dynamic-checkout" defer="defer" src="//cdn.shopify.com/shopifycloud/shopify/assets/storefront/features-87e8399988880142f2c62771b9d8f2ff6c290b3ff745dd426eb0dfe0db9d1dae.js" crossorigin="anonymous"></script>
	<style id="shopify-dynamic-checkout">
	.shopify-payment-button__button--hidden {
		visibility: hidden;
	}

	.shopify-payment-button__button {
		border-radius: 4px;
		border: none;
		box-shadow: 0 0 0 0 transparent;
		color: white;
		cursor: pointer;
		display: block;
		font-size: 1em;
		font-weight: 500;
		line-height: 1;
		text-align: center;
		width: 100%;
		transition: background 0.2s ease-in-out;
	}

	.shopify-payment-button__button[disabled] {
		opacity: 0.6;
		cursor: default;
	}

	.shopify-payment-button__button--unbranded {
		background-color: #1990c6;
		padding: 1em 2em;
	}

	.shopify-payment-button__button--unbranded:hover:not([disabled]) {
		background-color: #136f99;
	}

	.shopify-payment-button__more-options {
		background: transparent;
		border: 0 none;
		cursor: pointer;
		display: block;
		font-size: 1em;
		margin-top: 1em;
		text-align: center;
		width: 100%;
	}

	.shopify-payment-button__more-options:hover:not([disabled]) {
		text-decoration: underline;
	}

	.shopify-payment-button__more-options[disabled] {
		opacity: 0.6;
		cursor: default;
	}

	.shopify-payment-button__button--branded {
		display: flex;
		flex-direction: column;
		min-height: 44px;
		position: relative;
		z-index: 1;
	}

	.shopify-payment-button__button--branded .shopify-cleanslate {
		flex: 1 !important;
		display: flex !important;
		flex-direction: column !important;
	}
	</style>
	<script>
	window.performance && window.performance.mark && window.performance.mark('shopify.content_for_header.end');
	</script>
	</head>

<?


    $sql="select * from  `garment_product` where gproduct_id='".$prid."'";

    $sql_query = mysqli_query($con,$sql);
    $sql_result = mysqli_fetch_assoc($sql_query);
 
$table=mysqli_query($con,$sql);
$rws=mysqli_fetch_array($table);

$discount = $rws['discount'];

if($discount > 0){
    $discount_amount = $unit_price * ($discount/100);
    $final_selling_price = $unit_price - $discount_amount ;                            
}else{
    $final_selling_price = $unit_price ; 
}

?>


		<div id="pageContainer" class="isMoved">
		<main class="mainContent" role="main">
			<section id="pageContent">
				<div id="shopify-section-vela-template-product" class="shopify-section"> .
					<div class="container">
						<div class="pageCollectionInner detail_default">
							<div class="productBox">
								<div class="proBoxPrimary" id="ProductSection-vela-template-product" data-section-id="vela-template-product" data-section-type="product">
									<div class="row mb30">
										<div class="proBoxImage col-xs-12 col-md-6  mb30">
											<div id="proFeaturedImage" class="proFeaturedImage ">
												<div id="groupMedia" style=" display: none" data-product-single-media-group></div>
												<div id="groupProImage">
													<div class="card">
														<div class="card-body">
															<div class="responsive">

																		<?php echo  $imgframe;  ?>

															</div>
														</div>
													</div>

												</div>
											</div>

											<div id="productThumbs" class="proThumbnails thumbnails-wrapper">
												<div class="owl-thumblist">
													<div class="owl-carousel product-single__thumbnails product-single__thumbnails-vela-template-product" data-item="5" data-vertical="false">
														<?php
                                          
                                              $sqlimg="SELECT img_name FROM `product_images_new` WHERE `gproduct_id`='$prid' order by rank";
                                          
                                          $qryimg=mysqli_query($con,$sqlimg);
                                          if(mysqli_num_rows($qryimg)>0){
                                          while($rowimg23=mysqli_fetch_array($qryimg))
                                          {
                                              $img_name= $rowimg23[0];

                                              $image_path = 'https://srishringarr.com/yn/uploads'.$img_name;

                                              ?>
												<div class="thumbItem product-single__thumbnails-item">
                                                <a href="<? echo $image_path; ?>" class="product-single__thumbnail product-single__thumbnail--vela-template-product active-thumb" data-thumbnail-id="vela-template-product-6528328532086" data-imageid="6528328532086" data-stype="image" data-image="<? echo $image_path; ?>" data-zoom-image="<? echo $image_path; ?>">
                                          <img class="img-responsive" src="<? echo $image_path; ?>" alt="<?= $productName; ?> " />
                                          <img class="hidden" src="<? echo $image_path; ?>" alt="<?= $productName; ?> " /></a>

												</div>
															<? } } ?>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-md-6 mb30">
											<div class="proBoxInfo">
												<h1><? echo $rws[3];?></h1>
												<div class="proReviews"> <span class="shopify-product-reviews-badge" data-id="4491236868214"></span> </div>
												<div class="proDescription rte">
													<p>
														<?
                                                          $description = $rws[4];
                                                          $description = str_replace("•","●",$description);
                                                          $description =  str_replace("●","<br>● ",$description);
                                                          echo $description ;
                                                          ?>
													</p>
												</div>
												<div id="msgalerts"></div>
												<div class="wrapper">
													<form method="post" action="/cart/add" id="oldID" accept-charset="UTF-8" class="formAddToCart" enctype="multipart/form-data">
														<input type="hidden" name="form_type" value="product" />
														<input type="hidden" name="utf8" value="✓" />
														<div class="proVariants">

															<style rel="stylesheet" type="text/css">
															.slick-track {
																height: 18%;
															}

															.proVariants .selector-wrapper:nth-child(1) {
																display: none;
															}
															</style>
														</div>
														<div class="proPrice flexRow flexAlignCenter"> <span class="priceProduct ">
                                          <span class="mymoney">
                                          <?php echo 'MRP: '. $currency_symbol . ' ' .currencyAmount($cur,$final_selling_price,$con).' '; 
                                            if($discount>0) {
                                            ?>
                                            
                                            <span id="mrp" data-mrp="<? echo $rero[0]; ?>"></span>
                                                <del ><?php echo  '  '.$currency_symbol . ' ' .currencyAmount($cur,$rero[0],$con); ?></del>
                                                
                                              <?php } ?>
                                          </span> </span>
															<div id="velaSizeGuide" style="display: none;">
																<div class="velaSizeGuide"> </div>
															</div>
														</div>
														
														<? if($qty>0){ ?>
														<div class="velaGroup clearfix mb20">
															<div class="proQuantity">
																<!-- <label for="Quantity" class="qtySelector">Quantity:</label> -->
																<input type="number" id="Quantity" name="quantity" value="1" min="1" class="qtySelector"> </div>
															<button type="submit" name="add" id="AddToCart" class="btn btnAddToCart"> <i class="icons icon-handbag"></i> <span id="AddToCartText">Add to Cart</span> </button>
															<div class="velaBuyNow">
																<div data-shopify="payment-button" class="shopify-payment-button">
																	<button class="shopify-payment-button__button shopify-payment-button__button--unbranded shopify-payment-button__button--hidden" disabled="disabled" aria-hidden="true"> </button>
																	<button class="shopify-payment-button__more-options shopify-payment-button__button--hidden" disabled="disabled" aria-hidden="true"> </button>
																</div>
															</div>
														</div>    
														<? } ?>
														
														
														
														
													</form>
													<p class="proAttr productAvailability instock">
														<label>Availability:</label>
														<?php echo intval($qty); ?> in Stock
													</p>
													<p class="proAttr">
														<label>SKU:</label>
														<? echo $sku ; ?>
													</p>
													<div class="velaProductSharing">
														<h5 class="velaProductSharingTittle">Share:</h5>
														<ul class="socialSharing list-unstyled">
															<li>
																<a class="btnSharing btnTwitter" href="https://twitter.com/yosshitaneha/" data-social="twitter"> <i class="fa fa-twitter"></i><span> Tweet</span> </a>
															</li>
															<li>
																<a class="btnSharing btnFacebook" href="https://www.facebook.com/YosshitaandNehaFashionStudio/" data-social="facebook"> <i class="fa fa-facebook"></i><span> Facebook</span> </a>
															</li>
															<li>
																<a class="btnSharing btnLinkedin" href="https://www.instagram.com/yosshitanehafashionstudio/" data-social="instagram"> <i class="fa fa-instagram"></i><span> Instagram</span> </a>
															</li>
															<li>
																<a class="btnSharing btnPinterest" href="https://in.pinterest.com/yosshitaandneha/"> <i class="fa fa-pinterest-p"></i><span> Pinterest</span> </a>
															</li>
														</ul>
													</div>

													<!-- <br><button type="submit" name="custom" id="custom" class="btn btnAddToCart"> <span id="AddToCartText">Customisation Form</span> </button> <br> -->
													<?php if($type=='2' && $mainCategory=='5'){ ?> 
													    <button type="submit" name="custom" id="custom" class="btn btnAddToCart" ><a style="color:white" href="customisation_form.php?id=<?php echo $id;?>&type=<?php echo $type;?>"> <i class="fa fa-edit"></i><span id="AddToCartText">Customisation Form</span></a></button>
													<?php }?>


													<script type="text/javascript">
													$(document).ready(function() {
														$("#AddToCart").on('click', function() {
															var qty = $("#Quantity").val();
															var pid = '<? echo $id ;?>';
															var type = '<? echo $type; ?>';
															var price = '<? echo $final_selling_price ; ?>';
															var status = '1';
															var ac_type = '2';
															var image = '<? echo $path; ?>';
															var sku = '<? echo $sku; ?>';
															var mrpValue = document.getElementById('mrp').getAttribute('data-mrp');

															var discount_amount = mrpValue - price ; 

															$.ajax({
																type: "POST",
																url: '../addtocart.php',
																data: 'qty=' + qty + '&pid=' + pid + '&type=' + type + '&price=' + price + '&status=' + status + '&ac_type=' + ac_type + '&image=' + image + '&sku=' + sku+'&discount_amount='+discount_amount+'&mrp='+mrpValue,
																success: function(msg) {
                                                                    console.log(msg);
																	if(msg == 1) {
																		$("#msgalerts").html('<div class="alert alert-success" role="alert">Added To Cart</div>');
																		$("#cartDrawer").load('cartdrawer.php');
																	} else if(msg == 2) {
																		$("#msgalerts").html('<div class="alert alert-danger" role="alert">Error In Added To Cart</div>');
																		alert('Error In Added To Cart');
																	} else if(msg == 0) {
																		$("#msgalerts").html('<div class="alert alert-warning" role="alert">Selected Quantity is higher than Available Quantity</div>');
																	}
																}
															});
														});
														$('.btnSharing').on('click', function() {
															type = $(this).attr('data-social');
															if(type.length) {
																switch(type) {
																	case "twitter":
																		window.open("https://twitter.com/intent/tweet?text=Cotton%20Fleece%20Jogging%20Pants https://velademorubix-fashion.myshopify.com/products/arctander-chair", "sharertwt", "toolbar=0,status=0,width=640,height=445");
																		break;
																	case "facebook":
																		window.open("https://www.facebook.com/sharer/sharer.php?u=https://velademorubix-fashion.myshopify.com/products/arctander-chair&p[images][0]=", "sharer", "toolbar=0,status=0,width=660,height=445");
																		break;
																	case "linkedin":
																		window.open("https://www.linkedin.com/shareArticle?mini=true&amp;url=https://velademorubix-fashion.myshopify.com/products/arctander-chair&amp;title=Cotton%20Fleece%20Jogging%20Pants&amp;source=https://velademorubix-fashion.myshopify.com/products/arctander-chair", "sharerpinterest", "toolbar=0,status=0,width=660,height=445");
																		break;
																}
															}
														});
													});
													</script>
												</div>
												<div class="mb30 pt-md-30">
													<section class="proDetailInfo">
														<div class="proTabHeading">
															<ul class="nav velaProductNavTabs nav-tabs">
																<li> <a href="#proTabs1" data-toggle="tab">Details</a> </li>

																<li> <a href="#proTabs4" data-toggle="tab">Reviews</a> </li>
															</ul>
														</div>
														<div class="tab-content">
															<div class="tab-pane" id="proTabs1">
																<div class="rte">
																	<p>
																		<?
                                                      if($youtube){
                                                      $ytarray=explode("/", $youtube);
                                                      $ytendstring=end($ytarray);
                                                      $ytendarray=explode("?v=", $ytendstring);
                                                      $ytendstring=end($ytendarray);
                                                      $ytendarray=explode("&", $ytendstring);
                                                      $ytcode=$ytendarray[0]; ?>
																			<iframe width="560" height="315" src="https://www.youtube.com/embed/<? echo $ytcode ; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
																			<?  } ?>
																	</p>
																	<p>
																		<?php
                                                   $description = $rws[4];
                                                   $description = str_replace("•","●",$description);
                                                   $description =  str_replace("●","<br>● ",$description);
                                                   echo $description ;
                                                   ?>
																	</p>
																</div>
															</div>
															<div class="tab-pane" id="proTabs4">
																<div id="shopify-product-reviews" data-id="4491236868214"></div>
															</div>
														</div>
													</section>
												</div>
											</div>
										</div>
									</div>

									<section class="proRelated mb30">
										<div id="relatedProducts" class="velaProducts">
											<div class="headingGroup pb20">
                                    <h3 class="velaTitle velaHomeTitle">
                                       Maybe You Like
                                    </h3>
                                    <span class="subTitle">
                                       You may like our other products too!
                                    </span>
                                 </div>
<? 
include('like_same_category.php'); 
?>


<? 
include('like_history.php'); 
?>



                             </div>
									</section>
								</div>
							</div>
						</div>
					</div>

				</div>
			</section>


		</main>

		<div id="shopify-section-vela-template-notification" class="shopify-section"></div>
		<script type="text/javascript">
			$(window).on("load", function() {
				var dateCookie = new Date();
				var minutes = 60;
				dateCookie.setTime(dateCookie.getTime() + (minutes * 60 * 1000));
				setTimeout(function() {
					if(document.body.classList.contains('template-collection') && ($("#velaNotifiCollection").length > 0) && ($.cookie('velaNotifiCollectioin') != 'closed')) {
						$.fancybox.open({
							src: '#velaNotifiCollection',
							opts: {
								padding: 0,
								beforeLoad: function() {
									$('#velaNotifiCollection').removeClass('hidden');
								},
								href: '#velaNotifiCollection',
								helpers: {
									overlay: true
								},
								afterClose: function() {
									$('#velaNotifiCollection').addClass('hidden');
									$.cookie('velaNotifiCollectioin', 'closed', {
										expires: dateCookie,
										path: '/'
									});
								}
							}
						});
					} else if(document.body.classList.contains('template-blog') && ($("#velaNotifiBlog").length > 0) && ($.cookie('velaNotifiBlog') != 'closed')) {
						$.fancybox.open({
							src: '#velaNotifiBlog',
							opts: {
								padding: 0,
								beforeLoad: function() {
									$('#velaNotifiBlog').removeClass('hidden');
								},
								href: '#velaNotifiBlog',
								helpers: {
									overlay: true
								},
								afterClose: function() {
									$('#velaNotifiBlog').addClass('hidden');
									$.cookie('velaNotifiBlog', 'closed', {
										expires: dateCookie,
										path: '/'
									});
								}
							}
						});
					} else if(document.body.classList.contains('template-product') && ($("#velaNotifiProduct").length > 0) && ($.cookie('velaNotifiProduct') != 'closed')) {
						$.fancybox.open({
							src: '#velaNotifiProduct',
							opts: {
								padding: 0,
								beforeLoad: function() {
									$('#velaNotifiProduct').removeClass('hidden');
								},
								href: '#velaNotifiProduct',
								helpers: {
									overlay: true
								},
								afterClose: function() {
									$('#velaNotifiProduct').addClass('hidden');
									$.cookie('velaNotifiProduct', 'closed', {
										expires: dateCookie,
										path: '/'
									});
								}
							}
						});
					} else if(document.body.classList.contains('template-page') && ($("#velaNotifiPage").length > 0) && ($.cookie('velaNotifiPage') != 'closed')) {
						$.fancybox.open({
							src: '#velaNotifiPage',
							opts: {
								padding: 0,
								beforeLoad: function() {
									$('#velaNotifiPage').removeClass('hidden');
								},
								href: '#velaNotifiPage',
								helpers: {
									overlay: true
								},
								afterClose: function() {
									$('#velaNotifiPage').addClass('hidden');
									$.cookie('velaNotifiPage', 'closed', {
										expires: dateCookie,
										path: '/'
									});
								}
							}
						});
					} else if(($("#velaNotifi").length > 0) && ($.cookie('velaNotifi') != 'closed')) {
						$.fancybox.open({
							src: '#velaNotifi',
							opts: {
								padding: 0,
								beforeLoad: function() {
									$('#velaNotifi').removeClass('hidden');
								},
								href: '#velaNotifi',
								helpers: {
									overlay: true
								},
								afterClose: function() {
									$('#velaNotifi').addClass('hidden');
									$.cookie('velaNotifi', 'closed', {
										expires: dateCookie,
										path: '/'
									});
								}
							}
						});
					}
				}, 0);
			});
		</script>
	</div>

		<script id="headerCartTemplate" type="text/template">
		<form action="/cart" method="post" novalidate class="cart ajaxcart">
			<div class="headerCartInner">
				<div class="headerCartScroll"> {{#items}}
					<div class="ajaxCartProduct">
						<div class="ajaxCartRow rowFlex" data-line="{{line}}">
							<div class="headerCartImage">
								<a href="{{url}}"><img class="img-responsive" src="{{img}}" alt="Trending designer blouses online" /></a>
							</div>
							<div class="headerCartContent">
								<div class="headerCartInfo"> <a href="{{url}}" class="headerCartProductName">{{name}}</a> {{#if variation}}
									<div class="headerCartProductMeta">{{variation}}</div> {{/if}} {{#properties}} {{#each this}} {{#if this}}
									<div class="headerCartProductMeta">{{@key}}: {{this}}</div> {{/if}} {{/each}} {{/properties}}
									<div class="headerCartPrice"> {{{price}}} <span class="d-block">x {{itemQty}}</span> </div>
								</div>
								<div class="headerCartRemoveBox">
									<a href="#" class="cartRemove" onclick="return false;" data-line="{{ line }}"> <i class="btnClose"></i> <span>Remove</span> </a>
								</div>
							</div>
						</div>
					</div> {{/items}} </div>
				<div class="headerCartTotal"> <span class="headerCartTotalTitle">Subtotal</span> <span class="headerCartTotalNum">{{{totalPrice}}}</span> </div>
				<div class="headerCartButton d-flex">
					<div class="headerCartButtonBox mr10"> <a class="btn btnVelaCart btnViewCart" href="/cart">

                   View Cart

               </a> </div>
					<div class="headerCartButtonBox">
						<button type="submit" class="btn btnVelaCart btnCheckout" name="checkout"> Check Out </button>
					</div>
				</div>
			</div>
		</form>
	</script>
	<script id="velaAjaxQty" type="text/template">
		<div class="velaQty">
			<button type="button" class="qtyAdjust velaQtyButton velaQtyMinus" data-id="{{id}}" data-qty="{{itemMinus}}"> <span class="txtFallback">&minus;</span> </button>
			<input type="text" class="qtyNum velaQtyText" value="{{itemQty}}" min="0" data-id="{{id}}" aria-label="quantity" pattern="[0-9]*">
			<button type="button" class="qtyAdjust velaQtyButton velaQtyPlus" data-id="{{id}}" data-qty="{{itemAdd}}"> <span class="txtFallback">+</span> </button>
		</div>
	</script>
	<script id="velaJsQty" type="text/template">
		<div class="velaQty">
			<button type="button" class="velaQtyAdjust velaQtyButton velaQtyMinus" data-id="{{id}}" data-qty="{{itemMinus}}"> <span class="txtFallback">&minus;</span> </button>
			<input type="text" class="velaQtyNum velaQtyText" value="{{itemQty}}" min="1" data-id="{{id}}" aria-label="quantity" pattern="[0-9]*" name="{{inputName}}" id="{{inputId}}" />
			<button type="button" class="velaQtyAdjust velaQtyButton velaQtyPlus" data-id="{{id}}" data-qty="{{itemAdd}}"> <span class="txtFallback">+</span> </button>
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
						<a class="proImage" title="" href="#"> <img class="img-responsive proImageQuickview" src="//cdn.shopify.com/s/files/1/0276/4616/5110/t/6/assets/loading.gif?v=4737358046173361859" alt="Quickview" /> <span class="loadingImage"></span> </a>
					</div>
					<div class="proThumbnails proThumbnailsQuickview clearfix">
						<div class="owl-thumblist">
							<div class="owl-carousel"> </div>
						</div>
					</div>
				</div>
				<div class="proBoxInfo col-xs-12 col-sm-12 col-md-7">
					<h3 class="quickviewName mb20">&nbsp;</h3>
					<div class="proShortDescription rte"></div>
					<form action="/cart/add" method="post" enctype="multipart/form-data" class="formQuickview form-ajaxtocart">
						<div class="proVariantsQuickview">
							<select name='id' style="display:none"></select>
						</div>
						<div class="proPrice clearfix"> <span class="priceProduct priceCompare"></span> <span class="priceProduct pricePrimary"></span> </div>
						<div class="velaGroup d-flex flexAlignEnd mb20">
							<div class="proQuantity">
								<!-- <label for="Quantity" class="qtySelector">Quantity</label> -->
								<input type="number" id="Quantity" name="quantity" value="1" min="1" class="qtySelector"> </div>
							<div class="proButton">
								<button type="submit" name="add" class="btn btnAddToCart"> <span>Add to Cart</span> </button>
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
	</div>
	<div id="goToTop" class="hidden-xs hidden-sm"><span class="fa fa-angle-up"></span></div>
	<div id="velaPreLoading"> <span></span>
		<div class="velaLoading"> <span class="velaLoadingIcon one"></span> <span class="velaLoadingIcon two"></span> <span class="velaLoadingIcon three"></span> <span class="velaLoadingIcon four"></span> </div>
	</div>
	<script src="//cdn.shopify.com/s/files/1/0276/4616/5110/t/6/assets/jquery.elevatezoom.min.js?v=16345386540807305179" type="text/javascript"></script>
	<script src="//cdn.shopify.com/shopifycloud/shopify/assets/themes_support/option_selection-fe6b72c2bbdd3369ac0bfefe8648e3c889efca213baefd4cfb0dd9363563831f.js" type="text/javascript"></script>
	<script src="//cdn.shopify.com/shopifycloud/shopify/assets/themes_support/api.jquery-e94e010e92e659b566dbc436fdfe5242764380e00398907a14955ba301a4749f.js" type="text/javascript"></script>
	<script src="//cdn.shopify.com/s/javascripts/currencies.js" type="text/javascript"></script>
	<script src="//cdn.shopify.com/s/files/1/0276/4616/5110/t/6/assets/vendor.js?v=13878651640065809907" type="text/javascript"></script>
	<script src="//cdn.shopify.com/s/files/1/0276/4616/5110/t/6/assets/vela_ajaxcart.js?v=14082523266353193198" type="text/javascript"></script>
	<script src="//cdn.shopify.com/s/files/1/0276/4616/5110/t/6/assets/lazysizes.min.js?v=15377268347072223862" async="async"></script>
	<script src="//cdn.shopify.com/s/files/1/0276/4616/5110/t/6/assets/vela.js?v=11348010493869627964" type="text/javascript"></script>
	<script src="//cdn.shopify.com/s/files/1/0276/4616/5110/t/6/assets/jquery.cookie.js?v=7236575574540404818" type="text/javascript"></script>
	<script type="text/javascript">
		if(window.currencies) {
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
			if(cookieCurrency == null) {
				if(shopCurrency !== defaultCurrency) {
					Currency.convertAll(shopCurrency, defaultCurrency);
				} else {
					Currency.currentCurrency = defaultCurrency;
				}
			} else if($('[name=currencies]').size() && $('[name=currencies] .jsvela-currency__item[data-value=' + cookieCurrency + ']').size() === 0) {
				Currency.currentCurrency = shopCurrency;
				Currency.cookie.write(shopCurrency);
			} else if(cookieCurrency === shopCurrency) {
				Currency.currentCurrency = shopCurrency;
			} else {
				Currency.currentCurrency = cookieCurrency;
				Currency.convertAll(shopCurrency, cookieCurrency);
				velaCurrencies.data('value', cookieCurrency);
				velaCurrencyItem.removeClass('active');
				velaCurrencyItem.each(function() {
					if($(this).data('value') === cookieCurrency) $(this).addClass('active');
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


	<?php include('footer.php'); ?>
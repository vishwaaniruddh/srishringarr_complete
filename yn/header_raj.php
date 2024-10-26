<?php session_start();
include('config.php');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include('db_connection.php');

if(!isset($_SESSION['cur'])){
    $_SESSION['cur'] ='INR';
}

?>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="#ba933e">

    <link rel="canonical" href="https://yosshitaneha.com/">

        <link rel="shortcut icon" href="assets/logo.jpg" type="image/icon">
        
<?php
if(isset($_GET['type'])){
  if($_GET['type']==2){
    ?>
    <meta name="description" content="Buy/Stitch exclusive Indian Designer Wear. Saree Blouses, Lehenga Cholis, Indo Western, Evening Gowns, Kalamkari Outfits, Kurtis|YosshitaNeha">
    <meta name="keyword" content="Apparels, Indian Wear, Indian Wedding Wear, Saree Blouses, Lehenga Choli, Indo Western, Indian Designer Outfits, Evening Wear, Custom made Blouses, Kalamkari Kurtis, Kurtis, Designer Wear, Designer Blouses, Indian Traditional Wear">

    <title>
        Buy/ Customise Designer Wear at YosshitaNeha
    </title>
    <meta property="og:site_name" content="Yosshita Neha Fashion Studio">
    <meta property="og:url" content="https://yosshitaneha.com/">
    <meta property="og:title" content="Buy/ Customise Designer Wear at YosshitaNeha">
    <meta property="og:type" content="website">
    <meta property="og:description" content="Buy/Stitch exclusive Indian Designer Wear. Saree Blouses, Lehenga Cholis, Indo Western, Evening Gowns, Kalamkari Outfits, Kurtis|YosshitaNeha">

    <meta name="twitter:site" content="@">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Buy/ Customise Designer Wear at YosshitaNeha">
    <meta name="twitter:description" content="Buy/Stitch exclusive Indian Designer Wear. Saree Blouses, Lehenga Cholis, Indo Western, Evening Gowns, Kalamkari Outfits, Kurtis|YosshitaNeha">


    <?php

  } else if($_GET['type']==1)
  {?>
    <meta name="description" content="Buy from one of India's widest collection of designer Jewelry -Yosshita Neha.Bridal Jewelry,Kundan Jewelry,Earrings,Mang Tika,Borla,Nath,Diamond Set,Accessories">
    <meta name="keyword" content="Wedding Jewelry,Bridal Jewelry,Jewelry for Bride,Sabyasachi Style Jewelry,Kundan Set,Necklace Set,Mang Tika,Nath,Bridal Nath,Bangle,Damini,Borla,Earring,Diamond Jewelry,Antique Jewelry,Payal,Acessories">

  <title>
        Buy Exquisite Indian Designer Jewelry|Yosshita Neha
    </title>
  <meta property="og:site_name" content="Yosshita Neha Fashion Studio">
<meta property="og:url" content="https://yosshitaneha.com/">
<meta property="og:title" content="Buy Exquisite Indian Designer Jewelry|Yosshita Neha">
<meta property="og:type" content="website">
<meta property="og:description" content="Buy from one of India's widest collection of designer Jewelry -Yosshita Neha.Bridal Jewelry,Kundan Jewelry,Earrings,Mang Tika,Borla,Nath,Diamond Set,Accessories">


<meta name="twitter:site" content="@">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Buy Exquisite Indian Designer Jewelry|Yosshita Neha">
<meta name="twitter:description" content="Buy from one of India's widest collection of designer Jewelry -Yosshita Neha.Bridal Jewelry,Kundan Jewelry,Earrings,Mang Tika,Borla,Nath,Diamond Set,Accessories">

 <?php }

}
else{
  ?>
    <meta name="description" content="Buy Designer Jewellery & Outfits for any occasions. Exclusive Lehenga Choli, IndoWestern, Gowns and Jewelry. Also stitch Blouses & other Outfits at our studio.">
    <meta name="keyword" content="Designer Studio,Stitch Blouses,Designer in India,Designer Wear,Blouse,Lehenga,Indo Western,Indian Wear,Evening Gown,Jewellery,Buy Earrings,Mang Tika,Borla,Necklace Set,Damini,Kundan Jewelery,Nath,Bridal Jewelery & Accessories,Diamond Jewelery.">

    <title>
        YosshitaNeha | Shop / Customise Designer Wear & Jewellery
    </title>

    <!-- /snippets/social-meta-tags.liquid -->
<meta property="og:site_name" content="Yosshita Neha Fashion Studio">
<meta property="og:url" content="https://yosshitaneha.com/">
<meta property="og:title" content="YosshitaNeha | Shop / Customise Designer Wear & Jewellery">
<meta property="og:type" content="website">
<meta property="og:description" content="Buy Designer Jewellery & Outfits for any occasions. Exclusive Lehenga Choli, IndoWestern, Gowns and Jewelry. Also stitch Blouses & other Outfits at our studio.">

<!--added meta tag as per asked by manoj sir for facebook verification-->
<meta name="facebook-domain-verification" content="pgmpggi7zu956ixyxu1soy75w5e6ll" /> 

<meta name="twitter:site" content="@">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="YosshitaNeha| Shop/ Customise Designer Wear & Jewellery">
<meta name="twitter:description" content="Buy Designer Jewellery & Outfits for any occasions. Exclusive Lehenga Choli, IndoWestern, Gowns and Jewelry. Also stitch Blouses & other Outfits at our studio.">
 <?php
}
?>




    <!--<link href="css/vela-fonts.css" rel="stylesheet" type="text/css" media="all">-->
    <link rel="preload" href="css/vela-fonts.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="css/vela-fonts.css">
    </noscript>
    
<!--<link href="css/plugin.css" rel="stylesheet" type="text/css" media="all">-->
<link rel="preload" href="css/plugin.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="css/plugin.css">
    </noscript>

<!--<link href="css/vela-site.scss.css" rel="stylesheet" type="text/css" media="all">-->
<link rel="preload" href="css/vela-site.scss.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="css/vela-site.scss.css">
    </noscript>

<!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->

<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q5PT82HBCC"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-Q5PT82HBCC');
</script>

<script src="js/jquery-3.5.0.min.js" type="text/javascript"></script>
    <script type="text/javascript" async="" src="js/1.js"></script>
    <script type="text/javascript" async="" src="js/2.js"></script>

<script>
    window.money = '<span class="money">${{amount}}</span>';
    window.money_format = '${{amount}} USD';
    window.currency = 'USD';
    window.shop_money_format = "${{amount}}";
    window.shop_money_with_currency_format = "${{amount}} USD";
    window.loading_url = "//cdn.shopify.com/s/files/1/0276/4616/5110/t/5/assets/loading.gif?v=4737358046173361859";
    window.file_url = "//cdn.shopify.com/s/files/1/0276/4616/5110/files/?553";
    window.asset_url = "//cdn.shopify.com/s/files/1/0276/4616/5110/t/5/assets/?553";
    window.ajaxcart_type = 'drawer';
    window.newsletter_success = "Thank you for your subscription";
    window.cart_empty = "Your cart is currently empty.";
    window.swatch_enable = true;
    window.swatch_show_unvailable = true;
    window.sidebar_multichoise = true;
    window.float_header = false;
    window.review = true;
    window.currencies = true;
    window.countdown_format = "<ul class='list-unstyle list-inline'><li><span class='number'>%D</span><span>Days</span></li><li><span class='number'>%H</span><span>Hours</span></li><li><span class='number'>%M</span><span>Mins</span></li><li><span class='number'>%S</span><span>Secs</span></li></ul>";
</script>
    <script>window.performance && window.performance.mark && window.performance.mark('shopify.content_for_header.start');</script><meta id="shopify-digital-wallet" name="shopify-digital-wallet" content="/27646165110/digital_wallets/dialog">


<link href="https://monorail-edge.shopifysvc.com" rel="dns-prefetch">



<script id="shopify-features" type="application/json">{"accessToken":"e969fbd9de8c3a349d6e1854aa648c3e","betas":["rich-media-storefront-analytics"],"domain":"https://yosshitaneha.com/","predictiveSearch":true,"shopId":27646165110,"smart_payment_buttons_url":"https:\/\/cdn.shopify.com\/shopifycloud\/payment-sheet\/assets\/latest\/spb.en.js","dynamic_checkout_cart_url":"https:\/\/cdn.shopify.com\/shopifycloud\/payment-sheet\/assets\/latest\/dynamic-checkout-cart.en.js","locale":"en"}</script>
<script>var Shopify = Shopify || {};
Shopify.shop = "https://yosshitaneha.com/";
Shopify.locale = "en";
Shopify.currency = {"active":"USD","rate":"1.0"};
Shopify.country = "US";
Shopify.theme = {"name":"fashion-home03","id":81135960182,"theme_store_id":null,"role":"main"};
Shopify.theme.handle = "null";
Shopify.theme.style = {"id":null,"handle":null};
Shopify.cdnHost = "cdn.shopify.com";</script>
<script type="module">!function(o){(o.Shopify=o.Shopify||{}).modules=!0}(window);</script>
<script>!function(o){function n(){var o=[];function n(){o.push(Array.prototype.slice.apply(arguments))}return n.q=o,n}var t=o.Shopify=o.Shopify||{};t.loadFeatures=n(),t.autoloadFeatures=n()}(window);</script>
<script>(function() {
  function asyncLoad() {
    var urls = ["\/\/productreviews.shopifycdn.com\/assets\/v4\/spr.js?shop=velademorubix-fashion.myshopify.com"];
    for (var i = 0; i < urls.length; i++) {
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
})();</script>
<script id="__st">var __st={"a":27646165110,"offset":-18000,"reqid":"9465a689-ea15-4679-96b8-a8d9a53e937c","pageurl":"velademorubix-fashion.myshopify.com\/","u":"f616310d0d66","p":"home"};</script>
<script>window.ShopifyPaypalV4VisibilityTracking = true;</script>
<script>window.ShopifyAnalytics = window.ShopifyAnalytics || {};
window.ShopifyAnalytics.meta = window.ShopifyAnalytics.meta || {};
window.ShopifyAnalytics.meta.currency = 'USD';
var meta = {"page":{"pageType":"home"}};
for (var attr in meta) {
  window.ShopifyAnalytics.meta[attr] = meta[attr];
}</script>
<script>window.ShopifyAnalytics.merchantGoogleAnalytics = function() {

};
</script>
<script class="analytics">(function () {
  var customDocumentWrite = function(content) {
    var jquery = null;

    if (window.jQuery) {
      jquery = window.jQuery;
    } else if (window.Checkout && window.Checkout.$) {
      jquery = window.Checkout.$;
    }

    if (jquery) {
      jquery('body').append(content);
    }
  };

  var hasLoggedConversion = function(token) {
    if (document.cookie.indexOf('loggedConversion=' + window.location.pathname) !== -1) {
      return true;
    }
    if (token) {
      return document.cookie.indexOf('loggedConversion=' + token) !== -1;
    }
    return false;
  }

  var setCookieIfConversion = function(token) {
    if (token) {
      var twoMonthsFromNow = new Date(Date.now());
      twoMonthsFromNow.setMonth(twoMonthsFromNow.getMonth() + 2);

      document.cookie = 'loggedConversion=' + token + '; expires=' + twoMonthsFromNow;
    }
  }

  var trekkie = window.ShopifyAnalytics.lib = window.trekkie = window.trekkie || [];
  if (trekkie.integrations) {
    return;
  }
  trekkie.methods = [
    'identify',
    'page',
    'ready',
    'track',
    'trackForm',
    'trackLink'
  ];
  trekkie.factory = function(method) {
    return function() {
      var args = Array.prototype.slice.call(arguments);
      args.unshift(method);
      trekkie.push(args);
      return trekkie;
    };
  };
  for (var i = 0; i < trekkie.methods.length; i++) {
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
        if (window && window.navigator && typeof window.navigator.sendBeacon === 'function' && typeof window.Blob === 'function' && !Monorail.isIos12()) {
          var blobData = new window.Blob([payload], {
            type: 'text/plain'
          });

          if (window.navigator.sendBeacon(endpointUrl, blobData)) {
            return true;
          } // sendBeacon was not successful

        } // XHR beacon

        var xhr = new XMLHttpRequest();

        try {
          xhr.open('POST', endpointUrl);
          xhr.setRequestHeader('Content-Type', 'text/plain');
          xhr.send(payload);
        } catch (e) {
          console.log(e);
        }

        return false;
      },
      isIos12: function isIos12() {
        return window.navigator.userAgent.lastIndexOf('iPhone; CPU iPhone OS 12_') !== -1 || window.navigator.userAgent.lastIndexOf('iPad; CPU OS 12_') !== -1;
      }
    };
    Monorail.produce('monorail-edge.shopifysvc.com',
      'trekkie_storefront_load_errors/1.1',
      {shop_id: 27646165110,
      theme_id: 81135960182,
      app_name: "storefront",
      context_url: window.location.href,
      source_url: "https://cdn.shopify.com/s/trekkie.storefront.9f320156b58d74db598714aa83b6a5fbab4d4efb.min.js"});

      };
      scriptFallback.async = true;
      scriptFallback.src = 'https://cdn.shopify.com/s/trekkie.storefront.9f320156b58d74db598714aa83b6a5fbab4d4efb.min.js';
      first.parentNode.insertBefore(scriptFallback, first);
    };
    script.async = true;
    script.src = 'https://cdn.shopify.com/s/trekkie.storefront.9f320156b58d74db598714aa83b6a5fbab4d4efb.min.js';
    first.parentNode.insertBefore(script, first);
  };
  trekkie.load(
    {"Trekkie":{"appName":"storefront","development":false,"defaultAttributes":{"shopId":27646165110,"isMerchantRequest":null,"themeId":81135960182,"themeCityHash":"3019203884554981895","contentLanguage":"en","currency":"USD"},"isServerSideCookieWritingEnabled":true,"isPixelGateEnabled":true},"Performance":{"navigationTimingApiMeasurementsEnabled":true,"navigationTimingApiMeasurementsSampleRate":1},"Session Attribution":{},"Customer Events API":{}}
  );

  var loaded = false;
  trekkie.ready(function() {
    if (loaded) return;
    loaded = true;

    window.ShopifyAnalytics.lib = window.trekkie;


    var originalDocumentWrite = document.write;
    document.write = customDocumentWrite;
    try { window.ShopifyAnalytics.merchantGoogleAnalytics.call(this); } catch(error) {};
    document.write = originalDocumentWrite;
      (function () {
        if (window.BOOMR && (window.BOOMR.version || window.BOOMR.snippetExecuted)) {
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
        window.BOOMR.themeId = 81135960182;
        window.BOOMR.url =
          "https://cdn.shopify.com/shopifycloud/boomerang/shopify-boomerang-1.0.0.min.js";
        var where = document.currentScript || document.getElementsByTagName("script")[0];
        var parentNode = where.parentNode;
        var promoted = false;
        var LOADER_TIMEOUT = 3000;
        function promote() {
          if (promoted) {
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
          if (!window.addEventListener && window.attachEvent && navigator.userAgent.match(/MSIE [67]./)) {
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
          } catch (e) {
            dom = document.domain;
            iframe.src = "javascript:var d=document.open();d.domain='" + dom + "';void(0);";
            win = iframe.contentWindow;
            doc = win.document.open();
          }
          if (dom) {
            doc._boomrl = function() {
              this.domain = dom;
              bootstrap();
            };
            doc.write("<body onload='document._boomrl();'>");
          } else {
            win._boomrl = function() {
              bootstrap();
            };
            if (win.addEventListener) {
              win.addEventListener("load", win._boomrl, false);
            } else if (win.attachEvent) {
              win.attachEvent("onload", win._boomrl);
            }
          }
          doc.close();
        }
        var link = document.createElement("link");
        if (link.relList &&
          typeof link.relList.supports === "function" &&
          link.relList.supports("preload") &&
          ("as" in link)) {
          window.BOOMR.snippetMethod = "p";
          link.href = window.BOOMR.url;
          link.rel = "preload";
          link.as = "script";
          link.addEventListener("load", promote);
          link.addEventListener("error", function() {
            iframeLoader(true);
          });
          setTimeout(function() {
            if (!promoted) {
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
        if (window.addEventListener) {
          window.addEventListener("load", boomerangSaveLoadTime, false);
        } else if (window.attachEvent) {
          window.attachEvent("onload", boomerangSaveLoadTime);
        }
        if (document.addEventListener) {
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
        } else if (document.attachEvent) {
          document.attachEvent("onpropertychange", function(e) {
            if (!e) e=event;
            if (e.propertyName === "onBoomerangLoaded") {
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
        window.ShopifyAnalytics.lib.page(
          null,
          {"pageType":"home"}
        );


    var match = window.location.pathname.match(/checkouts\/(.+)\/(thank_you|post_purchase)/)
    var token = match? match[1]: undefined;
    if (!hasLoggedConversion(token)) {
      setCookieIfConversion(token);

    }
  });
      var eventsListenerScript = document.createElement('script');
      eventsListenerScript.async = true;
      eventsListenerScript.src = "//cdn.shopify.com/shopifycloud/shopify/assets/shop_events_listener-68ba3f1321f00bf07cb78a03841621079812265e950cdccade3463749ea2705e.js";
      document.getElementsByTagName('head')[0].appendChild(eventsListenerScript);

})();</script><script async="" src="//cdn.shopify.com/shopifycloud/shopify/assets/shop_events_listener-68ba3f1321f00bf07cb78a03841621079812265e950cdccade3463749ea2705e.js"></script>
    <script src="requiredfunction.js"></script>
<script>!function(e){e.addEventListener("DOMContentLoaded",function(){var t;null!==e.querySelector('form[action^="/contact"] input[name="form_type"][value="contact"]')&&(window.Shopify=window.Shopify||{},window.Shopify.recaptchaV3=window.Shopify.recaptchaV3||{siteKey:"6LcCR2cUAAAAANS1Gpq_mDIJ2pQuJphsSQaUEuc9"},(t=e.createElement("script")).setAttribute("src","https://cdn.shopify.com/shopifycloud/storefront-recaptcha-v3/v0.1/index.js"),e.body.appendChild(t))})}(document);</script>
<script integrity="sha256-2KbxRG1nAJxSTtTmhkiAC6kILrdVSO4o4QUDMcvnuig=" data-source-attribution="shopify.loadfeatures" defer="defer" src="//cdn.shopify.com/shopifycloud/shopify/assets/storefront/load_feature-d8a6f1446d67009c524ed4e68648800ba9082eb75548ee28e1050331cbe7ba28.js" crossorigin="anonymous"></script>
<script integrity="sha256-h+g5mYiIAULyxidxudjy/2wpCz/3Rd1CbrDf4NudHa4=" data-source-attribution="shopify.dynamic-checkout" defer="defer" src="//cdn.shopify.com/shopifycloud/shopify/assets/storefront/features-87e8399988880142f2c62771b9d8f2ff6c290b3ff745dd426eb0dfe0db9d1dae.js" crossorigin="anonymous"></script>


<script>window.performance && window.performance.mark && window.performance.mark('shopify.content_for_header.end');</script>
<meta property="og:image" content="https://cdn.shopify.com/s/files/1/0276/4616/5110/files/logo.png?height=628&amp;pad_color=fff&amp;v=1589372129&amp;width=1200">
<meta property="og:image:secure_url" content="https://cdn.shopify.com/s/files/1/0276/4616/5110/files/logo.png?height=628&amp;pad_color=fff&amp;v=1589372129&amp;width=1200">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="628">
<!--<script type="module" defer="" src="https://cdn.shopify.com/shopifycloud/consent-tracking-api/v0.1/consent-tracking-api.js"></script>-->

<link href="https://cdn.shopify.com/shopifycloud/boomerang/shopify-boomerang-1.0.0.min.js" rel="preload" as="script">

<script id="boomr-scr-as" src="https://cdn.shopify.com/shopifycloud/boomerang/shopify-boomerang-1.0.0.min.js" async=""></script>
<!--<link rel="stylesheet" type="text/css" href="https://productreviews.shopifycdn.com/assets/v4/spr-805222bdeda8199e3a86a468a398e3070e6126868692225ffa23ac7502b1eca2.css" media="screen">-->

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>


</head>
<!--menuMobileActive-->
<body id="products" class="template-collection ">
<div id="cartDrawer" class="drawer drawerRight" style="user-select: auto;" tabindex="-1"></div>
	<style>
	@media (max-width: 767px){
        ul.nav>li {
            display: block !important;
        }    
        .menuMobileOverlay{
            visibility:hidden;
        }
    }
.nav>li{
    display:inline-block !important;
}
    .headerMenu {
    position: relative;
    box-shadow: 0px 6px 14px -10px;
}
@media (min-width: 768px){
.menuMobileOverlay {
    display:none;
}    
}


</style>
<?php include('header1_raj.php'); ?>
<?php include('header2_raj.php'); ?>

<div id="velaMenuMobile" class="menuMobileContainer hidden-md hidden-lg">
    <div class="menuMobileWrapper">

        <div class="memoHeader">
            <div class="product-card__image" style="padding-top:18.461538461538463%;">
                <a href="https://yosshitaneha.com/"><img style="width: 135px; height:100%;" class="product-card__img lazyautosizes ls-is-cached lazyloaded"  sizes="90px" srcset="assets/logo.jpg"></a>
            </div>
            <br>
            <span>Menu</span>
            <div class="btnMenuClose">&nbsp;</div>
        </div>
        <ul class="nav memoNav">
                    <li class="">
                        <a href="https://yosshitaneha.com/" title="">Home</a>
                    </li>
                    <li class="hasMemoDropdown">
                        <a href="category_test.php?page=1" title="">Jewellery</a>
                        <span class="memoBtnDropdown collapsed" data-toggle="collapse" data-target="#memoDropdown11"><i class="fa fa-angle-down"></i></span>
                         <ul id="memoDropdown11" class="memoDropdown collapse"><li class="hasMemoDropdown active">
                                        <a href="#" title="">All categories</a>
                                        <span class="memoBtnDropdown collapsed" data-toggle="collapse" data-target="#memoDropdown111"><i class="fa fa-angle-down"></i></span>
                                        <ul id="memoDropdown111" class="memoDropdown collapse">
                                            <li class="">
                                                        <?php
                                                        $qryjew=mysqli_query($con,"SELECT * FROM `jewel_subcat` where mcat_id=2 or mcat_id=3");

                                                        while($rowjew=mysqli_fetch_array($qryjew)){
                                                            $qryjew1=mysqli_query($con,"select * from subcat1  where maincat_id='$rowjew[0]' and status=1 order by name");

                                                            $cnt = mysqli_num_rows($qryjew1);
                                                                $i = 1;
                                                                while($rowjew1=mysqli_fetch_row($qryjew1)) {

                                                                    if($i==1){ ?>
                                                                    <li>
                                                                        <a href="list.php?type=1&id=<?php echo $rowjew1[0]; ?>">
                                                                            <?php  echo ($rowjew[2]); ?>
                                                                                </b>
                                                                        </a>
                                                                    </li>
                                                                    <?php }
                                                                        $i++;
                                                                    }
                                                                }
                                                                ?>

                                                        </ul>
                                    </li>
                                    <br>
                                    <li class="hasMemoDropdown active">
                                        <a href="#" title="">Necklace Sets</a>
                                        <span class="memoBtnDropdown collapsed" data-toggle="collapse" data-target="#memoDropdown112"><i class="fa fa-angle-down"></i></span>
                                        <ul id="memoDropdown112" class="memoDropdown collapse">
                                          <li class="active">

                                                        <? $neck_sql=mysqli_query($con,"select * from subcat1 where maincat_id='1' and status=1 order by name");

                                                            while($neck_sql_result =mysqli_fetch_assoc($neck_sql)){ ?>
                                                          <li>
                                                            <a href="list.php?type=1&id=<?php echo $neck_sql_result['subcat_id']; ?>" title="">
                                                              <? echo $neck_sql_result['name'];?>
                                                            </a>
                                                          </li>
                                                          <? } ?>
                                                          </li>
                                                        </ul>
                                    </li>
                                    <br>
                                    <li class="hasMemoDropdown">
                                        <a href="#" title="">Earrings</a>
                                        <span class="memoBtnDropdown collapsed" data-toggle="collapse" data-target="#memoDropdown113"><i class="fa fa-angle-down"></i></span>
                                        <ul id="memoDropdown113" class="memoDropdown collapse">
                                          <li class="">
                                            <? $ear_sql=mysqli_query($con,"select * from subcat1 where maincat_id='17' and status=1 order by name");

                                                              while($ear_sql_result =mysqli_fetch_assoc($ear_sql)){ ?>
                                            <li>
                                              <a href="list.php?type=1&id=<?php echo $ear_sql_result['subcat_id']; ?>" title="">
                                                <? echo $ear_sql_result['name'];?>
                                              </a>
                                            </li>
                                            <? } ?>
                                            </li>
                                        </ul>
                                    </li>
                        </ul>
                    </li>
                    <li class="hasMemoDropdown active">
                        <a href="category_test.php?page=2" title="">Apparels</a>
                        <span class="memoBtnDropdown collapsed" data-toggle="collapse" data-target="#memoDropdown12"><i class="fa fa-angle-down"></i></span>
                        <ul id="memoDropdown12" class="memoDropdown collapse">
                          <li class="hasMemoDropdown active">
                                              <?
                                              $qryjew=mysqli_query($con,"SELECT * FROM `garments` where `Main_id`=2 or `Main_id`=3");
                                              while($rowjew=mysqli_fetch_assoc($qryjew)) {
                                                      $name =$rowjew['name'];
                                          ?>
                                          <h5 class="collTitle"><a href="list.php?type=2&id=<?php echo $rowjew['garment_id']; ?>" title="Womens"> <? echo $name; ?></a></h5>
                                          <? } ?>
                          </li>
                        </ul>
                    </li>
                    <li class="">
                    <a href="https://yosshitaneha.com/contact_us.php" title=""> <span>Contact Us</span></a>
                  </li>
                  <li class="">
                    <a href="https://yosshitaneha.com/about_us.php" title=""> <span>About Us</span></a>
                  </li>
        </ul>
    </div>
</div>
<div class="menuMobileOverlay hidden-md hidden-lg"></div>
</div>

<script>
		$(document).ready(function(){

               $.ajax({
                type: "POST",
                url: 'cartdrawer.php',
                data: 'count='+1,
                success:function(msg) {
                    $("#cartDrawer").html(msg);
                }
       });
    $(".btnAddToCart").on('click',function(){
$("#cartDrawer").html('');
               $.ajax({
                type: "POST",
                url: 'cartcount.php',
                data: 'count='+1,
                success:function(msg) {


                    $("#CartCount").html(msg);
                }
       });
          $.ajax({
                type: "POST",
                url: 'cartdrawer.php',
                data: 'count='+1,
                success:function(msg) {
                    $("#cartDrawer").html(msg);
                }
       });
     });
    });
</script>


<div id="pageContainer" class="isMoved is-transitioning">


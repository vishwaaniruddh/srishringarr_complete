<?php include('header.php');


$product_type = $_GET['type'];
$product_id = $_GET['id'];


//var_dump($_SESSION);
?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script src="https://pagination.js.org/dist/2.1.4/pagination.min.js"></script>
<link rel="stylesheet" href="https://pagination.js.org/dist/2.1.4/pagination.css"/>
<script type="text/javascript" src="//code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">




<style>
.velaProBlock.grid .btnProduct {
    width: 45px;
    height: 45px;
    text-align: center;
    line-height: 48px;
    padding: 20%;
}


.sidebarListCategories li.sidebarCateItem{
    display:block !important;
}
    .paginationjs .paginationjs-pages li.active>a{
            z-index: 3;
    color: #fff;
    background-color: #ba933e;
    border-color: #ba933e;
    cursor: default;
    }
    .paginationjs .paginationjs-pages li:not(:last-child) {
    margin-right: 8px;
}
.paginationjs .paginationjs-pages li {
    border-right: 1px solid #aaa !important;
    border : 1px solid #aaa !important;
}
.paginationjs .paginationjs-pages li>a{
    font-size:18px;
}
.product-card__image .product-card__img{
    object-fit: cover;
}
</style>



<main class="mainContent" role="main">
            <div id="shopify-section-template--14167069720694__main" class="shopify-section">
<div id="pageContent" class="vela-page" style="  ">
    <div class="container"><div class="pageContainer">
            <div class="rte">

            </div>
        </div>
    </div>
</div>

</div><div id="shopify-section-template--14167069720694__163731070222620442" class="shopify-section velaFramework">
<div class="velaMultiBanner mb60" style="background-color: rgba(0,0,0,0);
                                     ">
    <div class="container-full">
        <div class="velaMultiBannerInner gutter20">
            <div class="velaContent"><div class="rowFlex rowFlexMargin  noGutter">

<div class="col-xs-12">
                                <div class="velaBanner effectNone">
                                    <!--<a href="https://velademorubix-fashion.myshopify.com/pages/about-us#" title="velademorubix-fashion">-->

<div class="p-relative">
    <div class="product-card__image" style="padding-top:67.70833333333334%;">
        <img class="product-card__img lazyautosizes lazyloaded" src="assets/aboutusimages/m1.jpg" >
        <!-- <img class="product-card__img lazyautosizes lazyloaded" data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]" data-aspectratio="1.476923076923077" data-ratio="1.476923076923077" data-sizes="auto" alt="" data-srcset="//cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_180x.jpg?v=1589384194 180w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_360x.jpg?v=1589384194 360w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_540x.jpg?v=1589384194 540w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_720x.jpg?v=1589384194 720w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_900x.jpg?v=1589384194 900w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_1080x.jpg?v=1589384194 1080w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_1296x.jpg?v=1589384194 1296w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_1512x.jpg?v=1589384194 1512w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_1728x.jpg?v=1589384194 1728w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_1944x.jpg?v=1589384194 1944w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_2160x.jpg?v=1589384194 2160w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_2376x.jpg?v=1589384194 2376w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_2592x.jpg?v=1589384194 2592w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_2808x.jpg?v=1589384194 2808w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_3024x.jpg?v=1589384194 3024w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_4320x.jpg?v=1589384194 4320w" sizes="1262.769230769231px" srcset="//cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_180x.jpg?v=1589384194 180w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_360x.jpg?v=1589384194 360w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_540x.jpg?v=1589384194 540w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_720x.jpg?v=1589384194 720w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_900x.jpg?v=1589384194 900w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_1080x.jpg?v=1589384194 1080w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_1296x.jpg?v=1589384194 1296w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_1512x.jpg?v=1589384194 1512w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_1728x.jpg?v=1589384194 1728w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_1944x.jpg?v=1589384194 1944w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_2160x.jpg?v=1589384194 2160w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_2376x.jpg?v=1589384194 2376w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_2592x.jpg?v=1589384194 2592w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_2808x.jpg?v=1589384194 2808w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_3024x.jpg?v=1589384194 3024w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/bg-newsletter_4320x.jpg?v=1589384194 4320w"> -->
    </div>
    <div class="placeholder-background placeholder-background--animation" data-image-placeholder=""></div>
</div>


</a>
                                </div>
                            </div>

                    </div></div>
        </div>
    </div>
</div>
</div><div id="shopify-section-template--14167069720694__vela-about-text-feature" class="shopify-section"><div class="velaAboutUsFeature mbBlockGutter" style="background-color: rgba(0,0,0,0);
                                        ">
        <div class="container"><div class="rowFlex rowFlexMargin">
                        <div class="col-xs-12 col-sm-12 col-md-4 mbItemGutter">
                            <div class="featureBox">
                                <div class="featureImage">

<div class="p-relative">
    <div class="product-card__image" style="padding-top:62.59259259259259%;">
        <img class="product-card__img lazyautosizes lazyloaded" src="assets/aboutusimages/recreate.png" >
        <!-- <img class="product-card__img lazyautosizes lazyloaded" data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]" data-aspectratio="1.5976331360946745" data-ratio="1.5976331360946745" data-sizes="auto" alt="" data-srcset="//cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_180x.jpg?v=1617186810 180w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_360x.jpg?v=1617186810 360w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_540x.jpg?v=1617186810 540w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_720x.jpg?v=1617186810 720w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_900x.jpg?v=1617186810 900w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_1080x.jpg?v=1617186810 1080w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_1296x.jpg?v=1617186810 1296w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_1512x.jpg?v=1617186810 1512w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_1728x.jpg?v=1617186810 1728w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_1944x.jpg?v=1617186810 1944w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_2160x.jpg?v=1617186810 2160w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_2376x.jpg?v=1617186810 2376w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_2592x.jpg?v=1617186810 2592w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_2808x.jpg?v=1617186810 2808w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_3024x.jpg?v=1617186810 3024w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_4320x.jpg?v=1617186810 4320w" sizes="377px" srcset="//cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_180x.jpg?v=1617186810 180w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_360x.jpg?v=1617186810 360w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_540x.jpg?v=1617186810 540w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_720x.jpg?v=1617186810 720w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_900x.jpg?v=1617186810 900w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_1080x.jpg?v=1617186810 1080w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_1296x.jpg?v=1617186810 1296w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_1512x.jpg?v=1617186810 1512w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_1728x.jpg?v=1617186810 1728w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_1944x.jpg?v=1617186810 1944w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_2160x.jpg?v=1617186810 2160w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_2376x.jpg?v=1617186810 2376w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_2592x.jpg?v=1617186810 2592w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_2808x.jpg?v=1617186810 2808w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_3024x.jpg?v=1617186810 3024w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/8_540x_a2e773e3-9cd5-492c-a94e-f36fcacb9fb8_4320x.jpg?v=1617186810 4320w"> -->
    </div>
    <div class="placeholder-background placeholder-background--animation" data-image-placeholder=""></div>
</div>


</div>
                                <div class="featureBoxContent"><h4 class="featureTitle">WE RECREATE</h4>
                                        <div class="featuredesc"> Your precious old fabrics & sarees can now get a makeover. YN recreates from your existing fabrics and gives it a trendy new look.</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-4 mbItemGutter">
                            <div class="featureBox">
                                <div class="featureImage">

<div class="p-relative">
    <div class="product-card__image" style="padding-top:62.5%;">
        <img class="product-card__img lazyautosizes lazyloaded" src="assets/aboutusimages/Middle2.jpg" >

        <!-- <img class="product-card__img lazyautosizes lazyloaded" data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]" data-aspectratio="1.6" data-ratio="1.6" data-sizes="auto" alt="" data-srcset="//cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_180x.jpg?v=1617186829 180w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_360x.jpg?v=1617186829 360w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_540x.jpg?v=1617186829 540w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_720x.jpg?v=1617186829 720w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_900x.jpg?v=1617186829 900w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_1080x.jpg?v=1617186829 1080w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_1296x.jpg?v=1617186829 1296w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_1512x.jpg?v=1617186829 1512w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_1728x.jpg?v=1617186829 1728w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_1944x.jpg?v=1617186829 1944w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_2160x.jpg?v=1617186829 2160w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_2376x.jpg?v=1617186829 2376w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_2592x.jpg?v=1617186829 2592w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_2808x.jpg?v=1617186829 2808w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_3024x.jpg?v=1617186829 3024w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_4320x.jpg?v=1617186829 4320w" sizes="376px" srcset="//cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_180x.jpg?v=1617186829 180w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_360x.jpg?v=1617186829 360w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_540x.jpg?v=1617186829 540w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_720x.jpg?v=1617186829 720w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_900x.jpg?v=1617186829 900w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_1080x.jpg?v=1617186829 1080w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_1296x.jpg?v=1617186829 1296w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_1512x.jpg?v=1617186829 1512w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_1728x.jpg?v=1617186829 1728w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_1944x.jpg?v=1617186829 1944w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_2160x.jpg?v=1617186829 2160w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_2376x.jpg?v=1617186829 2376w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_2592x.jpg?v=1617186829 2592w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_2808x.jpg?v=1617186829 2808w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_3024x.jpg?v=1617186829 3024w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/6_10_4320x.jpg?v=1617186829 4320w"> -->
    </div>
    <div class="placeholder-background placeholder-background--animation" data-image-placeholder=""></div>
</div>


</div>
                                <div class="featureBoxContent">
                                    <h4 class="featureTitle"> WE SELL</h4>
                                    <div class="featuredesc"> We offer a plethora of breathtaking ready to wear apparel and jewellery so that you can deck yourself out to your heart’s desire and really personalise your look.</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-4 mbItemGutter">
                            <div class="featureBox">
                                <div class="featureImage">

<div class="p-relative">
    <div class="product-card__image" style="padding-top:62.5%;">
        <img class="product-card__img lazyautosizes lazyloaded" src="assets/aboutusimages/blouse.png" >

        <!-- <img class="product-card__img lazyautosizes lazyloaded" data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]" data-aspectratio="1.6" data-ratio="1.6" data-sizes="auto" alt="" data-srcset="//cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_180x.jpg?v=1617186847 180w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_360x.jpg?v=1617186847 360w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_540x.jpg?v=1617186847 540w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_720x.jpg?v=1617186847 720w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_900x.jpg?v=1617186847 900w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_1080x.jpg?v=1617186847 1080w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_1296x.jpg?v=1617186847 1296w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_1512x.jpg?v=1617186847 1512w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_1728x.jpg?v=1617186847 1728w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_1944x.jpg?v=1617186847 1944w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_2160x.jpg?v=1617186847 2160w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_2376x.jpg?v=1617186847 2376w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_2592x.jpg?v=1617186847 2592w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_2808x.jpg?v=1617186847 2808w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_3024x.jpg?v=1617186847 3024w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_4320x.jpg?v=1617186847 4320w" sizes="376px" srcset="//cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_180x.jpg?v=1617186847 180w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_360x.jpg?v=1617186847 360w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_540x.jpg?v=1617186847 540w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_720x.jpg?v=1617186847 720w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_900x.jpg?v=1617186847 900w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_1080x.jpg?v=1617186847 1080w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_1296x.jpg?v=1617186847 1296w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_1512x.jpg?v=1617186847 1512w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_1728x.jpg?v=1617186847 1728w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_1944x.jpg?v=1617186847 1944w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_2160x.jpg?v=1617186847 2160w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_2376x.jpg?v=1617186847 2376w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_2592x.jpg?v=1617186847 2592w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_2808x.jpg?v=1617186847 2808w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_3024x.jpg?v=1617186847 3024w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/7_4_4320x.jpg?v=1617186847 4320w"> -->
    </div>
    <div class="placeholder-background placeholder-background--animation" data-image-placeholder=""></div>
</div>


</div>
                                <div class="featureBoxContent">
                                    <h4 class="featureTitle">WE CUSTOM DESIGN</h4>
                                    <div class="featuredesc"> Our USP lies in customization since well-fit clothes are always in fashion. Come indulge in fashion and get your outfits tailored to perfection. We design for men, women & kids.</div></div>
                            </div>
                        </div>

</div>
        </div>
    </div>

</div><div id="shopify-section-template--14167069720694__vela-about-service" class="shopify-section velaFramework"><div class="velaAboutService mbGutter" style="background-color: #ba933e;
                                        ">
        <div class="container-full">
            <div class="noGutter rowFlex flexAlignCenter">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="aboutThumb">

<div class="p-relative">
    <div class="product-card__image" style="padding-top:58.64583333333333%;">
        <img class="product-card__img lazyautosizes lazyloaded" src="assets/aboutusimages/Bottom.jpg" >

        <!-- <img class="product-card__img lazyautosizes lazyloaded" data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]" data-aspectratio="1.7051509769094138" data-ratio="1.7051509769094138" data-sizes="auto" alt="" data-srcset="//cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_180x.jpg?v=1617186693 180w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_360x.jpg?v=1617186693 360w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_540x.jpg?v=1617186693 540w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_720x.jpg?v=1617186693 720w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_900x.jpg?v=1617186693 900w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_1080x.jpg?v=1617186693 1080w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_1296x.jpg?v=1617186693 1296w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_1512x.jpg?v=1617186693 1512w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_1728x.jpg?v=1617186693 1728w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_1944x.jpg?v=1617186693 1944w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_2160x.jpg?v=1617186693 2160w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_2376x.jpg?v=1617186693 2376w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_2592x.jpg?v=1617186693 2592w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_2808x.jpg?v=1617186693 2808w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_3024x.jpg?v=1617186693 3024w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_4320x.jpg?v=1617186693 4320w" sizes="632px" srcset="//cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_180x.jpg?v=1617186693 180w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_360x.jpg?v=1617186693 360w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_540x.jpg?v=1617186693 540w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_720x.jpg?v=1617186693 720w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_900x.jpg?v=1617186693 900w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_1080x.jpg?v=1617186693 1080w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_1296x.jpg?v=1617186693 1296w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_1512x.jpg?v=1617186693 1512w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_1728x.jpg?v=1617186693 1728w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_1944x.jpg?v=1617186693 1944w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_2160x.jpg?v=1617186693 2160w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_2376x.jpg?v=1617186693 2376w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_2592x.jpg?v=1617186693 2592w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_2808x.jpg?v=1617186693 2808w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_3024x.jpg?v=1617186693 3024w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/about4_1080x_a07842af-f530-4b1a-b5c3-1b7c54e333aa_4320x.jpg?v=1617186693 4320w"> -->
    </div>
    <div class="placeholder-background placeholder-background--animation" data-image-placeholder=""></div>
</div>


</div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="wrap"><h3 class="velaHomeTitle velaTitle text-center">
                                Why choose us
                            </h3><div class="velaContent">
                            <div class="rowFlex rowFlexMargin">

                                    <div class="col-md-12 col-sm-6">
                                        <div class="boxService d-flex flexAlignCenter">
                                            <div class="boxServiceContent">
                                                <p><b>Welcome to a world of mesmerizing Jewelry and Outfits. Stuff that you have never seen before!!</b></p>
                                                <p><b>Our label is a seamless confluence of inspiration, ethnicity and femininity. Each ensemble is designed to come alive on the wearer and compliment her feminine core.</b></p>
                                                <p><b>Our collections play around with different elements, to give rise to beautifully detailed pieces. We promise to offer exclusive pieces that you will cherish for the rest of your life.</b></p>
                                                <p><b>Most of the time what brings in customer delight is the largest collection anyone can find under one roof. We offer a plethora of breathtaking jewellery and apparel so that you can deck yourself out to your heart’s desire and really personalise your look.</b></p>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div></div><div id="shopify-section-template--14167069720694__vela-about-team" class="shopify-section"><div class="velaAboutUs velaAboutUsTeams mbBlockGutter">

</div>
</div>
        </main>


<style type="text/css">
@keyframes ldio-kpxe4ypb4vk {
  0% { transform: rotate(0deg) }
  50% { transform: rotate(180deg) }
  100% { transform: rotate(360deg) }
}
.ldio-kpxe4ypb4vk div {
  position: absolute;
  animation: ldio-kpxe4ypb4vk 1s linear infinite;
  width: 160px;
  height: 160px;
  top: 20px;
  left: 20px;
  border-radius: 50%;
  box-shadow: 0 4px 0 0 #deb34b;
  transform-origin: 80px 82px;
}
.loadingio-spinner-eclipse-w42oo7vkqqq {
  width: 200px;
  height: 200px;
  display: inline-block;
  overflow: hidden;
  /*background: #f1f2f3;*/
}
.ldio-kpxe4ypb4vk {
  width: 100%;
  height: 100%;
  position: relative;
  transform: translateZ(0) scale(1);
  backface-visibility: hidden;
  transform-origin: 0 0; /* see note above */
}
.ldio-kpxe4ypb4vk div { box-sizing: content-box; }
/* generated by https://loading.io/ */
</style>



<div id="q"></div>

<style>
    .flash {
  display: block;
  position: fixed;
  top: 125px;
  right: 25px;
  width: 350px;
  padding: 20px 25px 20px 85px;
  font-size: 16px;
  font-weight: 400;
  color: #66847C;
  background-color: #FFF;
  border: 2px solid #66847C;
  border-radius: 2px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.25);
  opacity: 0;
  z-index:100;
  /*display:none;*/
}

.flash__icon {
  position: absolute;
  top: 50%;
  left: 0;
  width: 1.8em;
  height: 100%;
  padding: 0 0.4em;
  background-color: #66847C;
  color: #FFF;
  font-size: 36px;
  font-weight: 300;
  transform: translate(0, -50%);
}
.flash__icon .icon {
  position: absolute;
  top: 50%;
  transform: translate(0, -50%);
}

.button {
  position: absolute;
  top: 50%;
  left: 50%;
  padding: 10px 20px;
  border: 2px solid #66847C;
  border-radius: 2px;
  color: #66847C;
  transform: translate(-50%, -50%);
  transition: all 0.1s;
}
.button:hover {
  cursor: pointer;
  color: #FFF;
  background-color: #66847C;
}
.button:active {
  box-shadow: none;
  background-color: #5f7b74;
}

@-webkit-keyframes drop-in-fade-out {
  0% {
    opacity: 0;
    visibility: visible;
    -webkit-transform: translate3d(0, -200%, 0);
    -moz-transform: translate3d(0, -200%, 0);
    -ms-transform: translate3d(0, -200%, 0);
    -o-transform: translate3d(0, -200%, 0);
    transform: translate3d(0, -200%, 0);
  }
  12% {
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  20% {
    opacity: 1;
  }
  70% {
    opacity: 1;
    visibility: visible;
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  80% {
    opacity: 0;
  }
  100% {
    visibility: hidden;
    -webkit-transform: translate3d(75%, 0, 0);
    -moz-transform: translate3d(75%, 0, 0);
    -ms-transform: translate3d(75%, 0, 0);
    -o-transform: translate3d(75%, 0, 0);
    transform: translate3d(25%, 0, 0);
  }
}
@-moz-keyframes drop-in-fade-out {
  0% {
    opacity: 0;
    visibility: visible;
    -webkit-transform: translate3d(0, -200%, 0);
    -moz-transform: translate3d(0, -200%, 0);
    -ms-transform: translate3d(0, -200%, 0);
    -o-transform: translate3d(0, -200%, 0);
    transform: translate3d(0, -200%, 0);
  }
  12% {
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  20% {
    opacity: 1;
  }
  70% {
    opacity: 1;
    visibility: visible;
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  80% {
    opacity: 0;
  }
  100% {
    visibility: hidden;
    -webkit-transform: translate3d(75%, 0, 0);
    -moz-transform: translate3d(75%, 0, 0);
    -ms-transform: translate3d(75%, 0, 0);
    -o-transform: translate3d(75%, 0, 0);
    transform: translate3d(25%, 0, 0);
  }
}
@-o-keyframes drop-in-fade-out {
  0% {
    opacity: 0;
    visibility: visible;
    -webkit-transform: translate3d(0, -200%, 0);
    -moz-transform: translate3d(0, -200%, 0);
    -ms-transform: translate3d(0, -200%, 0);
    -o-transform: translate3d(0, -200%, 0);
    transform: translate3d(0, -200%, 0);
  }
  12% {
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  20% {
    opacity: 1;
  }
  70% {
    opacity: 1;
    visibility: visible;
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  80% {
    opacity: 0;
  }
  100% {
    visibility: hidden;
    -webkit-transform: translate3d(75%, 0, 0);
    -moz-transform: translate3d(75%, 0, 0);
    -ms-transform: translate3d(75%, 0, 0);
    -o-transform: translate3d(75%, 0, 0);
    transform: translate3d(25%, 0, 0);
  }
}
@keyframes drop-in-fade-out {
  0% {
    opacity: 0;
    visibility: visible;
    -webkit-transform: translate3d(0, -200%, 0);
    -moz-transform: translate3d(0, -200%, 0);
    -ms-transform: translate3d(0, -200%, 0);
    -o-transform: translate3d(0, -200%, 0);
    transform: translate3d(0, -200%, 0);
  }
  12% {
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  20% {
    opacity: 1;
  }
  70% {
    opacity: 1;
    visibility: visible;
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }
  80% {
    opacity: 0;
  }
  100% {
    visibility: hidden;
    -webkit-transform: translate3d(75%, 0, 0);
    -moz-transform: translate3d(75%, 0, 0);
    -ms-transform: translate3d(75%, 0, 0);
    -o-transform: translate3d(75%, 0, 0);
    transform: translate3d(25%, 0, 0);
  }
}
.animate--drop-in-fade-out {
  -webkit-animation: drop-in-fade-out 3.5s 0.4s cubic-bezier(.32,1.75,.65,.91);
  -moz-animation: drop-in-fade-out 3.5s 0.4s cubic-bezier(.32,1.75,.65,.91);
  -ms-animation: drop-in-fade-out 3.5s 0.4s cubic-bezier(.32,1.75,.65,.91);
  -o-animation: drop-in-fade-out 3.5s 0.4s cubic-bezier(.32,1.75,.65,.91);
  animation: drop-in-fade-out 3.5s 0.4s cubic-bezier(.32,1.75,.65,.91);
}
</style>


<?php include('footer.php'); ?>


<?php include 'header.php';

?>


<script src="js/flexslider.min.js"></script>

<main class="mainContent" role="main">

<div id="shopify-section-1551027504217" class="shopify-section velaFramework"><div class="banner-slideShow " style="background-color: #eaebef;  margin:0 0 60px; ">
    <div class="container-full" >
        <div class="velaSlideshow">
            <div data-section-id="1551027504217" data-section-type="velaSlideshowSection"><div class="velaSlideshowWrapper">
            <button type="button" class="btnssPause" data-id="1551027504217">
                <span class="btnssPauseStop">
                <i class="fa fa-play"></i>
                <span class="iconText">Pause slideshow</span>
            </span>
                <span class="btnssPausePlay">
                <i class="fa fa-pause"></i>
                <span class="iconText">Play slideshow</span>
                </span>
            </button>
            <div id="velaSlideshows1551027504217" class="vela--slideshow velaSliderLoading"  data-autoplay="true" data-speed="5000" data-navigation="true" data-pagination="true">
        <?php
            $ban_sql = mysqli_query($con, "select * from yn_banner where status=1 order by id asc");
            while ($ban_sql_result = mysqli_fetch_assoc($ban_sql)) {
        ?>
                <div class="velassSlide velassSlide1551027504217-0" >
                    <a href="#" class="velassLink">
                        <div class="velassImage" >
                            <div class="p-relative">
                                <div class="product-card__image" style="padding-top:34.89583333333333%;;">
                                    <img class="product-card__img lazyload" src="AdminPanel/<?php echo $ban_sql_result['image']; ?>" data-aspectratio="2.8656716417910446" data-ratio="2.8656716417910446" data-sizes="auto" alt="" style="object-fit: fill;height:auto;padding-bottom:23%" />
                                </div>
                                <div class="placeholder-background placeholder-background--animation" data-image-placeholder></div>
                            </div>
                        </div>
                    </a>
                   <div class="velassCaption captionPosition" style="background-color:rgba(0,0,0,0)" >
                        <div class="container captionWrap">
                            <div class="velassCaptionContent text-left align-middle">
                                <div class="velassCaptionInner text-left ">
                                    <h3 class="velassHeadingSmall leftright-3" style="color:#1a1a1a;">

                                        <b><?php echo $ban_sql_result['title']; ?></b>
                                    </h3>
                                    <h2 class="velassHeading leftright-2" style="color:#ffffff;">
                                        <?php echo $ban_sql_result['description']; ?>
                                    </h2>
                                    <a class="btn btnVelaSlider leftright-5" href="<?php echo $ban_sql_result['link']; ?>" style="border-color: #1a1a1a;  background-color: #1a1a1a; color: #ffffff; padding: 14px 25px; "> Start Shopping <i class="icons icon-arrow-right"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             <?php } ?>
            </div>
            </div>
            </div>
            </div>
        </div>
    </div>
</div>

<style>
.slick-slide{
    height:auto !important;
}


.slider_li{
    width: 207.75px;
    margin-right: 20px;
    float: left;
    display: block;
}

.slider_img{
    width: 100%;
    height: auto;
    display: block;
    margin: 0 0 1em;
    box-shadow: none;
}
.tm-product-direction-nav , .tm-product-control-paging{
    display:none;
}
</style>
<div class="container">

    <div class="velaProducts sectionInner ">
        <div class="headingGroup pb20">
            <h3 class="velaHomeTitle text-center">
                New Arrivals
            </h3>
        </div>
    </div>
<div class="tm-slider">
<ul class="slides products">
<?

$sqlimg = "SELECT id,img,`description` from `newarrivals` order by rank";
$qryimg = mysqli_query($con, $sqlimg);
// $prodid = $qryimg['id'];
while ($rowimg = mysqli_fetch_array($qryimg)) {?>
        <li class="slider_li">
            <a href="https://yosshitaneha.com/detail.php?id=<?php echo $rowimg['id'];?>">
                <img class="slider_img" src="../<?php echo $rowimg['img']; ?>" alt=""></a>
            <p><?php echo $rowimg['description']; ?></p>
        </li>
    <?php }?>
     </ul>
</div>
</div>
<div class="shopify-section velaFramework" id="shopify-section-1586583951335">
    <div class="velaFiveCollection style_default mbBlockGutter" style="background-color: rgba(0,0,0,0);padding:20px 0 0; ">
        <div class="container">
            <div class="sectionInner ">
                <div class="headingGroup pb20">
                    <h3 class="velaHomeTitle text-center">
                        COLLECTIONS
                    </h3>
                </div>
                <div class="velaContent">
                    <div class="velaCollectionInner ">
                        <div class="velaContent">
                            <div class="rowFlex rowFlexMargin">
                                <div class="col-xs-12 col-sm-6 col-md-4" style="margin-top: 0;padding: 0;">
                                    <div class="velaCollectionItem mbItemGutter">
                                        <div class="effectFour">
                                            <a href="https://yosshitaneha.com/list.php?type=1&id=66" title="Bangles">
                                                <div class="p-relative">
                                                    <div class="product-card__image" style="padding-top:67.74193548387096%;">
                                                        <img alt="Bangles" class="product-card__img lazyautosizes lazyloaded" data-aspectratio="1.4761904761904763" data-ratio="1.4761904761904763" data-sizes="auto" data-srcset="https://srishringarr.com/asset/c/com/com_Bangles.jpg" data-widths="" sizes="783px" srcset="https://srishringarr.com/asset/c/com/com_Bangles.jpg">
                                                        </img>
                                                    </div>
                                                    <div class="placeholder-background placeholder-background--animation" data-image-placeholder="">
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="velaCollectionWrap">
                                            <h4 class="title">
                                                <a href="#" title="Bangles">
                                                   Bangles
                                                </a>
                                            </h4>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4" style="margin-top: 0;padding: 0;">
                                    <div class="velaCollectionItem mbItemGutter">
                                        <div class="effectFour">
                                            <a href="https://yosshitaneha.com/list.php?type=1&id=53" title="Borla">
                                                <div class="p-relative">
                                                    <div class="product-card__image" style="padding-top:67.74193548387096%;">
                                                        <img alt="Borla" class="product-card__img lazyautosizes lazyloaded" data-aspectratio="1.4761904761904763" data-ratio="1.4761904761904763" data-sizes="auto" data-srcset="https://srishringarr.com/asset/c/com/com_Borla.jpg" data-widths="" sizes="783px" srcset="https://srishringarr.com/asset/c/com/com_Borla.jpg">
                                                        </img>
                                                    </div>
                                                    <div class="placeholder-background placeholder-background--animation" data-image-placeholder="">
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="velaCollectionWrap">
                                            <h4 class="title">
                                                <a href="#" title="Womens">
                                                   Borla
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4" style="margin-top: 0;padding: 0;">
                                    <div class="velaCollectionItem mbItemGutter">
                                        <div class="effectFour">
                                            <a href="https://yosshitaneha.com/list.php?type=1&id=77" title="Earring">
                                                <div class="p-relative">
                                                    <div class="product-card__image" style="padding-top:67.74193548387096%;">
                                                        <img alt="Earring" class="product-card__img lazyautosizes lazyloaded" data-aspectratio="1.4761904761904763" data-ratio="1.4761904761904763" data-sizes="auto" src="https://srishringarr.com/asset/Earrings_Kundan .jpg" data-widths="" sizes="783px" >
                                                        </img>
                                                    </div>
                                                    <div class="placeholder-background placeholder-background--animation" data-image-placeholder="">
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="velaCollectionWrap">
                                            <h4 class="title">
                                                <a href="#" title="Earring">
                                                   Earring
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4" style="margin-top: 0;padding: 0;">
                                    <div class="velaCollectionItem mbItemGutter">
                                        <div class="effectFour">
                                            <a href="https://yosshitaneha.com/list.php?type=1&id=69" title="Hath Phool">
                                                <div class="p-relative">
                                                    <div class="product-card__image" style="padding-top:67.74193548387096%;">
                                                        <img alt="Hath Phool" class="product-card__img lazyautosizes lazyloaded" data-aspectratio="1.4761904761904763" data-ratio="1.4761904761904763" data-sizes="auto" data-srcset="https://srishringarr.com/asset/c/com/com_Hathphool.jpg" data-widths="" sizes="783px" srcset="https://srishringarr.com/asset/c/com/com_Hathphool.jpg">
                                                        </img>
                                                    </div>
                                                    <div class="placeholder-background placeholder-background--animation" data-image-placeholder="">
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="velaCollectionWrap">
                                            <h4 class="title">
                                                <a href="#" title="Hath Phool">
                                                  Hath Phool
                                                </a>
                                            </h4>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4" style="margin-top: 0;padding: 0;">
                                    <div class="velaCollectionItem mbItemGutter">
                                        <div class="effectFour">
                                            <a href="https://yosshitaneha.com/list.php?type=2&id=10" title="Lehenga Choli">
                                                <div class="p-relative">
                                                    <div class="product-card__image" style="padding-top:67.74193548387096%;">
                                                        <img alt="Lehenga Choli" class="product-card__img lazyautosizes lazyloaded" data-aspectratio="1.4761904761904763" data-ratio="1.4761904761904763" data-sizes="auto" data-srcset="https://srishringarr.com/asset/c/com/com_Lehenga_Choli.jpg" data-widths="" sizes="783px" srcset="https://srishringarr.com/asset/c/com/com_Lehenga_Choli.jpg">
                                                        </img>
                                                    </div>
                                                    <div class="placeholder-background placeholder-background--animation" data-image-placeholder="">
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="velaCollectionWrap">
                                            <h4 class="title">
                                                <a href="#" title="Lehenga Choli">
                                                   Lehenga Choli
                                                </a>
                                            </h4>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4" style="margin-top: 0;padding: 0;">
                                    <div class="velaCollectionItem mbItemGutter">
                                        <div class="effectFour">
                                            <a href="https://yosshitaneha.com/list.php?type=1&id=3" title="Kundan Set">
                                                <div class="p-relative">
                                                    <div class="product-card__image" style="padding-top:67.74193548387096%;">
                                                        <img alt="Kundan Set" class="product-card__img lazyautosizes lazyloaded" data-aspectratio="1.4761904761904763" data-ratio="1.4761904761904763" data-sizes="auto" data-srcset="https://srishringarr.com/asset/c/com/com_Necklace_Set_Kundan.jpg" data-widths="" sizes="783px" srcset="https://srishringarr.com/asset/c/com/com_Necklace_Set_Kundan.jpg">
                                                        </img>
                                                    </div>
                                                    <div class="placeholder-background placeholder-background--animation" data-image-placeholder="">
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="velaCollectionWrap">
                                            <h4 class="title">
                                                <a href="#" title="Kundan Set">
                                                  Kundan Set
                                                </a>
                                            </h4>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4" style="margin-top: 0;padding: 0;">
                                    <div class="velaCollectionItem mbItemGutter">
                                        <div class="effectFour">
                                            <a href="https://yosshitaneha.com/list.php?type=1&id=63" title="Mang Tikkas">
                                                <div class="p-relative">
                                                    <div class="product-card__image" style="padding-top:67.74193548387096%;">
                                                        <img alt="Mang Tikkas" class="product-card__img lazyautosizes lazyloaded" data-aspectratio="1.4761904761904763" data-ratio="1.4761904761904763" data-sizes="auto" data-srcset="https://srishringarr.com/asset/c/com/com_Tikkas.jpg" data-widths="" sizes="783px" srcset="https://srishringarr.com/asset/c/com/com_Tikkas.jpg">
                                                        </img>
                                                    </div>
                                                    <div class="placeholder-background placeholder-background--animation" data-image-placeholder="">
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="velaCollectionWrap">
                                            <h4 class="title">
                                                <a href="#" title="Mang Tikkas">
                                                  Mang Tikkas
                                                </a>
                                            </h4>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4" style="margin-top: 0;padding: 0;">
                                    <div class="velaCollectionItem mbItemGutter">
                                        <div class="effectFour">
                                            <a href="https://yosshitaneha.com/list.php?type=2&id=29" title="Trail Gown">
                                                <div class="p-relative">
                                                    <div class="product-card__image" style="padding-top:67.74193548387096%;">
                                                        <img alt="Trail Gown" class="product-card__img lazyautosizes lazyloaded" data-aspectratio="1.4761904761904763" data-ratio="1.4761904761904763" data-sizes="auto" data-srcset="https://srishringarr.com/asset/c/com/com_Trail_Gown.jpg" data-widths="" sizes="783px" srcset="https://srishringarr.com/asset/c/com/com_Trail_Gown.jpg">
                                                        </img>
                                                    </div>
                                                    <div class="placeholder-background placeholder-background--animation" data-image-placeholder="">
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="velaCollectionWrap">
                                            <h4 class="title">
                                                <a href="#" title="Trail Gown">
                                                  Trail Gown
                                                </a>
                                            </h4>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .velaFourCollection .velaCollectionWrap, .velaFiveCollection .velaCollectionWrap {
     background: transparent;
     padding: 0;
     color: white;
    min-width: 150px;
    position: absolute;
    top: 88%;
    left: 60%;
    text-align: right;
    -webkit-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    -o-transform: translate(-50%, -50%);
     box-shadow: none;
}
.velaCollectionWrap .title a
{
    color: white;
}
.mbItemGutter {
    margin-bottom: 0;
}

.product-card__image .product-card__img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: auto;
    object-fit: contain;
}
    </style>
</div>
<div id="shopify-section-1585963328748" class="shopify-section velaFramework"><div class="velaServices mbBlockGutter" style="
        background-color: #f8f8f8;

        padding: 20px 0;
    ">
    <div class="container">
        <div class="velaServicesInner hasbgGutter">
            <div class="velaContent"><div class="rowFlex rowFlexMargin">

                            <div class="col-xs-12 col-sm-4 mbItemGutter">
                                <div class="boxService text-center"><div class="boxServiceImage ">
                                            <div class="serviceImage" style="width: 48px;height: 48px">
<div class="p-relative">
    <div class="product-card__image" style="padding-top:100.0%;">
        <img class="product-card__img lazyautosizes lazyloaded" data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]" data-aspectratio="1.0" data-ratio="1.0" data-sizes="auto" alt="" data-srcset="//cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_180x.png?v=1589812786 180w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_360x.png?v=1589812786 360w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_540x.png?v=1589812786 540w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_720x.png?v=1589812786 720w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_900x.png?v=1589812786 900w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_1080x.png?v=1589812786 1080w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_1296x.png?v=1589812786 1296w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_1512x.png?v=1589812786 1512w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_1728x.png?v=1589812786 1728w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_1944x.png?v=1589812786 1944w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_2160x.png?v=1589812786 2160w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_2376x.png?v=1589812786 2376w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_2592x.png?v=1589812786 2592w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_2808x.png?v=1589812786 2808w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_3024x.png?v=1589812786 3024w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_4320x.png?v=1589812786 4320w" sizes="48px" srcset="//cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_180x.png?v=1589812786 180w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_360x.png?v=1589812786 360w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_540x.png?v=1589812786 540w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_720x.png?v=1589812786 720w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_900x.png?v=1589812786 900w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_1080x.png?v=1589812786 1080w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_1296x.png?v=1589812786 1296w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_1512x.png?v=1589812786 1512w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_1728x.png?v=1589812786 1728w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_1944x.png?v=1589812786 1944w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_2160x.png?v=1589812786 2160w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_2376x.png?v=1589812786 2376w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_2592x.png?v=1589812786 2592w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_2808x.png?v=1589812786 2808w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_3024x.png?v=1589812786 3024w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-1_4320x.png?v=1589812786 4320w">
    </div>
    <div class="placeholder-background placeholder-background--animation" data-image-placeholder=""></div>
</div>
                                            </div>
                                        </div><div class="boxServiceContent"><h4 class="boxServiceTitle">Free Worldwide Shipping</h4><div class="boxServiceDesc">
                                                On all orders over $75.00
                                            </div><a href="/policies/shipping-policy" title="block.settings.box_text_link">Learn More<span class="icons icon-arrow-right"></span></a></div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 mbItemGutter">
                                <div class="boxService text-center"><div class="boxServiceImage ">
                                            <div class="serviceImage" style="width: 48px;height: 48px">
<div class="p-relative">
    <div class="product-card__image" style="padding-top:100.0%;">
        <img class="product-card__img lazyautosizes lazyloaded" data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]" data-aspectratio="1.0" data-ratio="1.0" data-sizes="auto" alt="" data-srcset="//cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_180x.png?v=1589812796 180w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_360x.png?v=1589812796 360w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_540x.png?v=1589812796 540w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_720x.png?v=1589812796 720w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_900x.png?v=1589812796 900w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_1080x.png?v=1589812796 1080w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_1296x.png?v=1589812796 1296w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_1512x.png?v=1589812796 1512w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_1728x.png?v=1589812796 1728w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_1944x.png?v=1589812796 1944w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_2160x.png?v=1589812796 2160w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_2376x.png?v=1589812796 2376w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_2592x.png?v=1589812796 2592w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_2808x.png?v=1589812796 2808w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_3024x.png?v=1589812796 3024w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_4320x.png?v=1589812796 4320w" sizes="48px" srcset="//cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_180x.png?v=1589812796 180w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_360x.png?v=1589812796 360w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_540x.png?v=1589812796 540w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_720x.png?v=1589812796 720w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_900x.png?v=1589812796 900w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_1080x.png?v=1589812796 1080w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_1296x.png?v=1589812796 1296w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_1512x.png?v=1589812796 1512w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_1728x.png?v=1589812796 1728w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_1944x.png?v=1589812796 1944w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_2160x.png?v=1589812796 2160w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_2376x.png?v=1589812796 2376w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_2592x.png?v=1589812796 2592w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_2808x.png?v=1589812796 2808w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_3024x.png?v=1589812796 3024w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-2_4320x.png?v=1589812796 4320w">
    </div>
    <div class="placeholder-background placeholder-background--animation" data-image-placeholder=""></div>
</div>
                                            </div>
                                        </div><div class="boxServiceContent"><h4 class="boxServiceTitle">100% Payment Secure</h4><div class="boxServiceDesc">
                                                We ensure secure payment with PEV
                                            </div><a href="/policies/privacy-policy" title="block.settings.box_text_link">Learn More<span class="icons icon-arrow-right"></span></a></div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 mbItemGutter">
                                <div class="boxService text-center"><div class="boxServiceImage ">
                                            <div class="serviceImage" style="width: 48px;height: 48px">
<div class="p-relative">
    <div class="product-card__image" style="padding-top:100.0%;">
        <img class="product-card__img lazyautosizes lazyloaded" data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]" data-aspectratio="1.0" data-ratio="1.0" data-sizes="auto" alt="" data-srcset="//cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_180x.png?v=1589812804 180w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_360x.png?v=1589812804 360w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_540x.png?v=1589812804 540w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_720x.png?v=1589812804 720w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_900x.png?v=1589812804 900w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_1080x.png?v=1589812804 1080w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_1296x.png?v=1589812804 1296w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_1512x.png?v=1589812804 1512w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_1728x.png?v=1589812804 1728w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_1944x.png?v=1589812804 1944w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_2160x.png?v=1589812804 2160w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_2376x.png?v=1589812804 2376w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_2592x.png?v=1589812804 2592w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_2808x.png?v=1589812804 2808w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_3024x.png?v=1589812804 3024w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_4320x.png?v=1589812804 4320w" sizes="48px" srcset="//cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_180x.png?v=1589812804 180w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_360x.png?v=1589812804 360w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_540x.png?v=1589812804 540w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_720x.png?v=1589812804 720w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_900x.png?v=1589812804 900w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_1080x.png?v=1589812804 1080w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_1296x.png?v=1589812804 1296w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_1512x.png?v=1589812804 1512w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_1728x.png?v=1589812804 1728w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_1944x.png?v=1589812804 1944w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_2160x.png?v=1589812804 2160w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_2376x.png?v=1589812804 2376w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_2592x.png?v=1589812804 2592w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_2808x.png?v=1589812804 2808w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_3024x.png?v=1589812804 3024w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/our-3_4320x.png?v=1589812804 4320w">
    </div>
    <div class="placeholder-background placeholder-background--animation" data-image-placeholder=""></div>
</div>
                                            </div>
                                        </div><div class="boxServiceContent"><h4 class="boxServiceTitle">30 Days Return</h4><div class="boxServiceDesc">
                                                Return it within 20 day for an exchange
                                            </div><a href="/policies/refund-policy" title="block.settings.box_text_link">Learn More<span class="icons icon-arrow-right"></span></a></div>
                                </div>
                            </div>

                    </div></div>
        </div>
    </div>
</div>
</div>
</main>
<script>

  function getGridSize() {
    return (window.innerWidth < 600) ? 3 :
           (window.innerWidth < 900) ? 4 : 5;
  }



    $('.tm-slider').flexslider({
    animation:"slide",
    namespace:"tm-product-",
    itemWidth: 210,
    itemMargin: 20,
    slideshowSpeed: 2000,
animationSpeed: 600,
    selector:".products > li",
    minItems:getGridSize(),
    maxItems:getGridSize(),
    // touch:false,
    // controlNav:true
})
</script>
<?php include 'footer.php';?>

    <header id="velaHeader" class="velaHeader">
    <section class="headerWrap">
        <div class="velaHeaderMain headerMenu">
            <div class="container">
                <div class="headerContent rowFlex rowFlexMargin flexAlignCenter">
                    <div class="velaHeaderMobile hidden-lg hidden-xl hidden-md col-xs-3 col-sm-3">
                        <div class="menuBtnMobile d-flex flexAlignCenter">
                                <div id="btnMenuMobile" class="btnMenuMobile">
                                <span class="iconMenu"></span>
                                <span class="iconMenu"></span>
                                <span class="iconMenu"></span>
                                <span class="iconMenu"></span>
                            </div>
                            <!--<a class="velaSearchIcon" href="#velaSearchTop" data-toggle="collapse" title="Search">-->
                            <!--    <i class="icons icon-magnifier"></i>-->
                            <!--</a> -->
                        </div>
                    </div>
                    <div class="velaHeaderLeft d-flex flexAlignCenter col-xs-6 col-sm-6 col-md-2 col-lg-2">
                    	<div class="velaLogo" itemscope="" itemtype="https://schema.org/Organization"><a href="/" itemprop="url" class="velaLogoLink" style="width: 300px;"><span class="text-hide">velademorubix-fashion</span>

<div class="p-relative">
    <div class="product-card__image" style="padding-top:24.461538461538463%;" >
        <a href="https://srishringarr.com/yn/"><img style="width:135px;" class="product-card__img lazyautosizes ls-is-cached lazyloaded"  sizes="90px" srcset="assets/logo.jpg"></a>
    </div>
    <div class="placeholder-background placeholder-background--animation" data-image-placeholder=""></div>
</div>
</a></div></div>
        <div class="velaHeaderCenter velaMainmenu hidden-xs hidden-sm d-flex flexJustifyCenter col-xs-6 col-sm-8 col-lg-7 p-static">
            <section id="velaMegamenu" class="velaMegamenu" >
                <nav class="menuContainer">
<ul class="nav hidden-xs hidden-sm">
                        <li>
                            <a href="https://srishringarr.com/yn/" title="">
                                <span>Home</span>
                            </a>
                        </li>
                        <li class="hasMenuDropdown hasMegaMenu ">
                        	<a href="#" title="">
                                <span>Jewellery</span>
                            </a>
                    <a class="btnCaret hidden-xl hidden-lg hidden-md" data-toggle="collapse" href="#megaDropdown21"></a>

	<div id="megaDropdown21" class="menuDropdown megaMenu collapse">
		<div class="menuGroup row">

				<div class="col-sm-5">
					<div class="row">
                            <div class="col-xs-12 col-sm-4">
                                <ul class="velaMenuLinks">
                                    <li class="menuTitle">
                                        <a href="#" title="">All Categories</a>
                                    </li>
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
            						            <?php  echo ($rowjew[2]); ?></b>
            						        </a>
            						    </li>
            						<?php }
            						    $i++;
            					    }
            					}
            					?>
                                </ul>
                            </div>

                            <div class="col-xs-12 col-sm-4">
                                <ul class="velaMenuLinks">
                                    <li class="menuTitle">
                                        <a href="#" title="">Necklace Sets</a>
                                    </li>

                        <? $neck_sql=mysqli_query($con,"select * from subcat1 where maincat_id='1' and status=1 order by name");

            			while($neck_sql_result =mysqli_fetch_assoc($neck_sql)){ ?>
                                        <li>
                                            <a href="list.php?type=1&id=<?php echo $neck_sql_result['subcat_id']; ?>" title=""><? echo $neck_sql_result['name'];?></a>
                                        </li>
                        <? } ?>

                                </ul>
                            </div>
                        <div class="col-xs-12 col-sm-4">
                                <ul class="velaMenuLinks">
                                    <li class="menuTitle">
                                        <a href="#" title="">Earrings</a>
                                    </li>

                               <? $ear_sql=mysqli_query($con,"select * from subcat1 where maincat_id='17' and status=1 order by name");

            			while($ear_sql_result =mysqli_fetch_assoc($ear_sql)){ ?>
                                        <li>
                                            <a href="list.php?type=1&id=<?php echo $ear_sql_result['subcat_id']; ?>" title=""><? echo $ear_sql_result['name'];?></a>
                                        </li>
                        <? } ?>


                                </ul>
                            </div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="velaMenuProducts">
                            <div class="menuTitle"><span>New Products</span></div>
                        <div class="listProduct">
                                <div class="blockProMenu">
                                    <div class="proImage proImageMenu">
                                        <a class="proImageLink" href="/products/victo-pedant-lamp" title="" style="width: 80px; display: block;">
                                         <div class="p-relative">
                                            <div class="product-card__image" style="padding-top:124.25%;">
                                                <img class="product-card__img lazyautosizes ls-is-cached lazyloaded" data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]" data-aspectratio="0.8048289738430584" data-ratio="0.8048289738430584" data-sizes="auto" alt="Petit Piqué Backpack" data-srcset="//cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_180x.jpg?v=1589788212 180w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_360x.jpg?v=1589788212 360w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_540x.jpg?v=1589788212 540w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_720x.jpg?v=1589788212 720w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_900x.jpg?v=1589788212 900w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_1080x.jpg?v=1589788212 1080w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_1296x.jpg?v=1589788212 1296w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_1512x.jpg?v=1589788212 1512w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_1728x.jpg?v=1589788212 1728w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_1944x.jpg?v=1589788212 1944w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_2160x.jpg?v=1589788212 2160w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_2376x.jpg?v=1589788212 2376w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_2592x.jpg?v=1589788212 2592w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_2808x.jpg?v=1589788212 2808w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_3024x.jpg?v=1589788212 3024w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_4320x.jpg?v=1589788212 4320w" sizes="79.67806841046279px" srcset="//cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_180x.jpg?v=1589788212 180w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_360x.jpg?v=1589788212 360w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_540x.jpg?v=1589788212 540w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_720x.jpg?v=1589788212 720w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_900x.jpg?v=1589788212 900w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_1080x.jpg?v=1589788212 1080w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_1296x.jpg?v=1589788212 1296w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_1512x.jpg?v=1589788212 1512w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_1728x.jpg?v=1589788212 1728w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_1944x.jpg?v=1589788212 1944w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_2160x.jpg?v=1589788212 2160w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_2376x.jpg?v=1589788212 2376w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_2592x.jpg?v=1589788212 2592w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_2808x.jpg?v=1589788212 2808w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_3024x.jpg?v=1589788212 3024w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/19_1copy_4320x.jpg?v=1589788212 4320w">
                                            </div>
                                            <div class="placeholder-background placeholder-background--animation" data-image-placeholder=""></div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="proMeta proMetaMenu">
                                        <h5 class="proName">
                                            <a href="/products/victo-pedant-lamp" title="">Petit Piqué Backpack</a>
                                        </h5>

                                            <div class="proReviews">
                                                <span class="spr-badge" id="spr_badge_4491238178934" data-rating="0.0"><span class="spr-starrating spr-badge-starrating"><i class="spr-icon spr-icon-star-empty"></i><i class="spr-icon spr-icon-star-empty"></i><i class="spr-icon spr-icon-star-empty"></i><i class="spr-icon spr-icon-star-empty"></i><i class="spr-icon spr-icon-star-empty"></i></span><span class="spr-badge-caption">No reviews</span>
                                            </span>
                                            </div>
                                        <div class="boxProPrice">
                                            <span class=" proPrice"><span class="money" data-currency-usd="$79.00">$79.00</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="blockProMenu">
                                    <div class="proImage proImageMenu">
                                        <a class="proImageLink" href="/products/turning-table" title="" style="width: 80px; display: block;">
                                            <div class="p-relative">
                                                <div class="product-card__image" style="padding-top:124.25%;">
                                                    <img class="product-card__img lazyautosizes ls-is-cached lazyloaded" data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]" data-aspectratio="0.8048289738430584" data-ratio="0.8048289738430584" data-sizes="auto" alt="Black Silicone Strap" data-srcset="//cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_180x.jpg?v=1589788139 180w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_360x.jpg?v=1589788139 360w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_540x.jpg?v=1589788139 540w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_720x.jpg?v=1589788139 720w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_900x.jpg?v=1589788139 900w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_1080x.jpg?v=1589788139 1080w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_1296x.jpg?v=1589788139 1296w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_1512x.jpg?v=1589788139 1512w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_1728x.jpg?v=1589788139 1728w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_1944x.jpg?v=1589788139 1944w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_2160x.jpg?v=1589788139 2160w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_2376x.jpg?v=1589788139 2376w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_2592x.jpg?v=1589788139 2592w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_2808x.jpg?v=1589788139 2808w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_3024x.jpg?v=1589788139 3024w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_4320x.jpg?v=1589788139 4320w" sizes="79.67806841046279px" srcset="//cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_180x.jpg?v=1589788139 180w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_360x.jpg?v=1589788139 360w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_540x.jpg?v=1589788139 540w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_720x.jpg?v=1589788139 720w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_900x.jpg?v=1589788139 900w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_1080x.jpg?v=1589788139 1080w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_1296x.jpg?v=1589788139 1296w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_1512x.jpg?v=1589788139 1512w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_1728x.jpg?v=1589788139 1728w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_1944x.jpg?v=1589788139 1944w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_2160x.jpg?v=1589788139 2160w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_2376x.jpg?v=1589788139 2376w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_2592x.jpg?v=1589788139 2592w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_2808x.jpg?v=1589788139 2808w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_3024x.jpg?v=1589788139 3024w, //cdn.shopify.com/s/files/1/0276/4616/5110/products/16_1copy_4320x.jpg?v=1589788139 4320w">
                                                </div>
                                                <div class="placeholder-background placeholder-background--animation" data-image-placeholder=""></div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="proMeta proMetaMenu">
                                        <h5 class="proName">
                                            <a href="/products/turning-table" title="">Black Silicone Strap</a>
                                        </h5>

                                            <div class="proReviews">
                                                <span class="spr-badge" id="spr_badge_4491237097590" data-rating="5.0"><span class="spr-starrating spr-badge-starrating"><i class="spr-icon spr-icon-star"></i><i class="spr-icon spr-icon-star"></i><i class="spr-icon spr-icon-star"></i><i class="spr-icon spr-icon-star"></i><i class="spr-icon spr-icon-star"></i></span><span class="spr-badge-caption">1 review</span>
                                             </span>

                                            </div>

                                        <div class="boxProPrice">

                                            <span class=" proPrice"><span class="money" data-currency-usd="$59.00">$59.00</span></span>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
				</div>
          		<div class="col-sm-4">
                  	<div class="velaMenuBanner mb10">
                      	<a href="/collections/shoes">
                            <div class="p-relative">
                                <div class="product-card__image" style="padding-top:52.17391304347826%;">
                                    <img class="product-card__img lazyautosizes ls-is-cached lazyloaded" data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]" data-aspectratio="1.9166666666666667" data-ratio="1.9166666666666667" data-sizes="auto" alt="" data-srcset="//cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_180x.jpg?v=1589797831 180w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_360x.jpg?v=1589797831 360w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_540x.jpg?v=1589797831 540w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_720x.jpg?v=1589797831 720w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_900x.jpg?v=1589797831 900w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_1080x.jpg?v=1589797831 1080w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_1296x.jpg?v=1589797831 1296w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_1512x.jpg?v=1589797831 1512w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_1728x.jpg?v=1589797831 1728w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_1944x.jpg?v=1589797831 1944w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_2160x.jpg?v=1589797831 2160w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_2376x.jpg?v=1589797831 2376w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_2592x.jpg?v=1589797831 2592w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_2808x.jpg?v=1589797831 2808w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_3024x.jpg?v=1589797831 3024w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_4320x.jpg?v=1589797831 4320w" sizes="559.6666666666667px" srcset="//cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_180x.jpg?v=1589797831 180w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_360x.jpg?v=1589797831 360w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_540x.jpg?v=1589797831 540w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_720x.jpg?v=1589797831 720w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_900x.jpg?v=1589797831 900w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_1080x.jpg?v=1589797831 1080w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_1296x.jpg?v=1589797831 1296w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_1512x.jpg?v=1589797831 1512w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_1728x.jpg?v=1589797831 1728w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_1944x.jpg?v=1589797831 1944w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_2160x.jpg?v=1589797831 2160w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_2376x.jpg?v=1589797831 2376w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_2592x.jpg?v=1589797831 2592w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_2808x.jpg?v=1589797831 2808w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_3024x.jpg?v=1589797831 3024w, //cdn.shopify.com/s/files/1/0276/4616/5110/files/banner-menu_4320x.jpg?v=1589797831 4320w">
                                </div>
                                <div class="placeholder-background placeholder-background--animation" data-image-placeholder=""></div>
                            </div>
                      	</a>
                  	</div>
          		</div>
		</div>
	</div>
</li>
        <li class="hasMenuDropdown hasMegaMenu">
            	<a href="#" title="">
        <span>Apparels</span></a>
    <a class="btnCaret hidden-xl hidden-lg hidden-md" data-toggle="collapse" href="#megaDropdown22"></a>

        	<div id="megaDropdown22" class="menuDropdown megaMenu collapse">
        		<div class="menuGroup row">

        				<div class="col-sm-12">
        					<div class="row">
        					</div>
        				</div>

        		        <div class  ="col-sm-12">
                            <div class="velaMenuListCollection">
                                <div class="velaMenuListContent rowFlex">
                                    <?
                                    $qryjew=mysqli_query($con,"SELECT * FROM `garments` where `Main_id`=2 or `Main_id`=3");
                                    while($rowjew=mysqli_fetch_assoc($qryjew)) {
                                            $pathmain = $rowjew['garments_image'];
                                            $name =$rowjew['name'];
                                            $mainCatId =$rowjew['maincat_id'];

                                            $id = $rowjew['maincat_id'];

                                            $subcatId = $rowjew['subcat_id'];
                                            $main_catId = $rowjew['maincat_id']; ?>

                                            <div class="coll-item" style="width: 16.6667%;">
                                            <div class="collImage">
                                            <a href="list.php?type=2&id=<?php echo $rowjew['garment_id']; ?>">


                                            <div class="p-relative">
                                            <div class="product-card__image" style="padding-top:100.0%;">
                                            <img class="product-card__img lazyautosizes ls-is-cached lazyloaded" src="https://yosshitaneha.com/Admin/<? echo $pathmain; ?>">
                                            </div>
                                            <div class="placeholder-background placeholder-background--animation" data-image-placeholder=""></div>
                                            </div>


                                            </a>
                                            </div>
                                            <h5 class="collTitle"><a href="list.php?type=2&id=<?php echo $rowjew['garment_id']; ?>" title="Womens"> <? echo $name; ?></a></h5>
                                            </div>
                                    <? } ?>
                                 </div>
                            </div>
                        </div>

        		</div>
        	</div>
        </li>

        <li class="">
            <a href="/blogs/news" title=""><span>Gallery</span></a>
        </li>

        <li class="">
            <a href="/pages/contact" title="">
                <span>Contact Us</span></a>
        </li>

        <li class="">
            <!--<a href="https://srishringarr.com/yn/aboutus.php" title="">-->
                <span>About Us</span></a>
        </li>

    </ul>
        </nav>
    </section></div>
                    <div class="velaHeaderRight col-xs-3 col-sm-3 col-md-2 col-lg-3">
      <div id="velaTopLinks" class="velaTopLinks d-flex flexAlignCenter">
         <a href="https://yosshitaneha.com/account/account.php">
            <i class="icons icon-user"></i>
         </a>
         <ul class="list-unstyled list-inline hidden-xs hidden-sm hidden-md">



<a href="https://yosshitaneha.com/account/account.php">
    <? if($_SESSION['email']){
        echo "<span>Hello " .  $_SESSION['fname'] ."</span>" ;   }
                    else{
                        echo  "<span>Login / Signup"  ."</span>" ;
        ?>

    </a>  <a href="logout.php">Logout</a>
                    <? } else{  ?>

               <li><a href="login_register.php" id="customer_login_link">Login</a></li>
               <li><a href="login_register.php" id="customer_register_link">Sign up</a></li>
                    <? } ?>

         </ul>
      </div>
<!--<a class="velaSearchIcon hidden-xs hidden-sm" href="#velaSearchTop" data-toggle="collapse" title="Search">-->
<!--                            <i class="icons icon-magnifier"></i>-->
<!--                        </a>   -->
        <div class="velaCartTop">
            <a href="https://srishringarr.com/yosshitaneha/cart.php" class="jsDrawerOpenRight d-flex">
                <i class="fa fa-shopping-bag"></i>
                <span class="text">
                    <span id="CartCount"></span>
                </span>

            </a>
        </div>
                    </div>
                    <div id="velaSearchTop" class="collapse">
	<div class="text-center">
	    <form id="velaSearchbox" class="formSearch" action="/search" method="get">
	        <input type="hidden" name="type" value="product">
	        <input class="velaSearch form-control" type="search" name="q" value="" placeholder="Enter keywords to search..." autocomplete="off">
	        <button id="velaSearchButton" class="btnVelaSearch" type="submit">
	           	<i class="icons icon-magnifier"></i>
	            <span class="btnSearchText">Search</span>
	        </button>
	    <ul class="velaAjaxSearch" style="display: none;"></ul></form>
	</div>
</div>
                </div>
            </div>
        </div>
    </section>
</header>
<script>setInterval(function(){ $("#CartCount").load('cartcount.php'); }, 2000);</script>
<?
// var_dump($_SESSION);
?>

<!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
<?
$absolute_path = getcwd();
?>
<style>
    .nav>li{
        display:inline-block;
    }
</style>

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
    <div class="product-card__image" style="padding-top:42.461538%;" >
        <a href="https://yosshitaneha.com/"><img class="product-card__img lazyautosizes ls-is-cached lazyloaded" loading="lazy"  sizes="110px" src="https://<? echo $_SERVER['SERVER_NAME']; ?>/assets/logo.jpg"></a> </div>
						<div class="placeholder-background placeholder-background--animation" data-image-placeholder=""></div>
					</div>
					</a>
				</div>
			</div>
			<div class="velaHeaderCenter velaMainmenu hidden-xs hidden-sm d-flex flexJustifyCenter col-xs-6 col-sm-8 col-lg-7 p-static">
				<section id="velaMegamenu" class="velaMegamenu1" style="display">
					<nav class="menuContainer">
						<ul class="nav hidden-xs hidden-sm">
							<li>
								<a href="https://yosshitaneha.com/" title=""> <span>Home</span> </a>
							</li>
							<li class="hasMenuDropdown hasMegaMenu" >
								<!--<a href="category.php?page=2" title=""> <span>Jewellery</span> </a>-->
								<a href="#" title=""> <span>Jewellery</span> </a>
								<a class="btnCaret hidden-xl hidden-lg hidden-md" data-toggle="collapse" href="#megaDropdown21"></a>
								<div id="megaDropdown21" class="menuDropdown megaMenu collapse" style="   
								display: none;
    position: absolute;
    width: 100%;
    min-width: 700px;
    background: white;
    z-index: 9;
    top: 15px;
    padding: 20px;
    padding: 10px;
    box-shadow: 0px 0px 10px 2px rgb(0 0 0 / 40%);
    margin: 20px auto;
    margin-left: -130px;">
									<div class="menuGroup row">
										<div class="col-sm-12">
											<div class="row">
												<div class="col-xs-12 col-sm-4">
													<ul class="velaMenuLinks">
														<li class="menuTitle"> <a href="#" title="">All Categories</a> </li>
														<?php
                                                        $qryjew=mysqli_query($con,"SELECT * FROM `jewel_subcat` where mcat_id=2 or mcat_id=3");

                                                        while($rowjew=mysqli_fetch_array($qryjew)){
                                                            $qryjew1=mysqli_query($con,"select * from subcat1  where maincat_id='$rowjew[0]' and status=1 order by name");

                                                            $cnt = mysqli_num_rows($qryjew1);
                                                                $i = 1;
                                                                while($rowjew1=mysqli_fetch_row($qryjew1)) {

                                                                    if($i==1){ ?>
                                                                    <li>
                                                                        <a href="<? echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'] ; ?>/list.php?type=1&id=<?php echo $rowjew1[0]; ?>">
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
												</div>
												<div class="col-xs-12 col-sm-4">
													<ul class="velaMenuLinks">
														<li class="menuTitle"> <a href="#" title="">Necklace Sets</a> </li>
														<? $neck_sql=mysqli_query($con,"select * from subcat1 where maincat_id='1' and status=1 order by name");

                                                            while($neck_sql_result =mysqli_fetch_assoc($neck_sql)){ ?>
															<li>
																<a href="<? echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'] ; ?>/list.php?type=1&id=<?php echo $neck_sql_result['subcat_id']; ?>" title="">
																	<? echo $neck_sql_result['name'];?>
																</a>
															</li>
															<? } ?>
													</ul>
												</div>
												<div class="col-xs-12 col-sm-4">
													<ul class="velaMenuLinks">
														<li class="menuTitle"> <a href="#" title="">Earrings</a> </li>
														<? $ear_sql=mysqli_query($con,"select * from subcat1 where maincat_id='17' and status=1 order by name");

                                                while($ear_sql_result =mysqli_fetch_assoc($ear_sql)){ ?>
															<li>
																<a href="<? echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'] ; ?>/list.php?type=1&id=<?php echo $ear_sql_result['subcat_id']; ?>" title="">
																	<? echo $ear_sql_result['name'];?>
																</a>
															</li>
															<? } ?>
													</ul>
												</div>
											</div>
										</div>

                                        </div>
								</div>
							</li>
							<li class="hasMenuDropdown hasMegaMenu">
								<!--<a href="category.php?page=1" title=""> <span>Apparels</span></a>-->
								<a href="#" title=""> <span>Apparels</span></a>
								<a class="btnCaret hidden-xl hidden-lg hidden-md" data-toggle="collapse" href="#megaDropdown22"></a>
								<div id="megaDropdown22" class="menuDropdown megaMenu collapse" style="display: none;
    position: absolute;
    width: 100%;
    min-width: 900px;
    background: white;
    z-index: 9;
    top: 15px;
    padding: 20px;
    padding: 10px;
    box-shadow: 0px 0px 10px 2px rgb(0 0 0 / 40%);
    margin: 20px auto;
        margin-left: -250px;
    ">
									<div class="menuGroup row">
										<div class="col-sm-12">
											<div class="row"> </div>
										</div>
										<div class="col-sm-12">
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
                                                                $main_catId = $rowjew['maincat_id'];
                                                    ?>
														<div class="coll-item" style="width: 16.6667%;">
															<div class="collImage">
																<a href="<? echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'] ; ?>/list.php?type=2&id=<?php echo $rowjew['garment_id']; ?>">
																	<div class="p-relative">
																		<div class="product-card__image" style="padding-top:100.0%;"> <img class="product-card__img lazyautosizes ls-is-cached lazyloaded" loading="lazy" src="https://yosshitaneha.com/Admin/<? echo $pathmain; ?>"> </div>
																		<div class="placeholder-background placeholder-background--animation" data-image-placeholder=""></div>
																	</div>
																</a>
															</div>

															<h5 class="collTitle"><a href="<? echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'] ; ?>/list.php?type=2&id=<?php echo $rowjew['garment_id']; ?>" title="Womens"> <? echo $name; ?></a></h5> </div>
														<? } ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
							<!-- <li class=""> <a href="/blogs/news" title=""><span>Gallery</span></a> </li> -->
							<li class="">
								<a href="https://yosshitaneha.com/contact_us.php" title=""> <span>Contact Us</span></a>
							</li>
							<li class="">
								<a href="https://yosshitaneha.com/about_us.php" title=""> <span>About Us</span></a>
							</li>
						</ul>
					</nav>
				</section>
			</div>
			<div class="velaHeaderRight col-xs-3 col-sm-3 col-md-2 col-lg-3">
				<div id="velaTopLinks" class="velaTopLinks d-flex flexAlignCenter">
					<? if($_SESSION['email']){ ?>
					<a href="https://yosshitaneha.com/account/account.php"> <i class="icons icon-user"></i> </a>
					<? } else{ ?>
					<a href="https://yosshitaneha.com/login_register.php"> <i class="icons icon-user"></i> </a>
					<? }?>
					<ul class="list-unstyled list-inline hidden-xs hidden-sm hidden-md">
						<? if($_SESSION['email']){
                // echo "<span>Hello " .  $_SESSION['fname'] ."</span>" ;   }
                //     else{
                //         echo  "<span>Login / Signup"  ."</span>" ;
                //         }?> <a href="https://yosshitaneha.com/account/account.php"><?php echo "<span>Hello " .  $_SESSION['fname'] ."</span>" ; ?>  </a> / 
                
                                <a href="<? echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'] ; ?>/logout.php">Logout</a>
                
                
							<?}  else{  ?>
								<li><a href="https://yosshitaneha.com/login_register.php" id="customer_login_link">Login</a></li>
								<li><a href="https://yosshitaneha.com/login_register.php" id="customer_register_link">Sign up</a></li>
								<? } ?>
					</ul>
				</div>
				<!--<a class="velaSearchIcon hidden-xs hidden-sm" href="#velaSearchTop" data-toggle="collapse" title="Search">-->
				<!--                            <i class="icons icon-magnifier"></i>-->
				<!--                        </a>   -->
				<div class="velaCartTop">
					<a href="https://yosshitaneha.com/cart.php" class="d-flex flex-row-reverse"> <i class="icons icon-handbag"></i> <span class="text">
                    <span id="CartCount"></span> </span>
					</a>
				</div>
			</div>
			<div id="velaSearchTop" class="collapse">
				<div class="text-center">
					<form id="velaSearchbox" class="formSearch" action="/search" method="get">
						<input type="hidden" name="type" value="product">
						<input class="velaSearch form-control" type="search" name="q" value="" placeholder="Enter keywords to search..." autocomplete="off">
						<button id="velaSearchButton" class="btnVelaSearch" type="submit"> <i class="icons icon-magnifier"></i> <span class="btnSearchText">Search</span> </button>
						<ul class="velaAjaxSearch" style="display: none;"></ul>
					</form>
				</div>
			</div>
		</div>
		</div>
		</div>
	</section>
</header>
<script>


    
$('.hasMegaMenu').hover(function(){        
    $( this ).find(".menuDropdown").css('display','block');
    }, function() {
    $( this ).find(".menuDropdown").css('display','none');
    });
    

setInterval(function() {
	$("#CartCount").load('<? $_SERVER["DOCUMENT_ROOT"] ?>/cartcount.php');
}, 2000);



</script>
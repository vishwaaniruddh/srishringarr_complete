<!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
<?
$absolute_path = getcwd();
?>
<style>
    .nav>li{
        display:inline-block;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>

<style type="text/css">

/* ============ desktop view ============ */
@media all and (min-width: 992px) {

	.dropdown-menu li{
		position: relative;
	}
	.dropdown-menu .submenu{ 
		display: none;
		position: absolute;
		left:100%; top:-7px;
	}
	.dropdown-menu .submenu-left{ 
		right:100%; left:auto;
	}

	.dropdown-menu > li:hover{ background-color: #f1f1f1 }
	.dropdown-menu > li:hover > .submenu{
		display: block;
		    padding: 10px;
	}
}	
/* ============ desktop view .end// ============ */

/* ============ small devices ============ */
@media (max-width: 991px) {
    .dropdown-menu .dropdown-menu{
    		margin-left:0.7rem; margin-right:0.7rem; margin-bottom: .5rem;
    }
}	
/* ============ small devices .end// ============ */

</style>
<script>


	document.addEventListener("DOMContentLoaded", function(){
        

    	/////// Prevent closing from click inside dropdown
		document.querySelectorAll('.dropdown-menu').forEach(function(element){
			element.addEventListener('click', function (e) {
			  e.stopPropagation();
			});
		})



		// make it as accordion for smaller screens
		if (window.innerWidth < 992) {

			// close all inner dropdowns when parent is closed
			document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
				everydropdown.addEventListener('hidden.bs.dropdown', function () {
					// after dropdown is hidden, then find all submenus
					  this.querySelectorAll('.submenu').forEach(function(everysubmenu){
					  	// hide every submenu as well
					  	everysubmenu.style.display = 'none';
					  });
				})
			});
			
			document.querySelectorAll('.dropdown-menu a').forEach(function(element){
				element.addEventListener('click', function (e) {
		
				  	let nextEl = this.nextElementSibling;
				  	if(nextEl && nextEl.classList.contains('submenu')) {	
				  		// prevent opening link if link needs to open dropdown
				  		e.preventDefault();
				  		console.log(nextEl);
				  		if(nextEl.style.display == 'block'){
				  			nextEl.style.display = 'none';
				  		} else {
				  			nextEl.style.display = 'block';
				  		}

				  	}
				});
			})
		}
		// end if innerWidth

	}); 
	// DOMContentLoaded  end
</script>



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
						</div>
					</div>
					<div class="velaHeaderLeft d-flex flexAlignCenter col-xs-6 col-sm-6 col-md-2 col-lg-2">
						<div class="velaLogo" itemscope="" itemtype="https://schema.org/Organization"><a href="/" itemprop="url" class="velaLogoLink" style="width: 300px;"><span class="text-hide">velademorubix-fashion</span>

<div class="p-relative">
    <div class="product-card__image" style="padding-top:42.461538%;" >
        <a href="https://srishringarr.com/yn//">
            <img class="product-card__img lazyautosizes ls-is-cached lazyloaded" loading="lazy"  
            sizes="110px" src="https://<? echo $_SERVER['SERVER_NAME']; ?>/yn/assets/logo.jpg" 
			alt="Yosshita Neha Fashion Studio Logo"
            />
            </a> </div>
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
								<a href="https://srishringarr.com/yn//" title=""> <span>Home</span> </a>
							</li>



<li class="nav-item dropdown">
		    <a class="nav-link dropdown-toggle" href="#">  Jewellery »   </a>
		    <ul class="dropdown-menu first_dropown">
		        
		        <? 
		        $jew_sql=mysqli_query($con,"SELECT * FROM `jewel_subcat` where mcat_id=2 or mcat_id=3");     
            			
            			while($jew_sql_result=mysqli_fetch_assoc($jew_sql)){  

                            $subcat_id = $jew_sql_result['subcat_id'];
                            $categories_name = $jew_sql_result['categories_name']; ?>

                                <?   

                            $jew_sql1=mysqli_query($con,"select * from subcat1  where maincat_id='".$subcat_id."' and status=1 order by name");
                            $jew_sql1_rows = mysqli_num_rows($jew_sql1);
                            if($jew_sql1_rows>1){
                                
                                echo '<li><a class="dropdown-item" href="#">';
                                echo ucwords(strtolower($categories_name)) . ' » ';
                                
                                echo '<ul class="submenu dropdown-menu">';

                    			    while($jew_sql1_result = mysqli_fetch_assoc($jew_sql1)){
                                            $sub_cat_name = $jew_sql1_result['name']; 
                                            $jewsubcat_id = $jew_sql1_result['subcat_id'];
                                            
                                            if( strlen(trim($sub_cat_name)) > 0 ){ ?>
                                                <a jewel-id="<?php echo $jewsubcat_id; ?>" class="dropdown-item" href="/yn/<?php echo $jew_sql1_result['yn_url']; ?>">
                                                   <? echo ucwords(strtolower(trim($sub_cat_name))) ;?>    
                                               </a>    
                                               <br/>
                                            <? } ?>
                                            
                                            
                    			    <? }
                    			    
                    		
                                echo '</ul></a></li>';
                            }else{
                            
                            $jew_sql1=mysqli_query($con,"select * from subcat1  where maincat_id='".$subcat_id."' and status=1 order by name");
                            $jew_sql1_result = mysqli_fetch_assoc($jew_sql1);
                            $jewsubcat_id = $jew_sql1_result['subcat_id'];
                            ?>                     
                                <li>
                                    <a jewel-id="<?php echo $jewsubcat_id; ?>" class="dropdown-item" href="/yn/<?php echo $jew_sql1_result['yn_url']; ?>">
                                         <? echo ucwords(strtolower($categories_name)); ?>
                                    </a>
                                </li>
                            <? }
                            ?>

                            

                            
                            <?
                            
            			}
            	?>
		        
		        
		        
		        
		        
		        
		    </ul>
		</li>
		




		<li class="nav-item dropdown">
		    <a class="nav-link dropdown-toggle" href="#">  Apparel  »   </a>
		    <ul class="dropdown-menu first_dropown">
		        <?php 
        		        $qryjew=mysqli_query($con,"SELECT * FROM `garments` where `Main_id`=2 or `Main_id`=3");     

         		        while($rowjew=mysqli_fetch_array($qryjew)){
         		        $app_subcat_id = $rowjew[0] ;
         		        ?>
          	                <li>
          	                    <a apparel-id="<?php echo $app_subcat_id; ?>"  href="/yn/<? echo $rowjew['yn_url']; ?>" class="dropdown-item">
              	                    <?php echo ucwords(strtolower($rowjew[2])); ?>
          	                    </a>
          	                </li>
                        <?php } 
         		            
         		        ?>
		    </ul>
		</li>

						<!-- <li class=""> <a href="/blogs/news" title=""><span>Gallery</span></a> </li> -->
							<li class="">
								<a href="https://srishringarr.com/yn/contact_us.php" title=""> <span>Contact Us</span></a>
							</li>
							<li class="">
								<a href="hhttps://srishringarr.com/yn/about_us.php" title=""> <span>About Us</span></a>
							</li>
							<li class="">
								<a href="https://srishringarr.com/yn/client_diary.php" title=""> <span>Client Diary</span></a>
							</li>
						</ul>
					</nav>
				</section>
			</div>
			<div class="velaHeaderRight col-xs-3 col-sm-3 col-md-2 col-lg-3">
				<div id="velaTopLinks" class="velaTopLinks d-flex flexAlignCenter">
					<? if($_SESSION['email']){ ?>
					<a href="https://srishringarr.com/yn//account/account.php"> <i class="icons icon-user"></i> </a>
					<? } else{ ?>
					<a href="https://srishringarr.com/yn//login_register.php"> <i class="icons icon-user"></i> </a>
					<? }?>
					<ul class="list-unstyled list-inline hidden-xs hidden-sm hidden-md">
						<? if($_SESSION['email']){
                // echo "<span>Hello " .  $_SESSION['fname'] ."</span>" ;   }
                //     else{
                //         echo  "<span>Login / Signup"  ."</span>" ;
                //         }?> <a href="https://srishringarr.com/yn//account/account.php"><?php echo "<span>Hello " .  $_SESSION['fname'] ."</span>" ; ?>  </a> / 
                
                                <a href="<? echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'] ; ?>/logout.php">Logout</a>
                
                
							<?}  else{  ?>
								<li><a href="https://srishringarr.com/yn//login_register.php" id="customer_login_link">Login</a></li>
								<li><a href="https://srishringarr.com/yn//login_register.php" id="customer_register_link">Sign up</a></li>
								<? } ?>
					</ul>
				</div>
				<!--<a class="velaSearchIcon hidden-xs hidden-sm" href="#velaSearchTop" data-toggle="collapse" title="Search">-->
				<!--                            <i class="icons icon-magnifier"></i>-->
				<!--                        </a>   -->
				<div class="velaCartTop">
					<a href="https://srishringarr.com/yn//cart.php" class="d-flex flex-row-reverse"> <i class="icons icon-handbag"></i> <span class="text">
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
	$("#CartCount").load('<? $_SERVER["DOCUMENT_ROOT"] ?>/yn/cartcount.php');
}, 2000);

$('.nav-item.dropdown').hover(function(){   
    console.log('ds')
        $( this ).find("a.dropdown-toggle").addClass('show');
        $( this ).find("ul.first_dropown").addClass('show');
    }, function() {
        $( this ).find("a.dropdown-toggle").removeClass('show');
        $( this ).find("ul.first_dropown").removeClass('show');
    });


</script>


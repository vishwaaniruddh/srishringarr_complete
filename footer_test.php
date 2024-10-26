<script src="ajax.js" async></script>

<script src="cdn/popper.min.js" integrity="sha512-BmM0/BQlqh02wuK5Gz9yrbe7VyIVwOzD1o40yi1IsTjriX/NGF37NyXHfmFzIlMmoSIBXgqDiG1VNU6kB5dBbA==" crossorigin="anonymous"></script>
<script src="cdn/bootstrap.bundle.min.js" type="text/javascript"></script>
    	
        <!--<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>-->
        <script type="text/javascript" src="cdn/moment.min.js"></script>
 
<script type="text/javascript" src="cdn/daterangepicker.js"></script>

<script src="requiredfunctions.js"></script>
<script src="js/script.js"></script>

<script src="js/lazyload.js" async></script>




<style>
            @media (max-width: 767px){
                .mobile{
                    display: block;
    position: fixed;
    bottom: 8%;
    right: 8%;
    border-radius: 60px;
    background: #d0caca;
    padding: 15px;
    
    
    z-index: 100000;
                }
                
                
                .header-icons-noti2 {
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 13px;
    height: 13px;
    border-radius: 50%;
    background-color: #111111;
    color: white;
    font-family: Montserrat-Medium;
    font-size: 11px;
    position: absolute;
    top: -11px;
    right: -7px;
}


            }
            @media (min-width: 768px){
                .mobile{
                    display:none;
                }
            }
            
            option {
                width:80px;
            }
            
</style>

<div class="mobile">
    <div class="" id="cartshowid2"></div>    
</div>

    
	<!-- Footer -->
	<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45" style="    margin-top: 21px;
    border-top: 1px solid #b9b4b4;">
		<div class="flex-w p-b-90">
			<div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
				<h4 class="s-text12 p-b-30">
					GET IN TOUCH
				</h4>

				

					<p class="s-text7 w-size27" style=" text-align: justify; text-justify: inter-word;">
						Any questions? Let us know at <br>
						Sri Shringarr Fashion Studio,Shyamkamal Building B/1, Office No.104,1 st Floor, Agarwal Market, Opposite Railway Station,Vile Parle (East), Mumbai 400 057
						<!-- <br>Pin Code : 400 057 --><br>
						Mobile No :
						<a href="tel:+919324243011" class="Blondie">09324243011</a> /
						<a href="tel:+917400413163" class="Blondie">07400413163</a>
						
						  
					</p>

				<div>
					<div class="flex-m p-t-30">
						<a href="https://www.facebook.com/srishringarr/" target="_blank" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
						<a href="https://www.instagram.com/srishringarr/" target="_blank" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
						<!-- <a href="https://plus.google.com/u/1/113103807414319162517" target="_blank" class="fs-18 color1 p-r-20 fa social_googleplus"></a> -->
						<a href="https://twitter.com/SriShringarr" target="_blank" class="fs-18 color1 p-r-20 fa social_twitter"></a>
						<a href="https://in.pinterest.com/srishringarr/?eq=sri&etslf=5839" target="_blank" class="fs-18 color1 p-r-20 fa social_pinterest"></a>
					    
					    
    					
					</div>
					<br>
					    <label>Select your currency here</label>
					<select class="form-control" id="cur" style="width:80px">
                            <?
                            $cur_sql = mysqli_query($con,"select distinct(currency) as currency,country from conversion_rates where status=1 order by country ASC");
                            while($cur_sql_result = mysqli_fetch_assoc($cur_sql)){
                                $currency = $cur_sql_result['currency']; ?>
                                
                                <option value="<? echo $currency; ?>" <? if($_SESSION['cur'] == $currency){ echo 'selected'; }  ?> >
                                     <? echo $currency; ?>
                                </option>
                        
                            <? } ?>
                        </select>
				</div>
			</div>
			
				<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
					<h4 class="s-text12 p-b-30">
						Categories
					</h4>
					<ul>
						
							<li class="p-b-9">
								<a href="sub_category.php?type=1" class="s-text7">
									Jewellery
								</a>
							</li>
						
							<li class="p-b-9">
								<a href="sub_category.php?type=2" class="s-text7">
									Apparel
								</a>
							</li>
						</ul>
				    </div>
			<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					Quick Links
				</h4>
				<ul>
					<!-- <li class="p-b-9">
						<a href="/search/" class="s-text7">
							Search
						</a>
					</li> -->

					<li class="p-b-9">
						<a href="account/my-account.php" class="s-text7">
							Profile
						</a>
					</li>
	
					<li class="p-b-9">
						<a href="account/orders.php" class="s-text7">
							Orders 
						</a>
					</li>

					<!--<li class="p-b-9">-->
					<!--	<a href="wishlist.php" class="s-text7">-->
					<!--		Wishlist -->
					<!--	</a>-->
					<!--</li>-->
				</ul>
			</div>

			<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					Help
				</h4>
				<ul>
					<!-- <li class="p-b-9">
						<a href="/track-orders/" class="s-text7">
							Track Order
						</a>
					</li> -->
					
					 <li class="p-b-9">
						<a href="about_us.php" class="s-text7">
							About Us
						</a>
					</li> 

					<li class="p-b-9">
						<a href="policy.php" class="s-text7">
							Shipping, Returns, Cancellation and Refunds Policy
						</a>
					</li>

					<!--<li class="p-b-9">-->
					<!--	<a href="Shipping,Cancellation&amp;Returns.php" class="s-text7">-->
					<!--		Cancellation-->
					<!--	</a>-->
					<!--</li>-->

					<!--<li class="p-b-9">-->
					<!--	<a href="Shipping,Cancellation&amp;Returns.php" class="s-text7">-->
					<!--		Returns-->
					<!--	</a>-->
					<!--</li>-->
					
					<li class="p-b-8">
						<a href="faq.php" class="s-text7">
							FAQ
						</a>
					</li>
					<!-- <li class="p-b-9">
						<a href="#" class="s-text7">
							Blog
						</a>
					</li> -->
				</ul>
			</div>

			<div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
				<!---------------------------- Rahul 30-07-2019 --------------------------------->
					<iframe title="Sri Shringarr" width="100%" height="250px"  loading="lazy" src="https://www.youtube.com/embed/KGZVaCSe_mw?controls=0"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				<h7>Take a virtual tour of Sri Shringarr Fashion Studio</h7>
			</div>

			<!-- <div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
				<h4 class="s-text12 p-b-30">
					Notify Me
				</h4>

				<form>
					<div class="effect1 w-size9">
						<input class="s-text7 bg6 w-full p-b-5" type="text" name="email" placeholder="email@example.com">
						<span class="effect1-line"></span>
					</div>

					<div class="w-size2 p-t-20">
						<button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4 pointer" style="background-color: #e6be6e;color: #444;">
							Notify
						</button>
					</div>

				</form>
			</div> -->
		</div>

		<div class="t-center p-l-15 p-r-15">
			
			<div class="t-center s-text8 p-t-20">
        
        	 <a style="text-decoration: none;" href="terms_conditions.php">TERMS OF USE</a> &nbsp;
    	
        	 | &nbsp;<a style="text-decoration: none;" href="policy.php"> PRIVACY POLICY  </a>&nbsp; 
    	
        	 <!--| &nbsp;<a style="text-decoration: none;" href="about-us.php">ABOUT US </a>&nbsp; -->
    	
        	 | <a style="text-decoration: none;" href="contact_us.php">&nbsp;ENQUIRY</a>&nbsp; 
    	
        	 
	        
				<div style="text-align: center;font-size:15px;margin:10px 0px;">
		         	<a style="text-decoration: none;">
					Copyright © 2018 Sri Shringarr All Rights Reserved  </a><br/><br/>
		        </div>
			</div>
		</div>
	</footer>
	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div> 
	<!-- Container Selection1 -->
	<div id="dropDownSelect1"></div>
	
	<!--<script type="text/javascript" src="static/css/vendor/jquery/jquery-3.2.1.min.js"></script>-->

	<script type="text/javascript" src="static/css/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->

	<script type="text/javascript" src="static/css/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="static/css/vendor/select2/select2.min.js"></script>
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>

	<script type="text/javascript" src="static/css/vendor/slick/slick.min.js"></script>
	
	<script type="text/javascript" src="static/js/slick-custom.js"></script>

	<script type="text/javascript" src="static/css/vendor/countdowntime/countdowntime.js"></script>

	<script type="text/javascript" src="static/css/vendor/lightbox2/js/lightbox.min.js"></script>

	<script type="text/javascript" src="static/css/vendor/sweetalert/sweetalert.min.js"></script>

	<script src="static/js/main.js"></script>
	
	<script src='static/js/validation.js'></script>
	
	<script src='static/js/site.js'></script>
	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script>

$(document).ready(function(){


	$(".title").fadeIn(1000);
	// $("#fade").hide();
	
// 	$(function(){
//     if (window.matchMedia("(min-width:1366px)").matches) {
//         $('#mobileviewperfect').remove();
//     }
// });
// $(document).ready(function(){
// 	console.clear();
// });
// $(window).resize(function(){

//        if ($(window).width() <= 424) {  
//        		$('#mobileviewperfect').show();

//        }
//        else{
//        		$('#mobileviewperfect').hide();
//        }     

});

</script>

</body>
</html>
<?php 
// include('header_test.php');
include('header_p.php');
$directory = 'static/images/site/banner/';
$opendir = opendir($directory);



$mob_directory = 'asset/mob_ban/';
$mob_opendir = opendir($mob_directory);

?>
<title>Best Rental Wedding Outfits and Jewelry for Women|Sri Shringarr</title>
<!--<title>Women's Wedding Outfits and Jewelry Rentals|Sri Shringarr</title>-->
  <!--<meta name="description" content="Don’t Repeat It, Rent It. Best e-commerce website for getting an Exclusive range of Designer Lehenga choli, Jewelry, Evening Gowns, and Indo-Western on hire.">-->
  <meta name="description" content="Don’t Repeat It,Rent It.Exclusive Designer Lehenga Choli,Jewellery,Bridal Lehengas,Evening Gowns,Indo-Western on Hire.Click now for an ultimate renting experience.">
  <meta name="keywords" content="Rent Wedding Wear, Bridal Lehengas on Rent, Hire Traditional Jewellery, Hire Wedding Clothes, Wedding Clothes on hire, Indian Bridal Wear, Indian Bridal Jewelry on Hire, Hand Embroidered Lehengas on Rent, Rental Clothes, Lehenga on Rent, Jewellery on Rent, Evening Gowns on Hire, Made In India">

	<!--<div id="mobileviewperfect" style=""> </div>	-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/jquery.flexslider.js" integrity="sha512-/LtMywMLXZ29TJbETec4e6ndSWPxQDTdsqCud+8Q4IFnKQ1WVlr87r0D5oo9QNO9zuqQNJDmvQxQmvqe8DRYLA==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/flexslider.css" integrity="sha512-HWY8i77pPLL23sU4pHj+5iuZEmmmu2YaiTUcWrBXqBRTpn6yUdDvlFGNmG0qyjDg/vpt+YWNMASjg9M0eOU9DA==" crossorigin="anonymous" />


<div class="flexslider" id="mobile_ban">
  <ul class="slides">
      
      
    <?php
    $mob_ban = mysqli_query($con,"select * from bannerimg where bannerfor=2 and status=1");
    $mobbanpath = 'yn/Admin/shringarr/banner/mobile/';
    while($mob_ban_result = mysqli_fetch_assoc($mob_ban)){
        
        $mobbanimage = $mob_ban_result['img'];
         ?>
            			<li style="position:relative; ">
    			    <img class="lazyload" data-src="<?php echo $mobbanpath.$mobbanimage;?>" style="height:100%;object-fit:contain; " alt="Sri Shringarr">
                        <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15" style="position:absolute;top:10%;">
        				    <!--<div class="xl-text1 title" ><b>NEW ARRIVALS</b></div>-->
        					<!--<a href="contact_us.php">-->
        				 <!--       <input type="button" class="flex-c-m bg1 bo-rad-23 hov1 s-text1 trans-0-4"  value="Shop now" id="fade" style=" width:120px;height:30px;" />-->
        			  <!--      </a>-->
    				    </div>
    			</li>

<?
        
    }
    ?>
    
  </ul>
</div>




<div class="flexslider" id="web_ban">
  <ul class="slides">
      
      
    <?php
    $web_ban = mysqli_query($con,"select * from bannerimg where bannerfor=1 and status=1");
    $webbanpath = 'yn/Admin/shringarr/banner/web/';
    while($web_ban_result = mysqli_fetch_assoc($web_ban)){
        
        $webbanimage = $web_ban_result['img'];
         ?>
            			<li style="position:relative; ">
    			    <img class="lazyload" data-src="<?php echo $webbanpath.$webbanimage;?>" style="height:100%;object-fit:contain; " alt="Sri Shringarr">
                        <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15" style="position:absolute;top:10%;">
        				    <!--<div class="xl-text1 title" ><b>NEW ARRIVALS</b></div>-->
        					<!--<a href="contact_us.php">-->
        				 <!--       <input type="button" class="flex-c-m bg1 bo-rad-23 hov1 s-text1 trans-0-4"  value="Shop now" id="fade" style=" width:120px;height:30px;" />-->
        			  <!--      </a>-->
    				    </div>
    			</li>

<?
        
    }
    ?>
    
  </ul>
</div>




<script>
    // Can also be used with $(document).ready()
$(document).ready(function() {
    $('.flexslider').flexslider({
        animation: "slide"
});
});
</script>
    <!--End Of Main Slider -->
    <!-- dUMMY dATA -->

    <style>
        .col-xs-6 {
    width: 50%;
    padding-left: 0px;
    padding-right: 0px;
}

.hov-img-zoom{
    position:relative;
}

.hov-img-zoom span{ 
    position: absolute;
    bottom: 5%;
    right: 10%;
    color: white;
    font-size: 30px;
    z-index: 100000;
    font-weight: 900;    
}
 
    </style>
    <section class="blog bgwhite">
        <div>
			<div class="sec-title p-b-52">
				<h3 class="m-text5 t-center">
					Collections
				</h3>
			</div>
			<div class="">
<ul class="row">
    

<li class="col-xs-6 col-md-4 col-lg-3" style="padding-left:0px;padding-right:0px;">
    <div class="hovereffect">
        <a href="list.php?id=66&type=1">
        <span>Bangles</span>
        
            <img class="lazyload img-responsive" data-src="asset/com_Bangles.jpg" alt="">
        
            <div class="overlay"></div>
            </a>
    </div>
</li>


<li class="col-xs-6 col-md-4 col-lg-3" style="padding-left:0px;padding-right:0px;">
    
    <div class="hovereffect">
    <a href="list.php?id=53&type=1">
        <span>Borla</span>
    
            <img class="lazyload img-responsive" data-src="asset/com_Borla.jpg" alt="">
            <div class="overlay"></div>
        </a>
    </div>
</li>

<li class="col-xs-6 col-md-4 col-lg-3" style="padding-left:0px;padding-right:0px;">
    <div class="hovereffect">
        <a href="sub_category.php?cid=17&type=1">
        <span>Earring</span>
        
            <img class="lazyload img-responsive" data-src="asset/com_ear.jpg" alt="">
        
            <div class="overlay"></div>
        </a>
    </div>
</li>

<li class="col-xs-6 col-md-4 col-lg-3" style="padding-left:0px;padding-right:0px;">
    <div class="hovereffect">
        <a href="list.php?id=69&type=1">
        <span>Hath Phool</span>

            <img class="lazyload img-responsive" data-src="asset/com_Hathphool.jpg" alt="">
        
            <div class="overlay"></div>
            </a>
    </div>
</li>


<li class="col-xs-6 col-md-4 col-lg-3" style="padding-left:0px;padding-right:0px;">
    <div class="hovereffect">
        <a href="list.php?id=10&type=2">
        <span>Lehenga Choli</span>
        
            <img class="lazyload img-responsive" data-src="asset/com_Lehenga_Choli.jpg" alt="">
        
            <div class="overlay"></div>
        </a>
    </div>
</li>



<li class="col-xs-6 col-md-4 col-lg-3" style="padding-left:0px;padding-right:0px;">
    <div class="hovereffect">
        <a href="list.php?id=3&type=1">
        <span>Kundan Set</span>
        
            <img class="lazyload img-responsive" data-src="asset/com_Necklace_Set_Kundan.jpg" alt="">
            <div class="overlay"></div>
        </a>
    </div>
</li>


<li class="col-xs-6 col-md-4 col-lg-3" style="padding-left:0px;padding-right:0px;">
    <div class="hovereffect">
        <a href="list.php?id=63&type=1">
        <span>Mang Tikkas</span>
    
            <img class="lazyload img-responsive" data-src="asset/com_Tikkas.jpg" alt="">
            <div class="overlay"></div>
        </a>
    </div>
</li>


<li class="col-xs-6 col-md-4 col-lg-3" style="padding-left:0px;padding-right:0px;">
    <div class="hovereffect">
        <a href="list.php?id=29&type=2">
        <span>Trail Gown</span>
        
            <img class="lazyload img-responsive" data-src="asset/com_Trail_Gown.jpg" alt="">
            <div class="overlay"></div>         
        </a>
    </div>
</li>

</ul>

			</div>
        </div>
    </section>
     <!-- Dummy Data -->

    <!-- End of Categories -->
    
    <!-- Start Product Section  -->
    	
    <!-- End of Product Section  -->
    
        
<?php
include('footer.php');
// include('footer_main.php');
?>

    	<!--<link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css"> -->
    
<style>

.hovereffect a span{
position: absolute;
    bottom: 5%;
    right: 10%;
    color: white;
    font-size: 30px;
    z-index: 100000;
    font-weight: 900;    
}
    .hovereffect {
  width: 100%;
  float: left;
  overflow: hidden;
  position: relative;
  text-align: center;
  cursor: default;
  background: #000000;
}
.hovereffect .overlay {
  width: 100%;
  height: 100%;
  position: absolute;
  overflow: hidden;
  top: 0;
  left: 0;
  padding: 50px 20px;
}
.hovereffect img {
  display: block;
  position: relative;
  width: 100%;
  transition: opacity 0.35s, transform 0.35s;
}
.hovereffect:hover img {
  opacity: 0.4;
  filter: alpha(opacity=40);
  -webkit-transform: translate3d(0,0,0);
  transform: translate3d(0,0,0);
}
.hovereffect h2 {
  text-transform: uppercase;
  color: #fff;
  text-align: center;
  position: relative;
  font-size: 17px;
  overflow: hidden;
  padding: 0.5em 0;
  background-color: transparent;
}
.hovereffect h2:after {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 2px;
  background: #fff;
  content: '';
  -webkit-transition: -webkit-transform 0.35s;
  transition: transform 0.35s;
  -webkit-transform: translate3d(-100%,0,0);
  transform: translate3d(-100%,0,0);
}

.hovereffect:hover h2:after {
  -webkit-transform: translate3d(0,0,0);
  transform: translate3d(0,0,0);
}

.hovereffect a, .hovereffect p {
  color: #FFF;
  opacity: 1;
  filter: alpha(opacity=0);
  -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
  transition: opacity 0.35s, transform 0.35s;
  -webkit-transform: translate3d(100%,0,0);
  transform: translate3d(100%,0,0);
}

.hovereffect:hover a, .hovereffect:hover p {
  opacity: 1;
  filter: alpha(opacity=100);
  -webkit-transform: translate3d(0,0,0);
  transform: translate3d(0,0,0);
}
</style>

<?
// $_SESSION['shownl']=0;
if($_SESSION['shownl']==1){
    
}else{ ?>
<div id="myModal" class="modal fade">
    <div class="modal-dialog mymodaldialough">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Subscribe And Get 15% Discount Coupon</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
				<div class="newsletter">
	                <div class="nl_content">
	            <form id="nl_form">
	                
	            
                    <div class="form-group">

                        <input type="text" class="form-control" id="name" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="mobilenum" placeholder="Mobile" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email"  placeholder="Email Address" required>
                    </div>
                    <button id="nlsubmit" type="submit" class="btn btn-primary">Subscribe</button>
                        <a href="#" id="nevershownl" data-dismiss="modal">Never Show Again</a>
                </form>
                </div>
                
                
				</div>
    
            </div>
        </div>
    </div>
</div>
    
<? } ?>

<script>

    $("#nl_form").submit(function(e){
        e.preventDefault();
        var name=$("#name").val();
        var mobile=$("#mobilenum").val();
        var email=$("#email").val();
        
        var error ='';
        if(!name){
            error += 'Name Cannot Be Empty';
        }
        if(!mobile){
            error += 'Mobile Cannot Be Empty';
        }
        if(!email){
            error += 'Email Cannot Be Empty';
        }
        if(!name || !mobile || !email){
            alert(error);    
        }else{
    $.ajax({

            type: "POST",
            url: 'process_nl.php',
            data: 'name='+name+'&mobile='+mobile+'&email='+email,
            success:function(msg) {
                if(msg==1){
                    $("#nl_form").html('Coupon Sent To Your Email');
                }else if(msg==0){
                    $("#nl_form").html('Some Error Occured');
                }else if(msg==2){
                    $("#nl_form").html('Email ID OR Mobile Already Exists');
                }
            }
    });
    

        }
            
    }); 
    
    
    $(document).ready(function(){
    
        $("form").attr( 'autocomplete', 'off' );
    
});
    
    

</script>
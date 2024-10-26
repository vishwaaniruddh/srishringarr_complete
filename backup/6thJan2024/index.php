<?php 
// include('header_test.php');
include('header.php');
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
    $mob_ban = mysqli_query($con,"select * from bannerimg where bannerfor=2 and status=1 order by id asc");
    $mobbanpath = 'yn/Admin/shringarr/banner/mobile/';
    while($mob_ban_result = mysqli_fetch_assoc($mob_ban)){
        
        $mobbanimage = $mob_ban_result['img'];
         ?>
            			<li style="position:relative; ">
    			    <img class="lazyload" data-src="<?php echo $mobbanpath.$mobbanimage;?>" style="height:100%;object-fit:contain; " alt="Sri Shringarr">
                        <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15" style="position:absolute;top:10%;">
    				    </div>
    			</li>

<?
        
    }
    ?>
    
  </ul>
</div>




<div class="flexslider" id="web_ban" style="border: 0;"> 
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
    <style>
        .col-xs-6 {
            width: 50%;
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
    
    
    
    <section class="features-section">
<div class="container-fluid">
<div class="row">
<div class="col-md-4 p-0 feature">
<div class="feature-inner">
<div class="feature-icon">
<img src="./asset/1.png.webp" alt="#">
</div>
<h2>Fast Secure Payments</h2>
</div>
</div>
<div class="col-md-4 p-0 feature">
<div class="feature-inner">
<div class="feature-icon">
<img src="./asset/2.png.webp" alt="#">
</div>
<h2>Premium Products</h2>
</div>
</div>
<div class="col-md-4 p-0 feature">
<div class="feature-inner">
<div class="feature-icon">
<img src="./asset/3.png.webp" alt="#">
</div>
<h2>Fast Delivery</h2>
</div>
</div>
</div>
</div>
</section>



<style>
     .section {
            background-color: #e7e7e7;
            padding: 5%;
            text-align: center;
        }

h2 {
    color: #f51167;
    font-weight: 900;
}

        .columns {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .cust_column {
                margin: 10px auto;
            flex: 1;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                max-height: 250px;
    height: 250px;
    display: flex;
    align-items: center; /* Center vertically */
    justify-content: center; /* Center horizontally */
        }
        .cust_column h5{
            padding:10px;
        }

        .column h3 {
            color: #555;
        }

        .column p {
            color: #777;
        }
</style>

  <div class="section">
        <h2>Be worry-free! We Don't compromise on quality.</h2>

        <div class="row">
            <div class="col-sm-4">
                <div class="insta_col cust_column">
                    <h5>We select only high-quality latest design ethnic clothing & jewelry for our rental stock.</h5>                    
                </div>
            </div>
            
            <div class="col-sm-4">
                <div class="insta_col cust_column">
                    <h5>We make sure that our rental inventory is very affordable. Quality with affordability is our motto.</h5>                    
                </div>
            </div>
            
            
            <div class="col-sm-4">
                <div class="insta_col cust_column">
                    <h5>After every rental return, the product goes through a thorough cleaning and sanitization process.</h5>                    
                </div>
            </div>
        </div>
    </div>





<section class="blog bgwhite">

				<h2 class="t-center">
					Collections
				</h2>
				<br />

			<div class="">
<ul class="row">
    

<li class="col-xs-6 col-md-4 col-lg-3" style="padding-left:0px;padding-right:0px;">
    <div class="hovereffect">
        <a href="./rent_bridal_bangles">
        <span>Bangles</span>
        
            <img class="lazyload img-responsive" data-src="asset/com_Bangles.jpg" alt="">
            <!--<img class="lazyload img-responsive" loading="lazy" data-src="//images.weserv.nl/?url=asset/com_Bangles.jpg&w=400&h=300" alt="">-->
            <div class="overlay"></div>
            </a>
    </div>
</li>


<li class="col-xs-6 col-md-4 col-lg-3" style="padding-left:0px;padding-right:0px;">
    
    <div class="hovereffect">
    <a href="./rent_rajasthani_style_borla">
        <span>Borla</span>
    
            <img class="lazyload img-responsive" data-src="asset/com_Borla.jpg" alt="">
            
            <div class="overlay"></div>
        </a>
    </div>
</li>

<li class="col-xs-6 col-md-4 col-lg-3" style="padding-left:0px;padding-right:0px;">
    <div class="hovereffect">
        <a href="./antique_earrings_on_rent">
        <span>Earring</span>
        
            <img class="lazyload img-responsive" data-src="asset/com_ear.jpg" alt="">
        
            <div class="overlay"></div>
        </a>
    </div>
</li>

<li class="col-xs-6 col-md-4 col-lg-3" style="padding-left:0px;padding-right:0px;">
    <div class="hovereffect">
        <a href="./bridal_hathphool_on_rent">
        <span>Hath Phool</span>

            <img class="lazyload img-responsive" data-src="asset/com_Hathphool.jpg" alt="">
        
            <div class="overlay"></div>
            </a>
    </div>
</li>


<li class="col-xs-6 col-md-4 col-lg-3" style="padding-left:0px;padding-right:0px;">
    <div class="hovereffect">
        <a href="./lehenga_choli_on_rent">
        <span>Lehenga Choli</span>
        
            <img class="lazyload img-responsive" data-src="asset/com_Lehenga_Choli.jpg" alt="">
        
            <div class="overlay"></div>
        </a>
    </div>
</li>



<li class="col-xs-6 col-md-4 col-lg-3" style="padding-left:0px;padding-right:0px;">
    <div class="hovereffect">
        <a href="./kundan_bridal_set_on_rent">
        <span>Kundan Set</span>
        
            <img class="lazyload img-responsive" data-src="asset/com_Necklace_Set_Kundan.jpg" alt="">
            <div class="overlay"></div>
        </a>
    </div>
</li>


<li class="col-xs-6 col-md-4 col-lg-3" style="padding-left:0px;padding-right:0px;">
    <div class="hovereffect">
        <a href="./rent_mangtikka">
        <span>Mang Tikkas</span>
    
            <img class="lazyload img-responsive" data-src="asset/com_Tikkas.jpg" alt="">
            <div class="overlay"></div>
        </a>
    </div>
</li>


<li class="col-xs-6 col-md-4 col-lg-3" style="padding-left:0px;padding-right:0px;">
    <div class="hovereffect">
        <a href="./trail_gown_on_rent">
        <span>Trail Gown</span>
        
            <img class="lazyload img-responsive" data-src="asset/com_Trail_Gown.jpg" alt="">
            
            <div class="overlay"></div>         
        </a>
    </div>
</li>

</ul>

			</div>

    </section>
    
<div class="container-fluid newletter_testimonial">
    <div class="row">
        <!-- Newsletter Column -->
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-envelope newsletter-icon"></i>
                    <h2 class="card-title">Subscribe to Our Newsletter</h2>
                    <p class="card-text">Stay updated with the latest news and updates.</p>
                    <form class="newsletter-form">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control bordered-input " placeholder="Enter your email" aria-label="Recipient's email" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" id="button-addon2">Subscribe</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Testimonials Column -->
<div class="col-sm-6">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Testimonials</h2>
            <div id="testimonialCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="testimonial">
                            <img src="https://lh3.googleusercontent.com/a-/ALV-UjUpOcTHpqUsUMBzOvd51B5Ty2aT7qK3KH1oAe8lKcHA5A=s40-c-rp-mo-br100" alt="Testimonial User">
                            <p class="mt-3">"One of the best place for pre wedding gowns, all types of lehenga, bridal, sider’s with amazing options. Must visit    Thank you so much for making my pre wedding a success 👍🏻"</p>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <p class="text-muted">- Sakshi Vig</p>
                        </div>
                    </div>
                    
                    <div class="carousel-item">
                        <div class="testimonial">
                            <img src="https://lh3.googleusercontent.com/a/ACg8ocJRjMvoDhN_K5Hj5JUio38nSQKtQL_yOade_1AWUlPk=s40-c-rp-mo-br100" alt="Testimonial User">
                            <p class="mt-3">"Amazing dress I got from here. All r so cooperative. Thank you so much for making my event so special by your designer gown."</p>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p class="text-muted">- Aruna Chordia</p>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="testimonial">
                            <img src="https://lh3.googleusercontent.com/a-/ALV-UjWUqh180GpLZULUpi8li4CLP4q2s60xxxojWFH5PY0xu_A=s40-c-rp-mo-br100" alt="Testimonial User">
                            <p class="mt-3">"Very good jewelry.got loads of compliments. Will recommend this place . Very good service."</p>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p class="text-muted">- Nirmala bhadreshwara</p>
                        </div>
                    </div>
                    
                    <div class="carousel-item">
                        <div class="testimonial">
                            <img src="https://lh3.googleusercontent.com/a-/ALV-UjWtUfdBSd3PIK4KfLAl1g1fzhTJhg6QDMT91oz3ewyuw2U=s40-c-rp-mo-ba3-br100" alt="Testimonial User">
                            <p class="mt-3">"
                            Best experience by sri sringarr boutique and my lehenga gave me princess vibes 💙 thanks yoshita for the best option  being a plus size i was very much concerned but u gave me so many options and the best outfit of all thank u so much 😊✌️
                            "</p>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p class="text-muted">- Siddhi gawade</p>
                        </div>
                    </div>
                    
                    

                    <!-- Add more testimonial items as needed -->
                </div>
                <a class="carousel-control-prev" href="#testimonialCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#testimonialCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                <ol class="carousel-indicators">
                    <li data-target="#testimonialCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#testimonialCarousel" data-slide-to="1"></li>
                    <li data-target="#testimonialCarousel" data-slide-to="2"></li>
                    
                    <li data-target="#testimonialCarousel" data-slide-to="3"></li>
                    <!-- Add more indicators as needed -->
                </ol>
            </div>
        </div>
    </div>
</div>

        
        
        
        
        
        
    </div>
</div>




 <style>
 input.bordered-input{
         border: 1px solid !important;

 }
 .newletter_testimonial .card{
     min-height: 300px;
 }
   .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .newsletter-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .newsletter-form {
            max-width: 400px;
            margin: 0 auto;
        }

        .testimonial-slider {
            max-width: 500px;
            margin: 0 auto;
        }

        .testimonial img {
            max-width: 100px;
            border-radius: 50%;
        }

        .carousel-inner {
            text-align: center;
        }

        .stars {
            color: gold;
        }
        .carousel-indicators {
            position: absolute;
            right: 0;
            bottom: -20px !important;
            left: 0;
            z-index: 15;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-pack: center;
            justify-content: center;
            padding-left: 0;
            margin-right: 15%;
            margin-left: 15%;
            list-style: none;
        }
.carousel-indicators li {
    box-sizing: content-box;
    -ms-flex: 0 1 auto;
    flex: 0 1 auto;
    width: 30px;
    height: 1px;
    margin-right: 3px;
    margin-left: 3px;
    text-indent: -999px;
    cursor: pointer;
    background-color: black !important;
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    opacity: .5;
    transition: opacity .6s ease;
}
      
      
        .newletter_testimonial {
            padding: 20px;
        }

        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .newsletter-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .newsletter-form {
            max-width: 400px;
            margin: 0 auto;
        }

        .testimonial-slider {
            overflow: hidden;
        }

        
        .testimonial img {
            max-width: 100px;
            border-radius: 50%;
        }

        .stars {
            color: gold;
        }
        
        
        
        
        
        
      
      
      
      
      
      
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0 auto;
            width: 80%;
        }
        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .tab {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 5px;
        }
        .tab.active {
            background-color: #ddd;
        }
        .photos-container,
        .videos-container {
            display: none;
        }
        .insta_img{
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
        .insta_col a { 
            padding:10px;
            
        }
        hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    /* border: 0; */
    border-top: 3px solid gray;
    width: 100%;
}

video {
    width: 100%;
     object-fit: cover;
    max-height: 400px;
}
.insta_col {
    
    margin:5px auto;
    max-height: 400px;
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
    height: 200px;
}
.gallary{
        display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 16px;
    padding: 16px;
}

.insta_col:hover {
    transform: scale(1.05);
}
    </style>
<section>
    
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   
   
   
 <div class="container-fluid">
        <h2 class="t-center">Instagram Photos & Videos</h2>
        <hr />
        <div class="tabs">
            <button class="tab active" data-type="all">All</button>
            <button class="tab" data-type="photos">Photos</button>
            <button class="tab" data-type="videos">Videos</button>
        </div>
        
        <div class="gallary all-container"></div>
        <div class="gallary photos-container"></div>
        <div class="gallary videos-container"></div>
    </div>

    <script>
        $(document).ready(function() {
            // Get data from PHP
            $.getJSON('instagram.php', function(data) {
                // Define containers
                const allContainer = $('.all-container');
                const photosContainer = $('.photos-container');
                const videosContainer = $('.videos-container');
                
                $.each(data.data, function(index, item) {
                    allContainer.append(`
                    <div  class=" insta_col">
                          <a href="${item.permalink}" target="_blank">
                                ${item.media_type === 'IMAGE' ? `<img class="insta_img" src="${item.media_url}" alt="${item.caption}">` : `
                                    <video  controls>
                                        <source src="${item.media_url}" type="video/mp4">
                                    </video>
                                `}
                            </a>

                        </div>
                    `);


                    if (item.media_type === 'IMAGE') {
                        photosContainer.append(`
                        <div  class="insta_col">
                            <a href="${item.permalink}" target="_blank">
                                <img class="insta_img" src="${item.media_url}" alt="${item.caption}">
                            </a>
                        </div>
                        `);
                    } else if (item.media_type === 'VIDEO') {
                        videosContainer.append(`
                        <div  class="insta_col">
                            <a href="${item.permalink}" target="_blank">
                                <video  controls>
                                    <source src="${item.media_url}" type="video/mp4">
                                </video>
                            </a>
                        </div>
                        `);
                    }
                });

                // Show 'All' content by default
                allContainer.show();

                // Tab click event
                $('.tab').click(function() {
                    $('.tab').removeClass('active');
                    $(this).addClass('active');
                    $('.all-container, .photos-container, .videos-container').hide();
                    const type = $(this).data('type');
                    $(`.${type}-container`).show();
                    $(`.${type}-container`).css('display', 'grid');
                });
                
            });

        });
    </script>
    
</section>


<?php include('footer.php'); ?>

<style>

.hovereffect :hover{
    transform: scale(1.05);
}

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
    #myModal.modal {
    display: flex !important;
    align-items: center;
    justify-content: center;
}

#myModal .modal-dialog.mymodaldialough {
    max-width: 500px;
}


    .popup-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
    }

    .popup-content {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      text-align: center;
    }

    .close-btn {
      cursor: pointer;
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 20px;
      color: #333;
    }
    input.bordered{
        border: 1px solid !important;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>


<script>
    $(document).ready(function () {
        $("#nl_form").submit(function (e) {
            e.preventDefault();
            var name = $("#name").val();
            var mobile = $("#mobilenum").val();
            var email = $("#email").val();
            var error = '';
            if (!name) {
                error += 'Name Cannot Be Empty';
            }
            if (!mobile) {
                error += 'Mobile Cannot Be Empty';
            }
            if (!email) {
                error += 'Email Cannot Be Empty';
            }
            if (!name || !mobile || !email) {
                alert(error);
            } else {
                $.ajax({
                    type: "POST",
                    url: 'process_nl.php',
                    data: 'name=' + name + '&mobile=' + mobile + '&email=' + email,
                    success: function (msg) {
                        if (msg == 1) {
                            $("#nl_form").html('<h2>Coupon Sent To Your Email</h2>');
                            localStorage.setItem('popupClosed', 'true');
                        } else if (msg == 0) {
                            $("#nl_form").html('<h2>Some Error Occurred</h2>');
                        } else if (msg == 2) {
                            $("#nl_form").html('<h2>Email ID OR Mobile Already Exists</h2>');
                                localStorage.setItem('popupClosed', 'true');

                        }
                    }
                });
            }

        });
        $("form").attr('autocomplete', 'off');
    });

    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("button-addon2").addEventListener("click", function () {});
    });
</script>

<div class="popup-overlay" id="popup">
  <div class="popup-content">
    <span class="close-btn" onclick="closePopup()">×</span>
    <h2>Welcome to Our Website!</h2>
    <p>We would love to hear from you. Please fill out the form below:</p>
                        <form id="nl_form">
Name :  <input type="text" class="form-control bordered " id="name" placeholder="Name" required>
Mobile: <input type="text" class="form-control bordered" id="mobilenum" placeholder="Mobile" required>
Email:  <input type="email" class="form-control bordered" id="email" placeholder="Email Address" required>

      <br>
      
                            <button id="nlsubmit" type="submit" class="btn btn-primary">Subscribe</button>
<hr />
    </form>
    <p>If you're not interested, you can <a href="#" onclick="closePopup()">click here</a> to close this popup.</p>
  </div>
</div>

<script>

  function showPopup() {
    document.getElementById('popup').style.display = 'flex';
  }
  
  function closePopup() {
    document.getElementById('popup').style.display = 'none';
    localStorage.setItem('popupClosed', 'true');
  }
  document.addEventListener('DOMContentLoaded', function() {
    var popupClosed = localStorage.getItem('popupClosed');
    if (!popupClosed) {
      showPopup();
    }
  });
</script>

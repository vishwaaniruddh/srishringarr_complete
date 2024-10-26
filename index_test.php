<?php include('./header_test.php');
$directory = 'static/images/site/banner/';
$opendir = opendir($directory);

$mob_directory = 'asset/mob_ban/';
$mob_opendir = opendir($mob_directory);

?>
<title>Best Rental Wedding Outfits and Jewelry for Women|Sri Shringarr</title>
<meta
  name="description"
  content="Don’t Repeat It,Rent It.Exclusive Designer Lehenga Choli,Jewellery,Bridal Lehengas,Evening Gowns,Indo-Western on Hire.Click now for an ultimate renting experience."
/>
<meta
  name="keywords"
  content="Rent Wedding Wear, Bridal Lehengas on Rent, Hire Traditional Jewellery, Hire Wedding Clothes, Wedding Clothes on hire, Indian Bridal Wear, Indian Bridal Jewelry on Hire, Hand Embroidered Lehengas on Rent, Rental Clothes, Lehenga on Rent, Jewellery on Rent, Evening Gowns on Hire, Made In India"
/>
<script
  src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/jquery.flexslider.js"
  integrity="sha512-/LtMywMLXZ29TJbETec4e6ndSWPxQDTdsqCud+8Q4IFnKQ1WVlr87r0D5oo9QNO9zuqQNJDmvQxQmvqe8DRYLA=="
  crossorigin="anonymous"
></script>
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/flexslider.css"
  integrity="sha512-HWY8i77pPLL23sU4pHj+5iuZEmmmu2YaiTUcWrBXqBRTpn6yUdDvlFGNmG0qyjDg/vpt+YWNMASjg9M0eOU9DA=="
  crossorigin="anonymous"
/>

<div class="flexslider" id="mobile_ban">
  <ul class="slides">
    <?php
    $mob_ban = mysqli_query($con, "select * from bannerimg where bannerfor=2 and status=1 order by id asc");
    $mobbanpath = 'yn/Admin/shringarr/banner/mobile/';
    while ($mob_ban_result = mysqli_fetch_assoc($mob_ban)) {

        $mobbanimage = $mob_ban_result['img'];
        ?>
    <li style="position: relative">
      <img
        src="<?php echo $mobbanpath . $mobbanimage; ?>"
        style="height: 100%; object-fit: contain"
        alt="Sri Shringarr"
      />
      <div
        class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15"
        style="position: absolute; top: 10%"
      ></div>
    </li>

    <?php
    }
    ?>
  </ul>
</div>
<div class="flexslider" id="web_ban" style="border: 0">
  <ul class="slides">
    <?php
    $web_ban = mysqli_query($con, "select * from bannerimg where bannerfor=1 and status=1");
    $webbanpath = 'yn/Admin/shringarr/banner/web/';
    while ($web_ban_result = mysqli_fetch_assoc($web_ban)) {

        $webbanimage = $web_ban_result['img'];
        ?>
    <li style="position: relative">
      <img
        src="<?php echo $webbanpath . $webbanimage; ?>"
        style="height: 100%; object-fit: contain"
        alt="Sri Shringarr"
      />
      <div
        class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15"
        style="position: absolute; top: 10%"
      ></div>
    </li>

    <?php

    }
    ?>
  </ul>
</div>
<script>
  $(document).ready(function () {
    $(".flexslider").flexslider({
      animation: "slide",
    });
  });
</script>
<style>
  .col-xs-6 {
    width: 50%;
  }

  .hov-img-zoom {
    position: relative;
  }

  .hov-img-zoom span {
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
            <img src="./asset/1.png.webp" alt="#" />
          </div>
          <h2>Fast Secure Payments</h2>
        </div>
      </div>
      <div class="col-md-4 p-0 feature">
        <div class="feature-inner">
          <div class="feature-icon">
            <img src="./asset/2.png.webp" alt="#" />
          </div>
          <h2>Premium Products</h2>
        </div>
      </div>
      <div class="col-md-4 p-0 feature">
        <div class="feature-inner">
          <div class="feature-icon">
            <img src="./asset/3.png.webp" alt="#" />
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
  .cust_column h5 {
    padding: 10px;
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
        <h5>
          We select only high-quality latest design ethnic clothing & jewelry
          for our rental stock.
        </h5>
      </div>
    </div>

    <div class="col-sm-4">
      <div class="insta_col cust_column">
        <h5>
          We make sure that our rental inventory is very affordable. Quality
          with affordability is our motto.
        </h5>
      </div>
    </div>

    <div class="col-sm-4">
      <div class="insta_col cust_column">
        <h5>
          After every rental return, the product goes through a thorough
          cleaning and sanitization process.
        </h5>
      </div>
    </div>
  </div>
</div>
<section class="blog bgwhite">
  <h2 class="t-center">Collections</h2>
  <br />
  <div class="">
    <ul class="row">
      <li
        class="col-xs-6 col-md-4 col-lg-3"
        style="padding-left: 0px; padding-right: 0px"
      >
        <div class="hovereffect">
          <a href="./rent_bridal_bangles">
            <span>Bangles</span>
            <img
              class="lazyload img-responsive"
              data-src="asset/com_Bangles.jpg"
              alt=""
            />
            <div class="overlay"></div>
          </a>
        </div>
      </li>

      <li
        class="col-xs-6 col-md-4 col-lg-3"
        style="padding-left: 0px; padding-right: 0px"
      >
        <div class="hovereffect">
          <a href="./rent_rajasthani_style_borla">
            <span>Borla</span>
            <img
              class="lazyload img-responsive"
              data-src="asset/com_Borla.jpg"
              alt=""
            />
            <div class="overlay"></div>
          </a>
        </div>
      </li>

      <li
        class="col-xs-6 col-md-4 col-lg-3"
        style="padding-left: 0px; padding-right: 0px"
      >
        <div class="hovereffect">
          <a href="./antique_earrings_on_rent">
            <span>Earring</span>
            <img
              class="lazyload img-responsive"
              data-src="asset/com_ear.jpg"
              alt=""
            />
            <div class="overlay"></div>
          </a>
        </div>
      </li>

      <li
        class="col-xs-6 col-md-4 col-lg-3"
        style="padding-left: 0px; padding-right: 0px"
      >
        <div class="hovereffect">
          <a href="./bridal_hathphool_on_rent">
            <span>Hath Phool</span>
            <img
              class="lazyload img-responsive"
              data-src="asset/com_Hathphool.jpg"
              alt=""
            />
            <div class="overlay"></div>
          </a>
        </div>
      </li>

      <li
        class="col-xs-6 col-md-4 col-lg-3"
        style="padding-left: 0px; padding-right: 0px"
      >
        <div class="hovereffect">
          <a href="./lehenga_choli_on_rent">
            <span>Lehenga Choli</span>
            <img
              class="lazyload img-responsive"
              data-src="asset/com_Lehenga_Choli.jpg"
              alt=""
            />
            <div class="overlay"></div>
          </a>
        </div>
      </li>

      <li
        class="col-xs-6 col-md-4 col-lg-3"
        style="padding-left: 0px; padding-right: 0px"
      >
        <div class="hovereffect">
          <a href="./kundan_bridal_set_on_rent">
            <span>Kundan Set</span>
            <img
              class="lazyload img-responsive"
              data-src="asset/com_Necklace_Set_Kundan.jpg"
              alt=""
            />
            <div class="overlay"></div>
          </a>
        </div>
      </li>

      <li
        class="col-xs-6 col-md-4 col-lg-3"
        style="padding-left: 0px; padding-right: 0px"
      >
        <div class="hovereffect">
          <a href="./rent_mangtikka">
            <span>Mang Tikkas</span>
            <img
              class="lazyload img-responsive"
              data-src="asset/com_Tikkas.jpg"
              alt=""
            />
            <div class="overlay"></div>
          </a>
        </div>
      </li>

      <li
        class="col-xs-6 col-md-4 col-lg-3"
        style="padding-left: 0px; padding-right: 0px"
      >
        <div class="hovereffect">
          <a href="./trail_gown_on_rent">
            <span>Trail Gown</span>
            <img
              class="lazyload img-responsive"
              data-src="asset/com_Trail_Gown.jpg"
              alt=""
            />
            <div class="overlay"></div>
          </a>
        </div>
      </li>
    </ul>
  </div>
</section>

<section>
  <!--
<style>
.custom-img-class {
    max-width: 100%;
    height: auto;
}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 text-center">
            <h2 class="card-title">Rent Cycle</h2>
            <img class="lazyload custom-img-class" src="assets/RentCycle.jpg" alt="Testimonial User">
        </div>
    </div>
</div>
-->
  <style>
  /* if mobile image want to splitted 
  
    
.custom-img-class {
    max-width: 100%;
    height: auto;
}

.desktop-section {
    display: block;
}
.mobile-section {
    display: none;
}

@media (max-width: 768px) {
    .desktop-section {
        display: none;     }
    
    .mobile-section {
        display: none; 
    }
    
    
    .split-img {
        display: inline-block;
        max-width: 50%; 
        height: auto;
    }
}*/

/* General styling */
.custom-img-class {
    max-width: 100%;
    height: auto;
}

/* Desktop section (visible by default) */
.desktop-section {
    display: block;
}

/* Mobile section (hidden by default) */
.mobile-section {
    display: none;
}

/* Media query for screens 768px or smaller */
@media (max-width: 768px) {
    .desktop-section {
        display: none; /* Hide the desktop section on small screens */
    }
    
    .mobile-section {
        display: block; /* Show mobile section */
    }
    
    /* Mobile-specific image styling */
    .mobile-img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 0 auto;
    }
}



  </style>

<!-- if image want splitted 
 
<div class="desktop-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="card-title">Rent Cycle</h2>
                <img class="lazyload custom-img-class" src="assets/RentCycle.jpg" alt="Testimonial User">
            </div>
        </div>
    </div>
</div>


<div class="mobile-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="card-title">Rent Cycle</h2>
               
                <img class="lazyload split-img" src="assets/RentCycle_1.jpg" alt="Testimonial User Part 1">
                <img class="lazyload split-img" src="assets/RentCycle_2.jpg" alt="Testimonial User Part 2">
            </div>
        </div>
    </div>
</div>

-->


<div class="desktop-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="card-title">Rent Cycle</h2>
                <img class="lazyload custom-img-class" src="assets/RentCycle.jpg" alt="Rent Cycle Desktop">
            </div>
        </div>
    </div>
</div>


<div class="mobile-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="card-title">Rent Cycle</h2>
                <!-- A new image specifically for mobile view -->
                <img class="lazyload mobile-img" src="assets/Rent Cycle.svg" alt="Rent Cycle Mobile">
            </div>
        </div>
    </div>
</div>


</section>

<div class="container-fluid newletter_testimonial">
  <div class="row">
    <!-- Newsletter Column -->
    <!--<div class="col-sm-6">-->
    <!--    <div class="card">-->
    <!--        <div class="card-body text-center">-->
    <!--            <i class="fas fa-envelope newsletter-icon"></i>-->
    <!--            <h2 class="card-title">Subscribe to Our Newsletter</h2>-->
    <!--            <p class="card-text">Stay updated with the latest news and updates.</p>-->
    <!--            <form class="newsletter-form">-->
    <!--                <div class="input-group mb-3">-->
    <!--                    <input type="email" class="form-control bordered-input " placeholder="Enter your email" aria-label="Recipient's email" aria-describedby="button-addon2">-->
    <!--                    <div class="input-group-append">-->
    <!--                        <button class="btn btn-primary" type="button" id="button-addon2">Subscribe</button>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </form>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->

    <!-- Testimonials Column -->

    <div class="col-sm-12">
      <div class="card" style="background-color: #f9f9f9">
        <div class="card-body">
          <h2 class="card-title text-center">Testimonials</h2>
          <div
            id="testimonialCarousel"
            class="carousel slide"
            data-ride="carousel"
          >
            <div class="carousel-inner">
              <!-- First Testimonial -->
              <div class="carousel-item active">
                <div class="row d-flex justify-content-center">
                  <div class="col-md-10">
                    <div class="testimonial d-flex align-items-center">
                      <img
                        id="google-profile-img-1"
                        alt="Testimonial User"
                        class="testimonial-image"
                      />
                      <div class="testimonial-content ml-4">
                        <p class="contentfont">
                          "One of the best places for pre-wedding gowns. Must
                          visit. Thank you so much for making my pre-wedding a
                          success 👍🏻"
                        </p>
                        <div class="stars">
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p class="text-muted testimonial-name">- Sakshi Vig</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Second Testimonial -->
              <div class="carousel-item">
                <div class="row d-flex justify-content-center">
                  <div class="col-md-10">
                    <div class="testimonial d-flex align-items-center">
                      <img
                        id="google-profile-img-2"
                        alt="Testimonial User"
                        class="testimonial-image"
                      />
                      <div class="testimonial-content ml-4">
                        <p class="contentfont">
                          "Amazing dress. Thank you so much for making my event
                          so special with your designer gown."
                        </p>
                        <div class="stars">
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                        </div>
                        <p class="text-muted testimonial-name">
                          - Aruna Chordia
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Third Testimonial -->
              <div class="carousel-item">
                <div class="row d-flex justify-content-center">
                  <div class="col-md-10">
                    <div class="testimonial d-flex align-items-center">
                      <img
                        id="google-profile-img-3"
                        alt="Testimonial User"
                        class="testimonial-image"
                      />
                      <div class="testimonial-content ml-4">
                        <p class="contentfont">
                          "Very good jewelry. Got loads of compliments. Very
                          good service."
                        </p>
                        <div class="stars">
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                        </div>
                        <p class="text-muted testimonial-name">
                          - Nirmala Bhadreshwara
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Fourth Testimonial -->
              <div class="carousel-item">
                <div class="row d-flex justify-content-center">
                  <div class="col-md-10">
                    <div class="testimonial d-flex align-items-center">
                      <img
                        id="google-profile-img-4"
                        alt="Testimonial User"
                        class="testimonial-image"
                      />
                      <div class="testimonial-content ml-4">
                        <p class="contentfont">
                          "Best experience by Sri Sringarr boutique. My lehenga
                          gave me princess vibes 💙."
                        </p>
                        <div class="stars">
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                        </div>
                        <p class="text-muted testimonial-name">
                          - Siddhi Gawade
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Carousel Controls -->
            <a
              class="carousel-control-prev"
              href="#testimonialCarousel"
              role="button"
              data-slide="prev"
            >
              <span
                class="carousel-control-prev-icon"
                aria-hidden="true"
              ></span>
              <span class="sr-only">Previous</span>
            </a>
            <a
              class="carousel-control-next"
              href="#testimonialCarousel"
              role="button"
              data-slide="next"
            >
              <span
                class="carousel-control-next-icon"
                aria-hidden="true"
              ></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--

<style>
.testimonial {
    display: flex;
    align-items: center;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px; 
}

.testimonial-image {
    border-radius: 0; /* Ensure no rounded corners */
    box-shadow: none; /* Remove any shadow */
    opacity: 1; /* Full visibility */
    filter: none; /* Ensure no filters are applied */
    width: 100%; /* Set desired width */
    height: 100%; /* Set desired height */
    object-fit: cover; /* Maintain aspect ratio while filling the box */
}

.testimonial-content {
    flex-grow: 1; /* Allows content to expand */
    padding-left: 20px; /* Add space between image and content */
}

.stars {
    color: gold;
    font-size: 1.2em; /* Adjust star size */
}

/* Darker arrow icons without changing the background */
.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-image: none; /* Remove default Bootstrap arrow background */
}

.carousel-control-prev-icon:after,
.carousel-control-next-icon:after {
    color: #000; /* Darker arrow color */
    font-size: 30px; /* Size of the arrow */
    opacity: 0.9; /* Adjust darkness */
}

.carousel-control-prev-icon:after {
    content: '\f104'; /* FontAwesome left arrow */
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
}

.carousel-control-next-icon:after {
    content: '\f105'; /* FontAwesome right arrow */
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
}


</style>

-->

<script>
  const profileImageUrls = [
    "https://lh3.googleusercontent.com/a-/ALV-UjUpOcTHpqUsUMBzOvd51B5Ty2aT7qK3KH1oAe8lKcHA5A",
    "https://lh3.googleusercontent.com/a/ACg8ocJRjMvoDhN_K5Hj5JUio38nSQKtQL_yOade_1AWUlPk",
    "https://lh3.googleusercontent.com/a-/ALV-UjWUqh180GpLZULUpi8li4CLP4q2s60xxxojWFH5PY0xu_A",
    "https://lh3.googleusercontent.com/a-/ALV-UjWtUfdBSd3PIK4KfLAl1g1fzhTJhg6QDMT91oz3ewyuw2U",
  ];

  document.getElementById("google-profile-img-1").src = profileImageUrls[0];
  document.getElementById("google-profile-img-2").src = profileImageUrls[1];
  document.getElementById("google-profile-img-3").src = profileImageUrls[2];
  document.getElementById("google-profile-img-4").src = profileImageUrls[3];
</script>

<!--

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

.grid{
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 16px;
    padding: 16px;
}

@media (max-width: 767.98px){
    #loader img {
        position: absolute;
        top: 25%;
        -ms-transform: translateY(-50%);
        transform: translate(0%);
        height: 150px;
        left: -10%;

    }
}
    </style>
-->

<style>
  .testimonial {
    display: flex;
    align-items: center;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
  }

  .testimonial-image {
    width: 250px;
    height: 250px;
    object-fit: cover;
    border-radius: 5px; /* Slightly rounded corners */
    box-shadow: none;
    opacity: 1;
    filter: none;
  }

  .testimonial-content {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: center; /* Center content vertically */
    align-items: center; /* Center content horizontally */
    padding-left: 20px;
    text-align: center; /* Center the text */
    font-family: "Work Sans";
  }

  .stars {
    color: gold;
    font-size: 16px;
    margin-bottom: 10px; /* Add some space between the stars and the name */
  }

  .testimonial-name {
    font-size: 14px;
    margin-top: 10px;
    color: #555;
  }

  /* Darker arrow icons without changing the background */
  .carousel-control-prev-icon,
  .carousel-control-next-icon {
    background-image: none;
  }

  .carousel-control-prev-icon:after,
  .carousel-control-next-icon:after {
    color: #000;
    font-size: 30px;
    opacity: 0.9;
  }

  /* FontAwesome arrows for the carousel controls */
  .carousel-control-prev-icon:after {
    content: "\f104";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
  }

  .carousel-control-next-icon:after {
    content: "\f105";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
  }

  /* Carousel indicators styling */
  .carousel-indicators {
    bottom: -20px !important;
    margin-right: 15%;
    margin-left: 15%;
  }

  .carousel-indicators li {
    width: 30px;
    height: 1px;
    background-color: black !important;
    opacity: 0.5;
  }

  .grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 16px;
    padding: 16px;
  }

  .contentfont {
    font-family: "Work Sans";
    font-size: 18px;
  }

  /* Mobile adjustments */
  @media (max-width: 767.98px) {
    .testimonial {
      flex-direction: column;
      align-items: center;
    }

    .testimonial img {
      max-width: 175px;
      margin-bottom: 20px;
      margin-left: 10px; /* Move the image slightly to the right */
    }

    .testimonial-content {
      align-items: flex-start; /* Move the content to the left */
      text-align: left; /* Align text to the left */
      padding-left: 10px; /* Add some padding to move content slightly left */
    }

    .stars,
    .testimonial-name {
      margin-left: 15px; /* Move stars and name slightly to the left */
    }
  }
</style>

<section id="tabs">
  <div class="container-fluid" style="position: relative">
    <h2 class="t-center">Exclusive Collection</h2>
    <hr />
    <div class="tabs">
      <button class="tab active" data-type="all">All</button>
      <button class="tab" data-type="Apparel">Apparel</button>
      <button class="tab" data-type="Jewel">Jewellery</button>
    </div>

    <div class="grid"></div>
  </div>

  <script>
    $(document).ready(function () {
      var tabs = $(".tabs");
      var tabsOffsetTop = tabs.offset().top;

      $(".tab").click(function () {
        var type = $(this).data("type");
        $(".tab").removeClass("active");
        $(this).addClass("active");
        loadImages(type);
      });

      // Load all images by default
      loadImages("all");

      $(window).scroll(function () {
        var scrollTop = $(this).scrollTop();

        if (scrollTop >= tabsOffsetTop) {
          tabs.addClass("sticky");
        } else {
          tabs.removeClass("sticky");
        }
      });
    });

    function loadImages(type) {
      $.ajax({
        type: "POST",
        url: "getExclusiveRecords.php", // Replace with the actual PHP file
        data: { type: type },
        dataType: "json",
        success: function (data) {
          console.log(data);
          displayImages(data, type); // Pass 'type' to displayImages function
        },
        error: function (error) {
          console.error("Error fetching data:", error);
        },
      });
    }

    function displayImages(data, type) {
      var gallery = $(".grid");
      gallery.empty();

      var description = "";
      var headingText = ""; // New variable for the heading

      // Set description and heading based on type
      switch (type) {
        case "all":
          description = "Rent from our matchless inventory";
          headingText = "Explore"; // Generic heading for 'all'
          break;
        case "Apparel":
          description =
            "Unveil Your Style - Adorn yourself for the momentous events. Rent from our elegant collection.";
          headingText = "Explore"; // Custom heading for 'Apparel'
          break;
        case "Jewel":
          description =
            "Explore our exquisite collection of timeless elegance. Rent the matching jewellery for your dress.";
          headingText = "See What Glitters"; // Custom heading for 'Jewel'
          break;
        default:
          description = "Rent from our matchless inventory";
          headingText = "Explore"; // Default heading
      }

      // Appending the description to the gallery (currently commented out)
      // gallery.before('<p class="description">' + description + '</p>');

      if (Array.isArray(data)) {
        $.each(data, function (_, item) {
          var imageUrl = item.image_url;
          var sku = item.sku;
          var link = item.link;

          // Modify image URL as per requirement
          imageUrl = imageUrl.replace(
            "yosshitaneha.com",
            "srishringarr.com/yn"
          );

          // Create figure element
          var figureElement = $("<figure>").addClass("effect-sadie");
          var imageElement = $("<img>").attr("src", imageUrl).attr("alt", sku);
          var figcaptionElement = $("<figcaption>");

          // Use the dynamic heading text
          var headingElement = $("<h2>").text(headingText); // Dynamic heading based on type

          var paragraphElement = $("<p>").text(description);
          var anchorElement = $("<a>").attr("href", link).text("View more");

          // Append elements to the figure
          figcaptionElement.append(
            headingElement,
            paragraphElement,
            anchorElement
          );
          figureElement.append(imageElement, figcaptionElement);
          gallery.append(figureElement);
        });

        // Open link in a new tab/window on click
        $(document).on("click", ".grid a", function (e) {
          e.preventDefault();
          window.open($(this).attr("href"), "_blank");
        });
      } else {
        console.error("Invalid data format:", data);
      }
    }

    // function displayImages(data, type) {
    //     var gallery = $('.grid');
    //     gallery.empty();

    //     if (Array.isArray(data)) {
    //         $.each(data, function(_, item) {
    //             var imageUrl = item.image_url;
    //             var sku = item.sku;
    //             var link = item.link;

    //             // Create figure element
    //             var figureElement = $('<figure>').addClass('effect-sadie');

    //             var imageElement = $('<img>').attr('src', imageUrl).attr('alt', sku);
    //             var figcaptionElement = $('<figcaption>');

    //             var headingElement = $('<h2>').text('Explore');

    //             var paragraphElement = $('<p>').text('Elevate your style with our exquisite ' + type.toLowerCase());
    //             var anchorElement = $('<a>').attr('href', link).text('View more');
    //             figcaptionElement.append(headingElement, anchorElement);
    //             figureElement.append(imageElement, figcaptionElement);
    //             gallery.append(figureElement);
    //         });

    //         // Open link in a new tab/window on click
    //         $(document).on('click', '.grid a', function(e) {
    //             e.preventDefault();
    //             window.open($(this).attr('href'), '_blank');
    //         });
    //     } else {
    //         console.error('Invalid data format:', data);
    //     }
    // }
  </script>
</section>

<?php include('footer.php'); ?>

<style>
  .grid {
    position: relative;
    margin: 0 auto;
    padding: 1em 0 4em;
    list-style: none;
    text-align: center;
  }

  .grid figure {
    position: relative;
    float: left;
    overflow: hidden;
    margin: 10px 1%;
    min-width: 320px;
    max-width: 480px;
    max-height: 360px;
    width: 100%;
    background: #3085a3;
    text-align: center;
    cursor: pointer;
  }

  .grid figure img {
    position: relative;
    display: block;
    min-height: 100%;
    max-width: 100%;
    opacity: 0.8;
    object-fit: cover;
  }
  .grid figure figcaption,
  .grid figure figcaption > a {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }

  .grid figure figcaption {
    padding: 2em;
    color: #fff;
    text-transform: uppercase;
    font-size: 1.25em;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
  }
  figure.effect-sadie figcaption::before,
  figure.effect-sadie p {
    -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
    transition: opacity 0.35s, transform 0.35s;
  }
  figure.effect-sadie figcaption::before {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: -webkit-linear-gradient(
      top,
      rgba(72, 76, 97, 0) 0%,
      rgba(72, 76, 97, 0.8) 75%
    );
    background: linear-gradient(
      to bottom,
      rgba(72, 76, 97, 0) 0%,
      rgba(72, 76, 97, 0.8) 75%
    );
    content: "";
    opacity: 0;
    -webkit-transform: translate3d(0, 50%, 0);
    transform: translate3d(0, 50%, 0);
  }
  .grid figure figcaption::before,
  .grid figure figcaption::after {
    pointer-events: none;
  }

  figure.effect-sadie h2 {
    position: absolute;
    top: 50%;
    left: 0;
    width: 100%;
    color: #484c61;
    -webkit-transition: -webkit-transform 0.35s, color 0.35s;
    transition: transform 0.35s, color 0.35s;
    -webkit-transform: translate3d(0, -50%, 0);
    transform: translate3d(0, -50%, 0);
    opacity: 0;
  }

  .grid figure h2,
  .grid figure p {
    margin: 0;
  }
  .grid figure h2 {
    word-spacing: -0.15em;
    font-weight: 300;
  }
  .grid figure h2 span {
    font-weight: 800;
  }
  .grid figure p {
    letter-spacing: 1px;
    font-size: 68.5%;
  }
  figure.effect-sadie p {
    position: absolute;
    bottom: 0;
    left: 0;
    padding: 2em;
    width: 100%;
    opacity: 0;
    -webkit-transform: translate3d(0, 10px, 0);
    transform: translate3d(0, 10px, 0);
    color: white;
  }
  .grid figure figcaption > a {
    z-index: 1000;
    text-indent: 200%;
    white-space: nowrap;
    font-size: 0;
    opacity: 0;
  }

  figure.effect-sadie:hover figcaption::before,
  figure.effect-sadie:hover p {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }

  figure.effect-sadie:hover h2 {
    opacity: 1;
    color: #fff;
    -webkit-transform: translate3d(0, -50%, 0) translate3d(0, -40px, 0);
    transform: translate3d(0, -50%, 0) translate3d(0, -40px, 0);
  }

  .tabs {
    text-align: center;
    margin-bottom: 20px;
    background-color: #fff;
    padding: 10px;
    z-index: 1001;
    position: sticky;
    top: 0;
  }

  .tab {
    cursor: pointer;
    padding: 10px 15px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    margin-right: 10px;
  }

  .tab.active {
    background-color: #3498db;
    color: #fff;
  }

  /* Hover effect on scaling */
  .hovereffect:hover {
    transform: none; /* Disable scaling on hover */
  }

  /* Positioning the text span */
  .hovereffect a span {
    position: absolute;
    bottom: 5%;
    right: 10%;
    color: white;
    font-size: 30px;
    z-index: 100000;
    font-weight: 900;
  }

  /* General container styling */
  .hovereffect {
    width: 100%;
    float: left;
    overflow: hidden;
    position: relative;
    text-align: center;
    cursor: default;
    background: #000000;
  }

  /* Overlay styling */
  .hovereffect .overlay {
    width: 100%;
    height: 100%;
    position: absolute;
    overflow: hidden;
    top: 0;
    left: 0;
    padding: 50px 20px;
  }

  /* Image scaling and transition */
  .hovereffect img {
    display: block;
    position: relative;
    width: 100%;
    transition: opacity 0.35s, transform 0.35s;
  }

  /* Remove the scaling effect and opacity change on hover */
  .hovereffect:hover img {
    opacity: 0.4;
    transform: translate3d(0, 0, 0);
  }

  /* Header styling */
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

  /* Header underline animation */
  .hovereffect h2:after {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: #fff;
    content: "";
    transition: transform 0.35s;
    transform: translate3d(-100%, 0, 0);
  }

  /* On hover, show the underline */
  .hovereffect:hover h2:after {
    transform: translate3d(0, 0, 0);
  }

  /* Link and paragraph styling with fade and slide effect */
  .hovereffect a,
  .hovereffect p {
    color: #fff;
    opacity: 1;
    transition: opacity 0.35s, transform 0.35s;
    transform: translate3d(100%, 0, 0);
  }

  .hovereffect:hover a,
  .hovereffect:hover p {
    opacity: 1;
    transform: translate3d(0, 0, 0);
  }

  /* Mobile-friendly adjustments */
  @media (max-width: 768px) {
    .hovereffect:hover {
      transform: none; /* Disable any scaling on hover for mobile */
    }

    .hovereffect a span {
      font-size: 20px; /* Reduce text size for mobile */
      color: whitesmoke;
      bottom: 10%;
      right: 10%;
    }

    .hovereffect img {
      opacity: 1; /* Ensure full opacity on mobile */
    }

    .hovereffect:hover img {
      opacity: 0.4; /* Prevent hover from affecting image visibility */
    }

    .hovereffect h2 {
      font-size: 14px; /* Adjust header size for smaller screens */
    }

    .hovereffect h2:after {
      height: 1px; /* Thin out the underline for mobile */
    }
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
    z-index: 100000;
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
  input.bordered {
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
      var error = "";
      if (!name) {
        error += "Name Cannot Be Empty";
      }
      if (!mobile) {
        error += "Mobile Cannot Be Empty";
      }
      if (!email) {
        error += "Email Cannot Be Empty";
      }
      if (!name || !mobile || !email) {
        alert(error);
      } else {
        $.ajax({
          type: "POST",
          url: "process_nl.php",
          data: "name=" + name + "&mobile=" + mobile + "&email=" + email,
          success: function (msg) {
            if (msg == 1) {
              $("#nl_form").html("<h2>Coupon Sent To Your Email</h2>");
              localStorage.setItem("popupClosed", "true");
            } else if (msg == 0) {
              $("#nl_form").html("<h2>Some Error Occurred</h2>");
            } else if (msg == 2) {
              $("#nl_form").html("<h2>Email ID OR Mobile Already Exists</h2>");
              localStorage.setItem("popupClosed", "true");
            }
          },
        });
      }
    });
    $("form").attr("autocomplete", "off");
  });

  document.addEventListener("DOMContentLoaded", function () {
    document
      .getElementById("button-addon2")
      .addEventListener("click", function () {});
  });
</script>

<div class="popup-overlay" id="popup">
  <div class="popup-content">
    <span class="close-btn" onclick="closePopup()">×</span>
    <h2>Welcome to Our Website!</h2>
    <p>
      We would love to hear from you OR If you have specific requirement. please
      fill out the form below:
    </p>
    <form id="nl_form">
      Name :
      <input
        type="text"
        class="form-control bordered"
        id="name"
        placeholder="Name"
        required
      />
      Mobile:
      <input
        type="text"
        class="form-control bordered"
        id="mobilenum"
        placeholder="Mobile"
        required
      />
      Email:
      <input
        type="email"
        class="form-control bordered"
        id="email"
        placeholder="Email Address"
        required
      />
      <br />
      <button id="nlsubmit" type="submit" class="btn btn-primary">
        Subscribe
      </button>
      <hr />
    </form>
    <p>
      If you're not interested, you can
      <a href="#" onclick="closePopup()">click here</a> to close this popup.
    </p>
  </div>
</div>

<script>
  function showPopup() {
    // alert('Popup shown');
    document.getElementById("popup").style.display = "flex";
  }

  function closePopup() {
    alert("Popup closed");
    document.getElementById("popup").style.display = "none";
    localStorage.setItem("popupClosed", "true");
  }

  document.addEventListener("DOMContentLoaded", function () {
    var popupClosed = localStorage.getItem("popupClosed");
    if (!popupClosed) {
      // Show popup after 20 seconds
      setTimeout(function () {
        showPopup();
      }, 20000);

      // Show popup at 90% of page scroll
      window.addEventListener("scroll", function () {
        var scrollPercentage =
          (window.scrollY /
            (document.documentElement.scrollHeight - window.innerHeight)) *
          100;
        if (scrollPercentage >= 90) {
          //  alert('Reached 90%');
          showPopup();
        }
      });

      // Close intent
      window.addEventListener("beforeunload", function () {
        closePopup();
      });
    }
  });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.0/lazysizes.min.js" async></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    function isMobileDevice() {
        return (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('IEMobile') !== -1);
    }

    if (isMobileDevice()) {
        // Show the mobile section and hide the desktop section
        document.querySelector('.mobile-section').style.display = 'block';
        document.querySelector('.desktop-section').style.display = 'none';
    }
});
</script>


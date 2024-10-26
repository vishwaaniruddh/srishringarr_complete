<?php
session_start();

include('config.php');
include('functions.php');

if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}


if($_COOKIE['ss_userid'] > 0 ){
$userid =     $_COOKIE['ss_userid'] ; 
}else{
$userid = $_SESSION['gid'];
    
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--<meta name="keywords" content="htmlcss bootstrap menu, navbar, mega menu examples" />-->
<!--<meta name="description" content="Navigation  menu with submenu examples for any type of project, Bootstrap 4" />  -->
	<!--<title>Sri Shringarr</title>-->
    	<meta charset="UTF-8">
    	<!--<meta name="viewport" content="width=device-width, initial-scale=1"> -->
        
    	<link rel="icon" type="image/png" href="static/images/icons/favicon.png"/>
    	<!--<meta name="viewport" content="width=device-width, initial-scale=0.7"/>-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    	<link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css"> 
    	
    
    	<link rel="stylesheet" type="text/css" href="static/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    
    	<link rel="stylesheet" type="text/css" href="static/fonts/themify/themify-icons.css">
    
    	<link rel="stylesheet" type="text/css" href="static/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    	
    	
    	
    	
    	<link rel="stylesheet" type="text/css" href="static/css/style.css">
    
    	<link rel="stylesheet" type="text/css" href="static/css/vendor/animate/animate.css">
    
    	<link rel="stylesheet" type="text/css" href="static/css/vendor/css-hamburgers/hamburgers.min.css">
    
    	<!-- <link rel="stylesheet" type="text/css" href="/static/css/vendor/animsition/css/animsition.min.css"> -->
    
    	<link rel="stylesheet" type="text/css" href="static/css/vendor/select2/select2.min.css">
    
    	<link rel="stylesheet" type="text/css" href="static/css/vendor/daterangepicker/daterangepicker.css">
    
    	<link rel="stylesheet" type="text/css" href="static/css/vendor/slick/slick.css">
    
    	<link rel="stylesheet" type="text/css" href="static/css/vendor/lightbox2/css/lightbox.min.css">
        
    	<link rel="stylesheet" type="text/css" href="static/css/util.css">
    	<link rel="stylesheet" type="text/css" href="static/css/main.css">
    	<link rel="stylesheet" type="text/css" href="static/css/site.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
crossorigin="anonymous"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js" integrity="sha512-BmM0/BQlqh02wuK5Gz9yrbe7VyIVwOzD1o40yi1IsTjriX/NGF37NyXHfmFzIlMmoSIBXgqDiG1VNU6kB5dBbA==" crossorigin="anonymous"></script>


<!-- Bootstrap files (jQuery first, then Popper.js, then Bootstrap JS) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    	
        <!--<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>-->
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/latest/css/bootstrap.css">
        <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css">



<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-R8L1VTF3KQ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-R8L1VTF3KQ');
</script>





        <script src="requiredfunctions.js"></script>
<script type="text/javascript">
/// some script

// jquery ready start
$(document).ready(function() {
	// jQuery code

	//////////////////////// Prevent closing from click inside dropdown
    $(document).on('click', '.dropdown-menu', function (e) {
      e.stopPropagation();
    });

    // make it as accordion for smaller screens
    if ($(window).width() < 992) {
	  	$('.dropdown-menu a').click(function(e){
	  		e.preventDefault();
	        if($(this).next('.submenu').length){
	        	$(this).next('.submenu').toggle();
	        }
	        $('.dropdown').on('hide.bs.dropdown', function () {
			   $(this).find('.submenu').hide();
			})
	  	});
	}
	
	
	$(".dropdown-menu li a").on("click",function(){
    var href = $(this).attr('href');
    
    if(href != '#'){
        window.location = 'https://srishringarr.com/'+href;
    }
})



	
}); // jquery end
</script>

<style>

#nevershownl, #nlsubmit{
    font-size:12px;
}


h5.modal-title{
    font-size:15px;
}

#nl_form input{
    font-size:12px;
}
.form-control:focus {
    outline: none !important;
    box-shadow: 0 0 0 0 !important;
}


    .newsletter input {
    border-bottom: 1px solid #dcc7c7 !important;
}

.model-content{
    border: none;
    border-radius: unset;
}
    
    
    
    @media (min-width: 768px){

.mymodaldialough {
position: absolute !important;
    left: 30%;
    width: 100% !important;
    top: 10%;
}
        
    }

    @media (max-width: 767px){

.mymodaldialough {
    margin-top: 50%  !important;
    }
    
    .newsletter input {
    border-bottom: 1px solid #dcc7c7 !important;
    font-size:0.7rem !important;
}


/*.nl_content{*/
/*    width:50%  !important;*/
/*}*/

.nl_image{
    width:40%  !important;
}
.nl_image img{
    width:100%  !important;
}

.modal-content{
    font-size:10px  !important;
}

#nlsubmit{
    font-size: 0.7rem  !important;
}
    }


</style>




    <style>
/*        #loader {
    visibility: visible;
    height: 100vh;
    user-select: auto;
    display: flex;
    justify-content: center;
    width: 100%;
    position: relative;
    text-align: center;
    vertical-align: middle;
    background: #fcfcff;
        }
        #loader img{
    position: absolute;
    top: 50%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
height:150px;
        }
          
*/
    </style>
    
    
    


 <!--<div id="loader" class="center">-->
 <!--    <img src="assets/loader.gif">-->
     
 <!--</div>-->
 
    <script>
        // document.onreadystatechange = function() {

        //         // document.querySelector(
        //         //   "body").style.visibility = "hidden";
        //         // document.querySelector(
        //         //   "#loader").style.visibility = "visible";
                  
                  
        //     if (document.readyState !== "complete") {
        //         document.querySelector(
        //           "body").style.visibility = "hidden";
        //         document.querySelector(
        //           "#loader").style.visibility = "visible";
        //     } else {
        //         document.querySelector(
        //           "#loader").style.display = "none";
        //         document.querySelector(
        //           "body").style.visibility = "visible";
        //     }
        // };
    </script>
    
    
    

<script>

var ajax_call = function() {
    id = '1';
$.ajax({
            type: "POST",
            url: 'login_track.php',
            data: 'id='+id,
            success:function(msg) {}});    
}
setInterval(ajax_call, 1000);


</script>






<style type="text/css">

html, body {
  overflow-x: hidden;
}
body {
  position: relative
}
.cart_anchor{
    position:relative;
}
.topbar{
    z-index:100;
}
.header-icons-noti{
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background-color: #111111;
    color: white;
    font-family: Montserrat-Medium;
    font-size: 12px;
    position: absolute;
    top: -15px;
    right: -19px;
}




	@media (min-width: 992px){
		.dropdown-menu .dropdown-toggle:after{
			border-top: .3em solid transparent;
		    border-right: 0;
		    border-bottom: .3em solid transparent;
		    border-left: .3em solid;
		}

		.dropdown-menu .dropdown-menu{
			margin-left:0; margin-right: 0;
		}

		.dropdown-menu li{
			position: relative;
		}
		.nav-item .submenu{ 
			display: none;
			position: absolute;
			left:100%; top:-7px;
		}
		.nav-item .submenu-left{ 
			right:100%; left:auto;
		}

		.dropdown-menu > li:hover{ background-color: #f1f1f1 }
		.dropdown-menu > li:hover > .submenu{
			display: block;
		}
	}
</style>
    <style>
        .pointer {cursor: pointer;}
        .block2-overlay{
            top: auto !important;
            left: auto !important;
        }
        
        .add_to_cart_btn{
            display:none;
        }
        .product_div:hover .add_to_cart_btn{
            display: block ! important;
            color:white;
            text-align:center;
            padding: 7px;
            margin-bottom: 10px;
        }
    </style>
    
</head>
<body class="bg-light">
    
<!-- ========================= SECTION CONTENT ========================= -->

<style>
@media (min-width: 992px){
.navbar-expand-lg {
    -ms-flex-flow: row nowrap;
    flex-flow: row nowrap;
    -ms-flex-pack: start;
    justify-content: center;
}    

.navbar-nav{
        width: 100%;
    display: flex;
    justify-content: center;
}
}

    .custom_fluid{
        display: flex;
    justify-content: center;
    margin: auto;
    }
    
    @media (min-width: 768px){
        
        
        .flex-direction-nav a{
                height: 65px !important;
        }
        
        .search-box-btn{
	display: flex;
	border-radius: 50%;
	width: 3em;
	height: 3em;
	background: white;
	transition: .3s;
}


    .cust_logo{
        width:30%;
    }        
    nav.navbar{
        width:50%;
    }
    .header-icons{
            width: 20%;
        }
                    #web{
        position: sticky;
    top: 0;
    z-index: 100;
    }



        #mobile, #mobile_ban{
            display:none;
        }
        
        .search-box-btn img{
         position: absolute; top: 30%;left: 24%;   
        }
        
        
        
                #web{
background: white;
    padding-left: 2%;
    padding-right: 2%;
    display: flex;
        }
        .navbar-expand-lg{
                /*flex-flow: column;*/
        }
        .free_shipping_quotes{
        font-size: 20px;            
        }

    .banner_input{
        width: 120px;
    height: 30px;
}

.wrap-content-slide1 .xl-text3, .wrap-content-slide1 .xl-text2, .wrap-content-slide1 .xl-text1 {
    font-size: 40px;
}

.product_img{
    height:300px !important;
}
.product .text h3 a {
    color: #000;
    font-size:13px;
}
.subpart {
    font-size: 13px;
}

    }
    
        @media (max-width: 768px){
    
    
            .search-box-btn{
	display: flex;
	border-radius: 50%;
	width: 2em;
	height: 2em;
	background: white;
	transition: .3s;
}

    .search-box-btn img{
        
    position: absolute;
    top: 17%;
    left: 17%;
    
    }
    
    
    .m-text5{
        font-size:18px;
    }
    #mobile_ban .flex-viewport{
         height: 500px;
        min-height: 500px;   
    }
    
    .hov-img-zoom span{
    font-size: 18px !important;
    
}


    .sri_logo{
            width: 180px;
    }        
            .topbar-child2{
                display: flex;
                justify-content: flex-end;
            }
            .w-size9{
                display:none;
            }
            
            .breadcrumb a{
                font-size:10px;
            }
            .breadcrumb {
                padding: 0.25rem;
            }

.subpart {
    font-size: 9px;
}


.product .text h3 a{
       color: #000;
    font-size:10px;
}

.product_img{
    height:200px !important;
}
.img-fluid{
    min-height:200px !important;
}
body{
    overflow-x:hidden;
}
.flex-direction-nav a:before{
    font-size:20px !important;
}
.banner_input{
        width: 100px;
    height: 20px;
}

.flex-control-paging li a{
        width: 6px !important;
    height: 6px !important;
}

.wrap-content-slide1 .xl-text3, .wrap-content-slide1 .xl-text2, .wrap-content-slide1 .xl-text1 {
    font-size: 16px;
}

.flex-viewport{
    max-height:200px !important;
}
#web,#web_ban{
            display:none;
        }

        #mobile{
    display: flex;
    justify-content: space-between;
        background: white;
        }
        .nav-item{
            padding-left: 1%;
        }
        .nav-link{
            color: black;
        }
        .navbar-toggler{
background-color: white;
    border: 1px solid;
        }
        .topbar-social{
    padding-left: 15px;
    width: 80%;
        }
        .p-r-20{
                padding-right: 10px;
        }
        .topbar-child2{
            padding-right: 0;
    width: 20%;
        }
        .free_shipping_quotes{
            font-size:8px;
        }
        .collapse.show {
    display: block;
    width: 100%;
    padding: 1%;
    background: white;
    border: 1px solid #f8f9fa;
}
    }
    
    .navbar-expand-lg .navbar-nav .nav-link{
        color:black;
    }
    
    .wrap-slick1{
        z-index:-1;
    }

.dropdown-item{
        padding: 0.05rem 1.5rem;
}
</style>

<style>
.list-1 {
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-flex-wrap: wrap;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}
.list-1 li:first-child, .list-1 li:last-child {
    width: 50%;
}
.list-1 li {
    overflow: hidden;
    position: relative;
    width: 25%;
}
.list-1 img {
    width: 100%;
}
.list-1 li:first-child, .list-1 li:last-child {
    width: 50%;
}

@media (max-width: 767px)
{
.list-1 li {
    width: 100%;
}
.list-1 li:first-child, .list-1 li:last-child {
   width: 100%;
}

.item-slick1{
	height: 100px !important;
}

.slick-initialized .slick-slide{
	margin-top: 0 !important;
}

.slick1 .slick-slide .slick-initialized .slick-slider{
	margin-top: 0 !important;
}

.slick-list .draggable .slick-slide .slick-current .slick-active{
	margin-top: 0 !important;
}

.slick-slide{
	margin-top: 0 !important;
}

@media screen and (max-width:424px) {
    #mobileviewperfect {
        height:10%;
    }
}


</style>




<style>
    
.container_s{
    position: absolute;
    top: 50%;
    /* left: 50%; */
    transform: translate(-20%,-50%);
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    align-items: flex-end;
    width: 20%;
    right: 0;
}
h1{
	color: #fff;
	font-weight: 400;
}
input, button{
	border: none;
	background: none;
	outline: none;
}
button{
	cursor: pointer;
}
.search-box{
    display: flex;
    background: #08090A;
    border-radius: 2em;
}
.search-box-input{
	    width: 0px;
    font-size: 14px;
    color: #fff;
    transition: .5s;
}

.search-box-icon{
margin: auto;
    color: black;
    font-size: 12px;
}
.search-box-input::placeholder{
	color: white;
	opacity: .7;
}
.search-box:hover .search-box-input{
	padding-left: 2em;
	padding-right: 1em;
	width: 340px;
}
.search-box-btn:active{
	transform: scale(.75);
}

</style>



<div class="topbar">
    <div class="topbar-social" style="width: 80%;">
					<a href="https://www.facebook.com/srishringarr/" target="_blank" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
					<a href="https://www.instagram.com/srishringarr/" target="_blank" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
					<!-- <a href="https://plus.google.com/u/1/113103807414319162517" target="_blank" class="fs-18 color1 p-r-20 fa social_googleplus"></a> -->
					<a href="https://twitter.com/SriShringarr" target="_blank" class="fs-18 color1 p-r-20 fa social_twitter"></a>
					<a href="https://in.pinterest.com/srishringarr/?eq=sri&amp;etslf=5839" target="_blank" class="fs-18 color1 p-r-20 fa social_pinterest"></a>
					<p style="font-weight: 700;color: #888888; width: 100%; text-align: center;    margin: 0; "> <img src="assets/truck.png" style="height: 32px; "> <b class="free_shipping_quotes">Free Shipping To And Fro <span style="font-size:12px;">(India)</span></b> </p>
				</div>
				
				
  <div class="container_s">

		<form action="searchResult.php" method="POST" class="search-box" id="search_form" >
			<input type="text" name="query" class="search-box-input" placeholder="What are you looking for ?" id="query">
			<button class="search-box-btn" id="search" style="position:relative;">
				<img src="assets/search.png">
			</button>
		</form>
  </div>
    


	        </div>
	        
	        
<div class="container-fluid custom_fluid" id="web" style="box-shadow: 0px 6px 14px -10px;">
    
    <div class="cust_logo">
        <a href="/">
            <img src="static/images/site/logo/main_logo.png" alt="Avatar">
                        <!--<span style="font-size: 10px; display: block; color: red;text-align: right;"> Don’t Repeat It. Rent It.</span>-->
        </a>
    </div>
    			
<nav class="navbar navbar-expand-lg">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="main_nav">

<ul class="navbar-nav">
    

	<li class="nav-item"><a href="index.php" class="nav-link" href="#"> Home </a></li>

	
	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href ="sub_category.php?type=2" data-toggle="dropdown">  Apparel  </a>
            <ul class="dropdown-menu">
						    <?php 
	        $qryjew=mysqli_query($con,"SELECT * FROM `garments` where `Main_id`=1 or `Main_id`=3");     
 	        while($rowjew=mysqli_fetch_array($qryjew)){  ?>
                  <li><a class="dropdown-item" href="list.php?id=<?php echo $rowjew[0];?>&type=2"><?php echo ucwords(strtolower($rowjew[2])); ?></a></li>
            <?php } ?>

            </ul>
            
    </li>
								

	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">  Jewellery  </a>
	    <ul class="dropdown-menu">
  <?php  $qryjew = mysqli_query($con,"SELECT * FROM `jewel_subcat` where mcat_id=1 or mcat_id=3");     
                                			
                                		    while($rowjew=mysqli_fetch_array($qryjew)) {  
                                				$qryjew1=mysqli_query($con,"select * from subcat1  where maincat_id='$rowjew[0]' and status=1 order by name");
                                				
                                				$cnt = mysqli_num_rows($qryjew1); 	
                            					$i = 1;
                            					while($rowjew1=mysqli_fetch_row($qryjew1)) { 
                            						 
                            						if($cnt >1){ 
                            						    if($i==1){ ?>
                            						    <li>
                            							    <a class="dropdown-item" href="#"><?php echo ucwords(strtolower($rowjew[2])); ?> &raquo </span></a>
                            							    <ul class="submenu dropdown-menu">
                            							<?php }  ?>
                            							
                                                            <li> <a class="dropdown-item" href="list.php?id=<?php echo $rowjew1[0];?>&type=1" ><?php echo ucwords(strtolower($rowjew1[2]))?></b></a></li>
                                                            
                                                        <?php if($i==$cnt){?>
                                                        
                                                            <li>

                                                                <a class="dropdown-item" href="list.php?id=0&viewall=<?php echo $rowjew1[0];?>&type=1" >View All</a></li>
                                                        <?php echo '</ul></li>';} ?>
                            						<?php } else  { ?>
                                						
                                						<?php if($i==1){ ?>
                                						    <li><a class="dropdown-item" href="list.php?id=<?php echo $rowjew1[0];?>&type=1" ><?php echo ucwords(strtolower($rowjew[2]))?></b></a></li>
                                						<?php } ?>
                            						
                            						<?php } ?>

                            						<?php  
                            						$i++;
                            					}  ?>
                                			<?php } ?>
	    </ul>
	</li>
	
	<li class="nav-item"><a href="client_diary.php" class="nav-link" >Client Diary</a> </li>
	<li class="nav-item"><a href="contact_us.php" class="nav-link" >Contact Us</a> </li>
	
	
</ul>


  </div> <!-- navbar-collapse.// -->

</nav>

<style>
    .cart_account img{
        height:30px;
        width:30px;
    }
    .cart_account div{
        margin:auto 0;
        /*width: 25%;*/
    }
</style>
                      
<div class="cart_account" style="display:flex;justify-content: space-around;width:20%;"> 

        <div class="">  
         
                <a class="dropbtn" href="account/my-account.php">

                    <? if($_COOKIE['ss_userid']){
                          echo "<span>Hello " .  $_COOKIE['ss_fname'] ."</span>" ;   }
                    else{ 
                        echo  "<span>Login / Signup"  ."</span>" ;     
                    } ?> 
                    
                </a>
            </div>
    
    <div class="" id="cartshowid"></div>
    
<? if($_COOKIE['ss_userid']){ ?>
       <div>
           <a href="logout.php" style="color:black;">Logout</a>
       </div> 
<? }?>

</div>


</div><!-- container //  -->





<div id="mobile">
    <div class="">
        <a href="/">
            <img class="sri_logo" src="static/images/site/logo/main_logo.png" alt="Avatar">
            <!--<span style="font-size: 8px; display: block; color: red;text-align: right;"> Don’t Repeat It. Rent It.</span>-->
        </a>
    </div>    
    
        <div class="" style="margin:auto;">  
         
                <a class="dropbtn" href="account/my-account.php" style="font-size:10px;">

                    <? if($_COOKIE['ss_userid']){
                          echo "<span>Hello " .  $_COOKIE['ss_fname'] ."</span>" ;   }
                    else{ 
                        echo  "<span>Login / Signup"  ."</span>" ;     
                    } ?> 
                    
                </a>
            </div>
            
            
            
    <nav class="navbar navbar-expand-lg" >




  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" style="    margin: auto;">
    <!--<span class="navbar-toggler-icon"></span>-->
    <img src="assets/menu.png" style="height: 10px; width: 10px;">
  </button>
</nav>
</div>





  <div class="collapse navbar-collapse" id="main_nav">

<ul class="navbar-nav">
    

	<li class="nav-item"><a href="index.php" class="nav-link" href="#"> Home </a></li>
	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href ="sub_category.php?type=2" data-toggle="dropdown">  Apparel  </a>
            <ul class="dropdown-menu">
						    <?php 
	        $qryjew=mysqli_query($con,"SELECT * FROM `garments` where `Main_id`=1 or `Main_id`=3");     
 	        while($rowjew=mysqli_fetch_array($qryjew)){  ?>
                  <li><a class="dropdown-item" href="list.php?id=<?php echo $rowjew[0];?>&type=2"><?php echo ucfirst(strtolower($rowjew[2])); ?></a></li>
            <?php } ?>

            </ul>
            
    </li>
								

	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">  Jewellery  </a>
	    <ul class="dropdown-menu">
  <?php  $qryjew = mysqli_query($con,"SELECT * FROM `jewel_subcat` where mcat_id=1 or mcat_id=3");     
                                			
                                		    while($rowjew=mysqli_fetch_array($qryjew)) {  
                                				$qryjew1=mysqli_query($con,"select * from subcat1  where maincat_id='$rowjew[0]' and status=1 order by name");
                                				
                                				$cnt = mysqli_num_rows($qryjew1); 	
                            					$i = 1;
                            					while($rowjew1=mysqli_fetch_row($qryjew1)) { 
                            						 
                            						if($cnt >1){ 
                            						    if($i==1){ ?>
                            						    <li>
                            							    <a class="dropdown-item" href="#"><?php echo ucwords(strtolower($rowjew[2])); ?> &raquo </span></a>
                            							    <ul class="submenu dropdown-menu">
                            							<?php }  ?>
                                                            <li> <a class="dropdown-item" href="list.php?id=<?php echo $rowjew1[0];?>&type=1" ><?php echo ucwords(strtolower($rowjew1[2]))?></b></a></li>
                                                            
                                                        <?php if($i==$cnt){?>
                                                        
                                                            <li>

                                                                <a class="dropdown-item" href="list.php?id=0&viewall=<?php echo $rowjew1[0];?>&type=1" >View All</a></li>
                                                        <?php echo '</ul>';} ?>
                            						<?php } else  { ?>
                                						
                                						<?php if($i==1){ ?>
                                						    <li><a class="dropdown-item" href="list.php?id=<?php echo $rowjew1[0];?>&type=1" ><?php echo ucfirst(strtolower($rowjew[2]))?></b></a></li>
                                						<?php } ?>
                            						
                            						<?php } ?>

                            						<?php  
                            						$i++;
                            					}  ?>
                                			<?php } ?>
	    </ul>
	</li>
		<li class="nav-item"><a href="client_diary.php" class="nav-link" >Client Diary</a> </li>
		<li class="nav-item"><a href="contact_us.php" class="nav-link" >Contact Us</a> </li>
	
</ul>


  </div> <!-- navbar-collapse.// -->
  
  
  <script>
  
  $('#search_form').on('submit', function (e) {
      var query = $("#query").val();
      if(query){
          $("#form").submit();    
      }else{
          e.preventDefault();
      }
  });
  
  
  $(document).ready(function(){
  $("#nevershownl").on('click',function(){

  $.ajax({

            type: "POST",
            url: 'nes_session.php',
            data: '',
            success:function(msg) {}
    });
  
  });      
  });
  


  
  </script>

<?
// var_dump($_SESSION);
?>

<script>
	$(document).ready(function(){
		$("#myModal").modal('show');
	});
</script>

<style>


@media (min-width: 576px){
.modal-dialog.mymodaldialough {
max-width: 500px !important;
    margin: 10% auto !important;
}        
}

/*.newsletter{*/
/*    display:flex;*/
/*    justify-content:space-between;*/
/*}*/
.newsletter input{
        border-bottom:1px solid #dcc7c7 !important;
c
}
</style>




<br>
<br>
<br>
<?

    $cur_sql = mysqli_query($con,"select * from conversion_rates where status=1");
    $cur_sql_result = mysqli_fetch_assoc($cur_sql); 
    var_dump($cur_sql_result);
    

?>
    <select class="vela-currency jsvela-currency" id="cur">
        
        <?
        $cur_sql = mysqli_query($con,"select distinct(currency) as currency,country from conversion_rates where status=1 order by country ASC");
        while($cur_sql_result = mysqli_fetch_assoc($cur_sql)){
            $currency = $cur_sql_result['currency']; ?>
            
            <option value="<? echo $currency; ?>" <? if($_SESSION['cur'] == $currency){ echo 'selected'; }  ?> >
                 <? echo $cur_sql_result['country']; ?>
            </option>
    
        <? } ?>
    </select>
    






<script>
    $("#cur").on('change',function(){
        var cur = $("#cur").val();
        

        $.ajax({

            type: "POST",
            url: 'set_cur.php',
            data: 'cur='+cur,
            success:function(msg) {
                
                window.location.reload();
                
            }
        });

    })
</script>





<?
// echo currencyAmount('USD',1200);


// var_dump($_SESSION);
?>
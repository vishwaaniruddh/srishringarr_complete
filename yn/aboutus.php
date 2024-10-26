<?php
session_start();
include('config.php');

?>

<!DOCTYPE html>
<html>
<head>
<title>Yosshita Neha</title>
<link rel="" href="old/logo/Untitled-2 copy.jpg"/><link rel="icon" href="old/logo/Untitled-2 copy.jpg" type="image/x-icon" />
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!-- jQuery (necessary for Bootstrap s JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<!-- Custom Theme files -->
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Wedding Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- start menu -->
<script src="js/simpleCart.min.js"> </script>
<!-- start menu -->
<link href="css/memenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/memenu.js"></script>
<script>$(document).ready(function(){$(".memenu").memenu();});</script>
<!-- /start menu -->
</head>
<body>
<form id="formf" method="post">
<?php include("old/requiredfields.php");?><!--header-->
<div class="top_bg">
	<div class="container">
		<div class="header_top-sec">
			<?php include('old/topbar.php')?>
	    </div>
    </div>
    <div class="header-top">
	    <div class="header-bottom">
		    <div class="container" style="margin-top:-20px;">
			 <!---->
			  <?php include('old/menu.php')?>
			 <!---->
			 <div class="clearfix"> </div>
			 <!---->
			 </div>
			<div class="clearfix"> </div>
	  </div>
    </div>
    <!--- <div class="banner"></div> <!---->
    <div class="welcome">
	    <div class="container">
	        <!--<ol class="breadcrumb">
		        <li><a href="index.php">Home</a></li>
		        <li class="active">About Us</li>
		    </ol>--->
		    <div class="col-md-12 col-sm-12 col-xs-12 welcome-left">
			    <center> <h2>Welcome to  Yosshita Neha </h2></center>
			    <br>
		    </div>
		    <div class="col-md-12 col-sm-12 col-xs-12 welcome-right">

			    <h3>Our label is a seamless confluence of inspiration, ethnicity and femininity. Each ensemble is designed to come alive on the wearer and compliment her feminine core.</h3>
        		<p>Our collection plays around with different elements, to give rise to beautifully detailed and exquisitely cut fashion wear. </p>
        		<p> Our USP lies in customization since well-fit clothes are always in fashion! We promise to offer exclusive pieces that you will cherish for the rest of your life</p>
        		<p>Come indulge in fashion and get your outfits tailored to perfection. Fashion is about establishing an image that consumers can adapt to their own individuality. </p>
        		<p>And it's an image that can change, that can evolve. It's truly said that "God lies in Detail". It's surprising how a small detail can change the entire look. I believe in making simple things beautiful.</p>
        		<p></p>
        		<p></p>
		    </div>
	       </div>
        </div>
    <!---->
    <!---->
    <?php include('footer.php')?>
    </body>
</html>

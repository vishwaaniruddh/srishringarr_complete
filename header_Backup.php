<?php
// session_start();

include('config.php');
include('functions.php');

if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}

// var_dump($_COOKIE);

if($_COOKIE['ss_userid'] > 0 ){
$userid =     $_COOKIE['ss_userid'] ; 
}else{
$userid = $_SESSION['gid'];

}



?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <? header("Cache-Control: max-age=31536000"); ?>
    <script
  src="cdn/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
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
    	<!--<link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css"> -->
    	
    
    	<link rel="stylesheet" type="text/css" href="static/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    
    	<!--<link rel="stylesheet" type="text/css" href="static/fonts/themify/themify-icons.css">-->
    
    	<!--<link rel="stylesheet" type="text/css" href="static/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">-->
    	
    	
    	
    	
    	<link rel="stylesheet" type="text/css" href="static/css/style.css">
    
    	<link rel="stylesheet" type="text/css" href="static/css/vendor/animate/animate.css">
    
    
    	<link rel="stylesheet" type="text/css" href="static/css/util.css">
    	<link rel="stylesheet" type="text/css" href="static/css/main.css">
    	<link rel="stylesheet" type="text/css" href="static/css/site.css">

<!-- jQuery -->
<script src="js/jquery_2.4.min.js"></script>

<!-- Bootstrap files (jQuery first, then Popper.js, then Bootstrap JS) -->
<link href="cdn/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="cdn/bootstrap.css">

        <link rel="stylesheet" type="text/css" href="cdn/daterangepicker.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-R8L1VTF3KQ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-R8L1VTF3KQ');
</script>





<link rel="stylesheet" type="text/css" href="css/style.css">


    
    


 <div id="loader" class="center">
     <!--<img class="lazyload" data-src="assets/loader.gif">     -->
 </div>



</head>


















<body class="bg-light">
    
<!-- ========================= SECTION CONTENT ========================= -->





<div class="topbar">
			    			    <div class="topbar-social" style="width: 80%;">
					<a href="https://www.facebook.com/srishringarr/" target="_blank" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
					<a href="https://www.instagram.com/srishringarr/" target="_blank" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
					<!-- <a href="https://plus.google.com/u/1/113103807414319162517" target="_blank" class="fs-18 color1 p-r-20 fa social_googleplus"></a> -->
					<a href="https://twitter.com/SriShringarr" target="_blank" class="fs-18 color1 p-r-20 fa social_twitter"></a>
					<a href="https://in.pinterest.com/srishringarr/?eq=sri&amp;etslf=5839" target="_blank" class="fs-18 color1 p-r-20 fa social_pinterest"></a>
					<p style="font-weight: 700;color: #888888; width: 100%; text-align: center;    margin: 0; "> <img class="lazyload" data-src="assets/truck.png" style="height: 32px;" alt="Sri Shringarr"> <b class="free_shipping_quotes">Free Shipping To And Fro <span style="font-size:12px;">(India)</span></b> </p>
						<select class="form-control" id="cur">
        
        <?
        $cur_sql = mysqli_query($con,"select distinct(currency) as currency,country from conversion_rates where status=1 order by country ASC");
        while($cur_sql_result = mysqli_fetch_assoc($cur_sql)){
            $currency = $cur_sql_result['currency']; ?>
            
            <option value="<? echo $currency; ?>" <? if($_SESSION['cur'] == $currency){ echo 'selected'; }  ?> >
                 <? echo $cur_sql_result['country']; ?>
            </option>
    
        <? } ?>
    </select>
    
    
    
				</div>
				
		
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



	
  <div class="container_s">

		<form action="searchresult.php" method="GET" class="search-box" id="search_form" >
			<input type="text" name="query" class="search-box-input" placeholder="What are you looking for ?" id="query">
			<button class="search-box-btn" id="search" style="position:relative;">
				<img class="lazyload" data-src="assets/search.png" alt="Sri Shringarr">
			</button>
		</form>
  </div>
    


	        </div>
	        
	        
<div class="container-fluid custom_fluid" id="web" style="box-shadow: 0px 6px 14px -10px;">
    
    <div class="cust_logo">
        <a href="/">
            <img class="lazyload" data-src="static/images/site/logo/main_logo.png" alt="Avatar">
                        <!--<span style="font-size: 10px; display: block; color: red;text-align: right;"> Don’t Repeat It. Rent It.</span>-->
        </a>
    </div>
    			
<nav class="navbar navbar-expand-lg">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="main_nav">

<ul class="navbar-nav">
    

	<li class="nav-item"><a href="https://srishringarr.com/index.php" class="nav-link"> Home </a></li>

	
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
    <img class="lazyload" data-src="assets/menu.png" style="height: 10px; width: 10px;" alt="Sri Shringarr">
  </button>
</nav>
</div>





  <div class="collapse navbar-collapse" id="main_nav">

<ul class="navbar-nav">
    

	<li class="nav-item"><a href="https://srishringarr.com/yn/index.php" class="nav-link" > Home </a></li>
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

var ajax_call = function() {
    id = '1';
$.ajax({
            type: "POST",
            url: 'login_track.php',
            data: 'id='+id,
            success:function(msg) {}});    
}
setInterval(ajax_call, 5000);


</script>

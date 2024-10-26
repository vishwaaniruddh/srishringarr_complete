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

// $pathmain = "https://yosshitaneha.com/";

function ProIMG($type, $id){
    global $con;
    
    $prid = $id;
    // $pathmain = "https://yosshitaneha.com/";
    if($type=="1")
    {
        $sql="SELECT img_name FROM `product_images_new` WHERE `product_id`='".$prid."' order by rank ";
        $sql_query = mysqli_query($con,$sql);
        $sql_result = mysqli_fetch_row($sql_query);
        // var_dump($sql_result[0]);
        $path   = trim($pathmain . "uploads" . $sql_result[0]);
            // echo $path;
        return $pro_img = "https://yosshitaneha.com/" . $path;
    }
    else if($type=="2")
    {
        $sql="select img_name FROM `product_images_new` where gproduct_id='".$prid."' order by rank ";
        $sql_query = mysqli_query($con,$sql);
        $sql_result = mysqli_fetch_row($sql_query);
        $path   = trim($pathmain . "uploads" . $sql_result[0]);
            // echo $path;
        return $pro_img = "https://yosshitaneha.com/" . $path; 
    }
    // return $pro_img;
}


function getproductdetails($type, $id)
{
    global $con;
    $prid = $id;
    
    // echo $prid;
    if($type=="1")
    {
        $sql="SELECT product_name,product_desc FROM `product` WHERE `product_id`='".$prid."'";
        $sql_query = mysqli_query($con,$sql);
        $sql_result = mysqli_fetch_assoc($sql_query);
        return $pro_details[] = ['pro_desc'=>$sql_result['product_name'] ];
    }
    else if($type=="2")
    {
        $sql="select gproduct_name,gproduct_desc from  `garment_product` where gproduct_id='".$prid."'";
        $sql_query = mysqli_query($con,$sql);
        $sql_result = mysqli_fetch_assoc($sql_query);
        return $pro_details[] = ['pro_desc'=>$sql_result['gproduct_name'] ];    
    }
    // return $pro_details;
}

?>
<!DOCTYPE HTML>
<html lang="en">

<head>

    <? header("Cache-Control: max-age=31536000"); ?>
    <script src="cdn/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--<title>Sri Shringarr</title>-->
    <meta charset="UTF-8">

    <link rel="icon" type="image/png" href="static/images/icons/favicon.png" />
    
    <!-- MetaTags -->
    <?php 
        if(isset($_GET['type'] ) && isset($_GET['id'] ))
        {
            $type = mysqli_real_escape_string($con, $_GET['type']);
            $id = mysqli_real_escape_string($con, $_GET['id']);
            $days = mysqli_real_escape_string($con, $_GET['days']);
            
            $pro_img = ProIMG($type,$id);
            $productdetails=getproductdetails($type, $id);
            // var_dump($productdetails);
        ?>    
           <meta property="og:title" content="<?=$productdetails["pro_desc"];?>">
       <meta property="og:description" content="Don't Repeat it, Rent It | Sri Shringarr.">
       <meta property="og:image" content="<?=$pro_img;?>">
       <meta property="og:url" content="https://srishringarr.com/detail_test.php?id=<? echo $id;?>&type=<? echo $type;?>&days=<? echo $days;?>">
       <meta property="og:site_name" content="Sri Shringarr Fashion Studio"> 
    <?        
        } else {
    ?>        
        <meta property="og:title" content="Sri Shringarr Fashion Studio">
       <meta property="og:description" content="Don't Repeat it, Rent It | Sri Shringarr.">
       <meta property="og:image" content="static/images/icons/favicon.png">
       <meta property="og:url" content="https://srishringarr.com/list.php?id=10&type=2">
       <meta property="og:site_name" content="Sri Shringarr Fashion Studio"> 
    <?    }
    ?> 
    
    <link rel="canonical" href="/" />   




    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link rel="preload" href="static/fonts/font-awesome-4.7.0/css/font-awesome.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="static/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    </noscript>
    <link rel="preload" href="static/css/style.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="static/css/style.css">
    </noscript>
    <link rel="preload" href="static/css/vendor/animate/animate.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="static/css/vendor/animate/animate.css">
    </noscript>
    
    <link rel="preload" href="static/css/util.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="static/css/util.css">
    </noscript>
    <link rel="preload" href="static/css/main.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="static/css/main.css">
    </noscript>
    <link rel="preload" href="static/css/site.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="static/css/site.css">
    </noscript>
    <!--<link rel="stylesheet" type="text/css" href="static/fonts/font-awesome-4.7.0/css/font-awesome.min.css"> 
    <link rel="stylesheet" type="text/css" href="static/css/style.css"> 
    <link rel="stylesheet" type="text/css" href="static/css/vendor/animate/animate.css"> 
    <link rel="stylesheet" type="text/css" href="static/css/util.css">
    <link rel="stylesheet" type="text/css" href="static/css/main.css">
    <link rel="stylesheet" type="text/css" href="static/css/site.css">  -->
    
    

    <!-- jQuery -->
    <!--<script src="js/jquery_2.4.min.js"></script>-->
    <!--<script src = "cdn/jquery-3.6.0.min.js"></script>-->

    <!-- Bootstrap files (jQuery first, then Popper.js, then Bootstrap JS) -->
    <!--<link href="cdn/bootstrap.min.css" rel="stylesheet" type="text/css" />-->
    <!--<link href="cdn/bootstrap.css" rel="stylesheet" type="text/css" />-->
    <!--<link rel="stylesheet" type="text/css" href="cdn/bootstrap.css">-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
 
    <!--
    <link rel="preload" href="cdn/daterangepicker.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="cdn/daterangepicker.css">
    </noscript> -->
    <!--<link rel="stylesheet" type="text/css" href="cdn/daterangepicker.css">-->

    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!--<script async src="https://www.googletagmanager.com/gtag/js?id=G-R8L1VTF3KQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-R8L1VTF3KQ');
    </script> -->
    
    <style>
        select , option {
            width:80px;
        }
    </style>
    <link rel="preload" href="css/style.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="css/style.css">
    </noscript>
    <!--<link rel="stylesheet" type="text/css" href="css/style.css">-->

    <div id="loader" class="center">
             <img class="lazyload" data-src="assets/loader.gif">     
    </div>
</head>

<style>
    container_s {
        left:0px;
        right : 6px;
    }
    
   /* @media only screen */
   /*and (max-width : 768px) {*/
   /*.mainhead {*/
   /*    text-align:center;*/
   /*    width:100%;*/
       
   /*}*/
}
</style>

<body class="bg-light">
    <!-- ========================= SECTION CONTENT ========================= -->
    <div class="topbar">
    
        <div class="topbar-social" style="width: 100%;">
            <a href="https://www.facebook.com/srishringarr/" target="_blank" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
            <a href="https://www.instagram.com/srishringarr/" target="_blank" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
            <a href="https://twitter.com/SriShringarr" target="_blank" class="fs-18 color1 p-r-20 fa social_twitter"></a>
            <a href="https://in.pinterest.com/srishringarr/?eq=sri&amp;etslf=5839" target="_blank" class="fs-18 color1 p-r-20 fa social_pinterest"></a>
                <p class="mainhead" style="font-weight: 700;color: #888888;margin: 0; "> 
                        
                        <b class="free_shipping_quotes" >Free Shipping To And Fro <span style="font-size:12px;">(India)</span></b> 
                        <img class="lazyload" data-src="assets/truck.png" style="height: 32px;" alt="Sri Shringarr"> 
                        
                    </p>
    </div>
        
        
        

        

        <script>
            $("#cur").on('change', function() {
                var cur = $("#cur").val();


                $.ajax({

                    type: "POST",
                    url: 'set_cur.php',
                    data: 'cur=' + cur,
                    success: function(msg) {

                        window.location.reload();

                    }
                });

            })
        </script>


        <div class="container_s">

            <form action="searchresult.php" method="GET" class="search-box" id="search_form">
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
                        <a class="nav-link dropdown-toggle" href="sub_category.php?type=2" data-toggle="dropdown"> Apparel </a>
                        <ul class="dropdown-menu">
                            <?php
                            $qryjew = mysqli_query($con, "SELECT * FROM `garments` where `Main_id`=1 or `Main_id`=3");
                            while ($rowjew = mysqli_fetch_array($qryjew)) {  ?>
                                <li><a class="dropdown-item" href="list.php?id=<?php echo $rowjew[0]; ?>&type=2"><?php echo ucwords(strtolower($rowjew[2])); ?></a></li>
                            <?php } ?>

                        </ul>

                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> Jewellery </a>
                        <ul class="dropdown-menu">
                            <?php $qryjew = mysqli_query($con, "SELECT * FROM `jewel_subcat` where mcat_id=1 or mcat_id=3");

                            while ($rowjew = mysqli_fetch_array($qryjew)) {
                                $qryjew1 = mysqli_query($con, "select * from subcat1  where maincat_id='$rowjew[0]' and status=1 order by name");

                                $cnt = mysqli_num_rows($qryjew1);
                                $i = 1;
                                while ($rowjew1 = mysqli_fetch_row($qryjew1)) {

                                    if ($cnt > 1) {
                                        if ($i == 1) { ?>
                                            <li>
                                                <a class="dropdown-item" href="#"><?php echo ucwords(strtolower($rowjew[2])); ?> &raquo </span></a>
                                                <ul class="submenu dropdown-menu">
                                                <?php }  ?>

                                                <li> <a class="dropdown-item" href="list.php?id=<?php echo $rowjew1[0]; ?>&type=1"><?php echo ucwords(strtolower($rowjew1[2])) ?></b></a></li>

                                                <?php if ($i == $cnt) { ?>

                                                    <li>

                                                        <a class="dropdown-item" href="list.php?id=0&viewall=<?php echo $rowjew1[0]; ?>&type=1">View All</a>
                                                    </li>
                                                <?php echo '</ul></li>';
                                                } ?>
                                            <?php } else { ?>

                                                <?php if ($i == 1) { ?>
                                                    <li><a class="dropdown-item" href="list.php?id=<?php echo $rowjew1[0]; ?>&type=1"><?php echo ucwords(strtolower($rowjew[2])) ?></b></a></li>
                                                <?php } ?>

                                            <?php } ?>

                                        <?php
                                        $i++;
                                    }  ?>
                                    <?php } ?>
                                                </ul>
                                            </li>

                                            <li class="nav-item"><a href="client_diary.php" class="nav-link">Client Diary</a> </li>
                                            <li class="nav-item"><a href="contact_us.php" class="nav-link">Contact Us</a> </li>
                        </ul>
            </div> <!-- navbar-collapse.// -->
        </nav>

        <div class="cart_account" style="display:flex;justify-content: space-around;width:20%;">

            <div class="">

                <a class="dropbtn" href="account/my-account.php">

                    <? if ($_COOKIE['ss_userid']) {
                        echo "<span>Hello " .  $_COOKIE['ss_fname'] . "</span>";
                    } else {
                        echo  "<span>Login / Signup"  . "</span>";
                    } ?>

                </a>
            </div>

            <div class="" id="cartshowid"></div>

            <? if ($_COOKIE['ss_userid']) { ?>
                <div>
                    <a href="logout.php" style="color:black;">Logout</a>
                </div>
            <? } ?>

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

                <? if ($_COOKIE['ss_userid']) {
                    echo "<span>Hello " .  $_COOKIE['ss_fname'] . "</span>";
                } else {
                    echo  "<span>Login / Signup"  . "</span>";
                } ?>

            </a>
        </div>



        <nav class="navbar navbar-expand-lg">




            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" style="    margin: auto;">
                <!--<span class="navbar-toggler-icon"></span>-->
                <img class="lazyload" data-src="assets/menu.png" style="height: 10px; width: 10px;" alt="Sri Shringarr">
            </button>
        </nav>
    </div>





    <div class="collapse navbar-collapse" id="main_nav">

        <ul class="navbar-nav">


            <li class="nav-item"><a href="https://srishringarr.com/yn/index.php" class="nav-link"> Home </a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="sub_category.php?type=2" data-toggle="dropdown"> Apparel </a>
                <ul class="dropdown-menu">
                    <?php
                    $qryjew = mysqli_query($con, "SELECT * FROM `garments` where `Main_id`=1 or `Main_id`=3");
                    while ($rowjew = mysqli_fetch_array($qryjew)) {  ?>
                        <li><a class="dropdown-item" href="list.php?id=<?php echo $rowjew[0]; ?>&type=2"><?php echo ucfirst(strtolower($rowjew[2])); ?></a></li>
                    <?php } ?>

                </ul>

            </li>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> Jewellery </a>
                <ul class="dropdown-menu">
                    <?php $qryjew = mysqli_query($con, "SELECT * FROM `jewel_subcat` where mcat_id=1 or mcat_id=3");

                    while ($rowjew = mysqli_fetch_array($qryjew)) {
                        $qryjew1 = mysqli_query($con, "select * from subcat1  where maincat_id='$rowjew[0]' and status=1 order by name");

                        $cnt = mysqli_num_rows($qryjew1);
                        $i = 1;
                        while ($rowjew1 = mysqli_fetch_row($qryjew1)) {

                            if ($cnt > 1) {
                                if ($i == 1) { ?>
                                    <li>
                                        <a class="dropdown-item" href="#"><?php echo ucwords(strtolower($rowjew[2])); ?> &raquo </span></a>
                                        <ul class="submenu dropdown-menu">
                                        <?php }  ?>
                                        <li> <a class="dropdown-item" href="list.php?id=<?php echo $rowjew1[0]; ?>&type=1"><?php echo ucwords(strtolower($rowjew1[2])) ?></b></a></li>

                                        <?php if ($i == $cnt) { ?>

                                            <li>

                                                <a class="dropdown-item" href="list.php?id=0&viewall=<?php echo $rowjew1[0]; ?>&type=1">View All</a>
                                            </li>
                                        <?php echo '</ul>';
                                        } ?>
                                    <?php } else { ?>

                                        <?php if ($i == 1) { ?>
                                            <li><a class="dropdown-item" href="list.php?id=<?php echo $rowjew1[0]; ?>&type=1"><?php echo ucfirst(strtolower($rowjew[2])) ?></b></a></li>
                                        <?php } ?>
                                    <?php } ?>
                                <?php
                                $i++;
                            }  ?>
                            <?php } ?>
                                        </ul>
                                    </li>
                                    <li class="nav-item"><a href="client_diary.php" class="nav-link">Client Diary</a> </li>
                                    <li class="nav-item"><a href="contact_us.php" class="nav-link">Contact Us</a> </li>
                </ul>


    </div> <!-- navbar-collapse.// -->


    <script>
        var ajax_call = function() {
            id = '1';
            $.ajax({
                type: "POST",
                url: 'login_track.php',
                data: 'id=' + id,
                success: function(msg) {}
            });
        }
        setInterval(ajax_call, 5000);
    </script>
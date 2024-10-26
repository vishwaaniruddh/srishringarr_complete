<!DOCTYPE html>
<html lang="en">
<head>
    <script src="/cdn/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    
    <?php    if($category==1){ ?>
        
    <meta name="description" content="<?php echo $meta_description ; ?>">
    <meta name="keywords" content="<?php echo $meta_keyword; ?>">
    <meta property="og:title" content="<?php echo $meta_title ; ?>">
    <title><?php echo $category_name ; ?></title>

    <?php    } else if($is_Product_page==1){ 
    
?>


<meta property="og:title" content="<?php echo $meta_title ? $meta_title : "Don't Buy It | Rent It | Srisrishringarr"; ?>">
<meta property="og:description" content="<?php echo $meta_description ? $meta_description : 'Why buy when you can rent? Step out in style, save, and return hassle-free!'; ?>">
<meta property="og:url" content="<?php echo $meta_url ? $meta_url : 'https://srishringarr.com/'; ?>">
<meta property="og:image" content="<?php echo isset($ogImage) ? $ogImage : ''; ?>">

    
  <meta property="og:type" content="product">

  
<meta property="og:image:width" content="200">
<meta property="og:image:height" content="200">
  
  
    <?php }  ?>
    
    
    <meta name="facebook-domain-verification" content="dchmjjsa2pgxu6cqyf2let2ib5kaul" />
    <link rel="icon" type="image/png" href="/static/images/icons/favicon.png" />
    <meta name="google-signin-client_id" content="852903275648-aqalikbg7nd7bavegdg5alajb8pjvbj5.apps.googleusercontent.com">
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1006081147386707');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1006081147386707&ev=PageView&noscript=1"
    /></noscript>
    
    
    <meta name="keywords" content="<?= $ss_seo_keywords; ?>">
<?

$pageURL = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
$pageURL .= $_SERVER['HTTP_HOST'];
$pageURL .= $_SERVER['REQUEST_URI'];

$ogTitle = 'Sri Shringarr Fashion Studio';
$ogDescription = "Don't Repeat it, Rent It | Sri Shringarr.";

$ogURL = $pageURL;

?>



  
  
    <!--<meta property="og:type" content="website">-->
    
    <link rel="canonical" href="/" />   
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="p:domain_verify" content="19b761633583897fb010500cd8163dfb"/>

    <link rel="preload" href="/static/fonts/font-awesome-4.7.0/css/font-awesome.min.css?ver=<?php echo $file_version ; ?>&&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="/static/css/style.css?ver=<?php echo $file_version ; ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="/static/css/vendor/animate/animate.css?ver=<?php echo $file_version ; ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="/static/css/util.css?ver=<?php echo $file_version ; ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="/static/css/main.css?ver=<?php echo $file_version ; ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="/static/css/site.css?ver=<?php echo $file_version ; ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">

    <link rel="preload" href="/thirdparty/css/bootstrap.min.css?ver=<?php echo $file_version ; ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
   <script async src="https://www.googletagmanager.com/gtag/js?id=G-R8L1VTF3KQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-R8L1VTF3KQ');
    </script> 
    
    <style>
    
    
    @font-face {
    font-family: 'Work Sans';
    src: url('./fonts/static/WorkSans-Regular.ttf') format('ttf');
    font-weight: normal;
    font-style: normal;
}
body{
    font-family: 'Work Sans';
}



      .navbar-nav .nav-item:hover a.nav-link {
        color:#f51167;
    }


.custom-underline {
    color: blue; /* Set your desired text color */
    text-decoration: none; /* Remove the default underline */
    position: relative;
}

.custom-underline::after {
    content: '';
    display: block;
    width: 100%;
    height: 4px; /* Adjust the thickness of the underline */
    background-color: #f51167; /* Set your desired underline color */
    position: absolute;
    bottom: -2px; /* Adjust the distance below the text */
    left: 0;
}

    ::-webkit-scrollbar {
  width: 5px;
}
/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: red; 
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #b30000; 
}

        select , option {
            width:80px;
        }
    </style>
    
    <link rel="stylesheet" type="text/css" href="/css/style.css?ver=<?php echo $datetime ; ?>">
</head>


<body style="visibility:visible !important;">
    
    
    



    <?php include('./config.php');
include('./functions.php');


$datetime = date('Y-m-d h:i:s');


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
}


function get_that_filetime($file_url = false) {
    if (!file_exists($file_url)) {
        return '';
    }

    return filemtime($file_url);
}


?>




    <!-- ========================= SECTION CONTENT ========================= -->
    <div class="topbar">
    
        <div class="topbar-social" style="width: 100%;">
            <a href="https://www.facebook.com/srishringarr/" target="_blank" class="  color1 p-r-20 fa fa-facebook"></a>
            <a href="https://www.instagram.com/srishringarr/" target="_blank" class="  color1 p-r-20 fa fa-instagram"></a>
            <a href="https://twitter.com/SriShringarr" target="_blank" class="  color1 p-r-20 fa social_twitter"></a>
            <a href="https://in.pinterest.com/srishringarr/?eq=sri&amp;etslf=5839" target="_blank" class="  color1 p-r-20 fa social_pinterest"></a>
    </div>


        <div class="container_s">
            <form action="/searchresult.php" method="GET" class="search-box" id="search_form">
                <input type="text" name="query" class="search-box-input" placeholder="What are you looking for ?" id="query">
                <button class="search-box-btn" id="search" style="position:relative;">
                    <img class="lazyload" data-src="/assets/search.png" alt="Sri Shringarr">
                </button>
            </form>
            
        </div>



    </div>


    <div class="container-fluid custom_fluid" id="web" style="box-shadow: 0px 6px 14px -10px;">

        <div class="cust_logo">
            <a href="/">
                <img class="lazyload" data-src="/static/images/site/logo/main_logo.png" alt="Avatar">
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
                        <a class="nav-link dropdown-toggle" href="/sub_category.php?type=2" data-toggle="dropdown"> Apparel </a>
                        <ul class="dropdown-menu">
                            <?php
                            $qryjew = mysqli_query($con, "SELECT * FROM `garments` where `Main_id`=1 or `Main_id`=3");
                            while ($rowjew = mysqli_fetch_array($qryjew)) {  ?>
                                <li><a class="dropdown-item" href="/<?php echo $rowjew['url']; ?>"><?php echo ucfirst(strtolower($rowjew[2])); ?></a></li>
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
                                while ($rowjew1 = mysqli_fetch_array($qryjew1)) {

                                    if ($cnt > 1) {
                                        if ($i == 1) { ?>
                                            <li>
                                                <a class="dropdown-item" href="#"><?php echo ucwords(strtolower($rowjew[2])); ?> &raquo </span></a>
                                                <ul class="submenu dropdown-menu">
                                                <?php }  ?>

                                                <li> <a class="dropdown-item" href="/<?php echo $rowjew1['url']; ?>"><?php echo ucwords(strtolower($rowjew1[2])) ?></b></a></li>

                                                <?php if ($i == $cnt) { ?>

                                                <?php echo '</ul></li>';
                                                } ?>
                                            <?php } else { ?>

                                                <?php if ($i == 1) { ?>
                                                    <li> <a class="dropdown-item" href="/<?php echo $rowjew1['url']; ?>"><?php echo ucwords(strtolower($rowjew1[2])) ?></b></a></li>
                                                <?php } ?>

                                            <?php } ?>

                                        <?php
                                        $i++;
                                    }  ?>
                                    <?php } ?>
                                                </ul>
                                            </li>

                                            <li class="nav-item"><a href="/client_diary.php" class="nav-link">Client Diary</a> </li>
                                            <li class="nav-item"><a href="/contact_us.php" class="nav-link">Contact Us</a> </li>

                        </ul>
                    </li>
            </div> <!-- navbar-collapse.// -->
        </nav>
        
        
        

        <div class="cart_account" style="display:flex;justify-content: space-around;width:20%;">

            <div class="">

                <a class="dropbtn" href="/account/my-account.php">

                    <?php 
                    
                    // var_dump($_SESSION);
                    if ($_SESSION['email']) {
                        echo "<span>Hello " .  $_SESSION['fname'] . "</span>";
                    } else {
                        echo  "<span>Login / Signup"  . "</span>";
                    } ?>

                </a>
            </div>

            <div class="" id="cartshowid"></div>

            <?php if ($_SESSION['email']) { 
            
                 if(isset($_SESSION['is_social_login'])){
                     if($_SESSION['is_social_login']==1){ ?>
                        <div>
                            <a href="/googleLogin/logout.php" style="color:black;">Logout</a>
                        </div>
                  <?php   }else{  ?>
                      
                        <div>
                            <a href="/logout.php" style="color:black;">Logout</a>
                        </div>
                  <?php      }
                 }else{
            ?>
                <div>
                    <a href="/logout.php" style="color:black;">Logout</a>
                </div>
            <?php } }?>

        </div>


    </div><!-- container //  -->





    <div id="mobile">
        <div class="">
            <a href="/">
                <img class="sri_logo" src="/static/images/site/logo/main_logo.png" alt="Avatar">
                <!--<span style="font-size: 8px; display: block; color: red;text-align: right;"> Don’t Repeat It. Rent It.</span>-->
            </a>
        </div>

        <div class="" style="margin:auto;">

            <a class="dropbtn" href="/account/my-account.php">

                <?php if ($_SESSION['email']) {
                    echo "<span>Hello " .  $_SESSION['fname'] . "</span>";
                } else {
                    echo  "<span>Login / Signup"  . "</span>";
                } ?>

            </a>
        </div>



        <nav class="navbar navbar-expand-lg">




            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" style="    margin: auto;">
                <!--<span class="navbar-toggler-icon"></span>-->
                <img class="lazyload" data-src="/assets/menu.png" style="height: 10px; width: 10px;" alt="Sri Shringarr">
            </button>
        </nav>
    </div>





    <div class="collapse navbar-collapse" id="main_nav">

        <ul class="navbar-nav">


            <li class="nav-item"><a href="https://srishringarr.com/index.php" class="nav-link"> Home </a></li>
            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="/sub_category.php?type=2" data-toggle="dropdown"> Apparel </a>
                <ul class="dropdown-menu">
                    <?php
                    $qryjew = mysqli_query($con, "SELECT * FROM `garments` where `Main_id`=1 or `Main_id`=3");
                    while ($rowjew = mysqli_fetch_array($qryjew)) {  ?>
                        <li><a class="dropdown-item" href="/<?php echo $rowjew['url']; ?>"><?php echo ucfirst(strtolower($rowjew[2])); ?></a></li>
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
                        while ($rowjew1 = mysqli_fetch_array($qryjew1)) {

                            if ($cnt > 1) {
                                if ($i == 1) { ?>
                                    <li>
                                        <a class="dropdown-item" href="#"><?php echo ucwords(strtolower($rowjew[2])); ?> &raquo </span></a>
                                        <ul class="submenu dropdown-menu">
                                        <?php }  ?>
                                        <li> <a class="dropdown-item" href="<?php echo $rowjew1['url']; ?>"><?php echo ucwords(strtolower($rowjew1[2])) ?></b></a></li>
                                        <?php if ($i == $cnt) { ?>


                                        <?php echo '</ul>';
                                        } ?>
                                    <?php } else { ?>

                                        <?php if ($i == 1) { ?>
                                            <li> <a class="dropdown-item" href="<?php echo $rowjew1['url']; ?>"><?php echo ucwords(strtolower($rowjew1[2])) ?></b></a></li>
                                        <?php } ?>
                                    <?php } ?>
                                <?php
                                $i++;
                            }  ?>
                            <?php } ?>
                                        </ul>
                                    </li>
                                    <li class="nav-item"><a href="/client_diary.php" class="nav-link">Client Diary</a> </li>
                                    <li class="nav-item"><a href="/contact_us.php" class="nav-link">Contact Us</a> </li>
                                 </ul>


    </div>
    
    

<script>
     $(document).ready(function () {
            $('.navbar-nav .nav-item').hover(
                function () {
                    $(this).addClass('custom-underline');
                },
                function () {
                    $(this).removeClass('custom-underline');
                }
            );
        });
            // $("#cur").on('change', function() {
            //     var cur = $("#cur").val();


            //     $.ajax({

            //         type: "POST",
            //         url: '/set_cur.php',
            //         data: 'cur=' + cur,
            //         success: function(msg) {

            //             window.location.reload();

            //         }
            //     });

            // })

</script>
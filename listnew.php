<?php session_start();
include('header.php'); 

$product_type = $_GET['type'];
$product_id = $_GET['id'];
$pricefilter = $_GET['pricefilter'];

if($_REQUEST['viewall']){
    $viewall = $_REQUEST['viewall'];    
}
if($product_id == '10' && $product_type=='2'){ ?>
<title>Rent Designer Lehengas | Sri Shringarr Fashion studio</title>
<meta name="description" content="Rent your special Bridal / Sider Lehengas from Sri Shringarr. ✔Custom Fitting ✔Dry Cleaned ✔Delivery. Don’t Repeat It, Rent It. Click Now for Easy Rentals.">
<meta name="keywords" content="Bridal Lehenga Shops in Mumbai, Bridal Lehengas on Rent, Bridal Lehenga Rental, Bridal Lehenga Rent with prices, Lehenga Rental, Lehenga on Rent, Lehenga Rental Near Me, Lehenga Rental Online, Sider Lehenga On rent, Hand embroidered Lehenga on Rent, Bridal Wear on Hire, Designer Lehengas on Hire, Made In India.">
<? }elseif($product_id == '28' && $product_type=='2'){ ?>
  <title>Rent Exclusive Indo Western Outfits | Sri Shringarr</title>
  <meta name="description" content="Hire Women Outfits for Sangeet, Bachelor Parties, Cocktails etc. Take a glance at the exclusive collection of Sri Shringarr’s Indo Western section and easily rent any.">
  <meta name="keywords" content="Rent Indo Western Outfits, Rent Indo Western Wear, Rent Women's Wear, Sangeet Wear on Hire, Indo Western Gowns on Rent, Indo Western Lehenga Choli, Lehenga Choli on Rent, Crop Top Skirt, Dhoti Style, Draped Gowns, Sharara on rents, Rental clothes, Bridal Wear on Hire, Made In India">
<? }elseif($product_id == '22' && $product_type=='2'){ ?>
  <title>Rent Exclusive Designer Evening Gowns - Sri Shringarr</title>
  <meta name="description" content="Don’t Repeat It, Rent It. Rent Exclusive Reception Gowns, Floor Length Gowns, Indian Bridal Gowns, Ball Gowns, Trail Gowns, Pre Wedding Gowns.">
  <meta name="keywords" content="Rent Indian Gowns, Women Gowns on Rent, Drape Gowns, Reception Gowns on Hire, Hand Embroidered Gowns, Bridal Gowns, Evening Gowns, Designer Gowns, Ball Gown, Trail Gown, Pre Wedding Gown, Infinity Gown, Maternity Shoot Gowns, Rental Clothes, Clothes on Rent, Bridal Wear on Hire, Made In India.">
<? }elseif($product_id == '29' && $product_type=='2'){ ?>
  <title>Trail / Infinity Gown on Rent for Pre Wedding| Sri Shringarr</title>
  <meta name="description" content="Rent Trail Gowns / Infinity Gowns for your Pre Wedding or Maternity Shoot. Sri Shringarr gives Long Flowy Gowns on Hire. Pre Wedding Gowns | Maternity Gowns">
  <meta name="keywords" content="Trail Gowns on Rent, Rental Pre Wedding Gowns, Pre Wedding Shoot Gowns on Rent, Infinity Gowns on Rent, Maternity Shoot Gowns on Rent, Gowns on Rent, Long Gowns on Rent, Flowy Gowns on Rent.">
<? }elseif($product_id == '57' && $product_type=='1'){ ?>
  <title>Rent Elegant Matha Patti / Damini from Sri Shringarr</title>
  <meta name="description" content="Rent from the widest collection of Matha Patti to embrace your Wedding Look. Kundan Mathapatti, MathaPatti with Tikkas, Bridal Damini. Don’t Repeat It, Rent It.">
  <meta name="keywords" content="Rental Matha Patti, Kundan Matha Patti on Rent, Rent Bridal Jewellery, Matha Patti for round face, Nethichutti, Matha Patti Online on Hire, Damini on Rent in Mumbai, Bridal Damini for Rent, Indian Damini Online, Indian Traditional Jewellery on Rent, Made In India">
<? }elseif($product_id == '53' && $product_type=='1'){ ?>
  <title>Rent Rajasthani Style Mang Tikka - Borla | Sri Shringarr</title>
  <meta name="description" content="Rent trendy Borla styles to enhance your wedding look. Hire from our exclusive collection of Kundan Borlas, Rajastani Style Borlas, Polki Borlas, Diamond Borlas,Padmavat Styled Round Borla.">
  <meta name="keywords" content="Round Mangtikka on Rent , Rajasthani Borla on Hire, Rajasthani Mangtikka, Borla, Borla Jewellery, Hair accessories on rent, Hair Jewellery, Mangtikkas on rent, Jewellery on rent for one day, Bridal Jewellery on Hire, Made In India">
<? }elseif($product_id == '77' && $product_type=='1'){ ?>
  <title>Rent Beautiful Women Earrings | Sri Shringarr</title>
  <meta name="description" content="Hire from India's widest designer collection of exclusive Earring. Kundan Earrings | Bridal Earrings | Chandbali Earrings| Diamond Earrings| Studs on Hire">
  <meta name="keywords" content="Earrings on Rent, Kundan Earrings on Hire, Rent Diamond Earrings, Rent Green Kundan Earrings, Bridal Jewellery on rent, Chandbali Earrings on rent, New earring design, Long Dangler Earrings on Rent, Hire Designer Earrings, Earring Studs on Rent, Made In India, Jhimki, Jhumki, Chandelier Earring. ">
<? }elseif($product_id == '56' && $product_type=='1'){ ?>
  <title>Rent Kamarpatta|Kamarbandh|Waist Chain|South Indian Waist Belt</title>
  <meta name="description" content="Rent Trendy Kamarpatta Designs, South Indian Waist Chain, Kundan Belly Chain, Multi Layered Kamar Bandh, Traditional Kamarpatta | Indian Traditional Jewelry">
  <meta name="keywords" content="Indian Traditional Jewellery on Rent, Temple Jewellery on Rent, South Indian Bridal Jewellery on Rent, South Indian Waist Chain on Rent, Kundan Waist Chain on Hire, Kundan Kamarpatta on Rent, Oddiyanam, Kamarpatta with beads, Kamarbandh, Waist Chain, Belly Chain,Vaddanam, Temple Jewellery">
<? }elseif($product_id == '63' && $product_type=='1'){ ?>
  <title>Rent the Best Maang Tikka Designs | Sri Shringarr</title>
  <meta name="description" content="Rent from our exclusive designer collection of Maang Tikkas Online.  Your accessories are just a click away. Don't Repeat It, Rent It.">
  <meta name="keywords" content="Tikka Forehead on Rent, Hire Tikka Jewelry, Maang Tikkas Online On Rent, Tikka Online Jewellery, Bridal Maang Tikka on Rent, Mang Tikka Set on Rent,Kundan Tikka on Rent, Hair Jewelry on Hire, Rented Blue Maang Tikka, Green Maang Tikka on Rent, Rental Jewelry, Nethichutti, Made In India.">
<? }elseif($product_id == '66' && $product_type=='1'){ ?>
  <title>Exclusive Rental Bangle Designs for Women | Sri Shringarr</title>
  <meta name="description" content="Rent perfect Jewellery for your outfit. Hire Bangles from our exclusive collection of Kundan, Vilandi, Polki, Diamond Bangles.">
  <meta name="keywords" content="Rent Indian Bangles, Rental Kada’s, Jotha on Rent, Kundan Bangles on Hire, Gold Bangles on Hire, American Diamond Bangles on Rent, Temple Jewellery on Rent, Bangles with Laxmi, Bridal Bangles on rent, South Indian Bangles, Bangles for Women on Rent">
<? }elseif($product_id == '67' && $product_type=='1'){ ?>
  <title>Rent Trendy and Traditional Bracelet / Kadas for Women | Sri Shringarr</title>
  <meta name="description" content="Book Diamond/Kundan/Polki Bracelet for your special occasions. Rent now from India's widest Art Jewellery Collection!">
  <meta name="keywords" content="Rental jewellery Mumbai, Bracelet Bangles on rent, Bracelet for Women on Rent, Kada’s, Bangles, One Hand Bangles on Rent, Wedding Bracelet on Rent, American Diamond Bracelet, Kundan Bracelet, Kadas, Valayal, Gajju, Bale, Openable Bracelet on Rent, Jewelry on Rent with price, Made in India, Antique Kada, Golden Kada">
<? }elseif($product_id == '69' && $product_type=='1'){ ?>
  <title>Rent Haath Phool / Hath Panja Online | Sri Shringarr</title>
  <meta name="description" content="Rent trendy Haath Phool / Hath Panja from Sri Shringarr.   Click now to check the availability of your slots. Kundan Hathphool | Diamond Hath Panja ">
  <meta name="keywords" content="Hathphool on rent, Hathphool Bracelet with rings, hathphool design in kundan, hathphool design in gold, Hire Hathphool Rajputi, Hathphool with three finger rings on rent, Rental Jewelry, Bridal Hathphool on rent, Jewelry on Rent, Hath Panja on Rent , Hand Accessory, Hand Jewellery, Made in India.">
<? }elseif($product_id == '73' && $product_type=='1'){ ?>
  <title>Rent Unique Hair Accessories From Sri Shringarr</title>
  <meta name="description" content="Rent Indian Hair Accessories, Choti Pieces, Hair Clips, Amboda for Brides or Bridesmaids. Book Now to avail your slots!">
  <meta name="keywords" content="Indian Hair Accessories on Rent, Suryapirai and Chandrapirai, Jadanagam, Choti Pieces on Hire, Rent Temple Jewellery, Rental Amboda, Beaded Amboda, Hair Brooches for Rent , Hair Jewellery on Rent , Hair Pieces, Bridal Ambodas, Bridal Hair Clips, Hair Put-ons On Rent in Mumbai, Ambada, Ambada Veni Phool">
<? }elseif($product_id == '71' && $product_type=='1'){ ?>
  <title>Rent Exclusive Baju Bandh From Sri Shringarr</title>
  <meta name="description" content="Rent Kundan Baju Bandh, South Indian Baju Bandh, Diamond Bajuband Online from Sri Shringarr. Don't Repeat It, Rent It.">
  <meta name="keywords" content="Bajubandh on Rent, Rental Jewelry, Jewelry on Hire, Armlet on Hire, Indian Armlet, Hand Jewelry on rent, Rent bridal jewellery, Vanki, Vaaki, Traditional Bajubandh, Antique Bajubandh ">
<? }
?>
<!--<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>-->
<script src="pagination.js"></script>
<link rel="stylesheet" href="https://pagination.js.org/dist/2.1.4/pagination.css"/>
<style>
.loader {  color: #e6be6e;  font-size: 90px;  text-indent: -9999em;  overflow: hidden;  width: 1em;  height: 1em;  border-radius: 50%;  margin: 72px auto;  position: relative;  -webkit-transform: translateZ(0);  -ms-transform: translateZ(0);  transform: translateZ(0);  -webkit-animation: load6 1.7s infinite ease, round 1.7s infinite ease;  animation: load6 1.7s infinite ease, round 1.7s infinite ease;}
@-webkit-keyframes load6 {  0% {    box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;  }  5%,  95% {    box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;  }  10%,  59% {    box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;  }  20% {    box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;  }  38% {    box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;  }  100% {    box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;  }}@keyframes load6 { 0% {  box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;  } 5%,  95% {    box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;  }  10%,  59% {    box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;  }  20% {    box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;  }  38% {    box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;  }  100% {    box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;  }}
@-webkit-keyframes round {  0% {    -webkit-transform: rotate(0deg);    transform: rotate(0deg);  }  100% {    -webkit-transform: rotate(360deg);    transform: rotate(360deg);  }}@keyframes round {  0% {    -webkit-transform: rotate(0deg);    transform: rotate(0deg);  }  100% {    -webkit-transform: rotate(360deg);    transform: rotate(360deg);  }}					     p{					         color:#000;					     }					     .product_col:hover .product_img{    transition: transform 1.2s;    transform: scale(1.5);					     } div.subpart * {     all: initial;      all: unset;}

.formob{        text-transform: uppercase;}p,span,h1,h2,h3,h4,h5,h6{        font-family: Montserrat-Regular !important;}    .ftco-animate {    /*opacity: 0;*/    /*visibility: hidden;*/}
.product {    display: block;    width: 100%;     border: 1px solid #c3c3c3;     margin-bottom: 30px;    position: relative;    -moz-transition: all .3s ease;    -o-transition: all .3s ease;    -webkit-transition: all .3s ease;    -ms-transition: all .3s ease;    transition: all .3s ease;    padding: 10px;    background: white;    height: 100%;    margin-top: 10px;}.product .img-prod {    position: relative;    display: block;    overflow: hidden;}a {    -webkit-transition: .3s all ease;    -o-transition: .3s all ease;    transition: .3s all ease;    color: #ffa45c;}
.product .img-prod img {    -webkit-transform: scale(1);    -moz-transform: scale(1);    -ms-transform: scale(1);    -o-transform: scale(1);    transform: scale(1);    -moz-transition: all .3s ease;    -o-transition: all .3s ease;    -webkit-transition: all .3s ease;    -ms-transition: all .3s ease;    transition: all .3s ease;}
.img-fluid {    max-width: 100%;    height: auto;        min-height: 350px;    object-fit: cover;}img {    vertical-align: middle;    border-style: none;}
.product .img-prod span.status {    position: absolute;   top: 10px;    left: -1px;   padding: 2px 15px;    color: #000;    font-weight: 300;    background: #ffa45c;}
.product .img-prod .overlay {    position: absolute;    top: 0;    left: 0;    right: 0;    bottom: 0;    content: '';    opacity: 0;    background: #ffa45c;    -moz-transition: all .3s ease;    -o-transition: all .3s ease;    -webkit-transition: all .3s ease;    -ms-transition: all .3s ease;    transition: all .3s ease;}
.product .text {    background: #fff;    position: relative;    width: 100%;}
.pl-3, .px-3 {    padding-left: 1rem!important;.}.pb-3, .py-3 {    padding-bottom: 1rem!important;}.pr-3, .px-3 {    padding-right: 1rem!important;}.pt-3, .py-3 {    padding-top: 1rem!important;}
.product .text h3 {    font-size: 14px;    margin-bottom: 5px;    font-weight: 300;    text-transform: uppercase;    letter-spacing: 1px;}
.d-flex {    display: -webkit-box!important;    display: -ms-flexbox!important;    display: flex!important;}
@media (min-width: 992px){.col-lg {    -ms-flex-preferred-size: 0;    flex-basis: 0;    -webkit-box-flex: 1;    -ms-flex-positive: 1;    flex-grow: 1;    max-width: 100%;}    }
@media (min-width: 768px){.col-md-6 {    -webkit-box-flex: 0;    -ms-flex: 0 0 50%;    flex: 0 0 50%;    max-width: 50%;}}
@media (min-width: 576px){.col-sm {    -ms-flex-preferred-size: 0;    flex-basis: 0;    -webkit-box-flex: 1;    -ms-flex-positive: 1;    flex-grow: 1;    max-width: 100%;}    }
<? if($_GET['id']==29){ ?> 
 
.img-fluid {   object-fit: scale-down; }
    
<? } ?>

.col-xs-6{    width: 50%;    padding-left:3px;    padding-right:3px;    margin: 10px auto;}.paginationjs{    margin:20px auto;} </style>
<?
include('config.php');
function get_booking_status($sku) {
    global $con3;
    $sql = mysqli_query($con3,"select * from order_detail where item_id ='".$sku."' order by bill_id desc");
    $sql_result = mysqli_fetch_assoc($sql);
    $bill_id = $sql_result['bill_id'];
    if($bill_id>0){
        $status_sql = mysqli_query($con3,"select * from phppos_rent where bill_id ='".$bill_id."'");
        $status_sql_result = mysqli_fetch_assoc($status_sql);
        return $status_sql_result['booking_status'];        
    }
    else{
        return 0;
    }

}
?>
<div class="container">
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 p-b-50 p-r">
        <div class="flex-sb-m flex-w p-b-35">
						<!--<div class="flex-w"> 
							<a href="sub_category.php?type=1">Jewellery</a>&nbsp;/ Kundan
						</div> -->
						
						<ol class="breadcrumb" style="display:inline-flex">
		  <?php
		  if($product_type=="1")
		  {
		      ?>
		       <a href="sub_category.php?type=1"><li class=""> <?php echo "Jewellery";?>&nbsp; / &nbsp;</li></a>
		      <?php
		  }else if($product_type=="2")
		  {
		     ?>
		       <a href="sub_category.php?type=2"><li class=""> <?php echo "Apparels";?>&nbsp; / &nbsp;</li></a>
		      <?php  
		  }
		if($product_type=="1")
		{
		    $gtmctnm=mysqli_query($con,"select name,maincat_id from subcat1 where subcat_id='".$rws[8]."'");
		    $grmrws=mysqli_fetch_array($gtmctnm);
		    
		    $gtmctnm2=mysqli_query($con,"select categories_name from jewel_subcat where subcat_id='".$grmrws[1]."'");
		    $grmrws2=mysqli_fetch_array($gtmctnm2);
	    ?>
	    <?php if(strtolower($grmrws2[0]) != strtolower($grmrws[0])){ ?>
		    <li class=""><a href="javascript:void(0);" onclick='brdcrumbfunc("<?php echo $grmrws[1];?>","<?php echo $subcatid;?>","<?php echo $typ;?>","1");'><?php echo ucfirst(strtolower($grmrws2[0]));?></a></li>
	    <?php } ?>
		    
        <li class=""><a href="javascript:void(0);" onclick='brdcrumbfunc("<?php echo $grmrws[1];?>","<?php echo $rws[8];?>","<?php echo $typ;?>");'><?php echo ucfirst(strtolower($grmrws[0]));?></a></li>
		<?php }
		    else  if($product_type=="2"){ 
		        $gtmctnm=mysqli_query($con,"select name from garments where garment_id='".$rws['product_for']."'");
		        $grmrws=mysqli_fetch_array($gtmctnm);
		  ?>
		 <li class=""><a href="javascript:void(0);" onclick='brdcrumbfunc("<?php echo $rws['product_for'];?>","<?php echo "0";?>","<?php echo $typ;?>");'><?php echo ucfirst(strtolower($grmrws[0]));?></a></li>
		 <?php } ?>
		 </ol>
						<span class="s-text8 p-t-5 p-b-5">
							<!--Showing &lt; Page 1 of 8&gt;  146 results-->
						</span>
<!--						<span>-->
    
<!--<a href="javascript:prevPage()" id="btn_prev">Prev</a>-->
<!--<a href="javascript:nextPage()" id="btn_next">Next</a>-->

<!--						</span>-->
<select class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" style="width: auto;">
    <option>Select</option>
    <option value="list.php?id=<?php echo $product_id;?>&type=<?php echo $product_type;?>&pricefilter=1">Higher To Lower</option>
        <option value="list.php?id=<?php echo $product_id;?>&type=<?php echo $product_type;?>&pricefilter=2"> Lower To Higher </option>
    </option>
</select>
						<hr style="width:100%;background:#ccc;">
					</div>
    </div>
</div>
</div>
<div class="container">
    
    <?
    // var_dump($_SESSION);
    
    ?>
					    <div class="row formob">
    <div class="loader">Loading...</div>    
        <div  class="proList grid" id="list1">
            <div class="row rowFlexMargin wrapper"></div>
        </div>
						</div>
					</div>
					
<script>

   
  
var id='<? echo $product_id ; ?> ';
var type='<? echo $product_type ; ?>';
var pricefilter='<? echo $pricefilter ; ?>';
var viewall = '<? echo $viewall ; ?>';
var current_page = 1;
var records_per_page = 20;
        $.ajax({
            type: "POST",
            url: 'list5_json.php',
            data: 'id='+id+'&type='+type+'&pricefilter='+pricefilter,
            success:function(msg) {
                    
 if(msg){
     
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
var obj = JSON.parse(msg);
     
$('#list1').pagination({
  dataSource: obj, 
  pageSize: 20, 
  callback: function(data, pagination) {
      var wrapper = $('#list1 .wrapper').empty();
      $.each(data, function (i, f) {
                            var ht = '<div class="col-xs-6 col-md-4 col-lg-3 ftco-animate fadeInUp ftco-animated product_col">';
                            ht +='<div class="product">';
                            ht += '<a href="'+f.link+'" class="img-prod">';
                            ht += f.imageframe;
                            // ht += '<img class="img-fluid product_img" style="width: 100%; object-fit: contain; user-select: auto;" src="' +f.imageframe + '">';
                            ht += '</a>';
                            ht += '<div class="text py-3 px-3">';
                            ht += '<h3><a href="'+f.link+'">'+f.product_name+'</a></h3><hr>';
                            ht += '<div class="subpart">';
                            ht += '<p style="display:block;">MRP  '+f.cur_sym +' '+f.selling_price+'</p>';
                            ht += '<h6 style="color:red;    font-size: 13px; text-decoration: underline;font-weight: 700;">SKU : <a href="'+f.link+'">'+f.sku+'</a></h6>';
                            ht += '<div class="d-flex">';
                            ht += '<div class="pricing">';
                            ht += '<p class="price">';
                            ht += '<span class="mr-2 price-dc">Rent '+f.cur_sym +' <strong>'+f.rent_price+'</strong>  for 3 Days</span><br>';
                            ht += '<span class="price-sale">Deposit '+f.cur_sym +' <strong>'+f.deposite+'</strong></span>';
                            ht += '</p></div>';
                            ht += '<div class="rating"><p class="text-right">';
                            ht += '<a href="#"><span class="ion-ios-star-outline"></span></a>';
                            ht += '<a href="#"><span class="ion-ios-star-outline"></span></a>';
                            ht += '<a href="#"><span class="ion-ios-star-outline"></span></a>';
                            ht += '<a href="#"><span class="ion-ios-star-outline"></span></a>';
                            ht += '<a href="#"><span class="ion-ios-star-outline"></span></a>';
                            ht += '</p></div></div>';
                            ht += '<div class="here">'+f.booking+'</div>';
                            
                            console.log(ht);
                            $('#list1 .wrapper').append(ht);
                            
                        });
                    }
                });

       $('.loader').css('display','none');
    }
    
    
    
  }
}); 
setTimeout(function(){  
$('body').on('DOMSubtreeModified', 'li', function(){
  console.log('changed');
});

}, 3000);
</script>
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
  $("#nevershownl").on('click',function(){
  $.ajax({
            type: "POST",
            url: 'nes_session.php',
            data: '',
            success:function(msg) {}
    });
  });
</script>
<?php include('footer.php'); ?>
<?php session_start();
include('header.php');
include('config.php');

ini_set('memory_limit','24M');


$product_type = $_GET['type'];
$product_id = $_GET['id'];

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
<script>
function round_amount(amount){

    var round_num = amount.slice(-2);

        if(round_num < 50 ){
            add_amount = 50 - round_num;
        }
        if(round_num > 50 ){
            add_amount = 100 - round_num;
        }
        if(round_num ==  00 || round_num==50){
            add_amount = 00;
        }

    new_amount = parseInt(amount) + parseInt(add_amount);
    return new_amount;
}
</script>

<link rel="stylesheet" href="cdn/pagination.css"/>

<style>

<? if($_GET['id']==29){ ?>

.img-fluid {   object-fit: scale-down; }

<? } ?>

.col-xs-6{    width: 50%;    padding-left:3px;    padding-right:3px;    margin: 10px auto;}.paginationjs{    margin:20px auto;} </style>
<?



$product_type = $_GET['type'];
$product_id = $_GET['id'];
$pricefilter = $_GET['pricefilter'];

if($_REQUEST['viewall']){
    $viewall = $_REQUEST['viewall'];
}

 $file = 'data/'.$product_type . '-'.$product_id.'.json';
if($_REQUEST['viewall']){
    $viewall = $_REQUEST['viewall'];
    $file = 'data/'.$product_type . '-'.$product_id . '-' . $viewall .'.json';
}

$requesturi =  $_SERVER['REQUEST_URI'] ;

        $url = 'https://www.srishringarr.com'.  $_SERVER['REQUEST_URI']  ;

        if ( $temp = strstr($requesturi, 'page', true) ) {
        $requesturi = $temp;
        $requesturi = rtrim($requesturi , '&');
        }


function getDBrent2($sku,$type){

    global $con;

    if($type==1){
        $sql ="select rent_price from product where product_code='".$sku."' order by product_id desc";
    }else if($type==2){
         $sql ="select rent_price from garment_product where gproduct_code='".$sku."' order by gproduct_id desc";
    }

    $statement = mysqli_query($con,$sql);
    if($statement_result = mysqli_fetch_assoc($statement)){
        return $statement_result['rent_price'];
    }else{
        return 0 ;
    }

}

$todaysdt=date("Y-m-d");

$get_id = $_REQUEST['id'];
$type = $get_type = $_REQUEST['type'];



$get_pricefilter = $_REQUEST['pricefilter'];
$pathmain ='https://yosshitaneha.com/';
$viewall = $_REQUEST['viewall'];


if($get_id==0 && $get_type==1 && $viewall == 4 ){
 $all = "'2','1','6','3','68','4'";
 $necklace=1;
}

if($get_id==1 ||$get_id==2 ||$get_id==3 ||$get_id==4 ||$get_id==6||$get_id==68){
    if($type==1){
      $necklace=1;
    }
}

if($get_id==0 && $get_type==1 && $viewall == 76 ){

 $all = "'59','74','75','76','77','78','79','80'";
}

// $sql =  mysqli_query($con,"select count(product_for)  as count_a from `garment_product` where product_for='".$get_id."' and gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0)");
// $sql_count = mysqli_fetch_assoc($sql);
// var_dump( $sql_count);

if($type==2){
$sql_query = "select *, CAST(REGEXP_SUBSTR(gproduct_code,'[0-9]+') AS UNSIGNED) as sku from `garment_product` where product_for='".$get_id."' and gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0) order by sku desc";
}
if($type==1){
   if($all){
    $sql_query = "select product_id, product_image, product_code, product_name, product_desc, date_added, categories_id, subcategory, subcat_id, maincatagory, subcatagoty, sales_price, rent_price, itemid, product_new_imageid, deposit, facebook, Instagram, Google, Twitter, Pinterest, flipkart, amazon, discount, total_amt, seen_count, is_customized, is_color_same, is_pattern_same, is_piece_same, cgst, sgst, igst, short_desc, brand_color, youtube,CAST(REGEXP_SUBSTR(product_code,'[0-9]+') AS UNSIGNED) as sku from `product` where subcat_id in($all) order by sku desc";
   }else{
    $sql_query = "select product_id, product_image, product_code, product_name, product_desc, date_added, categories_id, subcategory, subcat_id, maincatagory, subcatagoty, sales_price, rent_price, itemid, product_new_imageid, deposit, facebook, Instagram, Google, Twitter, Pinterest, flipkart, amazon, discount, total_amt, seen_count, is_customized, is_color_same, is_pattern_same, is_piece_same, cgst, sgst, igst, short_desc, brand_color, youtube,CAST(REGEXP_SUBSTR(product_code,'[0-9]+') AS UNSIGNED) as sku from `product` where subcat_id='".$get_id."' order by sku desc";
   }
}
$raw_data = mysqli_query($con,$sql_query);
$i = 1;
while($row = mysqli_fetch_array($raw_data)){
   // echo '<pre>';print_r($row);echo '</pre>';
        if($type=="1"){
            $prcode=$row[2];
        }else{
            $prcode=$row[2];
        }
        $sku = $prcode;
        $product_name = $row[3];
        $discount = $row[21];
        $youtube = $row[35];

        $deposit = 0;


        $re = mysqli_query($con3,"SELECT unit_price,cost_price,quantity FROM phppos_items where name like '".$prcode."'");
        $rero=mysqli_fetch_row($re);

        $qty=round($rero[2]);
         
         if($sku=='HP164ON'){
            // echo $rero[0]."--".$rero[1]."--".$rero[2];
         }
         
        if($qty > 0 ){
        $re1 = mysqli_query($con3,"select sum(commission_amt) from order_detail where item_id='".$prcode."' and bill_id in(select bill_id from phppos_rent where booking_status!='Booked')");
        $rero1=mysqli_fetch_row($re1);
        $currentsp=$rero[0]-$rero1[0];
        $splimit=$rero[1]*0.8;

         if($sku=='HP164ON'){
           //  echo "--".$currentsp."--".$splimit;
         }
                if($type==1){
                    if($necklace==1){
                        if($currentsp>$splimit)
                            $newsp=$currentsp;
                        else
                            $newsp=$splimit;
                    }
                    else{
                        $newsp = $rero[0];
                    }

                }elseif($type==2){
                    if($currentsp>$splimit)
                        $newsp=$currentsp;
                    else
                        $newsp=$splimit;
                }


                 if($type=="1")
                        {
                            $sqlimg="SELECT img_name FROM `product_images_new` WHERE `product_id`='".$row[0]."'";

                              if($newsp<=40000){
                                $rentprice=$newsp*0.20;
                              }
                            else if($newsp<=60000){
                                $rentprice=$newsp*0.17;
                            }
                            else{
                                $rentprice=$newsp*0.15;
                            }

                               if($newsp<=2000){
                                   $courier = 100;
                               }else if($newsp<=5000){
                                   $courier = 250;
                               }else if($newsp<=10000){
                                   $courier = 500;
                               }else{
                                   $courier = 1000;
                               }

                                   $rentprice = $rentprice  + $courier ;
                                    if( $necklace == 1 ){    // necklace cat should have mimnim um 1500 rent and not less than that
                                            if($rentprice < 1500){
                                                $rentprice = 1500;
                                                $deposit = 3000;
                                            }
                                    }

                        }
                        else
                        {
                            $sqlimg="SELECT img_name FROM `product_images_new` WHERE `gproduct_id`='".$row[0]."'";

                            if($newsp<=40000){
                                $rentprice=$newsp*0.20;
                            } else if($newsp<=60000){
                                $rentprice=$newsp*0.17;
                            } else{
                                $rentprice=$newsp*0.15;
                            }

                            if($newsp<=10000){
                               $courier = 750;
                            }else {
                               $courier = 2000;
                            }
                        $rentprice = $rentprice  + $courier ;
                            if($rentprice < 3500 ){
                               $rentprice = 3500;
                             $deposit = 3500;
                            }
                        }
                        
              
                        $rentprice = intval($rentprice) ;

                        $qryimg = mysqli_query($con,$sqlimg);
                        $rowimg = mysqli_fetch_row($qryimg);

                         if($youtube){


                                $ytarray=explode("/", $youtube);
                                $ytendstring=end($ytarray);
                                $ytendarray=explode("?v=", $ytendstring);
                                $ytendstring=end($ytendarray);
                                $ytendarray=explode("&", $ytendstring);
                                $ytcode=$ytendarray[0];
                                $imgframe =  "<iframe title=\"\" width=\"100%\" height=\"315\"  src=\"https://www.youtube.com/embed/$ytcode\" autoplay=\"0\"  frameborder=\"0\" allowfullscreen  loading=\"lazy\"></iframe>";
                        }
                        else if($rowimg){
                            $path = ($pathmain."uploads".$rowimg[0]);

                            $source_img = trim("yn/uploads".$rowimg[0]);
                            $filename = basename($source_img);

                            $_file_parent = "https://srishringarr.com/";
                            $_new_filename = $_file_parent.$source_img;
                            if(!file_exists($_new_filename)){
                               $destination_img =  $path;
                            }else{
                            // $destination_img = 'comimage/com_'.$filename;
                            $destination_img =  str_replace($filename,'',$source_img) .'com_'.$filename;
                            }
                            // compress($source_img, $destination_img, 20);

                             $imgframe = '<img class="lazyload img-fluid product_img" loading="lazy" style="width: 100%; object-fit: contain; user-select: auto;" src="//images.weserv.nl/?url='.$destination_img.'&w=400&h=300">';
                            // $imgframe = '<img class="lazyload img-fluid product_img" loading="lazy" style="width: 100%; object-fit: contain; user-select: auto;" data-src="' . $destination_img . '">';

                        }
                        else{

                        }

                            $rentprice = round_amount($rentprice);


                            $link = "detail.php?id=$row[0]&type=$type&days=3";


                                $order_sql = mysqli_query($con3,"SELECT * FROM `order_detail` where `item_id`='".$row[2]."' and bill_id in(SELECT bill_id  FROM `phppos_rent` WHERE (`pick_date` >=".$todaysdt." or `delivery_date` >=".$todaysdt.") and booking_status!='Returned' ORDER BY `phppos_rent`.`pick_date` ASC) group by bill_id");
                                $order_sql_result = mysqli_fetch_assoc($order_sql);

                                $booking_billid = $order_sql_result['bill_id'];

                                $booking_sql = mysqli_query($con3,"select * from phppos_rent where bill_id ='".$booking_billid."'") ;
                                $booking_sql_result = mysqli_fetch_assoc($booking_sql);

                                $pick_date = $booking_sql_result['pick_date'];
                                $delivery_date = $booking_sql_result['delivery_date'];
                                $booking_status = $booking_sql_result['booking_status'];
                           
                               if($row[2]=='YNL237XL'){
                                 //  echo $booking_billid."--".$pick_date."--".$delivery_date."==".$booking_status;
                               }
                               
                           
                            if($pick_date!='' && $delivery_date!='' && $booking_status !='Returned') {
                                  $booking_date ='' ;
                                  if($pick_date!="0000-00-00" && $delivery_date!="0000-00-00"){
                                    $booking_date = '<div><span style="color:red;">Booking Status Dates</span> <br>'  .  date("d-m-Y", strtotime($pick_date)) .' - '. date("d-m-Y", strtotime($delivery_date)) . '</div>';
                                  }
                                      
                            }else{
                                $booking_date ='' ;
                            }


                            if(isset($deposit) && $deposit!=0){

                            }
                            else{ $deposit = intval($newsp*0.35); }
                                // $deposit = round($newsp*0.35) ;
                                $deposit=round_amount($deposit);
                                $final_rent = round_amount($rentprice) ;

                            if(getDBrent2($sku,$type)>0){
                                $final_rent = getDBrent2($sku,$type);
                                $final_rent = round_amount($final_rent+$courier);
                            }


                            $round_num = substr( $deposit, -2);
                            if($round_num < 50 && $round_num!=00 && $round_num!=50){
                                $add_amount = 50 - $round_num;
                            }
                            elseif($round_num > 50 && $round_num != 00 && $round_num!=50){
                                $add_amount = 100 - $round_num;
                            }
                            else{
                                $add_amount = 0;
                            }



                            $final_deposit = $deposit + $add_amount;



                            $selling_price = $rero[0] ;

                            $cur_sym = $currency_symbol;


                            $cur_sql = "select * from conversion_rates where currency ='".$currency."'";
                            $sql1 = mysqli_query($con,"select * from conversion_rates where currency ='".$currency."'");
                            $sql1_result = mysqli_fetch_assoc($sql1);
                            $rate = $sql1_result['rate'];

                            $newmoney = $rate*$selling_price ;

                         //   $final_deposit = $rate*$final_deposit ;
                         //   $rentprice = $rate * $rentprice ;

                            $selling_price  = round($newmoney,2) ;
                            $final_deposit = round($final_deposit,2);
                            $rentprice = round($final_rent,2);

 $data[] = ['1'=>$source_img,'com_image'=>$destination_img,'snno'=>$i,'cur_sym'=>$cur_sym,'product_name'=>$product_name,'selling_price'=>$selling_price,'rent_price'=>$rentprice,'image'=>$path,'sku'=>$prcode,'deposite'=>$deposit,'discount'=>$discount,'link'=>$link,'statement'=>'1', 'booking'=>$booking_date,'imageframe'=>$imgframe,'newsp'=>$newsp];
  $i++;

}
}


$page = !isset($_GET['page']) ? 1 : $_GET['page'];
$limit = 20; // five rows per page
$offset = ($page - 1) * $limit; // offset
$total_items = count($data); // total items
$total_pages = ceil($total_items / $limit);
$final = array_splice($data, $offset, $limit); // splice them according to offset and limit
//echo '<pre>';print_r($final);echo '</pre>';
//$final = $data;



if($pricefilter==2){
    usort($final, function ($item1, $item2) {
        return $item1['rent_price'] <=> $item2['rent_price'];
    });
}elseif($pricefilter==1){
    usort($final, function ($item1, $item2) {
        return $item2['rent_price'] <=> $item1['rent_price'];
    });
}





//$final = array_splice($raw_data, $offset, $limit); // splice them according to offset and limit

/*

   foreach($final as $_newfinal){
       echo '<pre>';print_r($_newfinal);echo '</pre>';
   }
*/
// echo '$total_pages = '.$total_pages ;
?>

<style>
.paginationjs .paginationjs-pages li.active {
    border: 1px solid white;
}
.paginationjs {
    display: flex;
    justify-content: center;
}


/*.loader {  color: #e6be6e;  font-size: 90px;  text-indent: -9999em;  overflow: hidden;  width: 1em;  height: 1em;  border-radius: 50%;  margin: 72px auto;  position: relative;  -webkit-transform: translateZ(0);  -ms-transform: translateZ(0);  transform: translateZ(0);  -webkit-animation: load6 1.7s infinite ease, round 1.7s infinite ease;  animation: load6 1.7s infinite ease, round 1.7s infinite ease;}*/
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


<br>
<br>
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
    <option value="list.php?id=<?php echo $product_id;?>&type=<?php echo $product_type;?>&pricefilter=1"<?php if(isset($_GET['pricefilter']) && $_GET['pricefilter']==1){ echo 'selected'; } ?>>Higher To Lower</option>
        <option value="list.php?id=<?php echo $product_id;?>&type=<?php echo $product_type;?>&pricefilter=2"<?php if(isset($_GET['pricefilter']) && $_GET['pricefilter']==2){ echo 'selected'; } ?>> Lower To Higher </option>
    </option>
</select>
						<hr style="width:100%;background:#ccc;">
					</div>
    </div>
</div>
</div>


<div class="container">


<div class="row rowFlexMargin wrapper">



    <?php foreach($final as $key => $value):

    // var_dump($value);
    ?>



<div class="col-xs-6 col-md-4 col-lg-3 ftco-animate fadeInUp ftco-animated product_col">
<div class="product">
  <a href="<? echo $value['link']; ?>" class="img-prod">
        <? echo $value['imageframe']; ?>
    </a>

<div class="text py-3 px-3">
<h3>
<a href="<? echo $value['link']; ?>"><? echo $value['product_name']; ?></a>
</h3>
<hr style="margin-top: 0rem; margin-bottom: 0.3rem;">
<div class="subpart">
<p style="display:block;">MRP  <? echo $value['cur_sym']. ' ' . $value['selling_price']; ?> </p>
<h6 style="color:red;    font-size: 13px; text-decoration: underline;font-weight: 700;">SKU : <a href="<? echo $value['link']; ?>"><? echo $value['sku']; ?></a>
</h6>
<div class="d-flex">
<div class="pricing">
<p class="price">
<span class="mr-2 price-dc">Rent <? echo $value['cur_sym']; ?> <strong><? echo $value['rent_price']; ?></strong>  for 3 Days</span>
<br>
<span class="price-sale">Deposit <? echo $value['cur_sym']; ?> <strong><? echo $value['deposite'];?></strong>
</span>
</p>
</div>
<div class="rating">
<p class="text-right">
<a href="#">
<span class="ion-ios-star-outline">
</span>
</a>
<a href="#">
<span class="ion-ios-star-outline">
</span>
</a>
<a href="#">
<span class="ion-ios-star-outline">
</span>
</a>
<a href="#">
<span class="ion-ios-star-outline">
</span>
</a>
<a href="#">
<span class="ion-ios-star-outline">
</span>
</a>
</p>
</div>
</div>
<div class="here">
<?php echo $value['booking']; ?>
</div>
</div>
</div>
</div>
</div>
    <?php endforeach; ?>

</div>

<div class="paginationjs">
<div class="paginationjs-pages">
<ul>
<li class="paginationjs-prev">
<a href="#" class="page_num">«</a>
</li>


<!-- print links -->
<?php

$active_page = $_GET['page'];

for($x = 1; $x <= $total_pages; $x++): ?>

<li class="paginationjs-page J-paginationjs-page active" data-num="1">
    <a href="<? echo $requesturi ; ?>&page=<?php echo $x; ?>" class="page_num" <? if($active_page==$x){ ?> style="background: #ca901d;"<? }?>>
        <? echo $x; ?>
    </a>
</li>
<?php endfor; ?>



<li class="paginationjs-next J-paginationjs-next" data-num="2" title="Next page">
<a  href="#">»</a>
</li>
</ul>
</div>
</div>
</div>







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
<? include('footer.php')?>
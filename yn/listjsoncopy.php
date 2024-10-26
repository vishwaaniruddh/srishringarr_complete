<?php

// include('db_connection.php');
include('config.php');

// include('../functions.php');
// $con = OpenCon();
// $con3 = OpenNewCon();
header('Content-Type: application/json');

$cur = $_SESSION['cur'];

// $get_id = $_REQUEST['id'];
$type = $get_type = $_REQUEST['type'];
$get_pricefilter = $_REQUEST['pricefilter'];
$pathmain ='https://yosshitaneha.com/';
    // $req_url = 'https://v6.exchangerate-api.com/v6/e19da6d8e3ff6d2c76ee44be/latest/USD';
// $req_url = 'https://v6.exchangerate-api.com/v6/d3c7c9bb78c86254d0f7470d/latest/USD';
// $response_json = file_get_contents($req_url);


function round_amount($amount){

    $round_num = substr( $amount, -2);
        if($round_num < 50 && $round_num!=00 ){
            $add_amount = 50 - $round_num;

        }
        if($round_num > 50 && $round_num != 00 ){
            $add_amount = 100 - $round_num;
        }
    $new_amount = $amount + $add_amount;

    return $new_amount;
}





$get_id = $_POST['id'];
$get_id = explode(',',$get_id);
$get_id=json_encode($get_id);

$get_id=str_replace( array('[',']','"') , ''  , $get_id);
$get_id=explode(',',$get_id);
$get_id = "'" . implode ( "', '", $get_id )."'";







function get_booking_status($prcode) {
    global $con3;

    $sql = mysqli_query($con3,"select * from order_detail where item_id ='".$prcode."' order by bill_id desc");
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

$todaysdt=date("Y-m-d");

// print_r($prcode);

if (isset($_REQUEST['pageno'])) {
        $pageno = $_REQUEST['pageno'];
    } else {
        $pageno = 1;
    }

    $no_of_records_per_page = 20;
    $offset = ($pageno-1) * $no_of_records_per_page;

    if($type=="1") {
        $total_pages_sql = "SELECT count(*) FROM `product` WHERE `subcat_id`='".$subcatid."'";
    } else if($type="2"){
        $total_pages_sql = "select count(*) from  `garment_product` where product_for='".$maincatid."' and  gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0)";
    }

    $result = mysqli_query($con,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);

        if($type=="2"){
            $sql_count = mysqli_query($con,"select count(product_for)  as count_a from `garment_product` where product_for in ($get_id) and gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0)");
            $sql_count = mysqli_fetch_assoc($sql_count);
            $product_count =  $sql_count['count_a'];
            $statement = "select gproduct_id, gproduct_image, gproduct_code, gproduct_name, gproduct_desc, date_added, garment_id, product_for, sales_price, rent_price, itemid, product_new_imageid, deposit, facebook, Instagram, Google, Twitter, Pinterest, flipkart, amazon, size_avail, discount, total_amt, status, seen_count, is_customized, is_color_same, is_pattern_same, is_piece_same, short_desc, suggested_products, cgst, sgst, igst, brand_color, youtube, CAST(REGEXP_SUBSTR(gproduct_code,'[0-9]+') AS UNSIGNED) as sku from `garment_product` where product_for in($get_id) and gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0) order by sku desc";
            $sql = mysqli_query($con,$statement);
        }else{
            $sql_count = mysqli_query($con,"select count(product_id)  as count_a from `product` where subcat_id in($get_id)");
            $sql_count = mysqli_fetch_assoc($sql_count);
            $product_count =  $sql_count['count_a'];
            $statement = "select product_id, product_image, product_code, product_name, product_desc, date_added, categories_id, subcategory, subcat_id, maincatagory, subcatagoty, sales_price, rent_price, itemid, product_new_imageid, deposit, facebook, Instagram, Google, Twitter, Pinterest, flipkart, amazon, discount, total_amt, seen_count, is_customized, is_color_same, is_pattern_same, is_piece_same, cgst, sgst, igst, short_desc, brand_color, youtube,CAST(REGEXP_SUBSTR(product_code,'[0-9]+') AS UNSIGNED) as sku from `product` where subcat_id in($get_id) order by sku desc";
            $sql = mysqli_query($con,$statement);
        }


while($row = mysqli_fetch_array($sql)){

            if($type=="1"){
                $prcode=$row[2];
            }else{
                $prcode=$row[2];
            }

            $product_name = $row[3];
            $discount = $row[21];

             if($type=="1"){
                 $youtube = $row[35];
             }elseif($type=="2"){
                 $youtube = $row[35];
             }


        $re = mysqli_query($con3,"SELECT unit_price,cost_price,quantity FROM phppos_items where name like '".$prcode."'");
        $rero=mysqli_fetch_row($re);

        $qty=round($rero[2]);

        if($qty > 0 ){


        $re1 = mysqli_query($con3,"select sum(commission_amt) from order_detail where item_id='".$prcode."' and bill_id in(select bill_id from phppos_rent where booking_status!='Booked')");
        $rero1=mysqli_fetch_row($re1);
        $currentsp=$rero[0]-$rero1[0];
        $splimit=$rero[1]*0.8;

                    if($currentsp>$splimit)
                    $newsp=$currentsp;
                    else
                    $newsp=$splimit;


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
                        }
                        else
                        {
                            $sqlimg="SELECT img_name FROM `product_images_new` WHERE `gproduct_id`='".$row[0]."'";
                              if($newsp<=40000)
                                $rentprice=$newsp*0.20;
                            else if($newsp<=60000)
                                $rentprice=$newsp*0.17;
                            else
                                $rentprice=$newsp*0.15;



                               if($newsp<=10000){
                                   $courier = 750;
                               }else {
                                   $courier = 1000;
                               }

                            if($rentprice<1500){
                                $rentprice  =1500;

                            }
                        }

                        $deposit = intval($newsp*0.35);
                        // $final_deposit = round_amount($deposit);
                        $qryimg = mysqli_query($con,$sqlimg);
                        $rowimg = mysqli_fetch_row($qryimg);
                        if($youtube){


                                $ytarray=explode("/", $youtube);
                                $ytendstring=end($ytarray);
                                $ytendarray=explode("?v=", $ytendstring);
                                $ytendstring=end($ytendarray);
                                $ytendarray=explode("&", $ytendstring);
                                $ytcode=$ytendarray[0];
                                $imgframe =  "<iframe title=\"\" width=\"100%\" height=\"315\" src=\"https://www.youtube.com/embed/$ytcode\" autoplay=\"0\"  frameborder=\"0\" allowfullscreen></iframe>";

                        }
                        else if($rowimg[0]){
                        $path = trim($pathmain."uploads".$rowimg[0]);

                        $source_img = trim("yn/uploads".$rowimg[0]);
                            $filename = basename($source_img);

                            $_file_parent = "https://srishringarr.com/";
                            $_new_filename = $_file_parent.$source_img;
                            // $destination_img = 'comimage/com_'.$filename;
                            if(!file_exists($_new_filename)){
                               $destination_img =  $path;
                            }else{
                                $destination_img =  str_replace($filename,'',$source_img) .'com_'.$filename;
                            }
                            $imgframe = '<img class="lazyload img-fluid product_img" style="width: 100%; object-fit: contain; user-select: auto;" data-src="' . $destination_img . '">';

                        }else{
                        // $path='';
                        }

                        $rentprice = round_amount($rentprice+$courier);



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

                        $link = "detail.php?id=$row[0]&type=$type";
                        $selling_price = $rero[0] ;
                        $cur_sym = $currency_symbol;


                        $cur_sql = "select * from conversion_rates where currency ='".$currency."'";
                        $sql1 = mysqli_query($con,"select * from conversion_rates where currency ='".$currency."'");
                        $sql1_result = mysqli_fetch_assoc($sql1);
                        $rate = $sql1_result['rate'];
                        $newmoney = $rate*$selling_price ;
                        $selling_price  = $newmoney ;
                        $final_deposit = $rate*$final_deposit ;


$data[] = ['1'=>$source_img,'com_image'=>$destination_img, 'pid'=>$row[0],'symbol'=>$currency_symbol, 'product_name'=>$product_name,'cur_sym'=>$cur_sym,'selling_price'=>$selling_price,'rent_price'=>$rentprice,'image'=>$path,'sku'=>$prcode,'deposit'=>$final_deposit,'discount'=>$discount,'link'=>$link,'statement'=>$statement,'cur_sql'=>$cur_sql,'imageframe'=>$imgframe];
    }
}

if(isset($_REQUEST['pricefilter'])){
    if($get_pricefilter==1){
        function pricesort($a, $b) {
            return $b['selling_price'] - $a['selling_price'];
        }
    }
    elseif($get_pricefilter==2){
            function pricesort($a, $b) {
                return  $a['selling_price'] - $b['selling_price'];
            }
    }else{
         function pricesort($a, $b) {
                return  $a['selling_price'] - $b['selling_price'];
            }
    }

    if(count($data)!= 0){
    usort($data, 'pricesort');
    $data = array_slice($data, 0, $product_count);
    }
}

/*
if(isset($_REQUEST['pricefilter'])){
    if($get_pricefilter==1){
        function pricesort($a, $b) {
if ($a['rent_price']==$b['rent_price']) return 0;
            return ($a['rent_price']>$b['rent_price'])?-1:1;
        }
    }
    elseif($get_pricefilter==2){
            function pricesort($a, $b) {
                if ($a['rent_price']==$b['rent_price']) return 0;
                return ($a['rent_price']<$b['rent_price'])?-1:1;
            }
    }

    if(count($data)!= 0){
    usort($data, 'pricesort');
    // $data = array_slice($data, 0, $product_count);
    }
}
*/



if($data){
echo json_encode($data);
}
else{
    echo json_encode('0');
}
?>

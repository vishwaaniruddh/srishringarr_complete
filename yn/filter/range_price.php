<?php include('../config.php');
// include('../../functions.php');
header('Content-Type: application/json');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


$cur = $_SESSION['cur'];

$get_id = $_REQUEST['id'];
$type = $get_type = $_REQUEST['type'];

$pathmain ='http://yosshitaneha.com/';


$req_url = 'https://v6.exchangerate-api.com/v6/d3c7c9bb78c86254d0f7470d/latest/USD';
$response_json = file_get_contents($req_url);


// $discountfilter = $_REQUEST['discountfilter'];

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



if($type==2){
    $sql_count = mysqli_query($con,"select count(product_for)  as count_a from `garment_product` where product_for='".$get_id."' and gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0)");
    $sql_count = mysqli_fetch_assoc($sql_count);
    $product_count =  $sql_count['count_a'];
    $statement = "select gproduct_id, gproduct_image, gproduct_code, gproduct_name, gproduct_desc, date_added, garment_id, product_for, sales_price, rent_price, itemid, product_new_imageid, deposit, facebook, Instagram, Google, Twitter, Pinterest, flipkart, amazon, size_avail, discount, total_amt, status, seen_count, is_customized, is_color_same, is_pattern_same, is_piece_same, short_desc, suggested_products, cgst, sgst, igst, brand_color, youtube, CAST(REGEXP_SUBSTR(gproduct_code,'[0-9]+') AS UNSIGNED) as sku from `garment_product` where product_for='".$get_id."' and gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0) order by sku desc";
    $sql = mysqli_query($con,$statement);
}else{
    $sql_count = mysqli_query($con,"select count(product_id)  as count_a from `product` where subcat_id='".$get_id."'");
    $sql_count = mysqli_fetch_assoc($sql_count);
    $product_count =  $sql_count['count_a'];
    $statement = "select product_id, product_image, product_code, product_name, product_desc, date_added, categories_id, subcategory, subcat_id, maincatagory, subcatagoty, sales_price, rent_price, itemid, product_new_imageid, deposit, facebook, Instagram, Google, Twitter, Pinterest, flipkart, amazon, discount, total_amt, seen_count, is_customized, is_color_same, is_pattern_same, is_piece_same, cgst, sgst, igst, short_desc, brand_color, youtube,CAST(REGEXP_SUBSTR(product_code,'[0-9]+') AS UNSIGNED) as sku from `product` where subcat_id='".$get_id."' order by sku desc"; 
    $sql = mysqli_query($con,$statement);
}

$data = []; 
$i=1 ; 
while($row = mysqli_fetch_array($sql)){
    
            if($type=="1"){
            $prcode=$row[2];
            }else{
            $prcode=$row[2];
            }
            
            $product_name = $row[3];
            $discount = $row[21];

    $i++;
        $re = mysqli_query($con3,"SELECT unit_price,quantity FROM phppos_items where name like '".$prcode."' order by unit_price ASC");
        $rero=mysqli_fetch_row($re);
        $qty=$rero[1];
        $qty = round($qty);
        if($qty>0){
            
        

$selling_price = $rero[0] ;

if(false !== $response_json) {
        $response = json_decode($response_json);
        if('success' === $response->result) {
            
            $base_price = 1; // Your price in USD
            // $EUR_price = round(($base_price * $response->conversion_rates->EUR), 2);
            $INR_price = round(($base_price * $response->conversion_rates->INR), 2);
            
            $dol_selling_price = round($rero[0] / $INR_price ,2 ) ;
            $dol_rent_price = round($rentprice / $INR_price ,2 ) ;
            $dol_final_deposit = round($final_deposit / $INR_price ,2 ) ;
            
            if($cur=='USD'){
                $selling_price = $dol_selling_price;
                $rent_price = $dol_rent_price ;
                $final_deposit = $dol_final_deposit ;
            }


        }
}
    
    $data[] = $selling_price;
}
}

sort($data);

$min_price = $data[0];
$max_price = end($data);


// $min_price = round($min_price);
// $max_price = round($max_price);


$data2 = ['start'=>$min_price,'end'=>$max_price];

if($data2){
echo json_encode($data2);    
}
else{
    echo json_encode('0');
}    
?>

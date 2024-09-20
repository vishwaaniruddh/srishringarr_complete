<?php include('config.php');
// header('Content-Type: application/json');

$cur = $_SESSION['cur'];

$type = $get_type = $_REQUEST['type'];
$maincatid = $get_id = $_REQUEST['id'];
$get_pricefilter = $_REQUEST['pricefilter'];
$pathmain ='https://yosshitaneha.com/';
$todaysdt=date("Y-m-d");

$get_id = explode(',',$get_id);
$get_id=json_encode($get_id);
$get_id=str_replace( array('[',']','"') , ''  , $get_id);
$get_id=explode(',',$get_id);
$get_id = "'" . implode ( "', '", $get_id )."'";


// $alljewel = [1,6,3,68,4,57,52,77,80,74,59,78,75,79,76,60,56,63,65,66,67,69,70,72,73] ; 

$alljewel = [5,8,10,27,28,22,29] ; 

foreach($alljewel as $k=>$v){
            // $statement = "select product_id, product_image, product_code, product_name, product_desc, date_added, categories_id, subcategory, subcat_id, 
            // maincatagory, subcatagoty, sales_price, rent_price, itemid, product_new_imageid, deposit, facebook, Instagram, Google, Twitter, Pinterest, flipkart,
            // amazon, discount, total_amt, seen_count, is_customized, is_color_same, is_pattern_same, is_piece_same, cgst, sgst, igst, short_desc, brand_color, 
            // youtube,CAST(REGEXP_SUBSTR(product_code,'[0-9]+') AS UNSIGNED) as sku from `product` where subcat_id in($v) order by sku desc";
            // $sql = mysqli_query($con,$statement);
            
             $statement = "select gproduct_id, gproduct_image, gproduct_code, gproduct_name, gproduct_desc, date_added, garment_id, product_for, sales_price, 
             rent_price, itemid, product_new_imageid, deposit, facebook, Instagram, Google, Twitter, Pinterest, flipkart, amazon, size_avail, discount, total_amt,
             status, seen_count, is_customized, is_color_same, is_pattern_same, is_piece_same, short_desc, suggested_products, cgst, sgst, igst, brand_color, 
             youtube, CAST(REGEXP_SUBSTR(gproduct_code,'[0-9]+') AS UNSIGNED) as sku from `garment_product` where product_for in($v) and 
             gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0) order by sku desc";
            $sql = mysqli_query($con,$statement);
            
while($row = mysqli_fetch_array($sql)){
    
     $productNames[] = $row['gproduct_name'];
    $product_id[] = $row['gproduct_id'];
    

}
    
}


$productNameCounts = [];

$i = 0 ; 
// Iterate through the product names
foreach ($productNames as $productName) {
    // Convert the product name to camelCase and remove spaces
    $camelCaseName = str_replace(' ', '_', ucwords($productName));

    // Check if this product name has been encountered before
    if (isset($productNameCounts[$camelCaseName])) {
        // Increment the count and append it to the camelCase name
        $count = ++$productNameCounts[$camelCaseName];
        $ynProductName = $camelCaseName . $count;
    } else {
        // First occurrence, no need to append a count
        $productNameCounts[$camelCaseName] = 1;
        $ynProductName = $camelCaseName;
    }

    // Output the yn_productName
// echo $product_id[$i];
    echo " yn_productName: $ynProductName";
    echo "<br>";
    
    echo "update garment_product set yn_productName='".$ynProductName."' where gproduct_id='".$product_id[$i]."'";
    
    mysqli_query($con,"update garment_product set yn_productName='".$ynProductName."' where gproduct_id='".$product_id[$i]."'");
    $i++;
}

?>

<? include('./config.php');
header('Content-Type: application/json; charset=utf-8');
$get_id =  $_REQUEST['id'];

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


   if($all){
    $sql_query = "select product_id, product_image, product_code, product_name, product_desc, date_added, categories_id, subcategory, subcat_id, maincatagory, 
    subcatagoty, sales_price, rent_price, itemid, product_new_imageid, deposit, facebook, Instagram, Google, Twitter, Pinterest, flipkart, amazon, discount, 
    total_amt, seen_count, is_customized, is_color_same, is_pattern_same, is_piece_same, cgst, sgst, igst, short_desc, brand_color, youtube,
    CAST(REGEXP_SUBSTR(product_code,'[0-9]+') AS UNSIGNED) as sku,newProductName from `product` where subcat_id in($all) order by sku desc";
   }else{
    $sql_query = "select product_id, product_image, product_code, product_name, product_desc, date_added, categories_id, subcategory, subcat_id, maincatagory, 
    subcatagoty, sales_price, rent_price, itemid, product_new_imageid, deposit, facebook, Instagram, Google, Twitter, Pinterest, flipkart, amazon, discount, 
    total_amt, seen_count, is_customized, is_color_same, is_pattern_same, is_piece_same, cgst, sgst, igst, short_desc, brand_color, youtube,
    CAST(REGEXP_SUBSTR(product_code,'[0-9]+') AS UNSIGNED) as sku,newProductName from `product` where subcat_id='".$get_id."' order by sku desc";
   }

$raw_data = mysqli_query($con,$sql_query);
$i = 1;
$cur_sym = $currency_symbol;
while($row = mysqli_fetch_array($raw_data)){
    
        $product_id = $row[0];    
        $product_name = $row[3];
        $prcode=$row[2];
                
        $re = mysqli_query($con3,"SELECT unit_price,quantity FROM phppos_items where name like '".$prcode."'");
        $rero=mysqli_fetch_row($re);

        $qty=round($rero[1]);
        if($qty && $qty > 0){
            
            $link = "https://www.srishringarr.com/jewel_detail.php?id=$product_id&days=3";
            $newProductName = $row['newProductName'];
            if($newProductName){
                $link = 'https://www.srishringarr.com/jewel/'.$newProductName.'&days=3' ; 
            }
            $data[] = ['product_id'=>$product_id,'link'=>$link];
        }
}


echo json_encode($data);

?>
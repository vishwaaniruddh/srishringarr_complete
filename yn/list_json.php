<?php include('config.php');
header('Content-Type: application/json');

$cur = $_SESSION['cur'];

$type = $get_type = $_REQUEST['type'];
$maincatid = $get_id = $_REQUEST['id'];
$get_pricefilter = $_REQUEST['pricefilter'];
$pathmain ='https://srishringarr.com/yn/';
$todaysdt=date("Y-m-d");

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

$get_id = explode(',',$get_id);
$get_id=json_encode($get_id);
$get_id=str_replace( array('[',']','"') , ''  , $get_id);
$get_id=explode(',',$get_id);
$get_id = "'" . implode ( "', '", $get_id )."'";


function get_booking_status($sku) {
    global $con3;
    
    // echo "select * from order_detail where item_id ='".$sku."' order by bill_id desc";
    $sql = mysqli_query($con3,"select * from order_detail where item_id ='".$sku."' order by bill_id desc");
    $sql_result = mysqli_fetch_assoc($sql);
    $bill_id = $sql_result['bill_id'];
    if($bill_id>0){
        $status_sql = mysqli_query($con3,"select * from phppos_rent where bill_id ='".$bill_id."'");
        $status_sql_result = mysqli_fetch_assoc($status_sql);
        return 1 ; 
    }
    else{
        return 0;
    }

}


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
            $statement = "select gproduct_id, gproduct_image, gproduct_code, gproduct_name, gproduct_desc, date_added, garment_id, product_for, sales_price, 
            rent_price, itemid, product_new_imageid, deposit, facebook, Instagram, Google, Twitter, Pinterest, flipkart, amazon, size_avail, discount, total_amt, 
            status, seen_count, is_customized, is_color_same, is_pattern_same, is_piece_same, short_desc, suggested_products, cgst, sgst, igst, brand_color, youtube,
            CAST(REGEXP_SUBSTR(gproduct_code,'[0-9]+') AS UNSIGNED) as sku,yn_productName from `garment_product` where product_for in($get_id) and gproduct_id
            in(select gproduct_id from product_images_new where gproduct_id>0) order by sku desc";
            $sql = mysqli_query($con,$statement);
        }else{
            $sql_count = mysqli_query($con,"select count(product_id)  as count_a from `product` where subcat_id in($get_id)");
            $sql_count = mysqli_fetch_assoc($sql_count);
            $product_count =  $sql_count['count_a'];
            $statement = "select product_id, product_image, product_code, product_name, product_desc, date_added, categories_id, subcategory, subcat_id,
            maincatagory, subcatagoty, sales_price, rent_price, itemid, product_new_imageid, deposit, facebook, Instagram, Google, Twitter, Pinterest, flipkart,
            amazon, discount, total_amt, seen_count, is_customized, is_color_same, is_pattern_same, is_piece_same, cgst, sgst, igst, short_desc, brand_color,
            youtube,CAST(REGEXP_SUBSTR(product_code,'[0-9]+') AS UNSIGNED) as sku,yn_productName from `product` where subcat_id in($get_id) order by sku desc";
            $sql = mysqli_query($con,$statement);
        }
        


while($row = mysqli_fetch_array($sql)){

$isRentProduct = 0 ; 
            if($type=="1"){
                $prcode=$row[2];
            }else{
                $prcode=$row[2];
            }

            $product_name = $row[3];
            $discount = $row['discount'];

             if($type=="1"){
                 $youtube = $row[35];
             }elseif($type=="2"){
                 $youtube = $row[35];
             }


        $re = mysqli_query($con3,"SELECT unit_price,cost_price,quantity FROM phppos_items where name like '".$prcode."'");
        $rero=mysqli_fetch_row($re);
        
        $check_detail_sql = mysqli_query($con3,"select * from order_detail where item_id='".$prcode."'");
        if($check_detail_sql_result = mysqli_fetch_assoc($check_detail_sql)){
            $isRentProduct=1 ; 
        }else{
            $isRentProduct=0 ;
        }

        $qty=round($rero[2]);
        
        
    
          
            
            
        if($qty > 0 && $isRentProduct==0 ){
            // 
if($maincatid=='5' && $type=='2'){
    
            
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
                            $booking_status = get_booking_status($prcode);
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
                            $imgframe = '<img class="lazyload img-fluid product_img"  alt="'.$product_name.'" style="width: 100%; object-fit: cover; user-select: auto;border: 1px solid gray;border-radius: 10px;padding: 15px;" data-src="//images.weserv.nl/?url='.$destination_img.'&w=400&h=300">';

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
                        
                        $newProductName = $row['yn_productName'];
                            if($newProductName){
                                if($type==1){
                                    $link = 'jewel/'.$newProductName ; 
                                }else{                                    
                                    $link = 'apparel/'.$newProductName ; 
                                }
                            }
                            
                        $selling_price = $rero[0] ;
                        $cur_sym = $currency_symbol;


                        $cur_sql = "select * from conversion_rates where currency ='".$currency."'";
                        $sql1 = mysqli_query($con,"select * from conversion_rates where currency ='".$currency."'");
                        $sql1_result = mysqli_fetch_assoc($sql1);
                        $rate = $sql1_result['rate'];
                        $newmoney = $rate*$selling_price ;
                        $selling_price  = $newmoney ;
                        $final_deposit = $rate*$final_deposit ;
                        
                        
                        // Final Amount With Discount
                        
                        $discount; // In Percentage 
                        
                        if($discount > 0){
                            $discount_amount = $selling_price * ($discount/100);
                            $final_selling_price = $selling_price - $discount_amount ;                            
                        }else{
                            $final_selling_price = $selling_price ; 
                        }

                        
                        
if($type=="2"){
    if($booking_status == 1){
            
    }else{
        $data[] = ['booking_status'=>$booking_status,'1'=>$source_img,'com_image'=>$destination_img, 'pid'=>$row[0],'symbol'=>$currency_symbol, 'product_name'=>$product_name,'cur_sym'=>$cur_sym,'selling_price'=>$final_selling_price,'actual_price'=>$selling_price,'rent_price'=>$rentprice,'image'=>$path,'sku'=>$prcode,'deposit'=>$final_deposit,'discount'=>$discount,'link'=>$link,'statement'=>$statement,'cur_sql'=>$cur_sql,'imageframe'=>$imgframe,'qty'=>$qty,'discount_amount'=>$discount_amount];
    }
            
}elseif($type=="1"){
    
    $data[] = ['1'=>$source_img,'com_image'=>$destination_img, 'pid'=>$row[0],'symbol'=>$currency_symbol, 'product_name'=>$product_name,'cur_sym'=>$cur_sym,'selling_price'=>$final_selling_price,'actual_price'=>$selling_price,'rent_price'=>$rentprice,'image'=>$path,'sku'=>$prcode,'deposit'=>$final_deposit,'discount'=>$discount,'link'=>$link,'statement'=>$statement,'cur_sql'=>$cur_sql,'imageframe'=>$imgframe,'qty'=>$qty,'discount_amount'=>$discount_amount];

    
}

            

    
}

            $re1 = mysqli_query($con3,"select sum(commission_amt) from order_detail where item_id='".$prcode."' and bill_id 
            in(select bill_id from phppos_rent where booking_status!='Booked')");
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
                            $booking_status = get_booking_status($prcode);
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
                            $imgframe = '<img class="lazyload img-fluid product_img"  alt="'.$product_name.'" style="width: 100%; object-fit: cover; user-select: auto;border: 1px solid gray;border-radius: 10px;padding: 15px;" data-src="//images.weserv.nl/?url='.$destination_img.'&w=400&h=300">';


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
                        
                         $newProductName = $row['yn_productName'];
                            if($newProductName){
                                if($type==1){
                                    $link = 'jewel/'.$newProductName ; 
                                }else{                                    
                                    $link = 'apparel/'.$newProductName ; 
                                }
                            }
        
        
                        $selling_price = $rero[0] ;
                        $cur_sym = $currency_symbol;


                        $cur_sql = "select * from conversion_rates where currency ='".$currency."'";
                        $sql1 = mysqli_query($con,"select * from conversion_rates where currency ='".$currency."'");
                        $sql1_result = mysqli_fetch_assoc($sql1);
                        $rate = $sql1_result['rate'];
                        $newmoney = $rate*$selling_price ;
                        $selling_price  = $newmoney ;
                        $final_deposit = $rate*$final_deposit ;
                        
                        
                        // Final Amount With Discount
                        
                        $discount; // In Percentage 
                        
                        if($discount > 0){
                            $discount_amount = $selling_price * ($discount/100);
                            $final_selling_price = $selling_price - $discount_amount ;                            
                        }else{
                            $final_selling_price = $selling_price ; 
                        }

$final_selling_price = round($final_selling_price,2);
                        
                        
if($type=="2"){
    if($booking_status == 1){
            $data[] = ['1'=>$source_img,'booking_status'=>$booking_status,'com_image'=>$destination_img, 'pid'=>$row[0],
            'symbol'=>$currency_symbol, 'product_name'=>$product_name,'cur_sym'=>$cur_sym,'selling_price'=>$final_selling_price,
            'actual_price'=>$selling_price,'rent_price'=>$rentprice,'image'=>$path,'sku'=>$prcode,'deposit'=>$final_deposit,'discount'=>$discount,
            'link'=>$link,'cur_sql'=>$cur_sql,'imageframe'=>$imgframe,'qty'=>$qty,'discount_amount'=>$discount_amount];
    }else{
        $data[] = ['1'=>$source_img,'booking_status'=>$booking_status,'com_image'=>$destination_img, 'pid'=>$row[0],'symbol'=>$currency_symbol,
        'product_name'=>$product_name,'cur_sym'=>$cur_sym,'selling_price'=>$final_selling_price,'actual_price'=>$selling_price,'rent_price'=>$rentprice,
        'image'=>$path,'sku'=>$prcode,'deposit'=>$final_deposit,'discount'=>$discount,'link'=>$link,'cur_sql'=>$cur_sql,
        'imageframe'=>$imgframe,'qty'=>$qty,'discount_amount'=>$discount_amount];
    }
} else if($type=="1"){
    $data[] = ['1'=>$source_img,'statement'=>$statement,'com_image'=>$destination_img, 'pid'=>$row[0],'symbol'=>$currency_symbol, 'product_name'=>$product_name,'cur_sym'=>$cur_sym,
    'selling_price'=>$final_selling_price,'actual_price'=>$selling_price,'rent_price'=>$rentprice,'image'=>$path,'sku'=>$prcode,'deposit'=>$final_deposit,
    'discount'=>$discount,'link'=>$link,'cur_sql'=>$cur_sql,'imageframe'=>$imgframe,'qty'=>$qty,'discount_amount'=>$discount_amount];
}

        }

            

    // }
    
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


// Assuming $data is your original array
if ($data) {
    // Define a custom sorting function to sort alphanumeric strings
    function alphanumericSort($a, $b) {
        return strnatcmp($b['sku'], $a['sku']); // Sort in descending order
    }

    // Initialize an empty array to store unique entries
    $uniqueData = array();

    // Iterate through the original array
    foreach ($data as $item) {
        // Use "sku" value as the key for the new array
        $uniqueData[$item['sku']] = $item;
    }

    // Sort the unique array using the custom sorting function
    uasort($uniqueData, 'alphanumericSort');

    // Encode the sorted and unique array as JSON and echo
    echo json_encode(array_values($uniqueData));
} else {
    // If $data is empty, echo '0'
    echo json_encode('0');
}

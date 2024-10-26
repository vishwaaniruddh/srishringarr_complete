<? include('config.php');
header('Content-Type: application/json; charset=utf-8');


function round_amount($amount){
$amount = (int)$amount;
$add_amount = 0;

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

$pathmain = 'https://srishringarr.com/yn/';

$sku = $_REQUEST['sku'];
$sql = mysqli_query($con3,"select * from order_detail where item_id like '".$sku."'");
while($sql_result = mysqli_fetch_assoc($sql)){
    $bill_id[] = $sql_result['bill_id'];
}

$bill_id=json_encode($bill_id);
$bill_id=str_replace( array('[',']','"') , ''  , $bill_id);
$arr=explode(',',$bill_id);
$bill_id = "'" . implode ( "', '", $arr )."'";

$skus = array() ;

$sql = mysqli_query($con3,"select * from order_detail where bill_id in ($bill_id) and item_id<> '".$sku."'");
while($sql_result = mysqli_fetch_assoc($sql)){
        $skus[] = trim($sql_result['item_id']);
}
if($skus){

$skus = array_unique($skus);
$sku_s = implode(', ',$skus);
$choices = explode(",", $sku_s);

$ids = '';
foreach($choices as $choice){
    $ids .= "'".trim($choice)."',";

}
$sku_id = rtrim($ids,",");


$sql_query = "select *, CAST(REGEXP_SUBSTR(gproduct_code,'[0-9]+') AS UNSIGNED) as sku from `garment_product` where gproduct_code in($sku_id) group by gproduct_code order by gproduct_id desc;
";
$raw_data = mysqli_query($con,$sql_query);
$i = 1;
$cur_sym = $currency_symbol;
while($row = mysqli_fetch_array($raw_data)){
        $deposit = 0;
        $product_id = $row[0];    
        $prcode=$row[2];
        $sku = $prcode;
        $product_name = $row[3];
        $product_name = str_ireplace("buy", "Rent", $product_name);
        $discount = $row[21];
        $youtube = $row[35];
        
        $re = mysqli_query($con3,"SELECT unit_price,quantity FROM phppos_items where name like '".$prcode."'");
        $rero=mysqli_fetch_row($re);
        
        $re1 = mysqli_query($con3,"select sum(commission_amt) from order_detail where item_id='".$prcode."' and 
        bill_id in(select bill_id from phppos_rent where booking_status!='Booked')");
        $rero1=mysqli_fetch_row($re1);
        

        $qty=round($rero[1]);
        if($qty && $qty > 0){
            $mrp = $unitPrice = $rero[0];
            $commissionAmount = $rero1[0] ;
            $currentsp = $unitPrice - $commissionAmount ;   
        
        
        if($currentsp > 0 ) {
                            if($mrp<=10000){
                               $courier = 1000;
                               $rentprice=$mrp*0.20;
                               $addedRentPrice = $courier + $rentprice ;
                               $deposit = $mrp * 0.35 ;
                            }else {
                               $courier = 2000;
                                if($currentsp<=40000){
                                    $rentprice=$currentsp*0.20; 
                                } else if($currentsp<=60000){
                                    $rentprice=$currentsp*0.17; 
                                } else{
                                    $rentprice=$currentsp*0.15; 
                                }
                                $addedRentPrice = $courier + $rentprice ;
                                if($addedRentPrice < 3000){
                                    $addedRentPrice = 3000 ; 
                                }
                                
                                $deposit = $currentsp * 0.35 ; 
                                    if($deposit<3000){
                                        $deposit = 3000 ; 
                                    }
                                    
                                
                            }
                            
                            
        
        
        // sku = YNL027
        // Unit Price = 26000.00
        // commission_amt = 22000  === rent amount
        // currentsp = mrp Price - rent amount = 4000 (35% deposite)
        // rentprice = currentsp * 0.20 = 800
        // echo 'rent price  = ' . $courier .  '+' . $rentprice . ' = ' . round_amount($addedRentPrice) .'<br>' ;
        }
        else{
                            if($mrp<=10000){
                               $courier = 1000;
                               $rentprice=$mrp*0.20;
                               $addedRentPrice = $courier + $rentprice ;
                               $deposit = $mrp * 0.35 ;
                            }else{
                                $deposit = 3000 ;
                                $addedRentPrice = 3000 ;                                 
                            }   
         }
        
        $deposit =  round_amount($deposit);  
        $addedRentPrice = round_amount($addedRentPrice) ; 
        
        
        
            $sqlimg="SELECT img_name FROM `product_images_new` WHERE `gproduct_id`='".$product_id."'";
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
                    $destination_img =  str_replace($filename,'',$source_img) .'com_'.$filename;
                }
                $imgframe = '<img class="lazyload img-fluid product_img" loading="lazy" style="width: 100%; object-fit: contain; user-select: auto;" src="//images.weserv.nl/?url='.$destination_img.'&w=400&h=300">';
            }
            

                $link = "apparel_detail.php?id=$product_id&type=2&days=3";
            
            
        $data[] = ['product_name'=>$product_name, 'mrp'=>$mrp,'addedRentPrice'=>$addedRentPrice,'imgframe'=>$imgframe,'sku'=>$sku,'deposit'=>$deposit,
        'discount'=>$discount,'link'=>$link];
            
        }
                            
}






$sql_query = "select product_id, product_image, product_code, product_name, product_desc, date_added, categories_id, subcategory, subcat_id, maincatagory, 
subcatagoty, sales_price, rent_price, itemid, product_new_imageid, deposit, facebook, Instagram, Google, Twitter, Pinterest, flipkart, amazon, discount, 
total_amt, seen_count, is_customized, is_color_same, is_pattern_same, is_piece_same, cgst, sgst, igst, short_desc, brand_color, youtube,
CAST(REGEXP_SUBSTR(product_code,'[0-9]+') AS UNSIGNED) as sku from `product` where product_code in($sku_id)";


$raw_data = mysqli_query($con,$sql_query);
$i = 1;
$cur_sym = $currency_symbol;
while($row = mysqli_fetch_array($raw_data)){
        

        
        $deposit = 0;
        $product_id = $row[0];    
        $prcode=$row[2];
        $sku = $prcode;
        $product_name = $row[3];
        $product_name = str_ireplace("buy", "Rent", $product_name);
        
        $discount = $row[21];
        $youtube = $row[35];
        
        $re = mysqli_query($con3,"SELECT unit_price,quantity FROM phppos_items where name like '".$prcode."'");
        $rero=mysqli_fetch_row($re);
        
        $re1 = mysqli_query($con3,"select sum(commission_amt) from order_detail where item_id='".$prcode."' and 
        bill_id in(select bill_id from phppos_rent where booking_status!='Booked')");
        $rero1=mysqli_fetch_row($re1);
        

        $qty=round($rero[1]);
        if($qty && $qty > 0){
            $mrp = $unitPrice = $rero[0];
            $commissionAmount = $rero1[0] ;
            $currentsp = $unitPrice - $commissionAmount ;   
        
        // echo ' MRP = ' . $mrp . '<br>';  
        // echo ' commission Amount = ' . $commissionAmount . '<br>'; 
        // echo ' Current Special Price = '.$currentsp . '<br>'; 
        
        
        if($mrp<=2000){
                $courier = 100;
           }else if($mrp<=5000){
               $courier = 250;
           }else if($mrp<=10000){
               $courier = 500;
           }else{
               $courier = 1000;
           }
           
           
        
        if($currentsp > 0 ) {
            if($mrp<=10000){
                $rentprice=$mrp*0.20;
                $addedRentPrice = $courier + $rentprice ;
                $deposit = $mrp * 0.35 ;
            }else {
                if($currentsp<=40000){
                    $rentprice=$currentsp*0.20;
                    // echo 'rentprice = currentsp * 0.20 = ' . $rentprice .'<br>';
                    } else if($currentsp<=60000){
                        $rentprice=$currentsp*0.17;
                        // echo 'rentprice = currentsp * 0.17 = ' . $rentprice .'<br>';
                        } else{
                            $rentprice=$currentsp*0.15;
                            // echo 'rentprice = currentsp * 0.15 = ' . $rentprice.'<br>' ;
                            }
                            $addedRentPrice = $courier + $rentprice ;
                            if($addedRentPrice < 3000){
                                $addedRentPrice = 3000 ;
                            }
                            $deposit = $currentsp * 0.35 ;
                            if($deposit<3000){
                                $deposit = 3000 ;
                            }
            }
        }
        else{
            if($mrp<=10000){
                $rentprice=$mrp*0.20;
                $addedRentPrice = $courier + $rentprice ;
                $deposit = $mrp * 0.35 ;
            }else{
                $deposit = 3000 ;
                $addedRentPrice = 3000 ;
            }   
         }
    
        $deposit =  round_amount($deposit);  
        $addedRentPrice = round_amount($addedRentPrice) ; 
        
        
        
            $sqlimg="SELECT img_name FROM `product_images_new` WHERE `product_id`='".$product_id."'";
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
                    $destination_img =  str_replace($filename,'',$source_img) .'com_'.$filename;
                }
                $imgframe = '<img class="lazyload img-fluid product_img" loading="lazy" style="width: 100%; object-fit: contain; user-select: auto;" src="//images.weserv.nl/?url='.$destination_img.'&w=400&h=300">';
            }
        

                $link = "jewel_detail.php?id=$product_id&type=1&days=3";
            
            
        $data[] = ['product_name'=>$product_name, 'mrp'=>$mrp,'addedRentPrice'=>$addedRentPrice,'imgframe'=>$imgframe,'sku'=>$sku,'deposit'=>$deposit,
        'discount'=>$discount,'link'=>$link,'courier'=>$courier];
            
        }
                            
}


echo json_encode($data);

    
}
?>
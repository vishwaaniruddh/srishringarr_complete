<? include('config.php');
include('functions.php');
header('Content-Type: application/json');


$get_id = $_REQUEST['id'];
$type = $get_type = $_REQUEST['type'];


// $get_id = 3; 
// $type =1;


$get_pricefilter = $_REQUEST['pricefilter'];
$pathmain ='http://yosshitaneha.com/';
$viewall = $_REQUEST['viewall'];




if($get_id==0 && $get_type==1 && $viewall == 4 ){
 
 $all = "'2','1','6','3','68','4'";    
}

if($get_id==0 && $get_type==1 && $viewall == 76 ){
 
 $all = "'59','74','75','76','77','78','79','80'";    
}



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

$todaysdt=date("Y-m-d");


if (isset($_REQUEST['pageno'])) {
        $pageno = $_REQUEST['pageno'];
    } else {
        $pageno = 1;
    }

    $no_of_records_per_page = 20;
    $offset = ($pageno-1) * $no_of_records_per_page;
    
    if($type=="1") {
        $total_pages_sql = "SELECT count(*) FROM `product` WHERE `subcat_id`='".$subcatid."'"; 
    } else if($type=2){
        $total_pages_sql = "select count(*) from  `garment_product` where product_for='".$maincatid."' and  gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0)";
    }
    
    $result = mysqli_query($conn,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    
    
    
    



if($type==2){
$sql_count = mysqli_query($con,"select count(product_for)  as count_a from `garment_product` where product_for='".$get_id."' and gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0)");
$sql_count = mysqli_fetch_assoc($sql_count);
$product_count =  $sql_count['count_a'];


$statement = "select gproduct_id, gproduct_image, gproduct_code, gproduct_name, gproduct_desc, date_added, garment_id, product_for, sales_price, rent_price, itemid, product_new_imageid, deposit, facebook, Instagram, Google, Twitter, Pinterest, flipkart, amazon, size_avail, discount, total_amt, status, seen_count, is_customized, is_color_same, is_pattern_same, is_piece_same, short_desc, suggested_products, cgst, sgst, igst, brand_color, youtube, CAST(REGEXP_SUBSTR(gproduct_code,'[0-9]+') AS UNSIGNED) as sku from `garment_product` where product_for='".$get_id."' and gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0) order by sku desc";

$sql = mysqli_query($con,$statement);
    
}elseif($type==1){
$sql_count = mysqli_query($con,"select count(product_id)  as count_a from `product` where subcat_id='".$get_id."'");
$sql_count = mysqli_fetch_assoc($sql_count);
$product_count =  $sql_count['count_a'];

 



if($all){
    
    $statement = "select product_id, product_image, product_code, product_name, product_desc, date_added, categories_id, subcategory, subcat_id, maincatagory, subcatagoty, sales_price, rent_price, itemid, product_new_imageid, deposit, facebook, Instagram, Google, Twitter, Pinterest, flipkart, amazon, discount, total_amt, seen_count, is_customized, is_color_same, is_pattern_same, is_piece_same, cgst, sgst, igst, short_desc, brand_color, youtube,CAST(REGEXP_SUBSTR(product_code,'[0-9]+') AS UNSIGNED) as sku from `product` where subcat_id in($all) order by sku desc";



    $sql = mysqli_query($con,$statement);
}else{

$statement = "select product_id, product_image, product_code, product_name, product_desc, date_added, categories_id, subcategory, subcat_id, maincatagory, subcatagoty, sales_price, rent_price, itemid, product_new_imageid, deposit, facebook, Instagram, Google, Twitter, Pinterest, flipkart, amazon, discount, total_amt, seen_count, is_customized, is_color_same, is_pattern_same, is_piece_same, cgst, sgst, igst, short_desc, brand_color, youtube,CAST(REGEXP_SUBSTR(product_code,'[0-9]+') AS UNSIGNED) as sku from `product` where subcat_id='".$get_id."' order by sku desc";



    $sql = mysqli_query($con,$statement);
}
    
}



// echo $statement; 
$i=1;
while($row = mysqli_fetch_array($sql)){
    
            if($type=="1"){
                $prcode=$row[2];
            }else{
                $prcode=$row[2];
            }
            
            $product_name = $row[3];
            $discount = $row[21];
            $youtube = $row[35];


    

        $re = mysqli_query($con3,"SELECT unit_price,cost_price,quantity FROM phppos_items where name like '".$prcode."'");
        $rero=mysqli_fetch_row($re);
        
        $qty=round($rero[2]);
        
        if($qty > 0 ){
        $re1 = mysqli_query($con3,"select sum(commission_amt) from order_detail where item_id='".$prcode."' and bill_id in(select bill_id from phppos_rent where booking_status!='Booked')");
        $rero1=mysqli_fetch_row($re1);
        $currentsp=$rero[0]-$rero1[0];
        $splimit=$rero[1]*0.8; 
        
        // if($currentsp>$splimit)
        $newsp=$currentsp;
        // else
        // $newsp=$splimit;
        

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
                               $rentprice = $rentprice  + $courier ;
                            
                            if($rentprice<2500){
                                $rentprice  =2500;

                            }
                        }  
                        
                        
                        
                        
                        $rentprice = intval($rentprice) ;  
                        
                        
                        
                        
                        
                        $deposit = intval($newsp*0.35);
                        // $final_deposit = round_amount($deposit);
                        $qryimg = mysqli_query($con,$sqlimg);
                        $rowimg = mysqli_fetch_row($qryimg);
                        
                        if($rowimg){
                            $path = trim($pathmain."uploads".$rowimg[0]);
                            $imgframe = '<img class="img-fluid product_img" style="width: 100%; object-fit: contain; user-select: auto;" src="' . $path . '">';
                        } else if($youtube){
                                
                                
                                $ytarray=explode("/", $youtube);
                                $ytendstring=end($ytarray);
                                $ytendarray=explode("?v=", $ytendstring);
                                $ytendstring=end($ytendarray);
                                $ytendarray=explode("&", $ytendstring);
                                $ytcode=$ytendarray[0];
                                $imgframe =  "<iframe width=\"100%\" height=\"315\" src=\"https://www.youtube.com/embed/$ytcode\" frameborder=\"0\" allowfullscreen></iframe>";
                        }else{

                        }
                        
                        
$rentprice = round_amount($rentprice);

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

$link = "detail.php?id=$row[0]&type=$type&days=3";


  $order_sql = mysqli_query($con3,"SELECT * FROM `order_detail` where `item_id`='".$row[2]."' and bill_id in(SELECT bill_id  FROM `phppos_rent` WHERE (`pick_date` >=".$todaysdt." or `delivery_date` >=".$todaysdt.") and booking_status!='Returned' ORDER BY `phppos_rent`.`pick_date` ASC) group by bill_id");
    $order_sql_result = mysqli_fetch_assoc($order_sql);
    
    $booking_billid = $order_sql_result['bill_id'];
    
    $booking_sql = mysqli_query($con3,"select * from phppos_rent where bill_id ='".$booking_billid."'") ; 
    $booking_sql_result = mysqli_fetch_assoc($booking_sql);
    
    $pick_date = $booking_sql_result['pick_date'];
    $delivery_date = $booking_sql_result['delivery_date'];
    $booking_status = $booking_sql_result['booking_status']; 
                            
                            
                            
                            
 if($pick_date!='' && $delivery_date!='' && $booking_status !='Returned') {
     
        $booking_date = '<div><span style="color:red;">Booking Status Dates</span> <br>'  .  date("d-m-Y", strtotime($pick_date)) .' - '. date("d-m-Y", strtotime($delivery_date)) . '</div>';
 }else{
     $booking_date ='' ; 
 }


// if(getDBrent($prcode,$type)>0){
//     $rentprice = getDBrent($prcode,$type); 
//     $rentprice = round_amount($rentprice+$courier);

// }
    
    $data[] = ['snno'=>$i,'product_name'=>$product_name,'selling_price'=>$rero[0],'rent_price'=>$rentprice,'image'=>$path,'sku'=>$prcode,'deposite'=>$final_deposit,'discount'=>$discount,'link'=>$link,'statement'=>'1', 'booking'=>$booking_date,'imageframe'=>$imgframe];                        
                            
                        // }
$i++;                            
        }

}

if(isset($_REQUEST['pricefilter'])){
    if($get_pricefilter==1){
        function pricesort($a, $b) {
            return $b['rent_price'] - $a['rent_price'];
        }
    }
    elseif($get_pricefilter==2){
            function pricesort($a, $b) {
                return  $a['rent_price'] - $b['rent_price'];
            }
    }
    
    if(count($data)!= 0){
    usort($data, 'pricesort');
    $data = array_slice($data, 0, $product_count);
    }    
}




// var_dump($data);


if($data){
echo json_encode($data);    
}
else{
    echo json_encode('0');
}    
?>

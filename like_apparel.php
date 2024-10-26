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



$category = $_REQUEST['id'];

$pathmain = 'https://srishringarr.com/yn/';

$sql_query = "select *, CAST(REGEXP_SUBSTR(gproduct_code,'[0-9]+') AS UNSIGNED) as sku from `garment_product` where product_for='".$category."' order by visitcount DESC LIMIT 10";

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
            

                $link = "apparel_detail.php?id=$product_id&days=3";
                
                $newProductName = $row['newProductName'];
                if($newProductName){
                    $link = 'apparel/'.$newProductName.'&days=3' ; 
                }
                
                
                
                $data[] = ['product_name'=>$product_name, 'mrp'=>$mrp,'addedRentPrice'=>$addedRentPrice,'imgframe'=>$imgframe,'sku'=>$sku,'deposit'=>$deposit,
                        'discount'=>$discount,'link'=>$link];
         
            
        }
                            
}


echo json_encode($data);

?>
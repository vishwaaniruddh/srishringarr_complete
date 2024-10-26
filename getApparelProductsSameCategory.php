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

$sql_query = "select *, CAST(REGEXP_SUBSTR(gproduct_code,'[0-9]+') AS UNSIGNED) as sku from `garment_product` where product_for='".$category."' 
order by sku DESC";

$raw_data = mysqli_query($con,$sql_query);
$i = 1;
$cur_sym = $currency_symbol;
while($row = mysqli_fetch_array($raw_data)){
        $product_id = $row[0];    
        $prcode=$row[2];
        $sku = $prcode;

        $re = mysqli_query($con3,"SELECT unit_price,quantity FROM phppos_items where name like '".$prcode."'");
        $rero=mysqli_fetch_row($re);
        

        $qty=round($rero[1]);
        if($qty && $qty > 0){
        
        
                $link = "https://www.srishringarr.com/apparel_detail.php?id=$product_id&days=3";
                $newProductName = $row['newProductName'];
                if($newProductName){
                    $link = 'https://www.srishringarr.com/apparel/'.$newProductName.'&days=3' ; 
                }
                
                
                
                $data[] = ['product_id'=>$product_id,'link'=>$link];
         
            
        }
                            
}


echo json_encode($data);

?>
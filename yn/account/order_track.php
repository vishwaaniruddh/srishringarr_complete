<? session_start();

include('../functions.php');
include('../config.php');


$userid=$_SESSION['gid'];




$cart = get_cart_ids($userid);


// var_dump($cart);

foreach($cart as $key => $val){
    
    $type = get_product_type_from_cart($val);
    $productid = get_product_id_from_cart($val);
    $sku  = get_sku($productid,$type);
  

if($sku){
    

    
    $quantity = get_cart_quantity($val);
    
    
    $sql      = mysqli_query($conn,"select * from order_track where userid='".$userid."' and sku='".$sku."'");
    $sql_result=mysqli_fetch_assoc($sql);
    
    if(!$sql_result){
        
        
        $sql=mysqli_query($conn,"insert into order_track(userid,sku,quantity) values('".$userid."','".$sku."','".$quantity."')");
    
        
    }

}    



    
}
?>
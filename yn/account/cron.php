<? include_once('../config.php');

include_once('../functions.php');



$sql=mysqli_query($conn,"SELECT * FROM order_track WHERE created_at <= NOW() - INTERVAL 5 MINUTE ");


while($sql_result=mysqli_fetch_assoc($sql)){
    
    $transaction_id=$sql_result['transaction_id'];
    $quantity=$sql_result['quantity'];
    $sku=$sql_result['sku'];
    
       $sql_one=mysqli_query($con3,"select * from phppos_items where name='".$sku."'");
            $sql_one_result=mysqli_fetch_assoc($sql_one);
            
            
        
            $get_quantity = $sql_one_result['quantity'];
            
            $new_quantity = $get_quantity+$quantity;
            
    
}


mysqli_query($conn,"delete FROM order_track WHERE created_at <= NOW() - INTERVAL 1 MINUTE  ");

?>
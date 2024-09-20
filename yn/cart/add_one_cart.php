<?php include('../config.php');

$cartid = $_REQUEST['cartid'];

$sql = mysqli_query($con,"select * from cart where cart_id='".$cartid."'");
$sql_result = mysqli_fetch_assoc($sql);
$sku = $sql_result['sku'];
$quantity = $sql_result['qty'];
$product_amt = $sql_result['product_amt'];

$get_total_quantity  =  getQuantity($sku) ; 

$quantity = $quantity+1 ; 

if($get_total_quantity < $quantity) {
    
    echo '2 '; //limit crossed 
}
else{
    
    $total_amt = $quantity * $product_amt ;  
    $sql_update="update cart set qty='".$quantity."', total_amt='".$total_amt."' where cart_id='".$cartid."'";

    if(mysqli_query($con,$sql_update)){
        echo '1';
    }
    else{
        echo '0';
    }
}

?>
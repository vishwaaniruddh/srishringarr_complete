<?php include($_SERVER['DOCUMENT_ROOT'].'/config.php');

include('../functions.php');

$productid=$_POST['productid'];
$userid=$_POST['usrid'];

$sku=$_POST['sku'];

$get_total_quantity = intval(get_quantity($sku));

$sql=mysqli_query($conn,"select * from cart where user_id='".$userid."' and product_id='".$productid."'");

$sql_result=mysqli_fetch_assoc($sql);

$quantity=$sql_result['qty']+1;

$amount=$sql_result['product_amt'];
$total_amt=$amount*$quantity;

if($get_total_quantity < $quantity) {
    
    echo '2'; //limit crossed 
}
else{
    $sql_update="update cart set qty='".$quantity."', total_amt='".$total_amt."' where user_id='".$userid."' and product_id='".$productid."'";
        // echo $sql_update;

    if(mysqli_query($conn,$sql_update)){
        echo '1';
    }
    else{
        echo '0';
    }
}

?>
<? include('../config.php');


$cartid = $_REQUEST['cartid'];


if($cartid){
    

$sql=mysqli_query($con,"select * from cart where cart_id='".$cartid."'");
$sql_result=mysqli_fetch_assoc($sql);
$previous_quantity=$sql_result['qty'];

if($previous_quantity==1){
 $sql_update="delete from cart where cart_id='".$cartid."'";

    if(mysqli_query($con,$sql_update)){
        
        echo '1';

    }
    else{
        echo 0;
    }
    
}
else{

$quantity=$sql_result['qty']-1;
$amount=$sql_result['product_amt'];
$total_amt=$amount*$quantity;

 $sql_update="update cart set qty='".$quantity."', total_amt='".$total_amt."' where cart_id='".$cartid."'";

    if(mysqli_query($con,$sql_update)){
       echo 1;
    }
    else{
        echo 0;
    }

}
}else{
    echo 3;
}
?>
<? include($_SERVER['DOCUMENT_ROOT'].'/config.php');


$productid=$_POST['productid'];
$userid=$_POST['usrid'];


$sql=mysqli_query($conn,"select * from cart where user_id='".$userid."' and product_id='".$productid."'");

$sql_result=mysqli_fetch_assoc($sql);

$previous_quantity=$sql_result['qty'];

if($previous_quantity==1){

$sql_update="delete from cart where user_id='".$userid."' and product_id='".$productid."'";

    if(mysqli_query($conn,$sql_update)){
        
        echo '1';

    }
    else{
        echo -1;
    }
    
}
else{

$quantity=$sql_result['qty']-1;

$amount=$sql_result['product_amt'];

echo 'amount'.$amount;


$total_amt=$amount*$quantity;
echo 'total_amt'.$total_amt;

$sql_update="update cart set qty='".$quantity."', total_amt='".$total_amt."' where user_id='".$userid."' and product_id='".$productid."'";

    if(mysqli_query($conn,$sql_update)){
       echo "new Quantity=".$quantity;
       echo $sql_update;
    }
    else{
        echo -1;
    }

}
    







?>
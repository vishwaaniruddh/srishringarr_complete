<? include('config.php');

$qty = $_POST['qty'];
$pid = $_POST['pid'];
$type = $_POST['type'];
$price = $_POST['price'];
$status = $_POST['status'];
$ac_type = $_POST['ac_type'];
$image = $_POST['image'];
$sku = $_POST['sku'];
$discount_amount = $_POST['discount_amount'];
$mrpValue = $_POST['mrp'];

$datetime = date('Y-m-d h:i:s');
$ogqty = getQuantity($sku) ; 
 

$check_sql = mysqli_query($con,"select * from cart where sku='".$sku."' and user_id='".$userid."'");
$check_sql_result = mysqli_fetch_assoc($check_sql);

if($check_sql_result){
 
 $newqty = $check_sql_result['qty']+$qty;
 $product_amt = $check_sql_result['product_amt'];
 $total_discount = $discount_amount + $check_sql_result['discount_amount'];
 $newmrpValue = $mrpValue + $check_sql_result['mrp'];
 if( $ogqty >= $newqty){
     $total_amt = $product_amt * $newqty ; 
     $sql = "update cart set qty='".$newqty."',total_amt='".$total_amt."',discount='".$total_discount."', mrp='".$newmrpValue."' where sku='".$sku."' and user_id='".$userid."'
     and ac_typ='2'";
     if(mysqli_query($con,$sql)){
         echo '1' ; 
     }else{
         echo '2' ;
     }
     
 }else{
     echo 0; 
 }
    
}else{
 
if($ogqty >= $qty ){
    $total_amt = $qty * $price ;
    $sql = "insert into cart(user_id,product_type ,product_id,qty,product_amt,total_amt,date,status,ac_typ,image,sku,discount,mrp)
    values('".$userid."', '".$type."', '".$pid."', '".$qty."', '".$price."', '".$total_amt."', '".$datetime."', '1' ,'2',  '".$image."','".$sku."',
    '".$discount_amount."','".$mrpValue."')"; 
        if(mysqli_query($con,$sql)){
            echo 1 ; // Inserted To Cart 
        }else{
            echo 2 ; // Insert Error
        }
    }else{
        echo '0'; //No  Qunatity 
}    
}

?>
<? session_start();
include($_SERVER['DOCUMENT_ROOT'].'/config.php');
include($_SERVER['DOCUMENT_ROOT'].'/functions.php');


$sku=$_POST['sku'];
$avail_quantity = intval(check_avail_quantity($sku));


$userid = $_SESSION['gid']; 


$new_qty=$_POST['new_qty'];


$product_id= $_POST['product_id'];

$product_id = trim($product_id,'"');


if($avail_quantity>=$new_qty){

$sql="update cart set qty='".$new_qty."' where user_id=$userid and product_id='".$product_id."'";

if(mysqli_query($conn,$sql)){
    echo 1;
}
else{
    echo 0;
}

}
else{
    echo 'Insufficient quantity';
}



?>
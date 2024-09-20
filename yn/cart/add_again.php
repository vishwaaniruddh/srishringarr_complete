<?php include($_SERVER['DOCUMENT_ROOT'].'/config.php');


$product_id=$_POST['product_id'];

$product_id = explode(',', $product_id);

foreach($product_id as $key => $val) {

    $select_sql=mysqli_query($con3,"select * from phppos_items where name LIKE '".$val."'");
    
    $select_sql_result=mysqli_fetch_assoc($select_sql);
    
    $quantity=$select_sql_result['quantity'];
    
    $new_quantity=$quantity+1;
    
    $update="update phppos_items set quantity='".$new_quantity."' where name LIKE '".$val."'";  

    mysqli_query($con3,$update);
    
}


?>


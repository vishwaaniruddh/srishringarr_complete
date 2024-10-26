<? session_start();
// include('config.php'); 
include('header.php'); 
// include('function.php');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$total_amount = total_cart_amount($userid) ;
$shipping_charges = get_shipping_charges($total_amount);
$datetime = date('Y-m-d h:i:s'); 

$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];


$delivery_add = $_SESSION['address'];


if($status=='success'){
    

    $select_sql=mysqli_query($con,"select * from Order_ent where transaction_id='".$txnid."'");
    $select_sql_result=mysqli_fetch_assoc($select_sql);
    
    
    //  
    if(!$select_sql_result && $userid>0) { //to prevent duplicate entries

         $insert="insert into Order_ent(user_id,amount,status,pmode,cmplt_status,transaction_stats,transaction_id,shipping_charges,total_amount,acc_type,date,delivery_add) VALUES ('".$userid."','".$amount."','".$status."','online','1','1','".$txnid."','".$shipping_charges."','".$total_amount."',2,'".$datetime."','".$delivery_add."')";

        mysqli_query($con,$insert);

        $order= mysqli_insert_id($con);
      
        $crtids=get_cart_ids($userid);
        
        
        
        foreach($crtids as $key => $val) {
            
                $qty=get_cart_quantity($val);
                $product_amt=get_product_amt_by_cart_id($val);
                $rental_date = get_cart_info($val);
                $cart_sql = mysqli_query($con,"select * from cart where cart_id='".$val."'");
                $cart_sql_result = mysqli_fetch_assoc($cart_sql);
                    
                $product_image = $cart_sql_result['image']; 
                $deposit_date = $cart_sql_result['deposite_date'];
                
                $insert_order_details = "insert into order_details(order_id,cart_id,user_id,product_type,product_id,qty,product_amt,total_amt,date  ,status,ac_typ,image) VALUES ('".$order."','".$val."','".$userid."','".get_product_type_from_cart($val,$userid)."','".get_product_from_cart_by_cartid($val)."','".$qty."','".$product_amt."','".$product_amt*$qty."','".date('Y/m/d h:i:s')."','1','2','".$product_image."')";
                // echo '<br>';
                mysqli_query($con,$insert_order_details);
            
        }
        
        
        
        delete_from_cart($userid) ; 
        
        
    
?>

<? } 


}

?>




<?
if($status=='success'){  ?>


   <div class="container">
    <h2 style="text-align:center;">Payment Sucessfully Done ! </h2>
</div>

 
<? }else{ ?>
    <div class="container">
    <h2 style="text-align:center;">Payment NOT Done ! </h2>
</div>

<? } ?>
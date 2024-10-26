<? session_start(); 
include('../config.php');
if($_COOKIE['ss_userid'] > 0 ){
$userid =     $_COOKIE['ss_userid'] ; 
}else{
$userid = $_SESSION['gid'];
    
}

include('../functions.php');

function total_cart_amount_v2($userid){
    
    global $con;
    
$total = 0 ; 
    $sql=mysqli_query($con,"select * from cart where user_id='".$userid."' and ac_typ=1");
    while($sql_result=mysqli_fetch_assoc($sql)){
        $qty = $sql_result['qty'];
        $product_amt = $sql_result['product_amt'];
        
        $total += $qty*$product_amt ; 
    }
    
    return $total;
    
}





$_SESSION['delivery'] = $_POST['delivery'];
$_SESSION['pickup'] = $_POST['pickup'];
$_SESSION['total_rental'] = $_POST['total_rental'];        


//$total_rental = total_cart_amount_v2($userid); 
$total_rental = $_POST['total_rental']; 

$_SESSION['rp_amount'] = $total_rental ; 
$_SESSION['rp_fname'] =  $_COOKIE['ss_fname'] .' '. $_COOKIE['ss_lname'];
$_SESSION['rp_email'] = $_COOKIE['ss_email']; 
$_SESSION['rp_mobile'] = $_COOKIE['ss_mobile'];


?>


<script>
    window.location.href="pay.php";
</script>
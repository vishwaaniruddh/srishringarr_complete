<? session_start();
include('config.php');

function currencyAmount($currency,$product_amount){
    
    global $con; 
    
    if($currency=='INR'){
        return $product_amount ; 
    }else{
    
        $cur_sql = "select * from conversion_rates where currency ='".$currency."'";
        $sql1 = mysqli_query($con,"select * from conversion_rates where currency ='".$currency."'");
        $sql1_result = mysqli_fetch_assoc($sql1);
        $rate = $sql1_result['rate'];
        $product_amount = $rate*$product_amount ;
        return $product_amount ;   
    }
}


$rent = $_REQUEST['rent'];
$currency = $_SESSION['cur'];

$final_rent = currencyAmount($currency,$rent) ;

echo round($final_rent,2) ; 
?>
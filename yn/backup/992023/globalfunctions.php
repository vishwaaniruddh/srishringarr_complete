<?php 
function currencyAmount($currency,$product_amount,$con){
     if($currency=='INR'){
        return $product_amount ; 
    }else{

        $cur_sql = "select * from conversion_rates where currency ='".$currency."'";
        $sql1 = mysqli_query($con,"select * from conversion_rates where currency ='".$currency."'");
        $sql1_result = mysqli_fetch_assoc($sql1);
        $rate = $sql1_result['rate'];
        $product_amount = $rate*$product_amount ;
        return round($product_amount,2) ;   
    }
}
?>
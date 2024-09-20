<?php session_start();
include('../../config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$json = file_get_contents('php://input');

$data = json_decode($json);


$array = (array) $data;



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
        return round($product_amount,2) ;   
    }
}



$total_amount   = $array['total_amount'];
$coupon_code    = $array['coupon'];

if($coupon_code){
$coupon_sql = mysqli_query($con,"select * from xircle_coupon  where code ='".$coupon_code."' and status=1 and min_price<=$total_amount and max_price >=$total_amount");
    if($coupon_sql_result = mysqli_fetch_assoc($coupon_sql)){

        $percent_discount = $coupon_sql_result['percent_discount'];         
        $percent_discount = ($percent_discount /100)*$total_amount  ;
        $discounted_amount = $total_amount - $percent_discount ;
        
        if($discounted_amount)
		{	
            $message = '';
		    $data = ['discount_amount'=>$percent_discount,'result_amount'=>$discounted_amount,'coupon'=>$coupon_code,'message'=>$message,'response'=>202];
		    
    		echo json_encode($data);

		}	
		else{

            $message = 'Not in Amount Range';
		    $data = ['coupon'=>$coupon_code,'message'=>$message,'response'=>302];
		    
    		echo json_encode($data);

		}

    }
    
    else{ 

            $message = 'Coupon Code Not Found !';
		    $data = ['coupon'=>$coupon_code,'message'=>$message,'response'=>402];
    		echo json_encode($data);
    }    
}else{
    $message = 'Coupon Code cannot be empty !';
		    $data = ['coupon'=>'','message'=>$message,'response'=>502];
    		echo json_encode($data);
}

	?>
	
	
	
<?php session_start();
include('config.php');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


$userid         = $_REQUEST['userid'];
$total_rental   = $_REQUEST['total_rental'];
$coupon_code    = $_REQUEST['coupon_code'];


// $sql =mysqli_query($con,"select * from xircle_coupon  where code ='".$coupon_code."'") ; 

// if($sql_result = mysqli_fetch_assoc($sql)){

// $min_amount = $sql_result['min_price'];
// $max_amount = $sql_result['max_price'];

// }


$coupon_sql = mysqli_query($con,"select * from xircle_coupon  where code ='".$coupon_code."' and status=1 and min_price<=$total_rental and max_price >=$total_rental");
    if($coupon_sql_result = mysqli_fetch_assoc($coupon_sql)){


        $percent_discount = $coupon_sql_result['percent_discount'];         
        $percent_discount = ($percent_discount /100)*$total_rental  ;
        $discounted_amount = $total_rental - $percent_discount ;
        
        if($discounted_amount)
		{	
		    echo round(currencyAmount($currency,$discounted_amount),2);
		
		        $_SESSION['coupon_code'] = $coupon_code ;
		

		}	
		else{
			echo  0;
			$_SESSION['coupon_code'] ='';
		}

    }
    
    else{ 
        	echo  2;
        	$_SESSION['coupon_code'] ='';
    }
	?>
	
	
	
<?php session_start();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


// include('function.php');
//include('yosshitaneha/function.php');

// //$con = mysqli_connect("localhost", "srishrin_juser", "juser123","srishrin_jewels");
//  $con = new mysqli("localhost", "srishrin_juser", "juser123","srishrin_jewels") or die("Connect failed: %s\n". $con -> error);
// //$con3=mysqli_connect("localhost", "sarmicro_pos", "Mypos1234","sarmicro_srishringarr"); 
//  $con3 = new mysqli("localhost", "sarmicro_pos", "Mypos1234","sarmicro_srishringarr") or die("Connect failed: %s\n". $con3 -> error);



$con = mysqli_connect("localhost", "u464193275_srishrinjuser", "9b@hMgk!=zI","u464193275_srishrinjewels");
$conn = mysqli_connect("localhost", "u464193275_srishrinjuser", "9b@hMgk!=zI","u464193275_srishrinjewels");
$con3=mysqli_connect("localhost", "u464193275_sarmicropos", "Mypos1234","u464193275_srishringarr");


$userid = $_SESSION['gid'];

if(isset($_SESSION['cur'])){
    $currency = $_SESSION['cur'];
}else{
    $currency = $_SESSION['cur']='INR';
}

$currency_symbolsql  = mysqli_query($con,"select symbol from conversion_rates where currency='".$currency."'") ;
$currency_symbolsql_result = mysqli_fetch_assoc($currency_symbolsql);
$currency_symbol = $currency_symbolsql_result['symbol'];
$cur = $_SESSION['cur'];
                           


if (!function_exists('name')) {

function name(){
    global $con,$userid;
    
    $sql = mysqli_query($con,"select * from Registration where registration_id='".$userid."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['Firstname'] .' ' . $sql_result['Lastname'] ; 
}
}


function email(){
    global $con,$userid;
    
    $sql = mysqli_query($con,"select * from Registration where registration_id='".$userid."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['email']; 
}


function getQuantity($sku){
    global $con3;
    $re = mysqli_query($con3,"SELECT quantity FROM phppos_items where name = '".$sku."'");
    $rero=mysqli_fetch_assoc($re);
    $qty=round($rero['quantity']);    
    
    return $qty ; 
    
}

// refer TO yosshitaneha/function.php

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



function igst($userid){
    
    global $con;
    //
    $sql=mysqli_query($con,"select * from cart where active=1 and user_id='".$userid."'");
    
    while($sql_result=mysqli_fetch_assoc($sql)){

        
     
        $quantity=$sql_result['qty'];
        $price=$sql_result['product_amt'];
        $product_type=$sql_result['product_type'];
        $price=floatval($price);
        

        $price = sprintf("%.2f", $price);
            
        if($product_type==2){ // ie. garment
            
        if($price<1060){
            
          $igst[]=($price-floatval($price*6)/100)*$quantity;
            }
            else{
            
            $igst[]=($price-floatval($price*100)/112)*$quantity;
           
            }
        }
        
        if($product_type==1){ // ie. jewellery
        
            $igst[]=($price-($price*3)/100)*$quantity;
            
            
           
        }
    }
    
$total=0; 
foreach($igst as $key => $val){



    $total=$total+$val;
    $total[]=sprintf("%.2f", $total);

}
return sprintf("%.2f", $total);
    
}



function get_shipping_charges($total){
    $shipping_charges = 0;
    if($total<=2000){
     $shipping_charges = 150;
    } else if($total >=2001 && $total <=5000){
     $shipping_charges = 200;
    } else if($total >=5001){
     $shipping_charges = 0;
    }
    return $shipping_charges;
}


function total_cart_amount($userid){
    
    global $con;
    
    $sql=mysqli_query($con,"select sum(total_amt) as total from cart where active=1 and user_id='".$userid."'");
    
    $sql_result=mysqli_fetch_assoc($sql);
    
    $total=$sql_result['total'];

    return $total;
    
}


function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range(0, 9));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }
    return $key; 
}


?>

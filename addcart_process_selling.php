<?php session_start();
include('config.php');

if($_COOKIE['ss_userid'] > 0 ){
$userid =     $_COOKIE['ss_userid'] ; 
}else{
$userid = $_SESSION['gid'];
}

$pid = $_POST['pid'];
$type = $_POST['type'];
$qty = $_POST['qty'];
$rent_date = $_POST['rent_date'];
$return_date = $_POST['return_date'];
$price = $_POST['price'];
$deposit = $_POST['deposit'];
$sales_price = $_POST['sales_price'];
$actyp ='1';
$sku = $_REQUEST['sku']; 
$dt= $date = date('Y-m-d H:i:s');
$image= $_POST['image'];


if($type==2){
    $deposite_date =date('Y-m-d', strtotime('-7 days', strtotime($rent_date)));
}elseif($type==1){
    $deposite_date =date('Y-m-d', strtotime('-7 days', strtotime($rent_date)));
}




$errs=0;

if(isset($userid) && $userid> 0 )
{

        if($rent_date!="")
        {
           $rent_date=date("Y-m-d",strtotime($rent_date));
        }



        if($return_date!="")
        {
            $return_date=date("Y-m-d",strtotime($return_date));
        }



   
    if($type=="1")
    {
    $sql="SELECT * FROM `product` WHERE `product_id`='".$pid."'";
    }
    else if($type=="2")
    {
    $sql="select * from  `garment_product` where gproduct_id='".$pid."'";
    }


$table=mysqli_query($con,$sql);
$tableftch=mysqli_fetch_array($table);
$productcode=$tableftch[2];


$cartid=0;
$billidexs=0;

$qryqty=mysqli_query($con,"select cart_id,qty,deposit_amt from cart where user_id='".$userid."' and product_id='".$pid."' and product_type='".$type."' and ac_typ='".$actyp."' and status=0 and purchase_type='Sell'");

// echo "select cart_id,qty,deposit_amt from cart where user_id='".$userid."' and product_id='".$pid."' and product_type='".$type."' and ac_typ='".$actyp."' and status=0"; 

$fetchqty1=mysqli_num_rows($qryqty);
if($fetchqty1 > 0){
    
        $sql=mysqli_query($con3,"select quantity from phppos_items where name='".$sku."'");
        $sql_result=mysqli_fetch_assoc($sql);
        $qunatity=$sql_result['quantity'];
        
        
        $fetchqty=mysqli_fetch_array($qryqty);
        $cartid=$fetchqty[0];
        $billidexs=$fetchqty[13];
        
        $qt=($fetchqty[1]+$qty);
        
        if($qt>$qunatity){
            echo '11' ; // Insufficient Quantity 
        }else{
            $totalamt1=$qt*$pprice;
            $updatesql = "update cart set qty='".$qt."',total_amt='".$totalamt1."',rent_dt='".$rent_date."',return_dt='".$return_date."',deposit_amt='".$deposit."' where cart_id='".$fetchqty[0]."'";
            if(mysqli_query($con,$updatesql)){
                echo 1 ;
            }else{
                echo 0;
            }
        
        }
}
else{
    $insertsql = "INSERT INTO `cart`( `user_id`, `product_id`, `qty`, `product_amt`, `total_amt`, `date`,product_type,ac_typ,image,sku,purchase_type) 
    VALUES ('".$userid."','".$pid."','".$qty."','".$price."','".$sales_price."','".$date."','".$type."','".$actyp."','".$image."','".$sku."','Sell')"; 
    
    if(mysqli_query($con,$insertsql)){
        echo 1;        
    }else{
        echo 0;
    }


}


}

else
{
    
    echo 0;
}
?>
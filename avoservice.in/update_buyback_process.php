<?php 
session_start();
include('config.php');


$invoiceId =$_POST['invoiceId'];
$todt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));
$comment   = $_POST['comment'];
   
      
$query=mysqli_query($con1,"update sales_orders set BuybackDate='".$todt."', Buyback_Coment='".$comment."',BuybackStatus='Yes'  where inv_no='".$invoiceId."'  ");
	if($query){
	  echo "<script>window.close();</script>";
	}else{
	    echo "error";
	}

?>
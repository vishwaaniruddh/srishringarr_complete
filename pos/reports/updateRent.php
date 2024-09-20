<?php

// include('config.php');
include('../db_connection.php') ;
$con=OpenSrishringarrCon();

$cid=$_POST['id'];
$amt=$_POST['amt'];

$qt=$_POST['qty1'];
// mysqli_query($con,"BEGIN;");
mysqli_autocommit($con,FALSE);


$result1 = mysqli_query($con,"update `phppos_rent` set status='S',booking_status='Returned' where bill_id='".$cid."'");	

 $result2 = mysqli_query($con,"SELECT * FROM  `order_detail` where bill_id='".$cid."'");
 while($row2=mysqli_fetch_row($result2)){
// $row2 = mysqli_fetch_row($result2);
 
 $q=$row2[9];
 $name = $row2[1];

$res1=mysqli_query($con,"update `order_detail` set return_qty='".$q."' where bill_id='".$cid."' and item_id='".$name."'");

$sql = mysqli_query($con,"select quantity from `phppos_items` where name='".$name."' ");
$sql_res = mysqli_fetch_row($sql);
$quantity = $sql_res[0];
$totalquantity = $quantity + $q;

$res2=mysqli_query($con,"update `phppos_items` set quantity='".$totalquantity."'  WHERE name='".$name."' ");

// $res2=mysqli_query($con,"update `phppos_items` set quantity=quantity+$q  WHERE name='$row2[1]'");
	
 }
if($result1 && $res1 && $res2){
// 	mysqli_query($con,"COMMIT");
	mysqli_commit($con);
header('location:rent_return.php');
}
else{
// 	mysqli_query($con,"ROLLBACK");
	mysqli_rollback($con);
	echo "Transaction is rolled back, keeping the data secure. Please try again.";
	}
	
CloseCon($con);

?>
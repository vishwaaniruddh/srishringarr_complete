<?php
session_start();
//include("access.php");
include("config.php");

$userid=$_SESSION['user'];
$date=date('Y-m-d H:i:s');
$cldate= $_POST['cldate'];

  $so_orderid= $_POST['so_orderid'];
 
  $branch= $_POST['branch'];
  $custid= $_POST['cust_id'];
  $amount= $_POST['cour_amount'];
  $handling= $_POST['hamali'];
  
  $total=$amount+$handling;
  
  $user = $_SESSION['user'];
 
  //===branch_exphead====
  
  $exp_type ="2";
  
  $desc= mysqli_real_escape_string($_POST['desc']);
  $remarks= mysqli_real_escape_string($_POST['remarks']);
  

$result12=mysqli_query($con1,"insert into `branch_expense`(branch_id,claim_date, exp_type, description, so_orderid, alert_id, courier, handling, claim_amt, remarks, entry_by, entry_date) VALUES ('".$branch."','".$cldate."','".$exp_type."','".$desc."','".$so_orderid."', '', '".$amount."', '".$handling."','".$total."','".$remarks."','".$user."', '".$date."')");
if($result12) {
$update= mysqli_query($con1,"Update so_order set claim_status=1 where id='".$so_orderid."' ");
}
	
	if ($result12 && $update){
	?> 
	
	<script type="text/javascript">
	alert("Successfull Enetered the Expenses");
	window.location='log_search.php';
	</script> 
	<?} else{ ?>
	<script type="text/javascript">
	alert("Some Error Occured !!!");
	window.location='logistics.php?id=<? echo $so_orderid ;?>';
	</script>  
	    
	 <?   
	} echo "Failed";
	
	?>
	
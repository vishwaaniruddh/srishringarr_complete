<?php 
include($_SERVER["DOCUMENT_ROOT"]."/CRM/config.php"); 



$id=$_GET['id'];

$name=$_POST['name'];
$cust_segment=$_POST['cust_segment'];
$cust_vertical=$_POST['cust_vertical'];
$branch_name=$_POST["branch_name"];
$contact_type=$_POST["contact_type"];
$designation=$_POST["designation"];
$mobile=$_POST["mobile"];
$email=$_POST["email"];
$landline=$_POST["landline"];
$city=$_POST["city"];
$state=$_POST["state"];
$pincode=$_POST["pincode"];
$area=$_POST["area"];
$contact_person=$_POST["contact_person"];
$sales_exe_name=$_POST["sales_exe_name"];
$address=$_POST["address"];
$remark=$_POST["remark"];
$product_requirement=$_POST["product_requirement"];
$capacity=$_POST["capacity"];
$quantity=$_POST["quantity"];
$lakh_value=$_POST["lakh_value"];
$finalization_date=$_POST["finalization_date"];
$order_chance=$_POST["order_chance"];
$addition_remark=$_POST["addition_remark"];
$isWorth=$_POST['isCheck'];



$customer = "UPDATE customer SET cust_segment='".$cust_segment."' ,name='".$name."',branch_name='".$branch_name."',contact_type='".$contact_type."',designation='".$designation."',sales_exe_name='".$sales_exe_name."',contact_person='".$contact_person."',remark='".$remark."',product_requirement='".$product_requirement."',capacity='".$capacity."',lakh_value='".$lakh_value."',finalization_date='".$finalization_date."',order_chance='".$order_chance."',addition_remark='".$addition_remark."',created_by='me' WHERE id='".$id."'";


if ($conn->query($customer) === TRUE) { 

$customer_contact = "UPDATE customer_contact SET contact_type='".$contact_type."' ,email='".$email."',mobile='".$mobile."',landline='".$landline."',city='".$city."',state='".$state."',pincode='".$pincode."',area='".$area."',address='".$address."' WHERE customer_id='".$id."'";

$conn->query($customer_contact);



?>
<script>
	setTimeout(function() { 
   	window.history.back();
		}, 2000);
    		alert('successfully updated !!');
</script>
    
<?php  } else { 
    // echo "<br>Error: " . $sql . "<br>" . $conn->error;
?>
<script>
    		alert('Error in updation !!');
	
</script>
<?php  }


$conn->close();
 ?>




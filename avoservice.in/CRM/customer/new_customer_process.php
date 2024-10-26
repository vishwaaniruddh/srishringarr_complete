<?php 
include($_SERVER["DOCUMENT_ROOT"]."/CRM/config.php"); 


$name=$_POST['name'];
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


$info = "INSERT INTO customer (name,cust_segment, branch_name, contact_type,designation,contact_person,sales_exe_name,remark,product_requirement,capacity,quantity,lakh_value,finalization_date,order_chance,addition_remark,created_by,updated_by,isWorth)
VALUES ('".$name."','".$cust_vertical."', '".$branch_name."', '".$contact_type."','".$designation."','".$contact_person."','".$sales_exe_name."','".$remark."','".$product_requirement."','".$capacity."','".$quantity."','".$lakh_value."','".$finalization_date."','".$order_chance."','".$addition_remark."',1,1,1)";


if ($conn->query($info)=== TRUE) {
    $customer_id = $conn->insert_id;
$cred_gen="INSERT INTO customer_contact (customer_id,contact_type, email, mobile, landline, city, state, pincode, area, address) 
VALUES ('".$customer_id."','".$end_user_seg."', '".$email."','".$mobile."', '".$landline."', '".$city."', '".$state."', '".$pincode."', '".$area."', '".$address."')";

$conn->query($cred_gen);   
?>
<script>
	setTimeout(function() { 
   	window.history.back();
		}, 2000);
    		alert('successfully updated !!');
</script>
<?php 
} else {
    echo "Error: " . $info . "<br>" . $conn->error;
}


 ?>

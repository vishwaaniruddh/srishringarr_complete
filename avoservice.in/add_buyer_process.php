<?php 
include('config.php');

if(isset($_GET['id']) && $_GET['id']>0){
    $id = $_GET['id'];
    //echo 'edit';
    $buyer_vertical	= $_POST['customer_vertical'];
    $buyer_name = $_POST['buyer_name'];
    $buyer_segment = $_POST['end_user'];
    $avo_branc = $_POST['avo_branch'];
    $buyer_city = $_POST['city'];
    $buyer_address = $_POST['address'];
    $buyer_state = $_POST['state'];
    $buyer_pin = $_POST['pincode'];
    $buyer_gst = $_POST['gst_no'];
    $buyer_executive = $_POST['executive_name'];
    $buyer_contact = $_POST['Buyer_contact_person'];
    $buyer_designation = $_POST['Buyer_designation'];
    $buyer_phone = $_POST['buyer_phone'];
    $buyer_mail = $_POST['buyer_e-mail'];
    $buyer_phone2 = $_POST['Landline_phone_no'];
    
    
        $sql = mysqli_query($con1,"update buyer set buyer_vertical='".$buyer_vertical."', buyer_name='".$buyer_name."', buyer_segment='".$buyer_segment."', avo_branch='".$avo_branc."', buyer_city='".$buyer_city."', buyer_address='".$buyer_address."', buyer_state='".$buyer_state."', buyer_pin='".$buyer_pin."', buyer_gst='".$buyer_gst."', buyer_executive='".$buyer_executive."', buyer_contact='".$buyer_contact."', buyer_designation='".$buyer_designation."', buyer_phone='".$buyer_phone."', buyer_mail='".$buyer_mail."', buyer_phone2='".$buyer_phone2."', status='1' where buyer_ID= '".$id."' ");
    
    //if($sql){
        echo '<script>alert("Updated successfully!")</script>';
    //}
    
} else {
   
$customer_ver = $_POST['customer_vertical'];
$name = $_POST['buyer_name'];
$end_user = $_POST['end_user'];
$avo_branc = $_POST['avo_branch'];
$city = $_POST['city'];
$address = $_POST['address'];
$state = $_POST['state'];
$pincode = $_POST['pincode'];
$gst_no = $_POST['gst_no'];
$executive_name = $_POST['executive_name'];
$Buyer_contact_person = $_POST['Buyer_contact_person'];
$Buyer_designation = $_POST['Buyer_designation'];
$Buyer_mobile_mumber = $_POST['buyer_phone'];
$buyer_email = $_POST['buyer_e-mail'];
$Landline_phone_no = $_POST['Landline_phone_no'];
$date = date("Y-m-d");

$sql_query = "insert into `buyer` (buyer_vertical,buyer_name,buyer_segment,buyer_city,buyer_address,buyer_state,avo_branch,buyer_pin,buyer_gst,buyer_executive,buyer_contact,buyer_designation,buyer_phone,buyer_mail,buyer_phone2,Status,created_date)values('".$customer_ver."','".$name."','".$end_user."','".$city."','".$address."','".$state."','".$avo_branc."','".$pincode."','".$gst_no."','".$executive_name."','".$Buyer_contact_person."','".$Buyer_designation."','".$Buyer_mobile_mumber."','".$buyer_email."','".$Landline_phone_no."','1','".$date."')";

//echo $sql_query;


$sql = mysqli_query($con1, $sql_query); 

}

if($sql){
    echo '<script>window.location.href="view_buyers.php"</script>';
} else {
    echo $sql_query;
    die;
}
?>
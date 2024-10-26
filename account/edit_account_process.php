<? session_start();
include_once('site_header.php');

include_once('../functions.php');

$userid=$_SESSION['gid'];

$fname=$_POST["billing_first_name"]; 
$lname=$_POST["billing_last_name"]; 
$country=$_POST["billing_country"]; 
$address=$_POST["billing_address_1"];
$city=$_POST["billing_city"]; 

$state=$_POST["state_code"];  
$pincode=$_POST["billing_postcode"];  
$mobile=$_POST["billing_phone"];  
$email=$_POST["billing_email"];  
$landmark=$_POST['landmark'];

//echo '<pre>';print_r($_POST);echo '</pre>';exit;

$city=get_city_id($city);

$sql=mysqli_query($conn,"update Registration set Firstname='".$fname."', Lastname='".$lname."', email='".$email."',Mobile='".$mobile."', address='".$address."', pincode='".$pincode."',landmark='".$landmark."',state='".$state."',city='".$city."' where registration_id='".$userid."'");

if($_SESSION['referer']== 'http://www.srishringarr.com/cart.php'){ ?>

<script>
    window.location='http://www.srishringarr.com/cart.php';
</script>


<?php }  else { ?> 

<script>
    window.location='http://www.srishringarr.com/account/my-account.php';
</script>
    
<? } ?>


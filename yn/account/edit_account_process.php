<? session_start();
include($_SERVER['DOCUMENT_ROOT'].'/header.php');



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

$datetime = date('Y-m-d h:i:s a');
$sql = "insert into shippingInfo(userid,person_name,person_contact,address,landmark,city,state,country,pincode,type,status,site,created_at,created_by) values('".$userid."','".$fname .' '.$lname."','".$mobile."','".$address."','".$landmark."','".$city."','".$state."','".$country."','".$pincode."','-','1','YN','".$datetime."','".$userid."')";




if(mysqli_query($con,$sql)){
    ?>
    <script>
        alert(' Added Successfully !');    
    </script>
    
    <?
}else{
    ?>
    <script>
        alert(' Added Error !');    
    </script>
    
    <?
}

if($_SESSION['referer']== 'http://www.yosshitaneha.com/cart.php'){ ?>

<script>
    window.location='../cart.php';
</script>


<?php }  else { ?> 

<script>
    window.location='./account.php';
</script>
    
<? } ?>

<?

include($_SERVER['DOCUMENT_ROOT'].'/footer.php');
?>


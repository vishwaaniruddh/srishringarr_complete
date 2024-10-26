<?php session_start();
// include_once('site_header.php');
include_once('../config.php');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['emailid'];
$mob=$_POST['mob'];
$gender=$_POST['radio'];
$pass=$_POST['passwd'];
$userid = $_POST['userid'];

$otp = $_POST['otp'];





$sql=mysqli_query($con,"select * from forget_password where email='".$email."' and password  like '".$otp."'");
if($sql_result=mysqli_fetch_assoc($sql)){
    
$errs=0;
$date = date('Y-m-d');


if($userid > 0 && isset($fname) && isset($lname) && isset($email) && isset($mob) && isset($pass)){

    $check_sql = mysqli_query($con,"select * from customer_login where email='".$email."' and site='SN'");
    if($check_sql_result = mysqli_fetch_assoc($check_sql)){ ?>
       <script>
            alert('Email ID Already Registered ! Login To Continue');
            window.location.href="my-account.php";
        </script>
    <? }else{
        $statement = "insert into Registration(Firstname,Lastname,email,Mobile,Gender,password,registration_date) values('".$fname."','".$lname."','".$email."','".$mob."','".$gender."','".$pass."','".$date."')";
        
        if(mysqli_query($con,$statement)){
            
            $insert_id = $con->insert_id;
            $state1 = "insert into customer_login(login_id,email,password,site) values('".$insert_id."','".$email."','".$pass."','SN')";
        if(mysqli_query($con,$state1)){ ?>
        
        <script>
            alert('Registration Succuessfully Done ! Login To Continue');
            window.location.href="my-account.php";
        </script>
        <? }
            
        }
        
    }
    
    
    
    
    
}else{
    ?>
    <script>
        alert("error Occured !");
        window.location="index.php";
    </script>

    <?
}


}else{ ?>
    <script>
        alert('Invalid OTP');
        window.history.back();
    </script>
    
<? }
?>


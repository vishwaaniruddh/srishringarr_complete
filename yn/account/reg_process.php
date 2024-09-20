<?php session_start();
error_reporting(1);
include('../config.php');



$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['emailid'];

$mob=$_POST['mob'];
//echo $mob;

$pass=$_POST['passwd'];
$errs=0;
$date = date('Y-m-d');


if(isset($_SESSION['gid']) && $_SESSION['gid'] > 0 && isset($fname) && isset($lname) && isset($email) && isset($mob) && isset($pass)){

    $check_sql = mysqli_query($con,"select * from customer_login where email='".$email."' and site='YN'");
    if($check_sql_result = mysqli_fetch_assoc($check_sql)){ ?>
       <script>
            alert('Email ID Already Registered ! Login To Continue');
            window.location.href="../login_register.php";
        </script>
    <? }else{
        $statement = "insert into Registration(Firstname,Lastname,email,Mobile,password,registration_date,site) values('".$fname."','".$lname."','".$email."','".$mob."','".$pass."','".$date."','YN')";
        
        if(mysqli_query($con,$statement)){
            
            $insert_id = $con->insert_id;
            $state1 = "insert into customer_login(login_id,email,password,site) values('".$insert_id."','".$email."','".$pass."','YN')";
        if(mysqli_query($con,$state1)){ ?>
        
        <script>
            alert('Registration Succuessfully Done ! Login To Continue');
            window.location.href="../login_register.php";
        </script>
        <? }
            
        }
        
    }
    
    
    
    
    
}else{
    ?>
    <script>
        alert("error Occured !");
        window.location.href="../login_register.php";
    </script>

    <?
}

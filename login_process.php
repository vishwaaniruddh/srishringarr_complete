<?php session_start();
include('config.php');

$gid=$_SESSION['gid'];
$email=$_POST['usernm'];
$passwd=$_POST['pass'];
//var_dump($_POST);



$sql1=mysqli_query($con,"select * from customer_login where email='".$email."' and password='".$passwd."'");
if($sql_result1=mysqli_fetch_assoc($sql1)){
$sql=mysqli_query($con,"select * from Registration where email='".$email."' and password='".$passwd."'");
if($sql_result=mysqli_fetch_assoc($sql)){
    


$_SESSION['fname']=$sql_result['Firstname'];
$_SESSION['lname']=$sql_result['Lastname'];
$_SESSION['mobile']=$sql_result['Mobile'];
$_SESSION['email'] = $sql_result['email'];
$_SESSION['gid'] = $sql_result['registration_id'];


    mysqli_query($con,"update cart set user_id = '".$sql_result['id']."' where user_id='".$gid."'");
    
    
    
    echo '<script>alert("Login Successfully");
    window.location.href="index.php";
    </script>';
}
else{
    
    echo '<script>alert("Incorrect Login Credentials");
    window.history.back();
    </script>';
    
}    
}else{
        echo '<script>alert("Incorrect Login Credentials");
    window.history.back();
    </script>';
}


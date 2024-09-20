<?php session_start();
include('../config.php');

$email=$_POST['usernm'];
$passwd=$_POST['pass'];

$sql1=mysqli_query($con,"select * from customer_login where email='".$email."' and password='".$passwd."' and site='YN'");

if($sql_result1=mysqli_fetch_assoc($sql1)){
   
$id = $sql_result1['login_id']; 
$sql = mysqli_query($con,"select * from Registration where registration_id='".$id."'");
$sql_result = mysqli_fetch_assoc($sql);

$_SESSION['fname']=$sql_result['Firstname'];
$_SESSION['lname']=$sql_result['Lastname'];
$_SESSION['mobile']=$sql_result['Mobile'];
$_SESSION['email'] = $sql_result['email'];
$_SESSION['gid'] = $sql_result['registration_id'];
$_SESSION['site'] ='YN';


setcookie("yn_fname",$sql_result['Firstname'],time()+31556926 ,'/');
setcookie("yn_lname",$sql_result['Lastname'],time()+31556926 ,'/');
setcookie("yn_mobile",$sql_result['Mobile'],time()+31556926 ,'/');
setcookie("yn_email",$sql_result['email'],time()+31556926 ,'/');
setcookie("yn_userid",$sql_result['registration_id'],time()+31556926 ,'/');




mysqli_query($con,"update cart set user_id = '".$sql_result['registration_id']."' where user_id='".$userid."'"); 
    
   ?>
    <script>
       swal("Good job!", "Login Success !", "success");

           setTimeout(function(){ 
               window.location.href="../cart.php";
           }, 3000);

       </script> 
   <?php
}
else{ ?>
    
  <script>
       swal("", "Login Error !", "error");
           swal('error','','Login Error');
           setTimeout(function(){ 
              window.history.back();
           }, 3000);

       </script>
<?php    
}

?>


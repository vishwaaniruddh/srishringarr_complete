<?php session_start();

include_once('site_header.php');

$userid = $_SESSION['gid'];

$password = $_POST['old_pwd'];
$newPassword = $_POST['pwd'];


$sql = mysqli_query($con,"select * from customer_login where login_id='".$userid."'");
$sql_result = mysqli_fetch_assoc($sql);

$ogPassword = $sql_result['password'];

if($ogPassword == $password){
    

    
     $update = "update customer_login set password='".$newPassword."' where login_id='".$userid."'";
    
    
    if(mysqli_query($con,$update)){ 
    
    session_destroy();
    ?>
       
       <script>
           alert("Password Changed Successfully ! ");
           window.location.href="my-account.php";
       </script> 
    <? }else{ 
    
        
    ?>
        <script>
           alert("Password Changed Error ! ");
           window.history.back();
       </script>
       
    <? }
    
    
}else{
    
    echo 'else';
    ?>
        <script>
           alert("Old Password Not Match ! ");
           window.history.back();
       </script>
       
    <?
    
}




?>
</body>
</html>

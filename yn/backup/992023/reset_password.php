<? include('config.php');


$userid = $_REQUEST['userid'];
$new_password = $_REQUEST['new_password'];

$sql = "update customer_login set password = '".$new_password."' where login_id='".$userid."'";

if(mysqli_query($con,$sql)){
    echo 'password Reset Successfully !';
    echo '<a href="https://yosshitaneha.com/login_register.php">Login</a>' ; 
}else{
    echo 'Error In Password Update! Contact System Administrator' ; 
}

?>
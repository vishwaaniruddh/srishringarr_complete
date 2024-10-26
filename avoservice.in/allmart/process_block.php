<?php include('config.php');
error_reporting(0);
ini_set('max_execution_time', 0);


$number = $_POST['mobile'];

if($number > 0){
$sql = "update new_member set is_whatsapp_send = 0 where mobile='".$number."'";

if(mysqli_query($con,$sql)){
    echo 1;
}
else{
    echo 0;
}
}
else{
    echo 0;
}

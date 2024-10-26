<?php  session_start();
include('config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

var_dump($_SESSION);

if($_SESSION['gid']=="")
{ 
    if(mysqli_query($con,"INSERT INTO `Registration`(`registration_id`) values ('')")){


$usrid=$con->insert_id;
echo $usrid;
}
$_SESSION['gid']=$usrid;


}else{
    echo 'else'; 
    
}
     

?>

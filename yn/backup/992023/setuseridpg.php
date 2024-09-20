<?php  session_start();
include('config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(isset($_SESSION['gid']))
{ 
    
}else{
    if(mysqli_query($con,"INSERT INTO `Registration`(`registration_id`) values ('')")){
        $usrid=$con->insert_id;
        $_SESSION['gid']=$usrid;
        echo $usrid;
    }
}
     

?>

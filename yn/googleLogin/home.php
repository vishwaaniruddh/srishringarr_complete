<?php
session_start();
if(!isset($_SESSION['token'])){
  header('Location: https://srishringarr.com');
  exit;
}
require('./config.php');
require('./db_connection.php');

$client->setAccessToken($_SESSION['token']);

if($client->isAccessTokenExpired()){
  header('Location: logout.php');
  exit;
}
$google_oauth = new Google_Service_Oauth2($client);
$user_info = $google_oauth->userinfo->get();



$login_id = $user_info['id'];
$first_name = $user_info['givenName'];
$last_name = $user_info['familyName'];
//echo $login_id;
$full_name = $user_info['givenName']." ".$user_info['familyName'];
$email = $user_info['email'];

$_SESSION['fname'] = $user_info['givenName'];
$_SESSION['is_social_login'] = 1;

$sql1=mysqli_query($con,"select * from customer_social_login where email='".$email."' AND site='YN'");
if(mysqli_num_rows($sql1)>0){
    if($sql_result1=mysqli_fetch_assoc($sql1)){
        $_SESSION['email'] = $user_info['email'];
    }
    header('Location: https://yosshitaneha.com');
    exit;
}else{
    $insert_sql = "INSERT INTO `customer_social_login`( `login_id`, `email`, `full_name`, `site`) VALUES ('".$login_id."','".$email."','".$full_name."','YN') ";
   // echo $insert_sql;die;
    $sql1=mysqli_query($con,$insert_sql);
    $_SESSION['email'] = $user_info['email'];   
    
    $insertreg_sql = "INSERT INTO `Registration`( `Firstname`, `Lastname`, `email`) VALUES ('".$first_name."','".$last_name."','".$email."') ";
   // echo $insert_sql;die;
   // $regsql1=mysqli_query($con,$insertreg_sql);
    if(mysqli_query($con,$insertreg_sql)){ 
        $reg_id = $con->insert_id;
        $pwd = "Google321@#";
        $insertlogin_sql = "INSERT INTO `customer_login`( `login_id`, `email`, `password`, `site`) VALUES ('".$reg_id."','".$email."','".$pwd."','YN') ";
        mysqli_query($con,$insertlogin_sql);
    }  
    
    header('Location: https://yosshitaneha.com');
    exit;
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <style>
    body{
      padding: 50px;
    }
    ul{
      list-style: none;
    }
    li{
      margin-bottom: 5px;
    }
  </style>
</head>
<body>
  <ul>
    <li><img src="<?=$user_info['picture'];?>"></li>
    <li><strong>ID:</strong> <?=$user_info['id'];?></li>
    <li><strong>Full Name:</strong> <?=$user_info['givenName'];?> <?=$user_info['familyName'];?></li>
    <li><strong>Email:</strong> <?=$user_info['email'];?></li>
    <li><a href="./logout.php">Logout</a></li>
  </ul>
</body>
</html>
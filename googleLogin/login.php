<?php
require('./config.php');
# the createAuthUrl() method generates the login URL.
$login_url = $client->createAuthUrl();
/* 
 * After obtaining permission from the user,
 * Google will redirect to the login.php with the "code" query parameter.
*/
if (isset($_GET['code'])):

  session_start();
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  if(isset($token['error'])){
    header('Location: https://srishringarr.com');
    exit;
  }
  $_SESSION['token'] = $token;
  header('Location: home.php');
  exit;

endif;

  header('Location: '.$login_url);
  exit;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login with Google account</title>
  <style>
    .btn{
      display: flex;
      justify-content: center;
      padding: 50px;
    }
    a{
      all: unset;
      cursor: pointer;
      padding: 10px;
      display: flex;
      width: 250px;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      background-color: 
#f9f9f9;
      border: 1px solid 
rgba(0, 0, 0, .2);
      border-radius: 3px;
    }
    a:hover{
      background-color: 
#ffffff;
    }
    img{
      width: 50px;
      margin-right: 5px;
    
    }
  </style>
</head>
<body>
    <div class="btn">
    <a href="<?= $login_url ?>"><img src="https://tinyurl.com/46bvrw4s" alt="Google Logo"> Login with Google</a>
    </div>
</body>
</html>
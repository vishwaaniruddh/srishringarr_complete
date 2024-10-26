
<?php

//index.php

//Include Configuration File
include('socialLogin2.php');

$login_button = '';


if(isset($_GET["code"]))
{

 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


 if(!isset($token['error']))
 {
 
  $google_client->setAccessToken($token['access_token']);

 
  $_SESSION['access_token'] = $token['access_token'];


  $google_service = new Google_Service_Oauth2($google_client);

 
  $data = $google_service->userinfo->get();

 
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}


if(!isset($_SESSION['access_token']))
{

 $login_button = '<a href="'.$google_client->createAuthUrl().'">Login With Google</a>';
}

?>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>PHP Login using Google Account</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 
 </head>
 <body>
  <div class="container">
   <br />
   <h2 align="center">PHP Login using Google Account</h2>
   <br />
   <div class="panel panel-default">
   <?php
   if($login_button == '')
   {
    echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
    echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
    echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
    echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
    echo '<h3><a href="logout.php">Logout</h3></div>';
   }
   else
   {
    echo '<div align="center">'.$login_button . '</div>';
   }
   ?>
   </div>
  </div>
 </body>
</html>

<?php

return ; 



require_once 'vendor/autoload.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json; charset=utf-8');


// Configure Google client
$client = new Google_Client();
$client->setApplicationName('Your Application Name');
$client->setClientId('852903275648-aqalikbg7nd7bavegdg5alajb8pjvbj5.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('https://www.srishringarr.com/socialLogin.php');

$client->addScope(Google_Service_Oauth2::USERINFO_EMAIL);
$client->addScope(Google_Service_Oauth2::USERINFO_PROFILE);

// Check for authorization code
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token);

  // Get user information
  $oauth2 = new Google_Service_Oauth2($client);
  $user = $oauth2->userinfo->get();

  // Display user information
  echo 'ID: ' . $user->id . '<br>';
  echo 'Name: ' . $user->name . '<br>';
  echo 'Email: ' . $user->email . '<br>';

  // Store access token for future use (optional)
  // e.g., in a database or session
} else {
  // Generate authorization URL
  $authUrl = $client->createAuthUrl();

  // Redirect to Google authorization
  header('Location: ' . $authUrl);
}
?>


<?php



return;
session_start();
require_once 'vendor/autoload.php';



 
$client = new Google\Client();
$client->setClientId('852903275648-aqalikbg7nd7bavegdg5alajb8pjvbj5.apps.googleusercontent.com');
$client->setClientSecret('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');

$client->setRedirectUri('https://www.srishringarr.com/socialLogin.php'); // Update with your actual redirect URI
$client->addScope([
    Google\Service\Oauth2::USERINFO_PROFILE,
    Google\Service\Oauth2::USERINFO_EMAIL,
    'https://www.googleapis.com/auth/user.phonenumbers.read' // Add this scope for phone number
]);

if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();

    // Redirect to a secure page to prevent the code from being leaked in the URL
    header('Location: https://' . $_SERVER['HTTP_HOST'] . '/secure-page.php');
    exit();
}

// Handle errors or unauthorized access
if (isset($_GET['error'])) {
    echo 'Error: ' . htmlspecialchars($_GET['error']);
    exit();
}

// Check if the access token is set in the session
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);

    // Get user information
    $oauthService = new Google\Service\Oauth2($client);
    $userInfo = $oauthService->userinfo->get();

    // Access the raw API response
    $rawApiResponse = $client->execute($userInfo->getHttpClient()->getRequest());

    // Access user information
    $name = $userInfo->getGivenName();
    $lastName = $userInfo->getFamilyName();
    $email = $userInfo->getEmail();
    $phone = $userInfo->getPhone();

    // Access the access token
    $accessToken = $client->getAccessToken()['access_token'];

    // Display the raw API response
    echo "Raw API Response: <pre>" . print_r($rawApiResponse, true) . "</pre>";

    // Now you have the user's name, last name, email, phone, and access token
    echo "Name: $name<br>";
    echo "Last Name: $lastName<br>";
    echo "Email: $email<br>";
    echo "Phone: $phone<br>";
    echo "Access Token: $accessToken";
} else {
    // Redirect the user to the Google authentication page
    $authUrl = $client->createAuthUrl();
    header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
}

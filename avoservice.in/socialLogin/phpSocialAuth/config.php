<?php

//start session on web page
session_start();

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('69227633841-0g6vm876bmrdgouhvqu3rqufi115qol2.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('https://avoservice.in/socialLogin/phpSocialAuth/index.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?> 
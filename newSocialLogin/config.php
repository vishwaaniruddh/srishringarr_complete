<?php
require('./vendor/autoload.php');

# Add your client ID and Secret
$client_id = "699700788618-7nunv3jh4eoorc33rh1tc5fl7p3of9ee.apps.googleusercontent.com";
$client_secret = "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";

$client = new Google\Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);

# redirection location is the path to login.php
$redirect_uri = 'https://srishringarr.com/googleLogin/login.php';
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");
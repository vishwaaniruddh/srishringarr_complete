<?php
require('./vendor/autoload.php');

# Add your client ID and Secret
$client_id = "310533525783-r4lknah008lomlobr03esk9pvbu5658n.apps.googleusercontent.com";
$client_secret = "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";

$client = new Google\Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);

# redirection location is the path to login.php
$redirect_uri = 'https://yosshitaneha.com/googleLogin/login.php';
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");
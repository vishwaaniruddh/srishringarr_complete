<?php
$app_id = '1284706728825062';
$app_secret = '678dd881343fc64687c5ddd763adb25a';
$user_access_token = 'IGQWRQMnU5S2w3eU42ZAGdydE8xakF5QXBsWTRySHprU2pMUm9Kc3lIVVNNb0hXUTBkUlZAGZAlBqU0g3U25LOHgzS1RQR0xicEVCb3lkOXNvRkotSGRCRlhZAVTNqSWx0blBSRVozM3YxMGN1TXN3eFAtUmkxSU5PTkEZD';

$endpoint = "https://graph.instagram.com/v11.0/me/media?fields=id,caption,media_type,media_url,thumbnail_url,permalink,timestamp&access_token=$user_access_token";

$response = file_get_contents($endpoint);
$data = json_decode($response, true);

// Return the JSON response to the JavaScript
header('Content-Type: application/json');
echo json_encode($data);
?>

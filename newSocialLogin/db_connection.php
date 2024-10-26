<?php
// Database connection
$db_host = 'localhost';
$db_user = 'srishrin_juser';
$db_password = 'juser123';
$db_name = 'srishrin_jewels';

$db_connection = new mysqli($db_host, $db_user, $db_password, $db_name);

// CHECK DATABASE CONNECTION
if($db_connection->error){
    echo "Connection Failed - ".$db_connection->connect_error;
    exit;
}
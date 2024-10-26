<?php 

include($_SERVER['DOCUMENT_ROOT'].'/css/dash/esir/api/functions.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
date_default_timezone_set('Asia/Kolkata');

$usersql = mysqli_query($con,"select * from eng_app_version");
$total = mysqli_fetch_row($usersql);
$version = $total[0];
$array = array(['code'=>200,'version'=>$version]);
echo json_encode($array);
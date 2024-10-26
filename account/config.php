<?php session_start();
date_default_timezone_set('Asia/Kolkata');
// $con = mysqli_connect("localhost", "srishrinjuser", "juser123","srishrinjewels");
// $conn = mysqli_connect("localhost", "srishrinjuser", "juser123","srishrinjewels");
// $con3=mysqli_connect("localhost", "sarmicropos", "Mypos1234","sarmicrosrishringarr");



$con = mysqli_connect("localhost", "u464193275_srishrinjuser", "9b@hMgk!=zI","u464193275_srishrinjewels");
$conn = mysqli_connect("localhost", "u464193275_srishrinjuser", "9b@hMgk!=zI","u464193275_srishrinjewels");
$con3=mysqli_connect("localhost", "u464193275_sarmicropos", "Mypos1234","u464193275_srishringarr");

$pathmain="";


$file_version = 1.1;
$userid = $_SESSION['gid'];
?>
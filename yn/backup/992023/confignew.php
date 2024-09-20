<?php session_start();
include('function.php');
$con = new mysqli("localhost", "srishrin_juser", "juser123","srishrin_jewels") or die("Connect failed: %s\n". $con -> error);
$con3 = new mysqli("localhost", "sarmicro_pos", "Mypos1234","sarmicro_srishringarr") or die("Connect failed: %s\n". $con3 -> error);
echo '<pre>';print_r($con);echo '</pre>';
echo '<pre>';print_r($con3);echo '</pre>';
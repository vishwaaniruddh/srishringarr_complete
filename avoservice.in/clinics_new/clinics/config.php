<?php
$server = "localhost";
$username = "avoservi_clinic";
$password = "clinic123*";
// $dbname = "sarmicro_clinicmgt";
$dbname = "avoservi_clinicmgt";

// $con = mysqli_connect("localhost","root","","sarmicro_clinicmgt");
$con = mysqli_connect("localhost","avoservi_avo","Myaccounts123*","avoservi_clinicmgt");
date_default_timezone_set('Asia/Calcutta');
if(!$con){
    die("Connection Failed : " .mysqli_connect_error());
}


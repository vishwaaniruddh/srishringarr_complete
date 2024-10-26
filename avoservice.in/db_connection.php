<?php

error_reporting(0);
error_reporting(E_ALL);
date_default_timezone_set('Asia/Kolkata');

function OpenCon1()
 {
 $dbhost = "localhost";
 $dbuser = "u464193275_avoservi_avo";
 $dbpass = "Myaccounts123*";
 $db = "u464193275_avoser_service";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }

function OpenCon2()
 {
 $dbhost = "localhost";
 $dbuser = "avoservi_anirudd";
 $dbpass = "aniruddh";
 $db = "avoservi_crm";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }

function CloseCon($conn)
 {
 $conn -> close();
 }

?>
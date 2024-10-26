<?php
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "avoservi_avo";
 $dbpass = "Myaccounts123*";
 $db = "avoservi_service";
 
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
 
 ?>
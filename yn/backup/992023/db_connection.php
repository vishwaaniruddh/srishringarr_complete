<?php
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "srishrin_juser";
 $dbpass = "juser123";
 $db = "srishrin_jewels";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 
 function OpenNewCon()
 {
 $dbhost = "localhost";
 $dbuser = "sarmicro_pos";
 $dbpass = "Mypos1234";
 $db = "sarmicro_srishringarr";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 
function CloseCon($conn)
 {
  $conn->close();
 }
   
?>
<?php
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "esurv";
// $port = "3308";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 
 function OpenComsarmiCon()
 {
 $dbhost = "localhost";
 $dbuser = "comsarmi_DVR";
 $dbpass = "sar@1234";
 $db = "comsarmi_dvr_data";
// $port = "3308";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 
 function OpenNewCon()
 {
 $dbhost = "192.168.100.21";
 $dbuser = "esurv";
 $dbpass = "Esurv123*";
 $db = "esurv";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 
  function OpenSrishringarrCon()
 {
 $dbhost = "198.38.84.10";
 $dbuser = "sarmicro_pos";
 $dbpass = "Mypos1234";
 $db = "sarmicro_srishringarr";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 
function OpenNewSrishringarrCon()
 {
 $dbhost = "198.38.84.10";
 $dbuser = "srishrin_juser";
 $dbpass = "juser123";
 $db = "srishrin_jewels";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 } 
 
 function OpenPurchaseSrishringarrCon()
 {
 $dbhost = "198.38.84.10";
 $dbuser = "satyavan_pos123";
 $dbpass = "Mypos1234";
 $db = "satyavan_pos";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 } 
 
 function OpenSrishringarrPayrollCon()
 {   
 $dbhost = "198.38.84.10";
 $dbuser = "sarmicro_payroll";
 $dbpass = "vertrigo123sar45";
 $db = "sarmicro_payrolldb";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>
<?php
include('config.php');

$username = $_POST['uname'];
$password = $_POST['password'];
//echo $username." /".$password;
$result = mysql_query("select * from login where username='$username' and password='$password'");

if(mysql_num_rows($result)>0)
   {
   $row=mysql_fetch_row($result); 
   session_regenerate_id();  
   session_start();
    $_SESSION['user']=$username;
  
  
 header("location: welcome.php");
   }
else
   header("location: index.html");
?>
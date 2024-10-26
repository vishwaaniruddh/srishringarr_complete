<?php session_start();
//echo $_SESSION['user'];
unset($_SESSION['user']);
session_destroy();
header("location: index.html");
?>

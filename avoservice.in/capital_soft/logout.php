<?php session_start();
//echo $_SESSION['user'];
unset($_SESSION['user']);
unset($_SESSION['branch']);
unset($_SESSION['designation']);
session_destroy();
header("location: index.php");
?>

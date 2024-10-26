<?php
session_start();
include('../config.php');

$qry2=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");
$qry2ro=mysqli_fetch_row($qry2);

echo $_SESSION['user']."   Hi......  <br>";

echo $qry2ro[0]."   Hello.  <br>";
die;
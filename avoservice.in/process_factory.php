<?php
session_start();
include("config.php");
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

$user=$_SESSION['user'];

 
 
 $party=$_POST['party'];
 $address=$_POST['address'];
 $contact=$_POST['person'];
 $mobile=$_POST['mobile'];



$qry=mysqli_query($con1,"INSERT INTO `factories` (`factory_name`,`address`, `Contact`, `mobile`,`status`) VALUES ('".$party."', '".$address."','".$contact."', '".$mobile."','1')");


if($qry)  { ?>
    <script type="text/javascript">
alert("New Factory is Successfully updated!!");

		window.location.href="view_factory.php"; </script> 
<?
	
} else ?>

   <script type="text/javascript">
alert("Something went wrong !!");

		window.location.href="add_factory.php"; </script> 

<?php
session_start();
include("config.php");
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

$user=$_SESSION['user'];

 
 
 $product=$_POST['product'];


$qry=mysqli_query($con1,"INSERT INTO `factory_product_master` (`prod_name`,`status`, `created_by`) VALUES ('".$product."', '1', '".$user."')");


if($qry)  { ?>
    <script type="text/javascript">
alert("New Product Master is Successfully added!!");

		window.close(); </script> 
<?
	
} else ?>

   <script type="text/javascript">
alert("Something went wrong !!");

		window.close(); </script> 

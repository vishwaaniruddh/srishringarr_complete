<?php
session_start();
include("config.php");
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

$user=$_SESSION['user'];

 $product=$_POST['product'];
 $spec=$_POST['spec'];
 
$qry=mysqli_query($con1,"INSERT INTO `factory_productlist` (`prod_id`,`specs`, `status`, `created_by`) VALUES ('".$product."', '".$spec."','1', '".$user."')");


if($qry)  { ?>
    <script type="text/javascript">
alert("New Product line is Successfully added!!");

		window.location.href="add_products.php"; </script> 
<?
	
} else ?>

   <script type="text/javascript">
alert("Something went wrong !!");

		window.location.href="add_products.php"; </script> 

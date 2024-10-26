<?php
session_start();
include("config.php");
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

$user=$_SESSION['user'];

 
 $id=$_POST['id'];
 $party=$_POST['party'];
 $address=$_POST['address'];
 $contact=$_POST['person'];
 $mobile=$_POST['mobile'];
 $email=$_POST['email'];



$qry=mysqli_query($con1,"UPDATE `parties` set `party_name`='".$party."',`address`='".$address."', `contact`='".$contact."', `number`='".$mobile."',`email`='".$email."' where id='".$id."'");


if($qry)  { ?>
    <script type="text/javascript">
alert("Client Details Updated Successfully !!");

		window.location.href="view_party.php"; </script> 
<?
	
} else ?>

   <script type="text/javascript">
alert("Something went wrong !!");

		window.location.href="view_party.php"; </script> 

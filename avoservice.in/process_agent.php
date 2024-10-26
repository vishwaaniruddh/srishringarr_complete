<?php
session_start();
include("config.php");
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

$user=$_SESSION['user'];

 
 
 $agent=$_POST['agent'];
 $address=$_POST['address'];
 $contact=$_POST['person'];
 $mobile=$_POST['mobile'];
 $email=$_POST['email'];



$qry=mysqli_query($con1,"INSERT INTO `agents` (`agent_name`,`address`, `contact`, `number`,`email`,`status`) VALUES ('".$agent."', '".$address."','".$contact."','".$mobile."', '".$email."','1')");


if($qry)  { ?>
    <script type="text/javascript">
alert("New Agent is Successfully updated!!");

		window.location.href="add_agent.php"; </script> 
<?
	
} else ?>

   <script type="text/javascript">
alert("Something went wrong !!");

		window.location.href="add_agent.php"; </script> 

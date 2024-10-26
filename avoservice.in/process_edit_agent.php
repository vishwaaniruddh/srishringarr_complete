<?php
session_start();
include("config.php");
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

$user=$_SESSION['user'];

 
 $id=$_POST['id'];
 $agent=$_POST['agent'];
 $address=$_POST['address'];
 $contact=$_POST['person'];
 $mobile=$_POST['mobile'];
 $email=$_POST['email'];


$qry=mysqli_query($con1,"UPDATE `agents` set `agent_name`='".$agent."',`address`= '".$address."', `contact`='".$contact."', `number`='".$mobile."',`email`='".$email."' where id='".$id."'");


if($qry)  { ?>
    <script type="text/javascript">
alert("Agent Details are Updated Successfully !!");

		window.location.href="view_agent.php"; </script> 
<?
	
} else ?>

   <script type="text/javascript">
alert("Something went wrong !!");

		window.location.href="view_agent.php"; </script> 

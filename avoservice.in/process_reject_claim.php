<?php
session_start();
include("config.php");
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

$user=$_SESSION['user'];
$id= $_POST[id];
$remarks=$_POST['app_rem'];

$qr=mysqli_query($con1,"UPDATE daily_expenses set status='0', reject_remarks='".$remarks."' where id='".$id."'");

if ($qr) { ?>
<script type="text/javascript">
alert("Claim is Rejected !!");

		window.close(); </script> 
<? } else { ?>
    
    <script type="text/javascript">
alert("Something went wrong !!");

		window.close(); </script> 

<?  } ?>
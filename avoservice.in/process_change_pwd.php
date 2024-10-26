<?php
session_start();
include("config.php");
if(!$_SESSION['user'])
	header('location:index.php');
	
$pwd_qry=mysqli_query($con1,"select password from login where username='".$_SESSION['user']."'");

//echo "select password from login where username='".$_SESSION['user']."'";
$pwd=mysqli_fetch_array($pwd_qry);

//echo $pwd[0];
//echo $_REQUEST['cur_pwd'];
//echo $_REQUEST['new_pwd1'];
//echo $_REQUEST['new_pwd2'];


if($pwd[0] == $_REQUEST['cur_pwd'] && $_REQUEST['new_pwd1']==$_REQUEST['new_pwd2']){

	$update_pwd=mysqli_query($con1,"update login set password='".$_REQUEST['new_pwd1']."' where username='".$_SESSION['user']."'");
	
//echo "update login set password='".$_REQUEST['new_pwd1']."' where username='".$_SESSION['user']."'";

	if($update_pwd)
		header('location:change_pwd.php?success=1');
		else
		header('location:change_pwd.php?success=2');
		}
		else
		header('location:change_pwd.php?success=0');
?>
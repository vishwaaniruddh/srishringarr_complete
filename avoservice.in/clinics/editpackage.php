<?php
	include("config.php");
	session_start();
	$str="update package set amt='".$_REQUEST['amt']."' where packid='".$_REQUEST['packid']."'";
	$qry=mysql_query($str);
	//echo $str;
	if($qry)
	{
		$_SESSION['success']=1;
	}
	else
	{
		$_SESSION['success']=0;
	}
	header('location:viewpackage.php');
?>
<?php
	include('config.php');
	
	$temp=$_POST['temp'];
	$sql="insert into thank(name) values('$temp')";
	$result=mysql_query($sql);
?>
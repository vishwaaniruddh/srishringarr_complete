<?php
	include('config.php');
	
	$temp=$_POST['temp'];
	$sql="insert into meditemp(name) values('$temp')";
	$result=mysql_query($sql);
?>
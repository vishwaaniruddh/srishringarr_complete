<?php
	include('config.php');
	
	$hosp=$_POST['hosp'];
	$sql="insert into hospital(name) values('$hosp')";
	$result=mysql_query($sql);
?>
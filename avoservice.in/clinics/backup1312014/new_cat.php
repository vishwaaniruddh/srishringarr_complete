<?php
include('config.php');

$cat=$_POST['cat'];

$sql="insert into category (category) values('$cat')";

$result=mysql_query($sql);

if($result)
{
	header("location:home.php");
}
else
	echo "Error Inserting Data";




?>
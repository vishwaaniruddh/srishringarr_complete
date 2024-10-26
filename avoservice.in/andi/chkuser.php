<?php
include("../config.php");

$username=$_GET['username'];
$qry=("Select username from login where username='".$username."'");
//echo $qry;
$result=mysql_query($qry);

if(mysql_num_rows($result)>0)
	{
		$str="1";
	}
	else
	{
		$str="0";
	}
	echo json_encode($str);
?>

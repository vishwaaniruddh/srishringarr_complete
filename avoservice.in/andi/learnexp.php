<?php
include("../config.php");

$name=$_GET['name'];
$feed=$_GET['feed'];
$st=str_replace("'","\'",$feed);
$sql=mysql_query("Insert into testme(`name`,`feedback`)Values('".$name."','".$st."')");
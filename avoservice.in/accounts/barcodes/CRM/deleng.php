<?php
include("config.php");
$id=$_GET['engid'];
$qry=mysql_query("Update  `satyavan_sunrise`.`phppos_engineer` set status=1 where id='".$id."'");
/*if(!$qry)
echo "".mysql_error();*/
if($qry)
header('location:engperforma.php');
else
echo "error".mysql_error();
?>
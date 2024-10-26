<?php
ini_set( "display_errors", 0);
include("datacon.php");


$id=$_GET['eid'];
$sumpd=0;
$bal=0;

/////count total retun
$qry1="SELECT baseyear FROM  salary  where empid='$id' ";
$res1=mysql_query($qry1);                
$num1=mysql_num_rows($res1);
$row1=mysql_fetch_row($res1);

echo $row1[0];				 				 
?>

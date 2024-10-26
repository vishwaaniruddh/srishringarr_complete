<?php
ini_set( "display_errors", 0);
include('config.php');

       $id=$_GET['cid'];

$sumpd=0;
$bal=0;

/////count total retun
$qry1="SELECT person_id FROM  phppos_people  where phone_number='$id' ";
$res1=mysql_query($qry1);                
$num1=mysql_num_rows($res1);
$row1=mysql_fetch_row($res1);

echo $num1."&&".$row1[0];				 				 
?>

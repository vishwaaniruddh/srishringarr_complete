<?php
ini_set( "display_errors", 0);

$con = mysql_connect("localhost","satyavan_sunrise","sunrise123*");
mysql_select_db("satyavan_sunrise",$con);

	$item=$_GET['item'];
		 
       
        	$qry="SELECT * FROM  `phppos_items` where name='$item'";
        

$res=mysql_query($qry); 
$row=mysql_fetch_row($res);
$str=$row[3]."###".$row[0];
echo $str;
	 
?>


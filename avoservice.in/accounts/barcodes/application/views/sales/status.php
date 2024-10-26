<?php
$con = mysql_connect("localhost","satyavan_sunrise","sunrise123*");
mysql_select_db("satyavan_sunrise",$con);

$id=$_GET['id'];

$sql="update `phppos_order` set status='delivered' where sales_id='".$id."'";

$result=mysql_query($sql);

if($result)
{
	
header("location: pending_order.php");

}
else
echo "error Updating data";
?>
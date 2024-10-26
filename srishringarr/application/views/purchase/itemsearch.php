<?php
include("config.php");
$name=$_GET['qu'];

//echo "select username from login where 1";
$sql=mysql_query("select name from phppos_items where name='".$name."' ");
if(mysql_num_rows($sql) > 0)
{
echo "taken";
}
else{echo "ok";};


?>
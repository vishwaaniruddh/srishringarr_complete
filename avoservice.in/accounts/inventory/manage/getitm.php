<?php
include("config.php");

$itmcode=$_GET['itmcode'];

$qry=mysql_query("select * from `item_details` where `item_code`='".$itmcode."'");
$row=mysql_fetch_row($qry);

echo $row[1]."****".$row[2]."****". $row[3]."****".$row[4]."****".$row[5]."****".$row[6]."****".$row[7]."****".$row[8]."****".$row[9]."****".$row[10]."****".$row[11];

?>
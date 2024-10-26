<?php
include('config.php');
$bank_id=$_GET['bank_id'];
$qrybal=mysql_query("SELECT * FROM `banks` where `bank_id`='$bank_id'");
$row=mysql_fetch_row($qrybal);
echo $row[6];

?>
<?php
include('config.php');

$sql=mysql_query("SELECT * FROM `approval` WHERE bill_id in (SELECT  `bill_id` 
FROM  `paid_amount` )");
while($row=mysql_fetch_row($sql)){
	
	mysql_query("update paid_amount set bill_id='$row[1]' where bill_id='$row[0]'");
	
}

?>
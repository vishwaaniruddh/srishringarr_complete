<?php
include('config.php');

$sql=mysql_query("SELECT * FROM   `surgery1`  WHERE `s_real_id`=''");
while($row=mysql_fetch_row($sql)){

mysql_query("UPDATE    `surgery1`  SET  `s_real_id` = 'Z-$row[37]' WHERE  `s_id` =$row[37]");

}
?>
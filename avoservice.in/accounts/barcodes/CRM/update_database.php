<?php
include('config.php');

$sql=mysql_query("select * from phppos_service1 ");
while($row=mysql_fetch_row($sql)){

mysql_query("update phppos_service1 set cr_id='T-$row[0]' where id='$row[0]' and amc_cust=''");

}

?>
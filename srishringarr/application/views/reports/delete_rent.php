<?php
ini_set( "display_errors", 0);

include('config.php');

$id=$_GET['id'];

 
  mysql_query("DELETE FROM `order_detail` WHERE `bill_id`='$id'");
   mysql_query("DELETE FROM `phppos_rent` WHERE `bill_id`='$id'");




header('location:../../../application/views/reports/rent_return.php');


?>
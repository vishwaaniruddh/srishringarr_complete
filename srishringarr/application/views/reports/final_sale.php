<?php
include('config.php');
$id=$_POST['bill_id'];

mysql_query("update approval set status='S' where bill_id='$id'");
header('location:app_return.php');
  
?>
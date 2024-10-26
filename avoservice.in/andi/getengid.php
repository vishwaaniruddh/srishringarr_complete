<?php
include('../config.php');
$alert=$_GET['alertid'];
$oldeng=mysql_query("select engineer from alert_delegation where alert_id='".$alert."'");
$getold=mysql_fetch_row($oldeng);
echo json_encode($getold[0]);
?>


<?php
function getcenter($ip)
{
include("config.php");
//echo "select center from login where ip='".$ip."'";
$qry=mysql_query("select center from login where ip='".$ip."'");
$row=mysql_fetch_row($qry);
//echo "center=".$row[0];
return $row[0];
}
?>
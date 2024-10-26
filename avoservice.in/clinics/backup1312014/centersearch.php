<?php
require_once "config.php";
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select name from area where name LIKE '$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['name'];
	echo "$cname\n";
}
?>
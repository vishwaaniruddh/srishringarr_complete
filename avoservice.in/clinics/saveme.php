<?php
include('config.php');

$txt=$_GET['savetxt'];
//echo $txt;
//echo "update scratchnotes set notes='".$txt."'";

$qry=mysql_query("update scratchnotes set notes='".$txt."'");
//if($qry)
?>
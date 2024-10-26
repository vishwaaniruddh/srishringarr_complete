<?php
if(isset($_POST['updfeed']))
{
include("config.php");	
if($_POST['feed']!='')
{
$qry=mysql_query("Insert into phppos_custfeedback(`person_id`,`dt`,`feedback`) Values('".$_POST['cid']."',Now(),'".$_POST['feed']."')");
if($qry)	
header('location:expired.php');
else
echo "failed".mysql_error();
}
else
header('location:expired.php');
}
?>
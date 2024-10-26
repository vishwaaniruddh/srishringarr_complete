<?php
session_start();
if(!isset($_SESSION['user']))
echo "0";
else
{
include("config.php");
$gid=$_GET['cust'];

$bnk=mysql_query("select * from `whatsapp_customer` where group_id='".$gid."'");
while($bnkro=mysql_fetch_array($bnk))

$whtsno[]=$bnkro[4];
$client=implode(",",$whtsno);
//$client=str_replace(",","','",$client);

echo $client;    

}
?>
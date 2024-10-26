<?php
include("config.php");
$amcid=$_GET['ref'];
$type=$_GET['type'];
//================AMC SITE ===============FROM AMC TABLE=========
if($type=='amc')
{
$qry=mysql_query("select * from Amc where amcid='".$amcid."'");
$amcrow=mysql_fetch_row($qry);
$cc=mysql_query("select email from emailid where custid='".$amcrow[1]."' and bank='".$amcrow[4]."'");
$ccro=mysql_fetch_row($cc);
echo $amcrow[1]."***".$amcrow[2]."***".$amcrow[3]."***".$amcrow[4]."***".$amcrow[12]."***".$amcrow[7]."***".$amcrow[9]."***".$amcrow[6]."***".$amcrow[5]."***".$ccro[0]."***".$amcrow[8]."***".$amcrow[0]."***".$amcrow[11]."***".$amcrow[21]."***".$amcrow[13];
}
//==================== SITE================ FROM ATM TABLE
if($type=='site')
{
//echo "select * from atm where track_id='".$amcid."'";
$qry=mysql_query("select * from atm where track_id='".$amcid."'");
$amcrow=mysql_fetch_row($qry);
$cc=mysql_query("select email from emailid where custid='".$amcrow[1]."' and bank='".$amcrow[4]."'");
$ccro=mysql_fetch_row($cc);
echo $amcrow[2]."***".$amcrow[11]."***".$amcrow[1]."***".$amcrow[3]."***".$amcrow[14]."***".$amcrow[6]."***".$amcrow[9]."***".$amcrow[5]."***".$amcrow[4]."***".$ccro[0]."***".$amcrow[7];
}
?>
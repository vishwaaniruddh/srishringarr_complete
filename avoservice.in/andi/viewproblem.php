<?php
include("../config.php");
$alertid=$_GET['alertid'];
$qry=mysql_query("Select * from alert where alert_id='".$alertid."'");
$row=mysql_fetch_row($qry);
$str='';

$str.=$row[9];
if($row[28]=='1')
{
$buy=mysql_query("select * from buyback where alertid='".$row2[0]."'");
 $buyro=mysql_fetch_row($buy);
 $str.="Buy Back :".$buyro[2];

}
echo json_encode($str);
?>
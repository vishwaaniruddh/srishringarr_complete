<?php
include("config.php");
$medid=$_GET['mid'];
$tp=$_GET['tp'];
if($tp=='open')
{
$qry=mysql_query("update curstock set stock=stock-1,inuse=inuse+1 where medid=$medid");
if($qry)
header("location:stock.php");
else
echo "Some Error Occurred. Please go back and try again";
}
elseif($tp=='finish')
{
$qry=mysql_query("update curstock set inuse=inuse-1 where medid=$medid");
if($qry)
header("location:stock.php");
else
echo "Some Error Occurred. Please go back and try again";

}
?>
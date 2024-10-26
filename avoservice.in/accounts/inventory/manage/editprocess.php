<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ITEM DETAILS</title>
</head>

<body bgcolor="#CCFF33">
<?php
include("config.php");
$item=$_POST['item'];
$purity=$_POST['purity'];
$gw=$_POST['gw'];
$nw=$_POST['nw'];
$dw=$_POST['dw'];
$dw2=$_POST['dw2'];
$csw=$_POST['csw'];
$party=$_POST['party'];
$mkr=$_POST['mkr'];
$mrp=$_POST['mrp'];
$itype=$_POST['itype'];
$ptype=$_POST['ptype'];
//echo "UPDATE `item_details` SET `purity`='$purity',`gw`='$gw',`nw`='$nw',`dw`='$dw',`dw2`='$dw2',`csw`='$csw',`party`=$party,`making`='$mkr',`itype`='$itype',`ptype`='$ptype',`mrp`='$mrp' where `item_code`='".$item."'";

$qry=mysql_query("UPDATE `item_details` SET `purity`='$purity',`gw`='$gw',`nw`='$nw',`dw`='$dw',`dw2`='$dw2',`csw`='$csw',`party`='$party',`making`='$mkr',`itype`='$itype',`ptype`='$ptype',`mrp`='$mrp' where `item_code`='".$item."'");

// $qry=mysql_query("insert into item_details values('$item','$purity','$gw','$nw','$dw','$dw2','$csw','$party','$mkr','$itype','$ptype','$mrp')");
//echo "insert into item_details values('$item','$purity','$gw','$nw','$dw','$dw2','$csw')";
if($qry)
   echo "<center>Updated Successful. Click <a href=itemdetails.php >here</a> for another entry</center>";
   else{
   echo "<center>Error Occured. Click <a href=itemdetails.php >here</a> to try again</center>";
   echo "<center>". mysql_error()."</center>";
   }
?>
</body>
</html>
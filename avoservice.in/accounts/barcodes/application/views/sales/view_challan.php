<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SUNRISE - Powered By Point Of Sale</title>
</head>
<?php
$con = mysql_connect("localhost","satyavan_sunrise","sunrise123*");
mysql_select_db("satyavan_sunrise",$con);
$sql=mysql_query("select * from phppos_challan");
?>

<body>
<center>
<h3>View Challans</h3>
<table border="1" cellpadding="2" cellspacing="0">
<th>Challan No</th>
<th>Customer</th>
<!--<th>Item No</th>
<th>Item Name</th>
<th>Quantity Purchased</th>-->
<th>Print Challan</th>
<?php 
while($row=mysql_fetch_row($sql)){ 
$sql1=mysql_query("select * from phppos_challan_items where sale_id='$row[0]'");
$row1=mysql_fetch_row($sql1);

$sql2=mysql_query("select * from phppos_people where person_id='$row[1]'");
$row2=mysql_fetch_row($sql2);

$sql3=mysql_query("select * from phppos_items where item_id='$row1[1]'");
$row3=mysql_fetch_row($sql3);
?>
<tr>
<td><?php echo $row1[0];?></td>
<td><?php echo $row2[0]." ".$row2[1]; ?></td>
<!--<td><?php //echo $row3[3];?></td>
<td><?php //echo $row3[0];?></td>
<td><?php //echo $row[2];?></td>-->
<td width="92"><a href="print_challan.php?id=<?php echo $row[0]; ?>&uid=<?php echo $row[2]; ?>" target="_blank">Print Challan</a></td>
</tr>
<?php } ?>
</table>
</center>
</body>
</html>
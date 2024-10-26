<style>
body { background-color:#1e8bce;}
.button{ background-color:#ac0404;border:2px solid #000;font:14px Arial, Helvetica, sans-serif;height:30px;padding:5px 10px;color:#fff;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;behavior:url(js/PIE.htc);position:relative; cursor:pointer;}
a{color:#FFF;}
</style>
<?php
$con = mysql_connect("localhost","satyavan_sunrise","sunrise123*");
mysql_select_db("satyavan_sunrise",$con);
?>
<h3 align="center">Pending Orders</h3>


<table width="864" align="center" border="1" cellpadding="4" cellspacing="0">
  <tr>
<th width="64" height="22">Sr No.</th>
<th width="117">Sales No.</th>
<th width="109">Sales Date</th>
<th width="206">Customer Name</th>
<th width="248">Customer Address</th>
<!--<th width="92">View Detail</th>-->
<th width="92">Print Challan</th>
<th width="92">Status</th>
</tr>
<?php
$i=1;
$sql=mysql_query("SELECT * FROM `phppos_sales` WHERE `sale_id` in (SELECT sales_id FROM  `phppos_order` where status='pending')");
while($row=mysql_fetch_row($sql)){
$sql1=mysql_query("SELECT * FROM `phppos_people` WHERE `person_id`='$row[1]'");
$row1=mysql_fetch_row($sql1);
?>
<tr>
<td><?php echo $i++; ?></td>
<td><?php echo $row[4]; ?></td>
<td><?php if(isset($row[0]) and $row[0]!='0000-00-00') echo date('d/m/Y',strtotime($row[0])); ?></td>
<td><?php echo $row1[0]." ".$row1[1]; ?></td>
<td><?php echo $row1[4].",".$row1[5].",".$row1[6].",".$row1[7].",".$row1[8]; ?></td>
<!--<td><a href="http://sarmicrosystems.in/sunrise/index.php/sales/receipt/<?php //echo $row[4]; ?>" target="_blank">View Detail</a></td>-->

<td width="92"><a href="http://sarmicrosystems.in/sunrise/index.php/sales/challan/<?php echo $row[4]; ?>" target="_blank">Print Challan</a></td>
<td><input name="st" id="st" type="checkbox"  onclick="window.location.href='status.php?id=<?php echo $row[4]; ?>'" /></td>
</tr>
<?php } ?>
</table><br><br>
<center>
<input type="button" value="Back" class="button" onclick="javascript:location.href = 'http://sarmicrosystems.in/sunrise/index.php/home';"/>
</center>
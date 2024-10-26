<?php
include('config.php');
$cid=$_GET['cid'];
if($cid=="sales"){
?>
<select name="cname" id="cname" onchange="MakeRequest();">
<option value="0">select</option>
<?php
include('config.php');
$result = mysql_query("SELECT * FROM  phppos_service order by name");
while($row = mysql_fetch_row($result)){ 
?>
<option value="<?php echo $row[18]; ?>"><?php echo $row[2]; ?></option>
<?php } ?>
</select>
<?php } else if($cid=="service") {?>

<select name="cname" id="cname" onchange="MakeRequest();">
<option value="0">select</option>
<?php
include('config.php');
$result = mysql_query("SELECT * FROM  phppos_service1 where amc_cust<>'' order by name");
while($row = mysql_fetch_row($result)){ 
?>
<option value="<?php echo $row[9]; ?>"><?php echo $row[2]; ?></option>
<?php } ?>
</select>

<?php } else{ ?>
<select name="cname" id="cname">
<option value="0">select</option>
<?php
include('config.php');
$result = mysql_query("SELECT * FROM  phppos_service1 where amc_cust='' order by name");
while($row = mysql_fetch_row($result)){ 
?>
<option value="<?php echo $row[9]; ?>"><?php echo $row[2]; ?></option>
<?php } ?>
</select>&nbsp;&nbsp;&nbsp;<a href="service.php">New Customer Request</a>
<?php } ?>
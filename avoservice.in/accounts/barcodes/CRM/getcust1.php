<?php
include('config.php');
$cid=$_GET['cid'];
if($cid=="sales"){
?>
<input type="hidden" value="<?php echo $cid ?>" name="cst_type" id="cst_type"/>
<select name="cname" id="cname" onchange="MakeRequest();">
<option value="0">select</option>
<?php
$result = mysql_query("SELECT * FROM  phppos_service order by name");
while($row = mysql_fetch_row($result)){ 
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
<?php } ?>
</select>
<?php } else {?>

<input type="hidden" value="<?php echo $cid ?>" name="cst_type" id="cst_type"/>
<select name="cname" id="cname" onchange="MakeRequest();">
<option value="0">select</option>

<?php

$result = mysql_query("SELECT * FROM  phppos_service1 order by name ASC");
while($row = mysql_fetch_row($result)){ 
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
<?php } ?>
</select>&nbsp;&nbsp;&nbsp;<a href="service1.php">New Service Customer</a>


<?php } ?>
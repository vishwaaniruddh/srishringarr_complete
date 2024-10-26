<?php
$id=$_GET['id'];
$prob=$_GET['prob'];
include("config.php");
 //echo "select distinct(bank_name) from alert where cust_id='".$id."' and alert_id in (select alertid from siteproblem where probid='".$prob."')";
$qry=mysqli_query($con1,"select distinct(bank_name) from alert where cust_id='".$id."' and alert_id in (select alertid from siteproblem where probid='".$prob."')");
?>
<option value="">Select</option>
<?php
while($row=mysqli_fetch_row($qry)){
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php	
}
?>
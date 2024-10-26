<?php
include("config.php");
$custid=$_GET['cust'];
/* ?>


<option value="">Select PO</option>
<?php
$qry=mysqli_query($con1,"select * from installed_sites where custid='".$custid."'");
while($row=mysqli_fetch_array($qry))
{
	?>
    <option value="<?php echo $row[2]."####site"; ?>"><?php echo $row[2];  ?></option>
    <?php
}*/
//echo "select * from Amc where cid='".$custid."' and po<>''";
$qry=mysqli_query($con1,"select * from Amc where cid='".$custid."' and po<>''");

while($row=mysqli_fetch_array($qry))
{
	
	?>
    <option value="<?php echo $row[2]; ?>"><?php echo $row[2];  ?></option>
    <?php
}
?>

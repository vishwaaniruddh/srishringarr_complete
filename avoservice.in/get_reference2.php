<?php
include("config.php");
//$cust=$_GET['cust'];
$po=$_GET['po'];
echo "Select * from Amc where po='".$po."'";
//$type=$_GET['type'];
//echo "Select distinct(Ref_id) from installed_sites where custid='".$cust."' and po='".$po."'";
?>
<option value="">Select Atm</option>
<?php


$qry=mysqli_query($con1,"Select * from Amc where po='".$po."'");
while($row=mysqli_fetch_array($qry))
{
	?>
    <option value="<?php  echo $row[0];   ?>"><?php echo $row[3];  ?></option>
    <?php
}
?>
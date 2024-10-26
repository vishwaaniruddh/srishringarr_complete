<?php
include("config.php");
$cust=$_GET['cust'];
$po=$_GET['po'];
$type=$_GET['type'];

?>
<option value="">Select Reference</option>
<?php
if($type=='site')
$qry=mysqli_query($con1,"Select Ref_id from installed_sites where custid='".$cust."' and po='".$po."'");
elseif($type=='amc')
$qry=mysqli_query($con1,"Select Ref_id from amc where cid='".$cust."' and po='".$po."'");
while($row=mysqli_fetch_array($qry))
{
	?>
    <option value="<?php echo $row[0];  ?>"><?php echo $row[0];  ?></option>
    <?php
}
?>
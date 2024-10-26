<?php
include("config.php");
$brid=$_GET['brid'];
?>

<select name="specs" id="specs" >
<option value="">-Select-</option>
<?php
$state=mysqli_query($con1,"select * from assets_specification where assets_id='".$brid."' order by name ASC");
while($stro=mysqli_fetch_array($state))
{
?>
<option value="<?php echo $stro[0]; ?>"><?php echo $stro[2]; ?></option>
<?php
}
?>
</select>

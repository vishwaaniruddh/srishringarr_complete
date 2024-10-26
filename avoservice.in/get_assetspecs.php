<?php
include("config.php");
$brid=$_GET['brid'];
?>

<select name="specs" id="specs" >
<option value="">-Select-</option>
<?php
$prodqr=mysqli_query($con1,"select * from assets where assets_name='".$brid."'");
$prod=mysqli_fetch_row($prodqr);

$state=mysqli_query($con1,"select * from assets_specification where assets_id='".$prod[0]."' order by name ASC");
while($stro=mysqli_fetch_array($state))
{
?>
<option value="<?php echo $stro[0]; ?>"><?php echo $stro[2]; ?></option>
<?php
}
?>
</select>

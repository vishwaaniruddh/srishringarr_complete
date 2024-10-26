<?php
include("config.php");
$prod_name=$_GET['brid'];

//$prod_name ="UPS";
?>

<select name="specs" id="specs" >
<option value="">-Select-</option>
<?php
$prodqry=mysqli_query($con1,"select * from assets where assets_name='".$prod_name."'");
$prod_id=mysqli_fetch_row($prodqry);

$state=mysqli_query($con1,"select * from assets_specification where assets_id='".$prod_id[0]."' order by name ASC");
while($stro=mysqli_fetch_array($state))
{
?>
<option value="<?php echo $stro[0]; ?>"><?php echo $stro[2]; ?></option>
<?php
}
?>
</select>

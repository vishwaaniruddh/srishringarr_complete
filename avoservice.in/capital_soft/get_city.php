<?php
$state=$_GET['state'];
include('config.php');

?>

<select name="city" id="city" >
<option value="0">--Select--</option>
<?php
$qry=mysqli_query($concs,"select * from cities where state_id='".$state."' and status='1' order by city ASC");
while($stroo=mysqli_fetch_array($qry))
{
?>
<option value="<?php echo $stroo[0]; ?>"><?php echo $stroo[1]; ?></option>
<?php
}
?>
</select>

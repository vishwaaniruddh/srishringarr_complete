<?php
include("config.php");
$brid=$_GET['brid'];
?>

<select name="state" id="state" >
<!--<option value="0">--Select--</option> -->
<?php
$state=mysqli_query($con1,"select * from state where branch_id='".$brid."' order by state ASC");
while($stro=mysqli_fetch_array($state))
{
?>
<option value="<?php echo $stro[0]; ?>"><?php echo $stro[1]; ?></option>
<?php
}
?>
</select>

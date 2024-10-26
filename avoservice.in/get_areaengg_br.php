<?php
include("config.php");
$brid=$_GET['brid'];
?>

<select name="Employee_name" id="Employee_name" >
<option value="">--Select--</option>
<?php
$engr= mysqli_query($con1,"select engg_id, engg_name from area_engg where status=1 and deleted=0 and area='".$brid."'");

while($stro=mysqli_fetch_array($engr))
{

?>
<option value="<?php echo $stro[0]; ?>"><?php echo $stro[1]; ?></option>
<?php
}
?>
</select>

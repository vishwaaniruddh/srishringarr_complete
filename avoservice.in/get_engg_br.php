<?php
include("config.php");
$brid=$_GET['brid'];
?>

<select name="Employee_name" id="Employee_name" >
<option value="">--Select--</option>
<?php
$state=mysqli_query($con1,"select engg_id from area_engg where area='".$brid."' and status=1 and deleted=0 order by engg_name ASC");

while($stro=mysqli_fetch_array($state))
{
 $engr= mysqli_query($con1,"select engg_id, engg_name from area_engg where engg_id='".$stro[0]."' ");
   
   $name= mysqli_fetch_row($engr);

?>
<option value="<?php echo $name[0]; ?>"><?php echo $name[1]; ?></option>
<?php
}
?>
</select>

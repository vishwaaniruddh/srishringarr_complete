<?php
$exphead=$_GET['state'];
include('config.php');

?>

<select name="exp_type" id="exp_type" >
<option value="">Select</option>
<?php
$qry=mysqli_query($con1,"select * from br_exptype where exp_headid='".$exphead."' and status='1' order by id ASC");
while($stroo=mysqli_fetch_array($qry))
{
?>
<option value="<?php echo $stroo[0]; ?>"><?php echo $stroo[2]; ?></option>
<?php
}
?>
</select>

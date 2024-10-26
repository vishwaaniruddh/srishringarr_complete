<?php
$state=$_GET['state'];
include('config.php');

//$state="Tech";

?>

<select name="Job_Specific" id="Job_Specific" >
<option value="0">--Select--</option>
<?php
 $qry1="select id from deparment where dep_name = '".$state."'";
$result=mysqli_query($con1,$qry1);
$row1 = mysqli_fetch_row($result);

$qry=mysqli_query($con1,"select * from Job_Specific where dept_id='".$row1[0]."' order by id ASC");
//echo "select * from Job_Specific where dept_id='".$row1[0]."' order by id ASC";
while($stroo=mysqli_fetch_array($qry))
{
?>
<option value="<?php echo $stroo[0]; ?>"><?php echo $stroo[1]; ?></option>
<?php
}
?>
</select>
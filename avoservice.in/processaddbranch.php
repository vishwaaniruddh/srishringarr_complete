<?php
include("config.php");


 $city=$_POST['brcity'];
 $state=$_POST['state'];
 $badd=$_POST['bradd'];
 $bpin=$_POST['brpin'];
 $logid=$_POST['logid'];
 $id=$_POST['id'];
$id2=0;
$cnt=0;
$qry=mysqli_query($con1,"INSERT INTO `branch_details` (`branchid`, `state`, `badd`, `city`, `pin`) VALUES (NULL, '".$state."', '".$badd."', '".$city."', '".$bpin."');");
$brid=mysqli_insert_id();
if($qry)
{
//echo "Update login set branch=branch',".$state."' where srno='".$logid."'";

$qry2=mysqli_query($con1,"Update login set branch=CONCAT_WS(',', branch,$state) where srno='".$logid."'");
if(!$qry2)
echo "Some Error Occurred. Please go back and fill the form again";
else
{
//echo "update branch_head set branchid=branch.',".$brid."' where head_id='".$id."'";
$qry3=mysqli_query($con1,"update branch_head set branchid=CONCAT_WS(',', branchid,$brid) where head_id='".$id."'");
if(!$qry3)
echo "<br> qer3=".mysqli_error();
else
{
?>
<script type="text/javascript">
if (confirm("Do you want to assign more branch to this person"))
	{
		document.location="addbranch.php?id=<?php echo $id; ?>&hid=<?php echo $logid;  ?>";
	}
	else
	document.location="view_cityhead.php";
</script>
<?php
}}
}
else
echo "Some Error Occurred. Please go back and fill the form again";

?>
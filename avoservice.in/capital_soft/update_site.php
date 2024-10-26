<?php
include("config.php");
session_start();

$id=$_POST['id'];
$bank=$_POST['bank'];
$branch=$_POST['state']; // Branch
$city=$_POST['city'];

$area=$_POST['area'];
$pin=$_POST['pin'];

$add=$_POST['add'];
$type=$_POST['type'];
$atmid=$_POST['atmid'];
$expdate1=$_POST['startdt']; /// Actually Expiry date
$dt=str_replace("/","-",$expdate1);
$expdate=date('Y-m-d', strtotime($dt));

//=============start updating from heree========================================
 
if($type=='amc')
$sql="Update Amc set branch='".$branch."', city='".$city."',pincode='".$pin."',address='".$add."',atmid='".$atmid."',bankname='".$bank."', area='".$area."' ,amc_ex_date='".$expdate."' where amcid='".$id."' ";

$update=mysqli_query($concs,$sql);

if($update)
{
	?>
<script type="text/javascript">
alert("Site has been Edited successfully");
window.onunload = refreshParent;
        function refreshParent() {
           window.opener.location.reload();
        }
		window.close(); 
</script>
<?php	
}
else
echo "Error in Updating ";
?>
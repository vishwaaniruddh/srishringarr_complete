<?php
include("config.php");
session_start();

$id=trim($_POST['id']);
$bank=$_POST['bank'];
$branch=$_POST['state']; // Branch
$city=$_POST['city'];

$area=$_POST['area'];
$pin=$_POST['pin'];
$state=$_POST['state_s'];

$add=$_POST['add'];
$type=$_POST['type'];
$atmid=$_POST['atmid'];
$expdate1=$_POST['startdt']; /// Actually Expiry date
$dt=str_replace("/","-",$expdate1);
$expdate=date('Y-m-d', strtotime($dt));

//=============start updating from heree========================================
 
if($type=='amc')
$sql="Update Amc set branch='".$branch."', city='".$city."',pincode='".$pin."',address='".$add."',atmid='".$atmid."',bankname='".$bank."', area='".$area."' ,amc_ex_date='".$expdate."',state='".$state."' where amcid='".$id."' ";

elseif($type=='new')
$sql="Update atm set branch_id='".$branch."', city='".$city."',pincode='".$pin."',address='".$add."',atm_id='".$atmid."',bank_name='".$bank."', area='".$area."',state1='".$state."' where track_id='".$id."' ";



$update=mysqli_query($con1,$sql);

/*if($type='amc')
{
$cnt=0;
$puro=mysqli_query($con1,"update amcpurchaseorder set expdt='".$start."' where amcsiteid='".$id."'");

$qry=mysqli_query($con1,"select servicetype from Amc where amcid='".$id."'");
$row=mysqli_fetch_row($qry);
$qry2=mysqli_query($con1,"select date,id from servicemonth where siteid='".$id."'");
		while($row2=mysqli_fetch_array($qry2))
		{
		$cnt=$cnt+1;
		$i=$row[0]*$cnt;
		//echo "=i<br>".$start;
		$today = strtotime($start);
		$twoMonthsLater = strtotime("+".$i." months", $today);
		$dt=date('d-m-Y', $twoMonthsLater)."<br>";
		//echo "update servicemonth set date='".$dt."' where id='".$row2[1]."'";
		$up=mysqli_query($con1,"update servicemonth set date='".$dt."' where id='".$row2[1]."'");
		}
}
*/

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
<?php
 $id=$_GET['id'];
include("config.php");
$qry=mysqli_query($con1,"select branchid,loginid from branch_head where head_id='".$id."'");
$row=mysqli_fetch_row($qry);
$qry2=mysqli_query($con1,"update branch_head set status='1' where head_id='".$id."'");
$qry3=mysqli_query($con1,"update login set status=1 where srno='".$row[1]."'");


if($qry2 && $qry3)
{
	header('Location:view_cityhead.php');
}
else
echo "Error Activating the ID";

?>
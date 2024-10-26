<?php
include('access.php');
include("config.php");

//$stype=$_GET['stype'];
$ptype=$_GET['ptype'];
$id=$_GET['id'];
//$quen=$_GET['quen'];

 
   //echo "update problemtype set `problem`='".$ptype."' where `probid`='".$id."'";
   $tab=mysqli_query($con1,"update problemtype set `problem`='".$ptype."' where `probid`='".$id."'");
   if(!$tab)
   echo "failed".mysqli_error();
  
?>
<script type="text/javascript">
alert("Data uploaded successfully");
window.location='site_issue.php';
</script>
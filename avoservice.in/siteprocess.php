<?php
include('access.php');
include("config.php");

$stype=$_GET['stype'];
$ptype=$_GET['ptype'];
$quen=$_GET['quen'];

 
   //echo "Insert into problemtype(`problem`,`type`) Values('".$ptype."','".$stype."')";
   $tab=mysqli_query($con1,"Insert into problemtype(`problem`,`type`) Values('".$ptype."','".$stype."')");
   if(!$tab)
   echo "failed".mysqli_error();
   
   if($tab)
   for($i=0;$i<count($quen);$i++)
   {
   $qid=mysqli_query($con1,"select max(probid) from problemtype where 1");
   $qid1=mysqli_fetch_row($qid);
   //echo "Insert into query(`questtype`,`quest`) Values('".$qid1[0]."','".$quen[$i]."').<br>";
   $tabl=mysqli_query($con1,"Insert into query(`questtype`,`quest`) Values('".$qid1[0]."','".$quen[$i]."')");
   if(!$tabl)
   echo "failed".mysqli_error();
   }
   if($tabl)
   

?>
<script type="text/javascript">
//alert("Data uploaded successfully");
//window.location='site_issue.php';
</script>
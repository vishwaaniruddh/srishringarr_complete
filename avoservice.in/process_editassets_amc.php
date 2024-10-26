<?php
session_start();
include('config.php');

 	$cust=$_POST['cust'];
	$pordr=$_POST['po'];
	$id=$_POST['site_id'];


 	$assets=$_POST['assets'];
 	$qty=$_POST['qty'];
 	$warranty=$_POST['warranty'];




for($i=0;$i<sizeof($assets);$i++) {

	if(isset($assets[$i]))
	{
		//echo "UPDATE `amcassets` SET `assetspecid`='".$assets[$i]."' WHERE `id`='".$id[$i]."'" ;
		//echo "<br>";	
		
		$result1= mysqli_query($con1,"UPDATE `amcassets` SET `assetspecid`='".$assets[$i]."' WHERE `id`='".$id[$i]."'");
		
		}
	}


?>
<script type="text/javascript">
alert("You have updated successfully.");
//window.location='newinstalation_local.php';
</script>
<table width="100%">
<tr>
<td align="center">
<input type="button" value="Close" class="readbutton" onClick="self.close()" />

</td></tr></table>
<?php
session_start();
include('config.php');

 	$cust=$_POST['cust'];
	$pordr=$_POST['po'];
	$site_id=$_POST['site_id'];


 	$assets=$_POST['assets'];
 	$qty=$_POST['qty'];
 	$warranty=$_POST['warranty'];

for($i=0;$i<sizeof($assets);$i++) {

	if(isset($assets[$i]))
	{
		//echo "UPDATE `site_assets` SET `assets_spec`='".$assets[$i]."',`quantity`='". $qty[$i]."',`valid`='".$warranty[$i]."' WHERE `site_ass_id`='".$site_id[$i]."' " ;
	//echo "<br>";	
		
		$result1= mysqli_query($con1,"UPDATE `site_assets` SET `assets_spec`='".$assets[$i]."',`quantity`='". $qty[$i]."',`valid`='".$warranty[$i]."' WHERE `site_ass_id`='".$site_id[$i]."'");
		
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
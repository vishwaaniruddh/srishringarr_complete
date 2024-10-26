<?php
include('config.php');
$opdid=$_REQUEST['opdid'];
$errrors=0;
mysql_query("BEGIN");
for($i=0;$i<count($opdid);$i++)
{
	$amt=$_REQUEST['amt_'.$opdid[$i]];
	$amto=$_REQUEST['amt1_'.$opdid[$i]];
	if($amt!=$amto)
	{		
		//echo $opdid[$i]." - ".$amt." - ".$amto."<br/>";
		$opd_qry=mysql_query("INSERT INTO `opd_collection_edithist`(`opd_collection_id`, `appid`, `amt`, `date`, `status`, `patientid`, `center`, `paymode`, `problems`, `packid`) SELECT * FROM `opd_collection` WHERE `id` = '".$opdid[$i]."'");
		$opd_update_qry=mysql_query("update `opd_collection` SET `amt` = '".$amt."' WHERE `opd_collection`.`id` = '".$opdid[$i]."'");
		if(!$opd_qry || !$opd_update_qry)
		$errors++;
	}	
}
if($errors==0)
{
	mysql_query("COMMIT");
?>
<script type="text/javascript">
alert("Edited Successfully");
window.location='view_patient1.php';
</script>
<?php	
}
else
{
	mysql_query("ROLLBACK");
?>
<script type="text/javascript">
alert("Edited Failed, Please try again.");
window.location='view_patient1.php';
</script>
<?php	
}
?>
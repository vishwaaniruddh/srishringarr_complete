<?php
include('config.php');
$id=$_GET['id'];
$cid=$_GET['cid'];
//echo $id."/".$cid;
//echo "update `phppos_service` set ".$id."=Yes where id='$cid'";

$sql="update`phppos_service` set ".$id."='Yes' where id='$cid'";
$result=mysql_query($sql);

if($result)
{?>
<script>
alert("Data Has Beent Updated");
	window.location.href=' cust_service.php';
	</script>
	<?php
}
else
echo "Error Inserting Data";
?>
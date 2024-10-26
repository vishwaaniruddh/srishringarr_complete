<?php
include('config.php');

$id=$_GET['id'];
$tb=$_GET['tbl'];
$st=$_GET['st'];
//echo $id."/".$cid;
//echo "update ".$tb." set ".$st."=Yes where id='$id'";
if($tb=="phppos_amcservicestatus"){
$sql="update ".$tb." set ".$st."='Yes' where Amcservice_id='$id'";
}else{
$sql="update ".$tb." set ".$st."='Yes' where id='$id'";
}
$result=mysql_query($sql);

if($result)
{?>
<script>
alert("Data Has Beent Updated");
	window.location.href=' amcview.php';
	</script>
	<?php
}
else
echo "Error Inserting Data".mysql_error();
?>
<?php 
include('config.php');
$id=$_REQUEST['patid'];
$packr=mysql_query("select * from patient_package where patientid='".$id."' and status=0 order by id DESC limit 1");
$pac=mysql_fetch_array($packr);

$pack=mysql_query("select * from package where `packid`='".$_REQUEST['pack']."'");
$packro=mysql_fetch_row($pack);

$stdt=date('Y-m-d', strtotime($pac['startdt']));
$expdt=date('Y-m-d', strtotime($stdt .' + '.$packro[1].'-'.'1 day'));

$amt=$packro[2]-$_POST['disamt'];
//echo "Update patient_package set packid='".$packro[1]."',expdt='".$expdt."',amt='".$amt."',discount='".$_POST['disamt']."',degrade='".$_POST['degrade']."' where patientid='".$id."' and status=0 order by id DESC Limit 1";
$package=mysql_query("Update patient_package set packid='".$packro[1]."',expdt='".$expdt."',amt='".$amt."',discount='".$_POST['disamt']."',degrade='".$_POST['degrade']."' where patientid='".$id."' and status=0 order by id DESC Limit 1");
if($package)
{
?>
<script>
alert("Successfully updated.");
window.location="patient_detail.php?id=<?php echo $id; ?>";
</script>
<?php
}
//echo "1";
else
{

?>
<script>
alert("Updation Failed, please try again.");
window.location="degrade_pack.php?id=<?php echo $id; ?>";
</script>
<?php
//echo "Error in updating data.".mysql_error();
}
?>
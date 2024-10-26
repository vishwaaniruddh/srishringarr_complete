<?php
if(isset($_POST['cmdsub']))
{
include("config.php");
$appid=$_POST['appid'];
$amount=$_POST['amount'];
if($amount>0)
{
//	echo "Insert into opd_collection(`appid`,`amt`) Values('".$appid."','".$amount."')";
$qry=mysql_query("Insert into opd_collection(`appid`,`amt`,`patientid`) Values('".$appid."','".$amount."','".$_POST['pid']."')");
$qry2=mysql_query("update appoint set presstat='5' where app_real_id='".$appid."'");
if(!$qry)
echo "Failed ".mysql_error();
else
{
?>
<script type="text/javascript">
alert("Amount Paid Successfully");
window.close();
</script>
<?php
}
}
else
{
?>
<script type="text/javascript">
alert("Invalid Amount");
window.close();
</script>
<?php
}
}
else
{
?>
<script type="text/javascript">
//alert("Invalid Amount");
window.close();
</script>
<?php
}
?>
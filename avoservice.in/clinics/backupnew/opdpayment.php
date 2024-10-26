<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
include("config.php");
$appid=$_GET['appid'];
$patid=$_GET['pid'];
$amt=$_GET['amt'];
//echo "select a.no,a.app_date,a.block_id,a.slot,a.new_old,a.type,a.hospital,b.srno,b.name,b.mobile,a.status from appoint a,patient b where a.no=b.srno and a.app_real_id='".$appid."'";
$query =mysql_query("select a.no,a.app_date,a.block_id,a.slot,a.new_old,a.type,a.hospital,b.srno,b.name,b.mobile,a.status from appoint a,patient b where a.no=b.srno and a.app_real_id='".$appid."'");
$row=mysql_fetch_row($query);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>OPD Payment</title>
<script type="text/javascript">
function validate()
{
if(document.getElementById('amount').value=='' || document.getElementById('amount').value=='0')
{
alert("Please Enter Amount");
document.getElementById('amount').focus();
return false;
}
return true;
}
</script>
</head>

<body bgcolor="#00CCCC">
<center>

<form name="opdpay" method="post" action="processopdpay.php" onsubmit="return validate();">
<table border="0">
<tr><th>Patient Name :</th><td><?php echo $row[8]; ?></td></tr>
<tr><th>Contact :</th><td><?php echo $row[9]; ?></td></tr>
<tr><th>Customer Type:</th><td><?php if($row[4]=='O'){ echo "Old Customer"; } else{ echo "New Customer"; } ?></td></tr>
<tr><th>Enter Amount :</th><td><input type="text" name="amount" id="amount" value="0" /></td></tr>
<tr><th colspan="2" align="center"><input type="hidden" name="pid" value="<?php echo $patid; ?>" /><input type="hidden" name="appid" value="<?php echo $appid; ?>" /><input type="submit" name="cmdsub" value="Pay >>" /></th></tr>
</table>
</form></center>
<?php 
include('footer.html');
}else
{ 
 header("location: index.html");
}

?>
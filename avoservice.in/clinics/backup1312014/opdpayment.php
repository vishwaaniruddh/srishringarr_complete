<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
include("config.php");
$appid=$_GET['appid'];
$patid=$_GET['pid'];
$amt=$_GET['amt'];
$pat=mysql_query("Select name,mobile from patient where srno='".$patid."'");
$patro=mysql_fetch_row($pat);
//echo "select a.no,a.app_date,a.block_id,a.slot,a.new_old,a.type,a.hospital,b.srno,b.name,b.mobile,a.status from appoint a,patient b where a.no=b.srno and a.app_real_id='".$appid."'";
$query =mysql_query("select a.no,a.app_date,a.block_id,a.slot,a.new_old,a.type,a.hospital,b.srno,b.name,b.mobile,a.status from appoint a,patient b where a.no=b.srno and a.app_real_id='".$appid."'");
$row=mysql_fetch_row($query);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>OPD Payment</title>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
 <link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
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
function abc()
{
/*
alert("hi");
var str=document.getElementById('bank_account').value;
alert(str);*/

if(document.getElementById('bank_account').value==2)
{
document.getElementById('chqno').disabled=true;
document.getElementById('bname').disabled=true;
document.getElementById('Datechq').disabled=true;
//document.getElementById('button').disabled=true;

}
else
{

document.getElementById('chqno').disabled=false;
document.getElementById('bname').disabled=false;
document.getElementById('Datechq').disabled=false;
//document.getElementById('button').disabled=false;
} 
}
</script>
</head>

<body bgcolor="#00CCCC">
<center>

<form name="opdpay" method="post" action="processopdpay.php" onsubmit="return validate();">
<table border="0">
<tr><th>Patient Name :</th><td><?php echo $patro[0]; ?></td></tr>
<tr><th>Contact :</th><td><?php echo $patro[2]; ?></td></tr>
<tr><th>Customer Type:</th><td><?php  echo "Old Customer"; ?></td></tr>
 <tr>
    <td>Into Bank Account<font color="#FF0000">*</font> :</td>
    <td> &nbsp;<select name="bank_account" id="bank_account" onChange="abc();">
      <option value="">select</option>
<?php $result6 = mysql_query("select * from ".$cid."_bank_accounts");
$num=mysql_num_rows($result6);
             	 while($row6=mysql_fetch_array($result6)) 
				 {
    		?>
	<option value="<?php echo $row6[8]; ?>"><?php echo $row6[2]; ?></option>
	  <?php } ?>
      </select>
      </td>
  </tr>
  <tr><td> Bank Name:</td><td><input type="text" name="bname" id="bname" /></td></tr>
<tr><td>           Cheque No.:</td><td><input type="text" name="chqno" id="chqno" /></td></tr>
<tr><td>       Date of Cheque:</td><td> <input type="text"  name="Datechq" id="Datechq" onClick="displayDatePicker('Datechq');" value="<?php echo date("d/m/Y"); ?>"  /> Format:dd/mm/YYYY
</td></tr>
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
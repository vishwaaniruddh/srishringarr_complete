<?php
include("access.php");

$id=$_GET['id'];
$br=$_GET['br'];
include("config.php");
/*require_once('config.php');
$sq=mysql_query("select cust_id from alert where alert_id='$id'");
$ro=mysql_fetch_row($sq);

$sq1=mysql_query("select * from cust where id='$ro[0]'");
$ro1=mysql_fetch_row($sq1);
*/

include_once('class_files/filter.php');
	$ob=new filter();
	$tab=$ob->filter_by('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("cust_id"),'alert',array("alert_id"),array($id),'','');
	$ro=mysql_fetch_row($tab);
	//echo $ro[0];
	$tab1=$ob->filter_by('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("*"),'customer',array("cust_id"),array($ro[0]),'','');
	$ro1=mysql_fetch_row($tab1);
date_default_timezone_set('Asia/Kolkata');
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script>

function mail_value(){
	
if(document.getElementById('mail').checked==false){
	//alert("hi");
	document.getElementById('email').value="";
}
else
document.getElementById('email').value=document.getElementById('ml').value;
}

function responsetime(){
	
if(document.getElementById('response').checked==false){
	//alert("hi");
	document.getElementById('rtime').value="";
}
else
document.getElementById('rtime').value="<?php echo date("Y-m-d h:m:s"); ?>";
}
</script>
</head>

<body>
<center>

<?php include("menubar.php"); ?>
<h2>Update</h2>
<div id="header">
<form action="process_update.php" method="get" name="form">
<input type="hidden" name="ml" id="ml" value="<?php echo $ro1[2];  ?>" />
<table width="363">
<tr>
<td width="184" height="35">Update : </td>
<td width="167">
<textarea name="up" id="up" rows="4" cols="25"></textarea>
</td>
</tr>

<tr>
<td width="184" height="35">Send this update to client also : </td>
<td width="167">
<input type="checkbox" name="mail" id="mail" value="mail" onclick="mail_value();"/><input type="text" value="" name="email" id="email" readonly="readonly"/>
</td>
</tr>
<tr>
<td width="184" height="35">Make this as response time : </td>
<td width="167">
<input type="checkbox" name="respose" id="response" value="rtime" onclick="responsetime();"/><input type="text" value="" name="rtime" id="rtime" readonly="readonly"/>
</td>
</tr>
<tr>
<td height="35"><input type="submit" value="submit" class="readbutton"/></td>
<td><input type="button" value="cancel" class="readbutton" onclick="Javascript:location.href='view_alert.php'"/></td>
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="br" value="<?php echo $br; ?>" />
<input type="text" name="dt" value="<?php echo date("Y-m-d H:m:s"); ?>" id="dt" />
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
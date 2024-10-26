<?php
include("access.php");
include("config.php");

$id=$_GET['id'];
$br=$_GET['br'];
$ctype=$_GET['ctype'];


/*require_once('config.php');
$sq=mysqli_query($con1,"select cust_id from alert where alert_id='$id'");
$ro=mysqli_fetch_row($sq);

$sq1=mysqli_query($con1,"select * from cust where id='$ro[0]'");
$ro1=mysqli_fetch_row($sq1);
*/

/*include_once('class_files/filter.php');
	$ob=new filter();
	$tab=$ob->filter_by('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("cust_id"),'alert',array("alert_id"),array($id),'','');
	$ro=mysqli_fetch_row($tab);
	//echo $ro[0];
	$tab1=$ob->filter_by('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("*"),'customer',array("cust_id"),array($ro[0]),'','');
	$ro1=mysqli_fetch_row($tab1);*/
date_default_timezone_set('Asia/Kolkata');
$qr=mysqli_query($con1,"select caller_email,call_status from alert where alert_id='".$id."'");
$ro1=mysqli_fetch_row($qr);



// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="popup.js" type="text/jscript" language="javascript"> </script>
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
document.getElementById('rtime').value=document.getElementById('dt').value;
}
</script>

<script>
function validate(form){
 with(form)
 {
   if(up.value=="")/*Name validation*/
   {
	alert("Please Enter Some Update");
	up.focus();
	return false;
    }
   
 }
   if(confirm('Are you sure you want to Enter this Update.')) 
   {
    return true;
   }
   else 
   {
    return false;
}
 return true;
 }


</script>
</head>

<body>
<center>

<?php include("menubar.php"); ?>
<h2>Update</h2>
<div id="header">
<form action="process_update1.php" method="post" name="form" onsubmit="return validate(this)">
<input type="hidden" name="ml" id="ml" value="<?php echo $ro1[0];  ?>" />
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
<tr><td>ETA</td><td><input type="text" name="est" id="est" value="<?php date('d/m/Y'); ?>" readonly="readonly" onclick="displayDatePicker('est');">
&nbsp;&nbsp;
<select name="time" id="time"><option value="">Select time</option>
<?php
for($i=1;$i<=12;$i++)
{
?>
<option value="<?php echo $i.":00:00"; ?>"><?php echo $i; ?></option>
<?php
}
?>

</select>

<select name="meri" id="meri"><option value="">Select</option>
<option value="am">am</option><option value="pm">pm</option>
</select></td></tr>
<tr><td width="184" height="35" colspan="2" align="center">Call Closure : </td></tr>
<?php
$statusme=0;
$actstat='';
$qryin=mysqli_query($con1,"Select * from tempclosedcall where alert_id='".$id."' and status=0");
	if(mysqli_num_rows($qryin)>0)
	{
	$statusme=1;
	$actstat="temp";
	}
	elseif($statusme=='0' && $ro1[1]=='Done')
	{
	$actstat="close";
	}
	elseif($ro1[1]=='2')
	{
	$actstat="wait";
	}
	elseif($ro1[1]=='Pending')
	{
	$actstat="pending";
	}
//echo $actstat;
?>
<tr>
<td width="167" >Pending</td>

<td><input type="radio" name="callclose" value="pending" <?php if($actstat=='pending'){echo "checked=='checked'";} ?>
/></td>
</tr>
<tr>
<td width="167" >Temporary Close</td>

<td><input type="radio" name="callclose" value="temp" <?php if($actstat=='temp'){echo "checked=='checked'";} ?>
/></td>
</tr>

<tr>
<td width="167" >Standby Close</td>
<td><input type="radio" name="callclose" value="wait"   <?php if($actstat=='wait'){echo "checked=='checked'";} ?> /></td>
</tr>

<tr>
<td width="167" >Permanent Close</td>
<td><input type="radio" name="callclose" value="close"   <?php if($actstat=='close'){echo "checked=='checked'";} ?> /></td>
</tr>

<tr>
<td colspan="2" align="center">

<table width="394">
<tr><td colspan="2" align="center"><h3>Select Types of Problem Occurred</h3></td></tr>
<?php

if($ctype=='new')
{
	$ctype='new';
}
elseif($ctype=='new temp' || $ctype=='service')
{
	$ctype='service';
}
//echo "Select * from problemtype where type='".$ctype."'  order by problem ASC";
$prob=mysqli_query($con1,"Select * from problemtype where type='".$ctype."'  order by problem ASC");
if(!$prob)
echo mysqli_error();
while($probro=mysqli_fetch_array($prob))
{

?>
<tr><td align="right"><input type="checkbox" name="prob[]" id="prob[]" value="<?php  echo $probro[0]; ?>" /></td><td align="left"><?php  echo $probro[1]; ?></td></tr>

<?php
}


?>


</table>

</td>
</tr>
<?php
$qrychkin=mysqli_query($con1,"Select * from installed_sitesme where alert_id='".$id."'");
if($ctype=='new' && mysqli_num_rows($qrychkin)>0)
{

?>
<tr>
<td width="184" height="35">Edit Expiry Details:</td>
<td>
<?php
$i=0;
$qrydt=mysqli_query($con1,"Select assets,startdt,id from installed_sitesme where alert_id='".$id."'");
while($resdt=mysqli_fetch_row($qrydt))
{

echo $resdt[0]."</br>";
?>
<input type="hidden" name="astname[]" value="<?php echo $resdt[0]; ?>" />
<input type="hidden" name="astid[]" value="<?php echo $resdt[2]; ?>" />
<input type="text" name="etadt[<?php echo $i; ?>]" id="etadt<?php echo $i; ?>"  value="<?php  echo date('d/m/Y',strtotime($resdt[1]));?>" onclick="displayDatePicker('etadt[<?php echo $i; ?>]');"  /></br>

<?php
$i++;
}?> 
</td>
</tr>
<?php
}
?>


<tr>
<td height="35"><input type="submit" value="submit" class="readbutton"/></td>
<td><input type="button" value="cancel" class="readbutton" onclick="Javascript:location.href='view_alert.php'"/></td>

<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="br" value="<?php echo $br; ?>" />
<input type="hidden" name="ctype" value="<?php echo $ctype; ?>" />
<input type="hidden" name="dt" value="<?php echo date("Y-m-d H:i:s"); ?>" id="dt" />
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
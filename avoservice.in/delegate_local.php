<?php
include("access.php");
 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delegate Call</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script>
function validate(form)
{
with(form)
{
var x=document.getElementById('eng').value;
 if(x=='0')
  {
   alert("Please Select Engineer");
   eng.focus();
  return false;
  }
x=document.getElementById('cat').value;
 if(x=='0')
  {
   alert("Please Select Category");
   cat.focus();
  return false;
  }
}
return true;

}
</script>
</head>

<body>
<center><?php include("menubar.php"); ?>
<h2>Delegate Alert</h2>
<div id="header">
<form action="process_delegation_local.php" method="post" name="form" onsubmit="return validate(this)";>
<table border="1">
<?php
include_once('class_files/select.php');
include('config.php');
 $req=$_GET['req'];
 $ctype=$_GET['ctype'];
 //$atm=$_GET['atm'];
 //$city=$_GET['city'];
 $br=$_GET['br'];
$bran=array();
if($_GET['br']!='all')
{
$br1=str_replace(",","','",$br);//echo $br1[0]."/".$br1[1];
$br1="'".$br1."'";
//echo $br1;
//echo "select state from state where state_id in (".$br1.")";
//echo "select state from state where state_id in (".$br1.")";
$src=mysqli_query($con1,"select state from state where state_id in (".$br1.")");
while($srcrow=mysqli_fetch_array($src))
{
	$bran[]=$srcrow[0];
}
$br3=implode(",",$bran);
$br2=str_replace(",","','",$br3);//echo $br1[0]."/".$br1[1];
$br2="'".$br2."'";
}

//echo $_GET['br'];
//$engg=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("engg_id","engg_name"),"area_engg","city",$city,array(""),"y","engg_name","a");
//echo "select engg_id,engg_name,area from area_engg where area IN (".$br1.") and status=1";
//echo "select engg_id,engg_name,area from area_engg where area IN (".$br1.") and status=1";
if($_GET['br']=='all')
$sql="select engg_id,engg_name,area,city from area_engg where status=1";
else
$sql="select engg_id,engg_name,area,city from area_engg where area IN (".$br1.") and status=1";

$engg=mysqli_query($con1,$sql);
if(!$engg)
echo "failed".mysqli_error();
//echo "select a.createdby,a.cust_id,a.atm_id,a.bank_name,a.address,a.state1,a.problem,a.entry_date,a.alert_type,a.assetstatus,l.cust_id,a.state from alertlocal a,local_site l where a.alert_id='".$req."' and a.cust_id=l.track_id";
$alert=mysqli_query($con1,"select a.createdby,a.cust_id,l.atm_id,a.bank_name,a.address,a.state1,a.problem,a.entry_date,a.alert_type,a.assetstatus,l.cust_id,l.track_id from alertlocal a,local_site l where a.alert_id='".$req."' and a.cust_id=l.track_id");
$alertro=mysqli_fetch_row($alert);
/*if(($alertro[8]=='service' || $alertro[8]=='new') &&  $alertro[9] ==  'amc')
   	$atm=mysqli_query($con1,"select atmid from Amc where amcid='".$alertro[2]."'");
if(($alertro[8]=='service' || $alertro[8]=='new') &&  $alertro[9] == 'site')
	$atm=mysqli_query($con1,"select atm_id from local_site where track_id='".$alertro[2]."'");
	
	$atmro=mysqli_fetch_row($atm);*/
?>
<tr><th>Client</th><td><?php echo $alertro[10]; ?></td><th>CIN</th><td><?php echo $alertro[2]; ?></td></tr>
<tr><th>Docket No.</th><td><?php echo $alertro[0]; ?></td><th>Bank</th><td><?php echo $alertro[3]; ?></td></tr>
<tr><th valign="top">Address</th><td valign="top"><?php echo nl2br($alertro[4]); ?></td><th valign="top">Problem</td><td valign="top"><?php echo nl2br($alertro[6]); ?></td></tr>
<tr>
<th height="35">Delegate Call To : </th>
<td>
<select name="eng" id="eng" >
<option value="0">select</option>
<?php
while($row=mysqli_fetch_row($engg)){ 
//echo "select city from cities where city_id='".$row[2]."'";
$q=mysqli_query($con1,"select state from state where state_id='".$row[2]."'");
$r=mysqli_fetch_row($q);
$q2=mysqli_query($con1,"select city from cities where city_id='".$row[3]."'");
$r2=mysqli_fetch_row($q2);
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[1]." (".$r[0]."-".$r2[0].")"; ?></option>
<?php
}
?>
</select>
</td>
<th>Call Logged On</th><td><?php echo date('d/m/Y h:i:s a',strtotime($alertro[7])); ?></td>
</tr>
<?php
	if($ctype!="new"){
?>
<tr><td>ETA</th><td colspan="3"><input type="text" name="est" id="est" value="<?php date('d/m/Y'); ?>" readonly="readonly" onclick="displayDatePicker('est');">
&nbsp;&nbsp;
<select name="time" id="time"><option value="">Select hrs</option>
<?php
for($i=1;$i<=12;$i++)
{
?>
<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php
}
?>

</select>
<select name="min" id="min"><option value="00">Select minutes</option>
<?php
for($i=0;$i<60;$i++)
{
if($i%5==0){
?>
<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php
}
}
?>

</select>

<select name="meri" id="meri"><option value="">Select</option>
<option value="am">am</option><option value="pm">pm</option>
</select></td></tr>
<tr>
<?php
	}
?>
<td>Category:</td>
<td colspan="3">
	<select name="cat" id="cat">
		<option value="0">Select Category</option>
		<option value="A">0-50</option>
		<option value="B">50-100</option>
		<option value="C">100-200</option>
		<option value="D">200-300</option>
		<option value="E">Above 300</option>
	</select>Km
</td></tr>
<tr>
<th height="35" colspan="4" align="center">
<input type="hidden" name="req" value="<?php echo $req ?>" readonly /><input type="hidden" name="atm" value="<?php echo $alertro[11]; ?>" /><input type="hidden" name="br" value="<?php echo $br ?>" />
<input type="hidden" id="brnch" name="brnch" value="<?php echo $alertro[11]; ?>">
<input type="submit" value="submit" class="readbutton" name="delegate" /></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
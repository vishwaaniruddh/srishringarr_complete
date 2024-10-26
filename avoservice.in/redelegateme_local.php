<?php
include('config.php');
include("access.php");
 $req=$_GET['req'];
 $ctype=$_GET['ctype'];
$br=$_GET['br'];
$oldeng=mysqli_query($con1,"select engineer from alert_delegationlocal where alert_id='".$req."'");
$getold=mysqli_fetch_row($oldeng);
/*$etchengid=mysqli_query($con1,"Select engg_name from area_engg where engg_id='".$getold[0]."'");
$getoldname=mysqli_fetch_row($etchengid);*/
//echo $getoldname;
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

if($_GET['br']=='all')
$sql="select engg_id,engg_name,area,city from area_engg where status=1";
else
$sql="select engg_id,engg_name,area,city from area_engg where area IN (".$br1.") and status=1";

$engg=mysqli_query($con1,$sql);
if(!$engg)
echo "failed".mysqli_error();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Redelegate Call</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script>
function validate(form)
{
with(form)
{
var x=document.getElementById('engnew').value;
 if(x=='0')
  {
   alert("Please Select Engineer");
   engnew.focus();
  return false;
  }
var y=document.getElementById('resonrel').value;
//alert(y);
 if(y=='')
  {
   alert("Please Enter reason for Redelegation");
   resonrel.focus();
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
<form action="process_redelegateme_local.php" method="post" name="form" onsubmit="return validate(this)";>
<table>
<tr>
<td height="35">Engineer : </td>
<td>
<select name="engnew" id="engnew" >
<option value="0">select</option>
<?php
while($row=mysqli_fetch_row($engg)){ 
//echo "select city from cities where city_id='".$row[2]."'";
$q=mysqli_query($con1,"select state from state where state_id='".$row[2]."'");
$r=mysqli_fetch_row($q);
$q2=mysqli_query($con1,"select city from cities where city_id='".$row[3]."'");
$r2=mysqli_fetch_row($q2);
?>
<option value="<?php echo $row[0]; ?>" <?php if($row[0]==$getold[0]){ echo "selected"; } ?>><?php echo $row[1]." (".$r[0]."-".$r2[0].")"; ?></option>
<!--<option value="<?php echo $row[0]; ?>"<?php if(isset($_GET['cid']) && $_GET['cid']==$row1[1]){ ?> selected <?php }  ?> ><?php echo $row[0]; ?></option>-->
<?php
}
?>
</select>
</td>
</tr>
<td height="35">Reason: </td>
<td>
<textarea rows="4" cols="40" name="resonrel" id="resonrel"></textarea>

</td>
</tr>
<?php
	if($ctype!="new"){
?>
<tr><td>ETA</td><td><input type="text" name="est" id="est" value="<?php echo date('d/m/Y'); ?>" readonly="readonly" onclick="displayDatePicker('est');">
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
<?php
	}
?>
<tr>
<td height="35">
<input type="hidden" name="req" value="<?php echo $req ?>" readonly /><input type="hidden" name="br" value="<?php echo $br ?>" /><input type="hidden" name="engold" value="<?php echo $getold[0]?>" />
<input type="submit" value="submit" class="readbutton" name="delegate" /></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
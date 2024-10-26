<?php
session_start();
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
include("access.php");
 	$req=$_GET['req'];
  	$atm=$_GET['atm'];
 	$city=$_GET['city'];
	$br=$_GET['br'];

$alertng=mysqli_query($concs,"select assetstatus,atm_id from alert where alert_id='".$req."'");
$alertro=mysqli_fetch_row($alertng);

if($alertro[0] ==  'amc')
   { $atm=mysqli_query($concs,"select atmid, latitude, longitude from Amc where amcid='".$alertro[1]."'");
   }
if($alertro[0] == 'site'){
$atm=mysqli_query($concs,"select atm_id, latitude, longitude from atm where track_id='".$alertro[1]."'");

}

$atmro=mysqli_fetch_row($atm);

$sitelat=$atmro[1];
$sitelong=$atmro[2];

$oldeng=mysqli_query($concs,"select engineer from alert_delegation where alert_id='".$req."'");
$getold=mysqli_fetch_row($oldeng);

$oldeng=$getold[0];

$sql="select engg_id,engg_name,area,city,engg_desgn, latitude, longitude from area_engg where status=3 order by engg_name ASC";
//echo $sql;
$engg=mysqli_query($concs,$sql);
if(!$engg)
echo "failed".mysqli_error();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Redelegate Call</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<link href="../menu.css" rel="stylesheet" type="text/css" />
<link href="../datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="../datepicker/datepick_js.js" type="text/javascript"></script>
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
 var est_date=document.getElementById('est').value; 
 //alert(est_date);
 if(est_date=='')
  {
   alert("Please Enter Date of Redelegation");
   est.focus();
  return false;
  }
 var time2=document.getElementById('time').value; 
  if(time2=='')
  {
   alert("Please Enter time");
   time.focus();
  return false;
  }
 var meri2=document.getElementById('meri').value; 
  if(meri2=='')
  {
   alert("Please Enter AM/PM");
   meri.focus();
  return false;
  }   

}
return true;
}

</script>
</head>

<body>
<center><?php include("menubar.php"); ?>
<h2>Re-Delegate Alert</h2>
<div id="header">
<form action="process_delegation_andime.php" method="post" name="form" onsubmit="return validate(this)";>
<table>
<tr>
<td height="35">Engineer : </td>
<td>
<select name="engnew" id="engnew" required >
<option value="0">select</option>
<?php
while($row=mysqli_fetch_row($engg)){ 
    

$q2=mysqli_query($concs,"select city,state_id from cities where city_id='".$row[3]."'");
$r2=mysqli_fetch_row($q2);

$q=mysqli_query($concs,"select state from state where branch_id='".$row[2]."' and state_id='".$r2[1]."'");
$r=mysqli_fetch_row($q);

$eng=$row[0];

?>
<option value="<?php echo $eng; ?>" <?php if($row[0]==$getold[0]){ echo "selected"; } ?>><?php echo $row[1]."-".$r2[0]; ?></option>

<!--<option value="<?php echo $row[0]; ?>"<?php if(isset($_GET['cid']) && $_GET['cid']==$row1[1]){ ?> selected <?php }  ?> ><?php echo $row[0]; ?></option>-->
<?php
}
?>
</select>
</td>
</tr>
<td height="35">Reason: </td>
<td>
<textarea rows="4" cols="40" name="resonrel" id="resonrel" required=""></textarea>

</td>
</tr>
<tr><td>ETA</td><td><input type="text" name="est" id="est" required="" value="<?php date('d/m/Y'); ?>" readonly="readonly" onclick="displayDatePicker('est');">
&nbsp;&nbsp;
<select name="time" id="time" required ><option value="">Select time</option>
<?php
for($i=1;$i<=12;$i++)
{
?>

<option value="<?php echo $i.":00:00"; ?>"><?php echo $i; ?></option>
<?php
}
?>

</select>

<select name="meri" id="meri" required ><option value="">Select</option>
<option value="am">am</option><option value="pm">pm</option>
</select></td>
</tr>
<tr>
<input type="hidden" name="engold" id="engold" value="<?php echo $getold[0]?>" />
</tr>
<tr><td height="35"><input type="submit" value="submit" class="readbutton" name="delegate" /></td> </tr>

<input type="hidden" name="req" value="<?php echo $req ?>" readonly />
<input type="hidden" name="atm" value="<?php echo $atm?>" />
<input type="hidden" name="br" value="<?php echo $br ?>" />

</table>
</form>
</div>
</center>
</body>
</html>
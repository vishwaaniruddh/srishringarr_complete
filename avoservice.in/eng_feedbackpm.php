<?php
session_start();
if(!isset($_SESSION['user']))
header('location:index.php');
else
{
include("config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
function validate()
{
///alert("hi");
	if(document.getElementById("feed").value=='')
	{
	alert("Please Enter some Feedback");
	return false;
	}
	if(document.getElementById("availperson").value=='')
	{
	alert("Please Enter Avaialble person name");
	return false;
	}
var cnt=document.getElementById("pmcnt").value;
//alert(cnt);
var cnt2;
cnt2=0;
//int i;
for(i=0;i<cnt;i++)
{
//alert(document.getElementById("asst"+i).checked);
if(document.getElementById("asst"+i).checked)
{
//alert("hello");
if(document.getElementById("cap"+i).value=='')
	{
	alert("Please Enter Company (Make)");
	document.getElementById("cap"+i).focus();
	return false;
	}
if(document.getElementById("spec"+i).value=='')
	{
	alert("Please select capacity");
	document.getElementById("spec"+i).focus();
	return false;
	}
	
	cnt2=cnt2+1;	
}
}
//alert(cnt2);
if(cnt2==0)
{
alert("Please select atleast one asset");
	document.getElementById("asst0").focus();
	return false;
}
return true;
}


</script>
</head>

<body>
<center>
<?php if(!isset($_GET['ctype'])){ include("menubar.php"); } ?>
<h2>Primitive Maintenance Feedback</h2>
<div id="header">


<?php
 $alert=$_GET['id'];
$eng_id=$_GET['eng_id'];
$pmalert=mysqli_query($con1,"select caller_name from pmalert where alert_id='".$alert."'");
$pmro=mysqli_fetch_row($pmalert);
//echo "Select assetstatus from pmalert where alert_id='".$alert."'";
$qryal=mysqli_query($con1,"Select assetstatus from pmalert where alert_id='".$alert."'");
$alres=mysqli_fetch_row($qryal);
?>
<form action="process_pmfeedback1.php" method="post" name="form" >
<table width="auto">
<tr>
<td width="175" height="35">Update : </td>
<td width="207"><textarea rows="4" cols="28" name="feed" id="feed"></textarea></td>
</tr>
<tr><td>Available Person</td><td><input type="text" name="availperson" id="availperson" value="<?php echo $pmro[0]; ?>"></td></tr>
<tr><td colspan="2">
<table>
<tr><td></td><td>Assets</td><td>Capacity</td><td>Company</td><td>Number(Qty)</td><td>Remark</td></tr>
<?php
$cnt=0;
//echo $alres[0];
$asst="select assets_id,assets_name from assets";
/*if($alres[0]=='site')
{

}
elseif($alres[0]=='amcnew')
{
}
elseif($alres[0]=='amc')
{*/

$amcast=mysqli_query($con1,$asst);
while($amcastro=mysqli_fetch_array($amcast))
{

?>
<tr><td align="center"><?php echo $cnt+1; ?></td><td align="left">
<input type="checkbox" name="asst[]" id="asst<?php echo $cnt; ?>" value="<?php echo $amcastro[1]; ?>" class="read"  onchange="CheckCheckboxes1(this);incre(this.id)"> <?php echo $amcastro[1]; ?></td>

<td align="center"><?php $spec=mysqli_query($con1,"select name from assets_specification where assets_id='".$amcastro[0]."'");
if(mysqli_num_rows($spec)>0){
?>
<select name="spec[]" id="spec<?php echo $cnt; ?>" class="read" disabled><option value="">Capacity</option>

<?php
while($specro=mysqli_fetch_array($spec))
{
?>
<option value="<?php echo $specro[0]; ?>"><?php echo $specro[0]; ?></option>
<?php
}
?>
</select>
<?php
}
 ?></td>
 <td align="center"><input type="text" name="cap[]" id="cap<?php echo $cnt; ?>" class="read" style="width:60px" placeholder="make" disabled></td>
 <td align="center"><select name="quan[]" id="quan<?php echo $cnt; ?>" class="read" disabled>
 <?php
 for($i=0;$i<=12;$i++)
 {
 ?>
 <option value="<?php echo $i+1; ?>"><?php echo $i+1; ?></option>
 <?php
 }
 ?>
 </select></td>
 <td align="center"><textarea name="rem[]" id="rem<?php echo $cnt; ?>" class="read" disabled></textarea></td>
</tr>
<?php
$cnt=$cnt+1;
}
//}
?></table>
</td></tr>
<tr>
<td height="35">
<input type="hidden" name="ctype" id="ctype" value="<?php if(isset($_GET['ctype'])){ echo $_POST['ctype'];} ?>" />
<input type="hidden" name="pmcnt" id="pmcnt" value="<?php echo $cnt; ?>" />
<input type="hidden" name="alert" value="<?php echo $alert; ?>" readonly /><input type="hidden" name="eng_id" value="<?php echo $eng_id; ?>" />
<input type="submit" value="submit" class="readbutton" name="cmdsub" onclick="return validate()"/>
</td>
<td>
<input type="button" value="Cancel" class="readbutton" onclick="Javascript:location.href='eng_alert.php'"/>
</td>
</tr>
</table>
</form>
</div>
</center>
<script type="text/javascript">
	function CheckCheckboxes1(chk){
    var txt = chk.parentNode.parentNode.cells[3].getElementsByTagName('input')[0];
    var sel1 = chk.parentNode.parentNode.cells[2].getElementsByTagName('select')[0];
    var sel2 = chk.parentNode.parentNode.cells[4].getElementsByTagName('select')[0];
    var txt2 = chk.parentNode.parentNode.cells[5].getElementsByTagName('textarea')[0];
    if(chk.checked == true)
    {
        txt.value = "";
        txt.disabled= false;
        sel1.disabled= false;
        sel2.disabled= false;
        txt2.disabled= false;
    }
    else
    {
        txt.value = "";
        txt.disabled= true;
        sel1.disabled= true;
        sel2.disabled= true;
        txt2.disabled= true;
    }
}


</script>
</body>
</html>
<?php
}
?>
<?php
session_start();
include("config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function validate()
{
//alert("hi");
	if(document.getElementById("feed").value=='')
	{
	alert("Please Enter some Feedback");
	return false;
	}
if(document.getElementById("close").checked==true || document.getElementById("stand").checked==true)
{
	if(document.getElementById("serial").value=='')
	{
	alert("Please Enter serial number of UPS");
	return false;
	}
}
if(document.getElementById("assetsups[]").checked==true)
{
	//alert("hi");
	if(document.getElementById("txt1ups[]").value=='')
	{
	alert("Please Enter UPS assets serial no");
	return false;
	}
}

}
</script>
<script>
function astselect(id)
{
	//alert(id);
}
</script>
</head>

<body>
<center>
<?php  include("menubar.php"); ?>
<h2>Feedback</h2>
<div id="header">


<?php
 $alert=$_GET['alert'];
$eng_id=$_GET['eng_id'];
//echo "Select * from alert where alert_id='".$alert."'";
$qryal=mysqli_query($con1,"Select alert_type from alert where alert_id='".$alert."'");
$alres=mysqli_fetch_row($qryal);
?>
<form action="process_feedback1.php" method="post" name="form"  >
<table width="394">
<tr>
<td width="175" height="35">Update : </td>
<td width="207"><textarea rows="4" cols="28" name="feed" id="feed"></textarea></td>
</tr>

<tr>
<td height="35">Call closed by giving Standby : </td>
<td><input type="checkbox" value="Y" name="stand" id="stand" /></td>
</tr>
<tr>
<tr>
<td height="35">Final Close : </td>
<td><input type="checkbox" value="Y" name="close" id="close" /></td>
</tr>
<?php 
 if($alres[0]=='new')
 {?>
<!--<td height="35">Ups Serial number : </td>
<td><input type="text" name="serial" id="serial" /></td>
</tr>-->
<?php
}
else
	{
	?>
	<td height="35">Ups Serial number : </td>
<td><input type="text" name="serial" id="serial" /></td>
</tr>
	<?php
	}
	?>
	<?php
	if($alres[0]=='new')
	{?>
<tr>
<td height="35" colspan="2"><b><center>UPS</center><b>
</tr>
<tr>
<td colspan="2">


<?php

//echo "Select * from alert_assets where alert_id='".$alert."' and assets like '%".UPS."%'";
$qryalrt=mysqli_query($con1,"Select * from alert_assets where alert_id='".$alert."' and assets like '%".UPS."%'");
$resrows=mysqli_num_rows($qryalrt);
if($resrows > 0)
{
	
while($row2=mysqli_fetch_row($qryalrt))
{
	
	for($i=0;$i<($row2[4]);$i++)
	{
		?>
        <input type="checkbox" name="assetsups[]" id="assetsups[]" onClick="" value="<?php echo $row2[3];?>" />
        <?php
		echo $row2[3];
		?>
		<!--<option value="<?php echo $row2[3]; ?>"><?php echo $row2[3]; ?></option>-->
        
		<input type="text" name="txt1ups[]"  id="txt1ups[]" placeholder="UPS Serial NO" >
	<br />
   
	 
    
	<?php
	}
	
}
}
else
{?>
<b>
	<?php echo  "<b><center> No UPS Assets</center></b>";
}

?>
</td>
</tr>
<tr>
<td height="35" colspan="2"><b><center>Other Assets</center><b>
</tr>

<tr>


<th>Srno</th>
<th>Assets with specifications-Quantity</th>
</tr>
<tr>
<?php
$cnt=0;
$qryothr=mysqli_query($con1,"Select assets,qty from alert_assets where alert_id='$alert' and assets not like '%".UPS."%'");
$resltot=mysqli_num_rows($qryothr);
if($resltot > 0)
{
while($rowothr=mysqli_fetch_row($qryothr))
{
?>

<td><?php echo $cnt+1; ?></td>
<td><input type="checkbox" name="assetsme[]" id="assetsme[]"  
onClick="astselect('assetsme<?php echo $cnt ?>');" value="<?php echo $rowothr[0]."-".$rowothr[1];?>" /><?php echo $rowothr[0]."-".$rowothr[1];?><br /></td></tr>
<br />




<?php
$cnt=$cnt+1;
}
}
else
{?>

<tr>
<td colspan="2" align="center">
	<?php echo  "<b> No Other Assets</b>";
}

?>
</td>
</tr>
<?php
}?>
<tr>
<td height="35">
<input type="hidden" name="alert" value="<?php echo $alert; ?>" readonly /><input type="hidden" name="eng_id" value="<?php echo $eng_id; ?>" />
<input type="submit" value="submit" class="readbutton" onclick="return validate()"/>
</td>
<td>
<input type="button" value="Cancel" class="readbutton" onclick="Javascript:location.href='eng_alert.php'"/>
</td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>


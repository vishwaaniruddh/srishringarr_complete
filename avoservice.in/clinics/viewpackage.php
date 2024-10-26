<?php
	session_start();
	if(!isset($_SESSION['SESS_USER_NAME']))
		header('location:index.html');
	include('template_clinic.html');
	include("config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Package</title>
<script type="text/javascript">
function showamt(cnt)
{
	//alert(document.getElementById("divdisp"+cnt).style.display);
	if(document.getElementById("divdisp"+cnt).style.display=='none')
		document.getElementById("divdisp"+cnt).style.display='block';
	else
		document.getElementById("divdisp"+cnt).style.display='none';
		
	if(document.getElementById("divedt"+cnt).style.display=='none')
	{
		document.getElementById("divedt"+cnt).style.display='block';
		document.getElementById("amt"+cnt).select();
	}
	else
		document.getElementById("divedt"+cnt).style.display='none';
	
}
function isNumberKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode;
if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
return false;
 
return true;
}
</script>
</head>

<body>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>


<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />


<div class="M_page">
<?php
	if(isset($_SESSION['success']))
	{
		if($_SESSION['success']==0)	
		{
			$result="Problem please try again.";
		}
		else if($_SESSION['success']==1)	
		{
			$result="Amount updated sucessfully.";
		}
?>
<script>
alert('<?php echo $result; ?>');
</script>
<?php
		unset($_SESSION['success']);
	}
?>
<fieldset class="textbox">
                <legend><h1><img src="ddmenu/img1.png" style="width:50px; height:50px;" />View Package</h1></legend>
<table border="1" width="50%">
	<tr>
		<th>Package</th>
		<th>Amount</th>
		<th>Edit</th>
	</tr>
	<?php 
		$cnt=1;
		$qry1=mysql_query("select * from `package` where status=0");
		while($row=mysql_fetch_array($qry1))
		{
	?>
	<tr>
		<td><?php echo $row['desc']; ?></td>
		<td>
			<div id="divdisp<?php echo $cnt; ?>" style="display:block">
				<?php echo $row['amt']; ?>
			</div>
			<div id="divedt<?php echo $cnt; ?>"  style="display:none">
				<form method="post" action="editpackage.php">
					<input type="text" name="amt" onKeyPress="return isNumberKey(event);" id="amt<?php echo $cnt; ?>" value="<?php echo $row['amt']; ?>" />
					<input type="hidden" name="packid" value="<?php echo $row['packid']; ?>" />
					<input type="submit" name="submit" value="Update"/>
				</form>
			</div>
		</td>
		<td><button class="submit formbutton"" onclick="showamt(<?php echo $cnt; ?>)"><a>Edit</a></button></td>
	</tr>
	<?php
			$cnt++;
		}
	?>
</table>
</div>
</body>
</html>
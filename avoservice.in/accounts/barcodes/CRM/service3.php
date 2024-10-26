<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAR CRM</title>
<link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
<center>
<input type="button" value="PM Call" class="button" onclick="javascript:location.href = 'cust_service.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="CR Call" class="button" onclick="javascript:location.href = 'cust_request.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="AMC" class="button" onclick="javascript:location.href = 'amcview.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Open Call" class="button" onclick="javascript:location.href = 'open.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Closed Call" class="button" onclick="javascript:location.href = 'close.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Alerts" class="button" onclick="javascript:location.href = 'alert.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Logout" class="button" onclick="javascript:location.href = 'logout.php';" style="width:100px;"/><br /><br />

<h2>AMC Service</h2><br /><br />
<?php
include('config.php');
$st=$_GET['st'];
$id=$_GET['id'];
$cid=$_GET['cid'];
$pdate=$_GET['pdate'];
$sdate1=$_GET['sdate'];

?>
<form action="process_service1.php" method="get">
<table width="418">


<tr>
<td height="38">Purchase Date : </td>
<td><input type="text" value="<?php if(isset($pdate) and $pdate!='0000-00-00') echo date('d/m/Y',strtotime($pdate));?>" readonly style="background-color:#CCC"/></td>
<tr>

<tr>
<td height="38">Service Date : </td>
<td><input type="text" value="<?php echo date('d/m/Y',strtotime($sdate1)); ?>" readonly style="background-color:#CCC"/></td>
<tr>

<td width="207" height="38"> Assign To : </td>
<td width="199">
<select name="assign">
<option value="0">select</option>
<?php
$result1 = mysql_query("SELECT * FROM  phppos_engineer where status=0 order by name");
while($row1 = mysql_fetch_row($result1)){ ?>
<option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
<?php } ?>
</select>
</td>
</tr>

<tr>
<td width="207">Description :</td>
<td><textarea rows="4" cols="30" name="desc"></textarea></td>
</tr>

<tr>
<td width="207" height="38">Available Person :</td>
<td><input type="text" name="per" id="per"/></td>
</tr>

<tr>
<td width="207" height="38"><input type="submit" name="submit" value="submit" class="button"/></td>
<td width="199"><input type="button" value="cancel" onclick="javascript:location.href = 'cust_service.php';" class="button"/></td>
</tr>
</table>
<input type="hidden" value="<?php echo $st; ?>" name="st" />
<input type="hidden" value="<?php echo $id; ?>" name="id" />
<input type="hidden" value="<?php echo $cid; ?>" name="cid" />
<input type="hidden" value="<?php echo $pdate; ?>" name="pdate" />
<input type="hidden" value="<?php echo $sdate1; ?>" name="sdate1" />
</form>

</center>
</body>
</html>
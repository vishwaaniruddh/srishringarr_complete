<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<?php
include('config.php');
$id=$_GET['id'];
$sdate1=$_GET['sdate1'];
//echo $id;
//echo "select * from prservice where customer='$id' and service_date='$sdate1'";
$sql="select * from prservice where customer='$id' and service_date='$sdate1'";
$result=mysql_query($sql);
$row=mysql_fetch_row($result);

$sql1="select name from phppos_engineer where id='$row[4]'";
$result1=mysql_query($sql1);
$row1=mysql_fetch_row($result1);
?>
<body>
<center>
<input type="button" value="PM Call" class="button" onclick="javascript:location.href = 'cust_service.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="CR Call" class="button" onclick="javascript:location.href = 'cust_request.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="AMC" class="button" onclick="javascript:location.href = 'amcview.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Open Call" class="button" onclick="javascript:location.href = 'open.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Closed Call" class="button" onclick="javascript:location.href = 'close.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Alerts" class="button" onclick="javascript:location.href = 'alert.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Logout" class="button" onclick="javascript:location.href = 'logout.php';" style="width:100px;"/><br /><br /><br />

<table width="321" border="1" cellpadding="0" cellspacing="0">
<tr>
<td>Service Date : </td>
<td width="116"><?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3]));?></td>
</tr>

<tr>
<td>Assign To : </td>
<td><?php echo $row1[0]; ?></td>
</tr>

<tr>
<td>Description : </td>
<td><?php echo $row[5]; ?></td>
</tr>

<tr>
<td>Available Person : </td>
<td><?php echo $row[6]; ?></td>
</tr>
</table><br /><br />

<input type="button" value="cancel" onclick="javascript:location.href = 'cust_service.php';" class="button"/>
</center>
</body>
</html>
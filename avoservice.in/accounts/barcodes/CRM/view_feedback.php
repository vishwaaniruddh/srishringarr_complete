<?php 
session_start();
if(isset($_SESSION['user']))
{
?>
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
<input type="button" value="Expired" class="button" onclick="javascript:location.href = 'expired.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Engineer Performance" class="button" onclick="javascript:location.href = 'engperforma.php';" style="width:160px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Logout" class="button" onclick="javascript:location.href = 'logout.php';" style="width:100px;"/><br /><br>

<h2>Customer Feedback</h2>

<?php
include('config.php');
$id=$_GET['id'];
$type=$_GET['type'];
$name=$_GET['name'];

$sql=mysql_query("select * from  feedback where id='$id' and type='$type'");
?>

<h3> Mr/Ms. <?php echo $name; ?></h3>

<table width="420" border="1" cellpadding="0" cellspacing="0">
<tr>
<th width="49">Sr.No</th>
<th width="105">Date</th>
<th width="129">Request</th>
<th width="127">Feedback</th>
</tr>
<?php
$i=1;
while($row = mysql_fetch_row($sql)){
	
$sql1=mysql_query("select * from phppos_request where id='$id' and cust_type='$type'");
$row1 = mysql_fetch_row($sql1);

?>
<tr>
<td><?php echo $i++; ?></td>
<td><?php if(isset($row[4]) and $row[4]!='0000-00-00') echo date('d/m/Y',strtotime($row[4])); ?></td>
<td><?php echo $row1[2]; ?></td>
<td><?php echo $row[2]; ?></td>
</tr>
<?php } ?>
</table>
</center>
</body>
</html>
<?php 

}else
{ 
 header("location: index.html");
}

?>
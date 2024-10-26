<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<center>
<h2>View Alerts</h2>
<div id="header">


<?php
session_start();
$des=$_SESSION['designation'];
$username=$_SESSION['user'];
//$pass=$_SESSION['password'];

include_once('class_files/select.php');
$sel_obj=new select();
$sql=$sel_obj->select_rows('localhost','site','site','atm_site',array("*"),"area_engg","email_id",$username,array(""),"y","city","a");
$row=mysql_fetch_row($sql);
	
?>
<table width="506" border="1" cellpadding="2" cellspacing="0">
<th>Name</th>
<th width="49">ATM</th>
<th width="68">Bank</th>
<th width="58">Area</th>
<th width="106">Problem</th>
<th width="106">Status</th>

<tr>
<td width="81"><?php echo $row[1]; ?></td>
<?php
$sql1=$sel_obj->select_rows('localhost','site','site','atm_site',array("alert_id"),"alert_delegation","engineer",$row[0],array(""),"y","","");
$row1=mysql_fetch_row($sql1);
/*include_once('config.php');
$sql1=mysql_query("select alert_id from alert_delegation where engineer='$row[0]'");
$row1=mysql_fetch_row($sql1);*/
$sql2=$sel_obj->select_rows('localhost','site','site','atm_site',array("*"),"alert","alert_id",$row1[0],array(""),"y","","");
//$sql2=mysql_query("select * from alert where alert_id='$row1[0]'");
while($row2=mysql_fetch_row($sql2)) {
?>

<td><?php echo $row2[2]; ?></td>
<td><?php echo $row2[3]; ?></td>
<td><?php echo $row2[4]; ?></td>
<td><?php echo $row2[9]; ?></td>
<td><input type="button" value="Done" class="readbutton" onclick="javascript:location.href='eng_feedback.php?alert=<?php echo $row1[0]; ?>&eng_id=<?php echo $row[0]; ?>'"/></td>
</tr>
<?php } ?>
</table>
</div>
</center>
</body>
</html>
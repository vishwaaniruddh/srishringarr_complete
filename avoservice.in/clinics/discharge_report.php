<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<?php

$id=$_GET['id'];
$sql=mysql_query("select * from discharge_summary where dis_real_id='$id'");
$row=mysql_fetch_row($sql);
?>
<body>
<table align="center"><tr><td colspan="2" align="center"><b><u>Case Summery</u></b></td></tr>
<tr><td width="311" height="30"><strong>Name:</strong></td>
<td width="478"><strong>Reg No.</strong></td>
</tr>
<tr><td height="29"><strong>Address :</strong></td> 
<td><strong>Age/sex:</strong></td>
<tr><td height="28"><strong>Date of Admission :</strong></td>
<td><strong>Time:</strong></td>
</tr>
<tr><td height="32"><strong>Date of Discharge :</strong></td>
<td><strong>Time :</strong></td>
</tr>
<tr><td height="33" colspan="2"><strong>Surgeon :</strong></td>
</tr>
<tr><td colspan="2"><hr/></td></tr>
<tr><td colspan="2"><strong>His examination findings are as follows</strong></td>
</tr>
<tr>
  <td height="47" colspan="2"><?php echo $row[5]; ?></td>
</tr>
<tr><td colspan="2"><em><strong>Operative Notes</strong></em></td></tr>
<tr><td colspan="2"><strong>Name of Operation:</strong></td></tr>
<tr><td colspan="2"><?php echo $row[7]; ?></td>
</tr>
<tr><td colspan="2"><strong>Operation Notes:</strong></td></tr>
<tr><td colspan="2"><?php echo $row[10]; ?></td></tr>
<tr><td colspan="2"><strong>Treatment Advised on Discharge:</strong></td></tr>
<tr><td colspan="2"><?php echo $row[8]; ?></td></tr>
<tr><td colspan="2"><strong>Finding on discharge:</strong></td></tr>
<tr><td colspan="2"><strong>Discharge Prescription:</strong></td></tr>
<tr><td colspan="2">
<table width="100%"><tr><td width="48%"><strong>Pre Operation</strong></td>
  <td width="52%"><strong>Intra Operation</strong></td></tr>
<tr><td><img src="" width="224" height="813" /></td>
<td><img src="" width="241" height="295"/></td>
</tr>
</table>
</td></tr>
</table>
</body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<center>
<h2>Feedback</h2>
<div id="header">


<?php
$alert=$_GET['alert'];
$eng_id=$_GET['eng_id'];
?>
<form action="process_feedback.php" method="get" name="form" >
<table width="311">
<tr>
<td height="35">Feedback : </td>
<td><textarea rows="4" cols="28" name="feed"></textarea></td>
</tr>

<tr>
<td height="35">
<input type="hidden" name="alert" value="<?php echo $alert; ?>" /><input type="hidden" name="eng_id" value="<?php echo $eng_id; ?>" />
<input type="submit" value="submit" class="readbutton" /></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
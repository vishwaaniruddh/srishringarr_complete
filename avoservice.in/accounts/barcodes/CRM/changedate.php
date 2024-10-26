<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SAR CRM</title>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
</head>

<body>
<?php
include('config.php');
$sd=$_GET['sd'];
$id=$_GET['id'];
?>
<center>
<form action="processdate.php" method="post">
Change Service Date : <input type="text" name="sdate" id="sdate" onClick="displayDatePicker('sdate');"/><br /><br />
<input type="hidden" value="<?php echo $sd; ?>" name="sd" /><input type="hidden" value="<?php echo $id; ?>" name="id" />
<input type="submit" value="submit" />
</form>
</center>
</body>
</html>
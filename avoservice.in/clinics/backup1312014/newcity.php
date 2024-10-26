<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add</title>
</head>

<body><center>

<form method="post" action="processcity.php">
<input type="hidden" name="field" id="field" value="<?php if(isset($_GET['field'])){ echo $_GET['field']; } else{ echo ""; } ?>" />
<table>
<tr><td> Add New :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="city" name="city" /></td></tr>
<tr><td><input name="submit" type="submit" value="Submit" /></td></tr>
</table>
</form></center>
</body>
</html>
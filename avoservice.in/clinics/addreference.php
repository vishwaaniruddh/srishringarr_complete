<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add</title>
</head>

<body>
<?php
if(isset($_POST['subref']))
{
include("config.php");
if($_POST['field']=='')
{
?>
<script type="text/javascript">
alert("You are not allowed to use this script directly");
window.close();
</script>
<?php
}
else
{
$qry=mysql_query("INSERT INTO `reference`(`desc`) VALUES ('".$_REQUEST['ref']."')");
if(!$qry)
echo "failed ".mysql_error();
else
{
?>
<script type="text/javascript">
alert("Reference added successfully");
</script>
<?php
}
}
}
?>
<center>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="field" id="field" value="<?php if(isset($_GET['field'])){ echo $_GET['field']; } else{ echo ""; } ?>" />
<table>
<tr><td> Add New :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="ref" name="ref" placeholder="Reference" /></td></tr>
<tr><td><input name="subref" type="submit" value="Submit" /></td></tr>
</table>
</form>
</center>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>New Hospital</title>
</head>

<body>
<?php
include("config.php");
if(isset($_POST['hossub']))
{
if(($_POST['hos']==''))
{
echo "Please Add hospital Name";
}
else
{
$qry=mysql_query("Insert into hospital(`name`) Values('".$_POST['hos']."')");
if($qry)
{
?>
<script type="text/javascript">
alert("Slot created Successfully");
window.onunload = refreshParent;
        function refreshParent() {
            window.opener.location.reload();
        }
		window.close();
</script>
<?php	
}
else
echo "Some Error occurred. Try again";
}
}
?>
<form name="newhos" method="post" action="<?php $_SERVER['PHP_SELF']  ?>">
Hospital Name : <input type="text" name="hos" id="hos" />
<br />
<input type="submit" name="hossub" value="Add Hospital" />
</form>

</body>
</html>

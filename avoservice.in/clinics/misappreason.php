<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
if(isset($_POST['cmdreason']))
{
include("config.php");
if(isset($_POST['reason']) && $_POST['reason']!='')
{
//$reason=str_replace(''',
$qry=mysql_query("Update appoint set missreason='".$_POST['reason']."' where app_real_id='".$_POST['appid']."'");
if($qry)
{
?>
<script type="text/javascript">
alert("Reason added successfully");
window.close();
</script>
<?php
}
}
else
echo "All provide some Reason";
}
?>
<form name="reason" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
<input type="hidden" name="appid" value="<?php echo $_GET['id']; ?>" />
Reason :<textarea name="reason"></textarea>
<input type="submit" name="cmdreason" value="submit" />
</form>
</body>
</html>

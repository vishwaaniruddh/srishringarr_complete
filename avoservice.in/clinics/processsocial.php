<?php

include('config.php');

$name=$_POST['name'];
$email=$_POST['email'];
$mobile=$_POST['mobile'];
$city=$_POST['city'];

$res=mysql_query("insert into social(name,mobile,city,email) values('$name','$mobile','$city','$email')");


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body onLoad="window.close();"><center>

</body>
</html>

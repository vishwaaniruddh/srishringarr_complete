<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AMC Decativate</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--validation-->
<script>
//////////////////////////////site type function

function validate(form){
 with(form)
 {

if(userfile.value.length < 1)
{
    alert("You Forgot to select an *.xls File to Import");
     return false;
}
 }
 return true;
 }
 


</script>

</head>

<body>
<center>
<?php include("menubar.php");
include("config.php"); ?>

<h2>De-activate AMC Sites</h2>
<div id="header">

<!--<form action="process_newsite3.php" method="post" enctype="multipart/form-data" onSubmit="return validate(this)" name="form"> -->
<form action="process_amcdeact.php" method="post" enctype="multipart/form-data" onSubmit="return validate(this)" name="form">
    
<table>
<tr>
<td width="216" height="35"><b>Select *.csv File to Import :</b></td>
<td width="521"><input type="file" name="userfile" value=""></td>
</tr>


<tr>

<td colspan="2"><b>Data Format: S.No,  Site_Id <font color='red'>*</font>,  Expiry Date ['YYYY-MM-DD'] <font color='red'>*</font>)</b></td>
</tr>

<tr>
<td height="35"  colspan="2"><input type="submit" value="submit" class="readbutton" /></td>
</tr></table>

</form>

</div>

</center>
</body>
</html>
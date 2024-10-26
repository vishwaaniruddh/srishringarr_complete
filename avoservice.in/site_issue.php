<?php
include("access.php");
include("config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New Account Manager/Client</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script>

function validate()
{
alert("hello");
var form=document.getElementById('siteform');
with(form)
{
if(stype.value=='0')
{
alert("Please Select Service");
stype.focus();
return false;
}
if(ptype.value=='')
{
alert("Please Enter  Problem");
ptype.focus();
return false;
}

}
return true;
}

</script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>


<h2>Site Issue </h2>
<div id="header">
<form action="siteprocess.php" method="get" name="siteform" enctype="multipart/form-data" id="siteform" onsubmit="return validate();">
<table>
<tr>
<td width="130" height="35">Service Type : </td>
<td width="189">
 
<select name="stype" id="stype">

<option value="0">select</option>
<option value="New">New</option>
<option value="Service">Service</option>

</select>
</td>
</tr>
<tr>
<td height="35">Problem Type : </td>
<td >
<input type="text" name="ptype" id="ptype" />

</td>
</tr>
<tr><td colspan="2" align="center" height='35'> <h2>Questions</h2></td></tr>

<?php
for($i=1;$i<=5;$i++)
{

?>
<tr><td>Q.<?php echo $i ; ?> </td> <td align="right"><input type="text" name="quen[]" id="quen" value="" /></tr>

<?php
}

?>



<tr>
<td height="35" colspan="2"><input  type="submit" value="submit" class="readbutton" onclick=""/></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
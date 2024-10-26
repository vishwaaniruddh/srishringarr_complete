<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAR CRM</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
<!---date--->
<script type='text/javascript' src='jquery-1.4.4.min.js'></script>
<script type="text/javascript" src="jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="jquery-ui.css">
<script type='text/javascript'>//<![CDATA[ 


////validation
function validate(form){
	//alert("hi");
 with(form)
 {
var numbers = /^[0-9]+$/;  
if(ename.value=='')
{
	alert("Please Enter Engineer Name");
ename.focus();
return false;
}
if(!cont.value.match(numbers))
{
alert("Please Enter Contact No. in numbers");
cont.focus();
return false;
}

}
return true;
}


</script>
</head>

<body>
<center>

<h2>New Engineer </h2>

<form action="process_eng.php" method="post" name="form" onSubmit="return validate(this)">
<table>
<tr>
<td width="155" height="40">Engineer Name : </td>
<td width="246"><input type="text" name="ename" id="ename" /></td>
</tr>

<tr>
<td height="40">Contact : </td>
<td><input type="text" name="cont" id="cont" /></td>
</tr>

<tr>
<td height="40">Email : </td>
<td><input type="text" name="email" id="email" /></td>
</tr>


<tr>
<td height="40"><input type="submit" value="submit" class="button" name="addeng"/></td>
</tr>
</table>
</form>

</center>
</body>
</html>

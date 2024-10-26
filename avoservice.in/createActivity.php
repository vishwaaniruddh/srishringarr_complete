<?php
include("access.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Activity</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script>


function validate(activity){
	
	//var form=document.getElementById('activity');
		with(activity){
		
			if(type.value=='')
			{
			alert("Select Type of Activity First.");
			type.focus();
			return false;
			}
			
			if(name.value=='')
			{
			alert("Select Type of Name.");
			name.focus();
			return false;
			}
	}
	 	if(confirm('Are you sure you want to Enter this Update.')) 
		   {
			return true;
		   }
		   else 
		    {
			return false;
			}
 return true;

}
</script>
</head>

<body>
<center>
<h2 style="color:#F00;"><?php if(isset($_GET['sucess'])) echo $_GET['sucess']; ?></h2>
<h2 class="h2color">Add Activity</h2>
<div id="">
<form action="process_activity.php" method="post" name="activity" enctype="multipart/form-data" id="activity" onSubmit="return validate(this);">
<table>
<!---Select Type of activity-->
<tr>
<td width="130" height="35">Type Of Activity : </td>
<td width="130" height="35">
<select name="type" id="type">

<option value="">select</option>
<option value="In House">In House</option>
<option value="Field">Field</option>
</select> </td>

</tr>
<!---Add Name of Activity-->
<tr>
<td height="35">Name Of Activity : </td>
<td><input type="text" name="name" id="name" /></td>
</tr>
<!---Submit Button -->
<tr>
<td height="35" colspan="2" align="center"><input  type="submit" value="submit" class="readbutton" /></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
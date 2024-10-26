<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add New Engineer</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<link href="menu.css" rel="stylesheet" type="text/css" />
<script>


function getXMLHttp()
{
 var xmlHttp
  try
  {
    //Firefox, Opera 8.0+, Safari
 xmlHttp = new XMLHttpRequest();
  }
  catch(e)
  {
    //Internet Explorer
    try
    {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
   catch(e)
    {
      try
      {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e)
      {
        alert("Your browser does not support AJAX!")
       return false;
      }
   }
 }
  return xmlHttp;
}

function validate()
{
//alert("hello");
var form=document.getElementById('engform');
with(form)
{
//alert("hello");

if(branch.value=='')
{
alert("Please Select Your Branch");
branch.focus();
return;
}

form.submit();
}
}

</script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>


<h2>Select Dept to Add Attendance</h2>
<div id="header">
<form action="add_attendance_deptform.php" method="post" name="engform" enctype="multipart/form-data" id="engform">
<table>
<? include("config.php");

if ($_SESSION['branch']=='all' || $_SESSION['branch']=='')
$state=mysqli_query($con1,"select * from `avo_branch` order by name ");
else 
$state=mysqli_query($con1,"select * from `avo_branch` where id ='".$_SESSION['branch']."'");
?>

<tr>
<td height="35">Branch : </td>
<td id="res">
<select name='branch' id='branch'> <!-- onchange="pick_state(this.value);">-->

<?// if ($_SESSION['branch']=='all' || $_SESSION['branch']=='') {
?>
<option value=''>select Branch</option>
<?php // } else {}

while($stro=mysqli_fetch_row($state))
{
?>
<option value="<?php echo $stro[1];  ?>"><?php echo $stro[1];  ?></option>
<?php } ?>
</select>
</td>
</tr>

<tr>
<td width="115" height="35">Department: </td>
<td width="305">
<select name="dept" id="dept" required>
    
<option value="">All</option>
<option value="service">Service Department</option>
<option value="other">All other Department</option>


</select>
</td>
</tr>


<tr>
<td height="35" colspan="2"><input  type="button" value="submit" class="readbutton" onclick="validate();"/></td>
</tr>

</table>
</form>
</div>
</center>
</body>
</html>
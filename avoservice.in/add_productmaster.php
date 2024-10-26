<?php include("access.php");
include("config.php");

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--validation-->
<script>

function getXMLHttp()

{   var xmlHttp

  try   {
    //Firefox, Opera 8.0+, Safari
 xmlHttp = new XMLHttpRequest();
  }   catch(e)
  {
    //Internet Explorer
    try     {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }    catch(e)
    {
      try       {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }       catch(e)
      {
        alert("Your browser does not support AJAX!")
       return false;
      }
   }
 }
  return xmlHttp;
}



function HandleResponse3(response)

{
//alert(response);
  document.getElementById('res').innerHTML = response;
}
</script>
</head>

<body>
<center>
<?php // include("menubar.php"); ?>
<h2>Add Product Master</h2>
<div id="header">
<form action="process_productmaster.php" method="post" name="form">
<table>

<tr>
<td height="35"> Product Master Name: </td>
<td> <input type="text" id="product" name="product"> </td>
</tr>

<tr>
<td height="35" colspan="2" align="center">
<input type="submit" value="submit" class="readbutton" /></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Facory</title>
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

function MakeRequest()

{ 
  var xmlHttp = getXMLHttp();
  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {

      HandleResponse3(xmlHttp.responseText);
    }
  }
  //alert("getarea.php?ccode="+document.forms[0].city.value);
var str=document.getElementById('city').value;
//alert(str);
  xmlHttp.open("GET", "get_area.php?city="+str, true);

  xmlHttp.send(null);
}

function HandleResponse3(response)

{

  document.getElementById('res').innerHTML = response;

}

function validate()
{
//alert("hello");
var form=document.getElementById('engform');
with(form)
{

if(party.value=='')
{
//alert("hi");
alert("Please Enter Client / Party Name");
party.focus();
return;
}

if(address.value=='')
{
alert("Please Enter Address ");
address.focus();
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


<h2>Add Client / Party</h2>
<div id="header">
<form action="process_party.php" method="post" name="engform" enctype="multipart/form-data" id="engform">
<table>


<tr>
<td height="35">Client / Party Name: </td>
<td><input type="text" name="party" id="party" required/></td>
</tr>

<tr>
<td height="35">Address: </td>
<td><input type="text" name="address" id="address" required/></td>
</tr>

<tr>
<td height="35">Contact Person: </td>
<td><input type="text" name="person" id="person" required/></td>
</tr>

<tr>
<td height="35">Mobile No.: </td>
<td><input type="number" min="1111111" max="999999999999999" name="mobile" id="mobile" onkeyup="if(parseInt(this.value)>999999999999999){ this.value =''; return false; }" /></td>
</tr>

<tr>
<td height="35">Email Id: </td>
<td><input type="text" name="email" id="email"  required/></td>
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
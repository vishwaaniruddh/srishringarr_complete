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

if(product.value=='')
{
//alert("hi");
alert("Please Select Product Master");
product.focus();
return;
}

if(spec.value=='')
{
alert("Please Enter Product Specs ");
spec.focus();
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


<h2>Add Product List</h2>
<div id="header">
<form action="process_prod_specs.php" method="post" name="engform" enctype="multipart/form-data" id="engform">
<table>


<tr>
<td height="35">Product Master: </td>
<td><select name="product" id="product" required/>
<option value="">Select</option>
<? $prodqry=mysqli_query($con1,"select * from factory_product_master");

while($prod=mysqli_fetch_row($prodqry)) { ?>
<option value="<? echo $prod[0]; ?> "><? echo $prod[1]; ?></option>
<? } ?>
</select>
</td> <td><a href="#" onClick="window.open('add_productmaster.php?','add_prod','width=450px,height=300,left=350,top=100')"> Add Product Master </a></td>
</tr>

<tr>
<td height="35">Product Name / Specs: </td>
<td><input type="text" name="spec" id="spec" required/></td>
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
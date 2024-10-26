<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script>
/////for city
function getXMLHttp()

{

  var xmlHttp

 //alert("hi1");

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

 //alert("hi2");

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
</script>
</head>

<body>
<center>
<h2>Add New Area Head</h2>
<?php
$id=$_GET['id'];
include_once('class_files/select.php');
$sel_obj=new select();
$area_head=$sel_obj->select_rows('localhost','site','site','atm_site',array("*"),"area_head","head_id",$id,array(""),"y","head_name","a");
$arow=mysqli_fetch_row($area_head);
?>
<div id="header">
<form action="update_areahead.php" method="post" name="form">
<table>
<tr>
<td width="99" height="35">City : </td>
<td width="189">
<select name="city" id="city" onchange="MakeRequest()">
<?php
include_once('class_files/select.php');
$sel_obj=new select();
$city_tab=$sel_obj->select_rows('localhost','site','site','atm_site',array("city_id","city"),"city","","",array(""),"y","city","a");
?>
<option value="0">select</option>
<?php while ($row=mysqli_fetch_row($city_tab)) { ?>
<option value="<?php echo $row[1];?>"<?php if($arow[3]==$row[1]){ echo "selected"; } ?>><?php echo $row[1]; ?></option>
<?php } ?>
</select>
</td>
</tr>

<tr>
<td height="35">Area : </td>
<td id="res"><select id="area" name="area"><option value="<?php echo $arow[2]; ?>"><?php echo $arow[2]; ?></option></select></td>
</tr>

<tr>
<td height="35">Name : </td>
<td><input type="text" name="name" id="name" value="<?php echo $arow[1]; ?>"/></td>
</tr>

<tr>
<td height="35">Contact : </td>
<td><input type="text" name="cont" id="cont" value="<?php echo $arow[5]; ?>"/></td>
</tr>

<tr>
<td height="35">Email : </td>
<td><input type="text" name="email" id="email" value="<?php echo $arow[4]; ?>"/></td>
</tr>

<tr>
<td height="35">
<input type="hidden" name="id" value="<?php echo $arow[0]; ?>" />
<input type="submit" value="submit" class="readbutton"/></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
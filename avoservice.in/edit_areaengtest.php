<?php include("access.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>

<script>
function validation()
{
try
{
if(document.getElementById("transferarea").value!="" && document.getElementById("fromdt").value=="")
{
alert("Select From Date");
return false;
}
}catch(ex)
{
alert(ex);
}
return true;
}
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
<?php include("menubar.php"); ?>
<h2>Edit Area Engineer</h2>
<?php
$id=$_GET['id'];
include_once('class_files/select.php');
$sel_obj=new select();
$eng_head=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("*"),"area_engg","engg_id",$id,array(""),"y","engg_name","a");
$erow=mysqli_fetch_row($eng_head);
?>
<div id="header">
<form action="update_areaenggtest.php" method="post" name="form" enctype="multipart/form-data" onsubmit="return validation();">
<table>
<tr>
<td width="99" height="35">City : </td>
<td width="189">
<select name="city" id="city" onchange="MakeRequest()">
<?php
$qry=mysqli_query($con1,"select city_id,city from cities");
$qry2=mysqli_query($con1,"select * from avo_branch");
//$row2=mysqli_fetch_row($qry2);
?>
<option value="0">select</option>
<?php while ($row=mysqli_fetch_row($qry)) { ?>
<option value="<?php echo $row[0];?>"<?php if($erow[3]==$row[0]){ echo "selected"; } ?>><?php echo $row[1]; ?></option>
<?php } ?>
</select>
</td>
</tr>

<tr>
<td height="35">Branch : </td>
<td id="res"><select id="area" name="area">
<?php while ($row2=mysqli_fetch_row($qry2)) { ?>
<option value="<?php echo $row2[0]; ?>" <?php if($erow[2]==$row2[0]){ echo "selected"; } ?> ><?php echo $row2[1]; ?></option>
<?php } ?>
</select></td>
</tr>

<tr>
<td height="35">Name : </td>
<td><input type="text" name="name" id="name" value="<?php echo $erow[1]; ?>"/></td>
</tr>

<tr>
<td height="35">Contact : </td>
<td><input type="text" name="cont" id="cont" value="<?php echo $erow[5]; ?>"/></td>
</tr>

<tr>
<td height="35">Email : </td>
<td><input type="text" name="email" id="email" value="<?php echo $erow[4]; ?>"/></td>
</tr>
<tr>
<td height="35">Upload Resume : </td>
<td><input type="file" name="resume" id="file"/><input type="hidden" name="resume2" value="<?php echo $erow[7];  ?>"><br><?php if($erow[7]!=''){ echo $erow[7]; } else { echo "resume not available"; }  ?> </td>
</tr>

<tr>
<td height="35">Transfer To Branch : </td>
<td id="res"><select id="transferarea" name="transferarea">
<option value=""  >Select Transfer TO</option>

<?php 
$qry2=mysqli_query($con1,"select * from avo_branch");

while ($row2=mysqli_fetch_row($qry2)) { 

if($erow[2]!=$row2[0])
{
?>
<option value="<?php echo $row2[0]; ?>"  ><?php echo $row2[1]; ?></option>
<?php
}
 } ?>
</select></td>
</tr>

<tr>
<td>Transfer Date
</td>
<td>
<input type="text" name="fromdt" id="fromdt" onkeypress="return runScript(event)"  onclick="displayDatePicker('fromdt');" placeholder="From Date" />
</td>
</tr>

<!--<tr>
<td>To Date
</td>
<td>
<input type="text" name="todt" id="todt" onkeypress="return runScript(event)"  onclick="displayDatePicker('todt');" placeholder="Transfer Date" />
</td>
</tr>-->


<tr>


<td height="35" colspan="2">
<input type="hidden" name="id" value="<?php echo $erow[0]; ?>" />
<input type="submit" value="submit" class="readbutton"/></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
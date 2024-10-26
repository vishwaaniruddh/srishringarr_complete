<?php
include("access.php");
//echo $_SESSION['user'];
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAR CRM</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<script>
///customer date
function cust()

{ //alert("GGG");

var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("res").innerHTML=xmlhttp.responseText;
    }
  }
  var s=document.getElementById('cname').value;
  var s1=document.getElementById('cust').value;
//	alert(s);
xmlhttp.open("POST","View_amc.php?cid="+s+"&cust="+s1,true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("fname=Henry&lname=Ford");
}



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
  var s=document.getElementById('cname').value;
//alert(s);
  xmlHttp.open("GET", "getcustomer.php?cname="+s, true);

  xmlHttp.send(null);

}



function HandleResponse3(response)

{

  document.getElementById('res1').innerHTML = response;

}


////serach contact
function MakeRequest1()

{ 
  var xmlHttp = getXMLHttp();
 

  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
//alert(xmlHttp.responseText);
      HandleResponse1(xmlHttp.responseText);
    }
  }

//alert("hi2");
 var s=document.getElementById('cname').value;
//alert(s);
if(s==0)
{
alert("select customer First");
}
else
{
document.getElementById('res').innerHTML ='<center><img src=images/loading81.gif></center>';
 //alert("getarea.php?ccode="+document.forms[0].city.value);
var cont=document.getElementById('cont').value;

  var s1=document.getElementById('pin').value;
 var id=document.getElementById('id').value;
//alert(s);
  xmlHttp.open("GET", "amcsearch.php?cont="+cont+"&cid="+s+"&pin="+s1+"&id="+id, true);
// alert("amcsearch.php?cont="+cont+"&cid="+s+"&pin="+s1+"&id="+id);

  xmlHttp.send(null);
  }

}

function HandleResponse1(response)

{

  document.getElementById('res').innerHTML = response;

}
</script>
<body>
<center>
<input type="button" value="PR Call" class="button" onclick="javascript:location.href = 'cust_service.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="CR Call" class="button" onclick="javascript:location.href = 'cust_request.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="AMC" class="button" onclick="javascript:location.href = 'amcview.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Open Call" class="button" onclick="javascript:location.href = 'open.php';" />&nbsp;&nbsp;&nbsp;
<input type="button" value="Closed Call" class="button" onclick="javascript:location.href = 'close.php';"  />&nbsp;&nbsp;&nbsp;
<input type="button" value="Alerts" class="button" onclick="javascript:location.href = 'alert.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Expired" class="button" onclick="javascript:location.href = 'expired.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Engineer Performance" class="button" onclick="javascript:location.href = 'engperforma.php';" style="width:160px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Logout" class="button" onclick="javascript:location.href = 'logout.php';" style="width:100px;"/><br /><br>
<h2>View AMC
</h2>

<a href="amc.php">New AMC Entry</a><br/><br/>

<select name="cname" id="cname" onchange="MakeRequest()">
<option value="0" >Select Customer</option>
<option value="sales" >Sales Customer</option>
<option value="service">Service Customer</option>
</select>

<table width="1132" border=0>


<tr><td width="35%" height="50" align="center" id="res1"></td>

<td width="65%">

<input type="text" name="id" id="id" placeholder="Search by Customer ID">
<!--<input type="text" name="cname" id="cname" placeholder="Search by Name">-->
<input type="text" name="cont" id="cont" placeholder="Search by Contact">
<input type="text" name="pin" id="pin" placeholder="Search by PinCode">
<input type="button" name="search" value="Search" onclick="MakeRequest1();" />
</td>
</tr>

<tr><td id="res" colspan="2"></td></tr></table>
</center>

</body>
</html>
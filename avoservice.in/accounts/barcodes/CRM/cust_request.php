<?php
include("access.php");
//echo $_SESSION['user'];
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAR CRM</title>
<link rel="stylesheet" type="text/css" href="style.css">

<script>
///customer date
function cust(a)

{ //alert("GGG");
//alert(a.value);
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
  var s=a.value;

xmlhttp.open("POST","getcust.php?cid="+s,true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("fname=Henry&lname=Ford");
}
///////////////////////check exp date
var searchReq = getXMLHttp();
function getXMLHttp()
{

  var xmlHttp

// alert("hi1");

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

// alert("hi");

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {

      HandleResponse(xmlHttp.responseText);

    }

  }

// alert("hi2");


var $ty1="";
var str = escape(document.getElementById('cname').value);
///alert(str);
var tp=document.getElementsByClassName('type');
///alert(tp.length);
for(var i=0;i<tp.length;i++){
if(tp[i].checked==true){
$ty1=tp[i].value;
}else{}

}
 xmlHttp.open("GET", "getDetail.php?cid="+str+"&tp="+$ty1, false);

  xmlHttp.send(null);

}
function HandleResponse(response)

{
//alert(response);
document.getElementById('detail').innerHTML=response;

}

	
</script>
</head>

<body>
<center>
<input type="button" value="PM Call" class="button" onclick="javascript:location.href = 'cust_service.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="CR Call" class="button" onclick="javascript:location.href = 'cust_request.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="AMC" class="button" onclick="javascript:location.href = 'amcview.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Open Call" class="button" onclick="javascript:location.href = 'open.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Closed Call" class="button" onclick="javascript:location.href = 'close.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Alerts" class="button" onclick="javascript:location.href = 'alert.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Expired" class="button" onclick="javascript:location.href = 'expired.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Engineer Performance" class="button" onclick="javascript:location.href = 'engperforma.php';" style="width:160px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Logout" class="button" onclick="javascript:location.href = 'logout.php';" style="width:100px;"/><br /><br>

<h2>Customer Request</h2>
<form action="process_request.php" method="post" >
<table>
<tr><td>Customer Type : </td><td><input name="type" id="type" type="radio" value="sales" onclick="cust(this);" class="type"  checked="checked"/>
Sales Customer  
    <input name="type" type="radio" id="type" value="service"  onclick="cust(this);" class="type"/>Service Customer
	
	 
    <input name="type" type="radio" id="type" value="temp"  onclick="cust(this);" class="type"/>
    Temporary  Customer</td>
</tr>

<tr><td width="154" height="40">Date : </td>
<td width="477"><?php echo date('d/m/Y'); ?></td>
</tr>
<tr>
<td height="40">Select Customer Name : </td>
<td id="res">
<select name="cname" id="cname" onchange="MakeRequest();">
<option value="0">select</option>
<?php
include('config.php');
$result = mysql_query("SELECT * FROM  phppos_service order by name");
while($row = mysql_fetch_row($result)){ 
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
<?php } ?>
</select></td></tr>
<tr><td id="detail" colspan="2">

</td>
<tr>
<td height="40">Request : </td>
<td><textarea name="req" rows="4" cols="30"></textarea></td>
</tr>

<tr>
<td height="40">Assign To :</td>
<td>
<select name="assign">
<option value="0">select</option>
<?php
$result1 = mysql_query("SELECT * FROM  phppos_engineer order by name");
while($row1 = mysql_fetch_row($result1)){ ?>
<option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
<?php } ?>
</select>
</td>
</tr>

<tr>
<td height="34"><input type="submit" value="submit" class="button"/></td>
</tr>
</table>
</form>
</center>
</body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAR CRM</title>
<link rel="stylesheet" type="text/css" href="style.css">
<?php //session_start();?>
<script>
/////display customer services
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


document.getElementById('detail').innerHTML='<img src=images/loading81.gif>';
var str = escape(document.getElementById('cname').value);
//alert(str);
 xmlHttp.open("GET", "getname.php?cname="+str, false);

  xmlHttp.send(null);

}
function HandleResponse(response)

{
//alert(response);
document.getElementById('detail').innerHTML=response;

}


function MakeRequest1()

{ 
  var xmlHttp = getXMLHttp();
 

  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {

      HandleResponse1(xmlHttp.responseText);
    }
  }

 //alert("hi2");
 //alert("getarea.php?ccode="+document.forms[0].city.value);
 document.getElementById('detail').innerHTML='<img src=images/loading81.gif>';
var cont=document.getElementById('cont').value;
var s1=document.getElementById('pin').value;
var id=document.getElementById('id').value;

  xmlHttp.open("GET", "prsearch.php?cont="+cont+"&pin="+s1+"&id="+id, true);
  ///alert("prsearch.php?cont="+cont+"&pin="+s1+"&id="+id);

  xmlHttp.send(null);

}

function HandleResponse1(response)

{

  document.getElementById('detail').innerHTML = response;

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
<input type="button" value="Logout" class="button" onclick="javascript:location.href = 'logout.php';" style="width:100px;"/><br /><br />

<h2>Customer Service</h2><input type="button" value="New Customer" class="button" onclick="javascript:location.href = 'newcustomer.php';" /><br /><br />


<table width="1045">
  <tr>
<td width="463"> Select Customer Name : 
<select name="cname" id="cname" onchange="MakeRequest();">
<option value="0">select</option>
<?php
include('config.php');
$result = mysql_query("SELECT * FROM  phppos_service order by name");
while($row = mysql_fetch_row($result)){ 
?>
<option value="<?php echo $row[18]; ?>"><?php echo $row[2]." ".$row[18]; ?></option>
<?php } ?>
</select>
</td>

<td width="570">
<input type="text" name="id" id="id" placeholder="Search by Customer ID">
<input type="text" name="cont" id="cont" placeholder="Search by Contact">
<input type="text" style="width:125px;" name="pin" id="pin"  placeholder="Search By Pincode"/><input type="button" name="search" value="Search" onclick="MakeRequest1();" />
</td>
</tr></table>
<div id="detail" align="center"></div>

</center>
</body>
</html>

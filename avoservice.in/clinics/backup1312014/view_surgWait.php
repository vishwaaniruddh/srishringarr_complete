<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))

 header('location:index.html');
 include('config.php');
 include('template_clinic.html');
?>
<style>
.results {table-layout:fixed;text-transform:uppercase;}
.results td {overflow: hidden;text-overflow: ellipsis; font-size:12px; width:120px;}
.results td input{font-size:12px;}
</style>

<link href="paging.css" rel="stylesheet" type="text/css" />
<script>
//////////////subcat
function loadXMLDoc()
{
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
    {// alert(xmlhttp.responseText);
    document.getElementById("sub_cat").innerHTML=xmlhttp.responseText;
    }

  }
  var cat=document.getElementById('diagnosis').value;
xmlhttp.open("POST","sub_cat.php?cat="+cat,true);

xmlhttp.send();
}



///////////////////////////////search By Id
function searchById(Mode,Page) {
 //alert("hi");
		  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
 
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
		 /* if(document.getElementById('idd').value=="" && document.getElementById('fname22').value=="")
		  {
			  var url = 'get_wait.php';
		  }else   if(document.getElementById('fname22').value==""){
			  
			  var s=document.getElementById('idd').value;
			var url = 'get_wait.php?id='+s;
		  } else if(document.getElementById('idd').value==""){
			  
			   var s=document.getElementById('fname22').value;
			var url = 'get_wait.php?fname='+s;
		  } else{*/
			  var id=document.getElementById('idd').value;
			  var s=document.getElementById('fname').value;
			  var cont=document.getElementById('cont').value;
			  var city=document.getElementById('city').value;
			  var sdate=document.getElementById('sdate').value;
			var url = 'get_wait.php';
		  //}
 	
		
			//alert(url);
			var pmeters = 'mode='+Mode+'&Page='+Page+'&fname='+s+'&id='+id+'&cont='+cont+'&city='+city+'&sdate='+sdate;

			HttPRequest.open('POST',url,true);
 
			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
 

			HttPRequest.onreadystatechange = function()
			{
 
			if(HttPRequest.readyState == 3)  // Loading Request
				  {
	document.getElementById("listingAJAX").innerHTML = '<img src="loader.gif" align="center" />';
				  }
 
				 if(HttPRequest.readyState == 4) // Return Request
				  {
		var response = HttPRequest.responseText;
 
// alert(response);
				   document.getElementById("search").innerHTML = response;
			  }
		}
  }



function Ddelete(id)
{
	if (confirm("Are you sure you want to delete this entry?"))
	{
		
		document.location="delete_wait.php?id="+id+"&aid=ws";
	}
}


</script>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Health Clinic</title>
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
</head>

<body onLoad="searchById('Listing','1')">
<div class="M_page">
<fieldset class="textbox"><fieldset class="textbox">
<h1>Waiting List For Surgery </h1>
<table class="results">
<tr>
<td><input type="text" style="border:none; width:50px; height:20px" name="idd" id="idd" onKeyUp="searchById('Listing','1');" placeholder="ID"/></td>
<td><input type="text" style="border:none; width:50px; height:20px" name="fname" id="fname" onKeyUp="searchById('Listing','1');" placeholder="Name"/></td>
<td><input type="text" style="border:none; width:50px; height:20px" name="cont" id="cont" onKeyUp="searchById('Listing','1');" placeholder="Contact"/></td>
<td><input type="text" style="border:none; width:50px; height:20px" name="city" id="city" onKeyUp="searchById('Listing','1');" placeholder="City"/></td>
<td></td>
<td><input type="text" style="border:none; width:65px; height:20px" name="sdate" id="sdate" onKeyUp="searchById('Listing','1');" placeholder="Date" onClick="displayDatePicker('sdate');"/></td>
<td></td><td></td><td></td>
</tr>
</table>

<div id="search"></div>
  
<button class="submit formbutton" type="button" onClick="window.open('surwait_print.php', '_BLANK')">Print</button> 
</fieldset></fieldset>
</div>
</body>
</html>

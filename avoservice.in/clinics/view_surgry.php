<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header('locatoion:index.html');
 include('config.php');
 include('template_clinic.html'); 
?>


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
		/*  if(document.getElementById('idd').value=="" && document.getElementById('fname22').value=="")
		  {
			  var url = 'get_surID.php';
		  }else   if(document.getElementById('fname22').value==""){
			  
			  var s=document.getElementById('idd').value;
			var url = 'get_surID.php?id='+s;
		  } else if(document.getElementById('idd').value==""){
			  
			   var s=document.getElementById('fname22').value;
			var url = 'get_surID.php?fname='+s;
		  } else{*/
			  //ar id=document.getElementById('idd').value;
			  var name=document.getElementById('name').value;
			  var sdate=document.getElementById('sdate').value;//alert(sdate);
			  var type=document.getElementById('type').value;
			var url = 'get_surID.php';
		 // }
 	
		
			//alert(url);
			var pmeters = 'mode='+Mode+'&Page='+Page+'&name='+name+'&sdate='+sdate+'&type='+type;

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
		
		document.location="delete_sur.php?id="+id+"&aid=ws";
	}
}


</script>
<!-- end multiple selection -->


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Health Clinic</title>
<style>
.results {table-layout:fixed;text-transform:uppercase;}
.results td {overflow: hidden;text-overflow: ellipsis; font-size:12px; width:120px;}
.results td input{font-size:12px;}
</style>
</head>

<body onLoad="searchById('Listing','1')">
   
 <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Surgery Records</p>
          
    <table class="results">
    <tr>
    <td><input type="text" style="border:none; width:50px; height:20px" name="name" id="name"  onkeyup="searchById('Listing','1');" placeholder="Name"/></td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><input type="text" style="border:none; width:50px; height:20px" name="type" id="type"  onkeyup="searchById('Listing','1');" placeholder="Type"/></td>
    <td><input type="text" style="border:none; width:65px; height:20px" name="sdate" id="sdate" onBlur="searchById('Listing','1');" onClick="displayDatePicker('sdate');" placeholder="Date"/></td>
    <td></td><td></td><td></td><td></td><td></td>
    </tr>
    </table>

    <div id="search"></div>

</body>
</html>

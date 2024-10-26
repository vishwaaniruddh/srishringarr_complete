<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header('location:index.html');
 
include('config.php');
include('template_clinic.html'); 

?>
<link href="paging.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
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
    { //alert(xmlhttp.responseText);
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
			  var url = 'get_docID.php';
		  }else   if(document.getElementById('fname22').value==""){
			  
			  var s=document.getElementById('idd').value;
			var url = 'get_docID.php?id='+s;
		  } else if(document.getElementById('idd').value==""){
			  
			   var s=document.getElementById('fname22').value;
			var url = 'get_docID.php?fname='+s;
		  } else{*/
			  var name=document.getElementById('name').value;//alert(id);
			  var add=document.getElementById('add').value;//alert(s);
			  var mobile=document.getElementById('mobile').value;//alert(city);
			  var pincode=document.getElementById('pincode').value;//alert(contact);
			  
			var url = 'telsearch.php';
		//  }
 	
		
			//alert(url);
			var pmeters = 'mode='+Mode+'&Page='+Page+'&name='+name+'&add='+add+'&mobile='+mobile+'&pincode='+pincode;

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
  
 //////delete doctor 
function confirm_delete2(id)
{
	if (confirm("Are you sure you want to delete this entry?"))
	{
		document.location="delete_teldir.php?id="+id;
	}
}

</script>
<style>

</style>
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />

<body onLoad="searchById('Listing','1')">
<div class="M_page">
<fieldset class="textbox">
          <legend><h1><img src="ddmenu/phone_directory.png" height="50" width="50">Telephone Directory</h1></legend>
          
          <table >
          <tr>
		  <td><input type="text" id="name" name="name" placeholder="Name" onKeyUp="searchById('Listing','1');" /></td>
          <td><input type="text" id="add" name="add" placeholder="Address" onKeyUp="searchById('Listing','1');" /></td>
          <td><input type="text" id="mobile" name="mobile" placeholder="Contact" onKeyUp="searchById('Listing','1');" /></td>
          <td><input type="text" id="pincode" name="pincode" placeholder="Pincode" onKeyUp="searchById('Listing','1');" /></td>
		  <td></td><td></td><td></td>
          </tr>
		  </table>
		  <div id="search"></div>
          </fieldset>
</div>
</body>

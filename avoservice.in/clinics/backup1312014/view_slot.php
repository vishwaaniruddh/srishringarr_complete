<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header('location:index.html');
 include('config.php');
 include('template_clinic.html');
?>

<!--Datepicker-->

<script>


function confirm_deleteslot(slot_id)
{
if(confirm("Are you sure you want to delete this slot?"))
  {
    document.location="delete_slot.php?slot_id="+slot_id;
  }
}
</script>


<link href="style1.css" rel="stylesheet" type="text/css" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Health Clinic</title>
<script type="text/javascript" src="paging.js"></script>
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
///////////////////////////////search By Id
function searchById(Mode,Page,num) {
 //alert("hi");
 var num2;
 if(num!=10)
 num2=document.getElementById(num).value;
 else
 num2=num;
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
		 
			 /* var id=document.getElementById('idd').value;
			  var s=document.getElementById('fname22').value;
			  var city=document.getElementById('city').value;//alert(city);
			  var area=document.getElementById('area').value;//alert(contact);
			  var mob=document.getElementById('mob').value;*/
			
//var pdate=document.getElementById('pdate').value;
//var ref=document.getElementById('ref').value;
						  
			  var url = 'search_slot.php';
		 // }
 	
		
			//alert(url);
			var pmeters = 'mode='+Mode+'&Page='+Page+'&num='+num2;

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

</script>
<link href="paging.css" rel="stylesheet" type="text/css" />
</head>
<body onLoad="searchById('Listing','1','10')">
<div class="M_page">
<fieldset class="textbox"><legend><h1>Slots</h1></legend>
<div id="search">

</div>

    </fieldset>
    </div>
  </body>

</html>

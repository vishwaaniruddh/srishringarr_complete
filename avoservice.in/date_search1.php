<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>

<title>Untitled Document</title>
<script>
///////////////////////////////search 
function searchById(a,b) {
//alert(a);
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
			 // var id=document.getElementById('idd').value;//alert(id);
			 //var br=document.getElementById('br').value; 
			 if(a!="Loading"){
			
			 var adate1=document.getElementById('adate1').value;
			 var adate2=document.getElementById('adate2').value;//alert(area);
			 
			  }
			//alert("gg"); 
			var url = 'date_alert1.php';
		//  }
 	
		var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'adate1='+adate1+'&adate2='+adate2;
			}//alert("gg");
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
 
//alert("gg"); 
			HttPRequest.onreadystatechange = function()
			{
 /*
			if(HttPRequest.readyState == 3)  // Loading Request
				  {
	document.getElementById("listingAJAX").innerHTML = '<img src="loader.gif" align="center" />';
				  }
 */
				 if(HttPRequest.readyState == 4) // Return Request
				  {
		var response = HttPRequest.responseText;
 
 //alert(response);
				  document.getElementById("search").innerHTML = response;
			  }
		}
  }

</script>
</head>

<body onLoad="searchById('Loading','1')">

<center>
<h2>Search By Alert Date </h2>

<table>
<tr>
<td>From Date :</td>
<td height="40"><input type="text" name="adate1" id="adate1"  placeholder="From" onclick="displayDatePicker('adate1');"/></td>
</tr>

<tr>
<td>To Date :</td>
<td width="75" height="40"><input type="text" name="adate2" id="adate2"  placeholder="To" onclick="displayDatePicker('adate2');"/></td>
</tr>

<tr>
<td width="75" height="40"><input type="button" value="search" onclick="searchById('Listing','1');" class="readbutton"/></td>
<td width="75" height="40"><input type="button" value="cancel" onclick="Javascript:location.href='view_callalert.php'" class="readbutton"/></td>
</tr>
</table>
<div id="search"></div>

</center>
</body>
</html>
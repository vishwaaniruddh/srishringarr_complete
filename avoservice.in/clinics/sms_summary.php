<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header('location:index.html');
 
include('config.php');
include('template_clinic.html');
?>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<link href="paging.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
<script>



function confirm_delete3(id)
{
	if (confirm("Are you sure you want to delete this entry?"))
	{
		document.location="delete_app.php?id="+id;
	}
	
}
</script>
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
			  var url = 'get_ByID1.php';
		  }else   if(document.getElementById('fname22').value==""){
			  
			  var s=document.getElementById('idd').value;
			var url = 'get_ByID1.php?id='+s;
		  } else if(document.getElementById('idd').value==""){
			  
			   var s=document.getElementById('fname22').value;
			var url = 'get_ByID1.php?fname='+s;
		  } else{*/
			  var hos=document.getElementById('hos').value;
			  var adate=document.getElementById('adate').value;
			 // var city=document.getElementById('city').value;//alert(city);
			  //var area=document.getElementById('area').value;//alert(contact);
			  //var diag=document.getElementById('diag').value;//alert(diag);
						  
			  var url = 'get_sms.php';
		 // }
 	
		
			//alert(url);
			var pmeters = 'mode='+Mode+'&Page='+Page+'&hos='+hos+'&adate='+adate;

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
				   document.getElementById("data").innerHTML = response;
			  }
		}
  }

</script>

<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
<body onLoad="searchById('Listing','1')">
<?php 
$result = mysql_query("select * from appoint");
?>

<div class="M_page">
<fieldset class="textbox">
<legend> <h1><img src="ddmenu/red-cross1.png" height="50" width="50">SMS Summary</h1> </legend>
          <table width="302">
          <tr>
          
          <td width="157" style="border:none;"><input type="text"  name="hos" id="hos" placeholder="Mobile No." onBlur="searchById('Listing','1');"/></td>
          
          <td width="157" style="border:none;"><input type="text"  name="adate" id="adate" placeholder="By Date" onBlur="searchById('Listing','1');" onClick="displayDatePicker('adate');"/></td>
          
          <td width="133" style="border:none;" valign="top">
          <button class="submit formbutton" type="button" onClick="searchById('Listing','1');"> Search </button>
          <!--<button class="submit formbutton" type="button" onClick="var n=document.getElementById('hos').value;
         var adate=document.getElementById('adate').value;
          window.open('hos_print.php?hos='+n+'&adate='+adate, '_BLANK')">Print</button>-->
          </td>
          </tr>
          </table>
          
          <div id="data"></div>
          

       </fieldset>

   </div>
</body>
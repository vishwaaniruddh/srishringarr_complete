<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 
include('config.php');
include('template.html');
$result = mysql_query("select * from patient");
?>
<style>
.results {table-layout:fixed;text-transform:uppercase;}
.results td {overflow: hidden;text-overflow: ellipsis; font-size:12px; width:135px;}
.results td input{font-size:12px;}
</style>

<link href="paging.css" rel="stylesheet" type="text/css" />
<script>
function confirm_delete3(id)
{ 
	if (confirm("Are you sure you want to delete this entry?"))
	{
		document.location="delete_app.php?id="+id;
	}
	
}

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
		  /*if(document.getElementById('searchdate').value=="" && document.getElementById('fname22').value=="" && document.getElementById('cont').value=="")
		  {
			  var url = 'get_app.php';
		  }else   if(document.getElementById('fname22').value=="" && document.getElementById('cont').value==""){
			  
			  var s=document.getElementById('searchdate').value;
			  var c= document.getElementById('cont').value;
			var url = 'get_app.php?searchdate='+s+'&cont='+c;
		  } else if(document.getElementById('searchdate').value=="" && document.getElementById('cont').value==""){
			  
			   var s=document.getElementById('fname22').value;
			var url = 'get_app.php?fname='+s;
		  } 
		  
		  else if(document.getElementById('searchdate').value=="" && document.getElementById('fname22').value==""){
			  
			   var cont=document.getElementById('cont').value;
			var url = 'get_app.php?cont='+s; //alert(cont);
		  }
		  else{
			  var searchdate=document.getElementById('searchdate').value;
			  var s=document.getElementById('fname22').value;
			  var cont=document.getElementById('cont').value; //alert(cont);

			var url = 'get_app.php?fname='+s+'&searchdate='+searchdate+'&cont='+cont;
		  }*/
 	
		      var name=document.getElementById('name').value;//alert(id);
			  var searchdate=document.getElementById('searchdate').value;//alert(adate);
			  var cont=document.getElementById('cont').value;//alert(city);
			   var hos=document.getElementById('hos').value;//alert(city);
			   var ref=document.getElementById('ref').value;//alert(city);
			  
			  var url = 'get_app.php';
			
			var pmeters = 'mode='+Mode+'&Page='+Page+'&name='+name+'&searchdate='+searchdate+'&cont='+cont+'&hos='+hos+'&ref='+ref;

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

function SentMail()
{
var x=document.getElementById('reccnt').value;
for(i=0;i<x;i++)
{
if(document.getElementById('mail'+i).checked==true)
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
    {
		alert(xmlhttp.responseText);
    document.getElementById("report").innerHTML=xmlhttp.responseText;
    }
  }
  value=document.getElementById('mail'+i).value;
 //alert("garmentgallery.php?cid="+id);
// alert("getcustdetail.php?id="+value+"&attr="+attr);
if(value!='')
xmlhttp.open("get","missed_app.php?patid="+value,false);
//alert("getpage.php?page="+page);
//xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send();

}
}
}



</script>

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<body onLoad="searchById('Listing','1')">

<p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Today's Appointments</p>

   <table class="results">
   <tr>
   <td><input type="text" style="border:none; width:65px; height:20px" name="searchdate" id="searchdate" onBlur="searchById('Listing','1');"  placeholder="Date" onClick="displayDatePicker('searchdate');" value="<?php  if(isset($_GET['searchdate'])){ echo $_GET['searchdate']; } ?>"/></td>
   <td><input type="text" style="border:none; width:50px; height:20px" name="name" id="name"  onkeyup="searchById('Listing','1');" placeholder="Name"/></td>
   <td><input type="text" style="border:none; width:70px; height:20px" name="cont" id="cont"  onkeyup="searchById('Listing','1');" placeholder="Contact"/></td>
 <td><input type="text" style="border:none; width:90px; height:20px" name="ref" id="ref"  onkeyup="searchById('Listing','1');" placeholder="Reference"/></td>
   <td><input type="text" style="border:none; width:70px; height:20px" name="hos" id="hos"  onkeyup="searchById('Listing','1');" placeholder="Hospital"/></td>
   </tr>
   </table>

        <div id="search"></div>


    <button class="submit formbutton" type="button" onClick="var name=document.getElementById('name').value;
          var searchdate=document.getElementById('searchdate').value; var cont=document.getElementById('cont').value;
          window.open('app_print.php?name='+name+'&searchdate='+searchdate+'&cont='+cont, '_BLANK')">Print</button>
<div id="report"></div>
</body>

<?php 
include('footer.html');
}else
{ 
 header("location: index.html");
}

?>
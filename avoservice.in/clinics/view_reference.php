<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header('location:index.html');
include('template_clinic.php');
include('config.php');
?>
<link href="paging.css" rel="stylesheet" type="text/css" />
<script>
//subcat
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
			  var id=document.getElementById('idd').value;
			  var s=document.getElementById('fname22').value;
						  
			  var url = 'get_pat_ref.php';
		 // }
 	
		
			//alert(url);
			var pmeters = 'mode='+Mode+'&Page='+Page+'&fname='+s+'&id='+id;
//alert(pmeters);
			HttPRequest.open('POST',url,true);
 
			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
 

			HttPRequest.onreadystatechange = function()
			{
 
			if(HttPRequest.readyState == 3)  // Loading Request
				  {
	document.getElementById("search").innerHTML = '<img src="loader.gif" align="center" />';
				  }
 
				 if(HttPRequest.readyState == 4) // Return Request
				  {
		var response = HttPRequest.responseText;
 
// alert(response);
				   document.getElementById("search").innerHTML = response;
			  }
		}
  }
  
function showrem(id,cnt)
{
	if(document.getElementById(id).style.display=='none')
	{
		document.getElementById(id).style.display='block';
	}
	else
	document.getElementById(id).style.display='none';
	if(document.getElementById(id+'1').style.display=='none')
	document.getElementById(id+'1').style.display='block';
	else
	document.getElementById(id+'1').style.display='none';
}
function add_date(cnt,ld)
{
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
		//alert(xmlhttp.responseText);
	if(xmlhttp.responseText=="1")
	{
		alert('Successfully Updated.');
		showrem('showrem'+cnt);
	}
	else
	{
		alert(xmlhttp.responseText);
		//document.getElementById("test_here").innerHTML = xmlhttp.responseText;
		//alert('Error in completing request. Please try again');
	}
    }
  }
  var num=document.getElementById('num'+cnt).value;
  var add_type=document.getElementById('add_type'+cnt).value;
    if(num=="")
    {
	alert("Please Select Number.");
	document.getElementById('num'+cnt).focus();
	return false;
    }
    else if(add_type=="")
    {
	alert("Please Select Add Type.");
	document.getElementById('add_type'+cnt).focus();
	return false;
    }
    else if(confirm('Are you sure you want update.'))
    {
    	xmlhttp.open("GET","add_enddate.php?num="+num+"&id="+ld+"&add_type="+add_type,true);
	xmlhttp.send();
    }

	
}

</script>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
 <link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<style>


 .M_page:-ms-input-placeholder { color:#f00; } 
 
 
</style>

<body onLoad="searchById('Listing','1')">
  
  
  
   <div class="M_page">
   <fieldset class="textbox">
   
	<legend><h1><img src="ddmenu/img1.png" style="width:50px; height:50px;" />Patient's Records</h1></legend>
    
    	   
    <table>
    <tr><td colspan="9"><?php if($newuser!="") echo "<h1 style='text-align:center; color:red'>New Patient (Id - ".$newuser. ") Name- ". $result[0] ."<a href='view_patient1.php'> <img   src='images/close.gif'</a></h1>";?></td></tr>
    <tr>
    <td><input type="text"  name="idd" id="idd" onKeyUp="searchById('Listing','1');"  placeholder="Id" /></td>
    <td><input type="text"  name="fname22" id="fname22"  onkeyup="searchById('Listing','1');" placeholder="Name"/></td>
    </tr>
    </table>
  
<div id="test_here"></div>
<div id="search"></div>
            </fieldset>
              
         </div>
</body>
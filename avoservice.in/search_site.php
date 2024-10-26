<?php
include("access.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script src="popup.js" type="text/jscript" language="javascript"> </script>

 
<script type="text/javascript">



///////////////////////////////search 
function searchById(a,b) {
//alert(a+" "+b+" "+perpg);

document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";

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
		 
			 
			var type=document.getElementById('type').value
			// if(a!="Loading"){
			 var data=document.getElementById('data').value;//alert(id);
			
			//  }
			//alert(document.getElementById('type').value);
			
			if(document.getElementById('type').value==""){
			    alert ("Enter type of search") ;}
			    else if(document.getElementById('type').value=="invoice"){
			 var url='sitesearch_invoice.php'
			 } else if(document.getElementById('type').value=="sno"){
			 var url='sitesearch_sno.php'
			 } else {  var url='siteid_search.php' }
 	
		var pmeters="";
			alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'data='+data+'&type='+type;
			}//alert("gg");
			else
			{
		 pmeters = 'data='+data+'&type='+type;	
			}
		//	alert(pmeters);
			
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
 
//alert("gg"); 
			HttPRequest.onreadystatechange = function()
			{
 
				 if(HttPRequest.readyState == 4) // Return Request
				  {
		var response = HttPRequest.responseText;
 
 //alert(response);
				  document.getElementById("search").innerHTML = response;
			  }
		}
  }
 
 function confirm_generate(id,atm,cid,type)

{
 
   // alert("id="+id+"type="+site+"atm="+atm+"cid="+cid);
    
	if (confirm("Are you sure you want to Generate call ?"))
	{
		document.location="service1.php?id="+id+"&type="+type+"&atm="+atm+"&cid="+cid;
		
	}
	
}
 
 
</script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>

<h2 class="h2color">Search for Site</h2>

<table  border="0" cellpadding="0" cellspacing="0">
<tr>

</tr>
<tr>
<th >Search Type <select  name="type" id="type" >



<option value="">Search By:</option>
<option value="siteid">Site/Sol/ATM Id</option>
<option value="invoice">Invoice Number</option>
<option value="sno">By Serial No.</option>
<option value="add">By Address</option>
</select> </th>



<th width="75"><input type="text" size="15" name="data" id="data" placeholder="Input data"/><br /></th>
<th><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>


</tr>
</table>




<div id="search"></div>

</center>
</body>
</html>
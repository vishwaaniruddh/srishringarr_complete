<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 
include('config.php');
include('template.html');

$sql="select * from patient";
$result=mysql_query($sql);
?>
<style>
.results {table-layout:fixed;text-transform:uppercase;}
.results td {overflow: hidden;text-overflow: ellipsis; font-size:12px; width:120px;}
.results td input{font-size:12px;}
</style>
<!--Discharge Records-->
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
			  var url = 'get_docID.php';
		  }else   if(document.getElementById('fname22').value==""){
			  
			  var s=document.getElementById('idd').value;
			var url = 'get_docID.php?id='+s;
		  } else if(document.getElementById('idd').value==""){
			  
			   var s=document.getElementById('fname22').value;
			var url = 'get_docID.php?fname='+s;
		  } else{*/
			  
			  var s=document.getElementById('fname').value;//alert(s);
			  var diag=document.getElementById('diag').value;//alert(city);
			  var tre=document.getElementById('tre').value;//alert(contact);
			  var op=document.getElementById('op').value;
			var url = 'dischargesearch.php';
		//  }
 	
		
			//alert(url);
			var pmeters = 'mode='+Mode+'&Page='+Page+'&fname='+s+'&diag='+diag+'&tre='+tre+'&op='+op;

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
<!--
function confirm_deletedis(id)
{
if(confirm("Are you sure you want to delete this entry?"))
  {
    document.location="delete_discharge.php?id="+id;
  }
}
//-->
</script>

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>


<body onLoad="searchById('Listing','1')">

        
        <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">View Discharge</p><br />
        
          <table width="835">
          <tr>
		  <td width="154" height="36"><input type="text" id="fname" name="fname" placeholder="Name" style="border:none; height:20px" onKeyUp="searchById('Listing','1');"/></td>
		   
          <td width="178">
          <input type="text" id="diag" name="diag" placeholder="Diagnosis" style="border:none; width:65px;height:20px" onKeyUp="searchById('Listing','1');"/></td>
          <td width="162"><input type="text" id="op" name="op" placeholder="Operaton" style="border:none;  width:65px;height:20px" onKeyUp="searchById('Listing','1');"/></td>
       
          <td width="225"><input type="text" id="tre" name="tre" placeholder="Treatment" style="border:none; width:65px; height:20px" onKeyUp="searchById('Listing','1');"/></td>
	
		  <td width="92"></td>
          </tr>
</table>
		  <div id="search"></div>
        
  
</body>

<?php
include('footer.html'); 
}else
{ 
 header("location: index.html");
}

?>
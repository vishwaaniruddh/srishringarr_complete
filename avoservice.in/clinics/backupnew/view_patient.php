<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header('location:index.html');
 
include('config.php');
include('template_clinic.html');

$sql="select * from patient";
$result=mysql_query($sql);

$results1 = mysql_query("SELECT * FROM opdwait WHERE new_old ='N'");
$rows1 = mysql_num_rows($results1);


$results2 = mysql_query("SELECT * FROM opdwait WHERE new_old ='O'");
$rows2 = mysql_num_rows($results2);


$results3 = $rows1 + $rows2;

?>
<style>

</style>
<script type="text/javascript">
function confirm_deleterecord(id)
{
if(confirm("Are you sure you want to delete this entry?"))
  {
    document.location="delete_apprecord.php?id="+id;
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
			  var id=document.getElementById('idd').value;//alert(id);
			  var s=document.getElementById('fname').value;//alert(s);
			  var adate=document.getElementById('adate').value;//alert(adate);
			  var hos=document.getElementById('hos').value;//alert(city);
			 
			var url = 'get_ByID.php';
		//  }
 	
		
			//alert(url);
			var pmeters = 'mode='+Mode+'&Page='+Page+'&fname='+s+'&id='+id+'&adate='+adate+'&hos='+hos;

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

<!--Datepicker-->
<link href="paging.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />

<body onLoad="searchById('Listing','1')">
<div class="M_page">
<fieldset class="textbox">
<legend><h1><img src="ddmenu/opd.png" style="width:50px; height:50px;" />OPD Waiting Patients</h1></legend>
          
<table >
<tr>
<td><label>Total Patients:</label></td><td><input type="text" name="total" id="total" value="<?php echo $results3; ?>" ></td>
<td><label>New:</label></td><td><input type="text" name="new" id="new" value="<?php echo $rows1;?>" ></td>
<td><label>Follow-up:</label></td><td><input type="text" name="fol" id="fol" value="<?php echo $rows2;?>" ></td>
</tr>
</table>
<br/>
<br/>
		  <table width="762" >
          <tr>
    <td><input type="text"  name="idd" id="idd" placeholder="Search By Id" onKeyUp="searchById('Listing','1');"/></td>
    <td><input type="text"  name="fname" id="fname" placeholder="Search By Name" onKeyUp="searchById('Listing','1');"/></td>
    <td><input type="text"  name="adate" id="adate" placeholder="By App Date" onBlur="searchById('Listing','1');"/></td>
    <td><input type="text"  name="hos" id="hos" placeholder="By Hospital" onKeyUp="searchById('Listing','1');"/></td>
    <td><input type="button" value="select" style="width:80px;height:25px;" onClick="displayDatePicker('adate');"></td>
  </tr></table>



  <div id="search"></div>

 <button class="submit formbutton" type="button" onClick="var n=document.getElementById('adate').value;var o=document.getElementById('fname22').value;window.open('opdwait_print.php?fname22='+o+'&adate='+n, '_BLANK')">Print</button>
   </fieldset> 
</div>
</body>
</html>

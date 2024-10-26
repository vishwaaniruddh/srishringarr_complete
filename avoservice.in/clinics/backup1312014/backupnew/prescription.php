<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header("location: index.html");
include('template_clinic.html');
include('config.php');
?>

<script type="text/javascript">
setInterval(function(){
    searchById('Listing','1')  // method to be executed;
    },40000);
function getXMLHttp()

{

  var xmlHttp

// alert("hi1");

  try

  {

    //Firefox, Opera 8.0+, Safari

    xmlHttp = new XMLHttpRequest();

  }

  catch(e)

  {

    //Internet Explorer

    try

    {

      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");

    }

    catch(e)

    {

      try

      {

        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");

      }

      catch(e)

      {

        alert("Your browser does not support AJAX!")

        return false;

      }

    }

  }

  return xmlHttp;

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
		  var name=document.getElementById('name').value;//alert(id);
			  var searchdate=document.getElementById('searchdate').value;//alert(adate);
			  var cont=document.getElementById('cont').value;//alert(city);
			   var pat=document.getElementById('patid').value;//alert(city);
			   var app=document.getElementById('appid').value;//alert(city);
			  
			  var url = 'search_pres.php';
			
			var pmeters = 'mode='+Mode+'&Page='+Page+'&name='+name+'&searchdate='+searchdate+'&cont='+cont+'&patid='+pat+'&appid='+app;
//alert(pmeters)
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
  
  
  function getpres(opdid)
{
//alert(opdid);

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

      //HandleResponse4(xmlHttp.responseText);
document.getElementById("med").innerHTML=xmlhttp.responseText;

    }

  }

 xmlhttp.open("GET", "getpres.php?opd="+opdid, false);
 //alert("getpres.php?opd="+opdid);
//alert("getitem.php?cname="+str+"&type="+str1);
  xmlhttp.send();

}
function givemed(opdid,appid)
{
if (confirm("Are you sure you want to give medicine to this patient?"))
	{
//alert(opdid+" "+appid);
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
	//alert(xmlhttp.responseText);
if(xmlhttp.responseText=='1')
{
if (confirm("Do you want to print this prescription?"))
{
printDiv("med");

document.getElementById("med").innerHTML='';
searchById('Listing','1');
}
else
{
document.getElementById("med").innerHTML='';
searchById('Listing','1');
}
}
else
alert("Some Error Occurred");
    }

  }

 xmlhttp.open("GET", "givemed.php?opd="+opdid+"&appid="+appid, false);
//alert("givemed.php?opd="+opdid+"&appid="+appid);
//alert("getitem.php?cname="+str+"&type="+str1);
  xmlhttp.send();

}
}
function printDiv(divName) {
//alert(divName);
 document.getElementById("medbut").style.display='none';
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />

<body onLoad="searchById('Listing','1')">


<div class="M_page">
<fieldset class="textbox">
 <legend><h1><img src="ddmenu/pharmacy_icon.png" height="50" width="50">Pharmacy Section</h1></legend>
 
<table width="100" >
   <tr>
   <td><input type="text"  name="searchdate" id="searchdate" onBlur="searchById('Listing','1');"  placeholder="Date" onClick="displayDatePicker('searchdate');" value="<?php  if(isset($_GET['searchdate'])){ echo $_GET['searchdate']; } else{ echo date("d/m/Y");  } ?>"/></td>
   <td><input type="text"  name="patid" id="patid"  onkeyup="searchById('Listing','1');" placeholder="patient ID"/></td>
   <td><input type="text"  name="name" id="name"  onkeyup="searchById('Listing','1');" placeholder="Name"/></td>
   <td><input type="text"  name="cont" id="cont"  onkeyup="searchById('Listing','1');" placeholder="Contact"/></td>
   <td><input type="text"  name="appid" id="appid"  onkeyup="searchById('Listing','1');" placeholder="Appointment ID"/></td>
 
   </tr>
   </table>
<!--<?php 
$qry=mysql_query("select * from appoint where presstat<>'2' and app_real_id in(select app_id from opd where medicines<>'') order by app_id DESC");
 ?>
<table border="0" width="80%">
<?php
while($row=mysql_fetch_array($qry))
{
//echo "select name from patient where srno='".$row[11]."'";
$pat=mysql_query("select name,srno from patient where srno='".$row[11]."'");
$patro=mysql_fetch_row($pat);
$opd=mysql_query("select medicines from opd where app_id='".$row[22]."'");
$opdro=mysql_fetch_row($opd);
$med=explode(",",$opdro[0]);
if(count($med)>0 && $med[0]!='')
{
?>
<tr><td>
<table border="0" width="100%"><tr><td valign="top">Patient Name:</td><td><h2><b><?php echo $patro[0]; ?></b></h2></td><td>&nbsp;</td>
<td valign="top">Patient ID:</td><td valign="top"><b><?php echo $patro[1]; ?></b></td></tr>
<tr><td colspan="5"><table border="1" width="50%"><tr><th width="10%">Sr. no.</th><th>Medicine</th></tr><?php  

for($i=0;$i<count($med);$i++)
{
?>
<tr><td><?php echo $i+1; ?></td><td><?php echo $med[$i]; ?></td></tr>
<?php
}
 ?></table></td></tr>
</table>
<hr size="2" />
</td></tr>
<?php
}
}
?>
</table>-->
  <table width="98%" border="1">
  <tr><td width="50%" valign="top"> <div id="search" style="width:50px"></div></td>
  <td width="50%"><div id="med">&nbsp;</div></td>
  </tr>
  </table>

</fieldset>
</div>

</body>
</html>
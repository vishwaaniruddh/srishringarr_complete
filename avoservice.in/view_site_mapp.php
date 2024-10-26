<?php
include("access.php");
include("config.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

$branch=$_SESSION['branch'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script src="popup.js" type="text/jscript" language="javascript"> </script>

<script>
function runScript(e) {
    if (e.keyCode == 13) {
		searchById('Listing','1','');
       // alert('enter pressed');
        // document.getElementById('button').click();
    }
}

</script>

<script type="text/javascript">

///////////////////////////////search 
function searchById(a,b,perpg) {
//alert(a+" "+b+" "+perpg);
var ppg='';
if(perpg=='')
ppg='10';
else
ppg=document.getElementById(perpg).value;
//alert(ppg);
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
		 
			 var br=document.getElementById('br').value;//alert(br);
			var type=document.getElementById('type').value;
			var mapp=document.getElementById('mapp').value;
			
			 if(a!="Loading"){
			 var id=document.getElementById('id').value;//alert(cid);
			 var cid=document.getElementById('cid').value;//alert(cid);
			 var branch=document.getElementById('branch').value;//alert(branch);
			 var add=document.getElementById('add').value;//alert(add);
			  }
			
			if(document.getElementById('type').value=="warr"){
			var url = 'search_site_mapp_warr.php';
			}else if(document.getElementById('type').value=="amc"){
			var url='search_amc_map.php'
		 }
 	
		var pmeters="";
		//	alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'id='+id+'&cid='+cid+'&add='+add+'&Page='+b+'&perpg='+ppg+'&br='+br+'&branch='+branch+'&mapp='+mapp;
			}//alert("gg");
			else
			{
			pmeters = 'Page='+b+'&perpg='+ppg+'&br='+br+'&mapp='+mapp;	
			}
			//alert(pmeters);
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
  
function setchange(id)
{
var xmlhttp = new XMLHttpRequest();
         xmlhttp.onreadystatechange = function() {
             if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                 alert(xmlhttp.responseText);
                 document.getElementById('subdiv'+id).innerHTML = "";
                 document.getElementById('subdiv'+id).innerHTML = xmlhttp.responseText;
           }
         }
         
         engg=document.getElementById('bbchange'+id).value; //alert (reason);
        
         if(engg.length==0)
         alert("Please Select Correct Engineer");
         
         else{
       
         xmlhttp.open("GET", "set_engg_mapp.php?id="+id+"&engg="+engg, true);
      
         xmlhttp.send();
         }
} 

function setamcchange(id)
{
var xmlhttp = new XMLHttpRequest();
         xmlhttp.onreadystatechange = function() {
             if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                 alert(xmlhttp.responseText);
                 document.getElementById('subdiv'+id).innerHTML = "";
                 document.getElementById('subdiv'+id).innerHTML = xmlhttp.responseText;
           }
         }
         
         engg=document.getElementById('bbchange'+id).value; //alert (reason);
        
         if(engg.length==0)
         alert("Please Select Correct Engineer");
         
         else{
       
         xmlhttp.open("GET", "set_amcengg_mapp.php?id="+id+"&engg="+engg, true);
      
         xmlhttp.send();
         }
} 
 
</script>
</head>

<body onLoad="searchById('Loading','1','')">
<center>
<?
include("menubar.php");  
      ?>
        
        <?php  $br= $_SESSION['branch']; ?>

<input type="hidden" value="<?php  echo $br;?>" name="br" id="br"/>
<h2 class="h2color">Engineer Mapping Details</h2>

<div class="">
<!--<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
	<br /> -->
<table  border="0" cellpadding="0" cellspacing="0">
<tr>

</tr>
<tr>
<th >Select Site <select  name="type" id="type" onchange="searchById('Listing','1','');">

<option value="warr">Warranty Sites</option>
<option value="amc">AMC Sites</option>

</select> </th>

<th>Select <select  name="mapp" id="mapp" onchange="searchById('Listing','1','');">
<option value="">Select</option>
<option value="mapped">Mapped Sites</option>
<option value="unmapp">Un-Mapped Sites</option>

</select> </th>
<th width="77">

<select id="cid" onchange="searchById('Listing','1','');">
<option value="">Vertical/ Customer</option>
<?php $qrycust=mysqli_query($con1,"select cust_id,cust_name from customer");
while($fetchcust=mysqli_fetch_array($qrycust))
{
?>
<option value="<?php echo $fetchcust[0];?>"><?php echo $fetchcust[1];?></option>
<?php } ?>
</select>

<? if($branch != 'all') 

$brqry ="select id, name from avo_branch where id in('$branch')";

else
$brqry="select id, name from avo_branch";

//echo $brqry;

$br1=mysqli_query($con1,$brqry);
?>


<th width="75">
    <select name="branch" id="branch" onchange="searchById('Listing','1','');" >

<option value="">Branch</option>
<?php

while($brr=mysqli_fetch_array($br1))
{
?>
<option value="<?php echo $brr[0]; ?>"><?php echo $brr[1]; ?></option>
<?php
}
?>
</select>


</th>

<th width="75"><input type="text" size="15" name="add" id="add" onkeypress="return runScript(event)" placeholder="Address"/></th>
<th width="75"><input type="text" size="15" name="id" id="id" onkeypress="return runScript(event)" placeholder="Site/Sol/ATM Id"/><br /></th>
<th><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>

</tr>
</table>
</div>




<div id="search"></div>

</center>
</body>
</html>
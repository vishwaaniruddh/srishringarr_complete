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
function pick_asset(val)
{
 // alert(val);
brid=val;
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
    var s=xmlhttp.responseText;
  	//alert(s);
	 document.getElementById('mystate').innerHTML = s;	
    }
  }
      	//alert("get_state_br.php?brid="+brid);    
	xmlhttp.open("GET","get_assetspecs.php?brid="+brid,true);
	xmlhttp.send();
}

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
		 
			
			var type=document.getElementById('product').value
			 if(a!="Loading"){
			var specs=document.getElementById('specs').value;//alert(cid);
			 var cid=document.getElementById('cid').value;//alert(cid);
			 var branch=document.getElementById('branch').value;//alert(state);
		 	  }
			var url='search_assetwise_sites.php';
		var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'cid='+cid+'&Page='+b+'&perpg='+ppg+'&branch='+branch+'&type='+type+'&specs='+specs;
			}//alert("gg");
			else
			{
			pmeters = 'Page='+b+'&perpg='+ppg+'&type='+type;	
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
 
</script>
</head>

<body onLoad="searchById('Loading','1','')">
<center>
<?
     if($_SESSION['designation']==5){

            include("AccountManager/menubar.php");
        }
        else{

          include("menubar.php");  
        }
?>

<h2 class="h2color">Product-wise Site Details</h2>

<div class="">
<table  border="0" cellpadding="0" cellspacing="0">

<tr>
<th>
    Select Product <select  name="product" id="product" onchange="pick_asset(this.value);" >
    <option value="">Select</option>
<?php 
$qryasset=mysqli_query($con1,"select * from assets order by assets_name ASC");
while($fetchr=mysqli_fetch_array($qryasset))
{
?>
<option value="<?php echo $fetchr[1];?>"><?php echo $fetchr[1];?></option>
<?php } ?>
</select> 
</th>

<th >
    <div id="mystate">Select Asset <select  name="specs" id="specs" onchange="searchById('Listing','1','');">
    <option value="">Select</option>
    </div>
</th>


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
</th>

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
<th><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>
</tr>
</table>
</div>

<div id="search"></div>

</center>
</body>
</html>
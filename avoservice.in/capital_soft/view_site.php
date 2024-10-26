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
<link href="../style.css" rel="stylesheet" type="text/css" />
<link href="../menu.css" rel="stylesheet" type="text/css" />
<script src="../popup.js" type="text/jscript" language="javascript"> </script>

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
function confirm_delete(id,tos)
{
	if (confirm("Are you sure you want to DeActivate this entry?"))
	{
		document.location="delete_site.php?id="+id+"&tos="+tos;
	}
	
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
		
			 if(a!="Loading"){
			 var id=document.getElementById('id').value;//alert(id);
			 var bank=document.getElementById('bank').value;//alert(bank);
			 var area=document.getElementById('area').value;//alert(area);
			 var branch=document.getElementById('branch').value;//alert(state);
			
			 	  }
			var url='search_sitedata.php'
		 
 	
		var pmeters="";
		//	alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'id='+id+'&area='+area+'&bank='+bank+'&Page='+b+'&perpg='+ppg+'&branch='+branch;
			}//alert("gg");
			else
			{
			pmeters = 'Page='+b+'&perpg='+ppg;	
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
<? include("menubar.php");  ?>
<h2 class="h2color">View Site</h2>

<div class="">
<!--<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export data into Excel</button> -->
<table  border="0" cellpadding="0" cellspacing="0">
<tr>

<th width="145"><input type="text" size="15" name="bank" id="bank" onkeypress="return runScript(event)" placeholder="End User"/></th>

<?php $brqry="select id, name from avo_branch";

$br1=mysqli_query($concs,$brqry);
?>

<th width="75">
    <select name="branch" id="branch" onchange="searchById('Listing','1','');" >

<option value="">Region</option>
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

<th width="75"><input type="text" size="15" name="area" id="area" onkeypress="return runScript(event)" placeholder="Address"/></th>
<th width="75"><input type="text" size="15" name="id" id="id" onkeypress="return runScript(event)" placeholder="Site/Sol/ATM Id"/></th>
<th><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>

</tr>
</table>
</div>


<div id="search"></div>

</center>
</body>
</html>
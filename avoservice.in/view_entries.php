<?php
//session_start();
include("access.php");
include('config.php');

?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="1200" >
<title>Factory</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="popup.css"  rel="stylesheet" type="text/css">
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="popup.js" type="text/jscript" language="javascript"> </script>

<script>
///////////////////////////////search 
function searchById(a,b,perpg) {
//alert(a+" "+b+" "+perpg);
var ppg='';
if(perpg=='')
ppg='10';
else
ppg=document.getElementById(perpg).value;
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
		  var factory=document.getElementById('factory').value;
		  
			 if(a!="Loading"){
			 	var factory=document.getElementById('factory').value;//alert(factory);
			 	var cust=document.getElementById('cust').value;
			   	var fromdt=document.getElementById('fromdt').value;
			 	var todt=document.getElementById('todt').value;
			   
			  }
			 // alert(br);
			//alert("gg"); 
			var url = 'search_entries.php'; 
		//  }
 	//alert(br);
		    var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'factory='+factory+'&Page='+b+'&perpg='+ppg+'&fromdt='+fromdt+'&todt='+todt+'&cust='+cust;
			// alert(pmeters);
			}
			else
			{
				 pmeters = 'factory='+factory+"&Page="+b+'&perpg='+ppg;
			}
			//alert(pmeters);
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
 
//alert(pmeters); 
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


function newwin(url,winname,w,h)
{
//alert("hi");
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (url, winname, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=1, resizable=yes, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
  //mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=500,height=400,left=350,top=200");
 
 }
 
 function runScript(e) {
    if (e.keyCode == 13) {
		searchById('Listing','1','');
       // alert('enter pressed');
        // document.getElementById('button').click();
    }
}

</script>
</head>

<body onLoad="searchById('Loading','1','')">
<center>
<? include("menubar.php");  ?>

<h2 class="h2color">View Entries</h2>
<div >
 <table cellpadding="" cellspacing="0" >

<tr>
<th>Factories</th><th>Suppliers</th><th>From Book Date</th><th>To Book Date</th> <th></th> </tr>
<tr>
    
<th>
    <select name="factory" id="factory">
    <option value="">All</option>
    <? $faqry=mysqli_query($con1,"select * from factories");
    while($fact=mysqli_fetch_row($faqry)) { ?>
    <option value="<?php echo $fact[1]; ?>"><?php echo $fact[1]; ?></option>  
    <? } ?>
    </select>
    
</th>    
<th>
    <select name="cust" id="cust">
    <option value="">All</option>
    <? $paqry=mysqli_query($con1,"select * from parties");
    while($part=mysqli_fetch_row($paqry)) { ?>
    <option value="<?php echo $part[0]; ?>"><?php echo $part[1]; ?></option>  
    <? } ?>
    </select>
    
</th>   
 <th width="75"><input type="text" name="fromdt" id="fromdt" onkeypress="return runScript(event)"  readonly="readonly" onclick="displayDatePicker('fromdt');" placeholder="To Date"/></th>
    
<th width="75"><input type="text" name="todt" id="todt" onkeypress="return runScript(event)"  readonly="readonly" onclick="displayDatePicker('todt');" placeholder="To Date"/></th>
     
      
  <th width="75" rowspan="2"><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>
 
  
  </tr>
  
</table>
</div>
<div id="search"></div>


</center>
</body>
</html>
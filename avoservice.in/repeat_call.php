<?php
include("access.php");
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
session_start();
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="1200" >
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
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
		  
		     var fromdt=document.getElementById('fromdate').value;
			var todt=document.getElementById('todate').value;
		
			var url = 'search_repeat_call.php'; 
			//alert(perpg);		
		    var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			
			if(a=="Loading"){ 
			 pmeters='Page='+b+'&perpg='+ppg;			 //alert(pmeters);
			}
			else
			{
				 pmeters ='Page='+b+'&perpg='+ppg+'&fromdt='+fromdt+'&todt='+todt;
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

<!--<body onLoad="searchById('Loading','1','')" >-->
<body  >
<center>
<?php include("menubar.php");  ?>

<div >
 <!--<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>-->
	<br />
<table cellpadding="" cellspacing="0" >
    <h2>Repeat Calls logged for the Day </h2>
  <tr>
 <? $date=date('d/m/Y'); ?>
     
<th width="75"><input style="color:red;font-weight: bold;"type="text" name="fromdate" id="fromdate" onkeypress="return runScript(event)"  value= "<? echo $date; ?>" readonly="readonly" onclick="displayDatePicker('fromdate');" placeholder="From Date"/></th>

<th width="75"><input style="color:red;font-weight: bold;"type="text" name="todate" id="todate" onkeypress="return runScript(event)"  value= "<? echo $date; ?>" readonly="readonly" onclick="displayDatePicker('todate');" placeholder="To Date"/></th>
     
<th width="75" rowspan="2"><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>
   </tr>
  
</table>
</div>
<div id="search"></div>


</center>
</body>
</html>
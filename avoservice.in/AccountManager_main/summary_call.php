<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
// print_r($_SESSION['branch']);
$brme=($_SESSION['branch']);
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="1200" >
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<link href="../menu.css" rel="stylesheet" type="text/css" />
<link href="../popup.css"  rel="stylesheet" type="text/css">
<!--datepicker-->
<link href="../datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="../datepicker/datepick_js.js" type="text/javascript"></script>
<script src="../popup.js" type="text/jscript" language="javascript"> </script>

<script>
///////////////////////////////search 
function searchById(a,b,perpg) {
//alert(a+" "+b+" "+perpg);
var ppg='';
if(perpg=='')
ppg='20';
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
		  //var br=document.getElementById('br').value;
		  var calltype=document.getElementById('calltype').value;
		  var curdate=document.getElementById('curdate').value;
		  var callwise=document.getElementById('callwise').value;
		  //var openall=document.getElementById('openall').value;
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
			 // var id=document.getElementById('idd').value;//alert(id);
			 if(a!="Loading"){
				 	var calltype=document.getElementById('calltype').value;
					var fromdt=document.getElementById('fromdt').value;
			 		var todt=document.getElementById('todt').value;	
					var callwise=document.getElementById('callwise').value;		 	
				
			  }
			 // alert(br);
			//alert("gg"); 
			var url = 'search_summarycall.php'; 
		//  }
 	//alert(br);
		    var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'curdate='+curdate+'&calltype='+calltype+'&Page='+b+'&perpg='+ppg+'&fromdt='+fromdt+'&todt='+todt+'&callwise='+callwise;
			// alert(pmeters);
			}
			else
			{
				 pmeters='curdate='+curdate+"&Page="+b+"&calltype="+calltype+'&perpg='+ppg+'&callwise='+callwise;
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
 /*
			if(HttPRequest.readyState == 3)  // Loading Request
				  {
	document.getElementById("listingAJAX").innerHTML = '<img src="loader.gif" align="center" />';
				  }
 */
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
  
  
  /////////////////////
  
  
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
<?php $br= $_SESSION['branch'];
?>
<input type="hidden" value="<?php  echo date("Y-m-d");?>" name="curdate" id="curdate"/>
<center>
<?php include("menubar.php");

 ?>
<h2 class="h2color">View Call Summary</h2>
<div >
	
<table cellpadding="" cellspacing="0" >
  <tr>
    <th width="77" colspan="">
    <select name="calltype" id="calltype" onchange="searchById('Listing','1','');">
      <option value="brsummary">Branch Wise Summary</option>
      <option value="clisummary">Client Wise Summary</option>
    </select>
    </th>
    
  	<th width="75">
   	<input type="text" name="fromdt" id="fromdt" onkeypress="return runScript(event)" readonly="readonly" onclick="displayDatePicker('fromdt');" placeholder="From Date"/></th>
  	
    <th width="75">
 	<input type="text" name="todt" id="todt" onkeypress="return runScript(event)"  readonly="readonly" onclick="displayDatePicker('todt');" placeholder="To Date"/></th>
     
 	<th width="75">
 	<select name="callwise" id="callwise" onchange="searchById('Listing','1','');">
    	
     	<option value="all">All</option>
      	<option value="service">Service Call</option>
      	<option value="new">New Call</option>
    </select></th>
     
	<th width="75" rowspan="2">
	<input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>  
    
  
  </tr>
  
</table>
</div>
<div id="search"></div>


</center>
</body>
</html>
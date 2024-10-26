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
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<script src="excel.js" type="text/javascript"></script>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="popup.css"  rel="stylesheet" type="text/css">
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="popup.js" type="text/jscript" language="javascript"> </script>

<script>
//==============/search /=============== 
function searchById(a,b,perpg) {
//alert(a+" "+b+" "+perpg);
var ppg='';
if(perpg=='')
ppg='25';
else
ppg=document.getElementById(perpg).value; //alert(ppg);
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
		 
		  var calltype=document.getElementById('calltype').value;//alert(calltype);	 
		 var tattype=document.getElementById('tattype').value;
			 if(a!="Loading"){
			var calltype=document.getElementById('calltype').value;//alert(calltype);	 
			 var tattype=document.getElementById('tattype').value;
			  }
			
			var url = 'search_ops_ageing.php'; 
	
		    var pmeters="";
			//alert(url);
			
			if(a!="Loading"){ 
  
   pmeters = 'calltype='+calltype+'&Page='+b+'&perpg='+ppg+'&tattype='+tattype;
			//alert(pmeters);
			}
			else
			{
			
				 pmeters='calltype='+calltype+'&perpg='+ppg+'&tattype='+tattype;
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


function newwin(url,winname)
{

  mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=500,height=600,left=420,top=130");
  
 }
</script>


<style>


div#lyrics{
    width:300px;
    height:100px;
    background-color:#003300;
    position:absolute;
    left:700px;
    padding:10px;
	color:#FFF;
    
}
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<script type="text/javascript">
 
$(document).ready(function(){
    $("div#lyrics").hide();
    
    $("#songlist tr").mouseover(function(){
        $(this).css("background-color","#ccc");
        $("#lyrics",this).show();
    }).mouseout(function(){
        $(this).css("background-color","#eee");
        $("#lyrics",this).hide();
    });
    
});
</script>
</head>

<body onLoad="searchById('Loading','1','')"> 

<center>
<?php include("menubar.php");

 ?>


<center>
<h2 class="h2color">Supply Pending Ageing</h2></center>

<div >
<button id="myButtonControlID" onClick="tableToExcel('call_summary1', 'Closed Ops TAT')">Export</button>
	
<table cellpadding="" cellspacing="0" >
  <tr>
  		
    	<th width="77" colspan="">    		    
    			<select name="calltype" id="calltype" onchange="searchById('Listing','1','');">
              <option value="brsummary">Branch Wise Summary</option>
              <option value="clisummary">Client Wise Summary</option>
            </select>
        </th>        	
        <th width="77" colspan="">    		    
    			<select name="tattype" id="tattype" onchange="searchById('Listing','1','');">
              <option value="bill">Billing Pending</option>
              <option value="dely">Delivery Pending</option>
              <option value="inst">Install Pending</option>
            </select>
        </th>
   
     
   <th width="75" rowspan="2"><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>
 
  </tr>
  
</table>
</div>
<div id="search"></div>


</center>
</body>
</html>
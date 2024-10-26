<?php
include("access.php");
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
// print_r($_SESSION['branch']);
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<link href="popup.css"  rel="stylesheet" type="text/css">
<script src="popup.js" type="text/jscript" language="javascript"> </script>

<script>
///////////////////////////////search 
function searchById(a,b) {
//alert(a+" "+b);
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
		  var br=document.getElementById('br').value;
		  //var calltype=document.getElementById('calltype').value;
	 if(a!="Loading"){
			 var id=document.getElementById('atmid').value;//alert(id);
			 var cid=document.getElementById('cid').value;//alert(cid);
			 var bank=document.getElementById('bank').value;//alert(bank);
			 
			 
			 var area=document.getElementById('area').value;//alert(area);
			 
			  }
			var url = 'search_transfer.php'; 
		    var pmeters="";
			if(a!="Loading"){ 
			 pmeters = 'atmid='+id+'&cid='+cid+'&area='+area+'&bank='+bank+'&br='+br+'&Page='+b;
			// alert(pmeters);
			}
			else
			{
				 pmeters = 'br='+br+"&Page="+b;
			}
			//alert("gg");
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

function approve(id,cmnt,status,done) {
//alert(a+" "+b);
//document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";
var conf = confirm("Are you sure you want to "+status+" this call?");
if(conf == true)
{
				//alert(id+" "+cmnt+" "+status);
 				var transid=document.getElementById(id).value;//alert(id);
			 	var tocmnt=document.getElementById(cmnt).value;//alert(cid);
			 //var stat=document.getElementById(status).value;//alert(bank);
			
			var url = 'approvetransfer.php'; 
		    var pmeters="";
			//alert("id="+transid+"&cmnt="+tocmnt+"&status="+status);
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
		 
				pmeters = 'id='+transid+'&cmnt='+tocmnt+'&status='+status;
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
if(response=='1')
{
document.getElementById(done).innerHTML='Done'
}
else
alert(status+"ing failed");
				  //document.getElementById("search").innerHTML = response;
			  }
		}
		}//end conformation if
		
  }
function showtext(id,div)
{
//alert(id+" "+div)
if(document.getElementById(id).checked==true)
document.getElementById(div).style.display='block';
else if(document.getElementById(id).checked==false)
document.getElementById(div).style.display='none';
}
</script>
</head>

<body onLoad="searchById('Loading','1')">
<?php $br= $_SESSION['branch'];// if($_SESSION['branch']!='all') { $br=implode(",",$_SESSION['branch']); } else{ $br=$_SESSION['branch'];  } ?>
<input type="hidden" value="<?php  echo $br;?>" name="br" id="br"/>
<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
 ?>



<h2 class="h2color">View Alerts</h2>

<div >

<table cellpadding="0" cellspacing="0" border="1" >
  <tr>
   <!-- <th width="77" colspan="5"><select name="calltype" id="calltype" onchange="searchById('Listing','1');">
      <option value="open">Open call</option>
      <option value="Done">Closed call</option>
      <option value="">All Calls</option>
    </select></th>-->
    <th width="77"><input type="text" name="cid" id="cid" onkeyup="" placeholder="Name"/></th>
    <th width="75"><input type="text" name="atmid" id="atmid" onkeyup="" placeholder="ATM"/></th>
    <th width="75"><input type="text" name="bank" id="bank" onkeyup="" placeholder="Bank"/></th>
    <th width="75"><input type="text" name="area" id="area" onkeyup="" placeholder="Address"/></th>
   <th><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>
   <!-- <th width="75"><input type="button" onclick="javascript:location.href='date_search.php?br=<?php echo $br; ?>'" class="readbutton" value="Search By Date" style="width:120px;"/></th>-->
  
  </tr>
  <tr>
    
  </tr>
</table>
</div>


<div id="search" ></div>


</center>
</body>
</html>
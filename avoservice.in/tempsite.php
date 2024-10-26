<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>

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
function confirm_delete(id)
{
	if (confirm("Are you sure you want to delete this entry?"))
	{
		document.location="delete_site.php?id="+id;
	}
	
}


///////////////////////////////search 
function searchById(a,b) {
//alert(a);
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
		 
			//var type=document.getElementById('type').value;
			 if(a!="Loading"){
			 var id=document.getElementById('id').value;//alert(id);
			 var cid=document.getElementById('cid').value;//alert(cid);
			 var bank=document.getElementById('bank').value;//alert(bank);
			 var city=document.getElementById('city').value;//alert(city);
			 var area=document.getElementById('area').value;//alert(area);
			 var state=document.getElementById('state').value;//alert(state);
			 var pin=document.getElementById('pin').value;//alert(pin);
			 //var sdate=document.getElementById('sdate').value;//alert(sdate);
			 //var edate=document.getElementById('edate').value;//alert(edate);
			  }
			////alert(document.getElementById('type').value);
			
			var url='tempsitesearch.php'
		
 	//alert(url);
		var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'id='+id+'&cid='+cid+'&city='+city+'&state='+state+'&area='+area+'&pin='+pin+'&area='+area+'&bank='+bank+'&Page='+b;
			}//alert("gg");
			else
			{
			pmeters = 'Page='+b;	
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
 /*
			if(HttPRequest.readyState == 3)  // Loading Request
				  {
	document.getElementById("listingAJAX").innerHTML = '<img src="loader.gif" align="center" />';
				  }
 */
				 if(HttPRequest.readyState == 4) // Return Request
				  {
		var response = HttPRequest.responseText;
 
// alert(response);
				  document.getElementById("search").innerHTML = response;
			  }
		}
  }
 //==========convert into AMC ================= 
 function convert(id,td,service,dt){
 //alert("GGG");
//alert(val+" "+attr+" "+chk);
//alert(service);
if(document.getElementById(service).value=='')
{
alert("Select preventive Maintenance");
document.getElementById(id).checked=false;
document.getElementById(service).focus();
}
else
{
var dt=document.getElementById(dt).value;
var value=document.getElementById(id).value;
var ser=document.getElementById(service).value;
//alert(value);

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
		 document.getElementById(td).innerHTML="<img src='images/right.png' />";
		else
    	document.getElementById(td).innerHTML="failed";
    }
  }
 //alert("garmentgallery.php?cid="+id);
// alert("getcustdetail.php?id="+value+"&attr="+attr);
 
xmlhttp.open("get","con2amc.php?id="+value+"&service="+ser+"&dt="+dt,false);

//alert("getpage.php?page="+page);
//xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send();
}
}

//========
function newwin(url,winname,w,h){
	//alert("hi");
		var left = (screen.width/2)-(w/2);
		var top = (screen.height/2)-(h/2);
		var targetWin = window.open (url, winname, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=1, resizable=yes, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
 }
</script>
</head>

<body onLoad="searchById('Loading','1')">
<center>
<?php include("menubar.php"); ?>

<h2 class="h2color">Temporary Sites</h2>

<div class="">
<table  border="0" cellpadding="0" cellspacing="0">
<tr>

</tr>
<tr>

<th width="77"><input type="text" size="15" name="cid" id="cid" onkeypress="return runScript(event)"   placeholder="Customer"/></th>
<th width="145"><input type="text" size="15" name="bank" id="bank" onkeypress="return runScript(event)" placeholder="Bank"/></th>

<th width="75"><input type="text" size="15" name="city" id="city" onkeypress="return runScript(event)" placeholder="City"/></th>
<th width="75"><!--<input type="text" size="15" name="state" id="state" onkeyup="searchById('Listing','1');" placeholder="State"/>-->
<select name="state" id="state" onchange="searchById('Listing','1');" >
<option value="">state</option>
<?php
$st=mysqli_query($con1,"select * from state order by state ASC");
while($stro=mysqli_fetch_array($st))
{
?>
<option value="<?php echo $stro[1]; ?>"><?php echo $stro[1]; ?></option>
<?php
}
?>
</select>


</th>
<th width="75"><input type="text" size="15" name="pin" id="pin" onkeypress="return runScript(event)" placeholder="Pincode"/></th>
<th width="75"><input type="text" size="15" name="area" id="area" onkeypress="return runScript(event)" placeholder="Address"/></th>
<th width="75"><input type="text" size="15" name="id" id="id" onkeypress="return runScript(event)" placeholder="ATM"/><br /></th>


<!--<td width="75"><input type="text" name="sdate" id="sdate"  onkeyup="searchById('Listing','1');" placeholder="From Date"/></td>
<td width="75"><input type="text" name="edate" id="edate"  onkeyup="searchById('Listing','1');" placeholder="To Date"/></td>-->
</tr>
</table>
</div>




<div id="search"></div>

</center>
</body>
</html>
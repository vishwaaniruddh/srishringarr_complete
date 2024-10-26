<?php
include("access.php");
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



<script>
function newwin(url,winname)
{

  mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=500,height=400,left=350,top=200");
  
 }
///////////////////////////////search 
function searchById(a,b,perpg) {
//alert("hi");
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
		   var calltype=document.getElementById('calltype').value;
		   // var sitetype=document.getElementById('sitetype').value;
		//alert(calltype);
			 if(a!="Loading"){
			 var id=document.getElementById('id').value;//alert(id);
			  var docket=document.getElementById('docket').value;//alert(cid);
			 var cid=document.getElementById('cid').value;//alert(cid);
			 var bank=document.getElementById('bank').value;//alert(bank);
			 var city=document.getElementById('city').value;//alert(id);
			var st=document.getElementById('state').value;//alert(id);
			 var fromdt=document.getElementById('fromdt').value;
			 var todt=document.getElementById('todt').value; 
 var complaintno=document.getElementById('complaintno').value; 
			  }
			//alert("gg"); 
			var url = 'searchdeltime.php'; 
		//  }
 	
		    //var pmeters="";
		
			if(a!="Loading"){ 
			 pmeters = 'atmid='+id+'&cid='+cid+'&bank='+bank+'&city='+city+'&Page='+b+"&calltype="+calltype+"&docket="+docket+'&fromdt='+fromdt+'&todt='+todt+'&perpg='+ppg+"&st="+st+'&complaintno='+complaintno;
			}//alert("gg");
			else
			{
				 pmeters = "Page="+b+"&calltype="+calltype+'&perpg='+ppg;
			}
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
 //alert(pmeters);
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

<body onLoad="searchById('Loading','1','');">
<center>
<?php include("menubar.php"); ?>

<h2 class="h2color">Delegate Report</h2>

<div>
<table cellpadding="" cellspacing="" width="100%" >
<tr>
<th><select name="calltype" id="calltype" onchange="searchById('Listing','1','');">
<option value="">All Calls</option>
<option value="service">Service Call</option>
<option value="inst">Installation call</option>
<option value="pm">PM Call</option>
<option value="dere">De-Re Call</option>

</select></th>

<th><select name="cid" id="cid" onchange="searchById('Listing','1','');" width='100px'><option value="">Select Client</option><?php
include('config.php');
$cl=mysqli_query($con1,"select cust_id,cust_name from customer order by cust_name ASC");
while($clro=mysqli_fetch_row($cl))
{
?>
<option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>
<?php
}
?></select></th>
<th><input type="text" name="docket" id="docket" onkeypress="return runScript(event)" placeholder="Client Docket Number"/></th>
<th ><select name="state" id="state" onchange="searchById('Listing','1','');" ><option value="">Branch</option>
<?php
$st=mysqli_query($con1,"select * from avo_branch order by name ASC");
while($stro=mysqli_fetch_array($st))
{
?>
<option value="<?php echo $stro[0]; ?>"><?php echo $stro[1]; ?></option>
<?php
}
?></select>
</th>
<th ><input type="text" name="complaintno" id="complaintno" onkeypress="return runScript(event)" placeholder="ComplaintNo"/></th> </tr>

<tr>
<th ><input type="text" name="id" id="id" onkeypress="return runScript(event)" placeholder="ATM"/></th>
<th ><input type="text" name="bank" id="bank" onkeypress="return runScript(event)" placeholder="Bank"/></th>
<th ><input type="text" name="city" id="city" onkeypress="return runScript(event)" placeholder="Address"/></th>
<!--<th width="75"><input type="button" onclick="javascript:location.href='date_search1.php'" class="readbutton" value="Search" style="width:120px;"/></th>-->
<th><input type="text" name="fromdt" id="fromdt" onkeypress="return runScript(event)" readonly="readonly" onclick="displayDatePicker('fromdt');" placeholder="From Date"/></th>
<th><input type="text" name="todt" id="todt" onkeypress="return runScript(event)" readonly="readonly" onclick="displayDatePicker('todt');" placeholder="To Date"/></th>
<th><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>
  
</tr>
<tr>


</tr>
</table>
</div>

<div id="search"></div>


</center>
</body>
</html>


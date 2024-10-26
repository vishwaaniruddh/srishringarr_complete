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
////////////////////////////////
function newwin(url,winname)
{

  mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=500,height=400,left=350,top=200");
  
 }
//======================search ===============
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
		   var openall=document.getElementById('openall').value;
		    var sitetype=document.getElementById('sitetype').value;
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
				var noupdate=document.getElementById('noupdate').value; 
				var branch=document.getElementById('branch').value;
			  }
			//alert("gg"); 
			var url = 'search_callalert.php'; 
		//  }
 	
		    //var pmeters="";
		
			if(a!="Loading"){ 
			 pmeters = 'atmid='+id+'&cid='+cid+'&bank='+bank+'&state='+city+'&Page='+b+"&calltype="+calltype+"&openall="+openall+"&docket="+docket+'&fromdt='+fromdt+'&todt='+todt+'&perpg='+ppg+"&st="+st+"&sitetp="+sitetype+'&complaintno='+complaintno+'&noupdate='+noupdate+'&branch='+branch;
			}//alert("gg");
			else
			{
				 pmeters = "Page="+b+"&calltype="+calltype+'&perpg='+ppg+"&sitetp="+sitetype;
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
//=====================convert warranty to pcb
function confirm_delete(id){

	//alert("id="+id);
if(confirm("Are you sure you want to convert this call ?"))
  {
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
	 res=xmlhttp.responseText;
        //document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
       	if(res==1){
	alert("You converted successfully");
	}else{
	
	alert("Please try again...");
	}
    }
  }
  //alert("convet_pcb.php?id="+id);
xmlhttp.open("GET","convet_pcb.php?id="+id,true);
xmlhttp.send();
    
  }
}

//===========Reopen Call============

function reopen_fun(Reopen_call){

if(confirm("Are you sure you want to Reopen this call ?"))
  {
    
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
//	 alert(xmlhttp.responseText);	
	 res=xmlhttp.responseText;
	 
	// alert(res);
        
       	if(res=="1"){
	alert("Call is Reopen successfull");
	}else{
	
	alert("Please try again...");
	}
    }
  }
  xmlhttp.open("GET","Reopen_call.php?id="+Reopen_call,true);
xmlhttp.send();
    
  }
}


</script>
</head>

<body onLoad="searchById('Loading','1','');">

<center>
<?php include("menubar.php"); ?>

<h2 class="h2color">View Alerts</h2>

<div>
<table cellpadding="" cellspacing="" >
<tr>
<th width="77" colspan="">
<select name="calltype" id="calltype"  onchange="searchById('Listing','1','');">
<option value="open">Open call</option>
<option value="Done">Closed call</option>
<option value="onhold">Call On Hold</option>
      <option value="Rejected">Rejected</option>
<option value="">All Calls</option>
</select></th>

<th width="77" colspan="">
<select name="openall" id="openall"  onchange="searchById('Listing','1','');">
<option value="all">All</option>
<option value="install">New Installation</option>
<option value="service">Service</option>
<option value="pm">PM Calls</option>
<option value="wtpcb">W2PCB</option>
<option value="dere">DeRe</option>
</select></th>

<th width="77" colspan=""><select name="sitetype" id="sitetype" onchange="searchById('Listing','1','');">
<option value="new">Site</option>
<option value="new temp">Temporary Site</option>
<!--<option value="">All Calls</option>-->
</select></th>
<th><select name="cid" id="cid"  onchange="searchById('Listing','1','');" width='100px'><option value="">Select Client</option><?php
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
<th width="77">
<select name="state" id="state" onchange="searchById('Listing','1','');" ><option value="">state</option>
<?php
$st=mysqli_query($con1,"select * from state where 1 order by state ASC");
while($stro=mysqli_fetch_array($st))
{
?>
<option value="<?php echo $stro[1]; ?>"><?php echo $stro[1]; ?></option>
<?php
}
?></select>
</th>
<th width="75"><input type="text" name="complaintno" id="complaintno" onkeypress="return runScript(event)" placeholder="ComplaintNo"/></th>

</tr><tr>
<th width="75"><input type="text" name="id" id="id" onkeypress="return runScript(event)" placeholder="ATM"/></th>
<th width="75"><input type="text" name="bank" id="bank" onkeyup="" placeholder="Bank" onkeypress="return runScript(event)"/></th>
<th width="75"><input type="text" name="city" id="city" onkeypress="return runScript(event)" placeholder="Address"/></th>
<!--<th width="75"><input type="button" onclick="javascript:location.href='date_search1.php'" class="readbutton" value="Search" style="width:120px;"/></th>-->
  <th width="75"><input type="text" name="fromdt" id="fromdt" readonly="readonly" onkeypress="return runScript(event)" onclick="displayDatePicker('fromdt');" placeholder="From Date"/></th>
 <th width="75"><input type="text" name="todt" id="todt"  readonly="readonly" onclick="displayDatePicker('todt');" onkeypress="return runScript(event)" placeholder="To Date"/></th>
  
  <th width="77" colspan="">
<select name="noupdate" id="noupdate"  onchange="searchById('Listing','1','');">
<option value="all">All</option>
<option value="noup">No Update</option>

</select></th>

<th width="77">
<?php 
		$selbr="select * from avo_branch where 1";
		if($_SESSION['branch']!='all')
		$selbr.=" and id = '".$_SESSION['branch']."' ";
		
	 	$selbr.=" order by id ASC";
		//echo $selbr;
		$selbr2=mysqli_query($con1,$selbr)
		?>
        <select name="branch" id="branch" >
        
		<?php if($_SESSION['branch']=='all'){?>
        <option value="">Branch</option>
        <?php }?>
        
		<?php
        
        while($branch1=mysqli_fetch_array($selbr2))
        {
        ?>
        <option value="<?php echo $branch1[0]; ?>"><?php echo $branch1[1]; ?></option>
        <?php
        }
        ?>
        </select>

</th>


 <th width="75"> <input type="button" id="button" onclick="searchById('Listing','1','');"  value="Search" /></th>
  
</tr>
<tr>


</tr>
</table>
</div>

<div id="search"></div>


</center>
</body>
</html>
<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
// print_r($_SESSION['branch']);
echo $brme=$_SESSION['branch'];
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="600" >
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
		  var br=document.getElementById('br').value;
		  var calltype=document.getElementById('calltype').value;
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
			 var id=document.getElementById('atmid').value;//alert(id);
			 var cid=document.getElementById('cid').value;//alert(cid);
			 var bank=document.getElementById('bank').value;//alert(bank);
			  var docket=document.getElementById('docket').value;//alert(cid);
			 var fromdt=document.getElementById('fromdt').value;
			 var todt=document.getElementById('todt').value;
			 var area=document.getElementById('area').value;//alert(area);
			 var eng=document.getElementById('eng').value;
			  var sitetp=document.getElementById('sitetp').value;
			  var state=document.getElementById('state').value;
                            var complaintno=document.getElementById('complaintno').value;
			  }
			 // alert(br);
			//alert("gg"); 
			var url = 'search_pmalert.php'; 
		//  }
 	//alert(br);
		    var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'atmid='+id+'&cid='+cid+'&area='+area+'&bank='+bank+'&br='+br+'&Page='+b+"&calltype="+calltype+'&perpg='+ppg+"&docket="+docket+'&fromdt='+fromdt+'&todt='+todt+'&eng='+eng+'&sitetp='+sitetp+'&state='+state+'&complaintno='+complaintno;
			// alert(pmeters);
			}
			else
			{
				 pmeters = 'br='+br+"&Page="+b+"&calltype="+calltype+'&perpg='+ppg;
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
<?php $br= $_SESSION['branch'];// if($_SESSION['branch']!='all') { $br=implode(",",$_SESSION['branch']); } else{ $br=$_SESSION['branch'];  } ?>
<input type="hidden" value="<?php  echo $br;?>" name="br" id="br"/>
<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
 ?>



<h2 class="h2color">P.M. Alerts</h2>

<div >
 <button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
	<br />
<table cellpadding="" cellspacing="0" >
  <tr>
    <th width="77" colspan=""><select name="calltype" id="calltype" onchange="searchById('Listing','1','');">
      <option value="open">Open call</option>
      <option value="Done">Closed call</option>
      <option value="onhold">Call On Hold</option>
      <option value="Rejected">Rejected</option>
      <option value="">All Calls</option>
    </select></th>
    <th><select name="cid" id="cid" onchange="searchById('Listing','1','');" ><option value="">Select Client</option><?php
$cl=mysqli_query($con1,"select cust_id,cust_name from customer order by cust_name ASC");
while($clro=mysqli_fetch_row($cl))
{
?>
<option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>
<?php
}
?></select></th>
    <th><input type="text" name="docket" id="docket" onkeypress="return runScript(event)" placeholder="Client Docket Number"/></th>
    <!--<th width="77"><input type="text" name="cid" id="cid" onkeyup="" placeholder="Name"/></th>-->
    <th width="75"><input type="text" name="atmid" id="atmid" onkeypress="return runScript(event)" placeholder="ATM"/></th>
    <th width="75"><input type="text" name="bank" id="bank" onkeypress="return runScript(event)" placeholder="Bank"/></th>
    <th width="75"><input type="text" name="area" id="area" onkeypress="return runScript(event)" placeholder="Address"/></th>
    <th width="75" rowspan="2"><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>
    </tr>
    
    <br />
    
    <tr>
     <th width="75"><!--<input type="text" name="state" id="state" onkeyup="" placeholder="State"/>-->
     <?php
	 
$br=$_SESSION['branch'];
if($br!='all' && $br!='0')
{
$br1=str_replace(",","','",$br);//echo $br1[0]."/".$br1[1];
$br1="'".$br1."'";
//echo $br1;
//echo "select state from state where state_id in (".$br1.")";
//echo "select state from state where state_id in (".$br1.")";
$src=mysqli_query($con1,"select state from state where branch_id in (".$br1.")");
while($srcrow=mysqli_fetch_array($src))
{
	$bran[]=$srcrow[0];
}
$br3=implode(",",$bran);
$br2=str_replace(",","','",$br3);//echo $br1[0]."/".$br1[1];
$br2="'".$br2."'";
}
$stqry="select state from state where 1";
if($_SESSION['branch']!='all')
$stqry.=" and state in ($br2)";
//echo $stqry;
?>
<select name="state" id="state" onchange="searchById('Listing','1','');" style="width:150px"><option value="">-select State-</option>
<?php

$stateqry=mysqli_query($con1,$stqry);
while($sttro=mysqli_fetch_array($stateqry))
{
	?>
    <option value="<?php echo $sttro[0]; ?>"><?php echo $sttro[0]; ?></option>
    <?php
}
?>
     </select>
     
     
     </th>
<th width="75"><input type="text" name="complaintno" id="complaintno" onkeypress="return runScript(event)" placeholder="ComplaintNo"/></th>
     <th>
     <?php  $engq="select * from area_engg where status='1'";
	 if($_SESSION['branch']!='all')
	 $engq.=" and area in ($brme)";
	// echo $engq;
	 $engq.=" order by engg_name ASC";
	 ?>
     <select name="eng" id="eng" onchange="searchById('Listing','1','');" style="width:150px"><option value="">-select Engineer-</option><?php 
	
	$eng=mysqli_query($con1,$engq);
	while($engg=mysqli_fetch_array($eng))
	{
	?>
    <option value="<?php echo $engg[0]; ?>"><?php echo $engg[1]; ?></option>
    <?php
	}
	
	 ?>
	 <option value="-1">Pending Delegation</option>
	 </select></th>
     <th width="77" colspan=""><select name="sitetp" id="sitetp" onchange="searchById('Listing','1','');" style="width:100px">
     <option value="">-select-</option>
      <option value="service">Service Site</option>
      <option value="new temp">Temporary Site</option>
      <option value="new">New Site</option>
      
    </select></th>
     <th width="75"><input type="text" name="fromdt" id="fromdt" onkeypress="return runScript(event)" readonly="readonly" onclick="displayDatePicker('fromdt');" placeholder="From Date"/></th>
     <th width="75"><input type="text" name="todt" id="todt" onkeypress="return runScript(event)"  readonly="readonly" onclick="displayDatePicker('todt');" placeholder="To Date"/></th>
     
  
    <!--<th width="75"><input type="button" onclick="javascript:location.href='date_search.php?br=<?php echo $br; ?>'" class="readbutton" value="Search By Date" style="width:120px;"/></th>-->
  
  </tr>
  
</table>
</div>
<div id="search"></div>


</center>
</body>
</html>
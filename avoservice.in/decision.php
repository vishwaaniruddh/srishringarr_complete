<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
// print_r($_SESSION['branch']);
$alertid=$_GET['alertid'];
$questate=$_GET['state']; //questing time sending state to delegate.php by hidden
include('config.php');
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
function searchById(a,b,id) {
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
		 
			//alert(document.getElementById("calltype").value);
			var calltype=document.getElementById("calltype").value; 
			var url = 'brquest.php'; 
		//  }
 	//alert(br);
		    var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'Page='+b+"&calltype="+calltype+"&aid="+id;
			// alert(pmeters);
			}
			else
			{
			//alert("hi");
			
			//alert(calltype);
				 pmeters = 'br='+br+"&Page="+b+"&calltype="+calltype+"&aid="+id;
				// alert(pmeters);
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


function newwin(url,winname)
{

  mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=500,height=400,left=350,top=200");
  
 }
 
 //==============validation 
 
 function validate(frm){
 with(frm)
 	{
	if(( frm.status[1].checked ) || ( frm.status[2].checked)){	
	   if(cmnt.value=="")/*Name validation*/
	   {	
	   		alert("Please Enter Some Update");
			cmnt.focus();
			return false;
		}
	}
		 return true;
 	}
 }
</script>
</head>

<body onLoad="searchById('Loading','1','<?php echo $alertid; ?>')">
<?php $br= $_SESSION['branch'];// if($_SESSION['branch']!='all') { $br=implode(",",$_SESSION['branch']); } else{ $br=$_SESSION['branch'];  } ?>
<input type="hidden" value="<?php  echo $br;?>" name="br" id="br"/>
<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
 ?>



<h2 class="h2color">
  <input type="hidden" name="alertid" id="alertid" value="<?php echo $alertid; ?>" />
  Questioner</h2>

<div >

<table cellpadding="" cellspacing="0" >
<?php
$alert=mysqli_query($con1,"select a.createdby,a.cust_id,a.atm_id,a.bank_name,a.address,a.state1,a.problem,a.entry_date,a.alert_type,a.assetstatus,c.cust_name from alert a,customer c where a.alert_id='".$alertid."' and a.cust_id=c.cust_id");
$alertro=mysqli_fetch_row($alert);
if($alertro[8]=='service' &&  $alertro[9] ==  'amc')
    $atm=mysqli_query($con1,"select atmid from Amc where amcid='".$alertro[2]."'");
	if($alertro[8]=='service' &&  $alertro[9] == 'site')
	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$alertro[2]."'");
	
	$atmro=mysqli_fetch_row($atm);
?>
<tr><th>Client</th><td><?php echo $alertro[10]; ?></td><th>Atm ID</th><td><?php echo $atmro[0]; ?></td></tr>
<tr><th>Docket No.</th><td><?php echo $alertro[0]; ?></td><th>Bank</th><td><?php echo $alertro[3]; ?></td></tr>
<tr><th valign="top">Address</th><td valign="top"><?php echo nl2br($alertro[4]); ?></td><th valign="top">Problem</td><td valign="top"><?php echo nl2br($alertro[6]); ?></td></tr>
  <tr>
  <th>Call type</th>
    <th width="77" colspan="" align="center"><select name="calltype" id="calltype" onchange="searchById('Listing','1','<?php echo $alertid; ?>','<?php echo $questate; ?>');">
    <option value="">--Select Call Type--</option>
    <?php
	$qry=mysqli_query($con1,"select * from questtype");
	while($quest=mysqli_fetch_array($qry))
	{
	?>
    <option value="<?php echo $quest[0]; ?>"><?php echo $quest[1]." ".$quest[0]; ?></option>
    <?php
	}
	?>
      
    </select></th>
    <th>Call Logged On</th><td><?php echo date('d/m/Y h:i:s a',strtotime($alertro[7])); ?></td>
    
  </tr>
  <tr>
    
  </tr>
</table>

</div>
<input type="hidden" name="aid" value="<?php echo $alertid; ?>" />
<input type="hidden" name="state" value="<?php echo $questate; ?>" />
<div id="search">
<form name="frm" method="post" action="">
  <div id="questions"></div>
</form>
</div>


</center>
</body>
</html>
<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
// print_r($_SESSION['branch']);
$alertid=$_GET['alertid'];
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
			var url = 'brquestlocal.php'; 
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
$alert=mysqli_query($con1,"select a.createdby,a.cust_id,a.atm_id,a.bank_name,a.address,a.state1,a.problem,a.entry_date,a.alert_type,a.assetstatus,a.caller_phone from alertlocal a where a.alert_id='".$alertid."'");
$alertro=mysqli_fetch_row($alert);
//echo "select * from local_site where track_id='".$alertro[1]."'";
$local_site_qry=mysqli_query($con1,"select * from local_site where track_id='".$alertro[1]."'");
$local_site=mysqli_fetch_array($local_site_qry);
?>
<tr><th>Client</th><td><?php echo $local_site['cust_id']; ?></td><th>CIN</th><td><?php echo $alertro[2]; ?></td></tr>
<tr><th>Docket No.</th><td><?php echo $alertro[0]; ?></td><th>Customer/Caller Number : </th><td><?php echo $local_site['cphone']." / ".$alertro[10]; ?></td></tr>
<tr><th valign="top">Address</th><td valign="top"><?php echo nl2br($alertro[4]); ?></td><th valign="top">Problem</td><td valign="top"><?php echo nl2br($alertro[6]); ?></td></tr>
  <tr>
  <th>Call type</th>
    <th width="77" colspan="" align="center"><select name="calltype" id="calltype" onchange="searchById('Listing','1','<?php echo $alertid; ?>');">
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
<div id="search">
<form name="frm" method="post" action="">
  <div id="questions"></div>
</form>
</div>


</center>
</body>
</html>
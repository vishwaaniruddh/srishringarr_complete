<?php
include("access.php");
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CC Mail IDs</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script src="popup.js" type="text/jscript" language="javascript"> </script>



<script type="text/javascript">

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
		
					 if(a!="Loading"){
			 
			 customer=document.getElementById('customer').value; //alert(customer);
			
			var url = 'searchccmail.php'; 
	
		    var pmeters="";
			
			if(a!="Loading"){
			//alert(url);
			 pmeters = 'Page='+b+'&perpg='+ppg+'&customer='+customer;
			 
			 
			// alert(pmeters);
			}
			else
			{
				 pmeters = "Page="+b+'&perpg='+ppg;
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


	
}
</script>
<script>


function HandleResponse3(response)

{

  document.getElementById('res').innerHTML = response;

}
</script>
</head>

<!--<body onLoad="searchById('Loading','1','')"> -->

<body>
<center>
<?php include("menubar.php"); ?>

<h2>CC E-mails Setting</h2>
<div id="header">
<button id="myButtonControlID" onClick="javascript:window.location='addem.php'">Add E-Mails(After End user / Bank Created)</button>
<button id="myButton" onClick="javascript:window.location='add_avobank.php'">Add End User / Bank, if New</button>
<button id="myButton" onClick="javascript:window.location='view_avobank.php'">View End User/ Bank</button>
<!--<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>-->

	<table>
   
   <?php
    include("../config.php");
   
   
    $client="select cust_id,cust_name from customer where 1";
    
    
    if($_SESSION['designation']==5){
    //echo "select client from clienthandle where logid='".$_SESSION['logid']."'";
    $cust=mysqli_query($con1,"select client from clienthandle where logid= (select srno from login where username='".$_SESSION['user']."')");
    $cc=array();
    while($custr=mysqli_fetch_array($cust))
    $cc[]=$custr[0];
    
    $ccl=implode(",",$cc);
    $ccl=str_replace(",","','",$ccl);
    $ccl="'".$ccl."'";
    $client.=" and cust_name in($ccl)";
    
    }
    $client.=" order by cust_name ASC"; 
    
    //echo $client;
    ?>
   <th>
    <select name="customer" id="customer" onchange="searchById('Listing','1','');"> <?php if($_SESSION['designation']!=5){ ?><option value="">Select Client</option><?php }
$cl=mysqli_query($con1,$client);


while($clro=mysqli_fetch_row($cl))
{
?>
<option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>
<?php
}
?></select></th>
   
   
   
   
   
   
   
   
   
   
    
   <!-- <th width="75">
    <select name="customer" id="customer">
    <option value="">Select Customer</option>
    <?php 
	$bank_cust=mysqli_query($con1,"select * from `customer`");
	while($bank_cust1=mysqli_fetch_row($bank_cust)){
	?>
    <option value="<?php echo $bank_cust1[0]; ?>"><?php echo $bank_cust1[1]; ?></option>
    <?php }?>
    </select>
    </th> -->
    
    
	<th><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>
   	</table>


</div>
<div id="search"></div>
</center>
</body>
</html>
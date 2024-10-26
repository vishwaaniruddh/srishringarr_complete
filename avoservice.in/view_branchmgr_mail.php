<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Branch-emal-IDs</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script src="popup.js" type="text/jscript" language="javascript"> </script>
<script type="text/javascript">
function deactivate(id1)
{
	//alert(id1);
	if (confirm("Are you sure you want to deactivate this entry from android?"))
	{
		document.location="deactivateme_engg.php?id1="+id1;
	}
	
}
</script>
<script type="text/javascript">
function reactivate(id2)
{
	//alert(id1);
	if (confirm("Are you sure you want to reactivate this entry for android?"))
	{
		document.location="reactivateme_engg.php?id2="+id2;
	}
	
}
</script>
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
		
		//var name=""
		//var email=""
		//var con="";
			 // var id=document.getElementById('idd').value;//alert(id);
			 if(a!="Loading"){
			 //name=document.getElementById('name').value; //alert(name);
			 branch=document.getElementById('branch').value; //alert(customer);
			 //con=document.getElementById('number').value;alert(con);
			  //var state=document.getElementById('state').value;//alert(cid);
			  }
			
			var url = 'search_branch_email.php'; 
	
		    var pmeters="";
			
			if(a!="Loading"){
			//alert(url);
			 pmeters = 'Page='+b+'&perpg='+ppg+'&branch='+branch;
			 //alert(pmeters);
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

function confirm_delete(id)
{
	if (confirm("Are you sure you want to delete this entry?"))
	{
		document.location="delete_engg.php?id="+id;
	}
	
}
</script>
<script>
/////for city
function getXMLHttp()

{

  var xmlHttp

 //alert("hi1");

  try

  {

    //Firefox, Opera 8.0+, Safari
 xmlHttp = new XMLHttpRequest();
  }

  catch(e)
  {
    //Internet Explorer
    try
    {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
   catch(e)
    {
      try
      {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e)
      {
        alert("Your browser does not support AJAX!")
       return false;
      }
   }
 }
  return xmlHttp;
}
function Approve(id)

{ 
//alert(id);
  var xmlHttp = getXMLHttp();
 

  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
if((xmlHttp.responseText)==0)
document.getElementById('app'+id).innerHTML="Done";
else
{
}
    //  HandleResponse3(xmlHttp.responseText);
    }
  }

 
  xmlHttp.open("GET", "appeng.php?id="+id, true);
//alert("appeng.php?id="+id);
  xmlHttp.send();

}

function HandleResponse3(response)

{

  document.getElementById('res').innerHTML = response;

}
</script>
</head>

<body onLoad="searchById('Loading','1','')">
<center>
<?php include("menubar.php"); ?>

<h2>Branch Manager E-mails</h2>
<div id="header">
<button id="myButtonControlID" onClick="javascript:window.location='add_br_email.php'">ADD NEW</button>
<!--<button id="myButton" onClick="javascript:window.location='add_avobank.php'">ADD Bank</button>
<button id="myButton" onClick="javascript:window.location='view_avobank.php'">View Bank</button>-->
<!--<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>-->

	<table>
   <!-- <th width="77">
    <select name="name" id="name">
    <option value="">Select Bank</option>
    <?php 
	$bank=mysqli_query($con1,"select * from avo_bank");
	while($bank1=mysqli_fetch_row($bank)){
	?>
    <option value="<?php echo $bank1[0]; ?>"><?php echo $bank1[1]; ?></option>
    <?php }?>
    </select>
    </th> -->
    
    <th width="75">
    <select name="branch" id="branch">
    <option value="">Select Branch</option>
    <?php 
	$avo_br=mysqli_query($con1,"select * from `avo_branch`");
	while($avo_br1=mysqli_fetch_row($avo_br)){
	?>
    <option value="<?php echo $avo_br1[0]; ?>"><?php echo $avo_br1[1]; ?></option>
    <?php }?>
    </select>
    </th>
    
    
	<th><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>
   	</table>


</div>
<div id="search"></div>
</center>
</body>
</html>
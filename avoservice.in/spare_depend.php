<?php
include("access.php");
 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Attended Calls</title>
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
		
		
			 // var id=document.getElementById('idd').value;//alert(id);
			 if(a!="Loading"){
			
			 
	//	var prob=document.getElementById('prob').value;//alert(prob);	 
		var branch=document.getElementById('branch').value;// alert(branch);
		var cust=document.getElementById('cust').value;//alert(cust);
		var type=document.getElementById('type').value;//alert(type);
			 
			  }
			
		var url = 'search_spare_depend.php'; 
	
		    var pmeters="";
			
			if(a!="Loading"){ 
			 pmeters = 'Page='+b+'&perpg='+ppg+'&cust='+cust+'&branch='+branch+'&type='+type;
			// alert(pmeters);
			}
			else
			{
				 pmeters = "Page="+b+'&perpg='+ppg;
			}
		//	alert(pmeters);
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

function getXMLHttp()
{ var xmlHttp
  try   {

    //Firefox, Opera 8.0+, Safari
 xmlHttp = new XMLHttpRequest();
  }   catch(e)   {
    //Internet Explorer
    try     {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }    catch(e)    {
      try       {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }       catch(e)      {
        alert("Your browser does not support AJAX!")
       return false;
      }
   }
 }
  return xmlHttp;
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
<?php include("menubar.php"); ?>

<h2>Attended Open / Hold Service Calls</h2>
<div id="header"><button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>


<table>

  
    <th width="75">
        
    <?php $state=mysqli_query($con1,"Select id, name from avo_branch order by name ASC"); ?>
    
    <select name="branch" id="branch" onchange="searchById('Listing','1','');"> <option value="">Select Branch</option>
     
     <?php
	 while($st=mysqli_fetch_array($state))
	 {
	 ?>
     <option value="<?php echo $st[0]; ?>"><?php echo $st[1]; ?></option>
     <?php
	 }
	 ?></select> </th>
	 
<th>Call Type</th>
<th width="77"> <select name="type" id="type">
    
    <option value="">All</option>
    <option value="service">Service Call</option>
    <option value="new">Installation</option>
    <option value="de_re">De-Re Calls</option>
    <option value="pm">PM Calls</option>
    </select></th>

<!--<th>Select Problem</th>
<th width="77"><select name="prob" id="prob">
    
    <option value="">All Attended Open / Hold calls</option>
<?php
//$prob=mysqli_query($con1,"select distinct(prob_group) from problemtype order by prob_group ASC");
while($probro=mysqli_fetch_row($prob))
{
?>
<option value="<?php echo $probro[0];?>" <?php if($_POST['prob']==$probro[0]){echo selected;}?>><?php echo $probro[0]; ?></option>
<?php
}
?></select>
</th> -->

<th><select name="cust" id="cust">
    <option value="">Select Customer</option>
<?php
	$cust_qry=mysqli_query($con1,"select cust_id,cust_name from customer where cust_id in (select distinct(`cust_id`) from alert)");
	while($cust=mysqli_fetch_row($cust_qry))
	{
?>
<option value="<?php echo $cust[0]; ?>" <?php if($_POST['cust']==$cust[0]){echo selected;}?>><?php echo $cust[1]; ?></option>
<?php 	} ?>
</select> </th>
	 
 <th><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>    
    
     
</table>


</div>
<div id="search"></div>
</center>
</body>
</html>


<?php
include("access.php");
 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Engineers</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script src="popup.js" type="text/jscript" language="javascript"> </script>


<script type="text/javascript">

///////////////////////////////search 
function searchById(a,b,perpg) {
//alert(a+" "+b+" "+perpg);

var ppg='';
if(perpg=='')
ppg='30';
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
			 var name=document.getElementById('name').value;//alert(id);
			 var empcode=document.getElementById('empcode').value;//alert(empcode);
			 var con=document.getElementById('number').value;//alert(bank);
			 var branch=document.getElementById('branch').value;//alert(branch);
			 
			  }
			
			var url = 'searchdeleteeng.php'; 
	
		    var pmeters="";
			
			if(a!="Loading"){ 
			 pmeters = 'Page='+b+"&name="+name+'&perpg='+ppg+"&empcode="+empcode+'&number='+con+'&branch='+branch;
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

function confirm_activate(id)
{
	if (confirm("Are you sure!! You want to Activate this Engineer?!!!"))
	{
		document.location="reactivate_engg.php?id="+id;
	}
	
}
</script>
<script>


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
</head>

<body onLoad="searchById('Loading','1','')">
<center>
<?php include("menubar.php"); ?>

<h2>View Area Engineers</h2>
<div id="header"><button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>


<table>



    <th width="77"><input type="text" name="name" id="name" onkeyup="" placeholder="Name"/></th>
    <th width="75"><input type="text" name="empcode" id="empcode" onkeyup="" placeholder="Employee code"/></th>
    <th width="75"><input type="text" name="number" id="number" onkeyup="" placeholder="Number"/></th>

    
    
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
	 ?></select>
     </th>
 <th><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>    
    
</table>


</div>
<div id="search"></div>
</center>
</body>
</html>
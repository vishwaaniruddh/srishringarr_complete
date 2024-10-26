<?php
include("access.php");
 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>start-end time</title>
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
			 var engg_login=document.getElementById('engg_login').value;//alert(id);
			 var from=document.getElementById('from').value;//alert(empcode);
			 var to=document.getElementById('to').value;//alert(bank);
			
			 
			  }
			
			var url = 'search_engg_start_end.php'; 
	
		    var pmeters="";
			
			if(a!="Loading"){ 
			 pmeters = 'Page='+b+"&engg_login="+engg_login+'&perpg='+ppg+"&from="+from+'&to='+to;
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

</script>


</head>

<body onLoad="searchById('Loading','1','')">
<center>
<?php include("menubar.php"); ?>

<h2>Start-End time</h2>
<div id="header">


<table>

<tr >
 				<th>Engineer Name:</th>
				<th>from date:</th>
                <th>To date:</th>
                  <th>Search</th>
 				</tr>

<? $user=$_SESSION['user']; ?>

<tr>

<?  
if($_SESSION['designation']=='4') {
$logqry=mysqli_query($con1,"select srno from login where username='".$user."'");
$eng=mysqli_fetch_row($logqry);

$sql.= "select loginid, engg_name from area_engg where loginid='".$eng[0]."' and status='1' ";
$result = mysqli_query($con1,$sql);
//echo $sql;
?>

<td>
 <select name="engg_login" id="engg_login" >
<?
while ($engr=mysqli_fetch_row($result)){
?>
    <option value="<?php echo $engr[0]; ?>"><?php echo $engr[1]; ?></option>
   
   <? } } else { ?>
   
  <option value="">You are not Authorised</option>
  <? }  ?>

</td>


<td><input type="date" name="from" id="from"></td>
<td><input type="date" name="to" id="to"></td>



 <td><input type="button" onclick="searchById('Listing','1','');" value="Search" /></td>    
   
     
</table>


</div>
<div id="search"></div>
</center>
</body>
</html>







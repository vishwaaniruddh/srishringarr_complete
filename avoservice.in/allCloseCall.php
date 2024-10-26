<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
// print_r($_SESSION['branch']);
$brme=($_SESSION['branch']);
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<script src="excel.js" type="text/javascript"></script>
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
		 // var br=document.getElementById('br').value;
		  var calltype=document.getElementById('calltype').value;//alert(calltype);	 
		 
			 if(a!="Loading"){
				var calltype=document.getElementById('calltype').value;//alert(calltype);	 
			 	var Employee_name=document.getElementById('Employee_name').value;//alert(cid);
			 	var fromdt=document.getElementById('fromdt').value;//alert(fromdt);
			 	var todt=document.getElementById('todt').value;//alert(todt);
				
			//	var state=document.getElementById('state').value;//alert(state);
				var branch=document.getElementById('branch').value;//alert(branch);
				var openall=document.getElementById('openall').value;//alert(openall);
				
			
			  }
			 
			//alert("gg"); 
			var url = 'search_allCloseCall.php'; 
	
		    var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
   pmeters = 'calltype='+calltype+'&Page='+b+'&perpg='+ppg+'&fromdt='+fromdt+'&todt='+todt+'&openall='+openall+'&branch='+branch+'&Employee_name='+Employee_name;
		//	alert(pmeters);
			}
			else
			{
				 pmeters='calltype='+calltype+'&perpg='+ppg;
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


//=================Pick Engr============

function pick_engg(val){
//alert(val);
brid=val;
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
    var s=xmlhttp.responseText;
  	//alert(s);
	 document.getElementById('mystate').innerHTML = s;	
    }
  }
   
   //	alert("get_engg_br.php?brid="+brid);    
	xmlhttp.open("GET","get_engg_br.php?brid="+brid,true);
	xmlhttp.send();
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

<body>


<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
 ?>



<h2 class="h2color">Call Analysis</h2>

<div >
 <button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export</button>
	<br />
<table cellpadding="" cellspacing="0" >
  <tr>
  		
    	
    
<?php 
if($_SESSION['branch']=='all'){
$selbr= mysqli_query($con1,"select * from avo_branch order by name ASC"); 

} else {

$selbr= mysqli_query($con1,"select select * from avo_branch where in(".$_SESSION['branch'].") order by name ASC");
}
?> 

<tr>
<th width="77" colspan="">
    
    <select name="branch" id="branch" onchange="pick_engg(this.value);">
      	
     <option value= "">Select</option>

        <?php while ($result=mysqli_fetch_array($selbr)) {
	    $branch=mysqli_query($con1,"select id, name from avo_branch where id='".$result[0]."'");
	    $brname=mysqli_fetch_row($branch);
               ?>
	<option value="<?php echo $brname[0]; ?>"><?php echo $brname[1]; ?></option>
      
      <? }      ?>
</select>
</th>

<th>
<div id="mystate">
    
 <select name="Employee_name" id="Employee_name" >
    
    <option value="">Select</option>

  <option value="<?php echo $name[0]; ?>"><?php echo $name[1]; ?></option>
 
</div>
</th>
    
    
    
    
       	
     	
        <!--Call Type-->
    	<th>
        	<select name="openall" id="openall" >
				<option value="all">All</option>
				<option value="install">New Installation</option>
				<option value="service">Service</option>
				<option value="dere">De-Re Installation</option>
                <option value="pm">PM</option>
			</select>
       	</th>
        
        <!--From Date-->
     	<th width="75" colspan="2">
     <input type="text" name="fromdt" id="fromdt" readonly="readonly" onclick="displayDatePicker('fromdt');" placeholder="From Date"/></th>
     
     	<!--To Date-->
   		<th width="75" colspan="2">
   		<input type="text" name="todt" id="todt" readonly="readonly" onclick="displayDatePicker('todt');" placeholder="To Date"/></th>
     
   <th width="75" rowspan="2"><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>
   <input type="hidden" name="calltype" id="calltype"  value="<?php echo "Done";?>"/>
  </tr>
  
</table>
</div>
<div id="search"></div>


</center>
</body>
</html>
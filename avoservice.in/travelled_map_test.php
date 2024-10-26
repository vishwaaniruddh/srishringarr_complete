<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
// include('config.php');
include("db_connection.php");
$con1 = OpenCon1();

?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="1200" >
<title>Travel</title>
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
		 	var branch=document.getElementById('branch').value; //alert(branch);
		 
			 if(a!="Loading"){
			   	var engr=document.getElementById('Employee_name').value;// alert(engr);
			  	var branch=document.getElementById('branch').value;
			   	var date=document.getElementById('date').value;
			  
			  }
	
	
			var url = 'search_visit_details_test.php'; 
	
		    var pmeters="";
//	alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'Page='+b+'&perpg='+ppg+'&date='+date+'&engr='+engr+'&branch='+branch;
			// alert(pmeters);
			}
			else
			{
				 pmeters = "&Page="+b+'&perpg='+ppg+'&branch='+branch;
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
</head>

<body>
<center>
<?php include("menubar.php");  ?>

<h2 class="h2color">Travel</h2>

<div >

<table cellpadding="" cellspacing="0" >

 <tr>
<?     
if($_SESSION['designation']=='4') {
    // echo $_SESSION['user'];
$qry2=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");

$qry2ro=mysqli_fetch_row($qry2);

// echo $qry2ro[0];
$sql.= "select engg_id, engg_name, area from area_engg where loginid='".$qry2ro[0]."' and status='1' ";

//echo "select engg_id, engg_name from area_engg where loginid='".$qry2ro[0]."' and status='1' ";
$result = mysqli_query($con1,$sql);
$engr=mysqli_fetch_row($result);
$selbr= "select id from avo_branch where id ='".$engr[3]."'";}
	  else if($_SESSION['branch']!='all'){
	$selbr= "select id from avo_branch where id IN (".$_SESSION['branch'].") order by name ASC ";
	  } else 
	  
	  $selbr= "select id from avo_branch order by id ASC ";
	  
	  
		$selbr2=mysqli_query($con1,$selbr);
?>

<tr>
<th width="77" colspan="">
 
         
         <select name="branch" id="branch" onchange="pick_engg(this.value);">
     	
      	<option value= "">Select</option>
<?php
		while ($result=mysqli_fetch_array($selbr2)) {
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
    
<? if($_SESSION['designation']!='4'){ ?>
    <option value="">Select</option> <? } ?>
<?   if($_SESSION['designation']=='4'){   ?>
    
    <option value="<?php echo $engr[0]; ?>"><?php echo $engr[1]; ?></option>
   
   <? }  else ?>
    
    <option value="<?php echo $name[0]; ?>"><?php echo $name[1]; ?></option>
</div>
</th>


        <th width="75"><input type="text" name="date" id="date" onkeypress="return runScript(event)" readonly="readonly" onclick="displayDatePicker('date');" placeholder="Date"/></th>
      	

  
 <th width="75" rowspan="2"><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>
  
  </tr>
  
</table>
</div>
<div id="search"></div>


</center>
</body>
</html>
<?php
 CloseCon($con1);
?>
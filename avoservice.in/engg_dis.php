<?php
session_start();
include("access.php");
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


///////////////////////////////search 
function searchById(a,b,perpg) {
//alert(a+" "+b+" "+perpg);
var ppg='';
if(perpg=='')
ppg='100';
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
			     
			 var Employee_name=document.getElementById("Employee_name").value;
              var from=document.getElementById("from").value;  //alert(from);
              var to=document.getElementById("to").value; 
              var br=document.getElementById('Branch').value;
						
			  }
			var url = 'search_engg_dis.php'; 
		    var pmeters="";
		//	alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
    
	
   pmeters = 'Employee_name='+Employee_name+'&br='+br+'&Page='+b+'&perpg='+ppg+'&from='+from+'&to='+to;
			//alert(pmeters);
			}
			else
			{
				 pmeters='&perpg='+ppg;
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

  mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=500,height=600,left=420,top=130");
  
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
<?php include("menubar.php");

 ?>

<h2 class="h2color">Engineer-wise Distance Summary</h2>

<div >
<button id="myButtonControlID" onClick="tableToExcel('dis_summary', 'Dis Summary')">Export</button>
	<br />
<table cellpadding="" cellspacing="0" >
    	<tr >
                            

                       
				<th> Branch:</th>
				
				<th>Engineer Name:</th>
				<th>From Date:</th>
				<th>To Date:</th>
                
                 <th>Search</th>
 				</tr>
 				
 <?
$selbr= "select id, name from avo_branch where 1";
	
	if($_SESSION['branch']!='all' && $_SESSION['designation']!='4') {
	$selbr.= " and id IN (".$_SESSION['branch'].") order by id ASC ";
	}  
		$selbr2=mysqli_query($con1,$selbr);
?>

<tr>

<? if ($_SESSION['designation']!='4') { ?>

<td width="77" colspan="">
 
         
         <select name="Branch" id="Branch" onchange="pick_engg(this.value);">
      	
      	<option value= "">Select</option>
<?php 
		while ($result=mysqli_fetch_array($selbr2)) {
	    $branch=mysqli_query($con1,"select id, name from avo_branch where id='".$result[0]."'");
	    $brname=mysqli_fetch_row($branch);
               ?>
	   <option value="<?php echo $brname[0]; ?>"><?php echo $brname[1]; ?></option>
      
      <? } 
     
     ?>
       </select>
</td>

<? }  else {?>
<td><input type="hidden" name="Branch" id="Branch" value='' </td>
<? } ?>

<td>
 <div id="mystate">
 <select name="Employee_name" id="Employee_name" >
    
<? if($_SESSION['designation']!='4'){ ?>
    <option value="">Select</option> <? } ?>
    
    
<?   if($_SESSION['designation']=='4'){

$qry2=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");

$qry2ro=mysqli_fetch_row($qry2);

$sql.= "select engg_id, engg_name from area_engg where loginid='".$qry2ro[0]."' and status='1' ";

//echo "select engg_id, engg_name from area_engg where loginid='".$qry2ro[0]."' and status='1' ";
$result = mysqli_query($con1,$sql);
$engr=mysqli_fetch_row($result);

?>
    
    <option value="<?php echo $engr[0]; ?>"><?php echo $engr[1]; ?></option>
   
   <? } 
   
   else ?>
    
    <option value="<?php echo $name[0]; ?>"><?php echo $name[1]; ?></option>

</div>
</td>


<td><input type="date" name="from" id="from"></td>
<td><input type="date" name="to" id="to"></td>

<th width="75" rowspan="2"><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>

  </tr>
  
</table>
</div>
<div id="search"></div>


</center>
</body>
</html>

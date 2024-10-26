<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">

var tableToExcel = (function() {
//alert("hii");
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>
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
			 var email=document.getElementById('email').value;//alert(cid);
			 var con=document.getElementById('number').value;//alert(bank);
			  //var state=document.getElementById('state').value;//alert(cid);
			 
			  }
			
			var url = 'searchengme.php'; 
	
		    var pmeters="";
			
			if(a!="Loading"){ 
			 pmeters = 'Page='+b+"&name="+name+'&perpg='+ppg+"&email="+email+'&number='+con;
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

<h2>View Area Engineers</h2>
<div id="header"><button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
<table><th width="77"><input type="text" name="name" id="name" onkeyup="searchById('Listing','1','');" placeholder="Name"/></th>
    <th width="75"><input type="text" name="email" id="email" onkeyup="searchById('Listing','1','');" placeholder="Email"/></th>
    <th width="75"><input type="text" name="number" id="number" onkeyup="searchById('Listing','1','');" placeholder="Number"/></th>
    <!--<th width="75"><?php $state=mysqli_query($con1,"Select * from state order by state ASC");
	
	 ?><select name="state" id="state" onchange="searchById('Listing','1','');"><option value="">Select State</option>
     <?php
	 while($st=mysqli_fetch_array($state))
	 {
	 ?>
     <option value="<?php echo $st[0]; ?>"><?php echo $st[1]; ?></option>
     <?php
	 }
	 ?></select>
     </th>--></table>

<!--<table width="590" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res">
<tr><th width="86">Name</th>
<th width="103">City</th>
<th width="82">Area</th>
<th width="80">Email</th>
<th width="92">Contact</th>

<?php if(($_SESSION['designation'])=='1'){ ?><th width="80">Resume</th>
<th width="92">Approval</th>
<th width="47">Edit</th>
<th width="56">Delete</th>

<?php } ?></tr>

<?php

$count=0;
include("config.php");
$br=$_SESSION['branch'];
if($_SESSION['branch']!='all')
{
$br1=str_replace(",","','",$br);//echo $br1[0]."/".$br1[1];
$br1="'".$br1."'";
//echo $br1;
//echo "select state from state where state_id in (".$br1.")";
//echo "select state from state where state_id in (".$br1.")";
$src=mysqli_query($con1,"select state from state where state_id in (".$br1.")");
while($srcrow=mysqli_fetch_array($src))
{
	$bran[]=$srcrow[0];
}
$br3=implode(",",$bran);
$br2=str_replace(",","','",$br3);//echo $br1[0]."/".$br1[1];
$br2="'".$br2."'";
}
$qry="";
$str="";
//include_once('class_files/select.php');
//$sel_obj=new select();
//$city_head=$sel_obj->select_rows('localhost','site','site','atm_site',array("*"),"area_engg","","",array(""),"y","engg_name","a");
//echo $br2." ".$_SESSION['branch'];
if($_SESSION['branch']=='all')
{
$str="select * from area_engg where deleted=0 order by status ASC";
}
else
$str="select * from area_engg where deleted=0 and area in (".$_SESSION['branch'].") order by status ASC";

//echo $str;
$qry=mysqli_query($con1,$str);
while($row=mysqli_fetch_row($qry))
{
$count=$count+1;
//echo "select city from cities where city_id='".$row[3]."'";
//echo "select state from state where state_id='".$row[2]."'";
$qry2=mysqli_query($con1,"select city from cities where city_id='".$row[3]."'");
$row2=mysqli_fetch_row($qry2);
$qry3=mysqli_query($con1,"select state from state where state_id='".$row[2]."'");
$row3=mysqli_fetch_row($qry3);
//$city_head=$sel_obj->select_rows('localhost','site','site','atm_site',array("*"),"area_engg","","",array(""),"y","engg_name","a");	
?>
<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">
<td><?php echo $row[1]; ?></td>
<td><?php echo $row2[0]; ?></td>
<td><?php echo $row3[0]; ?></td>
<td><?php echo $row[4]; ?></td>
<td><?php echo $row[5]; ?></td>
<?php if(($_SESSION['designation'])=='1'){ ?><td><?php if($row[7]!=''){  ?><a href="download.php?filename=<?php echo $row[7]; ?>"><?php echo $row[1]." Resume"; ?></a><?php  } ?></td>
<td><?php // echo $row[9];   ?>
<div id="app<?php echo $row[0]; ?>"><?php if($row[9]==0){ ?><input class="buttn" type='button' onclick="Approve('<?php echo $row[0]; ?>');" style="background:#; height:25px" value='Approve'><?php } elseif($row[9]==1){ ?><input class="buttn" type='button' style="background:#CCCCCC; height:25px" onclick="Approve('<?php echo $row[0]; ?>');" value='Disapprove'><?php }  ?></div></td>
<td width="47" height="31"> <a href='edit_areaeng.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
<td width="56" height="31">  <a href="javascript:confirm_delete(<?php echo $row[0]; ?>);" class="update"> Delete </a></td><?php  } ?>
</tr>
<?php } ?>
</table>-->
</div>
<div id="search"></div>
</center>
</body>
</html>
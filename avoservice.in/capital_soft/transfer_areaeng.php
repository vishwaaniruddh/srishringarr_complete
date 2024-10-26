<?php include("access.php");

include("../config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>

<script>
function validation()
{
try
{
if(document.getElementById("transferarea").value!="" && document.getElementById("fromdt").value=="")
{
alert("Select From Date");
return false;
}

if(document.getElementById("add").value=="")
{
alert("Enter Transfrered Residence Address");
return false;
}

if(document.getElementById("lat").value=="")
{
alert("Enter Transfrered Residence Latitude");
return false;
}


}catch(ex)
{
alert(ex);
}
return true;
}

//========================================Branch wise state function

function pick_state(val)
{
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
      	//alert("get_state_br.php?brid="+brid);    
	xmlhttp.open("GET","get_state_eng.php?brid="+brid,true);
	xmlhttp.send();
}
//============City
function pick_city(val)
{ //alert("Hiiiii");
//alert(val);
state=val;
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
    var c=xmlhttp.responseText;
  //	alert(c);
	 document.getElementById('mycity').innerHTML = c;	
    }
  }
      //	alert("get_city.php?state="+state);    
	xmlhttp.open("GET","get_city.php?state="+state,true);
	xmlhttp.send();
}



</script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>
<h2>Transfer Engineer</h2>
<?php
$id=$_GET['id'];

$eng_head=mysqli_query($con1,"select * from area_engg where engg_id='".$id."'");

$erow=mysqli_fetch_row($eng_head);
$qry2=mysqli_query($con1,"select * from avo_branch where id=$erow[2]");
?>
<div id="header">
<form action="process_transfer_eng.php" method="post" name="form" enctype="multipart/form-data" onsubmit="return validation();">
<table>

<tr>
<td height="35">Region : </td>
<td> <input type="hidden" id="area" name="area"
<?php while ($row2=mysqli_fetch_row($qry2)) { ?>
value="<?php echo $row2[0]; ?>" ><?php echo $row2[1]; ?> 
<?php } ?>
</td>
</tr>

<tr>
<td height="25">Name : </td>
<td> <?php echo $erow[1]; ?></td>
</tr>

<tr>
<td height="25">Contact : </td>
<td><?php echo $erow[5]; ?></td>
</tr>

<tr>
<td height="25">Employee code: </td>
<td><?php echo $erow[6];?> </td>
</tr>

<td height="25">Designation: </td>
<td>
<?php echo $erow[11];?>
</td>
</tr>

<tr>
<td height="25">Date of Join</td>
<td>
<?php echo $erow[13];?>
</td>
</tr>


<tr>
<td height="35">Transfer to Region : </td>
<!--<td id="res"> -->
<td>
<select name='transferarea' id='transferarea'> <!--onchange="pick_state(this.value);"> -->
<option value='0'>Select</option>
<?php
//include("../config.php");
$state=mysqli_query($con1,"select * from `avo_branch` ");
while($stro=mysqli_fetch_row($state))
{
?>
<option value="<?php echo $stro[0];  ?>"><?php echo $stro[1];  ?></option>
<?php
}
?></select>
</td>
</tr>
<!--=============State=======-->
<tr>
<td height="35">State : </td>
<!--<td id="res"> -->
<td>
<div id="mystate">
<select name='state' id='state' onchange="pick_city(this.value);">
<option value='0'>select State</option>
<?php

$state_avo=mysqli_query($con1,"select * from `state` order by state ASC ");
while($state_avo1=mysqli_fetch_row($state_avo))
{ ?>
<option value="<?php echo $state_avo1[0];  ?>"><?php echo $state_avo1[1];  ?></option>
<?php
}
?></select>
</div>
</td>
</tr>

<tr>
<td width="130" height="35">City : </td>
<td width="189">
<div id="mycity">
<select name="city" id="city">
<option value="">select</option>
<?php
//include("config.php");
$city_tab=mysqli_query($con1,"select * from `cities` order by city ASC ");
while ($row=mysqli_fetch_row($city_tab)) { ?>
<option value="<?php echo $row[0];?>"><?php echo $row[1]; ?></option>
<?php } ?>
</select>
</div>
</td>
</tr>


<tr>
<td>Transfer Date
</td>
<td>
<input type="text" name="fromdt" id="fromdt" onkeypress="return runScript(event)"  onclick="displayDatePicker('fromdt');" placeholder="From Date" readonly/>
</td>
</tr>

<tr>
<td height="25">Transfer Residence Latitude</td>
<td><input type="text" name="lat" id="lat" /> </td>
</tr>
<tr>
<td height="25">Transfer Residence Longitude</td>
<td><input type="text" name="long" id="long" /> </td>
</tr>
<tr>
<td height="25">Transfer Residence Address</td>
<td><input type="text" name="add" id="add" /> </td>
</tr>


<tr>


<td height="35" colspan="2">
<input type="hidden" name="id" value="<?php echo $erow[0]; ?>" />
<input type="submit" value="submit" class="readbutton"/></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
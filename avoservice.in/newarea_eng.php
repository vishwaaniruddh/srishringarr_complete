<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add New Engineer</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<link href="menu.css" rel="stylesheet" type="text/css" />
<script>
/////for city
//===============State Pick==========
function pick_state(val)
{
  // alert(val);
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

//======================

function getXMLHttp()
{
 var xmlHttp
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

function MakeRequest()

{ 
  var xmlHttp = getXMLHttp();
  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {

      HandleResponse3(xmlHttp.responseText);
    }
  }
  //alert("getarea.php?ccode="+document.forms[0].city.value);
var str=document.getElementById('city').value;
//alert(str);
  xmlHttp.open("GET", "get_area.php?city="+str, true);

  xmlHttp.send(null);
}

function HandleResponse3(response)
{
  document.getElementById('res').innerHTML = response;
}

function validate()
{
//alert("hello");
var form=document.getElementById('engform');
with(form)
{
//alert("hello");
if(city.value=='')
{
//alert("hi");
alert("Select City first");
city.focus();
return;
}
if(area.value=='0')
{
alert("Please Select Branch");
area.focus();
return;
}

if(state.value=='0')
{
alert("Please Select State");
state.focus();
return;
}

if(name.value=='')
{
alert("Please Enter Engineer Name");
name.focus();
return;
}

if(lat.value=='')
{
alert("Please Enter Engineer Residence Latitude");
lat.focus();
return;
}

if(long.value=='')
{
alert("Please Enter Engineer Residence Longitude");
long.focus();
return;
}

if(add.value=='')
{
alert("Please Enter Engineer Residence Address");
add.focus();
return;
}

if(cont.value=='')
{
alert("Please Enter Engineer Contact Number");
cont.focus();
return;
}

if(empcode.value=='')
{
alert("Please Enter Engineer Employee code");
empcode.focus();
return;
}


if(desgn.value=='')
{
alert("Please Select Designation");
desgn.focus();
return;
}
if(doj.value=='')
{
alert("Please Enter Date of Joining");
doj.focus();
return;
}



if(cont.value!='')
{

 var y = cont.value;
 if(isNaN(y)||y.indexOf(" ")!=-1)
           {
              alert("Enter numeric value for Phone ");
              cont.value='';
              cont.focus();
              return;
           }
           if (y.length>10)
           {
                alert("Enter 10 characters without starting 0");
               cont.focus();
                return;
           }
}

if(lat.value!='')
{

 var y = lat.value;
 if(isNaN(y)||y.indexOf(" ")!=-1)
           {
              alert("Enter numeric value for Latitude");
              lat.value='';
              lat.focus();
              return;
           }
           if (y.length <5)
           {
                alert("Enter Correct Latitude");
               lat.focus();
                return;
           }
} 

form.submit();
}
}



</script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>


<h2>Add New Engineer</h2>
<div id="header">
<form action="process_areaengg.php" method="post" name="engform" enctype="multipart/form-data" id="engform">
<table>


<tr>
<td height="35">Branch : </td>
<td id="res">
<select name='area' id='area'> <!-- onchange="pick_state(this.value);">-->
<option value='0'>select Branch</option>
<?php
include("config.php");
$state=mysqli_query($con1,"select * from `avo_branch` order by name ");
while($stro=mysqli_fetch_row($state))
{
?>
<option value="<?php echo $stro[0];  ?>"><?php echo $stro[1];  ?></option>
<?php
}
?></select>
</td>
</tr>

<tr>
<td height="35">State : </td>
<td id="res">
<div id="mystate">
<select name='state' id='state'onchange="pick_city(this.value);">
<option value='0'>select State</option>
<?php
include("config.php");
$state_avo=mysqli_query($con1,"select * from `state` order by state");
while($state_avo1=mysqli_fetch_row($state_avo))
{
?>
<option value="<?php echo $state_avo1[0];  ?>"><?php echo $state_avo1[1];  ?></option>
<?php
}
?></select>
</div>
</td>
</tr>

<tr>
<td width="130" height="35">City : </td>
<td id="res" width="189">
<div id="mycity">
<select name="city" id="city">
<option value="">select</option>
<?php
include("config.php");
$city_tab=mysqli_query($con1,"select * from `cities` order by city ASC ");
while ($row=mysqli_fetch_row($city_tab)) { ?>
<option value="<?php echo $row[0];?>"><?php echo $row[1]; ?></option>
<?php } ?>
</select>
</div>
</td>
</tr>

<tr>
<td height="35">Name : </td>
<td><input type="text" name="name" id="name" /></td>
</tr>

<tr>
<td height="35">Contact : </td>
<td><input type="text" name="cont" id="cont" /></td>
</tr>

<tr>
<td height="35">Employee code: </td>
<td><input type="text" name="empcode" id="empcode" /></td>
</tr>

<td width="115" height="35">Designation: </td>
<td width="305">
<select name="desgn" id="desgn" required>
<option value="">select</option>
<option value="Field Engineer">Field Engineer</option>
<option value="Trainee">Trainee</option>
<option value="PCB/Field Engineer">PCB/Field Engineer</option>
<option value="PCB Engineer">PCB Engineer</option>
<option value="Sr.Engineer">Sr.Engineer </option>
<option value="Logistics"> Logistics</option>
<option value="Marketing"> Marketing</option>
<option value="Chargeable Engineer"> Chargeable Engineer</option>
<option value="Franchise"> Franchise</option>
<option value="Dummy ID"> Dummy ID </option>
</select>
</td>
</tr>

<tr>
<td>Date of Join
</td>
<td>
<input type="text" name="doj" id="doj" onkeypress="return runScript(event)"  readonly="readonly" onclick="displayDatePicker('doj');" placeholder="Join Date" />
</td>
</tr>

<tr>
<td>Residence Latitude
</td>
<td>
<input type="text" name="lat" id="lat" />
</td>
</tr>

<tr>
<td>Residence Longitude
</td>
<td>
<input type="text" name="long" id="long"  />
</td>
</tr>

<tr>
<td>Residence Address
</td>
<td>
<input type="text" name="add" id="add" />
</td>
</tr>

<tr>
<td height="35" colspan="2"><input  type="button" value="submit" class="readbutton" onclick="validate();"/></td>

<input type="hidden" name='branch' value="<?php echo $_SESSION['branch'] ?>"/>
</tr>

</table>
</form>
</div>
</center>
</body>
</html>
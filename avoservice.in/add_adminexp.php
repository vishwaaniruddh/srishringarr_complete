<?php
include("access.php");

include("config.php");
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
	xmlhttp.open("GET","get_exptype.php?state="+state,true);
	xmlhttp.send();
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

form.submit();
}
}



</script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>

<h2>Add Admin Expenses</h2>
<div id="header">
<form action="process_adminexp.php" method="post" name="engform" enctype="multipart/form-data" id="engform">
<table>

<tr>
<td height="35">Branch : </td>
<td id="res">
<? 

if($_SESSION['branch']=='all')
$brqry=mysqli_query($con1,"select * from `avo_branch` order by name ");
else
$brqry=mysqli_query($con1,"select * from `avo_branch` where id in ( '".$_SESSION['branch']."') ");
?>

<select name='area' id='area'> 
<? if($_SESSION['branch']=='all') { ?>

<option value=''>Select Branch</option>
<?php }
while($stro=mysqli_fetch_row($brqry))
{ ?>
<option value="<?php echo $stro[0];  ?>"><?php echo $stro[1];  ?></option>
<?php } ?>
</select>
</td>
</tr>

<tr>
<td height="35">Expense Head: </td>
<td id="res">

<select name='exp_head' id='exp_head' onchange="pick_city(this.value);">> 
<option value=''>Select</option>
<?
$expqry=mysqli_query($con1,"select * from `branch_exphead` where status=1 order by id");
while($exp=mysqli_fetch_row($expqry))
{ ?>
<option value="<?php echo $exp[0];  ?>"><?php echo $exp[1];  ?></option>
<?php } ?>
</select>
</td>
</tr>

<tr>
<td width="130" height="35">Expenses Type: </td>
<td id="res" width="189">
<div id="mycity">
<select name="exp_type" id="exp_type">
<option value="">select</option>
<?php
$city_tab=mysqli_query($con1,"select * from `br_exptype` where status=1 order by id ASC ");
while ($row=mysqli_fetch_row($city_tab)) { ?>
<option value="<?php echo $row[0];?>"><?php echo $row[2]; ?></option>
<?php } ?>
</select>
</div>
</td>
</tr>





<tr>
<td height="35">Paid to: </td>
<td><input type="text" name="name" id="name" /></td>
</tr>

<tr>
<td height="35">Narration / Description: </td>
<td><input type="text" name="cont" id="cont" /></td>
</tr>

<tr>
<td height="35">Employee code: </td>
<td><input type="text" name="empcode" id="empcode" /></td>
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
<?php include("access.php"); ?>
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


function validate()
{
var form=document.getElementById('form');
with(form)
{
if(city.value=='')
{
alert("Select City first");
city.focus();
return;
}


if(name.value=='')
{
alert("Please Enter Engineer Name");
name.focus();
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
alert("Please Select Correct Designation");
desgn.focus();
return;
}

}
}



//========================================Branch wise state function

function pick_state(val){
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
	xmlhttp.open("GET","../get_state_br.php?brid="+brid,true);
	xmlhttp.send();
}


</script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>
<h2>Edit Area Engineer</h2>
<?php
$id=$_GET['id'];
include('config.php');

$eng_head=mysqli_query($concs,"select * from area_engg where engg_id='".$id."'");
$erow=mysqli_fetch_row($eng_head);
?>
<div id="header">
<form action="update_areaengg.php" method="post" name="form" id="form" enctype="multipart/form-data" onsubmit="return validation();">
<table>




<tr>
<td height="35">Name : </td>
<td><?php echo $erow[1]; ?></td>
</tr>

<tr>
<td height="35">Contact : </td>
<td><input type="text" name="cont" id="cont" value="<?php echo $erow[5]; ?>"/></td>
</tr>

<tr>
<td height="35">Employee code: </td>
<td><input type="text" name="empcode" id="empcode" value="<?php echo $erow[6];?>" /></td>
</tr>


<tr>
<td width="99" height="35">City : </td>
<td width="189">
<select name="city" id="city"> <!-- onchange="MakeRequest()"> -->
<?php

$brqry=mysqli_query($con1,"select state_id from state where branch_id='".$erow[2]."' ");

$qry2=mysqli_query($concs,"select state_id from state where branch_id='".$erow[2]."' ");
while($row2=mysqli_fetch_row($qry2)) {

$qry=mysqli_query($concs,"select city_id,city from cities where state_id='".$row2[0]."' and status=1 ORDER BY city ASC");

?>
<!--<option value="0">select</option> -->
<?php while ($row=mysqli_fetch_row($qry)) { ?>
<option value="<?php echo $row[0];?>" <?php if($erow[3]==$row[0]){ echo "selected"; } ?>><?php echo $row[1]; ?></option>
<?php
}
} ?>
</select>
</td>
</tr>



<tr>
<td width="115" height="35">Designation: </td>
<td width="305">
<select name="desgn" id="desgn">
<option value="<?php echo $erow[11];  ?>"><?php echo $erow[11];?></option>
<option value="Sr.Engineer">Sr.Engineer </option>
<option value="Field Engineer">Field Engineer</option>
<option value="Trainee">Trainee</option>
</select>
</td>
</tr>

<tr>
<td height="35">Date of Join</td>
<td>
<? $doj=date("d/m/Y", strtotime($erow[13]));
//echo $doj;
?>

<input type="text" name="doj" id="doj" value="<?php echo $doj;?>" onkeypress="return runScript(event)"  onclick="displayDatePicker('doj');" placeholder="From Date" />
</td>
</tr>

<td width="250" height="35">Engineer Residence Address</td>

<td> <input type="textarea" name="address" id="address" cols="50" value="<?php echo $erow[20];?>" />
</td>
</tr>

<tr>
<td height="35">Engineer Residence Latitude</td>
<td> <input type="number" step="any" name="lat" id="lat" value="<?php echo $erow[18];?>" placeholder="latitude" />
</td>
</tr>

<tr>
<td height="35">Engineer Residence Longitude</td>
<td> <input type="number" step="any" name="long" id="long" value="<?php echo $erow[19];?>" placeholder="longitude" />
</td>
</tr>
<tr>



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
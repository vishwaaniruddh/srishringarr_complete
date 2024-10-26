<?php
include("access.php");
//echo $_SESSION['user'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAR CRM</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
<!---date--->
<script type='text/javascript' src='jquery-1.4.4.min.js'></script>
<script type="text/javascript" src="jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="jquery-ui.css">
<script type='text/javascript'>//<![CDATA[ 
////get end date
$(function() {
	
	
    $(".firstcal").datepicker({
        dateFormat: "dd/mm/yy",
        onSelect: function(dateText, instance) {
			//var str1=document.getElementById('pack').value;
			//var m=str1.split(" ");
			var a=3;var b=6;var c=9;var d=1;
			
			//var mon=m[1]+"()";
			//alert(mon);
            date = $.datepicker.parseDate(instance.settings.dateFormat, dateText, instance.settings);
			date1 = $.datepicker.parseDate(instance.settings.dateFormat, dateText, instance.settings);
			date2 = $.datepicker.parseDate(instance.settings.dateFormat, dateText, instance.settings);
			date3 = $.datepicker.parseDate(instance.settings.dateFormat, dateText, instance.settings);
			//if(m[1]=="Year"){
			//alert(date.getFullYear()+3);
			// date.setYear(date.getFullYear() + a);
			// date.setDate(date.getDate() -1);
			//}
			//else{
            date.setMonth(date.getMonth() + a);
			date.setDate(date.getDate() -1);
			 
			 date1.setMonth(date1.getMonth() + b);
			 date1.setDate(date1.getDate() -1);
			 
			 date2.setMonth(date2.getMonth() + c);
			 date2.setDate(date2.getDate() -1);
			 
			 date3.setYear(date3.getFullYear() + d);
			 date3.setDate(date3.getDate() -1);
			
			//}
			
            $(".secondcal").datepicker("setDate", date); $(".thirdcal").datepicker("setDate", date1); $(".forthcal").datepicker("setDate", date2);$(".lastcal").datepicker("setDate", date3);
        }
    });
    $(".secondcal").datepicker({
        dateFormat: "dd/mm/yy"
    });
	$(".thirdcal").datepicker({
        dateFormat: "dd/mm/yy"
    });
	$(".forthcal").datepicker({
        dateFormat: "dd/mm/yy"
    });
	$(".lastcal").datepicker({
        dateFormat: "dd/mm/yy"
    });
	
});

function changeuser() {
if(document.getElementById('cust').value=='commercial')
{
	document.getElementById('comm').style.display='block';
	document.getElementById('dom').style.display='none';
	
}

else
{
	document.getElementById('comm').style.display='none';
	document.getElementById('dom').style.display='block';
}
}

////validation
function validate(form){
 with(form)
 {
var numbers = /^[0-9]+$/;  
if(!cont.value.match(numbers))
{
alert("Please Enter Contact No. in numbers");
cont.focus();
return false;
}
if(pin.value=="")
{
alert("Please Enter Pincode");
pin.focus();
return false;
}
if(model.value=="")
{
alert("Please Enter Model No");
model.focus();
return false;
}
if(dop.value=="")
{
alert("Please Enter Purchase Date");
dop.focus();
return false;
}
}
return true;
}


function validate1(form1){
 with(form1)
 {
var numbers = /^[0-9]+$/;  
if(!cont.value.match(numbers))
{
alert("Please Enter Contact No. in numbers");
cont.focus();
return false;
}
if(pin1.value=="")
{
alert("Please Enter Pincode");
pin1.focus();
return false;
}
if(model.value=="")
{
alert("Please Enter Model No");
model.focus();
return false;
}
if(dop1.value=="")
{
alert("Please Enter Purchase Date");
dop1.focus();
return false;
}

}
return true;
}
</script>
</head>

<body>
<center>
<input type="button" value="PM Call" class="button" onclick="javascript:location.href = 'cust_service.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="CR Call" class="button" onclick="javascript:location.href = 'cust_request.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="AMC" class="button" onclick="javascript:location.href = 'amcview.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Open Call" class="button" onclick="javascript:location.href = 'open.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Closed Call" class="button" onclick="javascript:location.href = 'close.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Alerts" class="button" onclick="javascript:location.href = 'alert.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Expired" class="button" onclick="javascript:location.href = 'expired.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Engineer Performance" class="button" onclick="javascript:location.href = 'engperforma.php';" style="width:160px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Logout" class="button" onclick="javascript:location.href = 'logout.php';" style="width:100px;"/><br /><br>

<h2>New Customer </h2>
Select Customer : <select id="cust" onchange="changeuser();">
  <option value="domestic">Domestic</option>
  <option value="commercial">Commercial</option>
</select>

<div id="dom">
<form action="process_newcustomer.php" method="post" name="form" onSubmit="return validate(this)" enctype="multipart/form-data">
<table>
<tr>
<td width="155" height="40">Customer Name : </td>
<td width="246"><input type="text" name="cname" id="cname" /></td>
</tr>

<tr>
<td height="40">Contact : </td>
<td><input type="text" name="cont" id="cont" /></td>
</tr>

<tr>
<td height="40">Email : </td>
<td><input type="text" name="email" id="email" /></td>
</tr>

<tr>
<td height="40">Address : </td>
<td><textarea name="add" rows="4" cols="30"></textarea></td>
</tr>

<tr>
<td height="40">Pincode : </td>
<td><input type="text" name="pin" id="pin" /></td>
</tr>

<tr>
<td height="40">Model No. : </td>
<td><input type="text" name="model" id="model" /></td>
</tr>

<tr>
<td height="40">Model Image : </td>
<td><input type="file" name="file"  /></td>
</tr>


<tr>
<td height="40">Motor Warranty : </td>
<td><select id="motor" name="motor">
<option value="Not Applicable">Not Applicable</option>
<option value="1 Year">1 year</option>
<option value="2 Year">2 Year</option>
<option value="3 Year">3 Year</option>
<option value="4 Year">4 Year</option>
<option value="5 Year">5 Year</option>
</select></td>
</tr>


<tr>
<td height="40">Date of Purchase : </td>
<td><input type="text" name="dop" id="dop" class="firstcal"/><input type="hidden" id="pack" value="3 Months" /><input type="hidden" id="pack1" value="3 Months" /></td>
</tr>

<tr>
<td height="40">Service Date 1 : </td>
<td><input type="text" name="sdate1" id="sdate1" class="secondcal" readonly="readonly"></td>
</tr>

<tr>
<td height="40">Service Date 2 : </td>
<td><input type="text" name="sdate2" id="sdate2" class="thirdcal" readonly="readonly"/></td>
</tr>

<tr>
<td height="40">Service Date 3 : </td>
<td><input type="text" name="sdate3" id="sdate3" class="forthcal" readonly="readonly"/></td>
</tr>

<tr>
<td height="40">Service Date 4 : </td>
<td><input type="text" name="sdate4" id="sdate4" class="lastcal" readonly="readonly"/></td>
</tr>
<tr>
<td height="40"><input type="submit" value="submit" class="button"/></td>
</tr>
</table>
</form>
</div>


<div id="comm" style="display:none;">
<form action="process_newcustomer1.php" method="post" name="form1" onSubmit="return validate1(this)">
<table>
<tr>
<td width="155" height="40">Customer Name : </td>
<td width="246"><input type="text" name="cname" id="cname" /></td>
</tr>

<tr>
<td height="40">Contact : </td>
<td><input type="text" name="cont" id="cont" /></td>
</tr>

<tr>
<td height="40">Email : </td>
<td><input type="text" name="email" id="email" /></td>
</tr>

<tr>
<td height="40">Address : </td>
<td><textarea name="add" rows="4" cols="30"></textarea></td>
</tr>

<tr>
<td height="40">Pincode : </td>
<td><input type="text" name="pin1" id="pin1" /></td>
</tr>

<tr>
<td height="40">Model No. : </td>
<td><input type="text" name="model" id="model" /></td>
</tr>

<tr>
<td height="40">Model Image : </td>
<td><input type="file" name="file"  /></td>
</tr>


<tr>
<td height="40">Motor Warranty : </td>
<td><select id="motor" name="motor">
<option value="Not Applicable">Not Applicable</option>
<option value="1 Year">1 year</option>
<option value="2 Year">2 Year</option>
<option value="3 Year">3 Year</option>
<option value="4 Year">4 Year</option>
<option value="5 Year">5 Year</option>
</select></td>
</tr>

<tr>
<td height="40">Date of Purchase : </td>
<td><input type="text" name="dop1" id="dop1" onclick="displayDatePicker('dop1');"/></td>
</tr>

<tr>
<td height="40">Select Service : </td>
<td>
<select name="service">
<option value="6">6 Months</option>
<option value="12">12 Months</option>
</select>
</td>
</tr>

<tr>
<td height="40"><input type="submit" value="submit" class="button"/></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
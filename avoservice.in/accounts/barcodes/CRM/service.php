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

function validate1(form1){
 with(form1)
 {
var numbers = /^[0-9]+$/;  
if(cname.value=="")
{
	alert("Please Enter Customer Name.");
	return false;
}
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
<input type="button" value="Logout" class="button" onclick="javascript:location.href = 'logout.php';" style="width:100px;"/><br /><br />

<h2>New Service Customer </h2>

<form action="process_newcustomer2.php" method="post" onSubmit="return validate1(this)"  id="form1" name="form1">
<table>
<tr>
<td width="129" height="40">Customer Name : </td>
<td width="264"><input type="text" name="cname" id="cname" /></td></tr>

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
  <td height="40"><input type="submit" value="submit" class="button"/></td>
   <td height="40"><input type="button" value="Cancel" class="button" onclick="javascript:location.href = 'cust_request.php';"/></td>
</tr>
</table>
</form>
</center>
</body>
</html>

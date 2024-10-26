<?php
include("access.php");
//echo $_SESSION['user'];
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAR CRM</title>
<link rel="stylesheet" type="text/css" href="style.css">
<!---date--->
<script type='text/javascript' src='jquery-1.4.4.min.js'></script>
<script type="text/javascript" src="jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="jquery-ui.css">
    
<script type='text/javascript'>//<![CDATA[ 
////get end date
/*$(function() {
	
	
    $(".firstcal").datepicker({
        dateFormat: "dd/mm/yy",
        onSelect: function(dateText, instance) {
			var str1=document.getElementById('pack').value;
			var m=str1.split(" ");
			var a=Number(m[0]);
			
			var mon=m[1]+"()";
			//alert(mon);
            date = $.datepicker.parseDate(instance.settings.dateFormat, dateText, instance.settings);
			if(m[1]=="Year"){
			//alert(date.getFullYear()+3);
			 date.setYear(date.getFullYear() + a);
			 date.setDate(date.getDate() -1);
			}else{
            date.setMonth(date.getMonth() + a);
			 date.setDate(date.getDate() -1);
			}
			
            $(".secondcal").datepicker("setDate", date);
        }
    });
    $(".secondcal").datepicker({
        dateFormat: "dd/mm/yy"
    });
});
*/
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


/////display items
var searchReq = getXMLHttp();
function getXMLHttp()
{

  var xmlHttp

// alert("hi1");

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

//alert("hi");

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {

      HandleResponse(xmlHttp.responseText);

    }

  }

// alert("hi2");

var str = escape(document.getElementById('cname').value);
var str1 = escape(document.getElementById('cst_type').value);

//alert(str1);
 xmlHttp.open("GET", "getitem.php?cname="+str+"&service="+str1, true);
//alert("getitem.php?cname="+str+"&type="+str1);
  xmlHttp.send(null);

}
function HandleResponse(response)

{
/////alert(response);
var st=response;
var a=st.split("####");

document.getElementById('detail').innerHTML=a[0];
document.getElementById('detail1').innerHTML=a[1];
}


//////get start date
function MakeRequest1()

{

  var xmlHttp = getXMLHttp();

//alert("hi");

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {

      HandleResponse1(xmlHttp.responseText);

    }

  }

// alert("hi2");

var str = escape(document.getElementById('cname').value);
var str1 = escape(document.getElementById('type').value);

//alert(str1);
 xmlHttp.open("GET", "get_startdate.php?cname="+str+"&service="+str1, true);
//alert("getitem.php?cname="+str+"&type="+str1);
  xmlHttp.send(null);

}
function HandleResponse1(response)

{
//alert(response);
document.getElementById('detail1').innerHTML=response;

}


/////customer type

function cust(a)

{ //alert("GGG");
//alert(a.value);
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
    document.getElementById("res").innerHTML=xmlhttp.responseText;
    }
  }
  var s=a.value;

xmlhttp.open("POST","getcust1.php?cid="+s,true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("fname=Henry&lname=Ford");
}
</script>
</head>

<body>
<center>
<input type="button" value="PR Call" class="button" onclick="javascript:location.href = 'cust_service.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="CR Call" class="button" onclick="javascript:location.href = 'cust_request.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="AMC" class="button" onclick="javascript:location.href = 'amcview.php';" style="width:100px;"/>
<input type="button" value="Open Call" class="button"  onclick="javascript:location.href = 'open.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Closed Call" class="button" onclick="javascript:location.href = 'close.php';"  />&nbsp;&nbsp;&nbsp;
<input type="button" value="Alerts" class="button" onclick="javascript:location.href = 'alert.php';" style="width:100px;"/>
&nbsp;&nbsp;&nbsp;
<input type="button" value="Expired" class="button" onclick="javascript:location.href = 'expired.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Engineer Performance" class="button" onclick="javascript:location.href = 'engperforma.php';" style="width:160px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Logout" class="button" onclick="javascript:location.href = 'logout.php';" style="width:100px;"/><br /><br>

<h2>Customer AMC</h2>

<form action="process_amc.php" method="post">
<table>
<tr>
<td height="40">Customer Type : </td>
<td><input type="radio" name="type" id="type" value="sales" onclick="cust(this);" class="type" checked="checked"/>Sales Customer  
    <input type="radio" name="type" id="type" value="service"  onclick="cust(this);" class="type"/>Service Customer
</td>
</tr>

<tr><td height="40">Date : </td><td><?php echo date('d/m/Y'); ?></td></tr>

<tr>
<td height="40">Select Customer Name : </td>
<td id="res">
<input type="hidden" value="sales" name="cst_type" id="cst_type"/>
<select name="cname" id="cname" onchange="MakeRequest();">
<option value="0">select</option>
<?php
include('config.php');
$date=date('Y-m-d');
$enddate=strtotime(date("Y-m-d", strtotime($date)) . " +1 month");
$result = mysql_query("SELECT * FROM  phppos_service  order by name");
while($row = mysql_fetch_row($result)){ 
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
<?php } ?>
</select>
</td>
</tr>
<tr>
<tr>

<td colspan="2"><div id="detail1"></div></td>
</tr>
<tr>

<td><div id="detail"></div></td>
</tr>

<tr>
<td height="40">Start Date : </td><td><input type="text" name="sdate" id="sdate" class="firstcal"/>
</tr>

<tr>
<td height="40">Amount : </td><td><input type="text" name="amount" id="amount" />
</tr>
<input type="hidden" id="pack" value="1 Year" />

<input type="hidden" name="sdate1" id="sdate1" class="secondcal" readonly="readonly"></td>
<input type="hidden" name="sdate2" id="sdate2" class="thirdcal" readonly="readonly"/></td>
<input type="hidden" name="sdate3" id="sdate3" class="forthcal" readonly="readonly"/></td>
<input type="hidden" name="sdate4" id="sdate4" class="lastcal" readonly="readonly"/></td>

<tr>
<td height="34"><input type="submit" value="submit" class="button"/></td>
</tr>
</table>
</form>
</center>
</body>
</html>

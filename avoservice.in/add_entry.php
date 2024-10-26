<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Factory</title>
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
if(agent.value=='')
{
//alert("hi");
alert("Please Enter Agent Name");
agent.focus();
return;
}

if(cust.value=='0')
{
alert("Please Enter Customer / Party ");
cust.focus();
return;
}


form.submit();
}
}



</script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>


<h2>Add Entries</h2>
<div id="header">
<form action="process_entries.php" method="post" name="engform" enctype="multipart/form-data" id="engform">
<table>


<tr>
<td height="35">Agent Name: </td>
<td><select name="agent" id="agent" />
<option value=''> Select </option>

<?php
$qry=mysqli_query($con1,"select * from agents order by agent_name ASC");
while($row=mysqli_fetch_row($qry)) { ?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?> </option>
<? } ?>
</select>
</td>
</tr>

<tr>
<td height="35">Party / Supplier Name: </td>
<td><select name="cust" id="cust" />
<option value=''> Select </option>

<?php
$qry1=mysqli_query($con1,"select * from parties order by party_name ASC");
while($row1=mysqli_fetch_row($qry1)) { ?>
<option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?> </option>
<? } ?>
</select>
</td>
</tr>

<tr>
<td height="35">Product: </td>
<td><select name="material" id="material" />
<option value=''> Select </option>

<?php
$qry1=mysqli_query($con1,"select a.prod_spcid, b.prod_name, a.specs from factory_productlist a, factory_product_master b where a.prod_id=b.prod_id  order by b.prod_id ASC");
while($pro=mysqli_fetch_row($qry1)) { ?>
<option value="<?php echo $pro[0]; ?>"><?php echo $pro[1]." - ".$pro[2]; ?> </option>
<? } ?>
</select>
</td>
</tr>

<tr>
<td height="35">Qty: </td>
<td><input type="number" min="0" max="10000000" name="qty" id="qty" style="font-size:15px; font-weight:bold;" onkeyup="if(parseInt(this.value)>10000000){ this.value =''; return false; }" /></td>
</tr>

<tr>
<td height="35">Actual Qty: </td>
<td><input type="number" min="0" max="10000000" name="aqty" id="aqty" style="font-size:15px; font-weight:bold;" onkeyup="if(parseInt(this.value)>10000000){ this.value =''; return false; }" required/></td>
</tr>

<tr>
<td height="35">PI / SO No: </td>
<td><input type="text" name="so" id="so" /></td>
</tr>

<tr>
<td>Date of Booking </td>
<td>
<input type="text" name="date" id="date" onkeypress="return runScript(event)"  readonly="readonly" onclick="displayDatePicker('date');" placeholder="Booking date" required/>
</td>
</tr>

<tr>
<td height="35">Invoice No: </td>
<td><input type="text" name="inv" id="inv" required/></td>
</tr>


<tr>
<td>Rate</td>



<td><input type="number" min="1" max="100000000" name="rate" id="rate" onkeyup="if(parseInt(this.value)>100000000){ this.value =''; return false; }" /></td>
</tr>
<tr>
<td>Terms of delivery </td>
<td> <input type="text" name="terms" id="terms" required/>
</td>
</tr>

<tr>
<td>Port of delivery</td>
<td> <input type="text" name="port" id="port" required/>
</td>
</tr>

<tr>
<td height="35">Select Factory: </td>
<td><select name="factory" id="factory" />
<option value=''> Select </option>

<?php
$qry1=mysqli_query($con1,"select * from factories where status=1 ");
while($row1=mysqli_fetch_row($qry1)) { ?>
<option value="<?php echo $row1[1]; ?>"><?php echo $row1[1]; ?> </option>
<? } ?>
</select>
</td>
</tr>

<tr>
<td>Payment Terms</td>
<td> <input type="text" name="payterm" id="payterm" required/>
</td>
</tr>

<tr>
<td>BL No</td>
<td> <input type="text" name="blno" id="blno" required/>
</td>
</tr>

<tr>
<td>Loading Date</td>
<td>
<input type="text" name="ldate" id="ldate" onkeypress="return runScript(event)"  readonly="readonly" onclick="displayDatePicker('ldate');" placeholder="Loading date" required/>
</td>
</tr>

<tr>
<td>Vessel Takeoff Date</td>
<td>
<input type="text" name="vdate" id="vdate" onkeypress="return runScript(event)"  readonly="readonly" onclick="displayDatePicker('vdate');" placeholder="Takeoff date" required/> 
</td>
</tr>

<tr>
<td>ETA</td>
<td>
<input type="text" name="eta" id="eta" onkeypress="return runScript(event)"  readonly="readonly" onclick="displayDatePicker('eta');" placeholder="ETA" required/> 
</td>
</tr>

<tr>
<td>Special Terms - If any</td>
<td> <input type="text" name="splterm" id="splterm" required/>
</td>
</tr>

<tr>
<td>Status</td>
<td> <select name="status" id="status" required/>
<option value=''> Select</option>
<option value='To be Loaded'> To be Loaded</option>
<option value='To be Dispatched'> To be Dispatched</option>
<option value='Dispatched'> Dispatched</option>
<option value='Arrived'> Arrived</option>
<option value='Cleared'> Cleared</option>

</select>
</td>
</tr>

<tr>
<td>Docs Status</td>
<td> <select name="docstatus" id="docstatus" required/>
<option value=''> Select</option>
<option value='Pending'> Pending</option>
<option value='Verified - Correct'> Verified - Correct</option>
<option value='Verified - InCorrect'> Verified - InCorrect</option>
</select>
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
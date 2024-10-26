<?php
include '../access.php';
include '../config.php';
//echo $_SESSION['designation'];
$cust = $_GET['cust'];
$atmid = $_GET['atmid'];
$qryatm = mysqli_query($con1, "Select * from Amc where amcid='" . $atmid . "'");
$resatm = mysqli_fetch_row($qryatm);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<link href="../menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="../datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="../datepicker/datepick_js.js" type="text/javascript"></script>
<!--validation-->
<script>

function validate1(form1){
 with(form1)
 {

 var numbers = /^[0-9]+$/;
var namePattern = /^[A-Za-z()_ ]/;
if(cust.value==0)
{
	alert("Please Select Customer.");
	cust.focus();
	return false;
}
if(po.value==0)
{
	alert("Please Select Purchase.");
	po.focus();
	return false;
}

if(ref_id.value==0)
{
	alert("Please Select Atm ID.");
	ref_id.focus();
	return false;
}
if(buybk.checked==true)
{
if(buybkdesc.value=='')
{
alert("Please provide Buy Back Description");
buybkdesc.focus();
return false;
}
}
if(cname.value.search(/[a-z]+$/)== -1 && cname.value.search(/[A-Z]+$/)== -1 )
{
	alert("Please Enter  Contact Person Name in letters");
	cname.focus();
	return false;
}
if(cphone.value.length!=10)
 {
alert("Please Enter 10 Digits Contact Number.");
cphone.focus();
return false;
}

if(!cphone.value.match(numbers))
  {
alert("Please Enter Contact No. to continue.");
cphone.focus();
return false;
}

if(cemail.value.search(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)==-1)
{
alert("Invalid E-mail Address! Please re-enter.")
cemail.focus();
return false;
}
}


 return true;
 }



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

 //alert("hi2");

  //alert("getarea.php?ccode="+document.forms[0].city.value);
var str=document.getElementById('state').value;
//alert(str);
  xmlHttp.open("GET", "get_city.php?state="+str, true);

  xmlHttp.send(null);

}

function HandleResponse3(response)

{

  document.getElementById('res').innerHTML = response;

}


//////atm id data
function atmid()
{ //alert("h");
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
  ////alert(s);
 // document.getElementById('assettr').style.display='block';
	 document.getElementById('asset_div').innerHTML = s;
    }
  }
    var cust=document.getElementById('cust').value;
    var po=document.getElementById('po').value;
    var ref=document.getElementById('ref_id').value;

//alert("../get_dataamc.php?cust="+cust+"&po="+po+"&ref="+ref);

xmlhttp.open("GET","../get_dataamc.php?cust="+cust+"&po="+po+"&ref="+ref,true);

xmlhttp.send();
}
function astselect(id)
{
	//alert(id);
	var x=document.getElementById(id).value;
	alert(x);
	/* if (document.getElementById(id).checked==true)
	  {
		 document.getElementById('t1').value=1;
		 //alert(document.getElementById('t1').value);

        }
		 else
		 {
            document.getElementById('t1').value=0;
        }
		alert(document.getElementById('t1').value);*/
}


///////////type of alert
function alert_type(){
if(document.getElementById('call').value=='new')
{
	document.getElementById('assets').style.display='block';
}

else
{
	document.getElementById('assets').style.display='none';

}
}

////assets
function addThem()
{
var a = document.form.asset;
var add = a.value+',';
document.form.asset_box.value += add;
return true;
}

///////Assets
function assets()

{
  var xmlHttp = getXMLHttp();


  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {

      HandleResponse5(xmlHttp.responseText);
    }
  }

 //alert("hi2");

  //alert("getarea.php?ccode="+document.forms[0].city.value);
var str=document.getElementById('po').value;
/////alert(str);
//alert("get_asset.php?po="+str);
  xmlHttp.open("GET", "../get_assetme.php?po="+str, true);

  xmlHttp.send(null);

}

function HandleResponse5(response)

{

  document.getElementById('ref_id1').innerHTML = response;

}
///////get po no.
function po_no()

{
  var xmlHttp = getXMLHttp();


  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {


      HandleResponse4(xmlHttp.responseText);
    }
  }

 //alert("hi2");

  //alert("getarea.php?ccode="+document.forms[0].city.value);
var str=document.getElementById('cust').value;
////alert(str);
  xmlHttp.open("GET", "../get_po.php?cust="+str, true);

  xmlHttp.send(null);

}

function HandleResponse4(response)

{

  document.getElementById('po_no').innerHTML = response;

}
function showdesc(id)
{
//alert(id);
if(document.getElementById(id).checked==true)
document.getElementById('buybktr').style.display='block';
else if(document.getElementById(id).checked==false)
document.getElementById('buybktr').style.display='none';
}
</script>
</head>

<body onload="atmid();">
<center>
<?php include "menubar.php";?>

<h2>AMC Installation Alert</h2>

<div id="header">

<form action="process_alertamc.php" method="post" name="form" onSubmit="return validate1(this)">

<br/>

<!--
<select name="call" id="call" onchange="alert_type();" style="border:2px #fff solid;">
<option value="0">Select Alert</option>
<option value="new">New Installation</option>
<option value="service">Service Alert</option>

</select>-->

<br /><br />

<div id="assets" style="display:block;">
<table width="601">
 <tr><td width="158">
Subject : </td>
  <td width="154">

<input type="text" name="sub" id="sub">

</td>
<td width="64"> Client Docket Number :
<td width="199">
<input type="text" name="doc" id="doc" value="New Installation Call" readonly >

</td></tr>
<tr>

<td width="64"> Customer :
<td width="158">
<input type="text" name="cust" id="cust" value="<?php echo $cust; ?>" readonly >

</td>


 <!-- <tr><td width="158">
 Customer : </td>
<?php
$client = "select cust_id,cust_name from customer where 1";
if ($_SESSION['designation'] == 5) {
    //echo "select client from clienthandle where logid='".$_SESSION['logid']."'";
    $cust = mysqli_query($con1, "select client from clienthandle where logid= (select srno from login where username='" . $_SESSION['user'] . "')");
    $cc = array();
    while ($custr = mysqli_fetch_array($cust)) {
        $cc[] = $custr[0];
    }

    $ccl = implode(",", $cc);
    $ccl = str_replace(",", "','", $ccl);
    $ccl = "'" . $ccl . "'";
    $client .= " and cust_name in($ccl)";

}
$client .= " order by cust_name ASC";
//echo $client;
?>
    <td width="154">
    <select name="cust" id="cust" onchange="po_no();"> <?php if ($_SESSION['designation'] != 5) {?><option value="0">Select Client</option><?php }
$cl = mysqli_query($con1, $client);
while ($clro = mysqli_fetch_row($cl)) {
    ?>
<option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>
<?php
}
?></select></td>-->

 <!-- <td width="154">

<select name="cust" id="cust" onchange="po_no();">
<option value="0">select</option>
<?php
$qry1 = mysqli_query($con1, "select * from customer");
while ($row = mysqli_fetch_row($qry1)) {
    ?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>


<?php }?>
</select>
</td>-->
<td width="64"> PO No :
<td width="199" id="po_no">
<?php
//echo "select po from amcpurchaseorder where amcsiteid='".$atmid."'";
$qry = mysqli_query($con1, "select po from amcpurchaseorder where amcsiteid='" . $atmid . "'");
$po = mysqli_fetch_row($qry);

?>

<input type="text" name="po" id="po" value="<?php echo $po[0]; ?>" readonly />

<!--<select name="po" id="po" onchange="assets();">
<option value="0">select</option>
</select>-->
</td></tr>
<?php
include_once '../class_files/select.php';
$sel_obj = new select();
$atm = $sel_obj->select_rows('localhost', 'hav_acc', 'Myaccounts123*', 'hav_accounts', array("tracker_id"), "atm", "", "", array(""), "y", "tracker_id", "a");
?>

<tr>
<td width="115" height="35">Atm Id : </td>
<td width="305" id="ref_id1" colspan="3"><input type="hidden" name="cdate" value="<?php echo date('Y-m-d'); ?>" />
<input type="text" name="ref_id" id="ref_id" value="<?php echo $resatm[3]; ?>" readonly >
<!--<select name="ref_id" id="ref_id" onchange="atmid();">
<option value="0">select</option>
<?php
while ($atmrow = mysqli_fetch_row($atm)) {
    ?>
<option value="<?php echo $atmrow[0]; ?>"><?php echo $atmrow[0]; ?></option>
<?php
}
?>
</select>
-->
</td>
</tr>

<tr><td colspan="4">
<div id="asset_div"></div>
</td></tr>
<tr>
<td width="168" height="35">Buy Back: </td>
<td width="421" colspan="3"><input type="checkbox" name="buybk" id="buybk" value="1" onclick="showdesc(this.id);" /></td>
</tr>
<tr >
<td colspan="4"><div id="buybktr" style="display:none">Description:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <textarea name="buybkdesc" id="buybkdesc"/></textarea></td>
</tr>
<tr>
<td height="35">Preffered Date : </td><td colspan="3"><input type="text" name="adate" id="adate" onclick="displayDatePicker('adate');" value="<?php echo date('d/m/Y'); ?>" /></td>
</tr>

<tr>
<td height="35">Requirement : </td>
<td colspan="3"><textarea rows="4" cols="28" name="prob" id="prob"></textarea></td>
</tr>

<tr>
<td height="35">Contact Person : </td>
<td colspan="3"><input type="text" name="cname" id="cname"/></td>
</tr>

<tr>
<td height="35">Contact : </td>
<td colspan="3"><input type="text" name="cphone" id="cphone"/></td>
</tr>

<tr>
<td height="35">Email : </td>
<td colspan="3"><input type="text" name="cemail" id="cemail"/></td>
</tr>

<tr>
<td colspan="4" height="35"><input type="submit" value="submit" class="readbutton" /><input type="hidden" name="autoid" value="<?php echo $atmid; ?>" /></td>
</tr>
</table>
</div>
</form>

</div>
</center>
</body>
</html>
<?php ?>
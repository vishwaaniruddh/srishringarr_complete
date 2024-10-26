<?php
include "access.php";
include 'config.php';
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New Temporary Site</title>
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
//=================Branch
if(branch_avo.value=="")
{
	alert("Please Enter Branch.");
	branch_avo.focus();
	return false;
}
 var numbers = /^[0-9]+$/;
var namePattern = /^[A-Za-z()_ ]/;
if(cust.value==0)
{
	alert("Please Select Customer.");
	cust.focus();
	return false;
}

if(atmid.value==0)
{
	alert("Please Enter Atmid.");
	atmid.focus();
	return false;
}
if(bank.value==0)
{
	alert("Please Enter Bank Name.");
	bank.focus();
	return false;
}
if(area.value==0)
{
	alert("Please Enter Area.");
	area.focus();
	return false;
}
if(city.value==0)
{
	alert("Please Enter City.");
	city.focus();
	return false;
}


if(state.value==0)
{
	alert("Please Enter State.");
	state.focus();
	return false;
}
if(address.value==0)
{
	alert("Please Enter Address.");
	address.focus();
	return false;
}
if(type_call.value=="service"){
			if(prob.value==0)
			{
				alert("Please Enter Requirements.");
				prob.focus();
				return false;
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
			/*if(appby.value=='')
			{
				alert("Please specify who has approved to log this call.");
				appby.focus();
				return false;
			}
			if(how.value==0)
			{
				alert("Please Enter Reference.");
				how.focus();
				return false;
			}*/
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


//=========atm id data
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
	 document.getElementById('asset_div').innerHTML = s;
    }
  }
   var cust=document.getElementById('cust').value;
    var po=document.getElementById('po').value;
  var ref=document.getElementById('ref_id').value;

 //////alert("get_data.php?cust="+cust+"&po="+po+"&ref="+ref);

xmlhttp.open("GET","get_data.php?cust="+cust+"&po="+po+"&ref="+ref,true);

xmlhttp.send();
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
	xmlhttp.open("GET","get_state_br.php?brid="+brid,true);
	xmlhttp.send();
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
  xmlHttp.open("GET", "get_asset.php?po="+str, true);

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
  xmlHttp.open("GET", "get_po.php?cust="+str, true);

  xmlHttp.send(null);

}

function HandleResponse4(response)

{

  document.getElementById('po_no').innerHTML = response;

}
function filladd(id)
{
if(document.getElementById('address').value=='')
document.getElementById('address').value=id.value;
else
document.getElementById('address').value=document.getElementById('address').value+","+id.value;
}
function fill()
{
//alert("hii");
//alert(document.getElementById('cc').value);
document.getElementById('ccemail').innerHTML='';
document.getElementById('ccemail').innerHTML=document.getElementById('cc').value;
}


//==================== Disable fields========================

function pmdisable(d){
	//alert(d);
	if(d=='pm'){
		// alert("hi");
		document.getElementById('prob').disabled=true;
		document.getElementById('cc').disabled=true;
		document.getElementById('ccemail').disabled=true;
		document.getElementById('appby').disabled=true;
		document.getElementById('how').disabled=true;
		document.getElementById('cemail').disabled=true;



		}else{
			document.getElementById('prob').disabled=false;
			document.getElementById('cc').disabled=false;
			document.getElementById('ccemail').disabled=false;
			document.getElementById('appby').disabled=false;
			document.getElementById('how').disabled=false;
			document.getElementById('cemail').disabled=false;
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
	xmlhttp.open("GET","get_state_br.php?brid="+brid,true);
	xmlhttp.send();
}
</script>


</head>

<body>
<center>
<?php include "menubar.php";?>

<h2>New Temporary Site Alert</h2>



<form action="processtempsite.php" method="post" name="form" onSubmit="return validate1(this)">

<br/>
<br /><br />


<table width="500">
<tr>
<td width="115" height="35">Subject : </td>
<td width="305">
<input type="text" name="sub" id="sub" />
</td>
</tr>
<tr>
<td width="115" height="35">Client Docket Number : </td>
<td width="305">
<input type="text" name="doc" id="doc" />
</td>
</tr>
  <tr><td width="155">
Select Customer : </td><td width="131">

<select name="cust" id="cust">
<option value="0">select</option>
<?php
$client = "select cust_id,cust_name from customer where 1";
if ($_SESSION['designation'] == '6') {
    //echo "select client from clienthandle where logid='".$_SESSION['logid']."'";
    $cust = mysqli_query($conc,"select client from clienthandle where logid='" . $_SESSION['logid'] . "'");
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

$qry1 = mysqli_query($conc,$client);
while ($row = mysqli_fetch_row($qry1)) {
    ?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>


<?php }?>
</select>
</td></tr>
<tr>
<td width="59"> PO No :</td>
<td width="180" id="po_no">
<input type="text" name="po" id="po" /><input type="hidden" name="cdate" value="<?php echo date('Y-m-d h:i:s'); ?>" /></td>

</tr>

<tr>
<td width="115" height="35">Site / Sol / ATM Id : </td>
<td width="305">
<input type="text" name="atmid" id="atmid" />
</td>
</tr>
<tr>
<td width="115" height="35">End User : </td>
<td width="305">
<input type="text" name="bank" id="bank" />
</td>
</tr>
<tr>
<td width="115" height="35">Area : </td>
<td width="305">
<input type="text" name="area" id="area" onblur="filladd(this);" />
</td>
</tr>
<tr>
<td width="115" height="35">City : </td>
<td width="305">
<input type="text" name="city" id="city" onblur="filladd(this);" />
</td>
</tr>

<tr>
<td width="115" height="35">Pincode : </td>
<td width="305">
<input type="text" name="pincode" id="pincode" onblur="filladd(this);" />
</td>
</tr>

<!----============Branch============= -->
<tr>
<td width="115" height="35">Branch : </td>
<td width="305">
<!--<input type="text" name="state" id="state" onblur="filladd(this);" />-->
<?php
$selbr = "select * from avo_branch where 1";
if ($_SESSION['branch'] != 'all') {
    $selbr .= " and id in(" . $_SESSION['branch'] . ") ";
}

$selbr .= " order by id ASC";
//echo $selbr;
$selbr2 = mysqli_query($conc,$selbr)
?>
        <select name="branch_avo" id="branch_avo" onchange="pick_state(this.value);">

		<?php if ($_SESSION['branch'] == 'all') {?>
        <option value="">Branch</option>
        <?php }?>

		<?php

while ($branch1 = mysqli_fetch_array($selbr2)) {
    ?>
        <option value="<?php echo $branch1[0]; ?>"><?php echo $branch1[1]; ?></option>
        <?php
}
?>
        </select>





</td>
</tr>

<tr>
<td width="115" height="35">State : </td>
<td width="305">
<div id="mystate">

<?php

$stqry = "select state,state_id from state where 1";

if ($_SESSION['branch'] != 'all') {
    $stqry .= " and branch_id= '" . $_SESSION['branch'] . "'";
}
$stqry = "select state,state_id from state where 1";
if ($_SESSION['branch'] != 'all') {
    $stqry .= " and branch_id= '" . $_SESSION['branch'] . "'";
}

?>
	<select name="state" id="state" >
	<option value="0">-select State-</option>
	<?php
$stateqry = mysqli_query($stqry);
while ($sttro = mysqli_fetch_array($stateqry)) {
    ?>
    <option value="<?php echo $sttro[0]; ?>"><?php echo $sttro[0]; ?></option>
    <?php
}
?>
     </select>

</div>
</td>
</tr>


<tr>
<td width="115" height="35">Address : </td>
<td width="305">
<textarea name="address" id="address" rows="4" cols="28" /></textarea>
</td>
</tr>

<tr>
<td width="115" height="35">Select Type: </td>
<td width="305">
<select name="type" id="type">
<option value="temporary">Select</option>
<option value="addon">Addon to AMC</option>
<option value="amc">AMC Site</option>
<option value="pcb">Call Basis</option>
<option value="warranty">Warranty Site</option>
</select>
</td>
</tr>
<tr>
<td height="35">Type Of Call : </td>
<td colspan="3">
<select name="type_call" id="type_call"> <!--onchange="pmdisable(this.value);"> -->
<option value="service">Service Call</option>
<option value="pm">PM Call</option>
<option value="dere"> De-Re Installation</option>
</select>
</td>
</tr>

<tr>
<td height="35">Requirement : </td>
<td><textarea rows="4" cols="28" name="prob" id="prob"></textarea></td>
</tr>

<tr>
<td height="35">Contact Person : </td>
<td><input type="text" name="cname" id="cname"/></td>
</tr>

<tr>
<td height="35">Contact : </td>
<td><input type="text" name="cphone" id="cphone"/></td>
</tr>

<tr>
<td height="35">Email : </td>
<td><input type="text" name="cemail" id="cemail"/></td>
</tr>
<tr>
<td height="35">CC Email : </td>
<td>
<?php
$cl = mysqli_query($conc,"select client from clienthandle where logid in (select srno from login where username='" . $_SESSION['user'] . "')");
$clnt = array();
while ($clntr = mysqli_fetch_array($cl)) {
    $clnt[] = $clntr[0];
}

$client = implode(",", $clnt);
$client = str_replace(",", "','", $client);

$cc = mysqli_query($conc,"select e.email,c.cust_name,e.bank from emailid e,customer c where e.custid=c.cust_id and e.status=0 and c.cust_name in ('$client') order by c.cust_name,e.bank ASC");
?>
<select name='cc' id='cc' onchange="fill();">
<option value="">Select CC Emails</option>
<?php
while ($ccro = mysqli_fetch_array($cc)) {
    ?>
<option value="<?php echo $ccro[0]; ?>"><?php echo $ccro[1] . " - " . $ccro[2]; ?></option>
<?php
}
?>
</select>
<textarea name="ccemail" id="ccemail"  rows=5 cols=25></textarea></td>
</tr>
<tr><td>Approved By:</td><td colspan="3"><input type="text" name="appby" id="appby" value="" /></td></tr><tr>
<td valign="top">Reference:</td><td><textarea name="how" id="how" /></textarea>

</td>

</tr>
<tr>
<td colspan="2" height="35"><input type="submit" name="cmdsubmit" value="submit" class="readbutton" /></td>
</tr>
</table>

</form>


</center>
</body>
</html>
<?php
include("access.php");
include('config.php');
//echo $_SESSION['user'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user'];  ?></title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<link href="../menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="../datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="../datepicker/datepick_js.js" type="text/javascript"></script>
<!--validation-->
<script>

function CheckNumeric(e) {
     console.log(e.which)
        if (window.event) // IE
        {
            if ((e.keyCode <48 || e.keyCode > 57) & e.keyCode != 8 && e.keyCode != 44) {
                event.returnValue = false;
                return false;
                console.log(false)
            }
        }
        else { // Fire Fox
            if ((e.which <48 || e.which > 57) & e.which != 8 && e.which != 44) {
                e.preventDefault();
                return false;
               
            }
        }
    } 
    
//=============================================
function validate(form1){
	
 with(form1)
 {
	 
	var numbers = /^[0-9]+$/;
/*	/^\d+(?:\.\d{0,2})?(?:,\s*\d+(?:\.\d{0,2})?)*,?$/gm
    if(whatsno.value !="")
    var what = whatsno.value
	var pattern = /^(?:\s*\d{15}\s*(?:,|$))+$/;
        if(pattern.test($("#what").val())){
        alert("Correct");
        return false;
        } else {
         alert("Wrong");
    	whatsno.focus();
		return false;
        }
*/
 
	//alert("atm"+ref.value);
	if(ref.value=="")
	{	
		alert("Please Enter ATM ID");
		ref.focus();
		return false;
	}
	//alert("bank"+bank.value);
	if(bank.value=="")
	{	
		alert("Please Enter Bank Name");
		bank.focus();
		return false;
	}

	if(branch.value=="")
	{	
		alert("Please Enter Branch");
		branch.focus();
		return false;
	}

	if(add.value=="")
	{	
		alert("Please Enter address");
		add.focus();
		return false;
	}


	if(alert_type.value=="")
	{	
		alert("Please Select Call Type");
		alert_type.focus();
		return false;
	}

	if(prob.value=="")
	{	
		alert("Please Enter problem");
		prob.focus();
		return false;
	}
	//alert("cname"+bank.value);
	if(cname.value=="")
	{	
		alert("Please Enter Contact Person");
		cname.focus();
		return false;
	}
	//alert("cphone"+cphone.value);
	if(cphone.value=="")
	{	
		alert("Please Enter Contact");
		cphone.focus();
		return false;
	}

	if(cemail.value=="")
	{	
		alert("Please Enter cemail");
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
function atmid(id,type)
{

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
		//alert(xmlhttp.responseText);
    var s=xmlhttp.responseText;
    //alert(s);
		var s1=s.split('#');
		///alert(s1[0]+"/"+s1[1]);
		//document.getElementById("cust").value=s1[0];
		document.getElementById("bank").value=s1[1];
		document.getElementById("state").value=s1[2];
		document.getElementById("city").value=s1[3];
		document.getElementById("add").value=s1[4];
		document.getElementById("pin").value=s1[5];
		document.getElementById("area").value=s1[6];
		//document.getElementById("add").value=s1[7];
   //alert(s1[4]);
    }
  }

xmlhttp.open("GET","../get_data2.php?atm="+id+"&type="+type,true);
//alert("get_data2.php?atm="+id+"&type="+type);
xmlhttp.send();
}

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


function HandleResponse4(response)

{

  document.getElementById('asset_div').innerHTML = response;

}
///////get po no.
function Po_no()

{ 
  var xmlHttp = getXMLHttp();
 

  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
//alert(xmlHttp.responseText);
      HandleResponse4(xmlHttp.responseText);
    }
  }

 //alert("hi2");

  //alert("getarea.php?ccode="+document.forms[0].city.value);
var str=document.getElementById('cust').value;
//alert("get_po2.php?cust="+str);
  xmlHttp.open("GET", "../get_po2.php?cust="+str, true);
//alert("get_po2.php?cust="+str);
  xmlHttp.send(null);

}

function HandleResponse4(response)

{
//alert(response);
  document.getElementById('po_no').innerHTML =  response;

}

function GetRef(id,type)
{ 

//alert(id);
  var xmlHttp = getXMLHttp();
 

  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
if(xmlHttp.responseText==0)
{
alert("Invalid Refernce ID");
document.getElementById(id).value='';
}
else
{
//alert(xmlHttp.responseText);
var str=xmlHttp.responseText.split("***");
//===================for customer selection Start =====================
var v;
v=str[0];
//alert(v);
for (i = 0; i < document.getElementById("cust").length; ++i){
	//alert(i);
    if (document.getElementById("cust").options[i].value == v){
		//alert(i);
     document.getElementById("cust").selectedIndex = i;
	
    }
}

var b;
b=str[10];
//alert(b);
for (i = 0; i < document.getElementById("branch").length; ++i){
		//alert(i);
    	if (document.getElementById("branch").options[i].value == b){
		//alert(i);
     	document.getElementById("branch").selectedIndex = i;
	
    	}
	}
//==for Branch selection End========================================	

	var mySelect = document.getElementById('po_no'),
    newOption = document.createElement('option');

	newOption.value = str[1];

// Not all browsers support textContent (W3C-compliant)
// When available, textContent is faster (see http://stackoverflow.com/a/1359822/139010)
if (typeof newOption.textContent === 'undefined')
{
    newOption.innerText = str[1];
}
else
{
    newOption.textContent = str[1];
}

mySelect.appendChild(newOption);

var atmsel= document.getElementById('ref'),
    newOption2 = document.createElement('option');

newOption2.value = id;
if(str[2]=='')
{
alert("Site ID not present");
document.getElementById('submit').disabled=true;
}
// Not all browsers support textContent (W3C-compliant)
// When available, textContent is faster (see http://stackoverflow.com/a/1359822/139010)
if (typeof newOption2.textContent === 'undefined')
{
    newOption2.innerText = str[2];
}
else
{
    newOption2.textContent = str[2];
}

atmsel.appendChild(newOption2);
		document.getElementById("bank").value=str[3];
		document.getElementById("state").value=str[4];
		document.getElementById("city").value=str[5];
		document.getElementById("add").value=str[6];
		document.getElementById("pin").value=str[7];
		document.getElementById("area").value=str[8];	
		document.getElementById("tp").value=type;
		document.getElementById("ccemail").innerHTML=str[9];	
//alert("done");
}
      //HandleResponse4(xmlHttp.responseText);
    }
  }


  xmlHttp.open("GET", "get_ref3.php?ref="+id+"&type="+type, true);
//alert("get_ref3.php?ref="+id);
  xmlHttp.send(null);

}


</script>

<script type="text/javascript">

function history(id,type)
{

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
	//	alert(xmlhttp.responseText);
		var str=xmlhttp.responseText.split("##");
	//alert(str[0]);	
  //  document.getElementById('searchbar').innerHTML=str[0];
//	alert(xmlhttp.responseText);
	if(str[1]=='1')
	{
	alert("Call is still open for this Site");
	document.getElementById('searchbar').innerHTML=str[0];
	document.getElementById('submit').disabled=true;
	}
	else if(str[2]>='7')
	{
	alert("#Y:More than 6 Multiple time Issues Arised in a Year");
	document.getElementById('searchbar').innerHTML=str[0];
	document.getElementById('submit').disabled=true;
	}
	else if(str[3]>='1')
	{
	alert("#R: Regret! Call closed within 2 Days. Reopen the Call");
	document.getElementById('searchbar').innerHTML=str[0];
	document.getElementById('submit').disabled=true;
	}
    }
  }

xmlhttp.open("get","gethistory_new.php?id="+id+"&type="+type,false);

xmlhttp.send();
}


function searchval(what,val,call)
{
	//alert(what+" "+val);
//	alert(document.getElementById(what).value);
if(document.getElementById(what).value=='' ||document.getElementById(val).value=='' )
{
alert("Please provide both the data for searching");
}
else
{
	//alert("hi");
document.getElementById('searchbar').innerHTML="<img src=loader.gif height=20px width=20px>";
var what=document.getElementById(what).value;
var txt=document.getElementById(val).value;
//alert(what+" "+txt);
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
	//	alert(xmlhttp.responseText);
    document.getElementById('searchbar').innerHTML=xmlhttp.responseText;
    }
  }


xmlhttp.open("get","servicesearch.php?val="+txt+"&what="+what+"&calltype="+call,false);

xmlhttp.send();
}
}

function fill()
{
//alert("hii");
//alert(document.getElementById('cc').value);
document.getElementById('ccemail').innerHTML='';
document.getElementById('ccemail').innerHTML=document.getElementById('cc').value;
}

//=>>>>>>>>>>>>>>>>>>>>>>>>>For Whatsapp No.>>>>>>>>>>>>
function getno(val)
{ 
//alert(val);
  var xmlHttp = getXMLHttp();
  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
   // alert(xmlHttp.responseText);
    if(xmlHttp.responseText==0)
    alert("sorry, your session has expired");
    else
document.getElementById('whatsno').innerHTML=xmlHttp.responseText;
      //HandleResponse3(xmlHttp.responseText);
    }
  }
  xmlHttp.open("GET", "get_whatsno.php?cust="+val, true);
  xmlHttp.send();
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
} 
function DDL_Problem(){

var ddlprob=document.getElementById('ddl_prob').value;

 //$("#prob").attr("value", " ");
if(ddlprob=="Others" || ddlprob=="Chronic Issue"){ 

document.getElementById('prob').innerHTML=ddlprob;
  document.getElementById('prob').readOnly = false;
}else{

 document.getElementById('prob').innerHTML=ddlprob; 
  document.getElementById('prob').readOnly = true;
}
}

</script>
</head>

<body <?php if(isset($_GET['id'])){ ?>  onload="GetRef('<?php echo $_GET['id'] ?>','<?php echo $_GET['type'] ?>');history('<?php echo $_GET['id'] ?>','<?php echo $_GET['type'] ?>')" <?php } ?>>
<center>
<?php include("menubar.php"); ?>

<h2>service Alert-Client</h2>
  

<div id="header">

<table border="0" cols="res">
    
<tr><td valign="top">

<?php

       if($_SERVER['REQUEST_METHOD']=='POST')
       {
               $dt=date("Y-m-d H:i:s");
 
        if($sql)
       {
       
    echo "Data added successfully<br><br><a href='service1.php'>New Service</a>";
 
       }
       else
       {
            ?>
            <div class="errors">
            <?php
         $service->ShowErrors();      

   //  echo "hii";
       ?></div>
       <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" name="form" onsubmit="return validate(this)" >

<div id="" style="display:block;">
<table border="0" >

<tr>
<td height="35" >Subject: <input type="text" name="sub" id="sub"  value="<?php echo $_POST['sub']; ?>" /></td>
<td colspan="3">Client Docket number:



<select name="docket" id="docket">
<option value="">select</option>
<option value="Operational">Operational </option>
<option value="Non Operational">Non Operational</option>
<option value="Chronic">Chronic</option>

</select>

</td>
</tr>
<tr><td width="110">
Select Customer : </td>
<td width="190">
<select name="cust" id="cust" onchange="Po_no();" style="width:150px">

<?php
$client="select cust_id,cust_name from customer where 1";
    if($_SESSION['designation']=='6'){
    //echo "select client from clienthandle where logid='".$_SESSION['logid']."'";
    $cust=mysqli_query($con1,"select client from clienthandle where logid='".$_SESSION['logid']."'");
    $cc=array();
    while($custr=mysqli_fetch_array($cust))
    $cc[]=$custr[0];
    
    $ccl=implode(",",$cc);
    $ccl=str_replace(",","','",$ccl);
    $ccl="'".$ccl."'";
    $client.=" and cust_name in($ccl)";
    
    }
    $client.=" order by cust_name ASC";
$qry1=mysqli_query($con1,$client);
while($row=mysqli_fetch_row($qry1)){
?>
<option value="<?php echo $row[0]; ?>" <?php  if(($_POST['cust'])==$row[0]){ ?>
selected="selected" <?php }  ?>><?php echo $row[1]; ?></option>


<?php } ?>
</select>

</td><td width="93">Select PO NO:	
<?php 
//echo $_POST['po'];
//$asst=	explode("####",$_POST['po']);
//echo $asst[0];
?>
<select name="po" onchange="PO(this.value);" id="po_no"><option value=''>Select PO</option>

<option value="<?php   echo $_POST['po'];  ?>" selected="selected"><?php  echo $_POST['po']; ?></option>
<?php  ?>
</select>

</td></tr>


<input type="hidden" name="cdate" value="<?php echo date('Y-m-d'); ?>" />

<tr><td>Site / ATM ID</td><td colspan="3" id="reference">
<?php

if($_POST['type']=="amc")
$st="select atmid from Amc where amcid='".$_POST['ref']."'";
elseif($_POST['type']=="site")
$st="select atm_id from atm where track_id='".$_POST['ref']."'";

//echo $st;
?>
<select name="ref" id="ref" onchange="">
<?php 
$today=new DateTime(date("Y-m-d"));
$pcb='';
$at='';

$qry=mysqli_query($con1,$st);
$roqry=mysqli_fetch_row($qry);
?>
<option value="<?php  echo $_POST['ref']; ?>" selected="selected"><?php  echo $roqry[0]; ?></option>

</select></td></tr>


<tr>
<td height="35">Bank Name:</td>
<td colspan="2"><input type="text" name="bank" id="bank" value="<?php if(isset($_POST['bank'])){ echo $_POST['bank']; } ?>" readonly /></td>
</tr>

<tr>
<td height="35">State Name:</td>
<td colspan="2"><input type="text" name="state" id="state" value="<?php if(isset($_POST['state'])){ echo $_POST['state']; } ?>" readonly /></td>
</tr>

<!----================Branch=======----------->
<tr>
<td height="35">Branch:</td>
<td colspan="3">
<?php 
include ("config.php");
 ?>
<select id="branch" name="branch">

<option value="">Select</option>
<?php

$qrystate=mysqli_query($con1,"select * from avo_branch");
while($qrystate1=mysqli_fetch_row($qrystate)){
?>

<option value="<?php echo $qrystate1[0]; ?>" <?php  if(($_POST['branch'])==$qrystate1[0]){ ?>
selected="selected" <?php }  ?>><?php echo $qrystate1[1]; ?></option>

<?php } ?>

</select>
</td>
</tr>

<tr>
<td height="35">City Name:</td>
<td colspan="2"><input type="text" name="city" id="city" value="<?php if(isset($_POST['city'])){ echo $_POST['city']; } ?>" readonly /></td>
</tr>
<tr>
<td height="35">Address:</td>
<td colspan="2"><textarea name="add" id="add"  readonly rows=5 cols=25 /> <?php if(isset($_POST['add'])){ echo $_POST['add']; } ?></textarea></td>
</tr>
<tr>
<td height="35">Pin Code:</td>
<td colspan="2"><input type="text" name="pin" id="pin" value="<?php if(isset($_POST['pin'])){ echo $_POST['pin']; } ?>" readonly /></td>
</tr>
<tr>
<td height="35">Area Name:</td>
<td colspan="2"><input type="text" name="area" id="area" value="<?php if(isset($_POST['area'])){ echo $_POST['area']; } ?>" readonly /></td>
</tr>


<tr>
<td height="35">Call Log type:</td>

<td><select id="alert_type" name="alert_type" required>
<option value="">Select Problems</option>

<option value="service">Service Call</option>
<option value="pm">PM Call </option>
<option value="dere">De-Re Installation</option>
</select></td>

</tr>
<!-- <tr>
<td height="35">Alert Date : </td>
<td><input type="text" name="adate" id="adate" onclick="displayDatePicker('adate');" value="<?php if(isset($_POST['adate'])){ echo $_POST['adate']; } else { echo date('d/m/Y'); } ?>" /></td>
</tr>-->

<tr>
<td height="35">Problem : </td>
<td colspan="3"><textarea rows="4" cols="28" name="prob" id="prob"> <?php if(isset($_POST['prob'])){ echo $_POST['prob']; } ?></textarea></td>
</tr>

<tr>
<td height="35">Contact Person : </td>
<td colspan="3"><input type="text" name="cname" id="cname" value="<?php if(isset($_POST['cname'])){ echo $_POST['cname']; } ?>"/></td>
</tr>

<tr>
<td height="35">Contact : </td>
<td colspan="3"><input type="text" name="cphone" id="cphone" value="<?php if(isset($_POST['cphone'])){ echo $_POST['cphone']; } ?>"/></td>
</tr>

<tr>
<td height="35">Email : </td>
<td colspan="3"><input type="text" name="cemail" id="cemail" value="<?php if(isset($_POST['cemail'])){ echo $_POST['cemail']; } ?>"/></td>
</tr>

<tr>
<td height="35">WhatsApp Group: </br> Enter only whatsApp numbers</td>
<td colspan="3"><?php

$cl=mysqli_query($con1,"select client from clienthandle where logid in (select srno from login where username='".$_SESSION['user']."')");
$clnt=array();
while($clntr=mysqli_fetch_array($cl))
$clnt[]=$clntr[0];
$client=implode(",",$clnt);
$client=str_replace(",","','",$client);
include ("config.php");
$whatcc=mysqli_query($con1,"select a.id,a.groupname, b.cust_name from whatsapp_groupname a,customer b where a.cust_id=b.cust_id and a.status=1 and b.cust_name in ('$client') and a.type='service' order by b.cust_name,a.groupname ASC");

$whatarray=array();
?>
<input type="checkbox" name="whatsgrp" id="whatsgrp" checked>
<select name='whatsgroup' id='whatsgroup' onchange="getno(this.value);">
<option value=""> Select Groups</option>
<?php
while($whatsrow=mysqli_fetch_row($whatcc))
{
?>
<option value="<?php echo $whatsrow[0]; ?>"><?php echo $whatsrow[2]." - ".$whatsrow[1]; ?></option>
<?php
}
?>
</select>

<textarea name="whatsno" id="whatsno"  onkeypress="CheckNumeric(event);" rows=3 cols=25><?php if(isset($_POST['whatsno'])){ echo $_POST['whatsno']; } ?></textarea></td>
</tr>



<tr>
<td height="35">CC Email : </td>
<td colspan="3"><?php

$cl=mysqli_query($con1,"select client from clienthandle where logid in (select srno from login where username='".$_SESSION['user']."')");
$clnt=array();
while($clntr=mysqli_fetch_array($cl))
$clnt[]=$clntr[0];

$client=implode(",",$clnt);
$client=str_replace(",","','",$client);
include ("config.php");
//echo "select e.email,c.cust_name,e.bank from emailid e,customer c where e.custid=c.cust_id and e.status=0 and c.cust_name in ('$client') order by c.cust_name,e.bank ASC";
$ccc=mysqli_query($con1,"select e.email,c.cust_name,e.bank from emailid e,customer c where e.custid=c.cust_id and e.status=0 and c.cust_name in ('$client') order by c.cust_name,e.bank ASC");
if(!$ccc)
echo mysqli_error();
?>
<input type="checkbox" name="sendmail" id="sendmail" checked>
<select name='cc' id='cc' onchange="fill();">
<option value="">Select CC Emails</option>
<?php
while($ccro=mysqli_fetch_array($ccc))
{
?>
<option value="<?php echo $ccro[0]; ?>" <?php if($_POST['cc']){ echo "selected";} ?>><?php echo $ccro[1]." - ".$ccro[2]; ?></option>
<?php
}
?>
</select><textarea name="ccemail" id="ccemail"  rows=5 cols=25><?php if(isset($_POST['ccemail'])){ echo $_POST['ccemail']; } ?></textarea></td>
</tr>
<div id="pcbdiv" style="display:none">
<tr><td>Approved By:</td><td colspan="3"><input type="text" name="appby" id="appby" value="<?php if(isset($_POST['appby'])){ echo $_POST['appby']; } ?>" /></td></tr><tr>
<td valign="top">Refrence:</td><td colspan="3"><textarea name="how" id="how" /><?php if(isset($_POST['how'])){ echo $_POST['how']; } ?></textarea>
<input type="hidden" name="pcbpres" id="pcbpres" value="<?php if(isset($_POST['pcbpres'])){ echo $_POST['pcbpres']; } ?>" />
<input type="hidden" name="crby" id="crby" value="<?php echo $_POST['crby']; ?>" />
</td>

</tr></div>	
<tr>
<td height="35" colspan="4"><input type="submit" value="submit" class="readbutton" id="submit" /></td>
</tr>

</table>
</div>
</form>
       <?php
      

       }
       }
       else
       {
      
 include("config.php");
 
	?>
<!---//////////////////form submit------------------->
<form action="processservice_temp.php" method="post" name="form1" onsubmit="return validate(this);">
    <input type="hidden" id="type" name="type" value="<?php echo $_GET['type']; ?>" />

<div id="" style="display:block;">
<table border="0">
<tr>
<td height="35" >Subject: <input type="text" name="sub" id="sub" /></td>
<td colspan="3">Site Status:

<select name="docket" id="docket" required>
<option value="">select</option>
<option value="Operational">Operational </option>
<option value="Non Operational">Non Operational</option>
<option value="Chronic">Chronic</option>

</select>

</td>
</tr>
<tr><td width="110">
Select Customer : </td>
<td width="190">
<?php
$client="select cust_id,cust_name from customer order by cust_name ASC";
 
?>
<select name="cust" id="cust" onchange="Po_no();" style="width:150px">
<option value="">select</option>
<?php

$qry1=mysqli_query($con1,$client);
while($row=mysqli_fetch_row($qry1)){
?>
<option value="<?php echo $row[0]; ?>" ><?php echo $row[1]; ?></option>


<?php } ?>
</select>

</td><td>Select PO NO:	
<select name="po" onchange="PO(this.value);" id="po_no">
<?php if(isset($_POST['po'])){ 
//$asst=	explode("####",$_POST['po']);
?>
<option value="<?php   echo $_POST['po']; ?>"><?php  echo $_POST['po']; ?></option>
<?php } ?>
</select>

</td></tr>


<input type="hidden" name="cdate" value="<?php echo date('Y-m-d'); ?>" />

<tr><td>Site / ATM ID</td><td colspan="3" id="reference">
<select name="ref" id="ref" onchange="">
<?php if(isset($_POST['ref'])){ 
?>
<option value="<?php  echo $_POST['ref']; ?>"><?php  echo $_POST['ref']; ?></option>
<?php } ?>
</select></td></tr>


<tr>
<td height="35">Bank Name:</td>
<td colspan="3"><input type="text" name="bank" id="bank" value="<?php if(isset($_POST['bank'])){ echo $_POST['bank']; } ?>" readonly /></td>
</tr>

<tr>
<td height="35">State Name:</td>
<td colspan="3"><input type="text" name="state" id="state" value="<?php if(isset($_POST['state'])){ echo $_POST['state']; } ?>" readonly /></td>
</tr>

<!----================Branch=======----------->
<tr>
<td height="35">Branch:</td>
<td colspan="3">
<?php 
include ("config.php");
?>
<select id="branch" name="branch">

<option value="">Select</option>
<?php
echo "select * from avo_branch";
$qrystate=mysqli_query($con1,"select * from avo_branch");
while($qrystate1=mysqli_fetch_row($qrystate)){
?>

<option value="<?php echo $qrystate1[0]; ?>" <?php  if(($_POST['branch'])==$qrystate1[0]){ ?>
selected="selected" <?php }  ?>><?php echo $qrystate1[1]; ?></option>

<?php } ?>

</select>
</td>
</tr>
<tr>
<td height="35">City Name:</td>
<td colspan="3"><input type="text" name="city" id="city" value="<?php if(isset($_POST['city'])){ echo $_POST['city']; } ?>" readonly /></td>
</tr>
<tr>
<td height="35">Address:</td>
<td colspan="3"><textarea name="add" id="add"  readonly rows=5 cols=25 /> <?php if(isset($_POST['add'])){ echo $_POST['add']; } ?></textarea></td>
</tr>
<tr>
<td height="35">Pin Code:</td>
<td colspan="3"><input type="text" name="pin" id="pin" value="<?php if(isset($_POST['pin'])){ echo $_POST['pin']; } ?>" readonly /></td>
</tr>
<tr>
<td height="35">Area Name:</td>
<td colspan="3"><input type="text" name="area" id="area" value="<?php if(isset($_POST['area'])){ echo $_POST['area']; } ?>" readonly /></td>
</tr>
<tr>
<td height="35">Call Log type:</td>

<td><select id="alert_type" name="alert_type" required>
<option value="">Select Problems</option>

<option value="service">Service Call</option>
<option value="pm">PM Call </option>
<option value="dere">De-Re Installation</option>
</select></td>

</tr>

<tr>
<td height="35">Problem : </td>



<td><select id="ddl_prob" name="ddl_prob" onchange="DDL_Problem()" required>
<option value="">Select Problems</option>

<option value="UPS Down">UPS Down</option>
<option value="Battery Backup issue">UPS Backup issue </option>
<option value="UPS Beap Sound">UPS Beap Sound</option>
<option value="Servo Issue">Servo Issue</option>
<option value="IT Not Working">IT Not Working</option>
<option value="UPS Output abnormal">UPS Output abnormal</option>
<option value="Solar Issue">Solar Issue</option>
<option value="Chronic Issue">Chronic Issue</option>
<option value="Others">Others</option>
</select></td>



<td colspan="3"><textarea rows="4" cols="28" name="prob" id="prob" readonly> <?php if(isset($_POST['prob'])){ echo $_POST['prob']; } ?></textarea></td>
</tr>

<tr>
<td height="35">Contact Person : </td>
<td colspan="3"><input type="text" name="cname" id="cname"  maxlength="20" value="<?php if(isset($_POST['cname'])){ echo $_POST['cname']; } ?>"/></td>
</tr>

<tr>
<td height="35">Contact : </td>
<td colspan="3"><input type="text" name="cphone" id="cphone" onkeypress="return isNumber(event)" maxlength="10" value="<?php if(isset($_POST['cphone'])){ echo $_POST['cphone']; } ?>"/></td>
</tr>

<tr>
<td height="35">Email : </td>
<td colspan="3"><input type="text" name="cemail" id="cemail" value="<?php if(isset($_POST['cemail'])){ echo $_POST['cemail']; } ?>"/></td>
</tr>

<tr>
<td height="35">WhatsApp Group:</br> Enter only whatsApp numbers </td>
<td colspan="3"><?php

$cl=mysqli_query($con1,"select client from clienthandle where logid in (select srno from login where username='".$_SESSION['user']."')");
$clnt=array();
while($clntr=mysqli_fetch_array($cl))
$clnt[]=$clntr[0];
$client=implode(",",$clnt);
$client=str_replace(",","','",$client);
include ("config.php");
$whatcc=mysqli_query($con1,"select a.id,a.groupname, b.cust_name from whatsapp_groupname a,customer b where a.cust_id=b.cust_id and a.status=1 and b.cust_name in ('$client') and a.type='service' order by b.cust_name,a.groupname ASC");

$whatarray=array();
?>
<input type="checkbox" name="whatsgrp" id="whatsgrp" checked>
<select name='whatsgroup' id='whatsgroup' onchange="getno(this.value);">
<option value=""> Select Groups</option>
<?php
while($whatsrow=mysqli_fetch_row($whatcc))
{
?>
<option value="<?php echo $whatsrow[0]; ?>"><?php echo $whatsrow[2]." - ".$whatsrow[1]; ?></option>
<?php
}
?>
</select>

<textarea name="whatsno" id="whatsno" onkeypress="CheckNumeric(event);"  rows=3 cols=25><?php if(isset($_POST['whatsno'])){ echo $_POST['whatsno']; } ?></textarea></td>
</tr>


<!--      Break -->
<tr>
<td height="35">CC Email : </td>
<td colspan="3"><?php

$cl=mysqli_query($con1,"select client from clienthandle where logid in (select srno from login where username='".$_SESSION['user']."')");
$clnt=array();
while($clntr=mysqli_fetch_array($cl))
$clnt[]=$clntr[0];

$client=implode(",",$clnt);
$client=str_replace(",","','",$client);
include ("config.php");
//echo "select e.email,c.cust_name,e.bank from emailid e,customer c where e.custid=c.cust_id and e.status=0 and c.cust_name in ('$client') order by c.cust_name,e.bank ASC";
$ccc=mysqli_query($con1,"select e.email,c.cust_name,e.bank from emailid e,customer c where e.custid=c.cust_id and e.status=0 and c.cust_name in ('$client') order by c.cust_name,e.bank ASC");
//echo mysqli_num_rows($ccc);
/*while($ccro=mysqli_fetch_row($ccc))
{
 echo $ccro[0]." ".$ccro[1]." - ".$ccro[2];
}*/
$c=array();
?>
<input type="checkbox" name="sendmail" id="sendmail" checked>
<select name='cc' id='cc' onchange="fill();">
<option value=""> Select CC Emails</option>
<?php
while($ccro=mysqli_fetch_row($ccc))
{
?>
<option value="<?php echo $ccro[0]; ?>"><?php echo $ccro[1]." - ".$ccro[2]; ?></option>
<?php
}
?>
</select>
<?php //echo print_r($c); ?>
<textarea name="ccemail" id="ccemail"  rows=5 cols=25><?php if(isset($_POST['ccemail'])){ echo $_POST['ccemail']; } ?></textarea></td>
</tr>
<div id="pcbdiv" style="display:none">
<tr><td>Approved By:</td><td colspan="3"><input type="text" name="appby" id="appby" value="<?php if(isset($_POST['appby'])){ echo $_POST['appby']; } ?>" /></td></tr><tr>
<td valign="top">Refrence:</td><td colspan="3"><textarea name="how" id="how" /><?php if(isset($_POST['how'])){ echo $_POST['how']; } ?></textarea>
<input type="hidden" name="pcbpres" id="pcbpres" value="<?php if(isset($_POST['pcbpres'])){ echo $_POST['pcbpres']; } ?>" />

</td>

</tr></div>	
<tr>
<td height="35" colspan="4"><input type="submit" value="submit" class="readbutton" id="submit" /></td>
</tr>

</table>
</div>
</form>
      
	<?php	  
 } ?>

</td><td valign="top">

<table border="0"><tr><td>
<select name="searchby" id="searchby">
<option value="">Search By</option>
<option value="atmid">Site/Sol/ATM ID</option>
<option value="add">Address</option>

</select>
</td></tr><tr><td><input type="text" name="search" id="search" /></td></tr>
<tr><td><input type="button" name="searchbtn" id="searchbtn" value="Search" onclick="searchval('searchby','search','service');" /></td></tr>
<tr style="display:block"><td><div style=" width:208px; height:770px; overflow:auto;" id="searchbar"></div></td></tr></table></td></tr></table></div>

</center>

</body>
</html>
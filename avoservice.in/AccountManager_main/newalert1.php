<?php
include("../access.php");
include('../config.php');
//echo $_SESSION['designation'];
 $cust=$_GET['cust'];
  $atmid=$_GET['atmid'];
  $trackid=$_GET['trackid'];
  $callid=$_GET['callid'];
  
//echo "Select * from atm where atm_id='".$atmid."' and `track_id`='".$trackid."'";
//echo "select type,po,contactno,contactperson,new_email from pending_installations where id='".$callid."'";


$my1=mysql_query("select type,po,contactno,contactperson,new_email from pending_installations where id='".$callid."'");
$myrow = mysql_fetch_row($my1);
 
if($myrow[0]=="sales")
$qry="SELECT `state1`,`po`,branch_id FROM `atm` WHERE `track_id`='$trackid'";
else
$qry="SELECT `state`,`po`,branch FROM `Amc` WHERE `amcid`='$trackid'";
$po=$myrow[1];
$qryatm=mysql_query($qry);
$resatm=mysql_fetch_row($qryatm);
$qrycust=mysql_query("Select cust_name from customer where cust_id='".$cust."'");
$cname=mysql_fetch_row($qrycust);

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
			
		//	var numbers = /^[0-9]+$/;
		//  var namePattern = /^[A-Za-z()'"@#*+_-]/g ;  [!@#$%^&*(),.?":{}|<>]
		//	var regularExpression = /^[a-zA-Z0-9@#&()'.+,_/"-]+$/;
			
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
			/*//==============state
			if(state.value==0)
			{
				alert("Please Select State.");
				state.focus();
				return false;
			}*/
			//========Branch
			if(branch_avo.value==0)
			{
				alert("Please Select Branch.");
				branch_avo.focus();
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
  var callid=document.getElementById('callid').value;
  
//alert("get_datame.php?cust="+cust+"&po="+po+"&ref="+ref);
  
xmlhttp.open("GET","get_datame.php?cust="+cust+"&po="+po+"&ref="+ref+"&callid="+callid,true);

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
function fill()
{
//alert("hii");
//alert(document.getElementById('cc').value);
document.getElementById('ccemail').innerHTML='';
document.getElementById('ccemail').innerHTML=document.getElementById('cc').value;
}
</script>
</head>

<body onload="atmid();">
<center>
<?php 
include("menubar.php"); 
?>

<h2>Generate Installation Call</h2>

<div id="header">

<form action="process_alertme.php" method="post" name="form" onSubmit="return validate1(this)">
<input type="hidden" id="frmpg" name="frmpg" value="<?php echo $_GET["frmpg"];?>">
<br/>

<!--
<select name="call" id="call" onchange="alert_type();" style="border:2px #fff solid;">
<option value="0">Select Alert</option>
<option value="new">New Installation</option>
<option value="service">Service Alert</option>

</select>-->


<div id="assets" style="display:block;">
<table width="601">
 <tr><td width="158">
Subject : </td>
  <td width="154">

<input type="text" name="sub" id="sub">
<input type="hidden" name="callid" id="callid" value="<?php echo $callid; ?>" />
</td>
<td width="64"> Client Docket Number :
<td width="199"> 
<input type="text" name="doc" id="doc" value="New Installation Call" readonly>

</td></tr>
<tr>

<td width="64"> Customer :
<td width="158"> 
<input type="text" name="cust" id="cust" value="<?php echo $cname[0]; ?>" readonly >

</td>


 <!-- <tr><td width="158">
 Customer : </td>
<?php
 $client="select cust_id,cust_name from customer where 1";
    if($_SESSION['designation']==5){
    //echo "select client from clienthandle where logid='".$_SESSION['logid']."'";
    $cust=mysql_query("select client from clienthandle where logid= (select srno from login where username='".$_SESSION['user']."')");
    $cc=array();
    while($custr=mysql_fetch_array($cust))
    $cc[]=$custr[0];
    
    $ccl=implode(",",$cc);
    $ccl=str_replace(",","','",$ccl);
    $ccl="'".$ccl."'";
    $client.=" and cust_name in($ccl)";
    
    }
    $client.=" order by cust_name ASC";
    //echo $client;
    ?>
    <td width="154">
    <select name="cust" id="cust" onchange="po_no();"> <?php if($_SESSION['designation']!=5){ ?><option value="0">Select Client</option><?php }
$cl=mysql_query($client);
while($clro=mysql_fetch_row($cl))
{
?>
<option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>
<?php
}
?></select></td>-->

 <!-- <td width="154">

<select name="cust" id="cust" onchange="po_no();">
<option value="0">select</option>
<?php
$qry1=mysql_query("select * from customer");
while($row=mysql_fetch_row($qry1)){
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>


<?php } ?>
</select>
</td>-->
<td width="64"> PO No :
<td width="199" id="po_no"> 

<?php

$ponodb=$myrow[1];
//echo $ponodb;
?>
<input type="text" name="po" id="po" value="<?php echo htmlentities($ponodb); ?>" readonly >
<!--<select name="po" id="po" onchange="assets();">
<option value="0">select</option>
</select>-->
</td></tr>
<?php
include_once('../class_files/select.php');
$sel_obj=new select();
$atm=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("tracker_id"),"atm","","",array(""),"y","tracker_id","a");
?>

<tr>
<td width="115" height="35">Atm Id : </td>
<td width="305" id="ref_id1" colspan="3"><input type="hidden" name="cdate" value="<?php echo date('Y-m-d'); ?>" /><input type="hidden" name="trackid" id="trackid" value="<?php echo $_GET['trackid']; ?>" readonly >
<input type="text" name="ref_id" id="ref_id" value="<?php echo $atmid; ?>" readonly >
<!--<select name="ref_id" id="ref_id" onchange="atmid();">
<option value="0">select</option>
<?php
while($atmrow=mysql_fetch_row($atm)){ 
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

<!---STATE wise-->

<tr>
<td height="35">STATE : </td>
<td colspan="3">
<select id="state_st" name="state_st">
<option value="0">Select State</option>
<?php 
$sqlst=mysql_query("select * from `state`");
while($sqlst1=mysql_fetch_row($sqlst)){
?>
<option value="<?php echo $sqlst1[1]; ?>" <?php if($sqlst1[1]==$resatm[0]) echo "selected"; ?>><?php echo $sqlst1[1]; ?></option>
<?php }?>
</select>
</td>
</tr>

<!---Branch wise-->

<tr>
<td height="35">Branch : </td>
<td colspan="3">
<select id="branch_avo" name="branch_avo">
<option value="0">Select Branch</option>
<?php 
$sqlbr=mysql_query("select * from `avo_branch`");
while($sqlbr1=mysql_fetch_row($sqlbr)){
?>
<option value="<?php echo $sqlbr1[0]; ?>" <?php if($sqlbr1[0]==$resatm[2]) echo "selected"; ?>><?php echo $sqlbr1[1]; ?></option>
<?php }?>
</select>
</td>
</tr>

<tr>
<td height="35">Requirement : </td>
<td colspan="3"><textarea rows="4" cols="28" name="prob" id="prob"></textarea></td>
</tr>

<tr>
<td height="35">Contact Person : </td>
<td colspan="3"><input type="text" name="cname" id="cname" value="<?php echo $myrow[3];?>"/></td>
</tr>

<tr>
<td height="35">Contact : </td>
<td colspan="3"><input type="text" name="cphone" id="cphone" value="<?php echo $myrow[2];?>"/></td>
</tr>

<tr>
<td height="35">Email : </td>
<td colspan="3"><input type="checkbox" name="em" id="em" checked/><input type="text" name="cemail" id="cemail" value="<?php echo $myrow[4];?>"/></td>
</tr>
<tr>
<td height="35">CC Email : </td>
<td colspan="3"><?php
$cc=mysql_query("select e.email,c.cust_name,e.bank from emailid e,customer c where e.custid=c.cust_id and e.status=0 and type='service' order by c.cust_name,e.bank ASC");
?>
<select name='cc' id='cc' onchange="fill();">
<option value="">Select CC Emails</option>
<?php
while($ccro=mysql_fetch_array($cc))
{
?>
<option value="<?php echo $ccro[0]; ?>"><?php echo $ccro[1]." - ".$ccro[2]; ?></option>
<?php
}
?>
</select><br><textarea name="ccemail" id="ccemail"  rows=5 cols=25><?php if(isset($_POST['ccemail'])){ echo $_POST['ccemail']; } ?></textarea></td>
</tr>
<tr>
<td colspan="4" height="35"><input type="submit" value="submit" class="readbutton" /></td>
</tr>
</table>
</div>
</form>

</div>
</center>
</body>
</html>
<?php  ?>
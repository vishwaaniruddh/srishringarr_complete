<?php
include("access.php");

//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New Temporary Site</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--validation-->

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
    

function validate1(form1){ debugger;
 with(form1)
 { debugger;
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

if(sub.value==0)
{
	alert("Please Mention Subject .");
	sub.focus();
	return false;
}	
	
if(po_no.value==0)
{
	alert("Please Enter Atmid.");
	po_no.focus();
	return false;
}
if(atmid.value==0)
{
	alert("Please Enter Atmid.");
	atmid.focus();
	return false;
}
if(bank.value=='')
{
	alert("Please Enter Bank Name.");
	bank.focus();
	return false;
}
if(area.value=='')
{
	alert("Please Enter Area.");
	area.focus();
	return false;
}
if(type.value=='')
{
	alert("Please Select Site Type ");
	type.focus();
	return false;
}
if(city.value=='')
{
	alert("Please Enter City.");
	city.focus();
	return false;
}


if(state.value=='')
{
	alert("Please Enter State.");
	state.focus();
	return false;
}
if(address.value=='')
{
	alert("Please Enter Address.");
	address.focus();
	return false;
}

if(pincode.value=='')
{
	alert("Please Enter Address.");
	pincode.focus();
	return false;
}

if(type_call.value=='')
{
	alert("Please Select Call Type.");
	type_call.focus();
	return false;
}

if(prob.value=='')
			{
				alert("Please Select Problem.");
				prob.focus();
				return false;
			}


if(appby.value.search(/[a-z]+$/) == -1 && appby.value.search(/[A-Z]+$/) == -1 && appby.value.length <= 5)
		
			{
				alert("Please mention who has approved to log.");
				appby.focus();
				return false;
			}
			if(how.value.search(/[a-zA-Z]+$/) == -1 && how.value.length <= 5)
			{
				alert("Please Enter Reason for temporary call.");
				how.focus();
				return false;
			}


//// Temp Call Type =========



if(type_call.value=="service" || type_call.value=="dere"  ){
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
			
	}
 }
 //return false;
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





function addThem()
{
var a = document.form.asset;
var add = a.value+',';
document.form.asset_box.value += add;
return true;
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



function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
} 



function DDL_Problem(){
//alert("Hi!!!!");
var ddlprob=document.getElementById('ddl_prob').value;

 //$("#prob").attr("value", "");
if(ddlprob=="Others"){

document.getElementById('prob').innerHTML=ddlprob;
  document.getElementById('prob').readOnly = false;
}else{

 document.getElementById('prob').innerHTML=ddlprob; 
  document.getElementById('prob').readOnly = true;
}

}



</script>


</head>

<body>
<center>
<?php include("menubar.php"); ?>

<h2>New Temporary Site Alert</h2>
<form action="processtempsite.php" method="post" name="form" onSubmit="return validate1(this)">
<br/>
<table width="500">
<tr>
<td width="115" height="35">Subject : </td>
<td width="305">
<input type="text" name="sub" id="sub" />
</td>
</tr>
<tr>
<!--<td width="115" height="35">Site Status : </td>
<td width="305">

<select name="doc" id="doc" required>
<option value="">select</option>
<option value="Operational">Operational </option>
<option value="Non Operational">Non Operational</option>
<option value="Chargeable">Chargeable</option>
</select> -->

</td>
</tr>
  <tr><td width="155">
Select Customer : </td><td width="131">

<select name="cust" id="cust">
<option value="0">select</option>
<?php
$qry1=mysqli_query($con1,"select * from customer");
while($row=mysqli_fetch_row($qry1)){
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>


<?php } ?>
</select>
</td></tr>
<tr>
<td width="59"> PO No :</td>
<td width="180" id="po_no"> 
<input type="text" name="po" id="po" /><input type="hidden" name="cdate" value="<?php echo date('Y-m-d h:i:s'); ?>" /></td>

</tr>

<tr>
<td width="115" height="35">Site / ATM Id : </td>
<td width="305">
<input type="text" name="atmid" id="atmid" />
</td>
</tr>
<tr>
<td width="115" height="35">Bank Name : </td>
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
		$selbr="select * from avo_branch where 1";
		if($_SESSION['branch']!='all')
		$selbr.=" and id in(".$_SESSION['branch'].") ";
		
	 	$selbr.=" order by id ASC";
		//echo $selbr;
		$selbr2=mysqli_query($con1,$selbr)
		?>
        <select name="branch_avo" id="branch_avo" onchange="pick_state(this.value);">
        
		<?php if($_SESSION['branch']=='all'){?>
        <option value="">Branch</option>
        <?php }?>
        
		<?php
        
        while($branch1=mysqli_fetch_array($selbr2))
        {
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

$stqry="select state,state_id from state where 1";

	if($_SESSION['branch']!='all')
	$stqry.=" and branch_id= '".$_SESSION['branch']."'";
	//echo $stqry;
?>
<?php
	$stqry="select state,state_id from state where 1";
	if($_SESSION['branch']!='all')
	$stqry.=" and branch_id= '".$_SESSION['branch']."'";
	
	?>
	<select name="state" id="state" >
	<option value="0">-select State-</option>
	<?php
	$stateqry=mysqli_query($con1,$stqry);
	while($sttro=mysqli_fetch_array($stateqry))
	{
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
<textarea name="address" id="address" rows="3" cols="28" /></textarea>
</td>
</tr>

<tr>
<td width="115" height="35">Type of Site: </td>
<td width="305">
<select name="type" id="type" required>
<option value="">Select</option>
<option value="addon">Addon AMC</option>
<option value="pcb">Chargeable</option>
<option value="goodwill">Goodwill Basis</option>
<option value="warr">Warranty not find</option>
</select>
</td>
</tr>
<tr>
<td height="35"> Date : </td>
<td><input type="text" name="adate" id="adate" onclick="displayDatePicker('adate');" value="<?php echo date('d/m/Y h:i:s'); ?>" /></td>
</tr>

<tr>
<td height="35">Type Of Call : </td>
<td colspan="3">
<select name="type_call" id="type_call" onchange="pmdisable(this.value);" required>
<option value="service">Service Call</option>
<option value="pm">PM Call</option>
<option value="dere"> De-Re Installation</option>
</select>
</td>
</tr>

<tr>
<td height="35">Problem : </td>

<td><select id="ddl_prob" name="ddl_prob" onchange="DDL_Problem()" required>
<option value="">Select Problems</option>

<option value="UPS Down">UPS Down</option>
<option value="Re-De Install">Re-De Installation</option>
<option value="UPS Backup issue">UPS Backup issue </option>
<option value="UPS Beap Sound">UPS Beap Sound</option>
<option value="Servo Issue">Servo Issue</option>
<option value="IT Not Working">IT Not Working</option>
<option value="UPS Output abnormal">UPS Output abnormal</option>
<option value="Solar Issue">Solar Issue</option>
<option value="Others">Others</option>
</select>

<textarea rows="2" cols="28" name="prob" id="prob" readonly></textarea></td>
</tr>

<tr>
<td height="35">Contact Person : </td>
<td><input type="text" name="cname" id="cname" maxlength="20"  /></td>
</tr>

<tr>
<td height="35">Contact No.: </td>
<td><input type="text" name="cphone" id="cphone"  onkeypress="return isNumber(event)" maxlength="10"  /></td>
</tr>

<tr>
<td height="35">Email : </td>
<td><input type="text" name="cemail" id="cemail"/></td>
</tr>
<td height="35" style="color:blue;">WhatsApp Numbers: <br> Multiple numbers separated with Comma(,) </td>
<td><textarea name="whatsno" id="whatsno"  onkeypress="CheckNumeric(event);" rows=3 cols=28></textarea></td>

<tr>
<td height="35">CC Email : </td>
<td>
<?php
$cc=mysqli_query($con1,"select e.email,c.cust_name,e.bank from emailid e,customer c where e.custid=c.cust_id and e.status=0 order by c.cust_name,e.bank ASC");
?>
<select name='cc' id='cc' onchange="fill();">
<option value="">Select CC Emails</option>
<?php
while($ccro=mysqli_fetch_array($cc))
{
?>
<option value="<?php echo $ccro[0]; ?>"><?php echo $ccro[1]." - ".$ccro[2]; ?></option>
<?php
}
?>
</select>
<textarea name="ccemail" id="ccemail"  rows=5 cols=25></textarea></td>
</tr>
<tr><td>Approved By:</td><td colspan="3"><input type="text" name="appby" id="appby" minlength="7" required /></td></tr><tr>
<td valign="top">Reason for temp call:</td>  <td><textarea name="how" id="how" minlength="10" required/></textarea>

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
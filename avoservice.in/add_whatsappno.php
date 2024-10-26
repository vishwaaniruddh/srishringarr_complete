<?php
session_start();
include("access.php");
include('config.php');
 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Client WhatsApp nos</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script>
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

if(client.value=='')
{
alert("Please Select Client");
client.focus();
return;
}
if(bank.value=='')
{
alert("Please Select Bank");
bank.focus();
return;
}

if(name.value=='')
{
alert("Please Enter Name.");
name.focus();
return;
}
if(whatsapp_no.value=='')
{
alert("Please Enter WhatsApp No.");
whatsapp_no.focus();
return;
}

if(whatsapp_no.value!='')
{

 var y = whatsapp_no.value;
 if(isNaN(y)||y.indexOf(" ")!=-1)
           {
              alert("Enter numeric value for Phone ");
              whatsapp_no.value='';
              whatsapp_no.focus();
              return;
           }
           if (y.length>10)
           {
                alert("Enter 10 Numbers without starting 0");
               whatsapp_no.focus();
                return;
           }
}

form.submit();
}
}

function getbank(val)
{ 
//alert(val);
  var xmlHttp = getXMLHttp();
 

  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
    //alert(xmlHttp.responseText);
    if(xmlHttp.responseText==0)
    alert("sorry, your session has expired");
    else
document.getElementById('bank').innerHTML=xmlHttp.responseText;
      //HandleResponse3(xmlHttp.responseText);
    }
  }

  xmlHttp.open("GET", "get_groupname.php?cust="+val, true);

  xmlHttp.send(null);

}
</script>
</head>

<body>
<center>
<?php 
if($_SESSION['designation']==5){
   include("AccountManager/menubar.php");
   } else {
     include("menubar.php");  
        }
?>
<h2>Add Customer WhatsApp Numbers</h2>
<div id="header">
<form action="process_add_whatsappno.php" method="post" name="engform" enctype="multipart/form-data" id="engform">
<table>


<tr>

<td height="35">Select Client : </td>

<? $client="select * from customer where 1";
    
    
    if($_SESSION['designation']==5){
    //echo "select client from clienthandle where logid='".$_SESSION['logid']."'";
    $cust=mysqli_query($con1,"select client from clienthandle where logid= (select srno from login where username='".$_SESSION['user']."')");
    $cc=array();
    while($custr=mysqli_fetch_array($cust))
    $cc[]=$custr[0];
    
    $ccl=implode(",",$cc);
    $ccl=str_replace(",","','",$ccl);
    $ccl="'".$ccl."'";
    $client.=" and cust_name in($ccl)";
    
    }


?>

<td>
<select name="client" id="client" onchange="getbank(this.value);">
<option value="">Select Client</option>

<?
$cl=mysqli_query($con1,$client);

while($clro=mysqli_fetch_row($cl))
{
?>

<option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>

<?php
}
?>
</td>
</tr>

<tr>
<td height="35">WhatsApp Group: </td>
<td><select name="bank" id="bank">
<option value="">Select </select>
</select>
</td>
<td><button id="myButton" onClick="javascript:window.location='add_whatsappgroup.php'">Add New</button></td>
</tr>

<tr>
<td height="35"> Person Name: </td>
<td><input type="text" name="name" id="name" </td>
</tr>

<tr>
<td height="35"> WhatApp No.: </td>
<td><input type="tel" name="whatsapp_no" id="whatsapp_no" pattern="[1-9]{1}[0-9]{9}" required> </td>
</tr>

<tr>
<td height="35" colspan="2"><input  type="button" value="submit" class="readbutton" onclick="validate();"/></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
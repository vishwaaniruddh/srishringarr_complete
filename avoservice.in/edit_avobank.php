<?php
session_start();
include("access.php");
 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CC Mail ID</title>
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

  xmlHttp.open("GET", "getbnk.php?cust="+val, true);

  xmlHttp.send(null);

}
</script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>


<h2>Edit Bank Customer Wise</h2>
<div id="header">
<form action="process_edit_bank.php" method="post" name="engform" enctype="multipart/form-data" id="engform">
<table>
<?php
 $bank=mysqli_query($con1,"select * from `avo_bank` where `bank_id`='".$_GET['id']."'");
 $bank1=mysqli_fetch_row($bank);
 ?>

<tr>
<td height="35">Select Client : </td>
<td>
<select name="client" id="client" onchange="getbank(this.value);">
<option value="">Select Client</option>
<?php
$clnt=mysqli_query($con1,"select * from customer");
while($clntro=mysqli_fetch_array($clnt))
{
?>
<option value="<?php echo $clntro[0]; ?>" <?php if($clntro[0]==$bank1[2]) echo "selected" ?>> <?php echo $clntro[1]; ?></option>
<?php
}
?>
</td>
</tr>

<tr>
<td height="35">Bank : </td>
<td><input type="text" name="bank" id="bank" value="<?php echo $bank1[1]; ?>" />
<input type="hidden" name="bankid" id="bankid" value="<?php echo $bank1[0]; ?>" />
</td>
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
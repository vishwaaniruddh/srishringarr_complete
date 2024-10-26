<?php
session_start();
include("access.php");
 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit CC Maid ID</title>
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
if(email.value=='')
{
alert("Please Enter Email ID");
email.focus();
return;
}
/*if(email.value!='')
{
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
if(!email.value.match(mailformat))  
{   
alert("You have entered an invalid email address!");  
email.focus();  
return;  
}  

}
*/
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
<?php include("menubar.php");
$ccm=mysqli_query($con1,"select * from emailid where id='".$_GET['id']."'");
$ccmro=mysqli_fetch_row($ccm);
//echo $ccmro[1];
 ?>


<h2>Edit CC Email IDs</h2>
<div id="header">
<form action="procedtem.php" method="post" name="engform" enctype="multipart/form-data" id="engform">
<table>


<tr>
<td height="35">Select Client : </td>
<td>
<select name="client" id="client">

<?php
$clnt=mysqli_query($con1,"select * from customer where cust_id='".$ccmro[1]."'");
$clntro=mysqli_fetch_row($clnt);
?>
<option value="<?php echo $ccmro[1]; ?>"><?php echo $clntro[1]; ?></option>
<?php
/*while($clntro=mysqli_fetch_array($clnt))
{
?>
<option value="<?php echo $clntro[0]; ?>" <?php if($clntro[0]==$ccmro[1]){ ?>selected="selected"<?php } ?>><?php echo $clntro[1]." ".$ccmro[1]." ".$clntro[0]; ?></option>
<?php
}*/
?>
</td>
</tr>

<tr>
<td height="35">Bank : </td>
<td><select name="bank" id="bank">
<option value="<?php echo $ccmro[2]; ?>"><?php echo $ccmro[2]; ?></select>
</select>
</td>
</tr>
<tr>
<td height="35">Type : </td>
<td><select name="type" id="type">
<option value="">Select Type</option>
<option value="service" <?php if($ccmro[5]=='service'){ echo "selected"; } ?>>Service</option>
<option value="new" <?php if($ccmro[5]=='new'){ echo "selected"; } ?>>New Installation</option>
</select>
</td>
</tr>
<tr>
<td height="35" valign="top">Email IDs:<br>(Press Enter after 1 Email ID) </td>
<td><textarea name="email" id="email" rows=7 cols=25><?php echo $ccmro[3]; ?></textarea></td>
</tr>

<tr>
<td height="35" colspan="2"><input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"><input  type="button" value="submit" class="readbutton" onclick="validate();"/></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
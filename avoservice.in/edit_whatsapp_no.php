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

  try   {

    //Firefox, Opera 8.0+, Safari
 xmlHttp = new XMLHttpRequest();
  }   catch(e)  {
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
           if (y.length !=10)
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

  xmlHttp.open("GET", "getbnk.php?cust="+val, true);

  xmlHttp.send(null);

}
</script>
</head>

<body>
<center>
<?php if($_SESSION['designation']==5){
   include("AccountManager/menubar.php");
   } else {
     include("menubar.php");  
        } ?>


<h2>Edit Customer WhatsApp Numbers</h2>
<div id="header">
<form action="process_edit_whatsappno.php" method="post" name="engform" enctype="multipart/form-data" id="engform">
<table>
<? $id= $_GET['id'];
$client="select * from whatsapp_customer where id='".$id."'";
$qry=mysqli_query($con1,$client);
$row=mysqli_fetch_row($qry);

$custqry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
$cust=mysqli_fetch_row($custqry);

$groupqry=mysqli_query($con1,"select * from whatsapp_groupname where id='".$row[2]."'");
$group=mysqli_fetch_row($groupqry);

?>

<tr>

<td height="35">Client : </td>
<td height="35"> <?php echo $cust[0]; ?> </td>

</tr>

<tr>

<td height="35">Group Name: </td>
<td height="35"> <?php echo $group[2]; ?> </td>

</tr>

<tr>

<td height="35">Type: </td>
<td height="35"> <?php echo $group[3]; ?> </td>

</tr>

<tr>
<td height="35"> Person Name: </td>
<td><input type="text" name="name" id="name" value="<?php echo $row[3]; ?>"> </td>
</tr>

<tr>
<td height="35"> WhatApp No.: </td>
<td><input type="text" name="whatsapp_no" id="whatsapp_no"  value="<?php echo $row[4]; ?>" pattern="[1-9]{1}[0-9]{9}" required> </td>
</tr>

<tr>
<input type="hidden" name="id" value="<?php echo $row[0]; ?>" />
<td height="35" colspan="2"><input  type="button" value="submit" class="readbutton" onclick="validate();"/></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
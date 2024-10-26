<?php
include("access.php");

include("config.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New Account Manager/Client</title>
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
/*if(city.value=='')
{
//alert("hi");
alert("Select City first");
city.focus();
return;
}*/
if(logintype.value=='0')
{
alert("Please Select Login Type");
logintype.focus();
return;
}
if(name.value=='')
{
alert("Please Enter  Name");
name.focus();
return;
}
if(cont.value=='')
{
alert("Please Enter Contact Number");
cont.focus();
return;
}
if(cont.value!='')
{
//alert("hello");
 var y = cont.value;
 if(isNaN(y)||y.indexOf(" ")!=-1)
           {
              alert("Enter numeric value for Phone ");
              cont.value='';
              cont.focus();
              return;
           }
           if (y.length>11)
           {
                alert("Enter 11 characters starting with 0");
               cont.focus();
                return;
           }
           if (y.charAt(0)!="0")
           {
           cont.value='0'+y;
               // alert("Phone1 should start with 0 ");
                //ph1.focus();
              //  return;
           }
}
if(email.value=='')
{
alert("Please Enter Email ID");
email.focus();
return;
}
if(email.value!='')
{
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
if(!email.value.match(mailformat))  
{   
alert("You have entered an invalid email address!");  
email.focus();  
return;  
}  

}

form.submit();
}
}
</script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>


<h2>New Users </h2>
<div id="header">
<form action="process_accmanager.php" method="post" name="engform" enctype="multipart/form-data" id="engform">
<table>

<tr>
<td height="35">Branch : </td>
<td id="res"><select name='area' id='area'>
<option value='0'>ALL</option>
<?php
include("config.php");
$state=mysqli_query($con1,"select * from avo_branch");
while($stro=mysqli_fetch_row($state))
{
?>
<option value="<?php echo $stro[0];  ?>"><?php echo $stro[1];  ?></option>
<?php
}
?></select>
</td>
</tr>
<tr>
<td height="35">Login Type: </td>
<td id="res"><select name='logintype' id='logintype'>
<option value='0'>select</option>
<option value='2'>Help Desk</option>
<option value='5'>Account Manager</option>
<option value='6'>Client</option>
<option value='7'>Accounts</option>
</td>
</tr>
<tr>
<td height="35">Name : </td>
<td><input type="text" name="name" id="name" /></td>
</tr>

<tr>
<td height="35">Contact : </td>
<td><input type="text" name="cont" id="cont" /></td>
</tr>

<tr>
<td height="35">Email : </td>
<td><input type="text" name="email" id="email" /></td>
</tr>
<!--<tr>
<td height="35">Upload Resume : </td>
<td><input type="file" name="resume" id="resume" /></td>
</tr>
<tr>-->
<tr><td colspan="2">
<?php
//echo "Select cust_id,cust_name from customer";
$qrycust=mysqli_query($con1,"Select cust_id,cust_name from customer");
while($rescust=mysqli_fetch_row($qrycust))
{
?>
<input type="checkbox" name="custx[]" id="custx[]" value="<?php echo $rescust[1]; ?>"><?php echo $rescust[1]; ?> 
<?php
}
?>
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
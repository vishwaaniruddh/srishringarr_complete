<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>


<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--validation-->
<script>
function validate(form){
 with(form)
 {
var numbers = /^[0-9]+$/;  

if(ref.value=="")
{
alert("Please Enter Reference ID");
ref.focus();
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
</script>
</head>

<body>
<center>
<?php /////include("menubar.php");
include("config.php"); ?>


<form action="process_newsite.php" method="post" enctype="multipart/form-data" name="form">
<table>
<tr>
<td width="126" height="35">Select Customer : </td>
<td width="221">
<select name="cust" id="cust">
<option value="0">select</option>
<?php
$qry1=mysqli_query($con1,"select * from customer");
while($row=mysqli_fetch_row($qry1)){
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>


<?php } ?>
</select></td>
</tr>

<tr>
<td height="35"><b>Select *.csv File to Import :</b></td>
<td><input type="file" name="userfile" value=""></td>
</tr>

<tr>
<td height="35" colspan="2" align="left"><font size="+1"><b>Select Assets</b></font> </td>
</tr>
<tr><td><table>
<?php
$qry=mysqli_query($con1,"select * from assets");
while($ass_row=mysqli_fetch_row($qry)){
?>
<tr>
<td height="35" colspan="2" align="left"><input type="checkbox" name="ass[]" value="<?php echo $ass_row[1]; ?>"/></td>
<td><?php echo $ass_row[1]; ?></td>
<td><select name="valid[]"> 
<option value="3,month" selected="selected">3 Month</option>
<option value="6,month">6 Month</option>
<option value="1,year">12 Month</option>
<option value="2,year">24 Month</option>
<option value="3,year">36 Month</option>
</select>
</td>
</tr>
<?php } ?>
</table></td></tr>


<tr>
<td height="35"><input type="submit" value="submit" class="readbutton" /></td>
</tr>
</table>
</form>

</center>
</body>
</html>
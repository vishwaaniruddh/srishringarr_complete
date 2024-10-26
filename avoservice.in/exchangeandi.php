<?php
include("access.php");
 
$engg=$_GET['engid'];
$logid=$_GET['logid'];
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script>


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


function validate()
{
//alert("hello");
var form=document.getElementById('engform');
with(form)
{
//alert("hello");
if(eng.value=='')
{
//alert("hi");
alert("Please select person to whom phone you want to exchange!! ");
eng.focus();
return;
}

form.submit();
}
}
</script>
</head>

<body>
<center>
<?php include("menubar.php");
include("config.php");
 ?>


<h2>Change Android Phone</h2>
<div id="header">
<form action="procexchngandi.php" method="post" name="engform" enctype="multipart/form-data" id="engform">
<table>
<tr>
<td width="130" height="35">Exchange Phone From: </td>
<td width="189">
<?php
$str="select * from area_engg  where status='1' and deleted='0' order by area ASC";

$eng=mysqli_query($con1,$str);

?>
<select name="eng" id="eng">

<option value="">select</option>
<?php while ($row=mysqli_fetch_row($eng)) { 

$st="select name from avo_branch where id='".$row[2]."'";
//echo "select name from avo_branch where id='".$row[2]."'";

$st2=mysqli_query($con1,$st);
$st2ro=mysqli_fetch_row($st2);

?>
<!--<option value="" disabled></option>
<option value="<?php echo ''; ?>" disabled style='background:black; color:white'><?php echo $st2ro[0]; ?></option> -->

<option value="<?php echo $row[0] ; ?>"><?php echo $st2ro[0]."--".$row[1]; ?> </option>
<?php } ?>
</select>
</td>
</tr>
<?php

$pple="select engg_id, engg_name from area_engg where loginid='".$logid."'";

$ppleqry=mysqli_query($con1,$pple);
$pplero=mysqli_fetch_row($ppleqry);
?>
<tr>
<td>
To the Engineer
</td>

<td>
<input type="hidden" name="oldid" id="oldid" value="<?php echo $engg; ?>"> <?php echo $pplero[1]; ?> </td>
</tr>

<tr>
<td height="35" colspan="2">

<input type="hidden" name="logid" id="logid" value="<?php echo $logid; ?>">
<input  type="button" value="submit" class="readbutton" onclick="validate();"/></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
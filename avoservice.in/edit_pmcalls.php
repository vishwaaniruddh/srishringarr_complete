<?php include("access.php");
include("config.php");
//include("search_pmalert_new.php");
$getdata=$_GET['id'];

//echo "hello : ".$getdata;

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--validation-->
<script>
function validate(form){
 with(form)
 {
var numbers = /^[0-9]+$/;  

if(atm.value=="")
{
alert("Please Enter ATM ID");
atm.focus();
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
//var str=document.getElementById('state').value;
//alert(str);
 // xmlHttp.open("GET", "get_city.php?state="+str, true);

  //xmlHttp.send(null);

}

function HandleResponse3(response)

{
//alert(response);
  document.getElementById('res').innerHTML = response;

}
</script>
</head>


<?php 
$qrypm=mysqli_query($con1,"select * from Pmcalls where Id='".$getdata."'");
$pm=mysqli_fetch_array($qrypm);






$tabdet="";
$atmdet="";
if(substr($row[1], 0, 4) == 'temp')
{
$watm="select * from tempsites where atmid='".$pm[1]."'";//get atmid
$atmdet=mysqli_query($con1,$watm);
$norrs=mysqli_num_rows($atmdet);
$tabdet="tempsites";

if($norrs=='0')
{
$watm1="select * from tempsites_pm where atmid='".$pm[1]."'";//get atmid
$atmdet=mysqli_query($con1,$watm1);
$tabdet="tempsites_pm";
}
}
else
{
$watm="select bank_name,address,cust_id,state1 from atm where atm_id='".$pm[1]."'";//get atmid
$atmdet=mysqli_query($con1,$watm);

$norrs=mysqli_num_rows($atmdet);
$tabdet="atm";
if($norrs==0)
{
$watm1="select bankname,address,cid,state from Amc where atmid='".$pm[1]."'";//get atmid
$atmdet=mysqli_query($con1,$watm1);
$tabdet="Amc";
}

}
$detroww=mysqli_fetch_array($atmdet);
$qrycust=mysqli_query($con1,"select cust_name from customer where cust_id='".$detroww[2]."'");
//echo "select cust_name from customer where cust_id='".$detroww[2]."'";
$ctm=mysqli_fetch_array($qrycust);
//echo $ctm[0];



?>




<body>


<center>
<?php // include("menubar.php"); ?>
<h2>Edit Pmcalls</h2>
<?php

$qrycust=mysqli_query($con1,"select cust_id,cust_name from customer ");



//$qryatm=mysqli_query($con1,"select * from Pmcalls where Id='".$getdata."'");
//$getatmqry=mysqli_fetch_array($qryatm);

//echo "select * from Pmcalls where Atmid='".$getdata."'";


//$qrycusttxt=mysqli_query($con1,"");
//$id=$_GET['id'];
//include_once('class_files/select.php');
//$sel_obj=new select();
//$atm=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("*"),"atm","track_id",$id,array(""),"y","state","a");
//$arow=mysqli_fetch_row($atm);
?>
<div id="header">
<form action="update_pmcalls.php" method="post" name="form">
<table>
<td height="35">Table Name : </td>
<td><select name="tbl" id="tbl">
<option value="">select table</option>
<option value="Amc" id="amc" <?php if($tabdet=='Amc'){ echo "selected";} ?>>Amc</option>
<option value="atm" id="atm" <?php if($tabdet=='atm'){ echo "selected";} ?>>atm</option>
<option value="tempsites" id="tempsite" <?php if($tabdet=='empsites'){ echo "selected";} ?>>Tempsites</option>
<option value="tempsites_pm" id="temp_pm" <?php if($tabdet=='tempsites_pm'){ echo "selected";} ?>>Tempsites_pm</option>

</select>
</td>
</tr>

<tr>
<td height="35">ATM ID : </td>
<td><input type="text" name="atmid" value="<?php echo $pm[1];?>" /></td>
</tr>

<tr>
<td height="35">Customer Name : </td>
<td><select name="cust" id="cust">
<option value="">select Customer</option>
<?php 
while($cstr=mysqli_fetch_array($qrycust))
{

?>
<option value="<?php echo $cstr[0];?>" <?php if($ctm[0]==$cstr[1]){ echo "selected";} ?> ><?php echo $cstr[1];?></option>
<?php }?>
</select>
</td>
</tr>

<tr>
<td height="35"> Bank Name : </td>
<td>
<input type="text" name="bank" value="<?php echo $detroww[0]; ?>" />

</td>
</tr>

<tr>
<td height="35">Address : </td>
<td><textarea rows="4" cols="28" name="add" ><?php echo $detroww[1]; ?></textarea></td>
</tr>

<tr>
<td height="35"> State : </td>
<td>
<select name="state" id="state" >
<option value="0">select</option>
<?php
$stqry=mysqli_query($con1,"select state from state");

?>
<?php 
while($st=mysqli_fetch_array($stqry))
{

?>
<option value="<?php echo $st[0];?>" <?php if($detroww[3]==$st[0]){ echo "selected";} ?> ><?php echo $st[0];?></option>
<?php }?>
</select>
</td>
</tr>



<tr>
<td height="35" colspan="2" align="center">

<input type="submit" value="submit" class="readbutton" /></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>